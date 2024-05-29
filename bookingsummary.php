<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    session_start();
include 'conn.php';
$bid=$_GET['bid'];
$uid=$_SESSION['userid'];
    ?>
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bookslot.css">

</head>
<body>
<div class="main">
        <div class="box">
            <div class="booking-summary">
                <div class="booking-details">
                    <h2 id="bs">BOOKING SUMMARY</h2>

                    <table>
                        
                    <form method="post">
                    <?php
                            $sql = "SELECT b.bookingid, b.price,v.vehiclenumber,st.location,b.date,b.time,s.slotid
                            FROM bookingtb b,vehicletb v,stationtb st,slottb s where b.vehicleid = v.vehicleid and b.slotid=s.slotid and s.stationid=st.stationid and b.userid=$uid and b.bookingid=$bid";
                            $res = mysqli_query($con, $sql);
                            ?>
                            <?php
                            if($res)
                            {
                                while($data = mysqli_fetch_assoc($res))
                                {
                                    ?>
                                   <tr>
                                        <label> <td>Station : </td><td><?php echo $data['location']; ?></td> </label></tr>
                                        <tr><label><td> Slot : </td><td>SL<?php echo $data['slotid']; ?></td> </label></tr>
                                        <tr><label><td> Vehicle Number : </td><td><?php echo $data['vehiclenumber']; ?></td> </label></tr>
                                      

                                        <!-- <input type="hidden" name="vid" id="vid"> -->
                                        <tr>     <label> <td>Time : </td><td><?php echo $data['time']; ?> </td></label></tr>
                                        <tr>    <label> <td>Date : </td><td><?php echo $data['date']; ?> </td></label></tr>
                                        <tr>    <label> <td>Price :</td><td> &#8377; <?php echo $data['price'];?></td> </label></tr>
                                    <?php
                                }
                            }
                            
                        ?>
                       
                                        </form>
                        </table>
                </div>
                        </div>
                        </div>
            </div>
        
</body>
</html>