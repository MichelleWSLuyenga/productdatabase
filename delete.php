<?php
	include('PHP/connect.php');

		$sql = "";
		$location = "";

		if(!empty($_POST['war_id']))
		{
			$sql = "DELETE FROM `albedo_repair`.`warranty` WHERE `warranty_id` = '".$_POST['war_id']."';";
			$location = "warranty.php";
		}

		if(!empty($_POST['site_id']))
		{
			$sql = "DELETE FROM `albedo_repair`.`repair_location` WHERE `location_id` = '".$_POST['site_id']."';";
			$location = "repair_location.php";
		}

		if(!empty($_POST['store_id']))
		{
			$sql = "DELETE FROM `albedo_repair`.`store` WHERE `dept_id` = '".$_POST['store_id']."';";
			$location = "store.php";
		}

		if(!empty($_POST['prod_id']))
		{
			$sql = "DELETE FROM `albedo_repair`.`product` WHERE `item` = '".$_POST['prod_id']."';";
			$location = "product.php";
		}

		if(!empty($_POST['emp_id']))
		{
			$sql = "DELETE FROM `albedo_repair`.`employee` WHERE `emp_id` = '".$_POST['emp_id']."';";
			$location = "employee.php";
		}

		if(!empty($_POST['cust_id']))
		{
			$sql = "DELETE FROM `albedo_repair`.`customer` WHERE `cust_id` = '".$_POST['cust_id']."';";
			$location = "customer.php";
		}

		if(!empty($_POST['role_id']))
		{
			$sql = "DELETE FROM `albedo_repair`.`role` WHERE `role_id` = '".$_POST['role_id']."';";
			$location = "role.php";
		}

		if(mysqli_query($conn, $sql) == true)
			{
				echo '<script>window.alert("Successfully deleted"); window.location.href = "'.$location.'";</script>';
			} else {
				echo '<script>window.alert("Unsuccessful to delete"); window.location.href = "'.$location.'";</script>';
			}

	mysqli_close($conn)
?>