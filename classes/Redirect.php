<?php

/////////////////////
/// Created Date    : June 6, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : Redirect.php
/// Description     :
///             It deals with things like 404 errors and/or redirecting to a specific page.
/////////////////////

class Redirect{
    public static function to($location = null){
        if($location){
            if(is_numeric($location)){
                switch ($location){
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        include 'includes/errors/404.inc';
                        exit();
                        break;
                }
            }
            header('Location: ' . $location);
            exit();
        }
    }
}