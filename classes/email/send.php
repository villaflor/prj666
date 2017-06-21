<?php
require 'PHPMailerAutoload.php';
function sendEmail($to ,$title, $subject, $body, $client_name = 'client_name'){
    $mail = new PHPMailer;
    //$mail->SMTPDebug = 3;  
     
    $mail->isSMTP();      // Set mailer to use SMTP
    $mail->Host = ' smtp.zoho.com';  			// Specify main and backup SMTP servers
    $mail->SMTPAuth = true;       // Enable SMTP authentication
    $mail->Username = 'wecreu@pying.ca'; // SMTP username
    $mail->Password = 'vLrJatJGqEuL';   // SMTP password
    $mail->SMTPSecure = 'ssl';    // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;    // TCP port to connect to
    
    $mail->setFrom('wecreu@pying.ca', $title);
    $mail->addAddress($to, $client_name);     // Add a recipient
    //$mail->addReplyTo('brian@pying.ca', 'Peiying (Brian)');
    $mail->isHTML(true);  // Set email format to HTML
    
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = $body;
    
    // if success return ture
    return $mail->send();
}
