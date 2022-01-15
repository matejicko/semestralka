<?php

namespace App;

use App\Config\Configuration;
use App\Models\country;
use App\Models\ingredient;
use App\Models\list_of_ingredients;
use App\Models\recipe;
use App\Models\unit;
use Exception;

class RecipesHandler
{
    /**
     * @throws Exception
     */
    public static function getRecipesForUser($user_id): array
    {
        try{
            return recipe::getAll('user_id = ?', [$user_id]);
        }catch(Exception){
            throw new Exception('Error while fetching from DB');
        }

    }

    /**
     * @throws Exception
     */
    public static function getAllIngredientsNames(): array
    {
        try{
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
        }catch(Exception){
            throw new Exception('Error while fetching from DB');
        }

    }

    /**
     * @throws Exception
     */
    public static function getAllUnitsShortcuts(): array
    {
        try{
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
        }catch(Exception){
            throw new Exception('Error while fetching from DB');
        }

    }

    /**
     * @throws Exception
     */
    public static function getAllCountriesNames(): array
    {
        try{
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
        }catch(Exception){
            throw new Exception('Error while fetching from DB');
        }

    }

    /**
     * @throws Exception
     */
    public static function getCountriesForRecipesAsMap(array $recipes): array
    {
        try{
            $mapOfCountries = [];

            foreach ($recipes as $recipe) {
                $mapOfCountries[$recipe->getCountryId()] = country::getOne($recipe->getCountryId());
            }

            return $mapOfCountries;

        }catch(Exception){
            throw new Exception('Error while fetching from DB');
        }

    }

