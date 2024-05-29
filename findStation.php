<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php';
    include 'conn.php'; 
    // session_start();
    
    ?>
   
    <title>Find Station</title>
    <link rel="stylesheet" href="assets/css/findStation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="assets/js/jQuery.js"></script>
    <script>

function searchbycity(val){
    $.ajax({
	type: "POST",
	url: "ajax.php",
	data:{"flag":"searchcity","city":val},
	success: function(data){
        // alert(data);
            $(".box").html(data);
		// $("#zone").html(data);
	}
	});
}
function getzone(val) {
	// alert(val);
	$.ajax({
	type: "POST",
	url: "ajax.php",
	data:{"flag":"getzone","city":val},
	success: function(data){
        // alert(data);
		$("#zone").html(data);
	}
	});
}

function searchbyzone(val){
    var city=$('#city').val();
    // alert(city);
    $.ajax({
	type: "POST",
	url: "ajax.php",
	data:{"flag":"searchzone","zone":val,"city":city},
	success: function(data){
        // alert(data);
            $(".box").html(data);
		// $("#zone").html(data);
	}
	});
}
function searchbyarea(val){
    var city=$('#city').val();
    var zone=$('#zone').val();
    // alert(city);
    $.ajax({
	type: "POST",
	url: "ajax.php",
	data:{"flag":"searcharea","area":val,"zone":zone,"city":city},
	success: function(data){
        // alert(data);
            $(".box").html(data);
		// $("#zone").html(data);
	}
	});
}
function getarea(val) {
    var city=$('#city').val();

	//alert(val);
	$.ajax({
	type: "POST",
	url: "ajax.php",
	data:{"flag":"getarea","zone":val,"city":city},
	success: function(data){
		$("#area").html(data);
	}
	});
}

</script>	
</head>
<body>
    <form name="insert" action="" method="post">
        <div id="inl">
            <span class="select">
                <select onChange="searchbycity(this.value); getzone(this.value);"  name="city" id="city" class="cityselect">
                    <option value="">Select City</option>
                    <?php $query =mysqli_query($con,"SELECT DISTINCT city FROM stationtb");
                        while($row=mysqli_fetch_array($query))
                        { ?>
                            <option value="<?php echo $row['city'];?>"><?php echo $row['city'];?></option>
                        <?php
                        }
                        ?>
                </select>
            </span>
            <span class="select">
                <select   name='zone' id='zone' onChange='searchbyzone(this.value); getarea(this.value);'>
                    <option value=''>Select Zone</option> 
                </select>
            </span>

            <span class="select">
                <select name="area" id="area" onChange='searchbyarea(this.value);'>
                    <option value="">Select Area</option>
                </select>
            </span>
        </div>
    </form>
    <div class="mainContainer">
        <div id="boxs" class="box"></div>
        <div class="box slot-main" id="hidebox"></div>
    </div>
    <script src="assets/js/jQuery.js"></script>
    <script src="assets/js/findStation.js"></script>
</body>
</html>