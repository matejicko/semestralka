<?php

namespace App\Controllers;

use App\AccountHandler;
use App\Authentification;
use App\Core\Responses\Response;
use App\Deleter;
use App\Models\country;
use App\Models\user;
use App\RecipesHandler;

class accountController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        try{
            $user = AccountHandler::getLoggedUser();

            if ($user != null){
                return $this->html([
                    'username' => $user->getUsername(),
                    'name' => $user->getName(),
                    'surname' => $user->getSurname(),
                    'mail' => $user->getMail(),
                    'photo' => $user->getPhoto()
                ]);
            }else{
                $this->redirect('fail', 'index',
                    ['error' => 'Na túto akciu musíš byť prihlásený!']);
            }
        }catch(\Exception){
            $this->redirect('fail', 'index',
                ['error' => 'Na túto akciu musíš byť prihlásený!']);
        }

    }

    public function deleteAccount(){
        try{
            $user = AccountHandler::getLoggedUser();

            if (isset($user)){
                //firstly, logged user has to be logged out
                Authentification::logOut();

                if (Deleter::deleteUser($user->getId())){
                    $this->redirect('home', 'index',
                        [ 'success_message' => 'Tvoj účet bol úspešne odstránený!']);
                }else{
                    $this->redirect('account');
                }
            }else{
                $this->redirect('fail', 'index',
                    ['error' => 'Na túto akciu musíš byť prihlásený!']);
            }
        }catch(\Exception){
            $this->redirect('fail', 'index',
                ['error' => 'Na túto akciu musíš byť prihlásený!']);
        }

    }

    public function settingsForm()
    {
        try{
            $user = AccountHandler::getLoggedUser();
            if ($user != null){
                return $this->html([
                    'username' => $user->getUsername(),
                    'name' => $user->getName(),
                    'surname' => $user->getSurname(),
                    'mail' => $user->getMail(),
                    'photo' => $user->getPhoto(),
                    'error' => $this->request()->getValue('error')
                ]);
            }else{
                $this->redirect('fail', 'index',
                    ['error' => 'Na túto akciu musíš byť prihlásený!']);
            }
        }catch(\Exception){
            $this->redirect('fail', 'index',
                ['error' => 'Na túto akciu musíš byť prihlásený!']);
        }

    }

    public function edit()
    {
        try{
            if (AccountHandler::editAccount($this->request())){
                $this->redirect('home', 'index',
                    [ 'success_message' => 'Zmeny boli úspešne nahraté!' ]);
            }else{
                $this->redirect('account', 'settingsForm',
                    [ 'error' => 'Nepodarilo sa nám zmeniť údaje na vašom profile. Pravdepodobne už evidujeme konto s vašou novou prezývkou alebo e-mailom...' ]);
            }
        }catch(\Exception){
            $this->redirect('fail', 'index',
                ['error' => 'Nastala neočakávaná chyba :(']);
        }

    }

    public function showMyRecipes(){
        try{
            $user = AccountHandler::getLoggedUser();
            $recipes = RecipesHandler::getRecipesForUser($user->getId());
            $countries = RecipesHandler::getCountriesForRecipesAsMap($recipes);
            return $this->html(
                [ 'recipes' => $recipes,
                    'countries' => $countries ]);
        }catch(\Exception){
            $this->redirect('fail', 'index',
                ['error' => 'Nastala neočakávaná chyba :(']);
        }

    }
}