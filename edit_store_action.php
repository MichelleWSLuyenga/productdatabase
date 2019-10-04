<?php

	include('PHP/connect.php');

	$msg = "";
	$sql = "UPDATE `albedo_repair`.`store` SET `dept_name` = '".$_POST['dept_name']."' WHERE `dept_id` = '".$_POST['store_id']."';";
	if(mysqli_query($conn, $sql) == true)
	{
		$msg = "Department store information is updated";
		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "store.php";</script>';
	} else {
		$msg = "Error: cannot update information";
		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "store.php";</script>';
	}

	mysqli_close($conn);
?>