    public static function addRecipe(Core\Request $request, $picture): bool
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
            }else{
                if (!FormatChecker::checkPlainText($ingredient[$i]) ||
                    !FormatChecker::checkPlainText($ingredient_unit[$i])){
                    return false;
                }
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
        if (!self::changeTitleToRecipe($recipe, $title, false)){
            return false;
        }

        //recipe image input control
        try{ //try to find ID for recipe, that will be added
            $recipes = recipe::getAll();
            if (isset($recipes)){
                $recipeId = $recipes[count($recipes) - 1]->getId() + 1;
            }else{
                $recipeId = 1;
            }
        }catch(Exception){
            return false;
        }

        if (isset($picture)) {
            if ($picture["error"] == UPLOAD_ERR_OK) {
                $nameImg =  $title . "_RECIPE_" . $recipeId . "_" . $picture['name'];
                $via = Configuration::UPLOAD_DIR_RECIPE_PHOTO . "$nameImg";
                move_uploaded_file($picture['tmp_name'], $via);

                $recipe->setImage($via);
            }else{
                return false;
            }
        }else{
            return false;
        }

        //controls if country exists in DB
        if (!self::changeCountryToRecipe($recipe, $country, false)){
            return false;
        }

        //duration format control
        if (!self::changeDurationToRecipe($recipe, $duration_value, $duration_unit, false)){
            return false;
        }

        //portions control
        if (!self::changePortionsToRecipe($recipe, $portion, false)){
            return false;
        }

        //process field is mandatory
        if (!self::changeProcessToRecipe($recipe, $process, false)){
            return false;
        }

        //about field is optional
        if (FormatChecker::checkNonNullityAndNonEmptiness($about)){

            //if there is about section, it has to follow some rules, otherwise recipe won't be added
            if (!self::changeAboutToRecipe($recipe, $about, false)){
                return false;
            }
        }

        //this function controls if ingredients input is correct and if needed, new ingredient is added to database
        if (!self::controlIngredientsInput($ingredient_value, $ingredient_unit, $ingredient)){
            return false;
        }

        //to add recipe, some user has to be logged in
        try{
            $loggedUser = AccountHandler::getLoggedUser();
            if ($loggedUser == null){
                return false;
            }else{
                $recipe->setUserId($loggedUser->getId());
            }
        }catch(Exception){
            return false;
        }

        //----------------------------------FINALIZATION----------------------------------
        //now when whole input is controlled, we can save recipe and transfer it to the database
        try{
            $recipe->save();
        }catch(Exception){
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

                }catch(Exception){
                    try{ //try to delete yet saved recipe with all yet saved associations
                        $recipes = recipe::getAll();
                        if (isset($recipes)){
                            $recipeId = $recipes[count($recipes) - 1]->getId();
                        }

                        Deleter::deleteIngredientsAssociatedToRecipe($recipeId);

                        $recipe->setId($recipeId);
                        $recipe->delete();
                    }catch(Exception){
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
     * @return bool - return whether ingredients input is correct or not
     */
    private static function controlIngredientsInput(array $ingredient_value, array $ingredient_unit, array $ingredient): bool
    {

        for ($i = 0; $i < count($ingredient) - 1; $i++) {

            if ($ingredient_value[$i] != null){

                //quantity of ingredient has to be greater than 0
                if (floatval($ingredient_value[$i] >= 0)) {

                    if ($ingredient[$i] != null && $ingredient_unit[$i] != null) {
                        try {
                            $ing = ingredient::getAll('name = ?', [$ingredient[$i]]);
                        } catch (Exception) {
                            return false; //in case some error occurs while fetching data from database
                        }

                        try {
                            $unit = unit::getAll('shortcut = ?', [$ingredient_unit[$i]]);
                        } catch (Exception) {
                            return false; //in case some error occurs while fetching data from database
                        }

                        //if there is such unit in database
                        if ($unit != null){

                            //in case that user added new ingredient, ingredient is added to DB
                            if ($ing == null) {
                                $new_ingredient = new ingredient(name: $ingredient[$i]);
                                try {
                                    $new_ingredient->save();
                                } catch (Exception) {
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

    /**
     * @throws Exception
     */
    public static function getIngredientsListInRecipe(int $id): string
    {
        try{
            $rows = list_of_ingredients::getAll('recipe_id = ?', [$id]);
            $output = "";

            foreach ($rows as $row){
                $ingredientQuantity = $row->getQuantity();

                $ingredient = ingredient::getOne($row->getIngredientId());
                $ingredientName = $ingredient->getName();

                //in case that no unit is used
                if ($row->getUnitId() == 1){
                    if ($ingredientQuantity == 0 || $ingredientQuantity == 1){
                        $output = $output . "&#9;-&#9;" . $ingredientName ."<br>";
                    }else{
                        $output = $output . "&#9;-&#9;<b>" . $ingredientQuantity .
                            "</b>&#9;" . $ingredientName . "<br>";
                    }
                }else{
                    $ingredientUnit = unit::getOne($row->getUnitId());
                    $ingredientUnitName = $ingredientUnit->getShortcut();

                    $output = $output . "&#9;-&#9;<b>" . $ingredientQuantity . " " .
                        $ingredientUnitName . "</b>&#9;" . $ingredientName ."<br>";
                }

            }

            return $output;
        }catch(Exception){
            throw new Exception('Error while fetching from DB');
        }

    }

    public static function changeTitleToRecipe(recipe $recipe, mixed $newTitle, bool $sendToDB): bool
    {
        if (!FormatChecker::checkPlainText($newTitle) || strlen($newTitle) > 64){
            return false;
        }else{
            $recipe->setTitle($newTitle);

            if ($sendToDB){
                try{
                    $recipe->save();
                }catch(Exception){
                    return false;
                }
            }
        }

        return true;
    }

    public static function changeDurationToRecipe(recipe $recipe, mixed $newValue, mixed $newUnit, bool $sendToDB): bool
    {
        if (FormatChecker::checkNonNullityAndNonEmptiness($newValue) &&
            FormatChecker::checkPlainText($newUnit)){

            if (floatval($newValue) > 0){
                $duration = $newValue . " " . $newUnit;
                $recipe->setDuration($duration);

                if ($sendToDB){
                    try{
                        $recipe->save();
                    }catch(Exception){
                        return false;
                    }
                }
                return true;
            }
        }

        return false;
    }

    public static function changePortionsToRecipe(recipe $recipe, mixed $newPortions, bool $sendToDB): bool
    {
        if (FormatChecker::checkNonNullityAndNonEmptiness($newPortions)){
            if (intval($newPortions) > 0){
                $recipe->setPortions(intval($newPortions));

                if ($sendToDB){
                    try{
                        $recipe->save();
                    }catch(Exception){
                        return false;
                    }
                }

                return true;
            }else{
                return false; //number of portions has to be positive number
            }
        }

        return false;
    }

    public static function changeCountryToRecipe(recipe $recipe, mixed $newCountry, bool $sendToDB): bool
    {
        try{
            $countryCheck = country::getAll('name = ?', [$newCountry]);

            if (!isset($countryCheck[0])){

                return false;

            }else{
                $recipe->setCountryId($countryCheck[0]->getId());

                if ($sendToDB){
                    $recipe->save();
                }

                return true;
            }
        }catch(Exception){
            return false;
        }

    }

    public static function changeProcessToRecipe(recipe $recipe, mixed $newProcess, bool $sendToDB): bool
    {
        if (!FormatChecker::checkPlainText($newProcess)){
            return false;
        }else{
            $recipe->setProcess($newProcess);

            if ($sendToDB){
                try{
                    $recipe->save();
                }catch(Exception){
                    return false;
                }
            }

            return true;
        }

    }

    public static function changeAboutToRecipe(recipe $recipe, mixed $newAbout, bool $sendToDB): bool
    {
        if (FormatChecker::checkPlainText($newAbout)){
            $recipe->setAbout($newAbout);

            if ($sendToDB){
                try{
                    $recipe->save();
                }catch(Exception){
                    return false;
                }
            }

            return true;

        }else{
            return false;
        }
    }
}