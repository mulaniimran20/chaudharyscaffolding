<?php
session_start();
include('dbcon.php');


$id = $_REQUEST['idd'];
$shopid = $_SESSION['adminsessionid'];



$selectproductlistquery = "SELECT * FROM `new_billing_list` WHERE `user_id` = '".$id."' and `billing_from_shop_id` = '".$shopid."'";

$result = mysqli_query($conn, $selectproductlistquery);

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{

$productid = $row['product_id'];
$deleteid = $row['billing_product_id'];
$product_pending_quantitis = $row['product_pending_quantitis'];

$dc_chalan_no = $row['dcno'];
$deletequery = "DELETE FROM `dc_number` WHERE `dc_id` = '".$dc_chalan_no."'";
$resultd = mysqli_query($conn, $deletequery);



$query1 = "SELECT * FROM `product_table` WHERE `product_id` = '".$productid."'";
$result1 = mysqli_query($conn, $query1);
$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

$actualpendingquant = $row1['product_available_stock'];

$updatequat = $actualpendingquant + $product_pending_quantitis;

$updatequery = "UPDATE `product_table` SET `product_available_stock`='".$updatequat."' WHERE `product_id` = '".$productid."'";
$rr = mysqli_query($conn, $updatequery);

$deletequery = "DELETE FROM `new_billing_list` WHERE `billing_product_id` = '".$deleteid."'";
$rms = mysqli_query($conn, $deletequery);



}

$delete1 = "DELETE FROM `return_challan_data` WHERE  `file_user_id` = '".$id."'";
$deleteres1 = mysqli_query($conn, $delete1);

$delete2 = "DELETE FROM `return_data_table` WHERE `return_user_id` = '$id'";
$deleteres2 = mysqli_query($conn, $delete2);



$deleteuserquery = "DELETE FROM `user_list` WHERE `user_id` = '".$id."'";
$resultdelte - mysqli_query($conn, $deleteuserquery);


header("Location: user_history_main.php");
?>