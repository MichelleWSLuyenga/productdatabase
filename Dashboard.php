<?php
	session_start();

	if(empty($_SESSION['permission']))
	{
		header('location: login.php');
	}

	if(!empty($_SESSION['nocost']))
      {
         echo $_SESSION['nocost'];
         $_SESSION['nocost'] == "";
      }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<script language="javascript">
		function resizeIframe(obj)
		{
			obj.style.height = 0;
    		obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  		}
	</script>
</head>
<body>
<?php include('PHP/navbar.php'); ?>

<?php
 include('PHP/connect.php');

  $sql = "SELECT * FROM `repair_location`;";
  $rp_location = mysqli_query($conn, $sql);
  $rpl = "";
  while($row = mysqli_fetch_array($rp_location))
  {
   $rpl .= "<option value='$row[0]'>$row[1]</option>";
  }

  $sql = "SELECT DISTINCT LEFT(`repair_num`, 2) AS `repair_year` FROM `repair_item`;";
  $rp_year = mysqli_query($conn, $sql);
  $rpy = "";
  while($row = mysqli_fetch_array($rp_year))
  {
   $rpy .= "<option value='$row[0]'>20".$row[0]."</option>";
  }

 mysqli_close($conn);
?>
 
<div class="col-md-12">
		<h1>Follow up report</h1>
	<!-- Follow up report table -->
	<?php include('follow_up_report.php'); ?>

	<?php
		if($_SESSION['permission']['view_report'] == '1')
	{ ?>
		<h1>Repair location report</h1>
		<form method="post" name="rpl_report" action="repair_location_report.php" target="report_iframe">
			<div class="row">
				<div class="col-md-1">
					<label>สถานที่ซ่อม</label>
				</div>
				<div class="col-md-2">
					<select class="relo" name="repair_site" required="required" onchange="site_selected(this.value);">
						<option></option>
						<option value="All">All</option>
						<?php echo $rpl; ?>
					</select>
				</div>
				<div class="col-md-1">
					<label>Complete</label>
				</div>
				<div class="col-md-2">
					<select class="relo" name="complete" required="required" onchange="status_selected(this.value);">
						<option></option>
						<option value="All">All</option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="col-md-1">
					<label>year</label>
				</div>
				<div class="col-md-2">
					<select class="relo" name="year" required="required" onchange="year_selected(this.value);">
						<option></option>
						<?php echo $rpy; ?>
					</select>
				</div>
				<div class="col-md-1">
					<input type="submit" name="display" value="Display" class="btn btn-success">
					</form>
				</div>
				<div class="col-md-1">
					<form method="post" name="rpl_excel_report" onsubmit="return validate();" action="repair_location_report.php">
					<input type="text" name="excel_site" id="excel_site" style="display:none">
					<input type="text" name="excel_status" id="excel_status" style="display:none">
					<input type="text" name="excel_year" id="excel_year" style="display:none">
					<input type="submit" name="excel_submit" value="Export .xls" class="btn btn-warning">
					</form>
				</div>
			</div>
			<iframe name="report_iframe" frameborder="0" scrolling="no" style="width:100%; margin-top:10px;" onload="resizeIframe(this);"></iframe>
			<?php
			}
			?>

		<?php
			if($_SESSION['permission']['print_receipt'] == '1')
		{ ?>
			<div class="row">
				<form name="print_receipt" method="post" action="receipt.php">
					<div class="col-md-4">
						<input type="text" name="form_num" placeholder="Form NO." class="relo" required="required">
					</div>
					<div class="col-md-4">
						<input type="submit" name="submit" value="Print Receipt" class="btn btn-success">
					</div>
				</form>
			</div>
		<?php
		}
		?>
</div>



<?php include('PHP/import.php'); ?>	
</body>
</html>

<script language="javascript">
	function validate()
	{
		if(document.rpl_report.repair_site.value == "" || document.rpl_report.complete.value == "" || document.rpl_report.year.value == "")
		{
			alert("All fields are required");
			return false;
		}
	}

  	function site_selected(site)
  	{
  		document.getElementById("excel_site").value = site;
  	}
  	function status_selected(status)
  	{
  		document.getElementById("excel_status").value = status;
  	}
  	function year_selected(year)
  	{
  		document.getElementById("excel_year").value = year;
  	}
</script>