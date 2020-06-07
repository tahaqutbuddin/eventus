
<?php
session_start();

$flag=$_SESSION['flag'];
if($flag==0)
{
    require 'mail_for_customer.php';
}else if($flag==1){
    require 'mail_for_replies.php';
}

$to_email =  $_SESSION['email_client'];
$subject = "Your Event Register Sucessfully";
$from = 'EventUs';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= "From: EventUs\r\n".
    'X-Mailer: PHP/' . phpversion();

// Sending email
if(mail($to_email, $subject, $body, $headers)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
}
?>