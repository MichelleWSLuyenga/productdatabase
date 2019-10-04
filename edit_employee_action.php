<?php

	include('PHP/connect.php');

	$msg = "";
	$emp_id = $_POST['emp_id'];
	$sql = "";

	if(!empty($_POST['emp_name']))
	{
		$sql .= "UPDATE `albedo_repair`.`employee` SET `emp_name` = '".$_POST['emp_name']."' WHERE `emp_id` = '".$emp_id."'; ";
	}

	if(!empty($_POST['emp_username']))
	{
		$sql .= "UPDATE `albedo_repair`.`employee` SET `username` = '".$_POST['emp_username']."' WHERE `emp_id` = '".$emp_id."'; ";
	}

	if(!empty($_POST['emp_password']))
	{
		$sql .= "UPDATE `albedo_repair`.`employee` SET `password` = '".$_POST['emp_password']."' WHERE `emp_id` = '".$emp_id."'; ";
	}

	if(isset($_POST['emp_active']) && $_POST['emp_active'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`employee` SET `active` = '".$_POST['emp_active']."' WHERE `emp_id` = '".$emp_id."'; ";
	}

	if(mysqli_multi_query($conn, $sql) == true)
	{
		$msg = "Employee information is updated";
		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "employee.php";</script>';
	} else {
		$msg = "Error: cannot update information";
		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "employee.php";</script>';
	}

	mysqli_close($conn);
?>