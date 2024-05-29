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
    <table style="margin-top:50px;">
        <tr>
            <td>
                <div class="box">
            <form action="" method="POST" id="slotform">
        <div class="head1">ADD SLOT</div>

<!-- <input type="text" placeholder="Station name" name="sname" class="sname"> -->
<select name="sname" id="sname" class="sname">

  <!-- <option value="volvo">Volvo</option> -->
</select>
<div id="serr" class="err"></div>

<input type="text" placeholder="Voltage" name="volt" id="volt" class="volt">
<div id="volerr" class="err"></div>


<input type="text" placeholder="Price" name="pr" id="pr" class="pr">
<div id="prerr" class="err"></div>


<select name="ct" id="ct" class="ct">
<option value="" disabled selected hidden>Current type</option>
<option value="AC">AC</option>
<option value="DC">DC</option>
  <!-- <option value="volvo">Volvo</option> -->
</select>
<div id="cterr" class="err"></div>


<input type="text" placeholder="Available" id="sava" name="ava" class="ava">
<div id="savaerr" class="err"></div>


<input type="button" name="inserts" class="inserts" value="insert">
	<input type="button" name="updates" class="updates" value="update" style="display:none;">
	</form>
</div>
</td>
<td class="t">
<div id="slottable">
</div>
</td>
</tr>
</table>
</body>
<script src="../login-logout/jQuery.js"></script>
<script src="../assets/js/manage.js"></script>
</html>