<?php 
      session_start();

      if(empty($_SESSION['permission']))
	  {
		 header('location: login.php');
	  }

	include('PHP/connect.php');

	$sql = "SELECT * FROM `role`";
	$role = mysqli_query($conn, $sql);
	$role_list = "";
	while($row = mysqli_fetch_array($role))
	{
		$role_list = $role_list."<option value='$row[0]'>$row[1]</option>";
	}

	mysqli_close($conn);
?>

<html>
<head>
	<meta http-equiv=Content-Type content="text/html" charset="utf-8">
	<title>ALBEDO - role</title>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">
	<?php include('PHP/navbar.php'); ?>
	<div class="col-md-12">
		<h1>Role</h1>
		<?php
		if($_SESSION['permission']['add_role'] == '1')
		{ ?>
			<div class="row">
				<div class="form-group col-md-8">
					<button class="open-button btn btn-primary">Add Role</button>
					<?php include('add_role.php'); ?>
				</div>
			</div>
		<?php
		}
		?>
			<div class="row">
				<?php include('role_table.php'); ?>
			</div>
	</div>
		<?php include('PHP/import.php'); ?>
	</body>
</html>

<?php
	exit;
?>