<?php

include 'dbcon.php';

$id= $_REQUEST['id'];
//$productid=  $_REQUEST['product_id'];
$editqty= $_REQUEST['qnty'];

$sql="SELECT  *  FROM `save_daily_entry` WHERE `id`='".$id."'";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$current_qty= $row['product_quantity'];
$productid = $row['product_id'];
$qty= $current_qty - $editqty;

$sql2= "UPDATE `save_daily_entry` SET `product_quantity`='$editqty' WHERE `id`='".$id."'";
$rrn = mysqli_query($conn, $sql2);

$sql1= "SELECT  `product_available_stock` FROM `product_table` WHERE `product_id`='".$productid."'";
$result1= mysqli_query($conn,$sql1);
$row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
$available_qty= $row['product_available_stock'];
 
$final_qty=$available_qty + $qty;

$sql3= "UPDATE `product_table` SET `product_available_stock`='$final_qty' WHERE `product_id`='".$productid."'";
$rr = mysqli_query($conn, $sql3);


?>