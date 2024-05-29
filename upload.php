<?php
include 'conn.php';
session_start();
if(isset($_FILES['file']['name'])){

    $filename = $_FILES['file']['name'];
    $uid=$_SESSION['userid'];
   $location = "assets/uploads/".$filename;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);

    $valid_extensions = array("jpg","jpeg","png");

   $response = 0;
      if(in_array(strtolower($imageFileType), $valid_extensions)) {

       if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){

        $sql="INSERT INTO `profiletb`(`userid`, `picture`) VALUES ('$uid','$location')";
        $res=mysqli_query($con,$sql);
        
         $response = $location;
        
      }
   }

   echo $response;
   exit;
}

echo 0;