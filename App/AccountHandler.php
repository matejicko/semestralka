<?php

namespace App;

use App\Models\user;

class AccountHandler
{
    public static function getLoggedUser()
    {
        $users = user::getAll('mail = ?', [$_SESSION['name']]);
        if ($users != null){
            return $users[0];
        }else{
            return null;
        }
    }

    public static function deleteAccount()
    {
        $user = self::getLoggedUser();
        if ($user != null){
            //all recipes belonging to such account has to be deleted at first
            //it means that all recipe-ingredient connections has to be removed from list_of_ingredients
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

        $checkUsers = user::getAll('id <> ? AND (username = ? OR mail = ?)', [$loggedUser->getId(), $newUsername, $newMail]);

        //in case that DB contains user(s) with same name or mail (which are unique identificators)
        if ($checkUsers != null){
            $checkUser = $checkUsers[0];
            if ($newUsername == $checkUser->getUsername() ||
                    $newMail == $checkUser->getMail()){
                return false;
            }
        }

        //if new username is not null or empty, then username change will be performed
        if (FormatChecker::checkUsername($newUsername) &&
            strcmp($loggedUser->getUsername(), $newUsername) != 0){ //in case that new username is different than present

            $loggedUser->setUsername($newUsername);
        }else{
            return false;
        }

        //if new name is not null or empty, then name change will be performed
        if (FormatChecker::checkUsername($newName) &&
            strcmp($loggedUser->getName(), $newName) != 0){

            $loggedUser->setName($newName);
        }else{
            return false;
        }

        //if new surname is not null or empty, then surname change will be performed
        if (FormatChecker::checkSurname($newSurname) &&
            strcmp($loggedUser->getSurname(), $newSurname) != 0){

            $loggedUser->setSurname($newSurname);

        }else{
            return false;
        }

        //if new mail is not null or empty, then mail change will be performed
        if (FormatChecker::checkUsername($newMail) &&
            strcmp($loggedUser->getMail(), $newMail) != 0){

            $loggedUser->setMail($newMail);
            $_SESSION['name'] = $newMail;
        }else{
            return false;
        }

        //at the end changes will be saved in DB
        $loggedUser->save();
        return true;

    }

}