<?php

	include('PHP/connect.php');

	$msg = "";
	$sql = "";

	if(isset($_POST['submit']))
	{
		if(!empty($_POST['site_name']))
		{
			if(!empty($_POST['site_addr']))
			{
				$sql = "UPDATE `albedo_repair`.`repair_location` SET `location_name` = '".$_POST['site_name']."', `address` = '".$_POST['site_addr']."' WHERE (`location_id` = '".$_POST['site_id']."');";
			} else {
				$sql = "UPDATE `albedo_repair`.`repair_location` SET `location_name` = '".$_POST['site_name']."' WHERE (`location_id` = '".$_POST['site_id']."');";
			}
		} else {
			if(!empty($_POST['site_addr']))
			{
				$sql = "UPDATE `albedo_repair`.`repair_location` SET `address` = '".$_POST['site_addr']."' WHERE (`location_id` = '".$_POST['site_id']."');";
			}
		}
	
		if(mysqli_query($conn, $sql) == true)
		{
			$msg = "Repair location information is updated";
			echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href="repair_location.php";</script>';
		} else {
			$msg = "Error: cannot update information";
			echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href="repair_location.php";</script>';
		}
	}

	mysqli_close($conn);
	
?>