<?php

	include('PHP/connect.php');

	$msg = "";
	$sql = "UPDATE `albedo_repair`.`warranty` SET `warranty_desc` = '".$_POST['war_name']."' WHERE `warranty_id` = '".$_POST['war_id']."';";
	if(mysqli_query($conn, $sql) == true)
	{
		$msg = "Warranty information is updated";
		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "warranty.php";</script>';
	} else {
		$msg = "Error: cannot update warranty information";
		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "warranty.php";</script>';
	}

	mysqli_close($conn);
?>