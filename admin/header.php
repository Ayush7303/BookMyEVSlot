<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(!isset($_SESSION['admin']))
{
    header("location:../login-logout/login.php");
}
?>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/adminindex.css">
</head>
<?php
include "../conn.php";
?>
<script src="https://kit.fontawesome.com/1e3435db7e.js" crossorigin="anonymous"></script>

<body>
    <div class="nav">
            <img src="../assets/images/Logo.png" id="imghome" style="background-color:white;" alt="logo"/>
       <!-- <span class="mrg"></span> -->
       <div class="rig ">

            <a href="" id="logoutbtn" style="margin-left:71px;"><i class='fas fa-sign-out-alt'></i> Logout</a>
            <a href="" class="profilebtn"><i class='far fa-user-circle'></i></a>
</div>

</div>
<script src="../assets/js/jQuery.js"></script>
<script>
$("#logoutbtn").on("click", function(){
    $.ajax({
        url: "../ajax.php",
        type: "POST",
        data: { "flag": "adminlogout"},
        success: function(data) {
            if(data==1)
            {
                // Document.getElementByClass("mrg").style.marginLeft+="200px";
                header("location:../login-logout/login.php");
            }
        }
        });
});  
</script>

</body>
</html>