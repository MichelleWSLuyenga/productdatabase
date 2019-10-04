	  <?php

      if(empty($_SESSION['permission']))
	  {
		 header('location: login.php');
	  }
	  elseif($_SESSION['permission']['edit_store'] == '0')
	  	{ ?>
		<div class="col-md-12">
			<div class="row"><div class="col-md-4 col-md-offset-4 text-center"><h1 style="color:#d9534f;">Permission Denied !!</h1></div></div>
		<hr>
			<div class="row"><div class="col-md-6 col-md-offset-3 text-center"><p style="color:#d9534f;">You don't have permission to access <b>/edit_store/</b> on this server.</p></div></div>
		</div>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<?php	
		die();
	} else {
	include('PHP/connect.php');

	$sql = "SELECT * FROM `customer` ORDER BY `cust_name` ASC";
	$oldcust = mysqli_query($conn, $sql);

	$sql = "SELECT * FROM `store`";
	$dept_store = mysqli_query($conn, $sql);

	$sql = "SELECT `item` FROM `product`";
	$prod_code = mysqli_query($conn, $sql);
	$prod = "";
	while($row3 = mysqli_fetch_array($prod_code))
	{
		$prod = $prod."<option value='$row3[0]'>$row3[0]</option>";
	}

	$sql = "SELECT * FROM `warranty`";
	$war_value = mysqli_query($conn, $sql);
	$war = "";
	while($row4 = mysqli_fetch_array($war_value))
	{
		$war = $war."<option value='$row4[0]'>$row4[1]</option>";
	}
	mysqli_close($conn);
	}
