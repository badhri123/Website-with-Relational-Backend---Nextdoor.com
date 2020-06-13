
<?php
if (isset($_GET['id'])){
      //echo $_GET['id'];
      //echo 'Hello';
      $var = $_GET['id'];
 } 
 $conn = mysqli_connect('localhost','badhri','Apsps6207e@','weather_station');

if(!$conn)
{
echo 'Connection error:' . mysqli_connect_error();
}

 $sql = 'SELECT * FROM  measurement WHERE sid='.$var  ;


$result = mysqli_query($conn,$sql);

$stations = mysqli_fetch_all($result,MYSQLI_ASSOC);
 
//print_r($stations);





?>

<!DOCTYPE html>
<html>
<head>
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Measurement in Station ID -<?php echo $var ?></h4>

	</section>

<style>
table {
border-collapse: collapse;
width: 100%;
color: #cbb09c;
font-family: monospace;
font-size: 25px;
text-align: center;
}
th {
background-color: #cbb09c;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>


<body>
<table>
<tr>
<th>Station ID</th>
<th>Temperature</th>
<th>Precipitation</th>
<th>Humidity</th>
<th>Time</th>
</tr>
<?php

// output data of each row
foreach($stations as $row) 
{
echo "<tr><td>" . '<a href="final.php?id='.$row["sid"].'">'.$row["sid"].'</a>'
. "</td><td>" . $row["mtemp"] . "</td><td>"
. $row["mpriecip"]. "</td><td>".$row["mhumid"]."</td><td>".$row["mtimestamp"].
"</tr>";
}
echo "</table>";

$conn->close();
?>
</table>
</body>
</html>

<?php 	mysqli_free_result($result);

 ?>


