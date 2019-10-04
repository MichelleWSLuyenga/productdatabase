
	<div class="table table-sm">
		<form method="post" name="intable" onsubmit="return validate();">
			<table class="table table-hover table-bordered" id="table">
				<thead class="thead-light">
					<tr>
						<th scope="col">ชื่อ</th>
						<th scope="col">เบอร์โทร</th>
						<?php
							if($_SESSION['permission']['edit_customer'] == '1' || $_SESSION['permission']['delete_customer'] == '1')
							{ 
						?>
							<th scope="col" style="width:15%;"></th>
						<?php 
							}
						?>
					</tr>
				</thead>
				<?php
					include('PHP/connect.php');

					$sql = "SELECT `customer`.*, count(`repair_order`.`cust_id`) AS exist FROM `customer` LEFT JOIN `repair_order` ON `repair_order`.`cust_id` = `customer`.`cust_id` GROUP BY `customer`.`cust_id` ORDER BY `customer`.`cust_name` ASC;";
			
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result))
					{
						$exist = $row[3];
						if($exist == "0")
						{
							echo "<tr><td scope='row' style='display:none;'>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td>";

							if($_SESSION['permission']['edit_customer'] == '1' && $_SESSION['permission']['delete_customer'] == '1')
							{
								echo "<td>
								<center>
									<input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary' onclick='frm_sbmt(1)'>&nbsp;
									<input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger' onclick='frm_sbmt(2)'>
								</center>
							</td></tr>";
							}
							elseif($_SESSION['permission']['edit_customer'] == '1' && $_SESSION['permission']['delete_customer'] == '0')
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
							elseif($_SESSION['permission']['edit_customer'] == '0' && $_SESSION['permission']['delete_customer'] == '1')
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
							echo "<tr><td scope='row' style='display:none;'>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td>";

							if($_SESSION['permission']['edit_customer'] == '1' && $_SESSION['permission']['delete_customer'] == '1')
							{
								echo "<td>
								<center>
									<input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary' onclick='frm_sbmt(1)'>&nbsp;
									<input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger' onclick='frm_sbmt(2)' disabled='disabled'>
								</center>
								</td></tr>";
							}
							elseif($_SESSION['permission']['edit_customer'] == '1' && $_SESSION['permission']['delete_customer'] == '0') 
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
							elseif($_SESSION['permission']['edit_customer'] == '0' && $_SESSION['permission']['delete_customer'] == '1')
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
			<input type="text" id="cust_id" name="cust_id" required="required" style="display:none">
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
				document.getElementById("cust_id").value = this.cells[0].innerHTML;
				var cust = document.getElementById("cust_id").value;
				var x = table.getElementsByClassName(cust);

				if(x[0].style.display == "none")
				{
					x[0].style.display = "inline";
					x[1].style.display = "inline";
				} else {
					x[0].style.display = "none";
					x[1].style.display = "none";
				}
				prev = cust;
		}
	}

	function validate()
	{
		if(document.getElementById("cust_id").value == "")
		{
			alert( "Please select order you want to edit" );
            return false;
		}
	}

	function frm_sbmt(num)
	{
		if(num == 1)
		{
			document.intable.action = "edit_customer.php";
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