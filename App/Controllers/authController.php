<?php

namespace App\Controllers;

use App\Authentification;
use App\Core\Responses\JsonResponse;
use App\Core\Responses\Response;
use App\Core\Responses\ViewResponse;

class authController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index(): ViewResponse|Response
    {
        return $this->html();
    }

    public function loginForm(): ViewResponse
    {
        return $this->html(['error' => $this->request()->getValue('error')]);
    }

    public function login()
    {
        $mail = $this->request()->getValue('email');
        $password = $this->request()->getValue('password');

        if(Authentification::verifyAndLogIn($mail, $password)){
            $this->redirect('home', 'index',
                [ 'success_message' => "Prihlásenie sa podarilo!"]);
        }else{
            $this->redirect('auth', 'loginForm',
                [ 'error' => 'Zadal si nesprávne meno alebo heslo!']);
        }
    }

    public function logout()
    {
        Authentification::logOut();
        $this->redirect('home', 'index',
            ['success_message' => 'Bol si úspešne odhlásený']);
    }

    public function registration()
    {
        if (Authentification::register($this->request())){
            Authentification::verifyAndLogIn($this->request()->getValue('mail'), $this->request()->getValue('password')); //after succesful registration it is convenient to remain logged in

            $this->redirect('home', 'index',
                ['success_message' => 'Registrácia prebehla úspešne :)']);
        }else{
            $this->redirect('auth', 'registrationForm',
                ['error' => 'Nepodarilo sa zaregistrovať! Pravdepodobne je tvoja prezývka už použitá, alebo k tomuto e-mailu už existuje konto.']);
        }

    }

    public function registrationForm(): ViewResponse
    {
        return $this->html(['error' => $this->request()->getValue('error')]);
    }

    public function isUniqueUsername(): JsonResponse
    {
        if (Authentification::isUniqueUsername($this->request()->getValue('username'))){
            return $this->json('true');
        }else{
            return $this->json('false');
        }
    }

    public function isUniqueMail(): JsonResponse
    {
        if (Authentification::isUniqueMail($this->request()->getValue('mail'))){
            return $this->json('true');
        }else{
            return $this->json('false');
        }
    }



}