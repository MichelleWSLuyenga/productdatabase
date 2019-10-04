<?php
	session_start();
	if(empty($_SESSION['permission']))
	{
		header('location: login.php');
	}
	elseif(empty($_POST['store_id']))
	{
		header('location: store.php');
	}
	elseif($_SESSION['permission']['edit_store'] == '0')
	{ ?>
		<div class="col-md-12">
			<div class="row"><div class="col-md-4 col-md-offset-4 text-center"><h1 style="color:#d9534f;">Permission Denied !!</h1></div></div>
		<hr>
			<div class="row"><div class="col-md-6 col-md-offset-3 text-center"><p style="color:#d9534f;">You don't have permission to access <b>/edit_store/</b> on this server.</p></div></div>
		</div>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<?php	
		die();
	} else {

		include('PHP/connect.php');

		$store_id = $_POST['store_id'];
		$sql = "SELECT * FROM `store` WHERE `dept_id` = '".$store_id."';";
		$dept_store = mysqli_query($conn, $sql);
		$store_name = "";
		while($row = mysqli_fetch_array($dept_store))
		{
			$store_name = "$row[1]";
		}

		mysqli_close($conn);
		
	}
?>

<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - edit department store</title>
</head>
<body>
	<?php include('PHP/navbar.php'); ?>
	<div class="col-md-12">
		<h1>Edit department store  #<?php echo $store_name; ?></h1>
		<form action="edit_store_action.php" method="post">
			<input type="text" name="store_id" value="<?php echo $store_id; ?>" style="display:none;" class="form-control">
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="dept_name" required="required" class="form-control" placeholder="New Name">
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($store_name)) {echo '<p class="badge badge-secondary">'.$store_name.'</p>'; } ?>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="submit" name="submit" value="Update" class="btn btn-success">
					<input type="button" name="back" value="Cancel" onclick="window.location.href = 'store.php'" class="btn btn-danger">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
		</form>
	</div>
	<?php include('PHP/import.php'); ?>
</body>
</html>