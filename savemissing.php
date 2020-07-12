<?php 
session_start();
include('dbcon.php');

$adminid = $_SESSION['adminsessionid'];


$reciptid = $_REQUEST['productprice'];

$vehicleno = $_REQUEST['vehicleno'];

$productids = $_REQUEST['productids'];

$productquantityt = $_REQUEST['productquantityt'];

$proids = explode(",", $productids);
$proquants = explode(",", $productquantityt);

$selectuserid = "SELECT DISTINCT `user_id` FROM `new_billing_list` WHERE `billing_recipt_id` = '24'";
$resultid = mysqli_query($conn, $selectuserid);
$rowid = mysqli_fetch_array($resultid, MYSQLI_ASSOC);

$userid = $rowid['user_id'];

for($i = 0; $i < sizeof($proquants); $i++)
{


$insertquery = "INSERT INTO `missing_data_entry`( `missing_by_user_id`, `missing_from_admin`, `missing_from_recipt_id`, `missing_product_id`, `missing_quantity`) VALUES ('".$userid."','".$adminid."','".$reciptid."','".$proids[$i]."','".$proquants[$i]."')";

$result = mysqli_query($conn, $insertquery);

}

header("Location: user_list.php");

?>