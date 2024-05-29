<!DOCTYPE html>
<html lang="en">
    <?php 
include 'index.php';
?>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/form.css">
</head>
<body>
    <table style="margin-top:10px;">
        <tr>
            <td>
                <div class="box">
            <form action="" method="POST" id="sform">
        <div class="head1">ADD STATION</div>

<input type="text" placeholder="Station name" name="stname" id="stname" class="stname"> 
<div id="snerr" class="err"></div>

<input type="text" placeholder="Location" name="stloc" id="stloc" class="stloc">
<div id="locerr" class="err"></div>

<input type="text" placeholder="Area" name="starea" id="starea" class="starea">
<div id="areaerr" class="err"></div>

<input type="text" placeholder="Zone" name="stzone" id="stzone" class="stzone">
<div id="zoneerr" class="err"></div>

<input type="text" placeholder="City" name="stcity" id="stcity" class="stcity">
<div id="cityerr" class="err"></div>

<input type="text" placeholder="Latitude" name="stlat" id="stlat" class="stlat">
<div id="laterr" class="err"></div>

<input type="text" placeholder="Longitude" name="stlon" id="stlon" class="stlon">
<div id="lonerr" class="err"></div>

<input type="text" placeholder="Available" name="stava" id="stava" class="stava">
<div id="avaerr" class="err"></div>

<input type="button" name="insert" class="insert" value="insert">

<input type="button" name="update" class="update" value="update" style="display:none;">
	</form>
</div>
</td>
<td class="t">
<div id="sttable">
</div>
</td>
</tr>
</table>
</body>
<script src="../assets/js/jQuery.js"></script>
<script src="../assets/js/manage.js"></script>
</html>