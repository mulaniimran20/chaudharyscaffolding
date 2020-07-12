<?php 
include('dbcon.php');

$productid = $_REQUEST['proid'];
$productnameupdate = $_REQUEST['productname'];
$productstockupdate = $_REQUEST['productstock'];
$opriginalstock = $_REQUEST['originalstock'];
$availablestock = $_REQUEST['availablestock'];

$updatedstock = $productstockupdate - $opriginalstock;
$updateavailablestock = $availablestock + $updatedstock;

$updatequery = "UPDATE `product_table` SET `product_name`='".$productnameupdate."',`product_quantity`='".$productstockupdate."',`product_available_stock`='".$updateavailablestock."' WHERE `product_id` = '".$productid."'";

$result = mysqli_query($conn, $updatequery);

header('Location: product_list.php');


?>