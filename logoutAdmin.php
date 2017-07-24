<?php
require_once 'core/init.php';

$user = new Admin();
$user->logout();

Redirect::to('indexAdmin.php');