?>


	<?php
	if(isset($_POST['submit']))
	{
	include('PHP/connect.php');

	$msg = "";
    switch($_POST['cust'])
    {
    	case "o":
    		$cust_id = $_POST['old_cust'];
    		$form_sql = "INSERT INTO repair_order (form_num, dept_store, cust_id, received_from_cust) VALUES ('".$_POST['form_num']."', '".$_POST['dept']."', '".$cust_id."', '".$_POST['received_date']."')";
    			if(mysqli_query($conn, $form_sql) == true)
    			{
    				$msg .= "New form is created successfully";
    			} else {
    				$msg .= "Error: cannot add a new form";
    			}
    		break;

		case "n":
			$cust_sql = "INSERT INTO customer (cust_name, tel) VALUES ('".$_POST['new_cust_name']."', '".$_POST['new_cust_tel']."')";
			if(mysqli_query($conn, $cust_sql) == true)
			{
				$msg .= "New customer is created successfully";
			} else {
				$msg .= "Error: cannot add a new customer";
			}
			$cust_result = mysqli_query($conn, "SELECT MAX(cust_id) FROM customer");
			$c_row = mysqli_fetch_array($cust_result);
			$cust_id = $c_row[0];
			
			$form_sql = "INSERT INTO repair_order (form_num, dept_store, cust_id, received_from_cust) VALUES ('".$_POST['form_num']."', '".$_POST['dept']."', '".$cust_id."', '".$_POST['received_date']."')";
			if(mysqli_query($conn, $form_sql) == true)
			{
				$msg .= "\\nNew form is created successfully";
			} else {
				$msg .= "\\nError: cannot add a new form";
			}
			break;
    }

    $rn_result = mysqli_query($conn, "SELECT MAX(repair_num) FROM repair_item");
    $rn_row = mysqli_fetch_array($rn_result);
    $repair_num = $rn_row[0];
    $curr_year = date("y");
    if(empty($repair_num)) {
    	$repair_num = $curr_year."/001";
    }
    $rn_year = substr($repair_num, 0, 2);
    if($curr_year != $rn_year) {
    	$rn_num = "/001";
    	$repair_num = $curr_year.$rn_num;
    } else {
    	$rn_num = substr($repair_num, -3);
   		$rn_num += 1;
   		$rn_num = "/".substr("000{$rn_num}", -3);
   		$repair_num = $curr_year.$rn_num;
    }

    $pro_result = mysqli_query($conn, "SELECT MAX(pro_num) FROM pro_number");
    $pro_row = mysqli_fetch_array($pro_result);
    $pro_num = $pro_row[0];
    
    //$curr_year = date("y");
    if(empty($pro_num)) {
    	$pro_num = "PR".$curr_year."/001";
    }
    $pro_year = substr($pro_num, 2, 2);
    if($curr_year != $pro_year) {
    	$p_num = "/001";
    	$pro_num = "PR".$curr_year.$p_num;
    } else {
    	$p_num = substr($pro_num, -3);
   		$p_num += 1;
   		$p_num = "/".substr("000{$p_num}", -3);
   		$pro_num = "PR".$curr_year.$p_num;
    }
    
   	$prod_amnt = $_POST['prod_amount'];
   	$form_num = $_POST['form_num'];
   	$prod_sql = "";
   	$cost_sql = "";
   	$j = 0;
   	for($i=1; $i<=$prod_amnt; $i++) {
   		$prodnum = 'prod_code'.$i;
   		$repairinfo = 'repair_detail'.$i;
   		$wartype = 'warranty'.$i;
   		$purchased = 'purchased_date'.$i;
   		$cost = 'repair_cost'.$i;
   		$prodcode[$j] = array($_POST[$prodnum]);
   		$repair_info[$j] = array($_POST[$repairinfo]);
   		$war_type[$j] = array($_POST[$wartype]);
   		$purchased_date[$j] = array($_POST[$purchased]);
   		if ($_POST[$cost] == '') {
   			$repair_cost[$j] = '0';
   		} else {
   			$repair_cost[$j] = array($_POST[$cost]);
   		}
   		
   		$prod_sql .= "INSERT INTO repair_item (repair_num, form_num, prod_code, repair_detail, warranty_type, purchased_date) VALUES ('".$repair_num."', '".$form_num."', '".implode($prodcode[$j])."', '".implode($repair_info[$j])."', '".implode($war_type[$j])."', '".implode($purchased_date[$j])."'); ";
   		
   		if($repair_cost[$j] != '0') {
   			$prod_sql .= "INSERT INTO pro_number (pro_num, repair_num, cost) VALUES ('".$pro_num."', '".$repair_num."', '".implode($repair_cost[$j])."'); ";
   		}
   		
   		$j++;

   		$rn_num = substr($repair_num, -3);
   		$rn_num += 1;
   		$rn_num = "/".substr("000{$rn_num}", -3);
   		$repair_num = $curr_year.$rn_num;

   		$p_num = substr($pro_num, -3);
   		$p_num += 1;
   		$p_num = "/".substr("000{$p_num}", -3);
   		$pro_num = "PR".$curr_year.$p_num;
   	}
   	if (mysqli_multi_query($conn, $prod_sql)) {
   		$msg .= "\\nNew repair product is recorded successfully";
   	} else {
   		$msg .= "\\nError:".$prod_sql.".mysqli_error($conn).";
   	}

   	mysqli_close($conn);

	echo '<script language="javascript"> window.alert ("'.$msg.'"); window.location.href = "repair_order.php" </script>';
	}
