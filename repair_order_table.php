</div>
</div>
	<div class="table table-responsive-xl">
		<form method="post" name="intable">
			<table class="table table-hover table-bordered" id="table">
				<thead class="thead-light">
					<tr>
						<?php
							if($_SESSION['permission']['update_repair_order'] == '1' || $_SESSION['permission']['edit_repair_order'] == '1')
							{ 
						?>
							<th></th>
						<?php 
							}
						?>
						<th scope="col" class="fit">ส่งซ่อม</th>
						<th scope="col" class="fit">ใบรับสินค้าส่งซ่อม</th>
						<th scope="col" class="fit">รหัสสินค้า</th>
						<th scope="col" class="fit">รายละเอียดงานซ่อม</th>
						<th scope="col" class="fit">การรับประกัน</th>
						<th scope="col" class="fit">วันที่ซื้อ</th>
						<th scope="col" class="fit">สถานที่ซ่อม</th>
						<th scope="col" class="fit">ส่งเข้าโรงงาน</th>
						<th scope="col" class="fit">รับจากโรงงาน</th>
						<th scope="col" class="fit">ส่งคืนห้าง</th>
						<th scope="col" class="fit">การขนส่ง</th>
						<th scope="col" class="fit">ผู้ส่ง</th>
						<th scope="col" class="fit">หมายเหตุ</th>
					</tr>
				</thead>
				<?php
					include('PHP/connect.php');

					$sql = "SELECT `repair_item`.*, `warranty`.`warranty_desc`, `repair_location`.`location_name`, `employee`.`emp_name` FROM `repair_item` LEFT JOIN `warranty` ON `warranty`.`warranty_id` = `repair_item`.`warranty_type` LEFT JOIN `repair_location` ON `repair_location`.`location_id` = `repair_item`.`repair_location` LEFT JOIN `employee` ON `employee`.`emp_id` = `repair_item`.`person_sent` ORDER BY `repair_item`.`repair_num`;";
			
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result))
					{
							echo "<tr>
							<td scope='row' style='display:none'>".$row[0]."</td>";

							if($_SESSION['permission']['update_repair_order'] == '1' && $_SESSION['permission']['edit_repair_order'] == '1')
							{
								echo "<td class='fit'><center>
									<input type='submit' value='update' style='display:none' class='".$row[0]." btn btn-info' onclick='frm_sbmt(1)'>&nbsp;
									<input type='button' value='edit' style='display:none' class='".$row[0]." btn btn-primary' onclick='frm_sbmt(2)'>
									</center>
									</td>";
							}
							elseif($_SESSION['permission']['update_repair_order'] == '1' && $_SESSION['permission']['edit_repair_order'] == '0')
							{
								echo "<td class='fit'><center>
									<input type='submit' value='update' style='display:none' class='".$row[0]." btn btn-info' onclick='frm_sbmt(1)'></center></td><td style='display:none'>
									<input type='button' value='edit' style='display:none' class='".$row[0]." btn btn-primary'>
									</td>";
							}
							elseif($_SESSION['permission']['update_repair_order'] == '0' && $_SESSION['permission']['edit_repair_order'] == '1')
							{
								echo "<td style='display:none'>
									<input type='submit' value='update' style='display:none' class='".$row[0]." btn btn-info'></td><td class='fit'><center>
									<input type='button' value='edit' style='display:none' class='".$row[0]." btn btn-primary' onclick='frm_sbmt(2)'>
									</center>
									</td>";
							}
							else
							{
								echo "<td style='display:none'><center>
									<input type='submit' value='update' style='display:none' class='".$row[0]." btn btn-info'>&nbsp;
									<input type='button' value='edit' style='display:none' class='".$row[0]." btn btn-primary'>
									</center>
									</td>";
							}

							echo "<td class='fit'>".$row[0]."</td>
							<td class='fit'>".$row[1]."</td>
							<td class='fit'>".$row[2]."</td>
							<td class='fit'>".$row[3]."</td>
							<td class='fit'>".$row[13]."</td>
							<td class='fit'>".$row[5]."</td>
							<td class='fit'>".$row[14]."</td>
							<td class='fit'>".$row[7]."</td>
							<td class='fit'>".$row[8]."</td>
							<td class='fit'>".$row[9]."</td>
							<td class='fit'>".$row[10]."</td>
							<td class='fit'>".$row[15]."</td>
							<td class='fit'>".$row[12]."</td>
							</tr>";
					}

					mysqli_close($conn);
				?>
				</table>
			<input type="text" id="rpi_id" name="repair_num2" required="required" style="display:none">
		</form>
	</div>

<script language="javascript">
	var table = document.getElementById("table");
	var prev = null;
	for(var i=0; i<table.rows.length; i++)
	{
		table.rows[i].onclick = function()
		{
				if(prev != null)
					{
						table.getElementsByClassName(prev)[0].style.display = "none";
						table.getElementsByClassName(prev)[1].style.display = "none";
					}
				document.getElementById("rpi_id").value = this.cells[0].innerHTML;
				var rpi_id = document.getElementById("rpi_id").value;
				var x = table.getElementsByClassName(rpi_id);
				if(x[0].style.display == "none")
				{
					x[0].style.display = "inline";
					x[1].style.display = "inline";
				} else {
					x[0].style.display = "none";
					x[1].style.display = "none";
				}
				prev = rpi_id;
		}
	}

	function validate()
	{
		if(document.getElementById("rpi_id").value == "")
		{
			alert( "Please select order you want to edit" );
            return false;
		}
	}

	function frm_sbmt(num)
	{
		if(num == 1)
		{
			document.intable.action = "update_repair_order.php";
		}

		if(num == 2)
		{
				document.intable.action = "edit_repair_order.php";
		}
		document.intable.submit();
	}
</script>