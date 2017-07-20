<?php
    if($_POST && $_POST["method"] == "sendEmail"){
        require_once('email/PHPMailerAutoload.php');
        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
        function safe_replace($string, $isNBSP=true) {
            $string = trim($string);
            if($isNBSP){
                $string = str_replace(' ','&nbsp;',$string);
                $string = nl2br($string);
            }
            return $string;
        }

        // Check strings
    	$name = safe_replace($_POST["name"]);
    	$from = safe_replace($_POST['email']);
    	$subject = safe_replace($_POST['your-subject'],false);
    	$message = safe_replace($_POST['message']);
    	date_default_timezone_set("Canada/Central");
    	$time = date('Y-m-d h:i:sa');


        // Check strings
        $to = $_POST["to"];
		$name = $_POST["name"];
		$from = $_POST['email'];
		$subject = $_POST['your-subject'];
		$message = $_POST['message'];
		date_default_timezone_set("Canada/Central");
		$time = date('Y-m-d h:i:sa');

        // Config smtp server
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = ' smtp.zoho.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'wecreu@pying.ca';                 // SMTP username
        $mail->Password = 'vLrJatJGqEuL';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        $mail->setFrom('wecreu@pying.ca', 'Message From wecreu');
        $mail->addAddress($to, '');     // Add a recipient
        // $mail->addCC($from);
        // $mail->addReplyTo('py@pying.ca', 'Peiying (Brian)');
        $mail->isHTML(false);                                  // Set email format to HTML

        $mail->Subject = "$subject";
        $mail->Body    = "Time: $time<br/>Name: $name<br/>From: $from<br/> Subject: $subject<br/>Message:<br/>$message";
        $mail->AltBody = "Time: $time<br/>Name: $name<br/>From: $from<br/> Subject: $subject<br/>Message:<br/>$message";

        // Send email and Check if the email has been sent
        if($mail->send()) {
        ?>
            <script>
                alert("Thank you. Your message has been sent.");
                window.location.href="<?php echo $_POST['url'];?>";
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("There is error, you message cannot be sent.");
                window.location.href="<?php echo $_POST['url'];?>";
            </script>
        <?php
        }
    }
?>
