<?php 
	          session_start();

	          if(empty($_SESSION['permission']))
			  {
				 header('location: login.php');
			  }

	          if(!empty($_SESSION['customer']))
	          {
	             echo $_SESSION['customer'];
	             $_SESSION['customer'] == "";
	          }
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - customer</title>
</head>
<body>
<?php include('PHP/navbar.php'); ?>

							<?php

                            //1. connection
                            include('PHP/connect.php');

                            //2. get the value from database (select )
                            $CountCus    = 'SELECT * FROM customer ORDER by cust_id DESC';
                            $result = mysqli_query($conn, $CountCus);
                            $row = mysqli_fetch_array($result);

                            //3 close the link
                            mysqli_close($conn);

                            ?>

            <!-- Adding -->
    <?php 
    	if($_SESSION['permission']['add_customer'] == '1')
		{ ?>     
	<button class="open-button btn btn-primary">Add Customer</button>
	<div class="form-popup myForm">
		<h1>Add Customer</h1>
		<form action="addCustomerAction.php" method="POST">
			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" id="customerid" name="customerid" class="form-control" placeholder="Next ID: <?php echo $row['cust_id']+1; ?>" disabled="disabled">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>

			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" id="customername" name="customername" class="form-control" placeholder="Customer Name" required="required">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>

			<div class="row">
				<div class="form-group col-md-4">
					<input type="text" id="customertel" name="customertel" class="form-control" placeholder="Telephone Number" required="required">
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<button type="submit" class="btn btn-success">Add</button>
					<!-- <button id="repage" type="button" class="btn btn-danger">Cancel</button> -->
					<button type="reset" name="reset" class="btn btn-danger" onclick="closeForm()">Cancel</button>
				</div>
				<div class="form-group col-md-4"></div>
				<div class="form-group col-md-4"></div>
			</div>
		</form>
	</div>
	<?php
	}
	?>
<!-- Table -->
<?php include('customer_table.php'); ?>
<?php include('PHP/import.php'); ?>


</body>
</html>

<?php
	exit;
?>