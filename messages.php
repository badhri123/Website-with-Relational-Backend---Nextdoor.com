<?php 
session_start();
 require_once "config.php";
	 if (isset($_GET['thid'])){
      //echo $_GET['id'];
      //echo 'Hello';
      $var = $_GET['thid'];
      //echo $var;
     
 } 
$mid = $_SESSION['mid'];
$_SESSION['thid'] = $var;
$sql_msg = "SELECT * FROM thread_visiblity join messages join members on (thread_visiblity.thread_iden = messages.threadid and messages.sent_id = members.mid) where messages.threadid =".$var." and thread_visiblity.member_iden ='".$_SESSION['mid']."'  order by messages.dateposted " ;

$record =  mysqli_query($link,$sql_msg);
$record = mysqli_fetch_all($record,MYSQLI_ASSOC);
//print_r($record);

$sql_msg2 = "SELECT * FROM postthread join messages join members on (postthread.th_id = messages.threadid and messages.sent_id = members.mid) where messages.threadid ='".$var."' and postthread.author_id ='".$_SESSION['mid']."' order by messages.dateposted " ;

$record2=  mysqli_query($link,$sql_msg2);
$record2= mysqli_fetch_all($record2,MYSQLI_ASSOC);
//print_r($record2);

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

foreach($record2 as $row) 
{
echo "<tr><td>" .$row["th_id"]
. "</td><td>" . $row["mname"] . "</td><td>"
. $row["title"]. "</td><td>".$row["textbody"]."</td><td>".
"</tr>";
}
echo "</table>";


?>
</table>



    <p class="center">
  
        <a href="replythread.php" class="btn btn-danger">Reply</a>
    </p>





    <p class="center">
  
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>