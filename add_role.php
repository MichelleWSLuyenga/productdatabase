<?php 
	if(isset($_POST['submit']))
	{
		include('PHP/connect.php');
		$insert_sql = "INSERT INTO `albedo_repair`.`role` (`role_name`) VALUES ('".$_POST['role_name']."');";
		$msg = "";
		$sql = "";
		if(mysqli_query($conn, $insert_sql) == true)
		{
			$last_id = mysqli_insert_id($conn);
			if(isset($_POST['add_rpo']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `add_repair_order` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['update_rpo']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `update_repair_order` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['edit_rpo']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `edit_repair_order` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['delete_rpo']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `delete_repair_order` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['add_prod']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `add_product` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['edit_prod']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `edit_product` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['delete_prod']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `delete_product` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['add_store']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `add_store` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['edit_store']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `edit_store` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['delete_store']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `delete_store` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['add_rpl']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `add_repair_location` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['edit_rpl']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `edit_repair_location` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['delete_rpl']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `delete_repair_location` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['add_warranty']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `add_warranty` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['edit_warranty']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `edit_warranty` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['delete_warranty']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `delete_warranty` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['add_customer']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `add_customer` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['edit_customer']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `edit_customer` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['delete_customer']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `delete_customer` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['add_employee']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `add_employee` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['edit_employee']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `edit_employee` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['delete_employee']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `delete_employee` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['master']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `view_master_repair` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['location']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `view_report` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}
			if(isset($_POST['receipt']))
			{
				$sql .= "UPDATE `albedo_repair`.`role` SET `print_receipt` = '1' WHERE (`role_id` = '".$last_id."'); ";
			}

			if(mysqli_multi_query($conn, $sql) == true)
			{
				$msg = "New role has added successfully";
				echo '<script language="javascript"> window.alert("'.$msg.'"); </script>';
			} else {
				$msg = "Error: cannot add role";
				echo '<script language="javascript"> window.alert("'.$msg.'"); </script>';
			}
		}
	}
?>
	<div class="form-popup myForm">
		<h3>Add new role</h3>
		<form action="" method="post" name="perm_form">
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" name="role_name" required="required" class="form-control" placeholder="Role Name">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-3">
				</div>
				<div class="form-group col-md-2 text-center">
					<h4>Update</h4>
				</div>
				<div class="form-group col-md-2 text-center">
					<h4>Add</h4>
				</div>
				<div class="form-group col-md-2 text-center">
					<h4>Edit</h4>
				</div>
				<div class="form-group col-md-2 text-center">
					<h4>Delete</h4>
				</div>
				<div class="form-group col-md-1"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-3">
					<label>
						Permission on repair order
					</label>
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="update_rpo" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="add_rpo" value="1"> 
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="edit_rpo" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="delete_rpo" value="1">
				</div>
				<div class="form-group col-md-1">
					<input type="button" name="rpo_all" value="Select all" onclick="selectAll(this.attributes['name'].value)" class="btn btn-info">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-3">
					<label>
						Permission on product
					</label>
				</div>
				<div class="form-group col-md-2"></div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="add_prod" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="edit_prod" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="delete_prod" value="1">
				</div>
				<div class="form-group col-md-1">
					<input type="button" name="prod_all" value="Select all" onclick="selectAll(this.attributes['name'].value)" class="btn btn-info">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-3">
					<label>
						Permission on store
					</label>
				</div>
				<div class="form-group col-md-2"></div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="add_store" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="edit_store" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="delete_store" value="1">
				</div>
				<div class="form-group col-md-1">
					<input type="button" name="store_all" value="Select all" onclick="selectAll(this.attributes['name'].value)" class="btn btn-info">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-3">
					<label>
						Permission on repair location
					</label>
				</div>
				<div class="form-group col-md-2"></div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="add_rpl" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="edit_rpl" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="delete_rpl" value="1">
				</div>
				<div class="form-group col-md-1">
					<input type="button" name="rpl_all" value="Select all" onclick="selectAll(this.attributes['name'].value)" class="btn btn-info">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-3">
					<label>
						Permission on warranty
					</label>
				</div>
				<div class="form-group col-md-2"></div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="add_warranty" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="edit_warranty" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="delete_warranty" value="1">
				</div>
				<div class="form-group col-md-1">
					<input type="button" name="warr_all" value="Select all" onclick="selectAll(this.attributes['name'].value)" class="btn btn-info">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-3">
					<label>
						Permission on customer
					</label>
				</div>
				<div class="form-group col-md-2"></div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="add_customer" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="edit_customer" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="delete_customer" value="1">
				</div>
				<div class="form-group col-md-1">
					<input type="button" name="cust_all" value="Select all" onclick="selectAll(this.attributes['name'].value)" class="btn btn-info">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-3">
					<label>
						Permission on employee
					</label>
				</div>
				<div class="form-group col-md-2"></div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="add_employee" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="edit_employee" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="delete_employee" value="1">
				</div>
				<div class="form-group col-md-1">
					<input type="button" name="emp_all" value="Select all" onclick="selectAll(this.attributes['name'].value)" class="btn btn-info">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-2 offset-md-5 text-center">
					<h4>Master</h4>
				</div>
				<div class="form-group col-md-2 text-center">
					<h4>Location</h4>
				</div>
				<div class="form-group col-md-2 text-center">
					<h4>Receipt</h4>
				</div>
				<div class="form-group col-md-1"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-3">
					<label>
						Permission on report
					</label>
				</div>
				<div class="form-group col-md-2"></div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="master" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="location" value="1">
				</div>
				<div class="form-group col-md-2 text-center">
					<input type="checkbox" class="checkbox-inline" name="receipt" value="1">
				</div>
				<div class="form-group col-md-1">
					<input type="button" name="report_all" value="Select all" onclick="selectAll(this.attributes['name'].value)" class="btn btn-info">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<button type="submit" name="submit" class="btn btn-success">Add</button>
					<button type="reset" name="reset" class="btn btn-danger" onclick="closeForm();">Cancel</button>
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
		</form>
	</div>

<script language="javascript">
	function selectAll(name)
	{
		switch(name)
		{
			case 'rpo_all':
				document.getElementsByName('add_rpo')[0].checked = "true";
				document.getElementsByName('update_rpo')[0].checked = "true";
				document.getElementsByName('edit_rpo')[0].checked = "true";
				document.getElementsByName('delete_rpo')[0].checked = "true";
			break;
			case 'prod_all':
				document.getElementsByName('add_prod')[0].checked = "true";
				document.getElementsByName('edit_prod')[0].checked = "true";
				document.getElementsByName('delete_prod')[0].checked = "true";
			break;
			case 'store_all':
				document.getElementsByName('add_store')[0].checked = "true";
				document.getElementsByName('edit_store')[0].checked = "true";
				document.getElementsByName('delete_store')[0].checked = "true";
			break;
			case 'rpl_all':
				document.getElementsByName('add_rpl')[0].checked = "true";
				document.getElementsByName('edit_rpl')[0].checked = "true";
				document.getElementsByName('delete_rpl')[0].checked = "true";
			break;
			case 'warr_all':
				document.getElementsByName('add_warranty')[0].checked = "true";
				document.getElementsByName('edit_warranty')[0].checked = "true";
				document.getElementsByName('delete_warranty')[0].checked = "true";
			break;
			case 'cust_all':
				document.getElementsByName('add_customer')[0].checked = "true";
				document.getElementsByName('edit_customer')[0].checked = "true";
				document.getElementsByName('delete_customer')[0].checked = "true";
			break;
			case 'emp_all':
				document.getElementsByName('add_employee')[0].checked = "true";
				document.getElementsByName('edit_employee')[0].checked = "true";
				document.getElementsByName('delete_employee')[0].checked = "true";
			break;
			case 'report_all':
				document.getElementsByName('master')[0].checked = "true";
				document.getElementsByName('location')[0].checked = "true";
				document.getElementsByName('receipt')[0].checked = "true";
			break;
		}
	}
</script>