?>
	<div class="form-popup myForm">
	<form action="" method="post">
		<div class="row">
			<div class="form-group col-md-4">
				<h3>Customer information</h3>
			</div>
			<div class="form-group col-md-4"></div>
			<div class="form-group col-md-4"></div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<div class="form-check">
					<input type="radio" name="cust" value="n" onclick="new_checked();" id="new" required="required">
					<label>
						New Customer
					</label>
				</div>
			</div>
			<div class="form-group col-md-4">
				<div class="form-check">
					<input type="radio" name="cust" value="o" onclick="old_checked();" id="old" required="required">
					<label>
						Old Customer
					</label>
				</div>
			</div>
			
			<div class="form-group col-md-4"></div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<div id="new_cust" style="display:none">
					<input type="text" id="nc_name" name="new_cust_name" required="required" class="form-control" placeholder="Name">
						<br>
					<input type="tel" id="nc_tel" name="new_cust_tel" required="required" class="form-control" placeholder="Telephone Number">
				</div><!-- comment cut out with khwan -->
			</div>
			<div class="form-group col-md-4">
				<select name="old_cust" id="old_cust" style="display:none" class="form-control" size="15">
					<?php while($row1 = mysqli_fetch_array($oldcust)):;?>
					<option value="<?php echo $row1[0];?>" required="required"><?php echo $row1[1];?></option>
					<?php endwhile;?>
				</select>
			</div>
			<div class="form-group col-md-4">
				<!-- comment cut out with khwan -->
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<h3>Form information</h3>
			</div>
			<div class="form-group col-md-4"></div>
			<div class="form-group col-md-4"></div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<label>
					Form Number :
				</label>
			</div>
			<div class="form-group col-md-4">
				<input type="text" name="form_num" required="required" class="form-control">
			</div>
			<div class="form-group col-md-4"></div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<label>
					Department Store :
				</label>
			</div>
			<div class="form-group col-md-4">
				<select name="dept" required="required" class="form-control">
					<option></option>
					<?php while($row2 = mysqli_fetch_array($dept_store)):;?>
						<option value="<?php echo $row2[0];?>"><?php echo $row2[1];?></option>
					<?php endwhile;?>
				</select>
			</div>
			<div class="form-group col-md-4"></div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<label>
					Received from Customer :
				</label>
			</div>
			<div class="form-group col-md-4">
				<input type="date" name="received_date" required="required" class="form-control">
			</div>
			<div class="form-group col-md-4"></div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<h3>Product information</h3>
			</div>
			<div class="form-group col-md-4"></div>
			<div class="form-group col-md-4"></div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
				<label>
					Number of Product :
				</label>
			</div>
			<div class="form-group col-md-4">
				<select name="prod_amount" onchange="prod_selected(this.selectedIndex);" class="form-control">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
			<div class="form-group col-md-4"></div>
		</div>
		<div id="prod1">
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4 bg-info text-center">
					<h4>Product 1</h4>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Product Code :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="prod_code1" required="required" class="form-control">
						<option></option>
						<?php echo $prod;?>
					</select>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Purchased Date :
				</div>
				<div class="form-group col-md-4">
					<input type="date" name="purchased_date1" required="required" class="form-control">
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Repair Detail :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="text" name="repair_detail1" required="required" class="form-control">
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Warranty Type :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="warranty1" onchange="warranty_selected(1, this.selectedIndex);" required="required" class="form-control">
						<option></option>
						<?php echo $war;?>
					</select>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div id="cost1" style="display:none" required="required">
				<div class="row">
					<div class="form-group col-md-4">
						<label>
							Repair Cost :
						</label>
					</div>
					<div class="form-group col-md-4">
						<input type="number" name="repair_cost1" id="rp_cost1" class="form-control">
					</div>
					<div class="form-group col-md-4"></div>
				</div>
			</div>
		</div>
		<div id="prod2" style="display:none">
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4 bg-info text-center">
					<h4>Product 2</h4>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Product Code :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="prod_code2" id="prod_code2" required="required" class="form-control">
						<option></option>
						<?php echo $prod;?>
					</select>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Purchased Date :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="date" name="purchased_date2" id="prod_date2" required="required" class="form-control">
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Repair Detail :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="text" name="repair_detail2" id="prod_repair2" required="required" class="form-control">
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Warranty Type :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="warranty2" onchange="warranty_selected(2, this.selectedIndex);" id="prod_war2" required="required" class="form-control">
						<option></option>
						<?php echo $war;?>
					</select>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div id="cost2" style="display:none">
				<div class="row">
					<div class="form-group col-md-4">
						<label>
							Repair Cost :
						</label>
					</div>
					<div class="form-group col-md-4">
						<input type="number" name="repair_cost2" id="rp_cost2" class="form-control">
					</div>
					<div class="form-group col-md-4"></div>
				</div>
			</div>
		</div>
		<div id="prod3" style="display:none">
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4 bg-info text-center">
					<h4>Product 3</h4>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Product Code :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="prod_code3" id="prod_code3" required="required" class="form-control">
						<option></option>
						<?php echo $prod;?>
					</select>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Purchased Date :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="date" name="purchased_date3" id="prod_date3" required="required" class="form-control">
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Repair Detail :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="text" name="repair_detail3" id="prod_repair3" required="required" class="form-control">
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Warranty Type :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="warranty3" onchange="warranty_selected(3, this.selectedIndex);" id="prod_war3" required="required" class="form-control">
						<option></option>
						<?php echo $war;?>
					</select>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div id="cost3" style="display:none">
				<div class="row">
					<div class="form-group col-md-4">
						<label>
							Repair Cost :
						</label>
					</div>
					<div class="form-group col-md-4">
						<input type="number" name="repair_cost3" id="rp_cost3" class="form-control">
					</div>
					<div class="form-group col-md-4"></div>
				</div>	
			</div>
		</div>
		<div id="prod4" style="display:none">
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4 bg-info text-center">
					<h4>Product 4</h4>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Product Code :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="prod_code4" id="prod_code4" required="required" class="form-control">
						<option></option>
						<?php echo $prod;?>
					</select>
					</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Purchased Date :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="date" name="purchased_date4" id="prod_date4" required="required" class="form-control">
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Repair Detail :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="text" name="repair_detail4" id="prod_repair4" required="required" class="form-control">
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Warranty Type :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="warranty4" onchange="warranty_selected(4, this.selectedIndex);" id="prod_war4" required="required" class="form-control">
						<option></option>
						<?php echo $war;?>
					</select>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div id="cost4" style="display:none">
				<div class="row">
					<div class="form-group col-md-4">
						<label>
							Repair Cost :
						</label>
					</div>
					<div class="form-group col-md-4">
						<input type="number" name="repair_cost4" id="rp_cost4" class="form-control">
					</div>
					<div class="form-group col-md-4"></div>
				</div>
			</div>
		</div>
		<div id="prod5" style="display:none">
			<div class="row">
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4 bg-info text-center">
					<h4>Product 5</h4>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Product Code :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="prod_code5" id="prod_code5" required="required" class="form-control">
						<option></option>
						<?php echo $prod;?>
					</select>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Purchased Date :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="date" name="purchased_date5" id="prod_date5" required="required" class="form-control">
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Repair Detail :
					</label>
				</div>
				<div class="form-group col-md-4">
					<input type="text" name="repair_detail5" id="prod_repair5" required="required" class="form-control">
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label>
						Warranty Type :
					</label>
				</div>
				<div class="form-group col-md-4">
					<select name="warranty5" onchange="warranty_selected(5, this.selectedIndex);" id="prod_war5" required="required" class="form-control">
						<option></option>
						<?php echo $war;?>
					</select>
				</div>
				<div class="form-group col-md-4"></div>
			</div>
			<div id="cost5" style="display:none">
				<div class="row">
					<div class="form-group col-md-4">
						<label>
							Repair Cost :
						</label>
					</div>
					<div class="form-group col-md-4">
						<input type="number" name="repair_cost5" id="rp_cost5" class="form-control">
					</div>
					<div class="form-group col-md-4"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
					<button type="submit" name="submit" class="btn btn-success">Add</button>
					<button type="reset" name="reset" class="btn btn-danger" onclick="closeForm()">Cancel</button>
			</div>
			<div class="form-group col-md-4"></div>
			<div class="form-group col-md-4"></div>
		</div>
	</form>
	</div>

