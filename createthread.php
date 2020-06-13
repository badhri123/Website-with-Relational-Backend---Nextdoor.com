

<?php 
session_start();
 require_once "config.php";
 $mid = $_SESSION['mid'];

  if(isset($_GET['Enter']))
  {


$receiver = $_GET['receiver'];
$initialmsg   = $_GET['initialmsg'];

$sql2 = "INSERT into threads(initial_msg) values ('".$initialmsg."')";
        if($stmt2 = mysqli_prepare($link, $sql2))
        {


            if(mysqli_stmt_execute($stmt2))
            {

               echo "Inserted";
            }
            else
            {
                 echo  mysqli_stmt_error($stmt2);
            }



         } 
$sql = "INSERT into postthread(author_id,receiver_id,date_created,initial_msg) values ('".$mid."','".$receiver."',now(),'".$initialmsg."')" ;
         
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

$thidup = "SELECT max(th_id) as mthid from postthread";
$thidup =  mysqli_query($link,$thidup);
$thidup = mysqli_fetch_all($thidup,MYSQLI_ASSOC);
print_r($thidup);
$thidup = $thidup[0]['mthid'];


$sql3 = "INSERT into messages (threadid,dateposted,title,textbody,sent_id) values ('".$thidup."',now(),'".$initialmsg."','".$initialmsg."','".$mid."')";
        if($stmt3 = mysqli_prepare($link, $sql3))
        {


            if(mysqli_stmt_execute($stmt3))
            {

               echo "Inserted";
            }
            else
            {
                 echo  mysqli_stmt_error($stmt3);
            }



         } 
     
  

  $sql4 = "CALL threadvisible()";
        if($stmt4 = mysqli_prepare($link, $sql4))
        {


            if(mysqli_stmt_execute($stmt4))
            {

               echo "Updated";
            }
            else
            {
                 echo  mysqli_stmt_error($stmt4);
            }



         } 
     
  }






// //$_SESSION['thid'] = $var;
// $sql_msg = "SELECT * FROM thread_visiblity join messages join members on (thread_visiblity.thread_id = messages.threadid and messages.sent_id = members.mid) where messages.threadid =".$var." and thread_visiblity.mem_id ='".$_SESSION['mid']."'  order by messages.dateposted " ;

// $record =  mysqli_query($link,$sql_msg);
// $record = mysqli_fetch_all($record,MYSQLI_ASSOC)

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




<section class="container grey-text">
    <h4 class="center">Create New Thread</h4>
    <form class="white" action="createthread.php" method="GET">
      <label>Recepients</label>
      <input type="text" name="receiver">
       <label>Initial Message</label>
      <input type="text" name="initialmsg">      
           
      <div class="center">
        <input type="submit" name="Enter" value="Post" class="btn btn-danger">
      </div>





      

    </form>
  </section>

      <p class="center">
  
        <a href="threads.php" class="btn btn-danger">Go Back</a>
    </p>

        <p class="center">
  
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    </body>
</html>