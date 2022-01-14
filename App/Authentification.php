<?php

namespace App;

use App\Config\Configuration;
use App\Models\user;
use mysql_xdevapi\Exception;

class Authentification
{
    public static function verifyAndLogIn($email, $password)
    {

        //input has to fit exact format
        if (FormatChecker::checkEmail($email) &&
            FormatChecker::checkPassword($password)) {

            //try to fetch user from DB
            try{
                $user = user::getAll('mail = ?',  [$email]);
            }catch(Exception){
                return false;
            }

            //if user is flawlessly fetched from DB, which means that user really exists
            if ($user != null) {

                //if given password is same as in DB
                if (password_verify($password, $user[0]->getPassword())){

                    //last step is to set session mail to currently logged user
                    $_SESSION['name'] = $user[0]->getMail();
                    return true;
                }else {
                    return false;
                }

            } else {
                return false;
            }
        }
    }

    public static function isLogged()
    {
        return isset($_SESSION['name']);
    }

    public static function logOut()
    {
        unset($_SESSION['name']);
        session_destroy();
    }

    public static function register($request)
    {
        $username = $request->getValue('username');
        $name = $request->getValue('name');
        $surname = $request->getValue('surname');
        $mail = $request->getValue('mail');

        $password = $request->getValue('password');
        $checkPassword = $request->getValue('password');
        
        //input has to be in proper format and has to be not-null
        if (FormatChecker::checkUsername($username) &&
            FormatChecker::checkName($name) &&
            FormatChecker::checkSurname($surname) &&
            FormatChecker::checkEmail($mail) &&
            FormatChecker::checkPassword($password) &&
            strcmp($password, $checkPassword) == 0) { //confirmation password must fit password

            $id = 0;
            try{
                //check if there is already user with such username or mail
                $checkUser = user::getAll('username = ? OR mail = ?', [$username, $mail]);
                $allUsers = user::getAll();
                if (isset($allUsers)){
                    $id = $allUsers[count($allUsers) - 1]->getId();
                }
            }catch(\Exception){
                return false;
            }

            //if there is nobody with same username or mail, new account can be created
            if ($checkUser == null) {

                if (isset($_FILES['photo'])) {
                    if ($_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
                        $nameImg =  $username . "_PROFILE_" . $id . "_" . $_FILES['photo']['name'];
                        $via = Configuration::UPLOAD_DIR_PROFILE_PHOTO . "$nameImg";
                        move_uploaded_file($_FILES['photo']['tmp_name'], $via);
                    }
                }

                $newUser = new user(username: $username,
                    name: $name,
                    surname: $surname,
                    mail: $mail,
                    photo: $via,
                    password: password_hash($password, PASSWORD_DEFAULT));

                try{
                    $newUser->save();
                }catch(\Exception){
                    return false;
                }

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public static function isUniqueUsername(mixed $username)
    {
        $user = user::getAll('username = ?', [$username]);

        if (isset($user[0])){
            return false;
        }else{
            return true;
        }

    }

    public static function isUniqueMail(mixed $mail)
    {
        $user = user::getAll('mail = ?', [$mail]);

        if (isset($user[0])){
            return false;
        }else{
            return true;
        }
    }
}