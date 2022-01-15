<?php

namespace App\Controllers;

use App\AccountHandler;
use App\Core\Responses\Response;
use App\Deleter;
use App\FormatChecker;
use App\Models\country;
use App\Models\ingredient;
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
        if (RecipesHandler::addRecipe($this->request(), $_FILES['photo'])){
            $this->redirect('home', 'index',
                [ 'success_message' => 'Recept bol úspešne pridaný']);
        }else{
            $this->redirect('recipes', 'addRecipeForm',
                ['error' => 'Recept sa nepodarilo pridať. Skontroluj správnosť všetkých vstupov...']);
        }
    }

    public function deleteRecipe()
    {
        if(Deleter::deleteRecipe(intval($this->request()->getValue('which')))){
            return $this->json('true');
        }else{
            return $this->json('false');
        }
    }

    public function editRecipeForm()
    {
        $ingredientsNames = RecipesHandler::getAllIngredientsNames();
        $unitShortcuts = RecipesHandler::getAllUnitsShortcuts();
        $countriesNames = RecipesHandler::getAllCountriesNames();

        $recipe = recipe::getOne($this->request()->getValue('id'));

        return $this->html(
            ['recipe' => $recipe,
                'ingredientsList' => $ingredientsNames,
                'unitsList' => $unitShortcuts,
                'countriesList' => $countriesNames]);
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
            'country' => $country,
            'ingredients_list' => RecipesHandler::getIngredientsListInRecipe($id)
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

    public function changeTitle(): \App\Core\Responses\JsonResponse{
        try{
            $newTitle = $this->request()->getValue('title');
            $recipe = recipe::getOne($this->request()->getValue('id'));

            if (isset($recipe)){
                if (RecipesHandler::changeTitleToRecipe($recipe, $newTitle, true)){
                    return $this->json('true');
                }
            }
        }catch(\Exception){
        }

        return $this->json('false');
    }

    public function changeCountry(): \App\Core\Responses\JsonResponse{
        try{
            $newCountry = $this->request()->getValue('country');
            $recipe = recipe::getOne($this->request()->getValue('id'));

            if (isset($recipe)){
                if (RecipesHandler::changeCountryToRecipe($recipe, $newCountry, true)){
                    return $this->json('true');
                }
            }
        }catch(\Exception){
        }

        return $this->json('false');
    }

    public function changeDuration(): \App\Core\Responses\JsonResponse{
        try{
            $newValue = $this->request()->getValue('value');
            $newUnit = $this->request()->getValue('unit');
            $recipe = recipe::getOne($this->request()->getValue('id'));

            if (isset($recipe)){
                if (RecipesHandler::changeDurationToRecipe($recipe, $newValue, $newUnit, true)){
                    return $this->json('true');
                }
            }
        }catch(\Exception){
        }

        return $this->json('false');
    }

    public function changePortions(): \App\Core\Responses\JsonResponse
    {
        try{
            $newPortions = $this->request()->getValue('portions');
            $recipe = recipe::getOne($this->request()->getValue('id'));

            if (isset($recipe)){
                if (RecipesHandler::changePortionsToRecipe($recipe, $newPortions, true)){
                    return $this->json('true');
                }
            }
        }catch(\Exception){
        }

        return $this->json('false');
    }

    public function changeProcess(): \App\Core\Responses\JsonResponse
    {
        try{
            $newProcess = $this->request()->getValue('process');
            $recipe = recipe::getOne($this->request()->getValue('id'));

            if (isset($recipe)){
                if (RecipesHandler::changeProcessToRecipe($recipe, $newProcess, true)){
                    return $this->json('true');
                }
            }
        }catch(\Exception){
        }

        return $this->json('false');
    }

    public function changeAbout(): \App\Core\Responses\JsonResponse
    {
        try{
            $newAbout = $this->request()->getValue('about');
            $recipe = recipe::getOne($this->request()->getValue('id'));

            if (isset($recipe)){
                if (RecipesHandler::changeAboutToRecipe($recipe, $newAbout, true)){
                    return $this->json('true');
                }
            }
        }catch(\Exception){
        }

        return $this->json('false');
    }


}