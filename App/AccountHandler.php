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

}