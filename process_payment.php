<?php 
include 'conn.php';


use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

session_start();
if(isset($_POST['flag']) and $_POST['flag']=='checkcaptcha')
{
    $capt=$_POST['captcha'];
    $c=$_SESSION['CAPTCHA_CODE'];
    if($capt==$c){
        echo 1;
    }
    else{
        echo 0;
    }

}
if(isset($_POST['flag']) and $_POST['flag']=='pay' )
{

    $paymentId = $_POST['payment_id'];
    $amount = $_POST['amount'];
    $name = $_POST['name'];
 
    date_default_timezone_set('Asia/Kolkata');
    $currtime = date('H:i:s');
    $currdate = date('Y:m:d');

    //insert data into database
    $sql="INSERT INTO  `razorpay_payment`(`name`,`amount`,`payment_status`,`payment_id`,`paid_on`) VALUES('$name','$amount','paid','$paymentId','$currdate $currtime')";
    $res=mysqli_query($con,$sql);

}
    // $stmt=$con->prepare($sql);
    // $stmt->execute();
if(isset($_POST['flag']) and $_POST['flag']=='addbooking')
{
    $stname = $_POST['stname'];
$vid =  $_POST['vid'];
$slid =  $_POST['slid'];
$time_value =  $_POST['time_value'];
$date =  $_POST['date'];
$price = $_POST['price'];
$uid = $_SESSION['userid'];
// $capt=$_POST['captcha'];
$oid = "o".rand(1000, 10000);
$message=" ";
// echo $slid.$time_value.$date;
// echo $vid;

// if($capt===$_SESSION['CAPTCHA_CODE']){
$sql = "INSERT INTO `bookingtb`(`bookingid`, `slotid`, `userid`, `vehicleid`, `date`, `time`, `duration`, `price`) VALUES('{$oid}', '{$slid}', '{$uid}', '{$vid}', '{$date}', '{$time_value}', '02:00:00', '{$price}')";
$res = mysqli_query($con, $sql);
if($res)
{

    $sql2 = "UPDATE slot_timetb SET status = 2 WHERE slotid = '{$slid}' AND timeid = (SELECT timeid FROM timetb WHERE time = '{$time_value}') AND date_id = (SELECT date_id FROM date_tb WHERE date = '{$date}')";
    $res2 = mysqli_query($con, $sql2);
    if($res2)
    {
        $message .= "<tr>
        <label> <td>Station : </td><td>{$stname}</td> </label></tr>
        <tr><label><td> Slot : </td><td>{$slid}</td> </label></tr>";
        $sql3 = "SELECT * FROM vehicletb WHERE VEHICLEID = {$vid}";
        $res3 = mysqli_query($con, $sql3);
        
        if($res3)
        {
            while($data = mysqli_fetch_assoc($res3))
            {
                $message .= "<tr><label><td> Vehicle : </td><td>{$data['VEHICLENAME']}</td></label></tr>";                
            }
        }
        $message .= "<tr><label> <td>Time : </td><td>{$time_value}</td></label></tr>
        <tr>    <label> <td>Date : </td><td>{$date}</td></label></tr>
        <tr>    <label> <td>Price :</td><td> &#8377; {$price}</td> </label></tr>";
        
        $sql4 = "SELECT EMAIL FROM usertb WHERE USERID = {$uid}";
        $res4 = mysqli_query($con, $sql4);
        
        if($res4)
        {
            while($data = mysqli_fetch_assoc($res4))
            {
                $email = $data['EMAIL'];               
            }
        }
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pateljesu1510@gmail.com';
        $mail->Password = 'tsznognqtlrlivum';
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->setFrom('pateljesu1510@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $sub = "Slot Booking Reciept From bookMyEVslot";
            
        $mail->Subject = $sub;
        $mail->Body = $message;
        $mail->send();
    }
}
}

// header("location:login-logout/login.php");

// include "conn.php";




?>