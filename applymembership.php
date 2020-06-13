<?php
session_start();
echo $_SESSION["username"];
//echo $_SESSION['blockid']; 
$uname   = $_SESSION['uname']; 
$uphone  = $_SESSION['uphone'];
$ublockname = $_SESSION['ublockname'];
$uhoodname = $_SESSION['uhoodname'];
$uprofile = $_SESSION['uprofile'];
$blockid = $_SESSION['blockid'];


require_once "config.php";
// Inserting into user table
        // Prepare an insert statement
        $sql = "INSERT INTO users (uname, uphone,ublockname,uhoodname,uprofile) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql))
        {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_phone, $param_blockname, $param_hoodname, $param_profile);
            
            // Set parameters
            $param_name = $uname;
            $param_phone = $uphone;
            $param_blockname = $ublockname;
            $param_hoodname = $uhoodname;
            $param_profile = $uprofile;

            if(mysqli_stmt_execute($stmt))
            {
            	//$sql = "INSERT INTO requestblock (blockid, uid,receiveddate) VALUES (?, ?, now())";
            	//echo "First Insert Exceuted.";
            	
            }



         }

          $sql2 = "INSERT INTO requestblock (blockid, uid,receiveddate) VALUES (?, ?, now())";
         if($stmt2 = mysqli_prepare($link, $sql2))
           
           {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt2, "ss", $param_blockid, $param_uid);
            //Set Param
            $param_blockid = $blockid;
         //   $param_uid="SELECT uid from users where uid=(SELECT LAST_INSERT_ID())";
            $sql3 = "SELECT uid from users where uid=(SELECT LAST_INSERT_ID())" ;


             $result = mysqli_query($link,$sql3);
             $result2 = mysqli_fetch_all($result,MYSQLI_ASSOC);
            // print_r($result2[0]["uid"]);
             $param_uid=$result2[0]["uid"];


            if(mysqli_stmt_execute($stmt2))
            {
            	//echo "Second Insert Executed";
            }
            else
            {
            	echo  mysqli_stmt_error($stmt2);
            }




        }



 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
<!--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style> -->
        <?php include('templates/header.php'); ?>

</head>
<body>
    <div class="page-header">
        <h3>Applied Successfully,Please wait for Approval.</h3>


    </div>

<!--     <div class="center">
     <h5>Number of Approvals received : <?php  $result4; ?></h5>
     </div> -->
    <p class="center">
  
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>