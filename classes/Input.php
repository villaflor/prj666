<?php

/////////////////////
/// Created Date    : June 4, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : Validation.php
/// Description     :
///             I allows the application to work with the user's input. It check
///         if data exist.
/////////////////////

class Input{
    public static function exists($type = 'post'){
        switch ($type){
            case 'post':
                return (!empty($_POST)) ? true : false;
                break;
            case 'get':
                return (!empty($_GET)) ? true : false;
                break;
            default:
                return false;
                break;
        }
    }

    public static function get($item){
        if(isset($_POST[$item])){
            return $_POST[$item];
        } else if(isset($_GET[$item])){
            return $_GET[$item];
        }

        return '';
    }
}