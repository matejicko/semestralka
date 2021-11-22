<?php

namespace App\Controllers;

use App\AccountHandler;
use App\Core\Responses\Response;
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
        AccountHandler::deleteAccount();
    }

    public function settingsForm()
    {
        return $this->html();
    }

    public function showMyRecipes(){
        $user = AccountHandler::getLoggedUser();
        $recepty = RecipesHandler::getRecipesForUser($user->getId());
        return $this->html(['recipes' => $recepty]);
    }
}