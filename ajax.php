<?php 

use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

session_start();

include "conn.php";

//Register
// sendregemail

if (isset($_POST['flag']) and $_POST['flag'] == "sendregemail") {
    $email = $_POST['email'];
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'pateljesu1510@gmail.com';
    $mail->Password = 'tsznognqtlrlivum';
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->setFrom('pateljesu1510@gmail.com');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $sub = "BookMyEVSlot:Registration";
    $message="Welcome to BookMyEVSlot.You have successfully registered.";
    $mail->Subject = $sub;
    $mail->Body = $message;
    $mail->send();
    echo 1;
}
if (isset($_POST['flag']) and $_POST['flag'] == "register") {
    $user_name = $_POST['uname'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $mobile_no = $_POST['mobileno'];



        $sql = "INSERT INTO `usertb`(`USERNAME`, `EMAIL`, `PASSWORD`, `MOBILENO`) VALUES ('{$user_name}','{$email}','{$pwd}','{$mobile_no}')";
        $res = mysqli_query($con, $sql);
        if($res)
            echo 1;
        else
            echo 0;
    } 

//Login

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

        }
         else {
            echo 3;
        }
    }

//Change password

if (isset($_POST['flag']) and $_POST['flag'] == "changepassword") {
    $curp = $_POST['curpwd'];
    $newp = $_POST['newpwd'];
   
    $uid=$_SESSION['userid'];
    $sql = "SELECT * FROM `usertb` WHERE `USERID`=$uid AND `PASSWORD`='{$curp}'";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) > 0) {
      
            $sql="UPDATE `usertb` SET `PASSWORD`='{$newp}' WHERE `USERID`=$uid";
            $res = mysqli_query($con, $sql);
            if($res)
            {
                echo 1;
            }

    } else {
        echo 2;
    }
} 

//Reflect user (profile)
    
if(isset($_POST['flag']) AND $_POST['flag']=='reflectuser')
{
	$uid=$_SESSION['userid'];
	$sql="SELECT * FROM `usertb` WHERE `USERID`='{$uid}'";
	$res=mysqli_query($con,$sql);
	if($res)
	{
		$data=mysqli_fetch_assoc($res);
		die(json_encode($data));
	}
} 

//Searching 

if(isset($_POST['flag']) and $_POST['flag']=='getzone')
{
$city=$_POST["city"];

$sql = "SELECT DISTINCT `zone` FROM `stationtb` WHERE `city`='{$city}'";
    $res = mysqli_query($con, $sql);
    $op = "
    <option value=''>Select Zone</option> </select>
    ";
    if($res)
    {
        while($data = mysqli_fetch_assoc($res))
        {
                $op .= " 
                
    <option value='{$data['zone']}'>{$data['zone']}</option>
";
            }
        }
    echo $op;
}

//searching

if(isset($_POST['flag']) and $_POST['flag']=='getarea')
{
$zone=$_POST["zone"];
$city=$_POST["city"];

$sql = "SELECT DISTINCT `area` FROM `stationtb` WHERE `zone` = '{$zone}' AND `city`='{$city}'";
    $res = mysqli_query($con, $sql);
    $op = "
<option value=''>Select Area</option>";
    if($res)
    {
        while($data = mysqli_fetch_assoc($res))
        {
                $op .= "    
    <option value='{$data['area']}'>{$data['area']}</option>
";
            }
        }
    echo $op;
}

//Display seaching result

if(isset($_POST['flag']) and $_POST['flag']=='searchzone')
{
    $z=$_POST["zone"];
    $c=$_POST["city"];
    $sql = "SELECT * FROM `stationtb` WHERE `zone`='{$z}' AND `city`='{$c}'";
    $res = mysqli_query($con, $sql);
    $op = "";
    if($res)
    {
        while($data = mysqli_fetch_assoc($res))
        {
            if($data['available']==1)
            {
                $op .= "<div class='card'>
                            <div class='station-list'>
                                <div class='station-img'>
                                    <img id='station-img' src='assets/icons/evmark2.png'/>
                                </div>
                                <div class='station-details'>
                                    <h2 class='st-name'>{$data['stationname']}</h2>
                                    <p class='st-location'>{$data['location']}</p>
                                    <div class='square' id='{$data['stationid']}' onclick='display_slots({$data['stationid']})'>
                                        <i class='fa fa-caret-down' name='s{$data['stationid']}'></i>
                                    </div>
                                    <p class='txt' id='txt{$data['stationid']}' onclick='display_slots({$data['stationid']})'>Show Slots</p>
                                </div> 
                                <div class='station-act-deact'>
                                    <div class='avl-txt'>
                                        
                                        <div class='avl'>
                                            <p>Available</p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class='slot-list' id='slots{$data['stationid']}'></div>
                        </div>";
            }
            else if($data['available']==0)
            {
                $op .= "<div class='card'>
                            <div class='station-list'>
                                <div class='station-img'>
                                    <img id='station-img' src='assets/icons/evmark2.png'/>
                                </div>  
                                <div class='station-details'>
                                    <h2 class='st-name'>{$data['stationname']}</h2>
                                    <p class='st-location'>{$data['location']}</p>
                                    <div class='square' id='{$data['stationid']}' onclick='display_slots({$data['stationid']})'>
                                        <i class='fa fa-caret-down' name='s{$data['stationid']}'></i>
                                    </div>
                                    <p class='txt' id='txt{$data['stationid']}' class='{$data['stationid']}'  onclick='display_slots({$data['stationid']})'>Show Slots</p>
                                </div> 
                                <div class='station-act-deact'>
                                    <div class='unavl-txt'>
                                        
                                        <div class='unavl'>
                                            <p>Unavailable</p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class='slot-list' id='slots{$data['stationid']}'></div>
                        </div>";                
            }
        }
    }
    echo $op;
}




//Display searching result

if(isset($_POST['flag']) and $_POST['flag']=='searchcity')
{
    $c=$_POST["city"];
    $sql = "SELECT * FROM stationtb WHERE city='{$c}'";
    $res = mysqli_query($con, $sql);
    $op = "";
    if($res)
    {
        while($data = mysqli_fetch_assoc($res))
        {
            if($data['available']==1)
            {
                $op .= "<div class='card'>
                            <div class='station-list'>
                                <div class='station-img'>
                                    <img id='station-img' src='assets/icons/evmark2.png'/>
                                </div>
                                <div class='station-details'>
                                    <h2 class='st-name'>{$data['stationname']}</h2>
                                    <p class='st-location'>{$data['location']}</p>
                                    <div class='square' id='{$data['stationid']}' onclick='display_slots({$data['stationid']})'>
                                        <i class='fa fa-caret-down' name='s{$data['stationid']}'></i>
                                    </div>
                                    <p class='txt' id='txt{$data['stationid']}' onclick='display_slots({$data['stationid']})'>Show Slots</p>
                                </div> 
                                <div class='station-act-deact'>
                                    <div class='avl-txt'>
                                        
                                        <div class='avl'>
                                            <p>Available</p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class='slot-list' id='slots{$data['stationid']}'></div>
                        </div>";
            }
            else if($data['available']==0)
            {
                $op .= "<div class='card'>
                            <div class='station-list'>
                                <div class='station-img'>
                                    <img id='station-img' src='assets/icons/evmark2.png'/>
                                </div>  
                                <div class='station-details'>
                                    <h2 class='st-name'>{$data['stationname']}</h2>
                                    <p class='st-location'>{$data['location']}</p>
                                    <div class='square' id='{$data['stationid']}' onclick='display_slots({$data['stationid']})'>
                                        <i class='fa fa-caret-down' name='s{$data['stationid']}'></i>
                                    </div>
                                    <p class='txt' id='txt{$data['stationid']}' class='{$data['stationid']}'  onclick='display_slots({$data['stationid']})'>Show Slots</p>
                                </div> 
                                <div class='station-act-deact'>
                                    <div class='unavl-txt'>
                                        
                                        <div class='unavl'>
                                            <p>Unavailable</p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class='slot-list' id='slots{$data['stationid']}'></div>
                        </div>";                
            }
        }
    }
    echo $op;
}

//Display searching result

