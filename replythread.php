<?php 
session_start();
 require_once "config.php";
$var = $_SESSION['thid'];
  if(isset($_GET['post'])){


$title = $_GET['title'];
$textbody   = $_GET['textbody'];
$sql = "INSERT into messages values(".$var.",now(),'".$title."','".$textbody."','".$_SESSION['mid']."')";
         
        if($stmt = mysqli_prepare($link, $sql))
        {


            if(mysqli_stmt_execute($stmt))
            {

               //echo "Inserted";
            }
            else
            {
                 echo  mysqli_stmt_error($stmt);
            }



         }  
     
  }





$mid = $_SESSION['mid'];
//$_SESSION['thid'] = $var;
$sql_msg = "SELECT * FROM thread_visiblity join messages join members on (thread_visiblity.thread_iden = messages.threadid and messages.sent_id = members.mid) where messages.threadid =".$var." and thread_visiblity.member_iden ='".$_SESSION['mid']."'  order by messages.dateposted " ;

$record =  mysqli_query($link,$sql_msg);
$record = mysqli_fetch_all($record,MYSQLI_ASSOC)

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
<table>
<tr>
<th>Dateposted</th>
<th>Sender</th>
<th>Title</th>
<th>Textbody</th>

</tr>
<?php

// output data of each row
foreach($record as $row) 
{
echo "<tr><td>" .$row["dateposted"]
. "</td><td>" . $row["mname"] . "</td><td>"
. $row["title"]. "</td><td>".$row["textbody"]."</td><td>".
"</tr>";
}
echo "</table>";

?>
</table>


<section class="container grey-text">
    <h4 class="center">Type Title and Message</h4>
    <form class="white" action="replythread.php" method="GET">
      <label>Title</label>
      <input type="text" name="title">
       <label>Message</label>
      <input type="text" name="textbody">      
           
      <div class="center">
        <input type="submit" name="post" value="Post" class="btn btn-danger">
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