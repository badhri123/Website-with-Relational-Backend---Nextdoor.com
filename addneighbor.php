<?php 
session_start();
//echo $_SESSION['blockid'];
require_once "config.php";

$username = $_SESSION['username'];

if (isset($_GET['id'])){
      //echo $_GET['id'];
      //echo 'Hello';
      $var = $_GET['id'];
 } 

$sqltemp = "SELECT mid,blockid from usertomember where username = '".$username."'";
$sqltemp =  mysqli_query($link,$sqltemp);
$sqltemp = mysqli_fetch_all($sqltemp,MYSQLI_ASSOC);
$blockid = $sqltemp[0]['blockid'];
$mem_id = $sqltemp[0]['mid'];

$sqltemp2 = "SELECT hood from blocks where blockid = '".$blockid."'";
$sqltemp2 =  mysqli_query($link,$sqltemp2);
$sqltemp2 = mysqli_fetch_all($sqltemp2,MYSQLI_ASSOC);
$hood = $sqltemp2[0]['hood'];



$sql = "INSERT into neighbors values('".$var."','".$mem_id."','".$hood."')";
         
        if($stmt = mysqli_prepare($link, $sql))
        {


            if(mysqli_stmt_execute($stmt))
            {

               echo "Inserted";
            }
            else
            {
                 echo  mysqli_stmt_error($stmt);
            }



         }  

 ?>

 <!DOCTYPE html>
<html>
<head>
	<?php include('templates/header.php'); ?>

	<section class="container">
		<h4 class="center">Added Successfully!</h4>


      <p class="center">
  
        <a href="neighbors_see.php" class="btn btn-danger">Go Back</a>
    </p>

        <p class="center">
  
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>