if(isset($_POST['flag']) and $_POST['flag']=='searcharea')
{
    $z=$_POST["zone"];
    $c=$_POST["city"];
    $a=$_POST["area"];
    $sql = "SELECT * FROM `stationtb` WHERE `area`='{$a}' AND `zone`='{$z}' AND `city`='{$c}'";
    $res = mysqli_query($con, $sql);
    $op = "";
    if($res)
    {
        while($data = mysqli_fetch_assoc($res))
        {
            if($data['available']==1)
            {
                $op .= "<div class='card'>
                            <div class='station-list'>
                                <div class='station-img'>
                                    <img id='station-img' src='assets/icons/evmark2.png'/>
                                </div>
                                <div class='station-details'>
                                    <h2 class='st-name'>{$data['stationname']}</h2>
                                    <p class='st-location'>{$data['location']}</p>
                                    <div class='square' id='{$data['stationid']}' onclick='display_slots({$data['stationid']})'>
                                        <i class='fa fa-caret-down' name='s{$data['stationid']}'></i>
                                    </div>
                                    <p class='txt' id='txt{$data['stationid']}' onclick='display_slots({$data['stationid']})'>Show Slots</p>
                                </div> 
                                <div class='station-act-deact'>
                                    <div class='avl-txt'>
                                        
                                        <div class='avl'>
                                            <p>Available</p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class='slot-list' id='slots{$data['stationid']}'></div>
                        </div>";
            }
            else if($data['available']==0)
            {
                $op .= "<div class='card'>
                            <div class='station-list'>
                                <div class='station-img'>
                                    <img id='station-img' src='assets/icons/evmark2.png'/>
                                </div>  
                                <div class='station-details'>
                                    <h2 class='st-name'>{$data['stationname']}</h2>
                                    <p class='st-location'>{$data['location']}</p>
                                    <div class='square' id='{$data['stationid']}' onclick='display_slots({$data['stationid']})'>
                                        <i class='fa fa-caret-down' name='s{$data['stationid']}'></i>
                                    </div>
                                    <p class='txt' id='txt{$data['stationid']}' class='{$data['stationid']}'  onclick='display_slots({$data['stationid']})'>Show Slots</p>
                                </div> 
                                <div class='station-act-deact'>
                                    <div class='unavl-txt'>
                                        
                                        <div class='unavl'>
                                            <p>Unavailable</p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class='slot-list' id='slots{$data['stationid']}'></div>
                        </div>";                
            }
        }
    }
    echo $op;
}

//Find station (Show station)

if(isset($_GET['flag']) and $_GET['flag']=='showStation')
{
    $sql = "SELECT * FROM stationtb";
    $res = mysqli_query($con, $sql);
    $op = "";
    if($res)
    {
        while($data = mysqli_fetch_assoc($res))
        {
            if($data['available']==1)
            {
                $op .= "<div class='card'>
                            <div class='station-list'>
                                <div class='station-img'>
                                    <img id='station-img' src='assets/icons/evmark2.png'/>
                                </div>
                                <div class='station-details'>
                                    <h2 class='st-name'>{$data['stationname']}</h2>
                                    <p class='st-location'>{$data['location']}</p>
                                    <div class='square' id='{$data['stationid']}' onclick='display_slots({$data['stationid']})'>
                                        <i class='fa fa-caret-down' name='s{$data['stationid']}'></i>
                                    </div>
                                    <p class='txt' id='txt{$data['stationid']}' onclick='display_slots({$data['stationid']})'>Show Slots</p>
                                </div> 
                                <div class='station-act-deact'>
                                    <div class='avl-txt'>
                                        
                                        <div class='avl'>
                                            <p>Available</p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class='slot-list' id='slots{$data['stationid']}'></div>
                        </div>";
            }
            else if($data['available']==0)
            {
                $op .= "<div class='card'>
                            <div class='station-list'>
                                <div class='station-img'>
                                    <img id='station-img' src='assets/icons/evmark2.png'/>
                                </div>  
                                <div class='station-details'>
                                    <h2 class='st-name'>{$data['stationname']}</h2>
                                    <p class='st-location'>{$data['location']}</p>
                                    <div class='square' id='{$data['stationid']}'>
                                        <i class='fa fa-caret-down' name='s{$data['stationid']}'></i>
                                    </div>
                                    <p class='txt' id='txt{$data['stationid']}' class='{$data['stationid']}'>Show Slots</p>
                                </div> 
                                <div class='station-act-deact'>
                                    <div class='unavl-txt'>
                                        
                                        <div class='unavl'>
                                            <p>Unavailable</p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class='slot-list' id='slots{$data['stationid']}'></div>
                        </div>";                
            }
        }
    }
    echo $op;
}

//Show slots(Find station)

if(isset($_GET['flag']) and $_GET['flag']=='showSlots')
{
    $sid = $_GET['sid'];
    $sql = "SELECT * FROM slottb WHERE stationid = $sid";

    $res = mysqli_query($con, $sql);

    $op = '';
    $count = 1;
    if($res)
    {
        $op.="<div class='slot0'></div>";
        while($data = mysqli_fetch_assoc($res))
        {
            if($data['available'] == 1)
            {
                // $_SESSION['sid']=$data['slotid'];
                $op .= "<div class='slot$count'>
                    <div class='slot-data'>
                        <div class='slot-img'>
                            <img src='assets/icons/slotlogo2.png'>
                        </div>
                        <div class='slot-details'>
                            <div class='general-details'>
                                <h2>SL0{$data['slotid']}</h2>
                                <p>{$data['currenttype']} - {$data['voltage']} kW</p>
                            </div>
                            <div class='price-details'>
                                <div class='avlbl'>
                                    <div class='avlbl-txt'>
                                        <p>Available</p>
                                    </div>
                                </div>
                                <div class='price'>
                                    <h4>&#8377; {$data['price']} / unit</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='book-btn'>
                        <button id='{$data['slotid']}:{$sid}' onclick='showTimes(this.id)' name='bookslot'>Book</button>
                    </div>
                </div>"; 
            }
            else
            {
                $op .= "<div class='slot$count'>
                    <div class='slot-data'>
                        <div class='slot-img'>
                            <img src='assets/icons/slotlogo2.png'>
                        </div>
                        <div class='slot-details'>
                            <div class='general-details'>
                                <h2>SL0{$data['slotid']}</h2>
                                <p>{$data['currenttype']} - {$data['voltage']} kW</p>
                            </div>
                            <div class='price-details'>
                                <div class='unavlbl'>
                                    <div class='unavlbl-txt'>
                                        <p>Unavailable</p>
                                    </div>
                                </div>
                                <div class='price'>
                                    <h4>&#8377; {$data['price']} / unit</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='book-btn'>
                        <button id='{$data['slotid']}:{$sid}' onclick='showTimes(this.id)' disabled>Book</button>
                    </div>
                </div>"; 
            }
            $count++;
        }
        $op.="<div class='slot4'></div>";
    }
    echo $op;
}

//Add EV(Manage E-vehcile)

if (isset($_POST['flag']) and $_POST['flag'] == "addEV") {
    $uid=$_SESSION['userid'];
    $ename=$_POST['EVNAME'];
    $enumber=$_POST['EVNUMBER'];
    $sql="INSERT INTO vehicletb(`USERID`, `VEHICLENAME`, `VEHICLENUMBER`) VALUES('$uid','$ename','$enumber')";
    $res=mysqli_query($con,$sql);
    if($res){
        echo 1;
    }
}

//Display EV(Manage E-vehcile)

if(isset($_POST['flag']) and $_POST['flag']=='displayEV'){
    $uid = $_SESSION['userid'];
    $sql = "SELECT * FROM vehicletb WHERE USERID = $uid";
    $res = mysqli_query($con, $sql);
    $op="";
    if($res)
    {
        $count = 1;
        while($data = mysqli_fetch_assoc($res))
        {
            $op.="<div class='box' id='b{$data['VEHICLEID']}'>
                    <div class='displayvehicle'>
                        <div class='circle'>
                            <p class='counter'>$count.</p>
                        </div>
                        <p class='EVlabel'>Vehicle name:</p>
                        <p class='EVdata'>{$data['VEHICLENAME']}</p>
                        <p class='EVlabel'>Vehicle number:</p>
                        <p class='EVdata'>{$data['VEHICLENUMBER']}</p>
                        <div style='text-align:center;padding-top:10px;'>
                        <a class='bdelete' id='{$data['VEHICLEID']}'>
                            <i class='fa fa-trash' style='font-size:15px;color:white;padding-right:12px;'></i>
                        </a>
                        <a class='bupdate' id='{$data['VEHICLEID']}'>
                            <i class='fa fa-edit' style='font-size:15px;color:white;padding-left:12px;'></i>
                        </a>

                        </div>
                    </div>
                </div>";
            $count++;   
        }
        $op.="<div class='box inputbox'>
            <form method='POST' id='insertvehicle'>
                <input type='text' placeholder='Vehicle Name' class='vname' id='vname' name='vname'>
                <input type='text' placeholder='Vehicle Number' class='vnumber' id='vnumber' name='vnumber'>
                <input type='button' value='ADD' class='insertvehicle' onclick='insert_vehicle();'>
            </form>
        </div>
        <div class='plus-box b'>
            <button class='add_txt' onclick='display_form();'>+</button>
        </div>";
    }
    echo $op;
}
if(isset($_POST['flag']) and $_POST['flag']=='delEV')
{
$vid = $_POST['VID'];

$sql = "DELETE FROM vehicletb WHERE VEHICLEID = $vid";
$res = mysqli_query($con, $sql);
if($res)
{
    echo 1;
}
}

