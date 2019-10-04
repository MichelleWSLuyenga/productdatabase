<?php
	session_start();
	if(empty($_SESSION['permission']))
	{
		header('location: login.php');
	}
	elseif(empty($_POST['repair_num2']))
	{
		header('location: repair_order.php');
	}
	elseif($_SESSION['permission']['edit_repair_order'] == '0')
	{ ?>
		<div class="col-md-12">
			<div class="row"><div class="col-md-4 col-md-offset-4 text-center"><h1 style="color:#d9534f;">Permission Denied !!</h1></div></div>
		<hr>
			<div class="row"><div class="col-md-6 col-md-offset-3 text-center"><p style="color:#d9534f;">You don't have permission to access <b>/edit_repair_order/</b> on this server.</p></div></div>
		</div>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<?php	
		die();
	} else {

		include('PHP/connect.php');

		$rpn = $_POST['repair_num2'];
		$sql = "SELECT `repair_item`.`repair_num`, `repair_item`.`form_num`, `repair_item`.`prod_code`, `repair_item`.`repair_detail`, `warranty`.`warranty_desc`, `repair_item`.`purchased_date`, `repair_location`.`location_name`, `repair_item`.`send_factory_date`, `repair_item`.`received_from_factory`, `repair_item`.`return_dept_date`, `repair_item`.`send_method`, `employee`.`emp_name`, `repair_item`.`note`, `store`.`dept_name`, `customer`.`cust_name`, `repair_order`.`received_from_cust`, `repair_order`.`arrived_at_comp`, `pro_number`.`pro_num`, `pro_number`.`cost`, `pro_number`.`money_received_date`, `repair_item`.`warranty_type` FROM `repair_item` LEFT JOIN `repair_order` ON `repair_item`.`form_num` = `repair_order`.`form_num` LEFT JOIN `customer` ON `repair_order`.`cust_id` = `customer`.`cust_id` LEFT JOIN `warranty` ON `repair_item`.`warranty_type` = `warranty`.`warranty_id` LEFT JOIN `repair_location` ON `repair_item`.`repair_location` = `repair_location`.`location_id` LEFT JOIN `employee` ON `repair_item`.`person_sent` = `employee`.`emp_id` LEFT JOIN `pro_number` ON `repair_item`.`repair_num` = `pro_number`.`repair_num` LEFT JOIN `store` ON `repair_order`.`dept_store` = `store`.`dept_id` WHERE `repair_item`.`repair_num` = '".$rpn."';";
		

		$status_info = mysqli_query($conn, $sql);
		$form_num = "";
		$prod_id = "";
		$rp_detail = "";
		$purchased_date = "";
		$war_type = "";
		$arrived_comp = "";
		$rp_site = "";
		$send_fact = "";
		$received_fact = "";
		$return_dept = "";
		$send_method = "";
		$send_person = "";
		$note = "";
		$dpt_store = "";
		$cust_id = "";
		$received_cust = "";
		$arrived_comp = "";
		$pro_n = "";
		$rp_cost = "";
		$money_received_date = "";
		$war_id = "";
		
		while($row = mysqli_fetch_array($status_info))
		{
			$form_num = "$row[1]";
			$prod_id = "$row[2]";
			$rp_detail = "$row[3]";
			$war_type = "$row[4]";
			$purchased_date = "$row[5]";
			$rp_site = "$row[6]";
			$send_fact = "$row[7]";
			$received_fact = "$row[8]";
			$return_dept = "$row[9]";
			$send_method = "$row[10]";
			$send_person = "$row[11]";
			$note = "$row[12]";
			$dpt_store = "$row[13]";
			$cust_id = "$row[14]";
			$received_cust = "$row[15]";
			$arrived_comp = "$row[16]";
			$pro_n = "$row[17]";
			$rp_cost = "$row[18]";
			$money_received_date = "$row[19]";
			$war_id = "$row[20]";
		}

		$sql = "SELECT * FROM `customer` ORDER BY `cust_name` ASC";
		$customer = mysqli_query($conn, $sql);
		$cust = "";
		while($row = mysqli_fetch_array($customer))
		{
			$cust = $cust."<option value='$row[0]'>$row[1]</option>";
		}

		$sql = "SELECT * FROM `store`";
		$dept_store = mysqli_query($conn, $sql);
		$store = "";
		while($row = mysqli_fetch_array($dept_store))
		{
			$store = $store."<option value='$row[0]'>$row[1]</option>";
		}

		$sql = "SELECT `item` FROM `product`";
		$prod_code = mysqli_query($conn, $sql);
		$prod = "";
		while($row = mysqli_fetch_array($prod_code))
		{
			$prod = $prod."<option value='$row[0]'>$row[0]</option>";
		}

		$sql = "SELECT * FROM `warranty`";
		$war_value = mysqli_query($conn, $sql);
		$war = "";
		while($row = mysqli_fetch_array($war_value))
		{
			$war = $war."<option value='$row[0]'>$row[1]</option>";
		}

		$sql = "SELECT * FROM `repair_location`";
		$repair_location = mysqli_query($conn, $sql);
		$rp_location = "";
		while($row = mysqli_fetch_array($repair_location))
		{
			$rp_location = $rp_location."<option value='$row[0]'>$row[1]</option>";
		}

		$sql = "SELECT * FROM `employee`";
		$employee = mysqli_query($conn, $sql);
		$emp = "";
		while($row = mysqli_fetch_array($employee))
		{
			$emp = $emp."<option value='$row[0]'>$row[1]</option>";
		}

		$pro_result = mysqli_query($conn, "SELECT MAX(pro_num) FROM pro_number");
	    $pro_row = mysqli_fetch_array($pro_result);
	    $nxt_pro_num = $pro_row[0];
	    
	    $curr_year = date("y");
	    if(empty($nxt_pro_num)) {
	    	$nxt_pro_num = "PR".$curr_year."/001";
	    }
	    $pro_year = substr($nxt_pro_num, 2, 2);
	    if($curr_year != $pro_year) {
	    	$p_num = "/001";
	    	$nxt_pro_num = "PR".$curr_year.$p_num;
	    } else {
	    	$p_num = substr($nxt_pro_num, -3);
	   		$p_num += 1;
	   		$p_num = "/".substr("000{$p_num}", -3);
	   		$nxt_pro_num = "PR".$curr_year.$p_num;
	    }

	    mysqli_close($conn);
	}
