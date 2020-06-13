<?php 
session_start();
require_once "config.php";
$var= $_SESSION['uid'];



  
// Inserting into user table
        // Prepare an insert statement
        $sql = 'UPDATE requestblock set noofapprovals=noofapprovals+1 where uid='.$var;
         
        if($stmt = mysqli_prepare($link, $sql))
        {


            if(mysqli_stmt_execute($stmt))
            {

            	echo "Updated";
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
<h3>Accepted Successfully!</h3>

    <p class="center">
  
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
        <p class="center">
  
        <a href="member.php" class="btn btn-danger">Go Back</a>
    </p>
</body>
</html>