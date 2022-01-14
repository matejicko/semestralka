<?php

namespace App;

use App\Config\Configuration;
use App\Models\country;
use App\Models\ingredient;
use App\Models\list_of_ingredients;
use App\Models\recipe;
use App\Models\unit;

class RecipesHandler
{
    public static function getRecipesForUser($user_id)
    {
        return recipe::getAll('user_id = ?', [$user_id]);
    }

    public static function getAllIngredientsNames()
    {
        $ingredients = ingredient::getAll();
        $i = 0;
        $names = [];

        if ($ingredients != null) {
            foreach ($ingredients as $ingredient) {
                $names[$i] = $ingredient->getName();
                $i++;
            }
        }

        return $names;
    }

    public static function getAllUnitsShortcuts()
    {
        $units = unit::getAll();
        $i = 0;
        $shortcuts = [];

        if ($units != null) {
            foreach ($units as $unit) {
                $shortcuts[$i] = $unit->getShortcut();
                $i++;
            }
        }

        return $shortcuts;
    }

    public static function getAllCountriesNames()
    {
        $countries = country::getAll();
        $i = 0;
        $names = [];

        if ($countries != null) {
            foreach ($countries as $country) {
                $names[$i] = $country->getName();
                $i++;
            }
        }

        return $names;
    }

    public static function getCountriesForRecipesAsMap(array $recipes)
    {
        $mapOfCountries = [];

        foreach ($recipes as $recipe) {
            $mapOfCountries[$recipe->getCountryId()] = country::getOne($recipe->getCountryId());
        }

        return $mapOfCountries;
    }

    public static function addRecipe(Core\Request $request, $picture)
    {
        //----------------------------------FETCHING INPUT FROM REQUEST----------------------------------
        //First segment of form - title and photo
        $title = $request->getValue('title');

        //Second segment of form - attributes of recipe
        $country = $request->getValue('country');
        $duration_value = $request->getValue('duration_value');
        $duration_unit = $request->getValue('duration_unit');
        $portion = $request->getValue('portion');


        //Third segment of form - ingredients
        $i = 0;
        while (1) {
            $ingredient_value[$i] = $request->getValue('ingredient_value_' . ($i + 1));
            $ingredient_unit[$i] = $request->getValue('ingredient_unit_' . ($i + 1));
            $ingredient[$i] = $request->getValue('ingredient_' . ($i + 1));

            //in case of end of list of ingredients
            if (!(isset($ingredient_value[$i]) &&
                isset($ingredient_unit[$i]) &&
                isset($ingredient[$i]))) {

                break;
            }

            $i++;
        }


        //Fourth segment of form - process
        $process = $request->getValue('process');

        //Fifth segment of form - about
        $about = $request->getValue('about');

        //----------------------------------CONTROL INPUT FORMAT AND CONSISTENCY----------------------------------
        $recipe = new recipe();

        //title is mandatory, has to be maximum 64 chars long and <script> mark is forbidden
        if (!FormatChecker::checkPlainText($title) || strlen($title) > 64){
            return false;
        }

        $recipe->setTitle($title);

        $recipeId = 0;
        try{ //try to find ID for recipe, that will be added
            $recipes = recipe::getAll();
            if (isset($recipes)){
                $recipeId = $recipes[count($recipes) - 1]->getId() + 1;
            }else{
                $recipeId = 1;
            }
        }catch(\Exception){

        }


        if (isset($picture)) {
            if ($picture["error"] == UPLOAD_ERR_OK) {
                $nameImg =  $title . "_RECIPE_" . $recipeId . "_" . $picture['name'];
                $via = Configuration::UPLOAD_DIR_RECIPE_PHOTO . "$nameImg";
                move_uploaded_file($picture['tmp_name'], $via);

                $recipe->setImage($via);
            }
        }

        //controls if country exists in DB
        $countryCheck = country::getAll('name = ?', [$country]);
        if (!isset($countryCheck[0])){
            return false;
        }

        $recipe->setCountryId($countryCheck[0]->getId());

        //duration format control
        if (FormatChecker::checkNonNullityAndNonEmptiness($duration_value) &&
            FormatChecker::checkNonNullityAndNonEmptiness($duration_unit)){

            if (floatval($duration_value) > 0){
                $duration = $duration_value . " " . $duration_unit;
                $recipe->setDuration($duration);
            }else{
                return false; //duration has to be positive number
            }
        }

        //portions control
        if (FormatChecker::checkNonNullityAndNonEmptiness($portion)){
            if (intval($portion) > 0){
                $recipe->setPortions(intval($portion));
            }else{
                return false; //number of portions has to be positive number
            }
        }

        //process field is mandatory
        if (!FormatChecker::checkPlainText($process)){
            return false;
        }else{
            $recipe->setProcess($process);
        }

        //about field is not mandatory
        if (FormatChecker::checkNonNullityAndNonEmptiness($about)){

            //if there is about section, it has to follow some rules, otherwise recipe won't be added
            if (FormatChecker::checkPlainText($about)){
                $recipe->setAbout($about);
            }else{
                return false;
            }
        }

        //this function controls if ingredients input is correct and if needed, new ingredient is added to database
        if (!self::controlIngredientsInput($ingredient_value, $ingredient_unit, $ingredient)){
            return false;
        }

        //to add recipe, some user has to be logged in
        $loggedUser = AccountHandler::getLoggedUser();
        if ($loggedUser == null){
            return false;
        }else{
            $recipe->setUserId($loggedUser->getId());
        }

        //----------------------------------FINALIZATION----------------------------------
        //now when whole input is controlled, we can save recipe and transfer it to the database
        $recipeId = 0;
        try{

            $recipe->save();
        }catch(\Exception){
            return false;
        }

        //all recipe-ingredient associations have to be stored in DB
        for ($i = 0; $i < count($ingredient) - 1; $i++){
            if (isset($ingredient_value[$i]) && isset($ingredient_unit[$i]) && isset($ingredient[$i])){
                try{
                    $quantity = floatval($ingredient_value);

                    $ingredients = ingredient::getAll('name = ?', [$ingredient[$i]]);
                    $units = unit::getAll('shortcut = ?', [$ingredient_unit[$i]]);

                    if (isset($ingredients[0]) && isset($units[0])){
                        $association = new list_of_ingredients(recipe_id: $recipeId,
                            ingredient_id: $ingredients[0]->getId(),
                            unit_id: $units[0]->getId(),
                            quantity: $quantity);

                        $association->save();
                    }

                }catch(\Exception){
                    try{
                        $recipe->delete(); //try to delete yet saved recipe
                    }catch(\Exception){
                    }
                    return false;
                }
            }
        }

        return true;

    }