?>

<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - edit repair order</title>
</head>

<script language="javascript">
	function warranty_selected(selectedObj)
	{
		var cost = document.getElementById('cost');
		var money = document.getElementById('money');
		switch(selectedObj){
			case 0:
				money.style.display = "none";
				cost.style.display = "none";
				break;
			case 1:
				money.style.display = "none";
				cost.style.display = "none";
				break;
			default:
				money.style.display = "block";
				cost.style.display = "block";
			break;
		}
	}
</script>

<body onload="warranty_selected(<?php echo $war_id; ?>)">
	<?php include('PHP/navbar.php'); ?>
	<div class="col-md-12">
		<h1>Edit Repair Order  #<?php echo $rpn; ?></h1>
		<form action="edit_repair_order_action.php" method="post" name="e_rpo" onsubmit="return validate();">
			<input type="text" name="fnum" value="<?php echo $form_num; ?>" style="display:none">
			<input type="text" name="rpnum" value="<?php echo $rpn ; ?>" style="display:none">
			<input type="text" name="pronum" value="<?php echo $pro_n; ?>" style="display:none">
			<input type="text" name="nxtpronum" value="<?php echo $nxt_pro_num; ?>" style="display:none">
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Form Number :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="text" name="form_num" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($form_num)){echo '<p class="badge badge-secondary">'.$form_num.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Customer :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="cust" class="form-control">
						<option></option>
						<?php echo $cust; ?>
					</select>
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($cust_id)){echo '<p class="badge badge-secondary">'.$cust_id.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Department Store :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="dept" class="form-control">
						<option></option>
						<?php echo $store; ?>
					</select>
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($dpt_store)){echo '<p class="badge badge-secondary">'.$dpt_store.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Received from Customer :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="date" name="received_date" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($received_cust)){echo '<p class="badge badge-secondary">'.$received_cust.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Product Code :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="prod_code" class="form-control">
						<option></option>
						<?php echo $prod; ?>
					</select>
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($prod_id)){echo '<p class="badge badge-secondary">'.$prod_id.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Purchased Date :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="date" name="purchased_date" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($purchased_date)){echo '<p class="badge badge-secondary">'.$purchased_date.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Repair Detail :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="text" name="repair_detail" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($rp_detail)){echo '<p class="badge badge-secondary">'.$rp_detail.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Warranty Type :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="warranty" onchange="warranty_selected(this.selectedIndex);" class="form-control">
						<option></option>
						<?php echo $war; ?>
					</select>
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($war_type)){echo '<p class="badge badge-secondary">'.$war_type.'</p>';} ?>
				</div>
			</div>
			<div id="cost">
				<div class="row">
					<div class="form-group col-md-4">
						<label>
							Repair Cost :
						</label>
					</div>
					<div class="form-group col-md-4">
						<input type="number" name="repair_cost" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<?php if(!empty($rp_cost)){echo '<p class="badge badge-secondary">'.$rp_cost.'</p>';} ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Arrived at Company :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="date" name="arrive_comp_date" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($arrived_comp)){echo '<p class="badge badge-secondary">'.$arrived_comp.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Repair Location :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="repair_location" class="form-control">
						<option></option>
						<?php echo $rp_location; ?>
					</select>
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($rp_site)){echo '<p class="badge badge-secondary">'.$rp_site.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Send to Factory :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="date" name="send_fact_date" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($send_fact)){echo '<p class="badge badge-secondary">'.$send_fact.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Received from Factory :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="date" name="received_fact_date" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($received_fact)){echo '<p class="badge badge-secondary">'.$received_fact.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Send to Department Store :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="date" name="send_dept_date" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($return_dept)){echo '<p class="badge badge-secondary">'.$return_dept.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Send Method :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="text" name="send_method" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($send_method)){echo '<p class="badge badge-secondary">'.$send_method.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Send Person :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="person_sent" class="form-control">
						<option></option>
						<?php echo $emp; ?>
					</select>
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($send_person)){echo '<p class="badge badge-secondary">'.$send_person.'</p>';} ?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Note :
					</label>
				</div>
				<div class="form-group col-md-4">
					<textarea name="note" class="form-control"></textarea>
				</div>
				<div class="form-group col-md-4">
					<?php if(!empty($note)){echo '<p class="badge badge-secondary">'.$note.'</p>';} ?>
				</div>
			</div>
			<div id="money">
				<div class="row">
					<div class="form-group col-md-4">
						<label>
							Received Money :
						</label>
					</div>
					<div class="form-group col-md-4">
						<input type="date" name="money_received_date" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<?php if(!empty($money_received_date)){echo '<p class="badge badge-secondary">'.$money_received_date.'</p>';} ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4">
					<input type="submit" name="submit" value="Update" class="btn btn-success">
					<input type="button" name="back" value="Cancel" onclick="window.location.href = 'repair_order.php'" class="btn btn-danger">
				</div>
			</div>
		</form>
	</div>
	<?php include('PHP/import.php'); ?>

