<!DOCTYPE html>
<html lang="en">
<head>
    <title>BookMyEVslot</title>
    <link rel="icon" type="image/png" href="assets/images/logo3.jpg"/>
    <link rel="stylesheet" href="assets/css/clientindex.css">
</head>
<?php
include "conn.php";
?>
<script src="https://kit.fontawesome.com/1e3435db7e.js" crossorigin="anonymous"></script>

<body>
    <div class="nav">
            <img src="assets/images/Logo.png" id="imghome" class="imgclick" style="background-color:white;" alt="logo"/>    
            <a href="manageEV.php" class="manageEV"><i class='fas fa-car-alt'></i> Manage E-Vehicle</a>
            <a href="findStation.php"><i class="fas fa-charging-station"></i> Find Station</a>
            <a href="viewbookings.php"><i class="fas fa-envelope-open-text"></i> View Booking</a>
       <!-- <span class="mrg"></span> -->
      <div class="rig">
      <?php 
        session_start();
        if(isset($_SESSION['username'])){
        ?>
            <a href="" id="logoutbtn" style="margin-left:71px;"><i class='fas fa-sign-out-alt'></i> Logout</a>
        <?php 
        } else {?>
            <a href="login-logout/login.php" id="loginbtn"><i class='fas fa-sign-in-alt'></i> Login | Register</a>
        <?php 
        }?>
            <a href="profile.php" class="profilebtn"><i class='far fa-user-circle'></i></a>
</div>
</div>





 <script src="assets/js/jQuery.js"></script>
<script>

<?php 
if(isset($_SESSION['username'])){
?>
$("#logoutbtn").show();
$(".profilebtn").show();
$("#loginbtn").hide();
<?php  
}
else{
?>
$("#logoutbtn").hide();
$(".profilebtn").hide();
$("#loginbtn").show();
<?php
}
?>
$("#logoutbtn").on("click", function(){
    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: { "flag": "logout"},
        success: function(data) {
            if(data==1)
            {
                // Document.getElementByClass("mrg").style.marginLeft+="200px";
                // header("location:index.php");
                window.location="index.php";
            }
        }
        });
});
$(".imgclick").on("click",function(){
    // header("location:index.php");
    $.ajax({
        url: "ajax.php",
        type: "POST",
        data: { "flag": "imageclick"},
        success: function(data) {
            if(data==1)
            {
                window.location="index.php";
            }
        }
        });
});
</script>

</body>
</html>