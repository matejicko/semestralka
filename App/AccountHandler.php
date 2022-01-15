<?php

namespace App;

use App\Config\Configuration;
use App\Models\user;
use Exception;

class AccountHandler
{
    /**
     * @throws Exception
     */
    public static function getLoggedUser(): ?user
    {
        try{
            $users = user::getAll('mail = ?', [$_SESSION['name']]);
            if ($users != null){
                return $users[0];
            }else{
                return null;
            }
        }catch(Exception){
            throw new Exception('Error while fetching from DB');
        }

    }

    /**
     * @throws Exception
     */
    public static function editAccount(Core\Request $request): bool
    {
        try{
            $loggedUser = self::getLoggedUser();
        }catch(Exception){
            return false;
        }

        $newUsername = $request->getValue('username');
        $newName = $request->getValue('name');
        $newSurname = $request->getValue('surname');
        $newMail = $request->getValue('mail');

        $newPassword = $request->getValue('new_password');
        $newPasswordCheck = $request->getValue('new_password_check');

        $password = $request->getValue('password');

        try{
            $checkUsers = user::getAll('id <> ? AND (username = ? OR mail = ?)', [$loggedUser->getId(), $newUsername, $newMail]);
        }catch(Exception){
            return false;
        }

        //in case that DB contains user(s) with same name or mail (which are unique identificators)
        if ($checkUsers != null){
            $checkUser = $checkUsers[0];
            if ($newUsername == $checkUser->getUsername() ||
                    $newMail == $checkUser->getMail()){
                return false;
            }
        }

        //if entered password doesn't match logged user's
        if (!password_verify($password, $loggedUser->getPassword())){
            return false;
        }

        //if new username is not null or empty, then username change will be performed
        if (FormatChecker::checkUsername($newUsername)){

            //in case that new username is different from present, it is necessary to change
            if (strcmp($loggedUser->getUsername(), $newUsername) != 0){
                $loggedUser->setUsername($newUsername);
            } //otherwise, it is not necessary to rewrite to same expression

        }else{
            return false;
        }

        //if new name is not null or empty, then name change will be performed
        if (FormatChecker::checkName($newName)){

            if (strcmp($loggedUser->getName(), $newName) != 0) {
                $loggedUser->setName($newName);
            }

        }else{
            return false;
        }

        //if new surname is not null or empty, then surname change will be performed
        if (FormatChecker::checkSurname($newSurname) ){

            if (strcmp($loggedUser->getSurname(), $newSurname) != 0) {
                $loggedUser->setSurname($newSurname);
            }
        }else{
            return false;
        }

        //if new mail is not null or empty, then mail change will be performed
        if (FormatChecker::checkEmail($newMail)){

            if (strcmp($loggedUser->getMail(), $newMail) != 0) {
                $loggedUser->setMail($newMail);
                $_SESSION['name'] = $newMail;
            }

        }else{
            return false;
        }

        //if new password is offered
        if (FormatChecker::checkNonNullityAndNonEmptiness($newPassword)){
            if (FormatChecker::checkPassword($newPassword) &&
                strcmp($newPassword, $newPasswordCheck) == 0){

                if (strcmp($password, $newPassword) != 0){
                    $loggedUser->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));
                }

            }else{
                return false;
            }
        }

        //if user is willing to change his profile picture
        if (isset($_FILES['photo'])) {
            if ($_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
                $nameImg =  $loggedUser->getUsername() . "_PROFILE_" . $_FILES['photo']['name'];
                $via = Configuration::UPLOAD_DIR_PROFILE_PHOTO . "$nameImg";

                if (file_exists($loggedUser->getPhoto()))
                {
                    unlink($loggedUser->getPhoto()); //delete current profile photo
                }

                move_uploaded_file($_FILES['photo']['tmp_name'], $via); //upload new photo
                $loggedUser->setPhoto($via);
            }
        }

        //at the end changes will be saved in DB
        try{
            $loggedUser->save();
        }catch(Exception){
            return false;
        }

        return true;

    }

}