<?php

	include('PHP/connect.php');

	$msg = "";
	$rpn = $_POST['rpnum'];
	$fn = $_POST['fnum'];
	$pron = $_POST['pronum'];
	$nxt_pron = $_POST['nxtpronum'];
	$sql = "";

	if(!empty($_POST['cust']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_order` SET `cust_id` = '".$_POST['cust']."' WHERE `form_num` = '".$fn."'; ";
	}

	if(!empty($_POST['dept']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_order` SET `dept_store` = '".$_POST['dept']."' WHERE `form_num` = '".$fn."'; ";
	}

	if(!empty($_POST['received_date']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_order` SET `received_from_cust` = '".$_POST['received_date']."' WHERE `form_num` = '".$fn."'; ";
	}

	if(!empty($_POST['prod_code']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_item` SET `prod_code` = '".$_POST['prod_code']."' WHERE `repair_num` = '".$rpn."'; ";
	}

	if(!empty($_POST['purchased_date']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_item` SET `purchased_date` = '".$_POST['purchased_date']."' WHERE `repair_num` = '".$rpn."'; ";
	}

	if(!empty($_POST['repair_detail']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_item` SET `repair_detail` = '".$_POST['repair_detail']."' WHERE `repair_num` = '".$rpn."'; ";
	}

	if(!empty($_POST['warranty']))
	{
		if(!empty($pron) && $_POST['warranty'] == 1)
		{
			$sql .= "DELETE FROM `albedo_repair`.`pro_number` WHERE `pro_num` = '".$pron."'; ";
		}

		$sql .= "UPDATE `albedo_repair`.`repair_item` SET `warranty_type` = '".$_POST['warranty']."' WHERE `repair_num` = '".$rpn."'; ";
	}

	if(!empty($_POST['repair_cost']))
	{
		if(!empty($pron))
		{
			$sql .= "UPDATE `albedo_repair`.`pro_number` SET `cost` = '".$_POST['repair_cost']."' WHERE `pro_num` = '".$pron."'; ";
		} else {
			$sql .= "INSERT INTO `albedo_repair`.`pro_number` (`pro_num`, `repair_num`, `cost`) VALUES ('".$nxt_pron."', '".$rpn."', '".$_POST['repair_cost']."'); ";
		}
	}

	if(!empty($_POST['arrive_comp_date']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_order` SET `arrived_at_comp` = '".$_POST['arrive_comp_date']."' WHERE `form_num` = '".$fn."'; ";
	}

	if(!empty($_POST['repair_location']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_item` SET `repair_location` = '".$_POST['repair_location']."' WHERE `repair_num` = '".$rpn."'; ";
	}

	if(!empty($_POST['send_fact_date']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_item` SET `send_factory_date` = '".$_POST['send_fact_date']."' WHERE `repair_num` = '".$rpn."'; ";
	}

	if(!empty($_POST['received_fact_date']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_item` SET `received_from_factory` = '".$_POST['received_fact_date']."' WHERE `repair_num` = '".$rpn."'; ";
	}

	if(!empty($_POST['send_dept_date']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_item` SET `return_dept_date` = '".$_POST['send_dept_date']."' WHERE `repair_num` = '".$rpn."'; ";
	}

	if(!empty($_POST['send_method']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_item` SET `send_method` = '".$_POST['send_method']."' WHERE `repair_num` = '".$rpn."'; ";
	}

	if(!empty($_POST['person_sent']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_item` SET `person_sent` = '".$_POST['person_sent']."' WHERE `repair_num` = '".$rpn."'; ";
	}

	if(!empty($_POST['note']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_item` SET `note` = '".$_POST['note']."' WHERE `repair_num` = '".$rpn."'; ";
	}

	if(!empty($_POST['form_num']))
	{
		$sql .= "UPDATE `albedo_repair`.`repair_order` SET `form_num` = '".$_POST['form_num']."' WHERE `form_num` = '".$fn."'; ";
	}

	if(!empty($_POST['money_received_date']))
	{
		if(!empty($pron))
		{
			$sql .= "UPDATE `albedo_repair`.`pro_number` SET `money_received_date` = '".$_POST['money_received_date']."' WHERE `pro_num` = '".$pron."'; ";
		} else {
			$sql .= "INSERT INTO `albedo_repair`.`pro_number` (`pro_num`, `repair_num`, `cost`, `money_received_date`) VALUES ('".$nxt_pron."', '".$rpn."', '".$_POST['repair_cost']."', '".$_POST['money_received_date']."'); ";
		}
	}

	if(mysqli_multi_query($conn, $sql) == true)
	{
		$msg = "Information is updated";
		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "repair_order.php";</script>';
	} else {
		$msg = "Error: cannot update information";
		echo '<script language="javascript"> window.alert("'.$msg.'"); </script> window.location.href = "repair_order.php";</script>';
	}

	mysqli_close($conn);
?>