<?php
/*
    script to upload images. created by Olga
    Is called when good information is validated and uploads image file to system renaming it as good id
    Also Contains function to delete images
    based on tutorial from https://www.w3schools.com/php/php_file_upload.asp
    and https://security.stackexchange.com/questions/32852/risks-of-a-php-image-upload-form
 */  


function uploadImageFunction($imageIdFileName, $alertMessage){

    
     $target_dir = "/data/www/default/wecreu/images/";
     $target_file = $target_dir . $imageIdFileName;
     $uploadOk = 1;
	 
    //checks if file is actually an image. Author Quang
    $allowed = array('png','jpg', 'PNG', 'JPG');
    $filename = $_FILES['good_image']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if($_FILES['good_image']['size'] == 0){
        $alertMessage = $alertMessage."File is empty, image not exist";
        $uploadOk = 0;
    } else if(!in_array($ext, $allowed)){
        $alertMessage = $alertMessage." File must be .png or .jpg";
        $uploadOk = 0;
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
         // if the image exists, delete it.
        unlink($target_file);
        $uploadOk = 1;
    }


     // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
       
        $alertMessage = $alertMessage." Sorry, your file was not uploaded.";
     // if everything is ok, try to upload file
    } else {
         if (move_uploaded_file($_FILES["good_image"]["tmp_name"], $target_file)) {   
          //   $image = $_FILES["good_image"]["name"];//$target_file;
             $imageVer=true;
        } else {
            $alertMessage = $alertMessage." Sorry, there was an error uploading your file.";
        }
    }
    return $alertMessage;
}

/*
Removes image
*/
    function removeImage($image){

        $filename = pathinfo($image, PATHINFO_BASENAME);

        $deletepath = "/data/www/default/wecreu/images/".$filename;

        if (is_file($deletepath)) {
            unlink($deletepath);
        }
    }

?>