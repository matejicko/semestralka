<?php

namespace App\Controllers;

use App\AccountHandler;
use App\Core\Responses\Response;
use App\Models\country;
use App\Models\recipe;
use App\SearchManager;

class recipesController extends \App\Controllers\AControllerRedirect
{
    /**
     * @inheritDoc
     */
    public function index()
    {
        return $this->html(
            [ 'nazov' => 'Pizza'
        ]);
    }

    public function addRecipeForm()
    {
        if (AccountHandler::getLoggedUser() != null){
            return $this->html();
        }else{
            $this->redirect('fail', 'permissionDenied');
        }

    }

    public function addRecipe()
    {
        return $this->html();
    }

    public function deleteRecipe()
    {
        return $this->html();
    }

    public function editRecipe()
    {
        return $this->html();
    }

    public function showRecipe()
    {
        $id = intval($this->request()->getGet()['id']);
        $recipe = recipe::getOne($id);
        $country = country::getOne($recipe->getCountryId());
        return $this->html( [
            'recipe' => $recipe,
            'country' => $country
        ]);
    }

    public function findRecipe(){
        return $this->html(
            [ 'recipes' => SearchManager::findRecipesByTitle($this->request()->getValue('title'))]);
    }
}