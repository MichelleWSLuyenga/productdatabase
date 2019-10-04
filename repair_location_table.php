	<div class="table table-sm">
		<form method="post" name="intable">
			<table class="table table-hover table-bordered" id="table">
				<thead class="thead-light">
					<tr>
						<th scope="col">สถานที่ซ่อม</th>
						<th scope="col">ที่อยู่</th>
						<?php
							if($_SESSION['permission']['edit_repair_location'] == '1' || $_SESSION['permission']['delete_repair_location'] == '1')
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

					$sql = "SELECT `repair_location`.*, count(`repair_item`.`repair_location`) AS exist FROM `repair_location` LEFT JOIN `repair_item` ON `repair_location`.`location_id` = `repair_item`.`repair_location` GROUP BY `repair_location`.`location_id` ORDER BY `location_name` ASC;";
			
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result))
					{
						$exist = $row[3];
						if($exist == "0")
						{
							echo "<tr>
							<td scope='row' style='display:none'>".$row[0]."</td>
							<td>".$row[1]."</td>
							<td>".$row[2]."</td>";

							if($_SESSION['permission']['edit_repair_location'] == '1' && $_SESSION['permission']['delete_repair_location'] == '1')
							{
								echo "<td>
									<center>
										<input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary' onclick='frm_sbmt(1)'>&nbsp;
										<input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger' onclick='frm_sbmt(2)'>
									</center>
								</td></tr>";
							} 
							elseif ($_SESSION['permission']['edit_repair_location'] == '1' && $_SESSION['permission']['delete_repair_location'] == '0') 
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
							elseif ($_SESSION['permission']['edit_repair_location'] == '0' && $_SESSION['permission']['delete_repair_location'] == '1')
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
							<td>".$row[2]."</td>";

							if($_SESSION['permission']['edit_repair_location'] == '1' && $_SESSION['permission']['delete_repair_location'] == '1')
							{
								echo "<td>
								<center>
									<input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary' onclick='frm_sbmt(1)'>&nbsp;
									<input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger' onclick='frm_sbmt(2)' disabled='disabled'>
								</center>
								</td></tr>";
							}
							elseif ($_SESSION['permission']['edit_repair_location'] == '1' && $_SESSION['permission']['delete_repair_location'] == '0') 
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
							elseif($_SESSION['permission']['edit_repair_location'] == '0' && $_SESSION['permission']['delete_repair_location'] == '1')
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
			<input type="text" id="site_id" name="site_id" required="required" style="display:none">
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
				document.getElementById("site_id").value = this.cells[0].innerHTML;
				var rpl = document.getElementById("site_id").value;
				var x = table.getElementsByClassName(rpl);
				if(x[0].style.display == "none")
				{
					x[0].style.display = "inline";
					x[1].style.display = "inline";
				} else {
					x[0].style.display = "none";
					x[1].style.display = "none";
				}
				prev = rpl;
		}
	}

	function validate()
	{
		if(document.getElementById("site_id").value == "")
		{
			alert( "Please select order you want to edit" );
            return false;
		}
	}

	function frm_sbmt(num)
	{
		if(num == 1)
		{
			document.intable.action = "edit_repair_location.php";
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