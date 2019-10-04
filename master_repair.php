<?php 
      session_start();

      if(empty($_SESSION['permission']))
	  {
		 header('location: login.php');
	  }

	  include('PHP/connect.php');

	  $sql = "SELECT DISTINCT LEFT(`repair_num`, 2) AS `repair_year` FROM `repair_item`;";
	  $rp_year = mysqli_query($conn, $sql);
	  $rpy = "";
	  while($row = mysqli_fetch_array($rp_year))
	  {
	   $rpy .= "<option value='$row[0]'>20".$row[0]."</option>";
	  }
?>
<!DOCTYPE>
<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - master repair</title>
	<style>
		.fit 
		{
			white-space: nowrap;
			width: 1%;
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container">
  
	    <div class="row">
	        
	       <nav class="navbar navbar-inverse navbar-expand-lg fixed-top">
	          <div class="container">
	            <!-- Brand and toggle get grouped for better mobile display -->
	            <div class="navbar-header">
	              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-3">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	              </button>
	              <a class="navbar-brand" href="#">ALBEDO</a>
	            </div>
	        
	            <!-- Collect the nav links, forms, and other content for toggling -->
	            <div class="collapse navbar-collapse" id="navbar-collapse-3">
	              <ul class="nav navbar-nav">
	                    <li class="nav-item"><a class="nav-link" href="Dashboard.php">Dashboard</a></li>
	                    <li class="nav-item"><a class="nav-link" href="repair_order.php">Repair Order</a></li>
	                    <li class="nav-item"><a class="nav-link" href="product.php">Product</a></li>
	                    <li class="nav-item"><a class="nav-link" href="Customer.php">Customer</a></li>
	                    <li class="nav-item"><a class="nav-link" href="master_repair.php">Master Repair</a></li>
	                    <li class="nav-item dropdown">
	                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">Extra Info</a>
	                        <ul class="dropdown-menu">
	                             <li class="nav-item"><a class="nav-link" href="employee.php">Employee</a></li>
	                             <li class="nav-item"><a class="nav-link" href="role.php">Role</a></li>
	                             <li class="nav-item"><a class="nav-link" href="warranty.php">Warranty</a></li>
	                             <li class="nav-item"><a class="nav-link" href="repair_location.php">Repair Location</a></li>
	                             <li class="nav-item"><a class="nav-link" href="store.php">Store</a></li>
	                        </ul>
	                    </li>
	                    <ul class="nav navbar-nav right">
	                      <li><a><i class="fas fa-user"></i>
	                        <?php if(!empty($_SESSION['name']))
	                        { 
	                          echo $_SESSION['name'];
	                        } ?>
	                      </a></li>
	                      <li><a href="signout.php">Sign Out</a></li>
	                    </ul>
	                  </ul>
	            </div><!-- /.navbar-collapse -->
	          </div><!-- /.container -->
	        </nav><!-- /.navbar -->
	        
	    </div>
	</div>
	<?php
		if($_SESSION['permission']['view_master_repair'] == '1')
	{ ?>
	<div class="col-md-12 form-group">
		<div class="row form-group">
			<form name="master_report" action="master_repair_export.php" method="post" onsubmit="return excelvalidate();" style="width:100%;">
				<div class="col-md-1 offset-md-3 form-group">
					<label style="font-size: 20px;">year</label>
				</div>
				<div class="col-md-4 form-group">
					<select class="form-control" name="year" required="required" onchange="year_selected(this.value);">
						<option></option>
						<?php echo $rpy; ?>
					</select>
				</div>
				<div class="col-md-1 form-group">
					<input type="text" name="excel_year" id="excel_year" style="display:none">
					<input type="submit" name="excel_submit" value="Export .xls" class="btn btn-warning">
				</div>
			</form>
		</div>
	</div>
	<?php
	}
	?>
	<div class="table-responsive-xl">
		<form method="post" action="edit_repair_order.php" onsubmit="return validate();">
			<table class="table table-hover table-bordered" id="table">
				<thead class="thead-light">
					<tr>
						<th></th>
						<th scope="col" class="fit">ส่งซ่อม</th>
						<th scope="col" class="fit">ใบรับสินค้าส่งซ่อม</th>
						<th scope="col" class="fit">ห้าง</th>
						<th scope="col" class="fit">รหัสสินค้า</th>
						<th scope="col" class="fit">แบบ</th>
						<th scope="col" class="fit">รุ่น</th>
						<th scope="col" class="fit">ชื่อสินค้า</th>
						<th scope="col" class="fit">รายละเอียดงานซ่อม</th>
						<th scope="col" class="fit">ชื่อลูกค้า</th>
						<th scope="col" class="fit">เบอร์โทร</th>
						<th scope="col" class="fit">การรับประกัน</th>
						<th scope="col" class="fit">วันที่ซื้อ</th>
						<th scope="col" class="fit">ค่าใช้จ่าย</th>
						<th scope="col" class="fit">เลขที่ PRO</th>
						<th scope="col" class="fit">วันที่ ได้รับเงิน</th>
						<th scope="col" class="fit">สถานที่ซ่อม</th>
						<th scope="col" class="fit">วันที่ รับจากลูกค้า</th>
						<th scope="col" class="fit">วันที่ ถึงบริษัท</th>
						<th scope="col" class="fit">จำนวนวัน</th>
						<th scope="col" class="fit">ส่งเข้าโรงงาน</th>
						<th scope="col" class="fit">รับจากโรงงาน</th>
						<th scope="col" class="fit">จำนวนวัน</th>
						<th scope="col" class="fit">สถานะ</th>
						<th scope="col" class="fit">ใช้เวลา (ออฟฟิศ-โรงงาน)</th>
						<th scope="col" class="fit">วันที่ ส่งคืนห้าง</th>
						<th scope="col" class="fit">การขนส่ง</th>
						<th scope="col" class="fit">ผู้ส่ง</th>
						<th scope="col" class="fit">Complete</th>
						<th scope="col" class="fit">หมายเหตุ</th>
						<th scope="col" class="fit">จำนวนวันทั้งหมด</th>
						<th scope="col" class="fit">สถานะงานซ่อม</th>
					</tr>
				</thead>
				<?php
					include('PHP/connect.php');
					$year = date("y");
					$sql = "SELECT `tbl1`.`repair_num`, `tbl1`.`form_num`, `tbl1`.`dept_name`, `tbl1`.`prod_code`, `tbl1`.`size`, `tbl1`.`collection`, `tbl1`.`detail`, `tbl1`.`repair_detail`, `tbl1`.`cust_name`, `tbl1`.`tel`, `tbl1`.`warranty_desc`, `tbl1`.`purchased_date`, `tbl1`.`cost`, `tbl1`.`pro_num`, `tbl1`.`money_received_date`, `tbl1`.`location_name`, `tbl1`.`received_from_cust`, `tbl1`.`arrived_at_comp`, `tbl1`.`datecount1`, `tbl1`.`send_factory_date`, `tbl1`.`received_from_factory`, `tbl1`.`datecount2`, `tbl1`.`status1`, (`tbl1`.`datecount1` + `tbl1`.`datecount2`) AS office_factory_datecount, `tbl1`.`return_dept_date`, `tbl1`.`send_method`, `tbl1`.`emp_name`, `tbl1`.`complete`, `tbl1`.`note`, `tbl1`.`repair_datecount`, CASE WHEN `tbl1`.`repair_datecount` < 46 THEN 'ในกำหนด' WHEN `tbl1`.`repair_datecount` >= 46 THEN 'เกินกำหนด' ELSE NULL END AS status2 FROM (SELECT `repair_item`.`repair_num`, `repair_item`.`form_num`, `store`.`dept_name`, `repair_item`.`prod_code`, `product`.`size`, `product`.`collection`, `product`.`detail`, `repair_item`.`repair_detail`, `customer`.`cust_name`, `customer`.`tel`, `warranty`.`warranty_desc`, `repair_item`.`purchased_date`, `pro_number`.`cost`, `pro_number`.`pro_num`, `pro_number`.`money_received_date`, `repair_location`.`location_name`, `repair_order`.`received_from_cust`, `repair_order`.`arrived_at_comp`, DATEDIFF(`repair_order`.`arrived_at_comp`, `repair_order`.`received_from_cust`) AS datecount1, `repair_item`.`send_factory_date`, `repair_item`.`received_from_factory`, DATEDIFF(`repair_item`.`received_from_factory`, `repair_item`.`send_factory_date`) AS datecount2, CASE WHEN `repair_item`.`received_from_factory` = null THEN 'ตามงานซ่อม' ELSE null END AS status1, `repair_item`.`return_dept_date`, `repair_item`.`send_method`, `employee`.`emp_name`, CASE WHEN `repair_item`.`return_dept_date` IS NULL THEN 'N' WHEN `repair_item`.`return_dept_date` IS NOT NULL THEN 'Y' END AS complete, `repair_item`.`note`, DATEDIFF(`repair_item`.`return_dept_date`, `repair_order`.`received_from_cust`) AS repair_datecount FROM `repair_item` LEFT JOIN `repair_order` ON `repair_item`.`form_num` = `repair_order`.`form_num` LEFT JOIN `customer` ON `repair_order`.`cust_id` = `customer`.`cust_id` LEFT JOIN `warranty` ON `repair_item`.`warranty_type` = `warranty`.`warranty_id` LEFT JOIN `repair_location` ON `repair_item`.`repair_location` = `repair_location`.`location_id` LEFT JOIN `employee` ON `repair_item`.`person_sent` = `employee`.`emp_id` LEFT JOIN `pro_number` ON `repair_item`.`repair_num` = `pro_number`.`repair_num` LEFT JOIN `store` ON `repair_order`.`dept_store` = `store`.`dept_id` LEFT JOIN `product` ON `product`.`item` = `repair_item`.`prod_code`) AS tbl1 WHERE `tbl1`.`repair_num` LIKE '".$year."%';";
			
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result))
					{
						echo "<tr>
						<td>
							<input type='submit' value='edit' style='display:none' id='".$row[0]."' class='btn btn-primary'>
						</td>
						<td class='fit'>".$row[0]."</td>
						<td class='fit'>".$row[1]."</td>
						<td class='fit'>".$row[2]."</td>
						<td class='fit'>".$row[3]."</td>
						<td class='fit'>".$row[4]."</td>
						<td class='fit'>".$row[5]."</td>
						<td class='fit'>".$row[6]."</td>
						<td class='fit'>".$row[7]."</td><td class='fit'>".$row[8]."</td><td class='fit'>".$row[9]."</td><td class='fit'>".$row[10]."</td><td class='fit'>".$row[11]."</td><td class='fit'>".$row[12]."</td><td class='fit'>".$row[13]."</td><td class='fit'>".$row[14]."</td><td class='fit'>".$row[15]."</td><td class='fit'>".$row[16]."</td><td class='fit'>".$row[17]."</td><td class='fit'>".$row[18]."</td><td class='fit'>".$row[19]."</td><td class='fit'>".$row[20]."</td><td class='fit'>".$row[21]."</td><td class='fit'>".$row[22]."</td><td class='fit'>".$row[23]."</td><td class='fit'>".$row[24]."</td><td class='fit'>".$row[25]."</td><td class='fit'>".$row[26]."</td><td class='fit'>".$row[27]."</td><td class='fit'>".$row[28]."</td><td class='fit'>".$row[29]."</td><td class='fit'>".$row[30]."</td></tr>";
					}
					mysqli_close($conn);
				?>
			</table>
			<input type="text" id="repair_num2" name="repair_num2" required="required" style="display:none">
		</form>
	</div>
		<?php include('PHP/import.php'); ?>
</body>
</html>

<script>
	var table = document.getElementById("table");
	var prev = null;
	for(var i=0; i<table.rows.length; i++)
	{
		table.rows[i].onclick = function()
		{
				if(prev != null)
					{
						document.getElementById(prev).style.display = "none";
					}
				document.getElementById("repair_num2").value = this.cells[1].innerHTML;
				var rpn = document.getElementById("repair_num2").value;
				var x = document.getElementById(rpn);
				if(x.style.display === "none")
				{
					x.style.display = "block";
				} else {
					x.style.display = "none";
				}
				prev = rpn;
		}
	}

	function validate()
	{
		if(document.getElementById("repair_num2").value == "")
		{
			alert( "Please select order you want to edit" );
            return false;
		}
	}

	function excelvalidate()
	{
		if(document.master_report.year.value == "")
		{
			alert("Year field is required");
			return false;
		}
	}

	function year_selected(year)
  	{
  		document.getElementById("excel_year").value = year;
  	}
</script>
