<?php

include('dbcon.php');

$dcid = $_REQUEST['dcid'];
$userid = $_REQUEST['userid'];
$wono = $_REQUEST['wono'];
$deleteid = $_REQUEST['id'];


$selectquery = "SELECT * FROM `new_billing_list` WHERE `billing_product_id` = '".$deleteid."'";
$result = mysqli_query($conn, $selectquery);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$productid = $row['product_id'];
$product_pending_quantitis = $row['product_pending_quantitis'];

$query1 = "SELECT * FROM `product_table` WHERE `product_id` = '".$productid."'";
$result1 = mysqli_query($conn, $query1);
$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

$actualpendingquant = $row1['product_available_stock'];

$updatequat = $actualpendingquant + $product_pending_quantitis;

$updatequery = "UPDATE `product_table` SET `product_available_stock`='".$updatequat."' WHERE `product_id` = '".$productid."'";

$rr = mysqli_query($conn, $updatequery);

$deletequery = "DELETE FROM `new_billing_list` WHERE `billing_product_id` = '".$deleteid."'";
$rms = mysqli_query($conn, $deletequery);

header('Location: editdc.php?dcid='.$dcid.'&userid='.$userid.'&wono='.$wono);

?>