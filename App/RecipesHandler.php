<?php

namespace App;

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

    public static function addRecipe(Core\Request $request)
    {
        //----------------------------------FETCHING INPUT FROM REQUEST----------------------------------
        //First segment of form - title and photo
        $title = $request->getValue('title');
        $photo = $request->getValue('photo');

        //Second segment of form - attributes of recipe
        $country_id = $request->getValue('country');
        $duration_value = $request->getValue('duration_value');
        $duration_unit = $request->getValue('duration_unit');
        $portion = $request->getValue('portion');

        //Third segment of form - ingredients
        $i = 1;
        while (1) {
            $ingredient_value[$i] = $request->getValue('ingredient_value_' . $i);
            $ingredient_unit[$i] = $request->getValue('ingredient_unit_' . $i);
            $ingredient[$i] = $request->getValue('ingredient_' . $i);

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
        $about = $request->getValue('process');

        //----------------------------------CONTROL DATA FORMAT----------------------------------

        //duration format control
        if (FormatChecker::checkNonNullityAndNonEmptiness($duration_value) &&
            FormatChecker::checkNonNullityAndNonEmptiness($duration_unit) &&
            intval($duration_value) > 0){

            $duration = $duration_value . " " . $duration_unit;
        }else{
            return false;
        }

        //this function controls if ingredients input is correct and if needed, new ingredient is added to database
        if (self::controlIngredientsInput($ingredient_value, $ingredient_unit, $ingredient)){

        }

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
        try {
            $to_find_greatest_id = ingredient::getAll();
            $greatest_id = $to_find_greatest_id[count($to_find_greatest_id) - 1]->getId();
        } catch (\Exception) {
            return false; //in case some error occurs while fetching data from database
        }


        for ($i = 0; $i < count($ingredient) - 1; $i++) {

            if ($ingredient_value[$i] != null) {

                //quantity of ingredient has to be greater than 0
                if (intval($ingredient_value[$i] > 0)) {

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
                                $greatest_id++;
                                $new_ingredient = new ingredient(id: $greatest_id, name: $ingredient[$i]);
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
            }

        }

        return true;
    }
}