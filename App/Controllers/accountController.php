<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Models\user;

class accountController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        $users = user::getAll('mail="'.$_SESSION['name'].'"');
        if ($users != null){
            $user = $users[0];

            return $this->html([
                'user' => $user
            ]);
        }
    }

    public function settingsForm()
    {

    }

    public function showMyRecipes(){

    }
}