<?php
	session_start();
	if(empty($_SESSION['permission']))
	{
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add employee</title>
</head>
<body>
<?php include('PHP/navbar.php'); ?>

	<?php
		$msg = "";
		if(isset($_POST['submit']))
		{
			include('PHP/connect.php');

			$sql = "INSERT INTO `albedo_repair`.`employee` (`emp_name`, `username`, `password`) VALUES ('".$_POST['emp_name']."', '".$_POST['emp_usrname']."', '".$_POST['emp_psswd']."');";
			if(mysqli_query($conn, $sql) == true)
			{
				$msg = "New employee is successfully added";
				echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "employee.php" </script>';
			} else {
				$msg = "Error: new employee is not added";
				echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "employee.php" </script>';
			}

			mysqli_close($conn);
		}

	?>

	<?php
		if($_SESSION['permission']['add_employee'] == '1')
		{ ?>
		<button class="open-button btn btn-primary">Add Employee</button>
		<div class="form-popup myForm">
			<h1>Add new employee</h1>
			<form action="" method="post">
				<div class="row">
					<div class="form-group col-md-4">
						<input type="text" name="emp_name" required="required" class="form-control" placeholder="Name">
					</div>
					<div class="form-group col-md-4"></div>
					<div class="form-group col-md-4"></div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<input type="text" name="emp_usrname" required="required" class="form-control" placeholder="Username">
					</div>
					<div class="form-group col-md-4"></div>
					<div class="form-group col-md-4"></div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<input type="password" name="emp_psswd" required="required" class="form-control" placeholder="Password">
					</div>
					<div class="form-group col-md-4"></div>
					<div class="form-group col-md-4"></div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<select name="role" class="form-control">
						</select>
					</div>
					<div class="form-group col-md-4"></div>
					<div class="form-group col-md-4"></div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
						<button type="submit" name="submit" class="btn btn-success">Add</button>
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
<!-- Table -->
<?php include('employee_table.php'); ?>

<?php include('PHP/import.php'); ?>	
</body>
</html>

<?php
	exit;
?>