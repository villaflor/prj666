<?php

function uploadImage($filename){

     $target_dir = "/data/www/default/prj/template/blue2/images";
     $target_file = $target_dir . "/" . $filename;// . basename($_FILES["fileToUpload"]["name"]);
     $uploadOk = 1;
     
     // Check if file already exists
     if (file_exists($target_file)) {
         // if the logo exists, delete it.
         unlink($target_file);
     }
     
     // Check if $uploadOk is set to 0 by an error
     if ($uploadOk == 0) {
         echo "Sorry, your file was not uploaded.";
     // if everything is ok, try to upload file
     } else {
         if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
             echo "The file <b>" . $target_file . "</b> has been uploaded";//basename($_FILES["fileToUpload"]["name"]) . "</b> has been uploaded.";
         } else {
             echo "Sorry, there was an error uploading your file.";
         }
     }
     echo '<p><p><a href="index.php">Back</a></p></p>';
}
?>