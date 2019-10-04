<?php 
	          session_start();

	          if(empty($_SESSION['permission']))
			  {
				 header('location: login.php');
			  }

	          if(!empty($_SESSION['war'])){
	            echo $_SESSION['war'];
	            $_SESSION['war'] = "";
	          }
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - warranty type</title>
</head>
<body>
	<?php include('PHP/navbar.php'); ?>
	<?php
		if($_SESSION['permission']['add_warranty'] == '1')
	{ ?>
	<button class="open-button btn btn-primary">Add Warranty Type</button>
	<div class="form-popup myForm">
		<h1>Add warranty type</h1>
		<form action="add_warranty_Action.php" method="post">
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="war_name" required="required" class="form-control" placeholder="Warranty Name">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<button type="submit" name="submit" class="btn btn-success">Add</button>
					<!-- <button id="repage" type="button" class="btn btn-danger">Cancel</button> -->
					<button type="reset" name="reset" class="btn btn-danger" onclick="closeForm()">Cancel</button>
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
		</form>
	</div>
	<?php 
	}
	?>
	<?php
		include('warranty_table.php');
		include('PHP/import.php'); 
	?>
</body>
</html>

<?php
	exit;
?>
	<!-- <?php

		// $msg = "";
		// if(isset($_POST['submit']))
		// {
		// 	include('PHP/connect.php');

		// 	$sql = "INSERT INTO `albedo_repair`.`warranty` (`warranty_desc`) VALUES ('".$_POST['war_name']."');";
		// 	if(mysqli_query($conn, $sql) == true)
		// 	{
		// 		$msg = "New warranty type is successfully created";
		// 		echo '<script language="javascript"> window.alert("'.$msg.'"); </script>';
		// 	} else {
		// 		$msg = "Error: new warranty type is not created";
		// 		echo '<script language="javascript"> window.alert("'.$msg.'"); </script>';
		// 	}

		// 	mysqli_close($conn);
		// }

	?> -->