
		<div class="table table-sm">
			<table class="table table-hover table-bordered" >
				<thead style="background-color: #522203; color: white;">
					<tr>
						<th scope="col">ส่งซ่อม</th>
						<th scope="col">รหัสสินค้า</th>
						<th scope="col">รายละเอียดงานซ่อม</th>
						<th scope="col">การรับประกัน</th>
						<th scope="col">ห้าง</th>
						<th scope="col">ชื่อลูกค้า</th>
					</tr>
				</thead>
				<?php
					include('PHP/connect.php');

					$sql = "SELECT `repair_item`.`repair_num`, `repair_item`.`prod_code`, `repair_item`.`repair_detail`, `warranty`.`warranty_desc`, `store`.`dept_name`, `customer`.`cust_name` FROM `repair_item` LEFT JOIN `repair_order` ON `repair_order`.`form_num` = `repair_item`.`form_num` LEFT JOIN `warranty` ON `warranty`.`warranty_id` = `repair_item`.`warranty_type` LEFT JOIN `store` ON `store`.`dept_id` = `repair_order`.`dept_store` LEFT JOIN `customer` ON `customer`.`cust_id` = `repair_order`.`cust_id` WHERE `repair_order`.`arrived_at_comp` IS NOT NULL AND `repair_item`.`return_dept_date` IS NULL ORDER BY `repair_item`.`repair_num`;";
			
					$result = mysqli_query($conn, $sql);
					$count = 0;
					while($row = mysqli_fetch_array($result))
					{
						
						{
							echo "<tr>
							<td>".$row[0]."</td>
							<td>".$row[1]."</td>
							<td>".$row[2]."</td>
							<td>".$row[3]."</td>
							<td>".$row[4]."</td>
							<td>".$row[5]."</td></tr>";
							$count ++;
						}
						
					}
					echo '<tr><td></td><td></td><td></td><td></td><th>รวม</th><th>'.$count.'</th></tr>';

					mysqli_close($conn);
				?>
		</table>
	</div>