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

/*function pixel(){
    $remoteAddr = $_SERVER['REMOTE_ADDR'];
    $httpUserAgent = $_SERVER['HTTP_USER_AGENT'];
    $remoteUser = $_SERVER['REMOTE_USER'];
    $requestURI = $_SERVER['REQUEST_URI'];
    $dateStamp = date("D dS M,Y h:i a");

    if($remoteUser !== 'Wecreu'){
        # Send to IFTTT
        $secret_key="NMbeNxHo_iK_neoJJncmx";
        $url = 'https://maker.ifttt.com/trigger/prj/with/key/' . $secret_key;
        $post_data = json_encode( array(
            'value1' => $remoteAddr,
            'value2' => $remoteUser,
            'value3' => $requestURI
        ));
        $ch = curl_init($url);

        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
    }

    $info = $remoteAddr . '","'
        . $httpUserAgent . '","'
        . $remoteUser . '","'
        . $requestURI . '","'
        . $dateStamp . '"' . "\n";

    $file = '/home/student/log.csv';
    $fp = fopen($file, "a");
    fputs($fp, $info);
    fclose($fp);
}*/
