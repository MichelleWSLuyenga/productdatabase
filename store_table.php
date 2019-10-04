	<div class="table table-sm">
		<form method="post" name="intable">
			<table class="table table-hover table-bordered" id="table">
				<thead class="thead-light">
					<tr>
						<th scope="col">ห้าง</th>
						<?php
							if($_SESSION['permission']['edit_store'] == '1' || $_SESSION['permission']['delete_store'] == '1')
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

					$sql = "SELECT `store`.*, count(`repair_order`.`dept_store`) AS exist FROM `store` LEFT JOIN `repair_order` ON `store`.`dept_id` = `repair_order`.`dept_store` GROUP BY `store`.`dept_id` ORDER BY `store`.`dept_name` ASC;";
			
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result))
					{
						$exist = $row[2];
						if($exist == "0")
						{
							echo "<tr>
							<td scope='row' style='display:none'>".$row[0]."</td>
							<td>".$row[1]."</td>";

							if($_SESSION['permission']['edit_store'] == '1' && $_SESSION['permission']['delete_store'] == '1')
							{
								echo "<td>
								<center>
									<input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary' onclick='frm_sbmt(1)'>&nbsp;
									<input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger' onclick='frm_sbmt(2)'>
								</center>
							</td></tr>";
							}
							elseif($_SESSION['permission']['edit_store'] == '1' && $_SESSION['permission']['delete_store'] == '0')
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
							elseif($_SESSION['permission']['edit_store'] == '0' && $_SESSION['permission']['delete_store'] == '1')
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
							<td style='display:none'>".$row[0]."</td>
							<td>".$row[1]."</td>";

							if($_SESSION['permission']['edit_store'] == '1' && $_SESSION['permission']['delete_store'] == '1')
							{
								echo "<td>
								<center>
									<input type='submit' value='edit' style='display:none' class='".$row[0]." btn btn-primary' onclick='frm_sbmt(1)'>&nbsp;
									<input type='button' value='delete' style='display:none' class='".$row[0]." btn btn-danger' onclick='frm_sbmt(2)' disabled='disabled'>
								</center>
								</td></tr>";
							}
							elseif($_SESSION['permission']['edit_store'] == '1' && $_SESSION['permission']['delete_store'] == '0') 
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
							elseif($_SESSION['permission']['edit_store'] == '0' && $_SESSION['permission']['delete_store'] == '1')
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
			<input type="text" id="store_id" name="store_id" required="required" style="display:none">
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
				document.getElementById("store_id").value = this.cells[0].innerHTML;
				var store_id = document.getElementById("store_id").value;
				var x = table.getElementsByClassName(store_id);
				if(x[0].style.display == "none")
				{
					x[0].style.display = "inline";
					x[1].style.display = "inline";
				} else {
					x[0].style.display = "none";
					x[1].style.display = "none";
				}
				prev = store_id;
		}
	}

	function validate()
	{
		if(document.getElementById("store_id").value == "")
		{
			alert( "Please select order you want to edit" );
            return false;
		}
	}

	function frm_sbmt(num)
	{
		if(num == 1)
		{
			document.intable.action = "edit_store.php";
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