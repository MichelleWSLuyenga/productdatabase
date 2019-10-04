<?php
	session_start();
	if(empty($_SESSION['permission']))
	{
		header('location: login.php');
	}
	elseif(empty($_POST['site_id']))
	{
		header('location: repair_location.php');
	}
	elseif($_SESSION['permission']['edit_repair_location'] == '0')
	{ ?>
		<div class="col-md-12">
			<div class="row"><div class="col-md-4 col-md-offset-4 text-center"><h1 style="color:#d9534f;">Permission Denied !!</h1></div></div>
		<hr>
			<div class="row"><div class="col-md-6 col-md-offset-3 text-center"><p style="color:#d9534f;">You don't have permission to access <b>/edit_repair_location/</b> on this server.</p></div></div>
		</div>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<?php	
		die();
	} else {

		include('PHP/connect.php');

		$site_id = $_POST['site_id'];
		$sql = "SELECT * FROM `repair_location` WHERE `location_id` = '".$site_id."';";
		$repair_location = mysqli_query($conn, $sql);
		$site_name = "";
		$site_addr = "";
		while($row = mysqli_fetch_array($repair_location))
		{
			$site_name = "$row[1]";
			$site_addr = "$row[2]";
		}

		mysqli_close($conn);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - edit repair location</title>
</head>
<body>
	<?php include('PHP/navbar.php'); ?>
	<div class="col-md-12">
		<h1>Edit repair location  #<?php echo $site_name; ?></h1>
		<form action="edit_repair_location_action.php" method="post" name="edit_rpl" onsubmit="return validate();">
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="site_id" value="<?php echo $site_id; ?>" style="display:none">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="site_name" class="form-control" placeholder="Name">
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(!empty($site_name)){echo $site_name;} ?></p>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<textarea name="site_addr" class="form-control" placeholder="Address"></textarea>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(!empty($site_addr)){echo $site_addr;} ?></p>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="submit" name="submit" value="Update" class="btn btn-success">
					<input type="button" name="back" value="Back" onclick="window.location.href = 'repair_location.php'" class="btn btn-danger">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
		</form>
	</div>
	<?php include('PHP/import.php'); ?>
</body>
</html>

<script language="javascript">
	function validate()
	{
		if(document.edit_rpl.site_name.value == "" && document.edit_rpl.site_addr.value == "")
		{
			alert( "At least one field is required" );
            document.edit_rpl.site_name.focus();
            return false;
		}
	}
</script>

<?php
	exit;
?>