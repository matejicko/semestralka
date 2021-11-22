<?php

namespace App;

use App\Models\recipe;

class RecipesHandler
{
    public static function getRecipesForUser($user_id)
    {
        return recipe::getAll('user_id = "'.$user_id.'"');
    }
}