<script>
	function old_checked()
	{
		if (document.getElementById('old').checked = true) {
			var oc = document.getElementById("old_cust");
			oc.style.display = "inline";
			oc.required = true;
			var nc = document.getElementById("new_cust");
			nc.style.display = "none";
			document.getElementById("nc_name").required = false;
			document.getElementById("nc_tel").required = false;
		}
	}

	function new_checked()
	{
	if (document.getElementById('new').checked = true) {
			var nc = document.getElementById("new_cust");
			nc.style.display = "inline";
			document.getElementById("nc_name").required = true;
			document.getElementById("nc_tel").required = true;
			var oc = document.getElementById("old_cust");
			oc.style.display = "none";
			oc.required = false;
		}
	}

	function prod_selected(selectedObj)
	{
			switch(selectedObj){
				case 0:
					document.getElementById('prod2').style.display = "none";
					document.getElementById('prod3').style.display = "none";
					document.getElementById('prod4').style.display = "none";
					document.getElementById('prod5').style.display = "none";
					for (var i=2; i<=5; i++)
					{
						var code = 'prod_code'+i;
						var date = 'prod_date'+i;
						var repair = 'prod_repair'+i;
						var warranty = 'prod_war'+i;
						document.getElementById(code).required = false;
						document.getElementById(date).required = false;
						document.getElementById(repair).required = false;
						document.getElementById(warranty).required = false;
					}
					break;
				case 1:
					document.getElementById('prod2').style.display = "block";
					document.getElementById('prod3').style.display = "none";
					document.getElementById('prod4').style.display = "none";
					document.getElementById('prod5').style.display = "none";
					for (var i=3; i<=5; i++)
					{
						var code = 'prod_code'+i;
						var date = 'prod_date'+i;
						var repair = 'prod_repair'+i;
						var warranty = 'prod_war'+i;
						document.getElementById(code).required = false;
						document.getElementById(date).required = false;
						document.getElementById(repair).required = false;
						document.getElementById(warranty).required = false;
					}
					for (var i=2; i<=2; i++)
					{
						var code = 'prod_code'+i;
						var date = 'prod_date'+i;
						var repair = 'prod_repair'+i;
						var warranty = 'prod_war'+i;
						document.getElementById(code).required = true;
						document.getElementById(date).required = true;
						document.getElementById(repair).required = true;
						document.getElementById(warranty).required = true;
					}
					break;
				case 2:
					document.getElementById('prod2').style.display = "block";
					document.getElementById('prod3').style.display = "block";
					document.getElementById('prod4').style.display = "none";
					document.getElementById('prod5').style.display = "none";
					for (var i=4; i<=5; i++)
					{
						var code = 'prod_code'+i;
						var date = 'prod_date'+i;
						var repair = 'prod_repair'+i;
						var warranty = 'prod_war'+i;
						document.getElementById(code).required = false;
						document.getElementById(date).required = false;
						document.getElementById(repair).required = false;
						document.getElementById(warranty).required = false;
					}
					for (var i=2; i<=3; i++)
					{
						var code = 'prod_code'+i;
						var date = 'prod_date'+i;
						var repair = 'prod_repair'+i;
						var warranty = 'prod_war'+i;
						document.getElementById(code).required = true;
						document.getElementById(date).required = true;
						document.getElementById(repair).required = true;
						document.getElementById(warranty).required = true;
					}
					break;
				case 3:
					document.getElementById('prod2').style.display = "block";
					document.getElementById('prod3').style.display = "block";
					document.getElementById('prod4').style.display = "block";
					document.getElementById('prod5').style.display = "none";
					for (var i=5; i<=5; i++)
					{
						var code = 'prod_code'+i;
						var date = 'prod_date'+i;
						var repair = 'prod_repair'+i;
						var warranty = 'prod_war'+i;
						document.getElementById(code).required = false;
						document.getElementById(date).required = false;
						document.getElementById(repair).required = false;
						document.getElementById(warranty).required = false;
					}
					for (var i=2; i<=4; i++)
					{
						var code = 'prod_code'+i;
						var date = 'prod_date'+i;
						var repair = 'prod_repair'+i;
						var warranty = 'prod_war'+i;
						document.getElementById(code).required = true;
						document.getElementById(date).required = true;
						document.getElementById(repair).required = true;
						document.getElementById(warranty).required = true;
					}
					break;
				case 4:
					document.getElementById('prod2').style.display = "block";
					document.getElementById('prod3').style.display = "block";
					document.getElementById('prod4').style.display = "block";
					document.getElementById('prod5').style.display = "block";
					for (var i=2; i<=5; i++)
					{
						var code = 'prod_code'+i;
						var date = 'prod_date'+i;
						var repair = 'prod_repair'+i;
						var warranty = 'prod_war'+i;
						document.getElementById(code).required = true;
						document.getElementById(date).required = true;
						document.getElementById(repair).required = true;
						document.getElementById(warranty).required = true;
					}
					break;
				default:
					document.getElementById('prod2').style.display = "none";
					document.getElementById('prod3').style.display = "none";
					document.getElementById('prod4').style.display = "none";
					document.getElementById('prod5').style.display = "none";
					for (var i=2; i<=5; i++)
					{
						var code = 'prod_code'+i;
						var date = 'prod_date'+i;
						var repair = 'prod_repair'+i;
						var warranty = 'prod_war'+i;
						document.getElementById(code).required = false;
						document.getElementById(date).required = false;
						document.getElementById(repair).required = false;
						document.getElementById(warranty).required = false;
					}
					break;
			}
	}

	function warranty_selected(id, selectedObj)
	{
		var div_name = 'cost'+id;
		var div = document.getElementById(div_name);
		var id_name = 'rp_cost'+id;
		switch(selectedObj){
			case 0:
				div.style.display = "none"
				document.getElementById(id_name).required = false;
			case 1:
				div.style.display = "none";
				document.getElementById(id_name).required = false;
				break;
			default:
				div.style.display = "block";
				document.getElementById(id_name).required = true;
			break;
		}
	}
</script>