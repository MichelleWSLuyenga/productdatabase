<?php

	session_start();
	require 'fpdf/fpdf.php';
	define('FPDF_FONTPATH','font/');
	include 'PHP/connect.php';

	$sql = "SELECT `repair_order`.`form_num`, `store`.`dept_name`, `customer`.`cust_name`, `repair_item`.`repair_num`, `pro_number`.`pro_num`, `repair_item`.`prod_code`, `repair_item`.`repair_detail`, `pro_number`.`cost`, `pro_number`.`money_received_date` FROM `repair_order` INNER JOIN `repair_item` ON `repair_item`.`form_num` = `repair_order`.`form_num` INNER JOIN `pro_number` ON `pro_number`.`repair_num` = `repair_item`.`repair_num` INNER JOIN `customer` ON `customer`.`cust_id` = `repair_order`.`cust_id` INNER JOIN `store` ON `store`.`dept_id` = `repair_order`.`dept_store` WHERE `repair_order`.`form_num` = '".$_POST['form_num']."' ORDER BY `repair_item`.`repair_num`;";

	$result = mysqli_query($conn, $sql);
	$info = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$info[] = $row;
	}
	
	$sum = 0;
	foreach($info as $item)
	{
		$sum += $item['cost'];
	}
	
	if($sum == 0)
	{
		$_SESSION['nocost'] = "<div class='alert alert-danger'>"."This form does not require payment"."</div>";
  		header("location: Dashboard.php");
  		mysqli_close($conn);
  		exit;
	}
	else
	{

		$pdf = new FPDF('P', 'mm', 'A4');
		$pdf -> AddPage();
		$pdf -> AddFont('angsa', '', 'angsa.php');
		$pdf -> AddFont('angsa', 'b', 'angsab.php');
		$pdf -> SetFont('angsa', 'b', 20);

		
		$pdf -> Cell(189, 12, iconv('UTF-8', 'TIS-620', 'ใบรับเงินชั่วคราว'), 0, 1, 'C');
		$pdf -> Cell(189, 24, iconv('UTF-8', 'TIS-620', ''), 0, 1);

		$pdf -> SetFont('angsa', '', 16);
		$pdf -> Cell(20, 8, iconv('UTF-8', 'TIS-620', 'ชื่อลูกค้า :'), 0, 0);
		$pdf -> Cell(20, 8, iconv('UTF-8', 'TIS-620', $info[0]['cust_name']), 0, 0);
		$pdf -> Cell(100, 8, iconv('UTF-8', 'TIS-620', ''), 0, 0);
		$pdf -> Cell(29, 8, iconv('UTF-8', 'TIS-620', 'เลขที่ใบซ่อม :'), 0, 0);
		$pdf -> Cell(20, 8, iconv('UTF-8', 'TIS-620', $info[0]['form_num']), 0, 1);

		$pdf -> Cell(20, 8, iconv('UTF-8', 'TIS-620', 'ห้าง :'), 0, 0);
		$pdf -> Cell(20, 8, iconv('UTF-8', 'TIS-620', $info[0]['dept_name']), 0, 0);
		$pdf -> Cell(100, 8, iconv('UTF-8', 'TIS-620', ''), 0, 0);
		$pdf -> Cell(29, 8, iconv('UTF-8', 'TIS-620', 'วันที่ :'), 0, 0);
		$pdf -> Cell(20, 8, iconv('UTF-8', 'TIS-620', $info[0]['money_received_date']), 0, 1);

		$pdf -> Cell(189, 24, iconv('UTF-8', 'TIS-620', ''), 0, 1);

		$pdf -> Cell(30, 8, iconv('UTF-8', 'TIS-620', 'เลขที่ส่งซ่อม'), 1, 0, 'C');
		$pdf -> Cell(30, 8, iconv('UTF-8', 'TIS-620', 'เลขที่ส่งบัญชี'), 1, 0, 'C');
		$pdf -> Cell(30, 8, iconv('UTF-8', 'TIS-620', 'Code'), 1, 0, 'C');
		$pdf -> Cell(69, 8, iconv('UTF-8', 'TIS-620', 'รายการ'), 1, 0, 'C');
		$pdf -> Cell(30, 8, iconv('UTF-8', 'TIS-620', 'ราคา'), 1, 1, 'C');

		$max = sizeof($info);
		for($i=0; $i<$max; $i++)
		{
			$pdf -> Cell(30, 8, iconv('UTF-8', 'TIS-620', $info[$i]['repair_num']), 1, 0);
			$pdf -> Cell(30, 8, iconv('UTF-8', 'TIS-620', $info[$i]['pro_num']), 1, 0);
			$pdf -> Cell(30, 8, iconv('UTF-8', 'TIS-620', $info[$i]['prod_code']), 1, 0);
			$pdf -> Cell(69, 8, iconv('UTF-8', 'TIS-620', $info[$i]['repair_detail']), 1, 0);
			$pdf -> Cell(30, 8, iconv('UTF-8', 'TIS-620', $info[$i]['cost']), 1, 1, 'R');
		}

		$pdf -> Cell(129, 8, iconv('UTF-8', 'TIS-620', ''), 0, 0);
		$pdf -> Cell(30, 8, iconv('UTF-8', 'TIS-620', 'รวม :'), 0, 0, 'C');
		$pdf -> Cell(30, 8, iconv('UTF-8', 'TIS-620', $sum), 1, 1, 'R');

		$pdf -> Cell(189, 12, iconv('UTF-8', 'TIS-620', ''), 0, 1);

		$pdf -> Cell(18, 8, iconv('UTF-8', 'TIS-620', 'หมายเหตุ :'), 0, 0);
		$pdf -> Cell(18, 8, iconv('UTF-8', 'TIS-620', 'เงินสด'), 0, 0);

		$pdf -> Cell(189, 60, iconv('UTF-8', 'TIS-620', ''), 0, 1);

		$pdf -> Cell(130, 8, iconv('UTF-8', 'TIS-620', ''), 0, 0);
		$pdf -> Cell(59, 8, iconv('UTF-8', 'TIS-620', 'ผู้รับของ ..............................................'), 0, 1);
		$pdf -> Cell(189, 8, iconv('UTF-8', 'TIS-620', ''), 0, 1);

		$pdf -> Cell(130, 8, iconv('UTF-8', 'TIS-620', ''), 0, 0);
		$pdf -> Cell(59, 8, iconv('UTF-8', 'TIS-620', 'ผู้ส่งของ ..............................................'), 0, 1);
		$pdf -> Cell(189, 8, iconv('UTF-8', 'TIS-620', ''), 0, 1);

		$pdf -> Cell(130, 8, iconv('UTF-8', 'TIS-620', ''), 0, 0);
		$pdf -> Cell(59, 8, iconv('UTF-8', 'TIS-620', 'ผู้รับเงิน ..............................................'), 0, 1);
		$pdf -> Cell(189, 8, iconv('UTF-8', 'TIS-620', ''), 0, 1);

		$pdf -> Cell(130, 8, iconv('UTF-8', 'TIS-620', ''), 0, 0);
		$pdf -> Cell(59, 8, iconv('UTF-8', 'TIS-620', 'ผู้อนุมัติ ..............................................'), 0, 1);

		$pdf -> Output();

		mysqli_close($conn);
		exit;
	}
?>