<?php

/////////////////////
/// Created Date    : June 4, 2017
/// Author          : Mark Anthony M. Villaflor
/// Filename        : sanitize.php
/// Description     :
///             It sanitize data (both going in and coming out)
/////////////////////

/// It uses the HTML entities function in PHP. It explicitly define
/// couple of options which is going to make this a little bit more
/// secure
function escape($string){
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}
