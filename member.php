<?php 
session_start();
//echo $_SESSION['blockid'];
require_once "config.php";

$username = $_SESSION['username'];

// Block Request

$sql = "SELECT uid,uname from requestblock natural join users where uid != (SELECT id from users_cred where username='".$_SESSION['username']."')  AND  blockid=(select blockid from usertomember where username='".$_SESSION['username']."') AND noofapprovals<3";



$result = mysqli_query($link,$sql);

$result = mysqli_fetch_all($result,MYSQLI_ASSOC);

// Friend Request
$memid = "SELECT mid from usertomember where username = '".$username."'";
$memid = mysqli_query($link,$memid);

$memid = mysqli_fetch_all($memid,MYSQLI_ASSOC);

//print_r($memid);
$memid = $memid[0]['mid'];



$sql2 = "SELECT msend_id,mname from friendrequest join members on (friendrequest.msend_id = members.mid) where friendrequest.mrec_id = '".$memid."' and friendrequest.acceptance='n' ";



$result2 = mysqli_query($link,$sql2);
//print_r($result2);

$result2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);

//print_r($result2);
$idsql = "SELECT mid from usertomember where username ='".$_SESSION['username']."'";
$idres = mysqli_query($link,$idsql);
$idres = mysqli_fetch_all($idres,MYSQLI_ASSOC);
$idres = $idres[0]["mid"];
$_SESSION['mid'] = $idres;

//$records = mysqli_query($link,"CALL setup(".$idres.")");

// $sql_msg = "SELECT * FROM messages join members on messages.sent_id = members.mid 
// where (sent_id in ( select id from friend_temptable )
// or sent_id in (select id from neighbor_temptable) or sent_id in (select id from Hood_companion)) order by messages.dateposted limit 3" ;
$sql_msg = "SELECT * FROM thread_visiblity join messages join members on (thread_visiblity.thread_iden = messages.threadid and messages.sent_id = members.mid) where thread_visiblity.member_iden ='".$_SESSION['mid']."' order by messages.dateposted limit 3" ;

$record =  mysqli_query($link,$sql_msg);
$record = mysqli_fetch_all($record,MYSQLI_ASSOC);
//print_r($record);











//print_r($result2);
// $result4 = $result[0]["noofapprovals"];
//echo $_SESSION["username"];
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
        <h5><u>Member Approval Requests </u></h5>

<?php 
 foreach($result as $row) 
{
echo "<tr><td>" . '<a href="userdetails.php?uid='.$row["uid"].'">'.$row["uid"].". ".'</a>'
. "</td><td>" . $row["uname"] . "</td><td>";
}
 ?>

    </div>

    <div class="right">

<h5><u>Friend Requests</u></h5>
<?php 
 foreach($result2 as $row2) 
{
echo "<tr><td>" . '<a href="memberdetails.php?mid='.$row2["msend_id"].'">'.$row2["msend_id"].". ".'</a>'
. "</td><td>" . $row2["mname"] . "</td><td>";
}
 ?>


    </div>


<section class="center">
    
<h5><u>Recent Messages</u></h5>
<table>
<tr>
<th>Date Posted</th>
<th>Sender</th>
<th>Title</th>
<th>Message</th>

</tr>
<?php

// output data of each row
foreach($record as $row) 
{
echo "<tr><td>".$row["dateposted"]
. "</td><td>" .  $row["mname"] . "</td><td>". $row["title"] . "</td><td>"
. $row["textbody"]. "</td><td>".
"</tr>";
}
echo "</table>";


?>

</section>

    <p class="center">
  
        <a href="threads.php" class="btn btn-danger">See all Messages</a>
    </p>



    <p class="center">
  
        <a href="neighbors_see.php" class="btn btn-danger">Add Neighbors</a>
    </p>

        <p class="center">
  
        <a href="friends_see.php" class="btn btn-danger">Add Friends</a>
    </p>



    <p class="center">
  
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>