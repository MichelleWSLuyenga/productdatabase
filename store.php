<?php 
      session_start();

      if(empty($_SESSION['permission']))
	  {
		 header('location: login.php');
	  }
      
      if(!empty($_SESSION['store']))
      {
        echo $_SESSION['store'];
        $_SESSION['store'] = "";
      }
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - add new department store</title>
</head>
<body>
	<?php include('PHP/navbar.php'); ?>
			
	
<!-- 	<?php

		// $msg = "";
		// if(isset($_POST['submit']))
		// {
		// 	include ('PHP/connect.php');

		// 	$sql = "INSERT INTO `albedo_repair`.`store` (`dept_name`) VALUES ('".$_POST['dept_name']."');";
		// 	if(mysqli_query($conn, $sql) == true)
		// 	{
		// 		$msg = "New department store is successfully added";
		// 		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "store.php" </script>';
		// 	} else {
		// 		$msg = "Error: new department store is not added";
		// 		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "store.php" </script>';
		// 	}
			
		// 	mysqli_close($conn);
		// }

	?> -->
	<?php
		if($_SESSION['permission']['add_store'] == '1')
		{ ?>
	<button class="open-button btn btn-primary">Add Department</button>
	<div class="form-popup myForm">
		<h1>Add department store</h1>
		<form action="add_store_Action.php" method="post">
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="dept_name" placeholder="Store Name" class="form-control" required="required">
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
	<?php include('store_table.php'); ?>
	<?php include('PHP/import.php'); ?>
</body>
</html>

<?php
	exit;
?>