<?php 
session_start();
//echo $_SESSION['blockid']; 
require_once "config.php";
            $sql3 = "SELECT id from users_cred where username='".$_SESSION['username']."'" ;


             $result = mysqli_query($link,$sql3);
             $result2 = mysqli_fetch_all($result,MYSQLI_ASSOC);
            //print_r($result2);
             $param_uid=$result2[0]["id"];
$sql = "SELECT noofapprovals from requestblock WHERE uid = '".$param_uid."'";




$result = mysqli_query($link,$sql);

$result = mysqli_fetch_all($result,MYSQLI_ASSOC);

$result4 = $result[0]["noofapprovals"];
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
        <h5>Number of Approvals so far : <?php echo $result4; ?></h5>
         

    </div>

<?php if($result4>=3)
{
	 ?>
	     <p class="left">
  
        <a href="member.php" class="btn btn-danger">Go to your member homepage</a>
    </p>
    <?php 

}
?>


    <p class="left">
  
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>