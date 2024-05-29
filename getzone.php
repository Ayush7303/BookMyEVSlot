<?php
require_once("conn.php");
if(!empty($_POST["city"])) 
{
$city=$_POST["city"];
$query1 =mysqli_query($con,"SELECT DISTINCT `zone` FROM `stationtb` WHERE `city`='{$city}'");
?>
<option value="">Select Zone</option>
<?php
while($row1=mysqli_fetch_array($query1))  
{
?>
<option value="<?php echo $row1["zone"]; ?>"><?php echo $row1["zone"]; ?></option>
<?php
}
}
?>
