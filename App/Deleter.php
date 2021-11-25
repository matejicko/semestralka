<?php

namespace App;

use App\Models\list_of_ingredients;
use App\Models\recipe;
use App\Models\user;

class Deleter
{
    public static function deleteUser($user_id)
    {
        $user = user::getOne($user_id);

        //najprv treba zistit, ci sa vobec nachadza uzivatel s danym id
        if (isset($user)){
            //najprv sa vymazu vsetky recepty daneho pouzivatela
            $recipes = recipe::getAll('user_id = '.$user_id);

            if (isset($recipes)){
                foreach($recipes as $recipe){
                    self::deleteRecipe($recipe->getId());
                }
            }

            //potom sa vymaze samotny pouzivatel
            $user->delete();
            return true;
        }else{
            //nepodarilo sa vymazat uzivatela, kedze sa nenachadza v DB
            return false;
        }
    }

    public static function deleteRecipe($recipe_id)
    {
        $recipe = recipe::getOne($recipe_id);

        //najprv treba zistit ci sa dany recept nachadza v DB
        if (isset($recipe)){
            //prve sa zmazu vsetky ingrediencie patriace receptu
            self::deleteIngredientsAssociatedToRecipe($recipe_id);

            //potom sa vymaze zaznam z tabulky recipe, t.j cely recept
            $recipe->delete();
            return true;
        }else{
            return false;
        }
    }

    private static function deleteIngredientsAssociatedToRecipe($recipe_id){
        $associations = list_of_ingredients::getAll('recipe_id = '.$recipe_id);

        if (isset($associations)){
            foreach ($associations as $association){
                $association->delete();
            }
        }
    }


}