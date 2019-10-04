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
	elseif($_SESSION['permission']['update_repair_order'] == '0')
	{ ?>
		<div class="col-md-12">
			<div class="row"><div class="col-md-4 col-md-offset-4 text-center"><h1 style="color:#d9534f;">Permission Denied !!</h1></div></div>
		<hr>
			<div class="row"><div class="col-md-6 col-md-offset-3 text-center"><p style="color:#d9534f;">You don't have permission to access <b>/update_repair_order/</b> on this server.</p></div></div>
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
		$sql = "SELECT `repair_item`.*, `repair_order`.`arrived_at_comp`, `repair_location`.`location_name`, `employee`.`emp_name` FROM `repair_item` LEFT JOIN `repair_order` ON `repair_item`.`form_num` = `repair_order`.`form_num` LEFT JOIN `repair_location` ON `repair_location`.`location_id` = `repair_item`.`repair_location` LEFT JOIN `employee` ON `repair_item`.`person_sent` = `employee`.`emp_id` WHERE `repair_item`.`repair_num` = '".$rpn."';";

		$status_info = mysqli_query($conn, $sql);
		$form_num = "";
		$arrived_comp = "";
		$rp_site = "";
		$send_fact = "";
		$received_fact = "";
		$return_dept = "";
		$send_method = "";
		$send_person = "";
		$note = "";
		$rpl_name = "";
		$empsent_name = "";
		
		while($row = mysqli_fetch_array($status_info))
		{
			$form_num = "$row[1]";
			$arrived_comp = "$row[13]";
			$rp_site = "$row[6]";
			$send_fact = "$row[7]";
			$received_fact = "$row[8]";
			$return_dept = "$row[9]";
			$send_method = "$row[10]";
			$send_person = "$row[11]";
			$note = "$row[12]";
			$rpl_name = "$row[14]";
			$empsent_name = "$row[15]";
		}

		$sql = "SELECT * FROM `repair_location`";
		$repair_location = mysqli_query($conn, $sql);
		$rp_location = "";
		while($row1 = mysqli_fetch_array($repair_location))
		{
			$rp_location = $rp_location."<option value='$row1[0]'>$row1[1]</option>";
		}

		$sql = "SELECT * FROM `employee`";
		$employee = mysqli_query($conn, $sql);
		$emp = "";
		while($row2 = mysqli_fetch_array($employee))
		{
			$emp = $emp."<option value='$row2[0]'>$row2[1]</option>";
		}
		mysqli_close($conn);
	}
?>

<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - update repair order</title>
</head>

<body>
	<div class="col-md-12">
		<h1>Update Repair Order  #<?php echo $rpn; ?></h1>

		<form name="update" method="post" action="update_repair_order_action.php">
			<div class="row">
				<div class="form-group col-md-4">
					<h3>Status information</h3>
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
			<div id="status">
				<input type="text" name="rpn" value="<?php echo $rpn; ?>" style="display:none">
				<input type="text" name="rpfn" value="<?php echo $form_num; ?>" style="display:none">
			<?php
			if(!empty($arrived_comp))
			{
				echo '<div class="row"><div class="form-group col-md-4"><label>Arrived at Company :</label></div><div class="form-group col-md-4">'.$arrived_comp.'</div><div class="form-group col-md-4"></div></div>';
			} else {
				echo '<div class="row"><div class="form-group col-md-4"><label>Arrived at Company :</label></div><div class="form-group col-md-4"><input type="date" name="arrive_comp_date" class="form-control"></div><div class="form-group col-md-4"></div></div>';
			}
			if(!empty($rp_site))
			{
				echo '<div class="row"><div class="form-group col-md-4"><label>Repair Location :</label></div><div class="form-group col-md-4">'.$rpl_name.'</div><div class="form-group col-md-4"></div></div>';
			} else {
				echo '<div class="row"><div class="form-group col-md-4"><label>Repair Location :</label></div><div class="form-group col-md-4"><select name="repair_location" class="form-control"> <option></option>'.$rp_location.'</select></div><div class="form-group col-md-4"></div></div>';
			}
			if(!empty($send_fact))
			{
				echo '<div class="row"><div class="form-group col-md-4"><label>Send to Factory :</label></div><div class="form-group col-md-4">'.$send_fact.'</div><div class="form-group col-md-4"></div></div>';
			} else {
				echo '<div class="row"><div class="form-group col-md-4"><label>Send to Factory :</label></div><div class="form-group col-md-4"><input type="date" name="send_fact_date" class="form-control"></div><div class="form-group col-md-4"></div></div>';
			}
			if(!empty($received_fact))
			{
				echo '<div class="row"><div class="form-group col-md-4"><label>Received from Factory :</label></div><div class="form-group col-md-4">'.$received_fact.'</div><div class="form-group col-md-4"></div></div>';
			} else {
				echo '<div class="row"><div class="form-group col-md-4"><label>Received from Factory :</label></div><div class="form-group col-md-4"><input type="date" name="received_fact_date" class="form-control"></div><div class="form-group col-md-4"></div></div>';
			}
			if(!empty($return_dept))
			{
				echo '<div class="row"><div class="form-group col-md-4"><label>Send to Department Store :</label></div><div class="form-group col-md-4">'.$return_dept.'</div><div class="form-group col-md-4"></div></div>';
			} else {
				echo '<div class="row"><div class="form-group col-md-4"><label>Send to Department Store :</label></div><div class="form-group col-md-4"><input type="date" name="send_dept_date" class="form-control"></div><div class="form-group col-md-4"></div></div>';
			}
			if(!empty($send_method))
			{
				echo '<div class="row"><div class="form-group col-md-4"><label>Send Method :</label></div><div class="form-group col-md-4">'.$send_method.'</div><div class="form-group col-md-4"></div></div>';
			} else {
				echo '<div class="row"><div class="form-group col-md-4"><label>Send Method :</label></div><div class="form-group col-md-4"><input type="text" name="send_method" class="form-control"></div><div class="form-group col-md-4"></div></div>';
			}
			if(!empty($send_person))
			{
				echo '<div class="row"><div class="form-group col-md-4"><label>Send Person :</label></div><div class="form-group col-md-4">'.$empsent_name.'</div><div class="form-group col-md-4"></div></div>';
			} else {
				echo '<div class="row"><div class="form-group col-md-4"><label>Send Person :</label></div><div class="form-group col-md-4"><select name="person_sent" class="form-control"><option></option>'.$emp.'</select></div><div class="form-group col-md-4"></div></div>';
			}
			if(!empty($note))
			{
				echo '<div class="row"><div class="form-group col-md-4"><label>Note :</label></div><div class="form-group col-md-4">'.$note.'</div><div class="form-group col-md-4"></div></div>';
			} else {
				echo '<div class="row"><div class="form-group col-md-4"><label>Note :</label></div><div class="form-group col-md-4"><input type="text" name="note" class="form-control"></div><div class="form-group col-md-4"></div></div>';
			}
			?>

				<div class="row">
					<div class="form-group col-md-4"></div>
					<div class="form-group col-md-4"></div>
					<div class="form-group col-md-4">
						<input type="submit" name="submit" value="Update" class="btn btn-success">
						<input type="button" name="back" value="Cancel" onclick="window.location.href = 'repair_order.php'" class="btn btn-danger">
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php include('PHP/import.php'); ?>
</body>
</html>

<?php
	exit;
?>