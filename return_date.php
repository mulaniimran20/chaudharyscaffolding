<?php

include('dbcon.php');

session_start();

$adminid = $_SESSION['adminsessionid'];

$userid = $_REQUEST['userid'];
$returndate = $_REQUEST['returndate'];


$updatequery = "UPDATE `new_billing_list` SET `return_product_date`='".$returndate."' WHERE `user_id` = '".$userid."' and `billing_from_shop_id` = '".$adminid."'";

$result = mysqli_query($conn, $updatequery);

header("Location: user_history_main.php");


?>