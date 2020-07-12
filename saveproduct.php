<?php
include('dbcon.php');
session_start();

$productname = $_POST['productname'];
$productstock = $_POST['productstock'];
$productprice = '';
$productpricetimespan = '';

$adminid = $_SESSION['adminsessionid'];

$insertquery = "INSERT INTO `product_table`(`product_name`, `product_quantity`, `product_available_stock`, `product_owner_shop_id`, `product_price`, `price_timespan`) VALUES ('".$productname."','".$productstock."','".$productstock."','".$adminid."','".$productprice."','".$productpricetimespan."')";

$result = mysqli_query($conn, $insertquery);

if($result)
{
    header("Location: product_list.php");
}
else{
    header("Location: add_product.php");
}

?>