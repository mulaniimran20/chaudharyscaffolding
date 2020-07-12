<?php
session_start();

include('dbcon.php');

$adminid = $_SESSION['adminsessionid'];


$updateid = $_REQUEST['updateid'];
$oldquant = $_REQUEST['oldquant'];
$newquant = $_REQUEST['newquant'];
$oldpendingquantity = $_REQUEST['oldpendingquantity'];
$pendingquantity = $_REQUEST['pendingquantity'];


$selectquery = "SELECT * FROM `new_billing_list` WHERE `billing_product_id` = '".$updateid."'";
$resutl = mysqli_query($conn, $selectquery);
$row = mysqli_fetch_array($resutl, MYSQLI_ASSOC);


$productid = $row['product_id'];

$updatequery = "UPDATE `new_billing_list` SET `product_quantity`='".$newquant."', `product_pending_quantitis`='".$pendingquantity."' WHERE `billing_product_id` = '".$updateid."'";
$result = mysqli_query($conn, $updatequery);



$getproductdetails = "SELECT * FROM `product_table` WHERE `product_id` = '".$productid."'";
$getprodetails = mysqli_query($conn, $getproductdetails);
$rowprodetails = mysqli_fetch_array($getprodetails);

$proquantityactual = $rowprodetails['product_available_stock'];

$updatecount = $proquantityactual + $oldpendingquantity;

$insercount = $updatecount - $pendingquantity;

$updateprodetailsquery = "UPDATE `product_table` SET `product_available_stock`='".$insercount."' WHERE `product_id` = '".$productid."'";

$resultupdatepro = mysqli_query($conn, $updateprodetailsquery);

?>