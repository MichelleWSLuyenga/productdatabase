<?php 
session_start();
include('PHP/connect.php');

$warranty = $_POST['war_name'];

$wan = "INSERT INTO `albedo_repair`.`warranty` (`warranty_desc`) VALUES ('$warranty')";

$result = mysqli_query($conn,$wan);
if($result === true) {
    $_SESSION['war'] = "<div class='alert alert-success'>"."Entered data successfully\n"."</div>";
	header("location: warranty.php");
}else {
  $_SESSION['war'] = "<div class='alert alert-danger'>"."Could not enter data: "."</div>" ;
  header("location: warranty.php");
}

mysqli_close();
 ?>