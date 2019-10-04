<?php
session_start();

include('PHP/connect.php');

$cusName = $_POST['customername'];
$cusTel = $_POST['customertel'];
$cusAdd = "INSERT INTO `customer`(`cust_name`, `tel`) VALUES ('$cusName','$cusTel')";

$result = mysqli_query($conn,$cusAdd);
if($result === true) {
    $_SESSION['customer'] = "<div class='alert alert-success'>"."Entered data successfully\n"."</div>";
	header("location: customer.php");
}else {
  $_SESSION['customer'] = "<div class='alert alert-danger'>"."Could not enter data: "."</div>" ;
  header("location: customer.php");
}

mysqli_close();
?>