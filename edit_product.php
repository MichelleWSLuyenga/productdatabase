	<?php
		session_start();

		if(empty($_SESSION['permission']))
		{
			header('location: login.php');
		}
		elseif(empty($_POST['prod_id']))
		{
			header('location: store.php');
		}
		elseif($_SESSION['permission']['edit_product'] == '0')
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

	$prod_id = $_POST['prod_id'];
	$sql = "SELECT * FROM `product` WHERE `item` = '".$prod_id."';";
	$product = mysqli_query($conn, $sql);
	$prod_detail = "";
	$prod_price = "";
	$prod_size = "";
	$prod_col = "";
	while($row = mysqli_fetch_array($product))
	{
		$prod_detail = "$row[1]";
		$prod_price = "$row[2]";
		$prod_size = "$row[3]";
		$prod_col = "$row[4]";
	}

	mysqli_close($conn);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - edit product</title>
</head>
<body>
	<?php include('PHP/navbar.php'); ?>
	
	<div class="col-md-12">
		<h1>Edit product  #<?php echo $prod_id; ?></h1>
		<form action="edit_product_action.php" method="post" name="edit_prod" onsubmit="return validate();">
			<input type="text" name="prod_id" value="<?php echo $prod_id; ?>" style="display:none">
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="prod_item" class="form-control" placeholder="Product code">
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(!empty($prod_id)){echo $prod_id;} ?></p>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="prod_name" class="form-control" placeholder="Product Detail">
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(!empty($prod_detail)){echo $prod_detail;} ?></p>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="number" name="prod_price" class="form-control" placeholder="Price">
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(!empty($prod_price)){echo $prod_price;} ?></p>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="prod_size" maxlength="4" class="form-control" placeholder="Size">
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(!empty($prod_size)){echo $prod_size;} ?></p>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="prod_col" maxlength="2" class="form-control" placeholder="Collection">
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(!empty($prod_col)){echo $prod_col;} ?></p>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="submit" name="submit" value="Update" class="btn btn-success">
					<input type="button" name="back" value="Cancel" onclick="window.location.href = 'product.php'" class="btn btn-danger">
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
		if(document.edit_prod.prod_item.value == "" && document.edit_prod.prod_name.value == "" && document.edit_prod.prod_price.value == "" && document.edit_prod.prod_size.value == "" && document.edit_prod.prod_col.value == "")
		{
			alert( "At least one field is required" );
            document.edit_prod.prod_item.focus();
            return false;
		}
	}
</script>