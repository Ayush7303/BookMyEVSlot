<?php 
$to="ayushrana385@gmail.com";
$subject="OTP";
$message="Heloo your otp is aaaaaa";
$from="ayushrana767@gmail.com";
$headers="From: $from";
if(mail($to,$subject,$message,$headers))
{
    echo "mail sent.";
}
else{
    echo "failed.";
}


?>