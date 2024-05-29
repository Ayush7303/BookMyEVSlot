<?php 
session_start();
include "conn.php";
    if (isset($_POST['flag']) and $_POST['flag'] == "logout") {
        unset($_SESSION['username']);
        unset($_SESSION['userid']);
        echo 1;
    } 
    if (isset($_POST['flag']) and $_POST['flag'] == "imageclick") {
       
        echo 1;
    } 
    if (isset($_POST['flag']) and $_POST['flag'] == "adminlogout") {
        unset($_SESSION['admin']);
        echo 1;
    } 
    if (isset($_POST['flag']) and $_POST['flag'] == "addEV") {
        $uid=$_SESSION['userid'];
        $ename=$_POST['EVNAME'];
        $enumber=$_POST['EVNUMBER'];
        $sql="INSERT INTO `vehicletb`(`USERID`, `VEHICLENAME`, `VEHICLENUMBER`) VALUES ($uid,'{$ename}','{$enumber}')";
        $res=mysqli_query($con,$sql);
        if($res){
            echo 1;
        }
    }
    if(isset($_POST['flag']) AND $_POST['flag']=='displaystation'){
        $num_per_page=10;
       $page="";
       if(isset($_POST["page_no"])){
        $page=$_POST["page_no"];
       }else{
         $page=1;
       }
       $offset=($page-1)*$num_per_page;

        $sql="SELECT * FROM stationtb LIMIT {$offset},{$num_per_page}";
        $res=mysqli_query($con,$sql);
        $output="";
        $output.="<table id='tbde'><tr><th>STATION NAME</th><th>LOCATION</th><th>CITY</th><th>LATITUDE</th><th>LONGITUDE</th><th>AVAILABLE</th><th>DELETE</th><th>UPDATE</th></tr>";
        if(mysqli_num_rows($res)>0){
    
            while($data=mysqli_fetch_assoc($res)){
                $output.="<tr><td>{$data['stationname']}</td><td>{$data['location']}</td><td>{$data['city']}</td><td>{$data['latitude']}</td><td>{$data['longitude']}</td><td>{$data['available']}</td><td><a href='#' class='deletedata' id='{$data['stationid']}'><i class='fa fa-trash-o' style='font-size:15px;color:black'></i></a></td><td><a href='#' class='updatedata' id='{$data['stationid']}'><i class='fa fa-edit' style='font-size:15px;color:black;'></i></a></td></tr>";
            }
            $output.="</table>";
        }
        $sql="SELECT * FROM stationtb";
        $rs_result=mysqli_query($con,$sql);
        $total_records=mysqli_num_rows($rs_result);
        $total_pages=ceil($total_records/$num_per_page);
        $output.="<div id='pagination'>";
        for($i=1 ; $i<=$total_pages;$i++)
        {
            $output.="<a class='active' id='{$i}' href=''>{$i}</a>";
        }
        $output.="</div>";
        echo $output;
    }
if (isset($_POST['flag']) and $_POST['flag'] == "register") {
    $user_name = $_POST['uname'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $mobile_no = $_POST['mobileno'];

        $sql = "INSERT INTO `usertb`(`USERNAME`, `EMAIL`, `PASSWORD`, `MOBILENO`) VALUES ('{$user_name}','{$email}','{$pwd}','{$mobile_no}')";
        $res = mysqli_query($con, $sql);
        // $to=$email;
        // $message="you are successfully registered to bookmyslot.";
        // $from="sem6project.ayush.jeshan@gmail.com";
        // $subject="registeration";
        // $header="From : $from";
        // mail($to,$subject,$message,$header);
    } 
if (isset($_POST['flag']) and $_POST['flag'] == "login") {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $sql = "SELECT * FROM `usertb` WHERE `EMAIL`='{$email}' AND `PASSWORD`='{$pwd}'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0) {
            while($data = mysqli_fetch_assoc($res)){
                if(($data['EMAIL']=="ayushrana07@gmail.com" && $data['PASSWORD']=="Ayushr@n@07") || ($data['EMAIL']=="pateljesu1510@gmail.com" && $data['PASSWORD']=="Jeshan@07"))
                {
                    $_SESSION['admin']=$data['USERNAME'];
                    echo 1;
                }
                else{
                    $_SESSION['username']=$data['USERNAME'];
                    $_SESSION['userid']=$data['USERID'];
                    echo 2;
                }
            }
            // setcookie("user_name", $data['user_name'], time() + (86400 * 30), "/");

        } else {
            echo 3;
        }
    }
    if(isset($_POST['flag']) AND $_POST['flag']=="insertstation"){
        
        $sname=$_POST['stname'];
        $sloc=$_POST['stloc'];
        $scity=$_POST['stcity'];
        $slat=$_POST['stlat'];
        $slon=$_POST['stlon'];
        $sava=$_POST['stava'];
        $sql="INSERT INTO `stationtb`(`stationname`, `location`, `city`, `latitude`, `longitude`, `available`) VALUES('{$sname}','{$sloc}','{$scity}','{$slat}','{$slon}','{$sava}')";
        $res=mysqli_query($con,$sql);
        if($res){
            echo 1;
        }
    }
    if(isset($_POST['flag']) AND $_POST['flag']=='deletestation')
{
	$sid=$_POST['stid'];
	$sql="DELETE FROM stationtb WHERE stationid='{$sid}'";
	$res=mysqli_query($con,$sql);
	if($res)
	{
		echo 1;
	}
}
if(isset($_POST['flag']) AND $_POST['flag']=='reflectstation')
{
	$sid=$_POST['stid'];
	$sql="SELECT * FROM stationtb WHERE stationid='{$sid}'";
	$res=mysqli_query($con,$sql);
	if($res)
	{
		$data=mysqli_fetch_assoc($res);
		die(json_encode($data));
	}
} 
if(isset($_POST['flag']) AND $_POST['flag']=='updatestation')
{
	$sname=$_POST['stname'];
    $sloc=$_POST['stloc'];
    $scity=$_POST['stcity'];
    $slat=$_POST['stlat'];
    $slon=$_POST['stlon'];
    $sava=$_POST['stava'];
    $sid=$_POST['stid'];
	$sql="UPDATE `stationtb` SET `stationname`='{$sname}',`location`='{$sloc}',`city`='{$scity}',`latitude`='{$slat}',`longitude`='{$slon}',`available`='{$sava}' WHERE `stationid`='{$sid}'";
	$res=mysqli_query($con,$sql);
	if($res)
	{
		echo 1;
	}
}	
?>