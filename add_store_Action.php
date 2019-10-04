<?php
	session_start();
	
	include('PHP/connect.php');

	$deptName = $_POST['dept_name'];
	$store = "INSERT INTO `albedo_repair`.`store` (`dept_name`) VALUES ('$deptName')";

	$result = mysqli_query($conn,$store);

	if($result === true) {
   		$_SESSION['store'] = "<div class='alert alert-success'>"."Entered data successfully\n"."</div>";
		header("location: store.php");
	} else {
  		$_SESSION['store'] = "<div class='alert alert-danger'>"."Could not enter data: "."</div>" ;
  		header("location: store.php");
	}

	mysqli_close();
	exit;
?>