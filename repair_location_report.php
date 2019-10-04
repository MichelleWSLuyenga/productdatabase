<?php
	
	if(isset($_POST['excel_submit']) && !empty($_POST['excel_site']) && !empty($_POST['excel_status']) && !empty($_POST['excel_year']))
	{
		require_once 'phpexcel/PHPExcel.php';
		include 'PHP/connect.php';

		$excel = new PHPExcel();
		$excel -> setActiveSheetIndex(0);

		$site = $_POST['excel_site'];
		$status = $_POST['excel_status'];
		$year = $_POST['excel_year'];
		$site_query = "";

		switch($site)
		{
			case "All":
				$site_query = "";
				break;
			default:
				$site_query = "AND `repair_location` = ".$site;

		}
		if($status == "Yes")
		{
			$sql = "SELECT `repair_item`.`repair_num`, `repair_order`.`form_num`, `repair_item`.`prod_code`, `repair_item`.`repair_detail`, `store`.`dept_name`, `customer`.`cust_name`, `repair_order`.`received_from_cust`, `repair_item`.`send_factory_date`, `repair_item`.`note`, `repair_location`.`location_name` FROM `repair_item` LEFT JOIN `repair_order` ON `repair_order`.`form_num` = `repair_item`.`form_num` LEFT JOIN `store` ON `store`.`dept_id` = `repair_order`.`dept_store` LEFT JOIN `customer` ON `customer`.`cust_id` = `repair_order`.`cust_id` LEFT JOIN `repair_location` ON `repair_location`.`location_id` = `repair_item`.`repair_location` WHERE `repair_item`.`repair_num` LIKE '".$year."%' ".$site_query." AND `repair_item`.`return_dept_date` IS NOT NULL ORDER BY `repair_item`.`repair_num`;";
		} elseif($status == "No") {
			$sql = "SELECT `repair_item`.`repair_num`, `repair_order`.`form_num`, `repair_item`.`prod_code`, `repair_item`.`repair_detail`, `store`.`dept_name`, `customer`.`cust_name`, `repair_order`.`received_from_cust`, `repair_item`.`send_factory_date`, `repair_item`.`note`, `repair_location`.`location_name` FROM `repair_item` LEFT JOIN `repair_order` ON `repair_order`.`form_num` = `repair_item`.`form_num` LEFT JOIN `store` ON `store`.`dept_id` = `repair_order`.`dept_store` LEFT JOIN `customer` ON `customer`.`cust_id` = `repair_order`.`cust_id` LEFT JOIN `repair_location` ON `repair_location`.`location_id` = `repair_item`.`repair_location` WHERE `repair_item`.`repair_num` LIKE '".$year."%' ".$site_query." AND `repair_item`.`return_dept_date` IS NULL ORDER BY `repair_item`.`repair_num`;";
		} elseif($status == "All") {
			$sql = "SELECT `repair_item`.`repair_num`, `repair_order`.`form_num`, `repair_item`.`prod_code`, `repair_item`.`repair_detail`, `store`.`dept_name`, `customer`.`cust_name`, `repair_order`.`received_from_cust`, `repair_item`.`send_factory_date`, `repair_item`.`note`, `repair_location`.`location_name` FROM `repair_item` LEFT JOIN `repair_order` ON `repair_order`.`form_num` = `repair_item`.`form_num` LEFT JOIN `store` ON `store`.`dept_id` = `repair_order`.`dept_store` LEFT JOIN `customer` ON `customer`.`cust_id` = `repair_order`.`cust_id` LEFT JOIN `repair_location` ON `repair_location`.`location_id` = `repair_item`.`repair_location` WHERE `repair_item`.`repair_num` LIKE '".$year."%' ".$site_query." ORDER BY `repair_item`.`repair_num`;";
		}

		$result = mysqli_query($conn, $sql);
		$site_name = "";
		$row = 8;
		while($data = mysqli_fetch_object($result))
		{
			$excel -> getActiveSheet()
				-> setCellValue('A'.$row, $data->repair_num)
				-> setCellValue('B'.$row, $data->form_num)
				-> setCellValue('C'.$row, $data->prod_code)
				-> setCellValue('D'.$row, $data->repair_detail)
				-> setCellValue('E'.$row, $data->dept_name)
				-> setCellValue('F'.$row, $data->cust_name)
				-> setCellValue('G'.$row, $data->received_from_cust)
				-> setCellValue('H'.$row, $data->send_factory_date)
				-> setCellValue('I'.$row, $data->note);
			$row++;
			$site_name = $data->location_name;
		}
		if(empty($site_name))
		{
			$site_name = "All";
		}

		$excel -> getActiveSheet()
			-> setCellValue('A1', 'สรุปรายการส่งซ่อม '.$site_name)
			-> setCellValue('A7', 'ส่งซ่อม')
			-> setCellValue('B7', 'เลขที่ซ่อม')
			-> setCellValue('C7', 'รหัสสินค้า')
			-> setCellValue('D7', 'รายละเอียดงานซ่อม')
			-> setCellValue('E7', 'ห้าง')
			-> setCellValue('F7', 'ชื่อลูกค้า')
			-> setCellValue('G7', 'รับจากลูกค้า')
			-> setCellValue('H7', 'ส่งโรงงาน')
			-> setCellValue('I7', 'หมายเหตุ')
			-> setCellValue('A3', 'Location :')
			-> setCellValue('B3', $site_name)
			-> setCellValue('A4', 'Complete :')
			-> setCellValue('B4', $status)
			-> setCellValue('A5', 'Year :')
			-> setCellValue('B5', '20'.$year)
			-> setCellValue('H5', 'วันที่ :')
			-> setCellValue('I5', date("d/m/Y"));
			

		$excel -> getActiveSheet() -> mergeCells('A1:I1');
		$excel -> getActiveSheet() -> getStyle('A1') -> applyFromArray(
			array(
				'font' => array(
					'size' => 24,
				)
			)
		);
		$excel -> getActiveSheet() -> getStyle('A1') -> getAlignment() -> setHorizontal('center');

		$excel -> getActiveSheet() -> getStyle('A7:I7') -> applyFromArray(
			array(
				'font' => array(
					'bold' => true
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'C0C0C0')
				)
			)
		);

		$excel -> getActiveSheet() -> getStyle('A3:A5') -> applyFromArray(
			array(
				'font' => array(
					'bold' => true
				)
			)
		);
		$excel -> getActiveSheet() -> getStyle('B5') -> getAlignment() -> setHorizontal('left');

		$excel -> getActiveSheet() -> getStyle('H5') -> applyFromArray(
			array(
				'font' => array(
					'bold' => true
				)
			)
		);
		$excel -> getActiveSheet() -> getStyle('H5') -> getAlignment() -> setHorizontal('right');

		$excel -> getActiveSheet() -> getStyle('A8:I'.($row-1)) -> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);

		$excel -> getActiveSheet() -> getColumnDimension('A') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('B') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('C') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('D') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('E') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('F') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('G') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('H') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('I') -> setWidth(20);

		$filename = "report_".date('d-m-Y').".xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");

		$file = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		$file -> save('php://output');

		mysqli_close($conn);
	}



	if(isset($_POST['display']) && !empty($_POST['repair_site']) && !empty($_POST['complete']) && !empty($_POST['year']))
	{
		include('PHP/connect.php');

		$site = $_POST['repair_site'];
		$status = $_POST['complete'];
		$year = $_POST['year'];
		$site_query = "";

		switch($site)
		{
			case "All":
				$site_query = "";
				break;
			default:
				$site_query = "AND `repair_location` = ".$site;

		}
		if($status == "Yes")
		{
			$sql = "SELECT `repair_item`.`repair_num`, `repair_order`.`form_num`, `repair_item`.`prod_code`, `repair_item`.`repair_detail`, `store`.`dept_name`, `customer`.`cust_name`, `repair_order`.`received_from_cust`, `repair_item`.`send_factory_date`, `repair_item`.`note`, `repair_location`.`location_name` FROM `repair_item` LEFT JOIN `repair_order` ON `repair_order`.`form_num` = `repair_item`.`form_num` LEFT JOIN `store` ON `store`.`dept_id` = `repair_order`.`dept_store` LEFT JOIN `customer` ON `customer`.`cust_id` = `repair_order`.`cust_id` LEFT JOIN `repair_location` ON `repair_location`.`location_id` = `repair_item`.`repair_location` WHERE `repair_item`.`repair_num` LIKE '".$year."%' ".$site_query." AND `repair_item`.`return_dept_date` IS NOT NULL ORDER BY `repair_item`.`repair_num`;";
		} elseif($status == "No") {
			$sql = "SELECT `repair_item`.`repair_num`, `repair_order`.`form_num`, `repair_item`.`prod_code`, `repair_item`.`repair_detail`, `store`.`dept_name`, `customer`.`cust_name`, `repair_order`.`received_from_cust`, `repair_item`.`send_factory_date`, `repair_item`.`note`, `repair_location`.`location_name` FROM `repair_item` LEFT JOIN `repair_order` ON `repair_order`.`form_num` = `repair_item`.`form_num` LEFT JOIN `store` ON `store`.`dept_id` = `repair_order`.`dept_store` LEFT JOIN `customer` ON `customer`.`cust_id` = `repair_order`.`cust_id` LEFT JOIN `repair_location` ON `repair_location`.`location_id` = `repair_item`.`repair_location` WHERE `repair_item`.`repair_num` LIKE '".$year."%' ".$site_query." AND `repair_item`.`return_dept_date` IS NULL ORDER BY `repair_item`.`repair_num`;";
		} elseif($status == "All") {
			$sql = "SELECT `repair_item`.`repair_num`, `repair_order`.`form_num`, `repair_item`.`prod_code`, `repair_item`.`repair_detail`, `store`.`dept_name`, `customer`.`cust_name`, `repair_order`.`received_from_cust`, `repair_item`.`send_factory_date`, `repair_item`.`note`, `repair_location`.`location_name` FROM `repair_item` LEFT JOIN `repair_order` ON `repair_order`.`form_num` = `repair_item`.`form_num` LEFT JOIN `store` ON `store`.`dept_id` = `repair_order`.`dept_store` LEFT JOIN `customer` ON `customer`.`cust_id` = `repair_order`.`cust_id` LEFT JOIN `repair_location` ON `repair_location`.`location_id` = `repair_item`.`repair_location` WHERE `repair_item`.`repair_num` LIKE '".$year."%' ".$site_query." ORDER BY `repair_item`.`repair_num`;";
		}

		if($result = mysqli_query($conn, $sql))
		{
			if(mysqli_num_rows($result) == NULL)
			{
				echo "<label>NO RESULT FOUND!</label>";
			} else {
					echo "<div class='table table-sm'><table class='table table-hover table-bordered'><tr><thead class='bg-primary'><th>ส่งซ่อม</th><th>เลขที่ซ่อม</th><th>รหัสสินค้า</th><th>รายละเอียดงานซ่อม</th><th>ห้าง</th><th>ชื่อลูกค้า</th><th>รับจากลูกค้า</th><th>ส่งโรงงาน</th><th>หมายเหตุ</th><thead></tr>";
					while($row = mysqli_fetch_assoc($result))
					{
						echo '<tr>
						<td>'.$row['repair_num'].'</td>
						<td>'.$row['form_num'].'</td>
						<td>'.$row['prod_code'].'</td>
						<td>'.$row['repair_detail'].'</td>
						<td>'.$row['dept_name'].'</td>
						<td>'.$row['cust_name'].'</td>
						<td>'.$row['received_from_cust'].'</td>
						<td>'.$row['send_factory_date'].'</td>
						<td>'.$row['note'].'</td></tr>';
					}
					echo "</table></div>";
				}
			} else {
				echo myslqi_error($result);
		}
		mysqli_close($conn);
	}
?>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">