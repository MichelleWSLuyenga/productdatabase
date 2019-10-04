<?php
		include('PHP/connect.php');

			$msg = "";
			$rpn = $_POST['rpn'];
			$rpfn = $_POST['rpfn'];
			$update_sql = "";
			
			if(!empty($_POST['arrive_comp_date']))
			{
				$update_sql .= "UPDATE `albedo_repair`.`repair_order` SET `arrived_at_comp` = '".$_POST['arrive_comp_date']."' WHERE `form_num` = '".$rpfn."'; ";
				$msg .= "Date arrived at company is recorded\\n";
			}

			if(!empty($_POST['repair_location']))
			{
				$update_sql .= "UPDATE `albedo_repair`.`repair_item` SET `repair_location` = '".$_POST['repair_location']."' WHERE `repair_num` = '".$rpn."'; ";
				$msg .= "Repair location is recorded\\n";
			}

			if(!empty($_POST['send_fact_date']))
			{
				$update_sql .= "UPDATE `albedo_repair`.`repair_item` SET `send_factory_date` = '".$_POST['send_fact_date']."' WHERE `repair_num` = '".$rpn."'; ";
				$msg .= "Date send to factory is recorded\\n";
			}

			if(!empty($_POST['received_fact_date']))
			{
				$update_sql .= "UPDATE `albedo_repair`.`repair_item` SET `received_from_factory` = '".$_POST['received_fact_date']."' WHERE `repair_num` = '".$rpn."'; ";
				$msg .= "Date received from factory is recorded\\n";
			}

			if(!empty($_POST['send_dept_date']))
			{
				$update_sql .= "UPDATE `albedo_repair`.`repair_item` SET `return_dept_date` = '".$_POST['send_dept_date']."' WHERE `repair_num` = '".$rpn."'; ";
				$msg .= "Date send to department store is recorded\\n";
			}

			if(!empty($_POST['send_method']))
			{
				$update_sql .= "UPDATE `albedo_repair`.`repair_item` SET `send_method` = '".$_POST['send_method']."' WHERE `repair_num` = '".$rpn."'; ";
				$msg .= "Method sent is recorded\\n";
			}

			if(!empty($_POST['person_sent']))
			{
				$update_sql .= "UPDATE `albedo_repair`.`repair_item` SET `person_sent` = '".$_POST['person_sent']."' WHERE `repair_num` = '".$rpn."'; ";
				$msg .= "Person sent is recorded\\n";
			}

			if(!empty($_POST['note']))
			{
				$update_sql .= "UPDATE `albedo_repair`.`repair_item` SET `note` = '".$_POST['note']."' WHERE `repair_num` = '".$rpn."'; ";
				$msg .= "Note is recorded\\n";
			}

			if(mysqli_multi_query($conn, $update_sql))
			{
				echo '<script language="javascript"> window.alert("'.$msg.'"); window.location = "repair_order.php"; </script>';
			} else {
				echo '<script language="javascript"> window.alert("Error: there is a problem when trying to insert record"); window.location = "repair_order.php"; </script>';
			}

			mysqli_close($conn);
?>