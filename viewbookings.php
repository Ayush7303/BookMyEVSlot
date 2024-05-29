<!DOCTYPE html>
<html lang="en">
<head>
<?php 
include 'header.php';
?>
<?php 
// session_start();
if(!isset($_SESSION['username'])){
    header("location:login-logout/login.php");
}
?>
    <title>Document</title>
<script src="https://kit.fontawesome.com/1e3435db7e.js" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="assets/css/booking.css">
</head>
<body>
    <h1 style="margin-top:50px;">Your Bookings</h1>
    <div id="bookings">
    <div id="bookingdata"></div></div>

    <h1>Recent Bookings</h1>
    <div id="recentbookings">
    <div id="recentbookingdata"></div></div>
</body>
<script src="assets/js/jQuery.js"></script>
<script src="assets/js/showbooking.js"></script>

</html>