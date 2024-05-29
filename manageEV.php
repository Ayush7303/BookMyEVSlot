<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>

<?php 
// session_start();
if(!isset($_SESSION['username'])){
    header("location:login-logout/login.php");
}
?>
<head>

    <title>Manage EV</title>
    <script src="https://kit.fontawesome.com/1e3435db7e.js" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <link rel="stylesheet" href="index.css"> -->
    <link rel="stylesheet" href="assets/css/manageEV.css">
    <!-- <link rel="stylesheet" href="assets/css/clientindex.css"> -->

</head>

<body>

    <div class="dblock"></div>
    <script src="assets/js/jQuery.js"></script>
    <script src="assets/js/manageEV.js"></script>

</body>
</html>