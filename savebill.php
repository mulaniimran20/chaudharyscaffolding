<?php
session_start();
include('dbcon.php');

$vehicleno = $_POST['vehicleno'];

$adminid = $_SESSION['adminsessionid'];

$username = trim($_POST['productname']);
$useremail = $_POST['productstock'];
$usermobile = $_POST['productprice'];
$useraddress = trim($_POST['address']);

$syear = $_POST['syear'];


$productids = $_POST['productids'];
$productquantities = $_POST['productquantityt'];

$ccemail = $_POST['ccemail'];

$workorderno = $_POST['workorderno'];
$workorderdate = $_POST['workorderdate'];
$dcno = $_POST['dcno'];
$datedd = $_POST['datedd'];





$msg = $_POST['msg'];

$supervisor = $_POST['supervisor'];
$receiver = $_POST['receiver'];


$sitename = trim($_POST['site_name']);


$contactname = trim($_POST['contactname']);


$productidsarr = explode(",",$productids);
$productquantitiesarr = explode(",",$productquantities);

$checkquer = "SELECT * FROM `user_list` WHERE  `user_register_shop_id` = '".$adminid."' and `user_address` = '".$useraddress."' and `user_name` = '".$username."' and `site_name` = '".$sitename."'";


$res = mysqli_query($conn, $checkquer);
$rowcount = mysqli_num_rows($res);


if($rowcount == 0)
{
$insertquery = "INSERT INTO `user_list`(`user_name`, `user_email`, `user_contact_no`, `user_address`, `user_register_shop_id`, `site_name`, `contacct_person`) VALUES ('".$username."','".$useremail."','".$usermobile."','".$useraddress."','".$adminid."', '".$sitename."', '".$contactname."')";

$result = mysqli_query($conn, $insertquery);
}


 $selectuseridquery = "SELECT * FROM `user_list` WHERE  `user_register_shop_id` = '".$adminid."' and `user_address` = '".$useraddress."' and `user_name` = '".$username."' and `site_name` = '".$sitename."'";

$resultgetuserid = mysqli_query($conn, $selectuseridquery);

$rowgetuserid = mysqli_fetch_array($resultgetuserid, MYSQLI_ASSOC);
//echo "<br>";

 $useridadd = $rowgetuserid['user_id'];
//exit();

if($workorderno == "")
{
    $workorderno = "";
}


$selectbillingidcheck = "SELECT * FROM `new_billing_list` WHERE `user_id` = '".$useridadd."' and `billing_from_shop_id` = '".$adminid."'";

$resultchkbidd = mysqli_query($conn, $selectbillingidcheck);
$rowchkbiddcount = mysqli_num_rows($resultchkbidd);

if($rowchkbiddcount == 0)
{

$insertquerygen = "INSERT INTO `generate_billing_recipt_no` (`id`) VALUES (NULL);";

$resultgen = mysqli_query($conn, $insertquerygen);


$selectbillidquery = "SELECT * FROM `generate_billing_recipt_no`";

$resu = mysqli_query($conn, $selectbillidquery);

$rowm = mysqli_fetch_array($resu, MYSQLI_ASSOC);

$billingid = $rowm['id'];

}
else{
 
 $rowchkbidd = mysqli_fetch_array($resultchkbidd);
    
  $billingid = $rowchkbidd['billing_recipt_id'];  
}
$deletequery = "DELETE FROM `generate_billing_recipt_no` WHERE `id` = '".$billingid."'";

$rr = mysqli_query($conn, $deletequery);



for($i = 0; $i < sizeof($productidsarr); $i++)
{

if($productquantitiesarr[$i] == null)
{
    echo $productquantitiesarr[$i];
}
else{    
    $insertbill = "INSERT INTO `new_billing_list`(`product_id`, `product_quantity`, `billing_from_shop_id`, `billing_recipt_id`, `product_pending_quantitis`, `user_id`, `entry_vehicle_no`, `workorderno`, `workorderdate`, `dcno`, `datedd`, `msg`, `supervisor`, `reciver`) VALUES ('".$productidsarr[$i]."','".$productquantitiesarr[$i]."','".$adminid."', '".$billingid."', '".$productquantitiesarr[$i]."', '".$useridadd."', '".$vehicleno."', '".$workorderno."', '".$workorderdate."', '".$dcno."', '".$datedd."', '".$msg."', '".$supervisor."', '".$receiver."')";

$resulfinal = mysqli_query($conn, $insertbill);

$selectproductscount = "SELECT * FROM `product_table` WHERE `product_id` = '".$productidsarr[$i]."' and `product_owner_shop_id` = '".$adminid."'";

$resprocount = mysqli_query($conn, $selectproductscount);

$rowprocount = mysqli_fetch_array($resprocount, MYSQLI_ASSOC);

$productcount = $rowprocount['product_available_stock'];
$prorowid = $rowprocount['product_id'];

$updatecount = $productcount - $productquantitiesarr[$i];

if($updatecount > 0)
{
$updatecountquery = "UPDATE `product_table` SET `product_available_stock`= '".$updatecount."' WHERE `product_id` = '".$prorowid."'";
}
else{
$updatecountquery = "UPDATE `product_table` SET `product_available_stock`= '".$updatecount."', `procut_status` = '0' WHERE `product_id` = '".$prorowid."'";
}

$resultff = mysqli_query($conn, $updatecountquery);

}
}



$insertquery = "INSERT INTO `dc_number`(`dc_id`, `year`, `shopid`) VALUES ('".$dcno."','".$syear."','".$adminid."')";

$res = mysqli_query($conn, $insertquery);




header("Location: billpdf.php?billid=".$billingid."&dcno=".$dcno."&ccemail=".$ccemail);

?>