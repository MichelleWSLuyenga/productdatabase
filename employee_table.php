<?php
 include('PHP/connect.php');

 $sql = "SELECT * FROM `employee`";
 $employee = mysqli_query($conn, $sql);
 $emp = "";
 while($row = mysqli_fetch_array($employee))
 {
  $emp = $emp."<option value='$row[0]'>$row[1]</option>";
 }

 mysqli_close($conn);
?>
	<div class="table table-sm">
		<form method="post" name="intable">
			<table class="table table-hover table-bordered" id="table">
				<thead class="thead-light">
					<tr>
						<th scope="col">ชื่อ</th>
						<th scope="col">ชื่อผู้ใช้</th>
						<th scope="col">ตำแหน่ง</th>
						<th scope="col">Active</th>
						<?php
							if($_SESSION['permission']['edit_employee'] == '1' || $_SESSION['permission']['delete_employee'] == '1')
							{ ?>
							<th scope="col" style="width:15%;"></th>
						<?php };
						?>
					</tr>
				</thead>
				<?php
					include('PHP/connect.php');

					$sql = "SELECT `employee`.`emp_id`, `employee`.`emp_name`, `employee`.`username`, `role`.`role_name`, CASE WHEN `employee`.`active` = '1' THEN 'Yes' WHEN `employee`.`active` = '0' THEN 'No' END AS active, count(`repair_item`.`person_sent`) AS exist FROM `employee` LEFT JOIN `repair_item` ON `employee`.`emp_id` = `repair_item`.`person_sent` LEFT JOIN `role` ON `role`.`role_id` = `employee`.`role` GROUP BY `employee`.`emp_id` ORDER BY `employee`.`emp_name` ASC;";
			
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result))
					{
						$exist = $row[5];
						if($exist == "0")
						{
							echo "<tr>
							<td scope='row' style='display:none'>".$row[0]."</td>
							<td>".$row[1]."</td>
							<td>".$row[2]."</td>
							<td>".$row[3]."</td>
							<td>".$row[4]."</td>";

							if($_SESSION['permission']['edit_employee'] == '1' && $_SESSION['permission']['delete_employee'] == '1')
							{
								echo "<td>
								<center>
									<input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary' onclick='frm_sbmt(1)'>&nbsp;
									<input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger' onclick='frm_sbmt(2)'>
								</center>
								</td></tr>";
							} 
							elseif($_SESSION['permission']['edit_employee'] == '1' && $_SESSION['permission']['delete_employee'] == '0') 
							{
								echo "<td>
								<center>
									<input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary' onclick='frm_sbmt(1)'>
								</center>
								</td><tr>
								<td style='display:none'>
									<input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger'>
								</td></tr>";
							}
							elseif($_SESSION['permission']['edit_employee'] == '0' && $_SESSION['permission']['delete_employee'] == '1')
							{
								echo "<td style='display:none'>
									<input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary'>
								</td><td>
								<center>
									<input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger' onclick='frm_sbmt(2)'>
								</center>
								</td></tr>";
							} 
							else
							{
								echo "<td style='display:none'>
								<center>
									<input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary'>&nbsp;
									<input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger'>
								</center>
								</td></tr>";
							}
						} else {
							echo "<tr>
							<td scope='row' style='display:none'>".$row[0]."</td>
							<td>".$row[1]."</td>
							<td>".$row[2]."</td>
							<td>".$row[3]."</td>
							<td>".$row[4]."</td>";

							if($_SESSION['permission']['edit_employee'] == '1' && $_SESSION['permission']['delete_employee'] == '1')
							{
								echo "<td>
								<center>
									<input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary' onclick='frm_sbmt(1)'>&nbsp;
									<input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger' onclick='frm_sbmt(2)' disabled='disabled'>
								</center>
								</td></tr>";
							}
							elseif($_SESSION['permission']['edit_employee'] == '1' && $_SESSION['permission']['delete_employee'] == '0') 
							{
								echo "<td>
								<center>
									<input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary' onclick='frm_sbmt(1)'>
								</center>
								</td>
								<td style='display:none'>
									<input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger' disabled='disabled'>
								</td></tr>";
							}
							elseif($_SESSION['permission']['edit_employee'] == '0' && $_SESSION['permission']['delete_employee'] == '1')
							{
								echo "<td style='display:none'>
								<input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary'></td>
								<td>
								<center><input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger' disabled='disabled'></center>
								</td></tr>";
							}
							else
							{
								echo "<td style='display:none'>
								<center><input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary'>&nbsp;
								<input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger' disabled='disabled'>
								</center></td></tr>";
							}
						}
					}
					mysqli_close($conn);
				?>
				</table>
			<input type="text" id="emp_id" name="emp_id" required="required" style="display:none">
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
				document.getElementById("emp_id").value = this.cells[0].innerHTML;
				var emp_id = document.getElementById("emp_id").value;
				var x = table.getElementsByClassName(emp_id);
				if(x[0].style.display == "none")
				{
					x[0].style.display = "inline";
					x[1].style.display = "inline";
				} else {
					x[0].style.display = "none";
					x[1].style.display = "none";
				}
				prev = emp_id;
		}
	}

	function validate()
	{
		if(document.getElementById("emp_id").value == "")
		{
			alert( "Please select order you want to edit" );
            return false;
		}
	}

	function frm_sbmt(num)
	{
		if(num == 1)
		{
			document.intable.action = "edit_employee.php";
			document.intable.submit();
		}

		if(num == 2)
		{
			var r = confirm("Are you sure you want to delete this?");
			if(r == true)
			{
				document.intable.action = "delete.php";
				document.intable.submit();
			}
		}	
	}
</script>