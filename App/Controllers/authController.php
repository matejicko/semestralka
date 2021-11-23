<?php

namespace App\Controllers;

use App\Authentification;
use App\Core\Responses\Response;

class authController extends \App\Controllers\AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        return $this->html();
    }

    public function loginForm()
    {
        return $this->html(['error' => $this->request()->getValue('error')]);
    }

    public function login()
    {
        $mail = $this->request()->getValue('email');
        $password = $this->request()->getValue('password');

        if(Authentification::verifyAndLogIn($mail, $password)){
            $this->redirect('home');
        }else{
            $this->redirect('auth', 'loginForm',
                ['error' => 'Užívateľské meno alebo heslo nie je správne!']);
        }

    }

    public function logout()
    {
        Authentification::logOut();
        $this->redirect('home');
    }

    public function registration()
    {
        $username = $this->request()->getValue('username');
        $name = $this->request()->getValue('name');
        $surname = $this->request()->getValue('surname');
        $mail = $this->request()->getValue('mail');
        $photo = $this->request()->getValue('photo');
        $password = $this->request()->getValue('password');
        $checkPassword = $this->request()->getValue('password');

        if (Authentification::register($username, $name, $surname, $mail, $photo, $password)){
            $this->redirect('home');
        }else{
            $this->redirect('auth', 'registrationForm',
                ['error' => 'Nepodarilo sa zaregistrovať!']);
        }

    }

    public function registrationForm()
    {
        return $this->html(['error' => $this->request()->getValue('error')]);
    }



}