<?php

namespace App;

use App\Models\country;
use App\Models\ingredient;
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

        foreach ($recipes as $recipe){
            $mapOfCountries[$recipe->getCountryId()] = country::getOne($recipe->getCountryId());
        }

        return $mapOfCountries;
    }
}