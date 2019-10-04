<?php
	session_start();
	if(empty($_SESSION['permission']))
	{
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - add new repair location</title>
</head>
<body>
<?php include('PHP/navbar.php'); ?>

	<?php

		$msg = "";
		if(isset($_POST['submit']))
		{
			include('PHP/connect.php');

			if(!empty($_POST['site_addr']))
			{
				$sql = "INSERT INTO `albedo_repair`.`repair_location` (`location_name`, `address`) VALUES ('".$_POST['site_name']."', '".$_POST['site_addr']."');";	
			} else {
				$sql = "INSERT INTO `albedo_repair`.`repair_location` (`location_name`) VALUES ('".$_POST['site_name']."');";
			}
			
			if(mysqli_query($conn, $sql) == true)
			{
				$msg = "New repair location is successfully added";
				echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "repair_location.php" </script>';
			} else {
				$msg = "Error: new repair location is not added";
				echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "repair_location.php" </script>';
			}

			mysqli_close($conn);
		}

	?>

	<?php
		if($_SESSION['permission']['add_repair_location'] == '1')
		{ ?>
		<button class="open-button btn btn-primary">Add Repair Location</button>
		<div class="form-popup myForm">
			<h1>Add a new repair location</h1>
			<form action="" method="post">
				<div class="row">
					<div class="form-group col-md-4">
						<input type="text" name="site_name" required="required" class="form-control" placeholder="Name">
					</div>
					<div class="form-group col-md-4"></div>
					<div class="form-group col-md-4"></div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<textarea name="site_addr" class="form-control" placeholder="Address"></textarea>
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
	<?php include('repair_location_table.php'); ?>
	<?php include('PHP/import.php'); ?>	

</body>
</html>

<?php
	exit;
?>