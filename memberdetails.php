<?php 
session_start();
 require_once "config.php";
	 if (isset($_GET['mid'])){
      //echo $_GET['id'];
      //echo 'Hello';
      $var = $_GET['mid'];
     
 } 

$_SESSION['mid'] = $var;

echo $_SESSION['mid'];
	


$sql = "SELECT uname,uprofile,ublockname from usertomember natural join users where mid=".$var;



$result = mysqli_query($link,$sql);

$result = mysqli_fetch_all($result,MYSQLI_ASSOC);


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
	<section class='center'>
<h3> Member Details </h3>
<h4> Member's Name : <?php print_r($result[0]['uname']); ?></h4>
<h4> Member's Profile : <?php print_r($result[0]['uprofile']); ?></h4>
<h4> Member's Blockname : <?php print_r($result[0]['ublockname']); ?></h4>
</section>



    <p class="center">
  
        <a href="acceptfriendrequest.php" class="btn btn-danger">Accept</a>
    </p>


    <p class="center">
  
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
        <p class="center">
  
        <a href="member.php" class="btn btn-danger">Go Back</a>
    </p>
</body>
</html>