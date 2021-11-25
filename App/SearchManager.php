<?php

namespace App;

use App\Models\recipe;

class SearchManager
{
    public static function findRecipesByTitle($title)
    {
        if ($title != null && $title != ''){
            return recipe::getAll('title LIKE "%'.$title.'%"');
        }
    }
}