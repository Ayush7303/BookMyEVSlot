<?php
include "conn.php";
session_start();
if(!isset($_SESSION['username'])){
    header("location:login-logout/login.php");
}
$time_value = $_POST['time-value'];
$slotid = $_POST['sl-id'];
$date = $_POST['date'];
$uid = $_SESSION['userid'];
$price = $_POST['price'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bookslot.css">
    <script src="assets/js/jQuery.js"></script>

    <script src="assets/js/bookslot.js"></script>

    <title>Booking Page</title>
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
                            $sql = "SELECT stationtb.stationid, stationtb.stationname, slottb.slotid FROM stationtb, slottb WHERE stationtb.stationid = slottb.stationid AND slottb.slotid = {$slotid}";
                            $res = mysqli_query($con, $sql);
                            ?>
                            <?php
                            if($res)
                            {
                                while($data = mysqli_fetch_assoc($res))
                                {
                                    ?>
                                   <tr>
                                        <label> <td>Station : </td><td><?php echo $data['stationname']; ?></td> </label></tr>
                                        <input type="hidden" name="stname" id="stname" value="<?php echo $data['stationname']; ?>">
                                        <tr><label><td> Slot : </td><td>SL<?php echo $data['slotid']; ?></td> </label></tr>
                                        <input type="hidden" name="slid" id="slid" value="<?php echo $data['slotid']; ?>">

                                        <tr><label><td> Select Vehicle : </td></label>
                                        <td><select name="vid" id="vid">
                        <option value="0"> --- SELECT VEHICLE --- </option>
                        <?php
                            $sql = "SELECT * FROM vehicletb WHERE USERID = {$uid}";
                            $res = mysqli_query($con, $sql);
                            ?>
                            <?php
                            if($res)
                            {
                                while($data = mysqli_fetch_assoc($res))
                                {
                                    ?>
                                        <option value="<?php echo $data['VEHICLEID'];?>"> <?php echo $data['VEHICLENAME']; ?> - <?php echo $data['VEHICLENUMBER']; ?> </option>
                                    <?php
                                }
                            }
                        ?>
                    </select></td></tr>


                                        <!-- <input type="hidden" name="vid" id="vid"> -->
                                        <tr>     <label> <td>Time : </td><td><?php echo $time_value; ?> </td></label></tr>
                                        <input type="hidden" name="time_value" id="time_value" value="<?php echo $time_value; ?>">
                                        <tr>    <label> <td>Date : </td><td><?php echo $date; ?> </td></label></tr>
                                        <input type="hidden" name="date" id="date" value="<?php echo $date; ?>">
                                        <tr>    <label> <td>Price :</td><td> &#8377; <?php echo $price*10; ?></td> </label></tr>
                                        <input type="hidden" name="price" id="totalamt" value="<?php echo $price; ?>">
                                        <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                                        <input type="hidden" name="uname" id="uname" value="<?php echo $_SESSION['username']; ?>">
                                        <tr><label><td><img src="captcha.php" alt="PHP Captcha"></img></td><td><input type="text" id="capt" placeholder="Enter Captcha"></td></label></tr>

                                    <?php
                                }
                            }
                        ?>
                        <!-- <input type="submit" value="PAY &#8377;<?php echo $price; ?>" hidden> -->
            <tr><td colspan=2><button class="btn btn-primary" id="rzp-button1">Pay</button></td></tr>
                    </form>
                        </table>
                </div>
                        </div>
                        </div>
            </div>
        
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">

          //get the input from the form
         function addbook(){
        var stname=$("#stname").val();
        var sid=$("#slid").val();
        var vid=$("#vid").val();
        var tv=$("#time_value").val();
        var dt=$("#date").val();
        var price=$("#totalamt").val();
        var uid=$("#uname").val();

        $.ajax({ 
            url: 'process_payment.php',
            'type': 'POST',
            'data': {'flag':'addbooking','stname':stname, 'vid':vid,'slid':sid,'time_value':tv,'date':dt,'price':price,'uid':uid},
            success:function(data){
                alert("Payment successfull and slot booked successfully.");
                window.location.href = 'index.php';
            }
        })
    }  
        //   sessionStorage.setItem("name",name);
        //   sessionStorage.setItem("amount",amount);
        //   sessionStorage.setItem("sid",sid);
        //   sessionStorage.setItem("vid",vid);
        //   sessionStorage.setItem("time",tv);
        //   sessionStorage.setItem("date",dt);
        //   sessionStorage.setItem("price",price);
        //   sessionStorage.setItem("uid",uid);
        // session['name']=name;
                            var temp=0;
        var name = $("#uname").val();
          var amount = $("#totalamt").val();
          var actual_amount = (amount*100);
        //   var description = $('#description').val();
          //var actual_amount = amount;
          var options = {
            "key": "rzp_test_MbcfHrpyk74VNy", // Enter the Key ID generated from the Dashboard
            "amount": actual_amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "INR",
            "name": name,
            "description": "Thank you",
            "image": "lg.png",
            //"order_id": "order_IluGWxBm9U8zJ8", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            "handler": function (response){
                console.log(response);
                $.ajax({
 
                    url: 'process_payment.php',
                    'type': 'POST',
                    'data': {'flag':'pay','payment_id':response.razorpay_payment_id,'amount':actual_amount,'name':name},
                    success:function(data){
                        
                        addbook();
                        console.log(data);
                    
// });
                    //   window.location.href = 'thank_you.php';
                    }
 
                });
                // alert(response.razorpay_payment_id);
                // alert(response.razorpay_order_id);
                // alert(response.razorpay_signature)
            },
             
        };
        var rzp1 = new Razorpay(options);
        rzp1.on('payment.failed', function (response){
                alert(response.error.code);
                alert(response.error.description);
                alert(response.error.source);
                alert(response.error.step);
                alert(response.error.reason);
                alert(response.error.metadata.order_id);
                alert(response.error.metadata.payment_id);
        });
        document.getElementById('rzp-button1').onclick = function(e){
            e.preventDefault();

            var capt=$("#capt").val();
             $.ajax({
 
            url: 'process_payment.php',
            'type': 'POST',
            'data': {'flag':'checkcaptcha','captcha':capt},
            success:function(data){
    //  alert(data);
                if(data==1)
                {
                    
                    rzp1.open();
                }
                else{
                    alert("Invalid Captcha.");
                }
            }
            });
            
    }

</script>