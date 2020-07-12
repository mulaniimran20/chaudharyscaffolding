<?php
include("dbcon.php");
session_start();

$queryinsert = "INSERT INTO `purchase_id`(`id`) VALUES (null)";
$resultinsert = mysqli_query($conn, $queryinsert);

$shopid = $_SESSION['adminsessionid'];

$selecctquery = "SELECT * FROM `purchase_id`";
$resultselect = mysqli_query($conn, $selecctquery);
$rowinsert = mysqli_fetch_array($resultselect, MYSQLI_ASSOC);

$purchaseid = $rowinsert['id'];

$deletequery = "DELETE FROM `purchase_id` WHERE `id` = '".$purchaseid."'";
$resultdelete = mysqli_query($conn, $deletequery);

$site_name = $_POST['site_name'];
$date = $_POST['datedd'];
$contactname = $_POST['contactname'];
$contactnumber = $_POST['productprice'];
$productid = $_POST['productids'];
$productqty = $_POST['productquantityt'];

$productidarr = explode(",", $productid);

$productqtyarr = explode(",",$productqty);


$n = sizeof($productidarr);

for($i = 0; $i < $n; $i++)
{
   $insertqueryfordaiy = "INSERT INTO `save_daily_entry`( `site_name`, `contact_person`, `contact_number`, `product_id`, `product_quantity`, `shop_id`, `purchase_date`, `purchase_id`) VALUES ('".$site_name."','".$contactname."','".$contactnumber."','".$productidarr[$i]."','".$productqtyarr[$i]."','".$shopid."','".$date."','".$purchaseid."')";
    
    $resultinsert = mysqli_query($conn, $insertqueryfordaiy);
    
   $selectproductdetails = "SELECT * FROM `product_table` WHERE `product_id` = '".$productidarr[$i]."'";
   $resultselect = mysqli_query($conn, $selectproductdetails);
   $rowpro = mysqli_fetch_array($resultselect, MYSQLI_ASSOC);
   
   $proquantorg = $rowpro['product_available_stock'];
   
   $newstock = $proquantorg - $productqtyarr[$i];
   
   $updatequesry = "UPDATE `product_table` SET `product_available_stock`='".$newstock."' WHERE `product_id` = '".$productidarr[$i]."' and `product_owner_shop_id` = '".$shopid."'";
   
   $updateresult = mysqli_query($conn, $updatequesry);
}

header("Location: todayuseddata.php");


?>