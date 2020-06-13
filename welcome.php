<?php
// Initialize the session
session_start();
require_once "config.php";
//echo $_SESSION["username"];
$sql2 = "SELECT noofapprovals from users_cred join requestblock on users_cred.id=requestblock.uid where username = '".$_SESSION['username']."'";



$result = mysqli_query($link,$sql2);

$result = mysqli_fetch_all($result,MYSQLI_ASSOC);
if(empty($result)) 
    $noofappr = 0;
else
{//print_r($result);
$noofappr = $result[0]['noofapprovals'];}


    if(isset($_POST['submit'])){
//echo "DEIIIIIIIIIIIIIIIIII";
 //session_start();
$_SESSION['uname']   = $_POST['uname'];
$_SESSION['uphone']   = $_POST['uphone'];
$_SESSION['ublockname']   = $_POST['ublockname'];
$_SESSION['uhoodname']   = $_POST['uhoodname'];
$_SESSION['uprofile']   = $_POST['uprofile'];
$_SESSION['blockid']   = $_POST['blockid'];
 header("location: applymembership.php");     
    }

 $sql2 = "SELECT blockid as blockno,blockname from blocks";
 $result2 = mysqli_query($link,$sql2);
//print_r($result2);

$result2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

    header("location: login.php");
    exit;
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
        <h3>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Nextdoor.</h3>
        <div class="center">
            <h4>Apply for Membership</h4>

            <form action="welcome.php" method="post">
            
                <label>Name</label>
                <input type="text" name="uname" class="form-control">
                
              
            
                <label>Phone Number</label>
                <input type="text" name="uphone" class="form-control">

                <label>Block Name</label>
                <input type="text" name="ublockname" class="form-control">

                <label>Hood Name</label>
                <input type="text" name="uhoodname" class="form-control">

                <label>Your Profile</label>
                <input type="text" name="uprofile" class="form-control">

                <label>Block Number</label>
                <input type="number" name="blockid" class="form-control">


                
            
            <div class="form-group">
                <input type="submit" name="submit" value="Submit">
            </div>
            
        </form>

        </div>

    </div>



    <?php 
    if($noofappr>=3)
    {  ?>
        <p class="center">
        <a href="member.php" class="btn btn-danger">Go to your Member Homepage</a>
        </p>
    <?php 

    }

 else{
    ?>
        <p class="center">
  
        <a href="approvals.php" class="btn btn-danger">If applied, See approvals</a>
        </p>
    <?php 
}
 ?>
    <p class="center">
  
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>