    /**Function controls if ingredients input is correct and in case that some ingredient/s are
     * not in DB, they are added. All arrays have to be same length.
     * @param array $ingredient_value - list of ingredients quantities
     * @param array $ingredient_unit - list of ingredients units
     * @param array $ingredient - list of ingredients names
     * @return false|true - return whether ingredients input is correct or not
     */
    private static function controlIngredientsInput(array $ingredient_value, array $ingredient_unit, array $ingredient)
    {

        for ($i = 0; $i < count($ingredient) - 1; $i++) {

            if ($ingredient_value[$i] != null){

                //quantity of ingredient has to be greater than 0
                if (floatval($ingredient_value[$i] >= 0)) {

                    if ($ingredient[$i] != null && $ingredient_unit[$i] != null) {
                        try {
                            $ing = ingredient::getAll('name = ?', [$ingredient[$i]]);
                        } catch (\Exception) {
                            return false; //in case some error occurs while fetching data from database
                        }

                        try {
                            $unit = unit::getAll('shortcut = ?', [$ingredient_unit[$i]]);
                        } catch (\Exception) {
                            return false; //in case some error occurs while fetching data from database
                        }

                        //if there is such unit in database
                        if ($unit != null){

                            //in case that user added new ingredient, ingredient is added to DB
                            if ($ing == null) {
                                $new_ingredient = new ingredient(name: $ingredient[$i]);
                                try {
                                    $new_ingredient->save();
                                } catch (\Exception) {
                                    return false; //in case some error occurs during sending data to database
                                }
                            }

                        }else{
                            return false; //if there is no unit with such name, it means recipe cannot be added
                        }

                    }
                } else { //in case that quantity of ingredient is below zero, process is failure
                    return false;
                }
            }else{ //in case that ingredient doesn't have its quantity set
                return false;
            }

        }

        return true;
    }

    public static function getIngredientsListInRecipe(int $id)
    {
        $rows = list_of_ingredients::getAll('recipe_id = ?', [$id]);
        $output = "";

        foreach ($rows as $row){
            $ingredientQuantity = $row->getQuantity();

            $ingredient = ingredient::getOne($row->getIngredientId());
            $ingredientName = $ingredient->getName();

            //in case that no unit is used
            if ($row->getUnitId() == 1){
                if ($ingredientQuantity == 0 || $ingredientQuantity == 1){
                    $output = $output . "&#9-&#9" . $ingredientName ."<br>";
                }else{
                    $output = $output . "&#9-&#9<b>" . $ingredientQuantity .
                         "</b>&#9" . $ingredientName . "<br>";
                }
            }else{
                $ingredientUnit = unit::getOne($row->getUnitId());
                $ingredientUnitName = $ingredientUnit->getShortcut();

                $output = $output . "&#9-&#9<b>" . $ingredientQuantity . " " .
                    $ingredientUnitName . "</b>&#9" . $ingredientName ."<br>";
            }

        }

        return $output;
    }
}