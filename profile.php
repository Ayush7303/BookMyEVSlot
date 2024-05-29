<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>

<head>
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/profile.css">

</head>
<body>
    <div class="a">
<div class="box">
<div class="head1">EDIT INFORMATION</div>
<!-- <form action="addprofile.php" method="POST" enctype="multipart/form-data"> -->
<?php 
include 'conn.php';
$sql="SELECT picture FROM profiletb";
$res=mysqli_query($con,$sql);
if(mysqli_num_rows($res))
{
    while($data=mysqli_fetch_assoc($res))
    {
?>
  
<div id="preview"><img class="pic" src="<?php echo $data['picture']; ?>"/></div><br>
<?php 
}
}
else
{
?>
  
<div id="preview"><img class="pic" src="assets/images/blankprofile.png"/></div><br>
<?php 
}
?>

        <input type="file" class="imup" id="imup"><br/><div id="err"></div>
</div>

<div class="box2">
<div class="head1">ACCOUNT INFORMATION</div>

<table>
<tr>
    <td>USER NAME</td>
    <td><input type="text" class="un" disabled></td>
</tr>
<tr>
    <td>E-MAIL</td>
    <td><input type="text" class="em" disabled></td>
</tr>
<tr>
    <td>MOBILE NO</td>
    <td><input type="text" class="mn" disabled></td>
</tr>
</table>
<div class="head1">CHANGE PASSWORD</div>
<table>
<tr>
    <td>CURRENT PASSWORD</td>
    <td><input type="password" id="cp">
    <div id="cpwderr" class="err"></div></td>
    
</tr>
<tr>
    <td>NEW PASSWORD</td>
    <td><input type="password" id="np">
    <div id="npwderr" class="err"></div></td>
 
</tr>
<tr>
    <td>CONFIRM PASSWORD</td>
    <td><input type="password" id="cnp">
    <div id="cnpwderr" class="err"></div></td>
    
</tr>
<tr>
    <td col span="2"><input type="button" id="changepwd" value="CHANGE PASSWORD"></button></td>
    <!-- <td><input type="text"></td> -->
</tr>
</table>
</div>
</div>
</body>
<script src="assets/js/jQuery.js"></script>
<script src="assets/js/profile.js"></script>
</html>