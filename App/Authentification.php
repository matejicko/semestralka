<?php

namespace App;

use App\Models\user;

class Authentification
{
    public static function verifyAndLogIn($email, $password)
    {

        //input has to fit exact format
        if (FormatChecker::checkEmail($email) &&
            FormatChecker::checkPassword($password)) {
            $user = user::getAll('mail ="' . $email . '" AND password = "' . $password . '"');

            if ($user != null) {
                foreach ($user as $item) {
                    $_SESSION['name'] = $item->getMail();
                }
                return true;
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

    public static function register(mixed $username, mixed $name, mixed $surname, mixed $mail, mixed $photo, mixed $password, mixed $checkPassword)
    {
        //TODO::add Photo verification and insertion into databse
        //input has to be in proper format and has to be not-null
        if (FormatChecker::checkUsername($username) &&
            FormatChecker::checkName($name) &&
            FormatChecker::checkSurname($surname) &&
            FormatChecker::checkEmail($mail) &&
            FormatChecker::checkPassword($password) &&
            strcmp($password, $checkPassword) == 0) { //confirmation password must fit password

            //check if there is already user with such username or mail
            $checkUser = user::getAll('username="' . $username . '"OR mail="' . $mail . '"');

            //if there is nobody with same username or mail, new account can be created
            if ($checkUser == null) {
                $newUser = new user(username: $username,
                    name: $name, surname: $surname, mail: $mail, photo: $photo, password: $password);

                $newUser->save();

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }
}