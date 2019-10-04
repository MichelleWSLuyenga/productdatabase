<?php
	session_start();
	if(empty($_SESSION['permission']))
	{
		header('location: login.php');
	}
	elseif(empty($_POST['war_id']))
	{
		header('location: warranty.php');
	}
	elseif($_SESSION['permission']['edit_warranty'] == '0')
	{ ?>
		<div class="col-md-12">
			<div class="row"><div class="col-md-4 col-md-offset-4 text-center"><h1 style="color:#d9534f;">Permission Denied !!</h1></div></div>
		<hr>
			<div class="row"><div class="col-md-6 col-md-offset-3 text-center"><p style="color:#d9534f;">You don't have permission to access <b>/edit_warranty/</b> on this server.</p></div></div>
		</div>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<?php	
		die();
	} else {

		include('PHP/connect.php');

		$war_id = $_POST['war_id'];
		$sql = "SELECT * FROM `warranty` WHERE `warranty_id` = '".$war_id."';";
		$warranty = mysqli_query($conn, $sql);
		$war = "";
		while($row = mysqli_fetch_array($warranty))
		{
			$war = "$row[1]";
		}
		mysqli_close($conn);
	}
?>
<!DOCTYPE html>
</html>
<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - edit warranty</title>
</head>
<body>
	<?php include('PHP/navbar.php'); ?>
	<div class="col-md-12">
		<h1>Edit warranty  #<?php echo $war; ?></h1>
		<form action="edit_warranty_action.php" method="post">
			<input type="text" name="war_id" value="<?php echo $war_id; ?>" style="display:none">
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="war_name" required="required" placeholder="New Name" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($war)) {echo '<p class="badge badge-secondary">'.$war.'</p>';} ?>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="submit" name="submit" value="Update" class="btn btn-success">
					<input type="button" name="back" value="Cancel" onclick="window.location.href = 'warranty.php'" class="btn btn-danger">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
		</form>
	</div>
	<?php include('PHP/import.php'); ?>
</body>
</html>