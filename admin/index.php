<!DOCTYPE html>

<?php
include 'header.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Document</title>
<script src="https://kit.fontawesome.com/1e3435db7e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="../assets/css/adminindex.css">

</head>
<script src="https://kit.fontawesome.com/1e3435db7e.js" crossorigin="anonymous"></script>

<body>
<h2 style="text-align: center; margin-top:10px;">DASHBOARD</h2>
<!-- <div class="db">
<div class="box2">
	<div class="concenter">
<i class="fa-solid fa-user" style="font-size:40px;"></i><br/><br/>
<b><span style="font-size:30px;color:#009579;">
<?php
$sql = "SELECT * FROM usertb";
$res = mysqli_query($con, $sql);
$c=0;
if($res)
{
	while($data=mysqli_fetch_assoc($res))
	{
		$c++;
	}
}
echo $c;
?></span></b>
 WELCOME
</div>
</div>
<div class="box2">
	<div class="concenter">
	<i class="fa-solid fa-book" style="font-size:40px;"></i><br/><br/>
	<b><span style="font-size:30px;color:#009579;">
<?php
$sql = "SELECT * FROM bookingtb";
$res = mysqli_query($con, $sql);
$c=0;
if($res)
{
	while($data=mysqli_fetch_assoc($res))
	{
		$c++;
	}
}
echo $c;
?>
</span></b>
 BOOKINGS
</div>
</div> -->
<!-- 
<div class="box2">
	<div class="concenter">
	<i class="fas fa-charging-station" style="font-size:40px;"></i><br/><br/>
<b><span style="font-size:30px; color:#009579;">

<?php
$sql = "SELECT * FROM stationtb WHERE available=1";
$res = mysqli_query($con, $sql);
$c=0;
if($res)
{
	while($data=mysqli_fetch_assoc($res))
	{
		$c++;
	}
}
echo $c;
?>
</span></b>
 ACTIVE STATIONS
</div>
</div>
</div><br/> -->

<div style="  display: flex;justify-content:center; align-items: center;">
<div class="nav2">
	<a href="managestation.php"><i class="fas fa-charging-station"></i> Manage station</a>
	<a href="manageslot.php"><i class='fa-solid fa-check-to-slot'></i> Manage slot</a>
	<a href="managebooking.php"><i class="fa-solid fa-book"></i> Manage booking</a>
	<a href="manageuser.php"><i class='fas fa-address-book'></i> Manage user</a>
	</div>
</div>
                 
</body>
</html>