<?php 
session_start();
//echo $_SESSION['blockid'];
require_once "config.php";

$mid = $_SESSION['mid'];

$result = "SELECT thread_iden,initial_msg from thread_visiblity join postthread on thread_visiblity.thread_iden = postthread.th_id where thread_visiblity.member_iden = '".$mid."' or postthread.author_id='".$mid."'";
$result =  mysqli_query($link,$result);
$result = mysqli_fetch_all($result,MYSQLI_ASSOC);


//print_r($result);

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
    <div class="left">
        <h5><u>Threads</u></h5>

<?php 
 foreach($result as $row) 
{
echo "<tr><td>" . '<a href="messages.php?thid='.$row["thread_iden"].'">'.$row["thread_iden"].". ".'</a>'
. "</td><td>" . $row["initial_msg"] . "</td><td>";

}

 ?>

    </div>

   



</section>






    <p class="center">
  
        <a href="createthread.php" class="btn btn-danger">Create a new Thread</a>
    </p>

    <p class="center">
  
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>