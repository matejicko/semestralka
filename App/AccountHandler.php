<?php

namespace App;

use App\Models\user;

class AccountHandler
{
    public static function getLoggedUser()
    {
        $users = user::getAll('mail="'.$_SESSION['name'].'"');
        if ($users != null){
            $user = $users[0];
            return $user;
        }else{
            return null;
        }
    }

    public static function deleteAccount()
    {
        $user = self::getLoggedUser();
        if ($user != null){
            //najprv musim zmazat vsetky recepty pre dany ucet
            //co si vyzaduje vymazat vsetky ingrediencie pripadajuce tomuto receptu
            //
        }else{
            return false;
        }
    }

    public static function editAccount(Core\Request $request)
    {
        $loggedUser = self::getLoggedUser();

        $newUsername = $request->getValue('username');
        $newName = $request->getValue('name');
        $newSurname = $request->getValue('surname');
        $newMail = $request->getValue('mail');

        $checkUsers = user::getAll('id <>'.$loggedUser->getId().' AND (username = "'.$newUsername.'" OR mail="'.$newMail.'")');

        //ak by sa uz nachadzal v DB user s rovnakym usernameom alebo mailom (jedinecnymi identifikatormi)
        if ($checkUsers != null){
            $checkUser = $checkUsers[0];
            if ($newUsername == $checkUser->getUsername() ||
                    $newMail == $checkUser->getMail()){
                return false;
            }
        }

        //ak novy username nie je prazdny retazec, tak ho nastavim (unikatnost je riesena vyssie)
        if ($newUsername != ''){
            $loggedUser->setUsername($newUsername);
        }else{
            return false;
        }

        //ak nove meno nie je prazdny retazec, tak ho nastavim
        if ($newName != ''){
            $loggedUser->setName($newName);
        }else{
            return false;
        }

        //ak nove priezvisko nie je prazdny retazec, tak ho nastavim
        if ($newSurname != ''){
            $loggedUser->setSurname($newSurname);
        }else{
            return false;
        }

        //ak novy mail nie je prazdny retazec, tak ho nastavim
        if ($newMail != ''){
            $loggedUser->setMail($newMail);
            $_SESSION['name'] = $newMail;
        }else{
            return false;
        }

        //nakoniec ulozim zmeny prihlaseneho uzivatela aj v databaze a dam vediet, ze sa edit podaril
        $loggedUser->save();
        return true;

    }

}