<?php
require_once("conn.php");
if(!empty($_POST["zone"])) 
{
$zone=$_POST["zone"];

$query =mysqli_query($con,"");
?>
<option value="">Select Area</option>
<?php
while($row=mysqli_fetch_array($query))  
{
?>
<option value="<?php echo $row["area"]; ?>"><?php echo $row["area"]; ?></option>
<?php
}
}



?>
