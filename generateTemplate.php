<?php
require_once 'core/init.php';
ini_set('display_errors', 'On');
$user = new User();


if (!$user->isLoggedIn()){
    Redirect::to('index.php');
}
if(Input::exists()){
    $client_name = $user->data()->username;
    $com_title = $user->data()->client_site_title;
    $target_dir = '/data/www/default/' . $client_name . '/images/';
    $target_file = $target_dir . "/logo.jpg";
    $uploadOk = 1;
// Desired folder structure
    $destination = '/data/www/default/' . $client_name;
    $destination2 = '/data/www/default/' . $client_name . '/images';
    $destination3 = '/data/www/default/' . $client_name . '/css';
    $check=0;
// To create the nested structure, the $recursive parameter
// to mkdir() must be specified.
    if (!file_exists($destination)){
        if (!mkdir($destination, 0770, true)) {
            die('Failed to create folders...');
        }
    } else {
        echo "directory already existed";
        $check=1;
    }
    if($check == 0){
        if (!file_exists($destination2)){
            if (!mkdir($destination2, 0770, true)) {
                die('Failed to create folders...');
            }
        }
        else {
            echo "directory already existed";
        }

        if (!file_exists($destination3)){
            if (!mkdir($destination3, 0770, true)) {
                die('Failed to create folders...');
            }
        }
        else {
            echo "directory already existed";
        }
    }
    echo "create";

    if (file_exists($target_file)){
        unlink($target_file);
    }
    if ($uploadOk == 0){
        echo "Sorry, your file was not uploaded";
    }
    else {
        if(move_uploaded_file($_FILES["client_logo"]["tmp_name"], $target_file)){
            echo "uploaded";
        }
        else{
            echo "Sorry";
        }
    }
    if ($check != 1 && $_POST['template'] == 2){
        $source = '/data/www/default/prj/template/blue';
        $source2 = '/data/www/default/prj/template/blue/images';
        $source3 = '/data/www/default/prj/template/blue/css';
        if($check==0){
            recurse_copy($source,$destination);
            recurse_copy($source2,$destination2);
            recurse_copy($source3,$destination3);
        }
        ob_start();
        include('../../template/blue/index.php');
        $forIndex = ob_get_contents();
        ob_end_clean();

        ob_start();
        include('../../template/blue/Header.php');
        $forHeader = ob_get_contents();
        ob_end_clean();

        $indexFile = fopen("/data/www/default/" . $client_name . "/index.php", "w") or die("Unable to open file!");
        $headerFile = fopen("/data/www/default/" . $client_name . "/Header.php", "w") or die("Unable to open file!");

        fwrite($indexFile, $forIndex);
        fclose($indexFile);

        fwrite($headerFile, $forHeader);
        fclose($headerFile);

        echo "Done writing";

    }
    else if ($check != 1 && $_POST['template'] == 1){
        $source = '/data/www/default/prj/template/green';
        $source2 = '/data/www/default/prj/template/green/images';
        $source3 = '/data/www/default/prj/template/green/css';
        if($check==0){
            recurse_copy($source,$destination);
            recurse_copy($source2,$destination2);
            recurse_copy($source3,$destination3);
        }
        ob_start();
        include('../../template/green/index-metadata.php');
        $forIndex = ob_get_contents();
        ob_end_clean();

        ob_start();
        include('../../template/green/header-nav.php');
        $forHeader = ob_get_contents();
        ob_end_clean();

        $indexFile = fopen("/data/www/default/". $client_name . "/index-metadata.php", "w") or die("Unable to open file!");
        $headerFile = fopen("/data/www/default/". $client_name ."/header-nav.php", "w") or die("Unable to open file!");

        fwrite($indexFile, $forIndex);
        fclose($indexFile);

        fwrite($headerFile, $forHeader);
        fclose($headerFile);

        echo "Done writing";

    }
    else if ($check != 1 && $_POST['template'] == 3){
        $source = '/data/www/default/prj/template/red';
        $source2 = '/data/www/default/prj/template/red/images';
        $source3 = '/data/www/default/prj/template/red/css';
        if($check==0){
            recurse_copy($source,$destination);
            recurse_copy($source2,$destination2);
            recurse_copy($source3,$destination3);
        }
        /*ob_start();
        include('../../template/red/');
        $forIndex = ob_get_contents();
        ob_end_clean();*/

        ob_start();
        include('../../template/red/header.php');
        $forHeader = ob_get_contents();
        ob_end_clean();

        //$indexFile = fopen("/data/www/default/testing2/index-metadata.php", "w") or die("Unable to open file!");
        $headerFile = fopen("/data/www/default/". $client_name ."/header.php", "w") or die("Unable to open file!");

        //fwrite($indexFile, $forIndex);
        //fclose($indexFile);

        fwrite($headerFile, $forHeader);
        fclose($headerFile);

        echo "Done writing";
    }
}



function recurse_copy($src,$dst) {
    $dir = opendir($src);
    //@mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    //echo "Copied";
    closedir($dir);
}

?>
<form action="" method="post"  enctype="multipart/form-data" >
    <div>Logo: <input type="file" name="client_logo" id="client_logo" accept="image/x-png,image/jpeg"/></div>
    <div>
        <input type="radio" name="template" value="1" checked>Green<br></div>
    <div><input type="radio" name="template" value="2">Blue<br></div>
    <div><input type="radio" name="template" value="3">Red</div>
    <div><input type="submit" value="submit"></div>
</form>