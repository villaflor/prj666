<?php

/////////////////////
/// Created Date    : June 5, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : Token.php
/// Description     :
///             It allows the application to check for cross-site forgery.
/////////////////////


class Token{
    public static function generate(){
        return Session::put(Config::get('session/token_name'), md5(uniqid()));
    }

    public static function check($token){
        $tokenName = Config::get('session/token_name');

        if(Session::exists($tokenName) && $token === Session::get($tokenName)){
            Session::delete($tokenName);

            return true;
        }

        return false;
    }
}