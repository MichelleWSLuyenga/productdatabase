<?php

	include('PHP/connect.php');

	$cust_id = $_POST['cust_id'];
	$msg = "";
	$sql = "";

	if(!empty($_POST['cust_name']))
	{
		$sql .= "UPDATE `albedo_repair`.`customer` SET `cust_name` = '".$_POST['cust_name']."' WHERE `cust_id` = '".$cust_id."'; ";
	}

	if(!empty($_POST['cust_tel']))
	{
		$sql .= "UPDATE `albedo_repair`.`customer` SET `tel` = '".$_POST['cust_tel']."' WHERE `cust_id` = '".$cust_id."'; ";
	}

	if(mysqli_multi_query($conn, $sql) == true)
	{
		$msg = "Customer information is updated";
		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "customer.php";</script>';
	} else {
		$msg = "Error: cannot update customer information";
		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "customer.php";</script>';
	}

	mysqli_close($conn);
?>