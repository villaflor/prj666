<?php
require_once  'core/init.php';

$user = new Admin();
$email = Input::get('email');
$identifier = Input::get('validateCode');
$date = new DateTime();

if($user->isLoggedIn()){
    Redirect::to('indexAdmin.php');
}

if(!$user->emailExist($email)){
    Redirect::to('indexAdmin.php');
}

if(!$user->data()->validate_hash){
    Redirect::to('indexAdmin.php');
}

if($identifier !== $user->data()->validate_hash){
    Redirect::to('indexAdmin.php');
}

if($date->format('Y-m-d H:i:s') > $user->data()->validate_email_expire){
    $user->deleteUser();
    Session::flash('registerAdminError', 'Your email address verification request has been expired. Please, register again.');
    Redirect::to('registerAdmin.php');
}

try{
    $user->update(array(
        'validate_hash' => NULL,
        'validated' => 1,
        'validate_email_expire' => NULL
    ), $user->data()->client_id);

    Session::flash('login', 'Your email address have been successfully verified.');
    Redirect::to('login.php');
} catch (Exception $e){
    die($e->getMessage());
}
