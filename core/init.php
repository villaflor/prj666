<?php

/////////////////////
/// Created Date    : June 4, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : init.php
/// Description     :
///             It initialize the application (autoload classes). It define things
///         like start sessions, set config, autoload classes, and include functions.
/// Changes / Updates:
/// June 6, 2017 - Added remember me for login
/////////////////////

session_start();

$sqlinfo = parse_ini_file("/secret/sql.ini");

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => $sqlinfo['host'],
        'username' => $sqlinfo['username'],
        'password' => $sqlinfo['password'],
        'db' => $sqlinfo['database']
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);

/// It allows the program to pass in a function that deals with or that is run every
/// time a class is accessed.
spl_autoload_register(function($class){
    require_once 'classes/' . $class .'.php';
});

require_once 'functions/sanitize.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('client_session', array('hash', '=', $hash));

    if($hashCheck->count()){
        $user = new User($hashCheck->first()->client_id);
        $user->login();
    }
}
