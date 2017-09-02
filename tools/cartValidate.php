<?php
//include 'conf.ini';
/*
This function validates input from customer during checkout.
If any inputted fields are absent or incorrect, isValid is set to false
and an error message is sent
Author Olga
*/

include 'csql.php';
 //   $isValid = true;
	$proceed = 0;

    if($_SERVER["REQUEST_METHOD"] == "POST"){//if data available...

        //checking name
        if(!empty($_POST["name"])){
            $name = validate($_POST["name"]);
            if(strlen($name) > 100){
				$isValid=false;
                $nameErr = "Name must be less that 100 characters, contains ".strlen($name);
            } else {
                $nameErr = "";
            }
        } else {
            $nameErr = "Please enter your name";
			$isValid=false;
		}


      //  checking address
        if(!empty($_POST["address"])){
            $address = validate($_POST["address"]);
            if(strlen($address) > 300){
				$isValid=false;
                $addressErr = "Address must be under 300 characters ";
            } else {
				$addressErr = "";
            }
        }
		else{
			$addressErr = "Please enter an address";
            $isValid=false;
		}

      // checking phone
        if(!empty($_POST["number"])){
            $phone = validate($_POST["number"]);
            if(strlen($phone) > 14){
                $phoneErr = "Phone number can't exceed 14 numbers ".strlen($phone);
				$isValid=false;
            } else if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)){
				$phoneErr = "Phone number must follow this format 000-000-0000";
				$isValid=false;
			}
			else{
                $phoneErr = "";
            }
        }else{
			$phoneErr = "Please enter an phone number";
            $isValid=false;
		}


     //   checking city
        if(!empty($_POST["city"])){    
			$city = validate($_POST["city"]);
             if(strlen($city)>100){
                $cityErr = "City name must be under 100 characters";
                $isValid=false;
            } else {
                $cityErr = "";
            }
		} else {
            $cityErr = "Please enter a city";
            $isValid=false;
        }

     //   checking province/state
		if(!empty($_POST["state"])){
            $state = validate($_POST["state"]);
            if(strlen($state)>100){
                $stateErr = "State name must be under 100 characters";
                $isValid=false;
            } else {
                $stateErr = "";
            }
		} else {
            $stateErr = "Please enter a state";
			$isValid=false;
        }


     //   checking country
		if(!empty($_POST["country"])){
            $country = validate($_POST["country"]);
            if(strlen($country)>100){
                $countryErr = "country name must be under 100 characters";
                $isValid=false;
            } else {
                $countryErr = "";
            }
		} else {
            $countryErr = "Please enter a country";
			$isValid=false;
        }

     //   checking email
		if(!empty($_POST["email"])){

            $email = validate($_POST["email"]);//used as reference http://php.net/manual/en/filter.examples.validation.php ,  https://en.wikipedia.org/wiki/Email_address
            if(!preg_match("/^[\W|\w]+@[a-z|0-9|-]+\.[a-z|0-9]+$/", $email)){ 
                $emailErr = "email is not valid";
                $isValid=false;
            } else {
                $emailErr = "";
            }
		} else {
                
            $emailErr = "Please enter your email";
			$isValid=false;
        }

     //   checking payment
		if(!empty($_POST["payment"])){//payment is pre-set value only needs to be present

            $payment = validate($_POST["payment"]);
         
		} else {
                
            $paymentErr = "Please select payment";
			$isValid=false;
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
