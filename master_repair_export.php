<?php
	
	if(isset($_POST['excel_submit']) && !empty($_POST['excel_year']))
	{
		require_once 'phpexcel/PHPExcel.php';
		include 'PHP/connect.php';

		$excel = new PHPExcel();
		$excel -> setActiveSheetIndex(0);

		$year = $_POST['excel_year'];
		$site_query = "";

		$sql = "SELECT `tbl1`.`repair_num`, `tbl1`.`form_num`, `tbl1`.`dept_name`, `tbl1`.`prod_code`, `tbl1`.`size`, `tbl1`.`collection`, `tbl1`.`detail`, `tbl1`.`repair_detail`, `tbl1`.`cust_name`, `tbl1`.`tel`, `tbl1`.`warranty_desc`, `tbl1`.`purchased_date`, `tbl1`.`cost`, `tbl1`.`pro_num`, `tbl1`.`money_received_date`, `tbl1`.`location_name`, `tbl1`.`received_from_cust`, `tbl1`.`arrived_at_comp`, `tbl1`.`datecount1`, `tbl1`.`send_factory_date`, `tbl1`.`received_from_factory`, `tbl1`.`datecount2`, `tbl1`.`status1`, (`tbl1`.`datecount1` + `tbl1`.`datecount2`) AS office_factory_datecount, `tbl1`.`return_dept_date`, `tbl1`.`send_method`, `tbl1`.`emp_name`, `tbl1`.`complete`, `tbl1`.`note`, `tbl1`.`repair_datecount`, CASE WHEN `tbl1`.`repair_datecount` < 46 THEN 'ในกำหนด' WHEN `tbl1`.`repair_datecount` >= 46 THEN 'เกินกำหนด' ELSE NULL END AS status2 FROM (SELECT `repair_item`.`repair_num`, `repair_item`.`form_num`, `store`.`dept_name`, `repair_item`.`prod_code`, `product`.`size`, `product`.`collection`, `product`.`detail`, `repair_item`.`repair_detail`, `customer`.`cust_name`, `customer`.`tel`, `warranty`.`warranty_desc`, `repair_item`.`purchased_date`, `pro_number`.`cost`, `pro_number`.`pro_num`, `pro_number`.`money_received_date`, `repair_location`.`location_name`, `repair_order`.`received_from_cust`, `repair_order`.`arrived_at_comp`, DATEDIFF(`repair_order`.`arrived_at_comp`, `repair_order`.`received_from_cust`) AS datecount1, `repair_item`.`send_factory_date`, `repair_item`.`received_from_factory`, DATEDIFF(`repair_item`.`received_from_factory`, `repair_item`.`send_factory_date`) AS datecount2, CASE WHEN `repair_item`.`received_from_factory` = null THEN 'ตามงานซ่อม' ELSE null END AS status1, `repair_item`.`return_dept_date`, `repair_item`.`send_method`, `employee`.`emp_name`, CASE WHEN `repair_item`.`return_dept_date` IS NULL THEN 'N' WHEN `repair_item`.`return_dept_date` IS NOT NULL THEN 'Y' END AS complete, `repair_item`.`note`, DATEDIFF(`repair_item`.`return_dept_date`, `repair_order`.`received_from_cust`) AS repair_datecount FROM `repair_item` LEFT JOIN `repair_order` ON `repair_item`.`form_num` = `repair_order`.`form_num` LEFT JOIN `customer` ON `repair_order`.`cust_id` = `customer`.`cust_id` LEFT JOIN `warranty` ON `repair_item`.`warranty_type` = `warranty`.`warranty_id` LEFT JOIN `repair_location` ON `repair_item`.`repair_location` = `repair_location`.`location_id` LEFT JOIN `employee` ON `repair_item`.`person_sent` = `employee`.`emp_id` LEFT JOIN `pro_number` ON `repair_item`.`repair_num` = `pro_number`.`repair_num` LEFT JOIN `store` ON `repair_order`.`dept_store` = `store`.`dept_id` LEFT JOIN `product` ON `product`.`item` = `repair_item`.`prod_code`) AS tbl1 WHERE `tbl1`.`repair_num` LIKE '".$year."%';";

		$result = mysqli_query($conn, $sql);
		$row = 7;
		while($data = mysqli_fetch_object($result))
		{
			$excel -> getActiveSheet()
				-> setCellValue('A'.$row, $data->repair_num)
				-> setCellValue('B'.$row, $data->form_num)
				-> setCellValue('C'.$row, $data->dept_name)
				-> setCellValue('D'.$row, $data->prod_code)
				-> setCellValue('E'.$row, $data->size)
				-> setCellValue('F'.$row, $data->collection)
				-> setCellValue('G'.$row, $data->detail)
				-> setCellValue('H'.$row, $data->repair_detail)
				-> setCellValue('I'.$row, $data->cust_name)
				-> setCellValue('J'.$row, $data->tel)
				-> setCellValue('K'.$row, $data->warranty_desc)
				-> setCellValue('L'.$row, $data->purchased_date)
				-> setCellValue('M'.$row, $data->cost)
				-> setCellValue('N'.$row, $data->pro_num)
				-> setCellValue('O'.$row, $data->money_received_date)
				-> setCellValue('P'.$row, $data->location_name)
				-> setCellValue('Q'.$row, $data->received_from_cust)
				-> setCellValue('R'.$row, $data->arrived_at_comp)
				-> setCellValue('S'.$row, $data->datecount1)
				-> setCellValue('T'.$row, $data->send_factory_date)
				-> setCellValue('U'.$row, $data->received_from_factory)
				-> setCellValue('V'.$row, $data->datecount2)
				-> setCellValue('W'.$row, $data->status1)
				-> setCellValue('X'.$row, $data->office_factory_datecount)
				-> setCellValue('Y'.$row, $data->return_dept_date)
				-> setCellValue('Z'.$row, $data->send_method)
				-> setCellValue('AA'.$row, $data->emp_name)
				-> setCellValue('AB'.$row, $data->complete)
				-> setCellValue('AC'.$row, $data->note)
				-> setCellValue('AD'.$row, $data->repair_datecount)
				-> setCellValue('AE'.$row, $data->status2);
			$row++;
		}

		$excel -> getActiveSheet()
			-> setCellValue('A1', 'ทะเบียนการซ่อมสินค้าประจำปี 20'.$year)
			-> setCellValue('A6', 'ส่งซ่อม')
			-> setCellValue('B6', 'ใบรับสินค้าส่งซ่อม')
			-> setCellValue('C6', 'ห้าง')
			-> setCellValue('D6', 'รหัสสินค้า')
			-> setCellValue('E6', 'แบบ')
			-> setCellValue('F6', 'รุ่น')
			-> setCellValue('G6', 'ชื่อสินค้า')
			-> setCellValue('H6', 'รายละเอียดงานซ่อม')
			-> setCellValue('I6', 'ชื่อลูกค้า')
			-> setCellValue('J6', 'เบอร์โทร')
			-> setCellValue('K6', 'การรับประกัน')
			-> setCellValue('L6', 'วันที่ซื้อ')
			-> setCellValue('M6', 'ค่าใช้จ่าย')
			-> setCellValue('N6', 'เลขที่ PRO')
			-> setCellValue('O6', 'วันที่ ได้รับเงิน')
			-> setCellValue('P6', 'สถานที่ซ่อม')
			-> setCellValue('Q6', 'วันที่ รับจากลูกค้า')
			-> setCellValue('R6', 'วันที่ ถึงบริษัท')
			-> setCellValue('S6', 'จำนวนวัน')
			-> setCellValue('T6', 'ส่งเข้าโรงงาน')
			-> setCellValue('U6', 'รับจากโรงงาน')
			-> setCellValue('V6', 'จำนวนวัน')
			-> setCellValue('W6', 'สถานะ')
			-> setCellValue('X6', 'ใช้เวลา (ออฟฟิศ-โรงงาน)')
			-> setCellValue('Y6', 'วันที่ส่งคืนห้าง')
			-> setCellValue('Z6', 'การขนส่ง')
			-> setCellValue('AA6', 'ผู้ส่ง')
			-> setCellValue('AB6', 'Complete')
			-> setCellValue('AC6', 'หมายเหตุ')
			-> setCellValue('AD6', 'จำนวนวันทั้งหมด')
			-> setCellValue('AE6', 'สถานะงานซ่อม')
			-> setCellValue('A3', 'Year :')
			-> setCellValue('B3', '20'.$year)
			-> setCellValue('A4', 'วันที่ :')
			-> setCellValue('B4', date("d/m/Y"));
			

		$excel -> getActiveSheet() -> mergeCells('A1:AE1');
		$excel -> getActiveSheet() -> getStyle('A1') -> applyFromArray(
			array(
				'font' => array(
					'size' => 40,
				)
			)
		);
		$excel -> getActiveSheet() -> getStyle('A1') -> getAlignment() -> setHorizontal('center');

		$excel -> getActiveSheet() -> getStyle('A6:AE6') -> applyFromArray(
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

		$excel -> getActiveSheet() -> getStyle('A3:A4') -> applyFromArray(
			array(
				'font' => array(
					'bold' => true
				)
			)
		);
		$excel -> getActiveSheet() -> getStyle('B3:B4') -> getAlignment() -> setHorizontal('left');

		$excel -> getActiveSheet() -> getStyle('A6:AE'.($row-1)) -> getAlignment() -> setHorizontal('center');

		$excel -> getActiveSheet() -> getStyle('A7:AE'.($row-1)) -> applyFromArray(
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
		$excel -> getActiveSheet() -> getColumnDimension('G') -> setWidth(25);
		$excel -> getActiveSheet() -> getColumnDimension('H') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('I') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('J') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('K') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('L') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('M') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('N') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('O') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('P') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('Q') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('R') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('S') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('T') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('U') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('V') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('W') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('X') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('Y') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('Z') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('AA') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('AB') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('AC') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('AD') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('AE') -> setWidth(20);
		$excel -> getActiveSheet() -> getColumnDimension('AF') -> setWidth(20);

		$filename = "master_repair_".date('d-m-Y').".xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");

		$file = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		$file -> save('php://output');

		mysqli_close($conn);
	}

?>