</body>
</html>

<script language="javascript">

	function validate()
	{
		if(document.e_rpo.form_num.value == "" && document.e_rpo.cust.value == "" && document.e_rpo.dept.value == "" && document.e_rpo.received_date.value == "" && document.e_rpo.prod_code.value == "" && document.e_rpo.purchased_date.value == "" && document.e_rpo.repair_detail.value == "" && document.e_rpo.warranty.value == "" && document.e_rpo.arrive_comp_date.value == "" && document.e_rpo.repair_location.value == "" && document.e_rpo.send_fact_date.value == "" && document.e_rpo.received_fact_date.value == "" && document.e_rpo.send_dept_date.value == "" && document.e_rpo.send_method.value == "" && document.e_rpo.person_sent.value == "" && document.e_rpo.note.value == "" && document.e_rpo.money_received_date.value == "" && document.e_rpo.repair_cost.value == "")
		{
			alert( "At least one field is required" );
            document.e_rpo.form_num.focus();
            return false;
		} else if(document.e_rpo.pronum.value == "" && document.e_rpo.repair_cost.value == "" && document.e_rpo.money_received_date.value != "")
		{
			alert("Cannot update money received date due to PRO number is not exist and cost is not specify");
			document.e_rpo.repair_cost.focus();
			return false;
		} else if(document.e_rpo.pronum.value == "" && document.e_rpo.repair_cost.value == "")
		{
			if(document.e_rpo.warranty.value != "1")
			{
				if(document.e_rpo.warranty.value = "")
				{
					return true;
				} else {
					alert("Cannot update warranty type due to cost is not specify");
					document.e_rpo.repair_cost.focus();
					return false;
				}
			
		} else {
			return true;
		}
	}

</script>