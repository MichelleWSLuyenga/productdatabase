<?php
	session_start();
	if(empty($_SESSION['permission']))
	{
		header('location: login.php');
	}
	elseif(empty($_POST['role_id']))
	{
		header('location: role.php');
	}
	elseif($_SESSION['permission']['edit_role'] == '0')
	{ ?>
		<div class="col-md-12">
			<div class="row"><div class="col-md-4 col-md-offset-4 text-center"><h1 style="color:#d9534f;">Permission Denied !!</h1></div></div>
		<hr>
			<div class="row"><div class="col-md-6 col-md-offset-3 text-center"><p style="color:#d9534f;">You don't have permission to access <b>/edit_role/</b> on this server.</p></div></div>
		</div>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<?php	
		die();
	} else {
		include('PHP/connect.php');

		$role_id = $_POST['role_id'];
		$sql = "SELECT * FROM `role` WHERE `role_id` = '".$role_id."';";
		$role = mysqli_query($conn, $sql);
		$role_perm = array();
		$role_perm[] = mysqli_fetch_assoc($role);

		mysqli_close($conn);
	}
?>

<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - edit role</title>
</head>
<body>
	<?php include('PHP/navbar.php'); ?>
	<div class="col-md-12">
		<h1>Edit role  #<?php echo $role_perm[0]['role_name']; ?></h1>
		<form action="edit_role_action.php" method="post" name="edit_role" onsubmit="return validate();">
			<input type="text" name="role_id" value="<?php echo $role_id; ?>" style="display:none">
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4">
					<input type="text" name="role_name" class="form-control" placeholder="Role name">
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if(!empty($role_perm[0]['role_name'])){echo $role_perm[0]['role_name'];} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4 bg-info text-center">
					<h4>Permission on repair order</h4>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Add</label>
				</div>
				<div class="form-group col-md-4">
					<select name="add_rpo" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['add_repair_order'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Update</label>
				</div>
				<div class="form-group col-md-4">
					<select name="update_rpo" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['update_repair_order'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Edit</label>
				</div>
				<div class="form-group col-md-4">
					<select name="edit_rpo" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['edit_repair_order'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Delete</label>
				</div>
				<div class="form-group col-md-4">
					<select name="delete_rpo" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['delete_repair_order'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4 bg-info text-center">
					<h4>Permission on product</h4>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Add</label>
				</div>
				<div class="form-group col-md-4">
					<select name="add_prod" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['add_product'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Edit</label>
				</div>
				<div class="form-group col-md-4">
					<select name="edit_prod" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['edit_product'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Delete</label>
				</div>
				<div class="form-group col-md-4">
					<select name="delete_prod" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['delete_product'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4 bg-info text-center">
					<h4>Permission on store</h4>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Add</label>
				</div>
				<div class="form-group col-md-4">
					<select name="add_store" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['add_store'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Edit</label>
				</div>
				<div class="form-group col-md-4">
					<select name="edit_store" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['edit_store'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Delete</label>
				</div>
				<div class="form-group col-md-4">
					<select name="delete_store" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['delete_store'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4 bg-info text-center">
					<h4>Permission on repair location</h4>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Add</label>
				</div>
				<div class="form-group col-md-4">
					<select name="add_repair_location" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['add_repair_location'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Edit</label>
				</div>
				<div class="form-group col-md-4">
					<select name="edit_repair_location" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['edit_repair_location'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Delete</label>
				</div>
				<div class="form-group col-md-4">
					<select name="delete_repair_location" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['delete_repair_location'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4 bg-info text-center">
					<h4>Permission on warranty</h4>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Add</label>
				</div>
				<div class="form-group col-md-4">
					<select name="add_warranty" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['add_warranty'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Edit</label>
				</div>
				<div class="form-group col-md-4">
					<select name="edit_warranty" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['edit_warranty'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Delete</label>
				</div>
				<div class="form-group col-md-4">
					<select name="delete_warranty" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['delete_warranty'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4 bg-info text-center">
					<h4>Permission on customer</h4>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Add</label>
				</div>
				<div class="form-group col-md-4">
					<select name="add_customer" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['add_customer'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Edit</label>
				</div>
				<div class="form-group col-md-4">
					<select name="edit_customer" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['edit_customer'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Delete</label>
				</div>
				<div class="form-group col-md-4">
					<select name="delete_customer" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['delete_customer'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4 bg-info text-center">
					<h4>Permission on employee</h4>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Add</label>
				</div>
				<div class="form-group col-md-4">
					<select name="add_employee" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['add_employee'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Edit</label>
				</div>
				<div class="form-group col-md-4">
					<select name="edit_employee" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['edit_employee'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Delete</label>
				</div>
				<div class="form-group col-md-4">
					<select name="delete_employee" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['delete_employee'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4 bg-info text-center">
					<h4>Permission on report</h4>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Master</label>
				</div>
				<div class="form-group col-md-4">
					<select name="master" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['view_master_repair'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Location</label>
				</div>
				<div class="form-group col-md-4">
					<select name="location" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['view_report'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Receipt</label>
				</div>
				<div class="form-group col-md-4">
					<select name="receipt" class="form-control">
						<option></option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<p class="badge badge-secondary"><?php if($role_perm[0]['print_receipt'] == '1'){echo 'Yes';} else {echo 'No';} ?></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<input type="submit" name="submit" value="Update" class="btn btn-success">
					<input type="button" name="back" value="Cancel" onclick="window.location.href = 'role.php'" class="btn btn-danger">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
		</form>
	</div>
	<?php include('PHP/import.php'); ?>
</body>
</html>

<script language="javascript">
	function validate()
	{
		if(document.edit_role.update_rpo.value == "" && document.edit_role.add_rpo.value == "" && document.edit_role.edit_rpo.value == "" && document.edit_role.delete_rpo.value == "" && document.edit_role.add_prod.value == "" && document.edit_role.edit_prod.value == "" && document.edit_role.delete_prod.value == "" && document.edit_role.add_store.value == "" && document.edit_role.edit_store.value == "" && document.edit_role.delete_store.value == "" && document.edit_role.add_repair_location.value == "" && document.edit_role.edit_repair_location.value == "" && document.edit_role.delete_repair_location.value == "" && document.edit_role.add_warranty.value == "" && document.edit_role.edit_warranty.value == "" && document.edit_role.delete_warranty.value == "" && document.edit_role.add_customer.value == "" && document.edit_role.edit_customer.value == "" && document.edit_role.delete_customer.value == "" && document.edit_role.add_employee.value == "" && document.edit_role.edit_employee.value == "" && document.edit_role.delete_employee.value == "" && document.edit_role.master.value == "" && document.edit_role.location.value == "" && document.edit_role.receipt.value == "")
		{
			alert( "At least one field is required" );
            return false;
		}
	}
</script>