if(isset($_POST['flag']) and $_POST['flag']=='getEV')
{
$vid = $_POST['VID'];

$sql = "SELECT * FROM vehicletb WHERE VEHICLEID = $vid";
$res = mysqli_query($con, $sql);
if($res)
{
    $op = "";
    while($data = mysqli_fetch_assoc($res))
    {
        $op.="<div class='uinputbox'>
        <form method='POST' id='updatevehicle'>
            <input type='text' placeholder='Vehicle Name' class='vname' id='uvname' name='uvname' value='{$data["VEHICLENAME"]}'>
            <input type='text' placeholder='Vehicle Number' class='vnumber' id='uvnumber' name='uvnumber' value='{$data["VEHICLENUMBER"]}'>
            <input type='button' value='EDIT' class='updatevehicle' id='{$data["VEHICLEID"]}'>
        </form>
    </div>";
    echo $op;
    }
}
}

if(isset($_POST['flag']) and $_POST['flag'] == 'updateEV')
{
$vid = $_POST['VID'];
$vname = $_POST['vname'];
$vnum = $_POST['vnum'];

$sql = "UPDATE vehicletb SET VEHICLENAME = '$vname', VEHICLENUMBER = '$vnum' WHERE VEHICLEID = $vid";
$res = mysqli_query($con, $sql);
if($res)
{
    echo 1;
}
else
{
    echo 0;
}
}
if(isset($_POST['flag']) AND $_POST['flag']=="insertslot"){
        
    $stid=$_POST['sid'];
    $voltage=$_POST['vol'];
    $price=$_POST['price'];
    $ct=$_POST['curtype'];
    $ava=$_POST['ava'];
    $sql="INSERT INTO `slottb`(`stationid`, `voltage`, `price`, `currenttype`,`available`) VALUES ('{$stid}','{$voltage}','{$price}','{$ct}','{$ava}')";
    $res=mysqli_query($con,$sql);
    if($res){
        echo 1;
    }
}
if (isset($_POST['flag']) and $_POST['flag'] == "displaystcombo") {
    $sql = "SELECT * FROM stationtb";
    $res = mysqli_query($con, $sql);

    $op="<option value='' disabled selected hidden>Station name</option>";
    if(mysqli_num_rows($res)>0)
    {
        
        while($data = mysqli_fetch_assoc($res))
        {
            $op.="<option value='{$data['stationid']}'>{$data['stationname']}</option>";
        }
    }
    echo $op;
} 
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
    
    if(isset($_POST['flag']) AND $_POST['flag']=='displaystation'){
        $num_per_page=8;
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
        $output.="<table id='tbde'><tr><th>STATION NAME</th><th>LOCATION</th><th>AREA</th><th>ZONE</th><th>CITY</th><th>LATITUDE</th><th>LONGITUDE</th><th>AVAILABLE</th><th>DELETE</th><th>UPDATE</th></tr>";
        if(mysqli_num_rows($res)>0){
    
            while($data=mysqli_fetch_assoc($res)){
                $output.="<tr><td>{$data['stationname']}</td><td>{$data['location']}</td><td>{$data['area']}</td><td>{$data['zone']}</td><td>{$data['city']}</td><td>{$data['latitude']}</td><td>{$data['longitude']}</td><td>{$data['available']}</td><td><a href='#' class='deletedata' id='{$data['stationid']}'><i class='fa fa-trash-o' style='font-size:15px;color:black'></i></a></td><td><a href='#' class='updatedata' id='{$data['stationid']}'><i class='fa fa-edit' style='font-size:15px;color:black;'></i></a></td></tr>";
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
    if(isset($_POST['flag']) AND $_POST['flag']=='displayslot'){
        $num_per_page=7;
       $page="";
       if(isset($_POST["page_no"])){
        $page=$_POST["page_no"];
       }else{
         $page=1;
       }
       $offset=($page-1)*$num_per_page;

        $sql="SELECT st.stationname,sl.* FROM slottb sl,stationtb st WHERE st.stationid=sl.stationid LIMIT {$offset},{$num_per_page}";
        $res=mysqli_query($con,$sql);
        $output="";
        $output.="<table id='tbde'><tr><th>STATION NAME</th><th>VOLTAGE</th><th>PRICE</th><th>CURRENT TYPE</th><th>AVAILABLE</th><th>DELETE</th><th>UPDATE</th></tr>";
        if(mysqli_num_rows($res)>0){
    
            while($data=mysqli_fetch_assoc($res)){
                $output.="<tr><td>{$data['stationname']}</td><td>{$data['voltage']}</td><td>{$data['price']}</td><td>{$data['currenttype']}</td><td>{$data['available']}</td><td><a href='#' class='deleteslot' id='{$data['slotid']}'><i class='fa fa-trash-o' style='font-size:15px;color:black'></i></a></td><td><a href='#' class='updateslot' id='{$data['slotid']}'><i class='fa fa-edit' style='font-size:15px;color:black;'></i></a></td></tr>";
            }
            $output.="</table>";
        }
        $sql="SELECT * FROM slottb";
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
    if(isset($_POST['flag']) AND $_POST['flag']=='displayuser'){
        $num_per_page=10;
       $page="";
       if(isset($_POST["page_no"])){
        $page=$_POST["page_no"];
       }else{
         $page=1;
       }
       $offset=($page-1)*$num_per_page;

        $sql="SELECT * FROM usertb LIMIT {$offset},{$num_per_page}";
        $res=mysqli_query($con,$sql);
        $output="";
        $output.="<table id='tbde' ><tr><th>USER NAME</th><th>E-MAIL</th><th>PASSWORD</th><th>MOBILE NO</th><th>DELETE</th><th>UPDATE</th></tr>";
        if(mysqli_num_rows($res)>0){
    
            while($data=mysqli_fetch_assoc($res)){
                $output.="<tr><td>{$data['USERNAME']}</td><td>{$data['EMAIL']}</td><td>{$data['PASSWORD']}</td><td>{$data['MOBILENO']}</td><td><a href='#' class='deleteuser' id='{$data['USERID']}'><i class='fa fa-trash-o' style='font-size:15px;color:black'></i></a></td><td><a href='#' class='updateuser' id='{$data['USERID']}'><i class='fa fa-edit' style='font-size:15px;color:black;'></i></a></td></tr>";
            }
            $output.="</table>";
        }
        $sql="SELECT * FROM usertb";
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

    if(isset($_POST['flag']) AND $_POST['flag']=='displaybooking'){
        $num_per_page=10;
       $page="";
       if(isset($_POST["page_no"])){
        $page=$_POST["page_no"];
       }else{
         $page=1;
       }
       $offset=($page-1)*$num_per_page;
	$uid=$_SESSION['userid'];
    $sql="SELECT b.bookingid, v.vehiclenumber,st.location,b.date,b.time,s.slotid
    FROM bookingtb b,vehicletb v,stationtb st,slottb s where b.vehicleid = v.vehicleid and b.slotid=s.slotid and s.stationid=st.stationid and b.userid=$uid LIMIT {$offset},{$num_per_page}";
    // $sql="SELECT * FROM bookingtb WHERE userid=$uid LIMIT {$offset},{$num_per_page}";
        $res=mysqli_query($con,$sql);
        $output="";
        $output.="<table id='tbde'><tr><th>BOOKING ID</th><th>SLOT ID</th><th>VEHICLE NUMBER</th><th>STATION LOCATION</th><th>DATE</th><th>TIME</th><th>CANCEL</th><th>PRINT</th></tr>";
        if(mysqli_num_rows($res)>0){
    
            while($data=mysqli_fetch_assoc($res)){
                $output.="<tr><td>{$data['bookingid']}</td><td>{$data['slotid']}</td><td>{$data['vehiclenumber']}</td><td>{$data['location']}</td><td>{$data['date']}</td><td>{$data['time']}</td><td><a href='#' class='deletebooking' id='{$data['bookingid']}'><i class='fa fa-trash-o' style='font-size:15px;color:black'></i></a></td><td><a href='#' class='printbooking' id='{$data['bookingid']}'><i class='fa fa-print' style='font-size:15px;color:black'></i></a></td></tr>";
            }
            $output.="</table>";
        }
        // $sql="SELECT * FROM bookingtb WHERE userid=$uid";
        // $rs_result=mysqli_query($con,$sql);
        // $total_records=mysqli_num_rows($rs_result);
        // $total_pages=ceil($total_records/$num_per_page);
        // $output.="<div id='pagination'>";
        // for($i=1 ; $i<=$total_pages;$i++)
        // {
        //     $output.="<a class='active' id='{$i}' href=''>{$i}</a>";
        // }
        // $output.="</div>";
        echo $output;
    }
    if(isset($_POST['flag']) AND $_POST['flag']=='displayrecentbooking'){
        $num_per_page=10;
       $page="";
       if(isset($_POST["page_no"])){
        $page=$_POST["page_no"];
       }else{
         $page=1;
       }
       $offset=($page-1)*$num_per_page;
	$uid=$_SESSION['userid'];
    $sql="SELECT b.bookingid, v.vehiclenumber,st.location,b.date,b.time,s.slotid
    FROM recentbookingtb b,vehicletb v,stationtb st,slottb s where b.vehicleid = v.vehicleid and b.slotid=s.slotid and s.stationid=st.stationid and b.userid=$uid LIMIT {$offset},{$num_per_page}";
    // $sql="SELECT * FROM bookingtb WHERE userid=$uid LIMIT {$offset},{$num_per_page}";
        $res=mysqli_query($con,$sql);
        $output="";
        $output.="<table id='tbde'><tr><th>BOOKING ID</th><th>SLOT ID</th><th>VEHICLE NUMBER</th><th>STATION LOCATION</th><th>DATE</th><th>TIME</th><th>CANCEL</th><th>PRINT</th></tr>";
        if(mysqli_num_rows($res)>0){
    
            while($data=mysqli_fetch_assoc($res)){
                $output.="<tr><td>{$data['bookingid']}</td><td>{$data['slotid']}</td><td>{$data['vehiclenumber']}</td><td>{$data['location']}</td><td>{$data['date']}</td><td>{$data['time']}</td><td><a href='#' class='deletebooking' id='{$data['bookingid']}'><i class='fa fa-trash-o' style='font-size:15px;color:black'></i></a></td><td><a href='#' class='printbooking' id='{$data['bookingid']}'><i class='fa fa-print' style='font-size:15px;color:black'></i></a></td></tr>";
            }
            $output.="</table>";
        }
        // $sql="SELECT * FROM bookingtb WHERE userid=$uid";
        // $rs_result=mysqli_query($con,$sql);
        // $total_records=mysqli_num_rows($rs_result);
        // $total_pages=ceil($total_records/$num_per_page);
        // $output.="<div id='pagination'>";
        // for($i=1 ; $i<=$total_pages;$i++)
        // {
        //     $output.="<a class='active' id='{$i}' href=''>{$i}</a>";
        // }
        // $output.="</div>";
        echo $output;
    }

    if(isset($_POST['flag']) AND $_POST['flag']=='displaybookingadmin'){
        $num_per_page=10;
       $page="";
       if(isset($_POST["page_no"])){
        $page=$_POST["page_no"];
       }else{
         $page=1;
       }
       $offset=($page-1)*$num_per_page;
       $sql="SELECT b.bookingid, v.vehiclenumber,st.location,b.date,b.time,s.slotid
       FROM bookingtb b,vehicletb v,stationtb st,slottb s where b.vehicleid = v.vehicleid and b.slotid=s.slotid and s.stationid=st.stationid LIMIT {$offset},{$num_per_page}";
       // $sql="SELECT * FROM bookingtb WHERE userid=$uid LIMIT {$offset},{$num_per_page}";
           $res=mysqli_query($con,$sql);
           $output="";
           $output.="<table id='tbde'><tr><th>BOOKING ID</th><th>SLOT ID</th><th>VEHICLE NUMBER</th><th>STATION LOCATION</th><th>DATE</th><th>TIME</th><th>CANCEL</th></tr>";
           if(mysqli_num_rows($res)>0){
       
               while($data=mysqli_fetch_assoc($res)){
                   $output.="<tr><td>{$data['bookingid']}</td><td>{$data['slotid']}</td><td>{$data['vehiclenumber']}</td><td>{$data['location']}</td><td>{$data['date']}</td><td>{$data['time']}</td><td><a href='#' class='deleteadminbooking' id='{$data['bookingid']}'><i class='fa fa-trash-o' style='font-size:15px;color:black'></i></a></td></tr>";
               }
               $output.="</table>";
           }
        $sql="SELECT * FROM bookingtb";
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

    if(isset($_POST['flag']) AND $_POST['flag']=="insertstation"){
        
        $sname=$_POST['stname'];
        $sloc=$_POST['stloc'];
        $sarea=$_POST['starea'];
        $szone=$_POST['stzone'];
        $scity=$_POST['stcity'];
        $slat=$_POST['stlat'];
        $slon=$_POST['stlon'];
        $sava=$_POST['stava'];
        $sql="INSERT INTO `stationtb`(`stationname`, `location`,`area`, `zone`, `city`, `latitude`, `longitude`, `available`) VALUES('{$sname}','{$sloc}','{$sarea}','{$szone}','{$scity}','{$slat}','{$slon}','{$sava}')";
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
if(isset($_POST['flag']) AND $_POST['flag']=='deleteuser')
{
	$uid=$_POST['uid'];
	$sql="DELETE FROM usertb WHERE USERID='{$uid}'";
	$res=mysqli_query($con,$sql);
	if($res)
	{
		echo 1;
	}
}
if(isset($_POST['flag']) AND $_POST['flag']=='deletebooking')
{
	$bid=$_POST['bid'];
    $query = "SELECT slot_timeid FROM slot_timetb WHERE slotid = (SELECT slotid FROM bookingtb WHERE bookingid = '{$bid}') AND timeid = (SELECT timeid from timetb WHERE time = (SELECT time FROM bookingtb WHERE bookingid = '{$bid}')) AND date_id = (SELECT date_id FROM date_tb WHERE date = (SELECT date FROM bookingtb WHERE bookingid = '{$bid}'))";

    $result = mysqli_query($con, $query);
    if($result)
    {
        while($data = mysqli_fetch_assoc($result))
        {
            $sltid = $data['slot_timeid'];
            $sql = "UPDATE slot_timetb SET status = 1 WHERE slot_timeid = '{$sltid}'";
            $res=mysqli_query($con,$sql);
            if($res)
            {
                $sql2="DELETE FROM bookingtb WHERE bookingid='{$bid}'";
                $res2 = mysqli_query($con, $sql2);
        
                if($res2)
                {
                    echo 1;
                }
            }
        }
    }
}
if(isset($_POST['flag']) AND $_POST['flag']=='deleteadminbooking')
{
	$bid=$_POST['bid'];
	$sql="DELETE FROM bookingtb WHERE bookingid='{$bid}'";
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
    $sarea=$_POST['starea'];
    $szone=$_POST['stzone'];
    $scity=$_POST['stcity'];
    $slat=$_POST['stlat'];
    $slon=$_POST['stlon'];
    $sava=$_POST['stava'];
    $sid=$_POST['stid'];
	$sql="UPDATE `stationtb` SET `stationname`='{$sname}',`location`='{$sloc}',`area`='{$sarea}',`zone`='{$szone}',`city`='{$scity}',`latitude`='{$slat}',`longitude`='{$slon}',`available`='{$sava}' WHERE `stationid`='{$sid}'";
	$res=mysqli_query($con,$sql);
	if($res)
	{
		echo 1;
	}
}	


if(isset($_POST['flag']) AND $_POST['flag']=='deleteslot')
{
	$sid=$_POST['slid'];
	$sql="DELETE FROM `slottb` WHERE `slotid`='{$sid}'";
	$res=mysqli_query($con,$sql);
	if($res)
	{
		echo 1;
	}
}

if(isset($_POST['flag']) AND $_POST['flag']=='reflectslot')
{
	$sid=$_POST['slotid'];
	$sql="SELECT st.stationname,sl.* FROM slottb sl,stationtb st WHERE st.stationid=sl.stationid AND slotid='{$sid}'";
	$res=mysqli_query($con,$sql);
	if($res)
	{
		$data=mysqli_fetch_assoc($res);
		die(json_encode($data));
	}
} 
if(isset($_POST['flag']) AND $_POST['flag']=='updateslot')
{
	$stid=$_POST['sid'];
    $voltage=$_POST['vol'];
    $price=$_POST['price'];
    $ct=$_POST['curtype'];
    $ava=$_POST['ava'];
    $slotid=$_POST['slid'];
	$sql="UPDATE `slottb` SET `stationid`='{$stid}',`voltage`='{$voltage}',`price`='{$price}',`currenttype`='{$ct}',`available`='{$ava}' WHERE `slotid`='{$slotid}'";
	$res=mysqli_query($con,$sql);
	if($res)
	{
		echo 1;
	}
}	


// booking Marker Popup

if(isset($_GET["flag"]) AND $_GET["flag"]=="getSlots")
{
    $stid = $_GET["stid"];
    $content = "";
    $sql = "SELECT * FROM stationtb WHERE stationid = '{$stid}'";
    $res = mysqli_query($con, $sql);
    if($res)
    {
        while($data = mysqli_fetch_assoc($res))
        {
            if($data['available'] == 1)
            {
                $content .= "<div class='st-details'>
                    <div class='st-icon'>
                        <img src='images/evmark2.png'>
                    </div>
                    <div class='st-data'>
                        <div class='st-name'>
                            <h1>{$data['stationname']}</h1>
                        </div>
                        <div class='st-location'>
                            <p>{$data['location']}</p>
                        </div>
                    </div>
                    <div class='st-avl'>
                        <div class='circle'></div>
                        <h3>Available</h3>
                        <div class='close-btn'>
                            <p>+</p>
                        </div>
                    </div>
                </div>
                <hr>";
            }
            else if($data['available'] == 0)
            {
                $content .= "<div class='st-details'>
                    <div class='st-icon'>
                        <img src='images/evmark2.png'>
                    </div>
                    <div class='st-data'>
                        <div class='st-name'>
                            <h1>{$data['stationname']}</h1>
                        </div>
                        <div class='st-location'>
                            <p>{$data['location']}</p>
                        </div>
                    </div>
                    <div class='st-unavl'>
                        <div class='circle'></div>
                        <h3>Unavailable</h3>
                        <div class='close-btn'>
                            <p>+</p>
                        </div>
                    </div>
                </div>
                <hr>";
            }
        }
    }

    date_default_timezone_set('Asia/Kolkata');

    $dt = date('d-M-l');
    $dt2 = date('Y-m-d');
    $date = array();
    $date2 = array();
    for($i=0;$i<7;$i++)
    {
        $date[] = $dt;
        $date2[] = $dt2;

        $dt = DateTime::createFromFormat('d-M-l', $dt)
        ->add(new DateInterval('P1D'))->format('d-M-l');
        $dt2 = DateTime::createFromFormat('Y-m-d', $dt2)
        ->add(new DateInterval('P1D'))->format('Y-m-d');
    }

    $content .="
    <div class='week-details'>
        <div class='week-boxes'>";
        for($i = 0; $i<7; $i++)
        {
            if($i==0)
            {
                $content .= "<div class='days_value selected-date' name='{$date2[$i]}:{$stid}' id='day{$i}' onclick='changeBG(this.id); getDate(this);'>";
                setcookie('date', $date2[$i]);
            }
            else
            {
                $content .= "<div class='days_value' id='day{$i}' name='{$date2[$i]}:{$stid}' onclick='changeBG(this.id); getDate(this);'>";
            }
            $content .= "<label>".explode("-", $date[$i])[1]."</label>
            <h3>".explode("-", $date[$i])[0]."</h3>
            <label>".substr(explode("-", $date[$i])[2], 0, 3)."</label>
            </div>";
        }
    $content .="</div>
    </div>";

    $content .= "<div class='slot-details'>";
    $today = '';
    if(isset($_COOKIE['date']))
    {
        $today = $_COOKIE['date'];
    }

    $sql = "SELECT * FROM slottb WHERE stationid = '{$stid}'";
    $res = mysqli_query($con, $sql);
    $count = 1;
    if($res)
    {
        $rec = 1;
        while($data = mysqli_fetch_assoc($res))
        {

            if($data['available'] == 1)
            {
                if($count < 3)
                {
                    $content .= "
                    <form method='POST' id='slot-form{$count}' action='bookslot.php'>
                    <div class='slot{$count}'>
                        <div class='slot-data'>
                            <div class='slot-img'>
                                <img src='assets/icons/slotlogo2.png'>
                            </div>
                            <div class='slot-nm-dt'>
                                <h2>SL{$count}</h2>
                                <p>{$data['currenttype']} - {$data['voltage']}</p>
                                <h3>&#8377; 14 / unit</h3>
                            </div>
                            <div class='avl-circle'>
                                <div class='circle'></div>
                            </div>
                        </div>
                        <div class='slot-times'>";

                        $sql2 = "SELECT timetb.time AS `time`, slot_timetb.status AS `status` FROM timetb, slot_timetb WHERE timetb.timeid = slot_timetb.timeid AND slotid = {$data['slotid']} AND date_id = (SELECT date_id FROM date_tb WHERE date = '{$today}')";
                        
                        $res2 = mysqli_query($con, $sql2);

                        if($res2)
                        {
                            while($data2 = mysqli_fetch_assoc($res2))
                            {
                                $time = explode(":", $data2['time']);
                                if($time[0] >= 12)
                                {
                                    $time[1] .= " PM";
                                }
                                else
                                {
                                    $time[1] .= " AM";
                                }

                                if($data2['status']==2)
                                {
                                    $content .= "<div class='sl-time-inactive'>
                                    <input type='hidden' name='sl-id' value='{$data['slotid']}'>
                                    <input type='hidden' name='date' value='{$today}'>
                                    <input type='hidden' name='price' value='{$data['price']}'>
                                    <input type='radio' value='{$data2['time']}' name='time-value' class='time-value'>
                                    <h3>{$time[0]}:{$time[1]}</h3>
                                    </div>";
                                }
                                else if($data2['status']==1)
                                {
                                    $content .= "<div class='sl-time-active' id='time{$rec}' onclick='change_bg(this.id)'>
                                    <input type='hidden' name='sl-id' value='{$data['slotid']}'>
                                    <input type='hidden' name='date' value='{$today}'>
                                    <input type='hidden' name='price' value='{$data['price']}'>
                                    <input type='radio' value='{$data2['time']}' id='rbtime{$rec}' name='time-value' class='time-value'>
                                    <h3>{$time[0]}:{$time[1]}</h3>
                                    </div>";
                                    $rec++;
                                }     
                            }
                        }
                        $content .= "</div>
                            <div class='book-btn'>
                            <input type='button' value='Book' id='bookslotbtn{$count}' name='bookslotbtn' class='bookslotbtn' onclick='chkBtnStatus(this.id)'>
                            <input type='submit' value='Book' name='bookslot' id='bookslot{$count}' class='bookslot' hidden>
                            </div>
                        </div>
                    </form>
                    <hr>";
                }
                else
                {
                    $content .= "
                    <form method='POST' id='slot-form{$count}' action='bookslot.php'>
                    <div class='slot{$count}'>
                        <div class='slot-data'>
                            <div class='slot-img'>
                                <img src='assets/icons/slotlogo2.png'>
                            </div>
                            <div class='slot-nm-dt'>
                                <h2>SL{$count}</h2>
                                <p>{$data['currenttype']} - {$data['voltage']}</p>
                                <h3>&#8377; 14 / unit</h3>
                            </div>
                            <div class='avl-circle'>
                                <div class='circle'></div>
                            </div>
                        </div>
                        <div class='slot-times'>";

                        $sql2 = "SELECT timetb.time AS `time`, slot_timetb.status AS `status` FROM timetb, slot_timetb WHERE timetb.timeid = slot_timetb.timeid AND slotid = {$data['slotid']} AND date_id = (SELECT date_id FROM date_tb WHERE date = '{$today}')";
                        
                        $res2 = mysqli_query($con, $sql2);

                        if($res2)
                        {
                            while($data2 = mysqli_fetch_assoc($res2))
                            {
                                $time = explode(":", $data2['time']);
                                if($time[0] >= 12)
                                {
                                    $time[1] .= " PM";
                                }
                                else
                                {
                                    $time[1] .= " AM";
                                }

                                if($data2['status']==2)
                                {
                                    $content .= "<div class='sl-time-inactive'>
                                    <input type='hidden' name='sl-id' value='{$data['slotid']}'>
                                    <input type='hidden' name='date' value='{$today}'>
                                    <input type='hidden' name='price' value='{$data['price']}'>
                                    <input type='radio' value='{$data2['time']}' name='time-value' class='time-value'>
                                    <h3>{$time[0]}:{$time[1]}</h3>
                                    </div>";
                                }
                                else if($data2['status']==1)
                                {
                                    $content .= "<div class='sl-time-active' id='time{$rec}' onclick='change_bg(this.id)'>
                                    <input type='hidden' name='sl-id' value='{$data['slotid']}'>
                                    <input type='hidden' name='date' value='{$today}'>
                                    <input type='hidden' name='price' value='{$data['price']}'>
                                    <input type='radio' value='{$data2['time']}' id='rbtime{$rec}' name='time-value' class='time-value'>
                                    <h3>{$time[0]}:{$time[1]}</h3>
                                    </div>";
                                    $rec++;
                                }     
                            }
                        }
                        $content .= "</div>
                            <div class='book-btn'>
                            <input type='button' value='Book' id='bookslotbtn{$count}' name='bookslotbtn' class='bookslotbtn' onclick='chkBtnStatus(this.id)'>
                            <input type='submit' value='Book' name='bookslot' id='bookslot{$count}' class='bookslot' hidden>
                            </div>
                        </div>
                    </form>";
                }
            }
            else if($data['available'] == 0)
            {
                if($count < 3)
                {
                    $content .= "
                    <form method='POST' id='slot-form{$count}' action='bookslot.php'>
                        <div class='slot{$count}'>
                            <div class='slot-data'>
                                <div class='slot-img'>
                                    <img src='assets/icons/slotlogo2.png'>
                                </div>
                                <div class='slot-nm-dt'>
                                    <h2>SL{$count}</h2>
                                    <p>{$data['currenttype']} - {$data['voltage']}</p>
                                    <h3>&#8377; 14 / unit</h3>
                                </div>
                                <div class='unavl-circle'>
                                    <div class='circle'></div>
                                </div>
                            </div>
                            <div class='slot-times'>";

                            $sql2 = "SELECT timetb.time AS `time`, slot_timetb.status AS `status` FROM timetb, slot_timetb WHERE timetb.timeid = slot_timetb.timeid AND slotid = {$data['slotid']} AND date_id = (SELECT date_id FROM date_tb WHERE date = '{$today}')";

                            $res2 = mysqli_query($con, $sql2);

                            if($res2)
                            {
                                while($data2 = mysqli_fetch_assoc($res2))
                                {
                                    $time = explode(":", $data2['time']);
                                    if($time[0] >= 12)
                                    {
                                        $time[1] .= " PM";
                                    }
                                    else
                                    {
                                        $time[1] .= " AM";
                                    }

                                    $content .= "<div class='sl-time-unavlbl'>
                                        <input type='hidden' name='sl-id' value='{$data['slotid']}'>
                                        <input type='hidden' name='date' value='{$today}'>
                                        <input type='hidden' name='price' value='{$data['price']}'>
                                        <input type='radio' value='{$data2['time']}' name='time-value' class='time-value'>
                                        <h3>{$time[0]}:{$time[1]}</h3>
                                    </div>";
                                }
                            }
                        $content .= "</div>
                        <div class='book-btn'>
                            <input type='submit' value='Book' name='bookslot' disabled>
                        </div>
                    </div>
                    </form>
                    <hr>";
                }
                else
                {
                    $content .= "
                    <form method='POST' id='slot-form{$count}' action='bookslot.php'>
                    <div class='slot{$count}'>
                        <div class='slot-data'>
                            <div class='slot-img'>
                                <img src='assets/icons/slotlogo2.png'>
                            </div>
                            <div class='slot-nm-dt'>
                                <h2>SL{$count}</h2>
                                <p>{$data['currenttype']} - {$data['voltage']}</p>
                                <h3>&#8377; 14 / unit</h3>
                            </div>
                            <div class='unavl-circle'>
                                <div class='circle'></div>
                            </div>
                        </div>
                        <div class='slot-times'>";

                        $sql2 = "SELECT timetb.time AS `time`, slot_timetb.status AS `status` FROM timetb, slot_timetb WHERE timetb.timeid = slot_timetb.timeid AND slotid = {$data['slotid']} AND date_id = (SELECT date_id FROM date_tb WHERE date = '{$today}')";
                        
                        $res2 = mysqli_query($con, $sql2);

                        if($res2)
                        {
                            while($data2 = mysqli_fetch_assoc($res2))
                            {
                                $time = explode(":", $data2['time']);
                                if($time[0] >= 12)
                                {
                                    $time[1] .= " PM";
                                }
                                else
                                {
                                    $time[1] .= " AM";
                                }
                                    
                                $content .= "<div class='sl-time-inactive'>
                                <input type='hidden' name='sl-id' value='{$data['slotid']}'>
                                <input type='hidden' name='date' value='{$today}'>
                                <input type='hidden' name='price' value='{$data['price']}'>
                                <input type='radio' value='{$data2['time']}' name='time-value' class='time-value'>
                                <h3>{$time[0]}:{$time[1]}</h3>
                                </div>"; 
                            }
                        }
                        $content .= "</div>
                            <div class='book-btn'>
                                <input type='submit' value='Book' name='bookslot' disabled>
                            </div>
                        </div>
                    </form>";
                }                
            }
            $count++;
        }
    }
    $content .= "</div>";
    echo $content;
}
if(isset($_GET["flag"]) && $_GET["flag"]=="upstemp")
{
    date_default_timezone_set('Asia/Kolkata');
    $currtime = date('H:i:s');
    $currdate = date('Y:m:d');
    // echo $currtime;
    
    // if($currtime == '23:51:00')
    // {
    //     $sql = "UPDATE slot_timetb SET status = 1";
    //     $res = mysqli_query($con, $sql);
    //     if($res)
    //     {
    //         echo 1;
    //     }        
    // }
    
        $sql = "UPDATE slot_timetb SET status = 0 WHERE timeid IN (SELECT timeid FROM timetb WHERE time < '{$currtime}') AND date_id = (SELECT date_id from date_tb WHERE date = '{$currdate}')";
        $res = mysqli_query($con, $sql);
        if($res)
        {
            echo 1;
        }
}
if(isset($_GET["flag"]) && $_GET["flag"]=="upbooking")
{
    date_default_timezone_set('Asia/Kolkata');
    $currtime = date('H:i:s');
    $currdate = date('Y:m:d');
    // echo $currtime;
    // echo $currdate;
    // if($currtime == '23:51:00')
    // {
    //     $sql = "UPDATE slot_timetb SET status = 1";
    //     $res = mysqli_query($con, $sql);
    //     if($res)
    //     {
    //         echo 1;
    //     }        
    // }
    $sql="SELECT * FROM `bookingtb` WHERE `date`='{$currdate}' AND `time`<='{$currtime}'";
    $res= mysqli_query($con,$sql);
    
 if($res)
    {
        // echo 1;
        while($data=mysqli_fetch_assoc($res))
        {
           
                // echo 1;
        $sql2="DELETE FROM `bookingtb` WHERE `bookingid`={$data['bookingid']}";
        $res2=mysqli_query($con,$sql2);
     if($res2)
        {
            echo 1;   
        }
        }
    }
    // $sql="SELECT * FROM `bookingtb` WHERE `date`='{$currdate}' AND `time`>'{$currtime}'";
    // $res= mysqli_query($con,$sql);
    // echo $res;
    // if(mysqli_num_rows($res))
    // {
    //     while($data=mysqli_fetch_assoc($res))
    //     {
    //     $sql2="INSERT INTO `recentbookingtb`(`slotid`, `userid`, `vehicleid`, `date`, `time`, `duration`, `price`, `bookingid`) VALUES ('{$data['slotid']}','{$data['userid']}','{$data['vehicleid']}','{$data['date']}','{$data['time']}','{$data['duration']}','{$data['price']}','{$data['bookingid']}')";
    //     $res2=mysqli_query($con,$sql2);
    //     if($res2)
    //     {
    //         echo 1;
    //     }
    // }
    }
        // $sql = "UPDATE slot_timetb SET status = 0 WHERE timeid IN (SELECT timeid FROM timetb WHERE time < '{$currtime}') AND date_id = (SELECT date_id from date_tb WHERE date = '{$currdate}')";
        // $res = mysqli_query($con, $sql);
        // if($res)
        // {
        //     echo 1;
        // }
// }
if(isset($_GET['flag']) && $_GET['flag'] == "futslots")
{
    $nextday = $_GET['date'];
    $stid = $_GET['stid'];

    $query1 = "SELECT * FROM slottb WHERE stationid = '{$stid}'";
    $result1 = mysqli_query($con, $query1);
    $count = 1;

    $content = "";
    if($result1)
    {
        $rec = 1;
        while($data = mysqli_fetch_assoc($result1))
        {
            if($data['available'] == 1)
            {
                if($count < 3)
                {
                    $content .= "
                    <form method='POST' id='slot-form{$count}' action='bookslot.php'>
                    <div class='slot{$count}'>
                        <div class='slot-data'>
                            <div class='slot-img'>
                                <img src='assets/icons/slotlogo2.png'>
                            </div>
                            <div class='slot-nm-dt'>
                                <h2>SL{$count}</h2>
                                <p>{$data['currenttype']} - {$data['voltage']}</p>
                                <h3>&#8377; 14 / unit</h3>
                            </div>
                            <div class='avl-circle'>
                                <div class='circle'></div>
                            </div>
                        </div>
                        <div class='slot-times'>";

                        $sql2 = "SELECT timetb.time AS `time`, slot_timetb.status AS `status` FROM timetb, slot_timetb WHERE timetb.timeid = slot_timetb.timeid AND slotid = {$data['slotid']} AND date_id = (SELECT date_id FROM date_tb WHERE date = '{$nextday}')";
                      
                        $res2 = mysqli_query($con, $sql2);

                        if($res2)
                        {
                            while($data2 = mysqli_fetch_assoc($res2))
                            {
                                $time = explode(":", $data2['time']);
                                if($time[0] >= 12)
                                {
                                    $time[1] .= " PM";
                                }
                                else
                                {
                                    $time[1] .= " AM";
                                }

                                if($data2['status']==2)
                                {
                                    $content .= "<div class='sl-time-inactive'>
                                    <input type='hidden' name='sl-id' value='{$data['slotid']}'>
                                    <input type='hidden' name='date' value='{$nextday}'>
                                    <input type='hidden' name='price' value='{$data['price']}'>
                                    <input type='radio' value='{$data2['time']}' name='time-value' class='time-value'>
                                    <h3>{$time[0]}:{$time[1]}</h3>
                                    </div>";
                                }
                                else if($data2['status']==1)
                                {
                                    $content .= "<div class='sl-time-active' id='time{$rec}' onclick='change_bg(this.id)'>
                                    <input type='hidden' name='sl-id' value='{$data['slotid']}'>
                                    <input type='hidden' name='date' value='{$nextday}'>
                                    <input type='hidden' name='price' value='{$data['price']}'>
                                    <input type='radio' value='{$data2['time']}' id='rbtime{$rec}' name='time-value' class='time-value'>
                                    <h3>{$time[0]}:{$time[1]}</h3>
                                    </div>";
                                    $rec++;
                                }     
                            }
                        }
                        $content .= "</div>
                            <div class='book-btn'>
                            <input type='button' value='Book' id='bookslotbtn{$count}' name='bookslotbtn' class='bookslotbtn' onclick='chkBtnStatus(this.id)'>
                            <input type='submit' value='Book' name='bookslot' id='bookslot{$count}' class='bookslot' hidden>
                            </div>
                        </div>
                    </form>
                    <hr>";
                }
                else
                {
                    $content .= "
                    <form method='POST' id='slot-form{$count}' action='bookslot.php'>
                    <div class='slot{$count}'>
                        <div class='slot-data'>
                            <div class='slot-img'>
                                <img src='assets/icons/slotlogo2.png'>
                            </div>
                            <div class='slot-nm-dt'>
                                <h2>SL{$count}</h2>
                                <p>{$data['currenttype']} - {$data['voltage']}</p>
                                <h3>&#8377; 14 / unit</h3>
                            </div>
                            <div class='avl-circle'>
                                <div class='circle'></div>
                            </div>
                        </div>
                        <div class='slot-times'>";

                        $sql2 = "SELECT timetb.time AS `time`, slot_timetb.status AS `status` FROM timetb, slot_timetb WHERE timetb.timeid = slot_timetb.timeid AND slotid = {$data['slotid']} AND date_id = (SELECT date_id FROM date_tb WHERE date = '{$nextday}')";
                        
                        $res2 = mysqli_query($con, $sql2);

                        if($res2)
                        {
                            while($data2 = mysqli_fetch_assoc($res2))
                            {
                                $time = explode(":", $data2['time']);
                                if($time[0] >= 12)
                                {
                                    $time[1] .= " PM";
                                }
                                else
                                {
                                    $time[1] .= " AM";
                                }

                                if($data2['status']==2)
                                {
                                    $content .= "<div class='sl-time-inactive'>
                                    <input type='hidden' name='sl-id' value='{$data['slotid']}'>
                                    <input type='hidden' name='date' value='{$nextday}'>
                                    <input type='hidden' name='price' value='{$data['price']}'>
                                    <input type='radio' value='{$data2['time']}' name='time-value' class='time-value'>
                                    <h3>{$time[0]}:{$time[1]}</h3>
                                    </div>";
                                }
                                else if($data2['status']==1)
                                {
                                    $content .= "<div class='sl-time-active' id='time{$rec}' onclick='change_bg(this.id)'>
                                    <input type='hidden' name='sl-id' value='{$data['slotid']}'>
                                    <input type='hidden' name='date' value='{$nextday}'>
                                    <input type='hidden' name='price' value='{$data['price']}'>
                                    <input type='radio' value='{$data2['time']}' id='rbtime{$rec}' name='time-value' class='time-value'>
                                    <h3>{$time[0]}:{$time[1]}</h3>
                                    </div>";
                                    $rec++;
                                }     
                            }
                        }
                        $content .= "</div>
                            <div class='book-btn'>
                            <input type='button' value='Book' id='bookslotbtn{$count}' name='bookslotbtn' class='bookslotbtn' onclick='chkBtnStatus(this.id)'>
                            <input type='submit' value='Book' name='bookslot' id='bookslot{$count}' class='bookslot' hidden>
                            </div>
                        </div>
                    </form>";
                }
            }
            else if($data['available'] == 0)
            {
                if($count < 3)
                {
                    $content .= "
                    <form method='POST' id='slot-form{$count}' action='bookslot.php'>
                    <div class='slot{$count}'>
                        <div class='slot-data'>
                            <div class='slot-img'>
                                <img src='assets/icons/slotlogo2.png'>
                            </div>
                            <div class='slot-nm-dt'>
                                <h2>SL{$count}</h2>
                                <p>{$data['currenttype']} - {$data['voltage']}</p>
                                <h3>&#8377; 14 / unit</h3>
                            </div>
                            <div class='unavl-circle'>
                                <div class='circle'></div>
                            </div>
                        </div>
                        <div class='slot-times'>";

                        $sql2 = "SELECT timetb.time AS `time`, slot_timetb.status AS `status` FROM timetb, slot_timetb WHERE timetb.timeid = slot_timetb.timeid AND slotid = {$data['slotid']} AND date_id = (SELECT date_id FROM date_tb WHERE date = '{$nextday}')";
                        
                        $res2 = mysqli_query($con, $sql2);

                        if($res2)
                        {
                            while($data2 = mysqli_fetch_assoc($res2))
                            {
                                $time = explode(":", $data2['time']);
                                if($time[0] >= 12)
                                {
                                    $time[1] .= " PM";
                                }
                                else
                                {
                                    $time[1] .= " AM";
                                }

                                $content .= "<div class='sl-time-unavlbl'>
                                <input type='hidden' name='sl-id' value='{$data['slotid']}'>
                                <input type='hidden' name='date' value='{$nextday}'>
                                <input type='hidden' name='price' value='{$data['price']}'>
                                <input type='radio' value='{$data2['time']}' name='time-value' class='time-value'>
                                <h3>{$time[0]}:{$time[1]}</h3>
                                </div>";   
                            }
                        }
                        $content .= "</div>
                            <div class='book-btn'>
                                <input type='submit' value='Book' name='bookslot' disabled>
                            </div>
                        </div>
                    </form>
                    <hr>";
                }
                else
                {
                    $content .= "
                    <form method='POST' id='slot-form{$count}' action='bookslot.php'>
                    <div class='slot{$count}'>
                        <div class='slot-data'>
                            <div class='slot-img'>
                                <img src='assets/icons/slotlogo2.png'>
                            </div>
                            <div class='slot-nm-dt'>
                                <h2>SL{$count}</h2>
                                <p>{$data['currenttype']} - {$data['voltage']}</p>
                                <h3>&#8377; 14 / unit</h3>
                            </div>
                            <div class='unavl-circle'>
                                <div class='circle'></div>
                            </div>
                        </div>
                        <div class='slot-times'>";

                        $sql2 = "SELECT timetb.time AS `time`, slot_timetb.status AS `status` FROM timetb, slot_timetb WHERE timetb.timeid = slot_timetb.timeid AND slotid = {$data['slotid']} AND date_id = (SELECT date_id FROM date_tb WHERE date = '{$nextday}')";
                        
                        $res2 = mysqli_query($con, $sql2);

                        if($res2)
                        {
                            while($data2 = mysqli_fetch_assoc($res2))
                            {
                                $time = explode(":", $data2['time']);
                                if($time[0] >= 12)
                                {
                                    $time[1] .= " PM";
                                }
                                else
                                {
                                    $time[1] .= " AM";
                                }

                                $content .= "<div class='sl-time-unavlbl'>
                                <input type='hidden' name='sl-id' value='{$data['slotid']}'>
                                <input type='hidden' name='date' value='{$nextday}'>
                                <input type='hidden' name='price' value='{$data['price']}'>
                                <input type='radio' value='{$data2['time']}' name='time-value' class='time-value'>
                                <h3>{$time[0]}:{$time[1]}</h3>
                                </div>";   
                            }
                        }
                        $content .= "</div>
                            <div class='book-btn'>
                            <input type='submit' value='Book' name='bookslot' class='bookslot' disabled>
                            </div>
                        </div>
                    </form>";
                }                
            }
            $count++;
        }
    }
    echo $content;
}

if(isset($_GET['flag']) && $_GET['flag'] == "setDate")
{
    date_default_timezone_set('Asia/Kolkata');
    $currtime = date('H:i:s');

        date_default_timezone_set('Asia/Kolkata');
        $today = date('Y-m-d');
    
        for($i=1;$i<=7;$i++)
        { 
            $sql = "SELECT * FROM date_tb";
            $res = mysqli_query($con, $sql);
            $rows = mysqli_num_rows($res);
            if($rows<1)
            {
                $sql2 = "INSERT INTO date_tb(`date`) VALUES('{$today}')";
                $res2 = mysqli_query($con, $sql2);
                if($res2)
                {
                    echo "Date {$today} Added!!";
                }
            }
            else
            {
                $sql2 = "UPDATE date_tb SET date = '{$today}' WHERE date_id = {$i}";
                $res2 = mysqli_query($con, $sql2);
                if($res2)
                {
                    echo "Date {$today} Updatted!!";
                }            
            }
    
            $nextday = DateTime::createFromFormat('Y-m-d', $today)
            ->add(new DateInterval('P1D'))->format('Y-m-d');
            $today = $nextday;
        }
    // }
}


if(isset($_GET['flag']) && $_GET['flag']=="showTimes")
{
    $slid = $_GET['slid'];
    $stid = $_GET['stid'];
    $today = '';
    $content="";
    if(isset($_COOKIE['date']))
    {
        $today = $_COOKIE['date'];
    }
    date_default_timezone_set('Asia/Kolkata');

    $dt = date('d-M-l');
    $dt2 = date('Y-m-d');
    $date = array();
    $date2 = array();
    for($i=0;$i<7;$i++)
    {
        $date[] = $dt;
        $date2[] = $dt2;

        $dt = DateTime::createFromFormat('d-M-l', $dt)
        ->add(new DateInterval('P1D'))->format('d-M-l');
        $dt2 = DateTime::createFromFormat('Y-m-d', $dt2)
        ->add(new DateInterval('P1D'))->format('Y-m-d');
    }
    $content .="<div class='close-slot-btn' id='buttonc'><h2>+</h2></div>
        <div class='week-details'>
            <div class='week-boxes'>";
                for($i = 0; $i<7; $i++)
                {
                    if($i==0)
                    {
                        $content .= "<div class='days_value selected-date' name='{$date2[$i]}:{$slid}' id='day{$i}' onclick='changeBG(this.id); getDate(this);'>";
                        setcookie('date', $date2[$i]);
                    }
                    else
                    {
                        $content .= "<div class='days_value' id='day{$i}' name='{$date2[$i]}:{$slid}' onclick='changeBG(this.id); getDate(this);'>";
                    }
                    $content .= "<label>".explode("-", $date[$i])[1]."</label>
                    <h3>".explode("-", $date[$i])[0]."</h3>
                    <label>".substr(explode("-", $date[$i])[2], 0, 3)."</label>
                    </div>";
                }
            $content .="</div>
            </div>
            <hr>
            
            <div class='slot-time-data'>
            <form method='post' action='bookslot.php'>
            <div class='slot-times'>";
            $rec = 1;
            $price = 14;
            $sql2 = "SELECT timetb.time AS `time`, slot_timetb.status AS `status` FROM timetb, slot_timetb WHERE timetb.timeid = slot_timetb.timeid AND slotid = {$slid} AND date_id = (SELECT date_id FROM date_tb WHERE date = '{$today}')";
                        
            $res2 = mysqli_query($con, $sql2);

            if($res2)
            {
                    while($data2 = mysqli_fetch_assoc($res2))
                    {
                        $time = explode(":", $data2['time']);
                        if($time[0] >= 12)
                        {
                            $time[1] .= " PM";
                        }
                        else
                        {
                            $time[1] .= " AM";
                        }

                        if($data2['status']==2)
                        {
                            $content .= "<div class='sl-time-inactive'>
                            <input type='hidden' name='sl-id' value='{$slid}'>
                            <input type='hidden' name='date' value='{$today}'>
                            <input type='hidden' name='price' value='{$price}'>
                            <input type='radio' value='{$data2['time']}' name='time-value' class='time-value'>
                            <h3>{$time[0]}:{$time[1]}</h3>
                            </div>";
                        }
                        else if($data2['status']==1)
                        {
                            $content .= "<div class='sl-time-active' id='time{$rec}' onclick='change_bg(this.id)'>
                            <input type='hidden' name='sl-id' value='{$slid}'>
                            <input type='hidden' name='date' value='{$today}'>
                            <input type='hidden' name='price' value='{$price}'>
                            <input type='radio' value='{$data2['time']}' id='rbtime{$rec}' name='time-value' class='time-value'>
                            <h3>{$time[0]}:{$time[1]}</h3>
                            </div>";
                            $rec++;
                        }     
                    }
                }
                $content .= "</div>
                <div class='book-btn'>
                    <input type='button' value='Book' name='bookslotbtn' class='bookslotbtn'>
                    <input type='submit' value='Book' name='bookslot' class='bookslot' hidden>
                </div>
            </div>
            </form>
            </div>
        </div>
    ";
    echo $content;
}

if(isset($_GET['flag']) && $_GET['flag'] == "futureslots")
{
    $nextday = $_GET['date'];
    $slid = $_GET['slid'];

    $content = "";
    $rec = 1;
    $price = 14;
    $sql2 = "SELECT timetb.time AS `time`, slot_timetb.status AS `status` FROM timetb, slot_timetb WHERE timetb.timeid = slot_timetb.timeid AND slotid = {$slid} AND date_id = (SELECT date_id FROM date_tb WHERE date = '{$nextday}')";
                
    $res2 = mysqli_query($con, $sql2);

    if($res2)
    {
            while($data2 = mysqli_fetch_assoc($res2))
            {
                $time = explode(":", $data2['time']);
                if($time[0] >= 12)
                {
                    $time[1] .= " PM";
                }
                else
                {
                    $time[1] .= " AM";
                }

                if($data2['status']==2)
                {
                    $content .= "<div class='sl-time-inactive'>
                    <input type='hidden' name='sl-id' value='{$slid}'>
                    <input type='hidden' name='date' value='{$nextday}'>
                    <input type='hidden' name='price' value='{$price}'>
                    <input type='radio' value='{$data2['time']}' name='time-value' class='time-value'>
                    <h3>{$time[0]}:{$time[1]}</h3>
                    </div>";
                }
                else if($data2['status']==1)
                {
                    $content .= "<div class='sl-time-active' id='time{$rec}' onclick='change_bg(this.id)'>
                    <input type='hidden' name='sl-id' value='{$slid}'>
                    <input type='hidden' name='date' value='{$nextday}'>
                    <input type='hidden' name='price' value='{$price}'>
                    <input type='radio' value='{$data2['time']}' id='rbtime{$rec}' name='time-value' class='time-value'>
                    <h3>{$time[0]}:{$time[1]}</h3>
                    </div>";
                    $rec++;
                }     
            }
        }
        $content .= "</div>";
        echo $content;
}
// if (isset($_POST['flag']) and $_POST['flag'] == "fg") {

//     $email = $_POST['email'];
//     $sql="SELECT * FROM `usertb` WHERE `EMAIL`='{$email}'";
//     $res = mysqli_query($con, $sql);
//     if (mysqli_num_rows($res) > 0) {

//                 $mail = new PHPMailer(true);
//         $mail->isSMTP();
//         $mail->Host = 'smtp.gmail.com';
//         $mail->SMTPAuth = true;
//         $mail->Username = 'pateljesu1510@gmail.com';
//         $mail->Password = 'tsznognqtlrlivum';
//         $mail->SMTPSecure = "ssl";
//         $mail->Port = 465;
//         $mail->setFrom('pateljesu1510@gmail.com');
//         $mail->addAddress($email);
//         $mail->isHTML(true);
//         $otp = rand(100000, 999999); //generates random otp
//         $_SESSION['session_otp'] = $otp;
//         $message = "Your one time email verification code is : " . $otp;
//         $sub = "Reset Password OTP From bookMyEVslot";
        
//         $mail->Subject = $sub;
//         $mail->Body = $message;
//         $mail->send();
//         echo 1;
//     }
// }
//     if ($email == "") {
//         echo 2;
//     }
//     else
//     {
//         $mail = new PHPMailer(true);
//         $mail->isSMTP();
//         $mail->Host = 'smtp.gmail.com';
//         $mail->SMTPAuth = true;
//         $mail->Username = 'pateljesu1510@gmail.com';
//         $mail->Password = 'tsznognqtlrlivum';
//         $mail->SMTPSecure = "ssl";
//         $mail->Port = 465;
//         $mail->setFrom('pateljesu1510@gmail.com');
//         $mail->addAddress($email);
//         $mail->isHTML(true);
//         $otp = rand(100000, 999999); //generates random otp
//         $_SESSION['session_otp'] = $otp;
//         $message = "Your one time email verification code is : " . $otp;
//         $sub = "Reset Password OTP From bookMyEVslot";
        
//         $mail->Subject = $sub;
//         $mail->Body = $message;
//         $mail->send();
//         echo 1;
//     }
// }
//xor future
?>