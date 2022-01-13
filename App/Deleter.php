<?php

namespace App;

use App\Models\list_of_ingredients;
use App\Models\recipe;
use App\Models\user;

class Deleter
{

    /*Safely (with all his/her recipes) delete user carrying ID entered to this function
     *
     */
    public static function deleteUser($user_id)
    {
        $user = user::getOne($user_id);

        //if there is user with such ID
        if (isset($user)){
            //delete all recipes belonged to this user first
            $recipes = recipe::getAll('user_id = ?', [$user_id]);

            if (isset($recipes)){
                foreach($recipes as $recipe){
                    self::deleteRecipe($recipe->getId());
                }
            }

            //after that, user deletion
            $user->delete();
            return true;
        }else{
            //it is impossible to delete non-existing user
            return false;
        }
    }

    /* Safely (with all its belongings) delete recipe with ID passed as input parameter
     *
     */
    public static function deleteRecipe($recipe_id)
    {
        $recipe = recipe::getOne($recipe_id);

        //if there is recipe with such ID
        if (isset($recipe)){
            //all connections between recipe and its ingredients has to be deleted first
            self::deleteIngredientsAssociatedToRecipe($recipe_id);

            //after that, recipe deletion is performed
            $recipe->delete();
            return true;
        }else{
            return false;
        }
    }

    /* Safely delete all associated ingredients with recipe, which ID is input parameter
    *
    */
    private static function deleteIngredientsAssociatedToRecipe($recipe_id){
        $associations = list_of_ingredients::getAll('recipe_id = ?', [$recipe_id]);

        if (isset($associations)){
            foreach ($associations as $association){
                $association->delete();
            }
        }
    }


}