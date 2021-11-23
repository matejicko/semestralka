<?php

namespace App\Controllers;

use App\Core\Responses\Response;
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
        return $this->html();
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
        return $this->html();
    }

    public function findRecipe(){
        return $this->html(
            [ 'recipes' => SearchManager::findRecipesByTitle($this->request()->getValue('title'))]);
    }
}