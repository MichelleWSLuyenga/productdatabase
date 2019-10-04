<?php
	session_start();
	if(empty($_SESSION['permission']))
	{
		header('location: login.php');
	}
	elseif(empty($_POST['emp_id']))
	{
		header('location: employee.php');
	}
	elseif($_SESSION['permission']['edit_employee'] == '0')
	{ ?>
		<div class="col-md-12">
			<div class="row"><div class="col-md-4 col-md-offset-4 text-center"><h1 style="color:#d9534f;">Permission Denied !!</h1></div></div>
		<hr>
			<div class="row"><div class="col-md-6 col-md-offset-3 text-center"><p style="color:#d9534f;">You don't have permission to access <b>/edit_employee/</b> on this server.</p></div></div>
		</div>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<?php	
		die();
	} else {

		include('PHP/connect.php');

		$emp_id = $_POST['emp_id'];
		$sql = "SELECT * FROM `employee` WHERE `emp_id` = '".$emp_id."';";
		$employee = mysqli_query($conn, $sql);
		$emp_name = "";
		$emp_username = "";
		$emp_password = "";

		$emp_active = "";
		while($row = mysqli_fetch_array($employee))
		{
			$emp_name = "$row[1]";
			$emp_username = "$row[2]";
			$emp_password = "$row[3]";
			$emp_active = "$row[5]";
		}

		mysqli_close($conn);
	}
?>

<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - edit employee</title>
	<script language="javascript">
		function color(value)
	{
		if(value == "")
		{
			document.edit_emp.emp_active.style.color = "#8e8e8e";
		} else {
			document.edit_emp.emp_active.style.color = "#555";
		}
	}
	</script>
</head>
<body onload="color('')">
	<?php include('PHP/navbar.php') ?>
	<div class="col-md-12">
		<h1>Edit employee  #<?php echo $emp_name; ?></h1>
		<form action="edit_employee_action.php" method="post" name="edit_emp" onsubmit="return validate();">
			<input type="text" name="emp_id" value="<?php echo $emp_id; ?>" style="display:none">
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="emp_name" class="form-control" placeholder="Name">
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(!empty($emp_name)){echo $emp_name;} ?></p>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="emp_username" class="form-control" placeholder="Username">
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(!empty($emp_username)){echo $emp_username;} ?></p>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="password" name="emp_password" class="form-control" placeholder="Password">
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(!empty($emp_password)){for($i=0; $i<=strlen($emp_password); $i++) {echo '* ';}} ?></p>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<select name="emp_active" class="form-control" onchange="color(this.selectedIndex.value)">
						<option selected="selected" disabled="disabled" value="">Active Status</option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(isset($emp_active)){if ($emp_active == '1') {echo 'Yes';} if($emp_active == '0') {echo 'No';}} ?></p>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="submit" name="submit" value="Update" class="btn btn-success">
					<input type="button" name="back" value="Cancel" onclick="window.location.href = 'employee.php'" class="btn btn-danger">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
		</form>
	</div>
	<?php include('PHP/import.php') ?>
</body>
</html>

<script language="javascript">
	function validate()
	{
		if(document.edit_emp.emp_name.value == "" && document.edit_emp.emp_username.value == "" && document.edit_emp.emp_password.value == "" && document.edit_emp.emp_active.value == "")
		{
			alert( "At least one field is required" );
            document.edit_emp.emp_name.focus();
            return false;
		}
	}
</script>

<?php
	exit;
?>