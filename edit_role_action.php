<?php

	include('PHP/connect.php');

	$msg = "";
	$role_id = $_POST['role_id'];
	$sql = "";

	if(isset($_POST['add_rpo']) && $_POST['add_rpo'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `add_repair_order` = '".$_POST['add_rpo']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['update_rpo']) && $_POST['update_rpo'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `update_repair_order` = '".$_POST['update_rpo']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['edit_rpo']) && $_POST['edit_rpo'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `edit_repair_order` = '".$_POST['edit_rpo']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['delete_rpo']) && $_POST['delete_rpo'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `delete_repair_order` = '".$_POST['delete_rpo']."' WHERE `role_id` = '".$role_id."'; ";
	}


	if(isset($_POST['add_prod']) && $_POST['add_prod'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `add_product` = '".$_POST['add_prod']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['edit_prod']) && $_POST['edit_prod'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `edit_product` = '".$_POST['edit_prod']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['delete_prod']) && $_POST['delete_prod'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `delete_product` = '".$_POST['delete_prod']."' WHERE `role_id` = '".$role_id."'; ";
	}


	if(isset($_POST['add_store']) && $_POST['add_store'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `add_store` = '".$_POST['add_store']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['edit_store']) && $_POST['edit_store'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `edit_store` = '".$_POST['edit_store']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['delete_store']) && $_POST['delete_store'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `delete_store` = '".$_POST['delete_store']."' WHERE `role_id` = '".$role_id."'; ";
	}


	if(isset($_POST['add_repair_location']) && $_POST['add_repair_location'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `add_repair_location` = '".$_POST['add_repair_location']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['edit_repair_location']) && $_POST['edit_repair_location'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `edit_repair_location` = '".$_POST['edit_repair_location']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['delete_repair_location']) && $_POST['delete_repair_location'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `delete_repair_location` = '".$_POST['delete_repair_location']."' WHERE `role_id` = '".$role_id."'; ";
	}


	if(isset($_POST['add_warranty']) && $_POST['add_warranty'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `add_warranty` = '".$_POST['add_warranty']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['edit_warranty']) && $_POST['edit_warranty'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `edit_warranty` = '".$_POST['edit_warranty']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['delete_warranty']) && $_POST['delete_warranty'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `delete_warranty` = '".$_POST['delete_warranty']."' WHERE `role_id` = '".$role_id."'; ";
	}


	if(isset($_POST['add_customer']) && $_POST['add_customer'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `add_customer` = '".$_POST['add_customer']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['edit_customer']) && $_POST['edit_customer'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `edit_customer` = '".$_POST['edit_customer']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['delete_customer']) && $_POST['delete_customer'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `delete_customer` = '".$_POST['delete_customer']."' WHERE `role_id` = '".$role_id."'; ";
	}


	if(isset($_POST['add_employee']) && $_POST['add_employee'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `add_employee` = '".$_POST['add_employee']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['edit_employee']) && $_POST['edit_employee'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `edit_employee` = '".$_POST['edit_employee']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['delete_employee']) && $_POST['delete_employee'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `delete_employee` = '".$_POST['delete_employee']."' WHERE `role_id` = '".$role_id."'; ";
	}


	if(isset($_POST['master']) && $_POST['master'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `view_master_repair` = '".$_POST['master']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['location']) && $_POST['location'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `view_report` = '".$_POST['location']."' WHERE `role_id` = '".$role_id."'; ";
	}
	if(isset($_POST['receipt']) && $_POST['receipt'] != "")
	{
		$sql .= "UPDATE `albedo_repair`.`role` SET `print_receipt` = '".$_POST['receipt']."' WHERE `role_id` = '".$role_id."'; ";
	}


	if(mysqli_multi_query($conn, $sql) == true)
	{
		$msg = "Role information has updated";
		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "role.php";</script>';
	} else {
		$msg = "Error: cannot update role information";
		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "role.php";</script>';
	}

	mysqli_close($conn);

?>