<?php
	include ('PHP/connect.php');
	if(isset($_POST['show']))
	{
		$sql = "SELECT `repair_item`.`repair_num`, `repair_order`.`received_from_cust`, `repair_order`.`arrived_at_comp`, `repair_item`.`send_factory_date`, `repair_item`.`received_from_factory`, `repair_item`.`return_dept_date` FROM `repair_item` LEFT JOIN `repair_order` ON `repair_order`.`form_num` = `repair_item`.`form_num` WHERE `repair_item`.`repair_num` = '".$_POST['repair_num']."';";

		$queryObj = mysqli_query($conn, $sql);
		$info = mysqli_fetch_assoc($queryObj);

		$sql = "SELECT * FROM `status_tracking`;";
		$queryObj = mysqli_query($conn, $sql);
		$status = array();
		while($row = mysqli_fetch_assoc($queryObj))
		{
			$status[$row['status_id']] = array('status_name' => $row['status_name'], 'status_word_display' => $row['status_word_display']);
		}
	}
?>

<div class="col-md-12">
		
			<?php 
				if(!empty($info['received_from_cust']))
					{ ?>
						<div class="row">
							<div class="col-md-3 offset-md-3">
								<p><?php echo $info['received_from_cust']; ?></p>
							</div>
							<div class="col-md-3">
								<p><?php echo $status['1']['status_word_display']; ?></p>
							</div>
						</div>
			<?php	} ?>
			<?php 
				if(!empty($info['arrived_at_comp']))
					{ ?>
						<div class="row">
							<div class="col-md-3 offset-md-3">
								<p><?php echo $info['arrived_at_comp']; ?></p>
							</div>
							<div class="col-md-3">
								<p><?php echo $status['2']['status_word_display']; ?></p>
							</div>
						</div>
			<?php	} ?>
			<?php 
				if(!empty($info['send_factory_date']))
					{ ?>
						<div class="row">
							<div class="col-md-3 offset-md-3">
								<p><?php echo $info['send_factory_date']; ?></p>
							</div>
							<div class="col-md-3">
								<p><?php echo $status['3']['status_word_display']; ?></p>
							</div>
						</div>
			<?php	} ?>
			<?php 
				if(!empty($info['received_from_factory']))
					{ ?>
						<div class="row">
							<div class="col-md-3 offset-md-3">
								<p><?php echo $info['received_from_factory']; ?></p>
							</div>
							<div class="col-md-3">
								<p><?php echo $status['4']['status_word_display']; ?></p>
							</div>
						</div>
			<?php	} ?>
			<?php 
				if(!empty($info['return_dept_date']))
					{ ?>
						<div class="row">
							<div class="col-md-3 offset-md-3">
								<p><?php echo $info['return_dept_date']; ?></p>
							</div>
							<div class="col-md-3">
								<p><?php echo $status['5']['status_word_display']; ?></p>
							</div>
						</div>
			<?php	} ?>
	
</div>