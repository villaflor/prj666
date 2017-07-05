<?php 
require_once 'core/init.php';
$user =new User();
ob_start();
include('index.php');
$random = ob_get_contents();
ob_end_clean();
echo $random;
?>
