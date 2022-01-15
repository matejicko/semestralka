<?php

namespace App;

use App\Models\recipe;
use Exception;

class SearchManager
{
    /**
     * @throws Exception
     */
    public static function findRecipesByTitle($title): ?array
    {
        try{
            if (FormatChecker::checkSearchingBarInput($title)){
                $formatted = '%' . $title . '%';
                return recipe::getAll('title LIKE ?', [$formatted]);
            }else{
                return null;
            }
        }catch(Exception){
            throw new Exception('Error while fetching from DB');
        }

    }
}