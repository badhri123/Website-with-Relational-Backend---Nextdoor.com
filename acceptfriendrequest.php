<?php 
session_start();
require_once "config.php";
$var= $_SESSION['mid'];


// echo $var;
// echo $_SESSION['mid'];
  
// Inserting into user table
        // Prepare an insert statement
        $sql = "UPDATE friendrequest set acceptance = 'y' where (msend_id = '".$_SESSION['mid']."' AND  mrec_id=(select mid from usertomember where username='".$_SESSION['username']."')) ";
         
        if($stmt = mysqli_prepare($link, $sql))
        {


            if(mysqli_stmt_execute($stmt))
            {

            	// echo "Updated";
            }
            else
            {
                 echo  mysqli_stmt_error($stmt);
            }



         }  

         // For just name of the friend request sender
         $sql2 = "SELECT mname from members where mid = '".$_SESSION['mid']."' ";
         $result2 = mysqli_query($link,$sql2);

$result2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
	

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
<h3>You are now friends with <?php echo $result2[0]['mname']; ?>  !</h3>

    <p class="center">
  
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
        <p class="center">
  
        <a href="member.php" class="btn btn-danger">Go Back</a>
    </p>
</body>
</html>