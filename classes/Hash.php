<?php

/////////////////////
/// Created Date    : June 5, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : Hash.php
/// Description     :
///             It allows the application to create hashes for things like salts.
/// Changes / Updates:
/// June 13, 2017 - Added string function, generates a string of random letters, to be used in forget password
/////////////////////

class Hash{
    public static function make($string, $salt = ''){
        return hash('sha256', $string . $salt);
    }

    public static function salt($length){
        return mcrypt_create_iv($length);
    }

    public static function unique(){
        return self::make(uniqid());
    }

    public static function string($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters = str_shuffle($characters);
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}