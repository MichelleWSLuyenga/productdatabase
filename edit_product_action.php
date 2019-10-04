<?php

	include('PHP/connect.php');

	$msg = "";
	$prod_id = $_POST['prod_id'];
	$sql = "";

	if(!empty($_POST['prod_name']))
	{
		$sql .= "UPDATE `albedo_repair`.`product` SET `detail` = '".$_POST['prod_name']."' WHERE `item` = '".$prod_id."'; ";
	}

	if(!empty($_POST['prod_price']))
	{
		$sql .= "UPDATE `albedo_repair`.`product` SET `price` = '".$_POST['prod_price']."' WHERE `item` = '".$prod_id."'; ";
	}

	if(!empty($_POST['prod_size']))
	{
		$sql .= "UPDATE `albedo_repair`.`product` SET `size` = '".$_POST['prod_size']."' WHERE `item` = '".$prod_id."'; ";
	}

	if(!empty($_POST['prod_col']))
	{
		$sql .= "UPDATE `albedo_repair`.`product` SET `collection` = '".$_POST['prod_col']."' WHERE `item` = '".$prod_id."'; ";
	}

	if(!empty($_POST['prod_item']))
	{
		$sql .= "UPDATE `albedo_repair`.`product` SET `item` = '".$_POST['prod_item']."' WHERE `item` = '".$prod_id."'; ";
	}

	if(mysqli_multi_query($conn, $sql) == true)
	{
		$msg = "Product information is updated";
		echo '<script language="javascript"> window.alert("'.$msg.'"); window.location.href = "product.php";</script>';
	} else {
		$msg = "Error: cannot update product";
		echo '<script language="javascript"> window.alert("'.$msg.'"); </script> window.location.href = "product.php";</script>';
	}

	mysqli_close($conn);
?>