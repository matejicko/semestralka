<?php

namespace App\Controllers;

use App\AccountHandler;
use App\Authentification;
use App\Core\Responses\Response;
use App\Deleter;
use App\Models\user;
use App\RecipesHandler;

class accountController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
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
            $this->redirect('fail', 'userData');
        }
    }

    public function deleteAccount(){
        $user = AccountHandler::getLoggedUser();

        if (isset($user)){
            //najprv treba odhlasit uzivatela
            Authentification::logOut();

            if (Deleter::deleteUser($user->getId())){
                $this->redirect('home', 'index');
            }else{
                $this->redirect('account');
            }
        }else{
            $this->redirect('fail', 'permissionDenied');
        }
    }

    public function settingsForm()
    {
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
            $this->redirect('fail', 'userData');
        }
    }

    public function edit()
    {
        if (AccountHandler::editAccount($this->request())){
            $this->redirect('account');
        }else{
            $this->redirect('account', 'settingsForm',
                ['error' => 'Nepodarilo sa nám zmeniť údaje na vašom profile :('] );
        }
    }

    public function showMyRecipes(){
        $user = AccountHandler::getLoggedUser();
        $recepty = RecipesHandler::getRecipesForUser($user->getId());
        return $this->html(['recipes' => $recepty]);
    }
}