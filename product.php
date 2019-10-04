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
	<title>ALBEDO - product</title>
</head>
<body>
	<?php include('PHP/navbar.php');
	
		$msg = "";
		$sql = "";
		if(isset($_POST['submit']))
		{
			$collection = substr($_POST['prod_code'], 2, 2);
			include ('PHP/connect.php');

			if(!empty($_POST['prod_size']))
			{
				$sql = "INSERT INTO `albedo_repair`.`product` (`item`, `detail`, `price`, `size`, `collection`) VALUES ('".$_POST['prod_code']."', '".$_POST['prod_name']."', '".$_POST['prod_price']."', '".$_POST['prod_size']."', '".$collection."');";
			} else {
				$sql = "INSERT INTO `albedo_repair`.`product` (`item`, `detail`, `price`, `collection`) VALUES ('".$_POST['prod_code']."', '".$_POST['prod_name']."', '".$_POST['prod_price']."', '".$collection."');";
			}
			
			if(mysqli_query($conn, $sql) == true)
			{
				$msg = "New product is added successfully";
				echo '<script language="javascript"> window.alert("'.$msg.'"); </script>';
			} else {
				$msg = "Error: cannot add product";
				echo("Error description: " . mysqli_error($conn));
				echo '<script language="javascript"> window.alert("'.$msg.'"); </script>';

			}

			mysqli_close($conn);
		}

	?>

	<?php
		if($_SESSION['permission']['add_product'] == '1')
		{ ?>
	<button class="open-button btn btn-primary">Add Product</button>
	<div class="form-popup myForm">
		<h1>Add product</h1>
		<form action="" method="post">
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="prod_code" required="required" class="form-control" placeholder="Product Code">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="prod_name" required="required" class="form-control" placeholder="Product Detail">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="prod_size" maxlength="3" class="form-control" placeholder="Size">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="number" name="prod_price" required="required" class="form-control" placeholder="Price">
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
	<?php include('product_table.php'); ?>
	<?php include('PHP/import.php') ?>	
</body>
</html>

<?php
	exit;
?>