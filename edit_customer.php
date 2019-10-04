<?php
	session_start();
	if(empty($_SESSION['permission']))
	{
		header('location: login.php');
	}
	elseif(empty($_POST['cust_id']))
	{
		header('location: customer.php');
	}
	elseif($_SESSION['permission']['edit_customer'] == '0')
	{ ?>
		<div class="col-md-12">
			<div class="row"><div class="col-md-4 col-md-offset-4 text-center"><h1 style="color:#d9534f;">Permission Denied !!</h1></div></div>
		<hr>
			<div class="row"><div class="col-md-6 col-md-offset-3 text-center"><p style="color:#d9534f;">You don't have permission to access <b>/edit_customer/</b> on this server.</p></div></div>
		</div>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<?php	
		die();
	} else {

		include('PHP/connect.php');

		$cust_id = $_POST['cust_id'];
		$sql = "SELECT * FROM `customer` WHERE `cust_id` = '".$cust_id."';";
		$customer = mysqli_query($conn, $sql);
		$cust_name = "";
		$cust_tel = "";

		while($row = mysqli_fetch_array($customer))
		{
			$cust_name = "$row[1]";
			$cust_tel = "$row[2]";
		}

		mysqli_close($conn);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - edit customer</title>
</head>
<body onload="color('')">
	<?php include('PHP/navbar.php'); ?>
	<div class="col-md-12">
		<h1>Edit customer  #<?php echo $cust_name; ?></h1>
		<form action="edit_customer_action.php" method="post" name="edit_cust" onsubmit="return validate();">
			<input type="text" name="cust_id" value="<?php echo $cust_id; ?>" style="display:none">
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="cust_name" class="form-control" placeholder="Name">
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(!empty($cust_name)){echo $cust_name;} ?></p>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="cust_tel" class="form-control" placeholder="Telephone Number">
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(!empty($cust_tel)){echo $cust_tel;} ?></p>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="submit" name="submit" value="Update" class="btn btn-success">
					<input type="button" name="back" value="Cancel" onclick="window.location.href = 'customer.php'" class="btn btn-danger">
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
		if(document.edit_cust.cust_name.value == "" && document.edit_cust.cust_tel.value == "")
		{
			alert( "At least one field is required" );
            document.edit_cust.cust_name.focus();
            return false;
		}
	}
</script>