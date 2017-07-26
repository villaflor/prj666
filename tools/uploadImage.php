<?php

    
     $target_dir = "/data/www/default/wecreu/images/";
     $target_file = $target_dir . $_FILES["good_image"]["name"];//"101.jpg";//basename($_FILES["good_image"]["name"]);
     $uploadOk = 1;

  //  echo "uploadImage.php runs, files [name]".$_FILES["good_image"]["name"].", [type]".$_FILES["good_image"]["type"].", [size]".$_FILES["good_image"]["size"]." [tmp name]".$_FILES["good_image"]["tmp_name"]." [error]".$_FILES["good_image"]["error"];
   

    if(isset($_POST["submit"])) { //from https://www.w3schools.com/php/php_file_upload.asp
        //$check = getimagesize($_FILES["good_image"]["name"]);
        $check = $FILES['good_image']['size'];
        if($check != 0) {
        //    echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "<script type='text/javascript'>alert('File is not an image.') </script>";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
         // if the logo exists, delete it.
        unlink($target_file);
        $uploadOk = 0;
       // $image = $target_file;
        echo "<script type='text/javascript'>alert('File already exists') </script>";

    }

    if($_FILES["good_image"]["size"] > 500000){
        echo "<script type='text/javascript'>alert('File is too large') </script>";
        $uploadOK = 0;
    }

     // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script type='text/javascript'>alert('Sorry, your file was not uploaded.') </script>";
     // if everything is ok, try to upload file
    } else {
         if (move_uploaded_file($_FILES["good_image"]["tmp_name"], $target_file)) {
             echo "The file <b>" . $target_file . "</b> has been uploaded";//basename($_FILES["fileToUpload"]["name"]) . "</b> has been uploaded.";
           //  echo "image ".$image;
             $image = /*"../../../images/".*/$_FILES["good_image"]["name"];//$target_file;
             $imageVer=true;
           //  echo " is set to ".$image." $imageVer= ".$imageVer."<br/>";
           
        } else {
            echo "<script type='text/javascript'>alert('Sorry, there was an error uploading your file.') </script>";
        }
    }
    

    function removeImage($image){

        $filename = pathinfo($image, PATHINFO_BASENAME);

      //  echo "got file ".$filename;

        $deletepath = "/data/www/default/wecreu/images/".$filename;

        if (is_file($deletepath)) {
            echo "<script type='text/javascript'>alert('found file '".$deletepath."' deleting!') </script>";
              //  fclose($deletepath);
            unlink($deletepath);
        }
    }

?>