<?php 
	if(isset($_GET['submit'])){
session_start();
$_SESSION['fname']   = $_GET['city'];
   header('Location: http://localhost/tuts/');     
	}
 
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Enter City Name</h4>
		<form class="white" action="add.php" method="GET">
			
			<input type="text" name="city">
           
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>



</html>