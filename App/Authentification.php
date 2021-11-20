<?php

namespace App;

use App\Models\user;

class Authentification
{
    public static function verify($email, $password)
    {
        $user = user::getAll('mail ="'.$email.'" AND password = "'.$password.'"');

        if ($user != null){
            foreach($user as $item){
                $_SESSION['name'] = $item->getMail();
            }
            return true;
        }else{
            return false;
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

    public static function register(mixed $username, mixed $name, mixed $surname, mixed $mail, mixed $photo, mixed $password)
    {
        $newUser = new user(username:$username,
            name:$name, surname:$surname, mail:$mail, photo:$photo, password:$password);

        $newUser->save();

        verify($mail, $password);

    }
}