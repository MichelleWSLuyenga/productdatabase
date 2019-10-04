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
	<title>ALBEDO - Reair Order</title>
	<style>
		.fit 
		{
			white-space: nowrap;
			width: 1%;
			text-align: center;
		}
	</style>
</head>
<body onload="prod_selected(0);">
	<?php include('PHP/navbar.php'); ?>
	<?php
		if($_SESSION['permission']['add_repair_order'] == '1')
		{ ?>
	<button class="open-button btn btn-primary">Add Repair Order</button>
	<?php include('add_repair_order.php'); 
	}
	?>
	<?php 	include('repair_order_table.php');
			include('PHP/import.php'); 
	?>	
</body>
</html>

<?php
	exit;
?>