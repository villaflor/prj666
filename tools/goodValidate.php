<?php
 /*
 Good validation script, checks if user input in create-good and edit-good forms 
 is present and valid and returns error messages if it is not
 Author Olga
*/
  
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //checking name
        if(empty($_POST["good_name"])){

            $nameErr = "Please enter a good name";

        } else {
            
            $name = validate($_POST["good_name"]);
            if(strlen($name) > 100){
                $nameErr = "Name must be less that 100 characters, contains ".strlen($name);
            } else {
                $nameVer = true;
            }
        }

     //  checking image presence(uploading is different file)
       if(!empty($_FILES["good_image"]['name'])){
            
            $imagelength = validate($_FILES["good_image"]['name']);
            if(strlen($imagelength) > 256){
                $imageErr = "image file path must be less that 256 characters";
            } else { 
                $imageVer = true;
            }
        } else {
            $imageVer = false;
        }

      //  checking description
        if(!empty($_POST["description"])){

            $description = validate($_POST["description"]);
            if(strlen($description) > 300){
                $descriptionErr = "Description must be less that 300 characters ".strlen($description);
            } else {
                $descVer = true;
            }
        }

     //   checking good_price
        if(empty($_POST["good_price"])){

            $priceErr = "Please enter a price";

        } else {
            $price = validate($_POST["good_price"]);
            if(!preg_match("/^\d{1,8}(\.\d{0,2}|)$/", $price)){
                $priceErr = "Price must be 8 digits, 2 decimals at most";
            } else {
                $priceVer = true;
            }
        }

   //     checking good_quantity
        if(!empty($_POST["good_quantity"])){

            $quantity = validate($_POST["good_quantity"]);
            if(!preg_match("/^\d{1,6}$/", $quantity)){
                $quantityErr = "Quantity must be 6 digits at most";
            } else {
                $qtyVer = true;
            }
        }

  //      checking good_weight
        if(!empty($_POST["good_weight"])){

            $weight = validate($_POST["good_weight"]);
            if(!preg_match("/^\d{1,6}(\.\d{0,2}|)$/", $weight)){
                $weightErr = "Weight must be 6 digits, 2 decimals at most";
            } else {
                $weightVer = true;
            }
        }

    //   checking taxable
        if(empty($_POST["taxable"])){
            $taxable = 0;
        } else {
            $taxable = 1;
        }

    //   checking visible
        if(empty($_POST["visible"])){
            $visible = 0;
        } else {
            $visible = 1;
        }

     //  checking category_id
        if(empty($_POST["category_id"])){
            $categoryErr = "Please choose a category";
        } else {
            $category = validate($_POST["category_id"]);
            $catVer = true;
        }
     //   checking sale_id
        if(isset($_POST["sale_id"])){
            $sale = validate($_POST["sale_id"]);
        }
    }

 //validation function
    function validate($data){
    
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    

?>