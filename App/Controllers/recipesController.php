<?php

namespace App\Controllers;

use App\AccountHandler;
use App\Core\Responses\Response;
use App\Deleter;
use App\FormatChecker;
use App\Models\country;
use App\Models\recipe;
use App\RecipesHandler;
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
            $ingredientsNames = RecipesHandler::getAllIngredientsNames();
            $unitShortcuts = RecipesHandler::getAllUnitsShortcuts();
            $countriesNames = RecipesHandler::getAllCountriesNames();

            return $this->html(
                [   'ingredientsList' => $ingredientsNames,
                    'unitsList' => $unitShortcuts,
                    'countriesList' => $countriesNames]
            );
        }else{
            $this->redirect('fail', 'permissionDenied');
        }

    }

    public function addRecipe()
    {
        if (RecipesHandler::addRecipe($this->request())){

        };

        $this->redirect('home', 'index');
    }

    public function deleteRecipe()
    {
        if(Deleter::deleteRecipe(intval($this->request()->getValue('which')))){
            $this->redirect('home', 'index',
                [ 'success_message' => 'Recept bol úspešne vymazaný']
            );
        }else{

        }
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

        if (FormatChecker::checkSearchingBarInput($this->request()->getValue('title'))){
            $recipes = SearchManager::findRecipesByTitle($this->request()->getValue('title'));
            return $this->html(
                [ 'recipes' => $recipes,
                    'countries' => RecipesHandler::getCountriesForRecipesAsMap($recipes) ] );
        }else{
            $this->redirect('home', 'index');
        }

    }
}