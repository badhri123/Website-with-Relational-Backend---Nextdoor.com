<?php 
session_start();
//echo $_SESSION['blockid'];
require_once "config.php";

$username = $_SESSION['username'];

$memid = "SELECT mid from usertomember where username = '".$username."'";
$memid = mysqli_query($link,$memid);

$memid = mysqli_fetch_all($memid,MYSQLI_ASSOC);
$memid = $memid[0]['mid'];
// Block Request
$ftemp = "CALL Displayfriends('".$memid."')";
if($stmt = mysqli_prepare($link, $ftemp))
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



$sql = "SELECT mid,mname,maddress from membersliveat where mid<> (SELECT mid from usertomember where username = '".$username."') and mid not in (select id from friend_temptable) and hood = (select hood from usertomember join membersliveat on usertomember.mid = membersliveat.mid where username = '".$username."')";





$result = mysqli_query($link,$sql);

$result = mysqli_fetch_all($result,MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html>
<head>
	<?php include('templates/header.php'); ?>

	<section class="container">
		<h4 class="center">People in your Hood</h4>

	</section>

</head>


<body>
<table>
<tr>
<th>Member ID(Click to Send Friend request)</th>
<th>Member Name</th>
<th>Address</th>

</tr>
<?php

// output data of each row
foreach($result as $row) 
{
echo "<tr><td>" . '<a href="addfriend.php?id='.$row["mid"].'">'.$row["mid"].'</a>'
. "</td><td>" . $row["mname"] . "</td><td>"
. $row["maddress"]. "</td><td>".
"</tr>";
}
echo "</table>";


?>
     <p class="center">
  
        <a href="member.php" class="btn btn-danger">Go Back</a>
    </p>

        <p class="center">
  
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</table>
</body>
</html>




