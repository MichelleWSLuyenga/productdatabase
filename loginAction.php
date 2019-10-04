<?php
	session_start();
	
	include('PHP/connect.php');

	$get_username = mysqli_real_escape_string($conn, $_POST['username']);
	$get_password = mysqli_real_escape_string($conn, $_POST['password']);

	$strSQL = "SELECT * FROM `employee` WHERE username = '$get_username' AND password = '$get_password'";

	$objQuery = mysqli_query($conn, $strSQL);
	
	$count = mysqli_num_rows($objQuery);
	if($count == 0)
	{
			$_SESSION['errMsg'] = 'Username or Password Incorrect!' ;
			header('location: login.php');
	}
	else
	{
		$user = mysqli_fetch_assoc($objQuery);
		if($user['active'] == '0')
		{
			$_SESSION['errMsg'] = 'Your account is expired';
			header('location: login.php');
		} else {
			$_SESSION['name'] = $user['emp_name'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['active'] = $user['active'];

			$sql = "SELECT * FROM `role` WHERE `role_id` = ".$user['role'];
			$result = mysqli_query($conn, $sql);
			$_SESSION['permission'] = mysqli_fetch_assoc($result);
			header('location: Dashboard.php');
		}
		
	}
	mysqli_close();

?>