<?php

include('dbcon.php');


$dcno = $_POST['dcno'];
$wono = $_POST['wono'];
$getproductname = $_POST['getproductname'];
$productquantity = $_POST['productquantity'];
$adminid = $_POST['adminid'];
$userid = $_POST['userid'];


$query = "SELECT * FROM `new_billing_list` WHERE `billing_from_shop_id` = '".$adminid."' and `user_id` = '".$userid."' and `workorderno` = '".$wono."' and `dcno` = '".$dcno."'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$billing_recipt_id = $row['billing_recipt_id'];
$entry_vehicle_no = $row['entry_vehicle_no'];
$workorderdate = $row['workorderdate'];
$datedd = $row['datedd'];
$msg = $row['msg'];
$supervisor = $row['supervisor'];

$queryinsert = "INSERT INTO `new_billing_list`(`product_id`, `product_quantity`, `product_pending_quantitis`, `billing_from_shop_id`, `billing_recipt_id`, `user_id`,  `entry_vehicle_no`, `workorderno`, `workorderdate`, `dcno`, `datedd`, `msg`, `authorizer`, `supervisor`, `reciver`) VALUES ('".$getproductname."', '".$productquantity."', '".$productquantity."', '".$adminid."', '".$billing_recipt_id."', '".$userid."', '".$entry_vehicle_no."', '".$wono."', '".$workorderdate."', '".$dcno."', '".$datedd."', '".$msg."', '', '".$supervisor."', '')";
$resultq = mysqli_query($conn, $queryinsert);


$productdetails = "SELECT * FROM `product_table` WHERE `product_id` = '".$getproductname."'";
$resultpro = mysqli_query($conn, $productdetails);
$rowpro = mysqli_fetch_array($resultpro, MYSQLI_ASSOC);

$proavailstock = $rowpro['product_available_stock'];

$updatestock = $proavailstock - $productquantity;

$proupdatequery = "UPDATE `product_table` SET `product_available_stock`='".$updatestock."' WHERE `product_id` = '".$getproductname."'";
$resultproupdate = mysqli_query($conn, $proupdatequery);

//header("Location: editdc.php?dcid=".$dcno."&userid=".$userid."&wono=".$wono);

?>