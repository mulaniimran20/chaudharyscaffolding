<?php

session_start();

include('dbcon.php');

$adminid = $_SESSION['adminsessionid'];

$billingid = $_POST['billingid'];
$productid = $_POST['productid'];
$returnquantity = $_POST['returnquantity'];
$pendingquantity = $_POST['pendingquantity'];
$updatecount1 = $_POST['updateCount'];

$returnquantity1 = $returnquantity;

$vno = $_POST['vno'];

$getDetails = "SELECT * FROM `new_billing_list` WHERE `billing_product_id` = '".$billingid."'";
$result = mysqli_query($conn, $getDetails);
$row = mysqli_fetch_array($result);


$rcno = $_REQUEST['rcno'];


$recipientid = $row['billing_recipt_id'];
$userid = $row['user_id'];
$billingdate = $row['billing_date'];
$billing_recipt_id = $row['billing_recipt_id'];
$productid = $row['product_id'];

$cupdateproidquery = "SELECT * FROM `new_billing_list` WHERE `product_id` = '".$productid."' and `user_id` = '".$userid."' and `billing_from_shop_id` = '".$adminid."'";
$cuptateresult = mysqli_query($conn, $cupdateproidquery);

//date_default_timezone_set('Asia/Kolkata');
$todaydate = date('Y/m/d h:i:s a', time());

$diff = abs(strtotime($todaydate) - strtotime($billingdate));

$days = floor($diff/(60*60*24));
$diffhrs = floor(($diff - $days * 60 * 60 * 24 )/(60*60));


if($diffhrs < 24)
{
    $days = $days + 1;
    $diffdate = $days;
}
else{
    $diffdate = $days;
}

$selectproductdetails = "SELECT * FROM `product_table` WHERE `product_id` = '".$productid."'";
$productresult = mysqli_query($conn, $selectproductdetails);
$rms = mysqli_fetch_array($productresult);

$product_available_stock = $rms['product_available_stock'];
$product_update_rms = $product_available_stock + $returnquantity;

while($cupdaterow = mysqli_fetch_array($cuptateresult, MYSQLI_ASSOC))
{
    $scount = $cupdaterow['product_pending_quantitis'];
    
    $chkcount = $returnquantity - $scount;
    if($chkcount < 0)
    {
        $updatecount =  $scount - $returnquantity;
        $returnquantity = 0;
    }
    else{
        $updatecount = 0;
        $returnquantity = $returnquantity - $scount;
    }
    
    $billingid1 = $cupdaterow['billing_product_id'];
    
echo $updatequery = "UPDATE `new_billing_list` SET `product_pending_quantitis`='".$updatecount."', `return_vehicle_no` = '".$vno."' WHERE `billing_product_id` = '".$billingid1."'";

$rr = mysqli_query($conn, $updatequery);

}




$updatequerycd = "UPDATE `new_billing_list` SET `return_vehicle_no` = '".$vno."' WHERE `billing_recipt_id` = '".$billing_recipt_id."'";

$rrcd = mysqli_query($conn, $updatequerycd);





$updateprotbl = "UPDATE `product_table` SET `product_available_stock`='".$product_update_rms."',`procut_status`='1' WHERE `product_id` = '".$productid."'";

$rrs = mysqli_query($conn, $updateprotbl);






$insertreturndataquery = "INSERT INTO `return_data_table`(`return_product_id`, `return_user_id`, `return_bill_id`, `total_days_completed`, `return_shop_id`, `return_count`, `return_vehicle_no`, `rc_challan_no`) VALUES ('".$productid."','".$userid."','".$billing_recipt_id."','".$diffdate."','".$adminid."', '".$returnquantity1."', '".$vno."', '".$rcno."')";

$srs = mysqli_query($conn, $insertreturndataquery);

$selectverify = "SELECT * FROM `rc_number` WHERE `rc_no` = '".$rcno."'";
$resultverify = mysqli_query($conn, $selectverify);
$countverify = mysqli_num_rows($resultverify);

$yearinsert = explode(".", $rcno);

if($countverify == 0)
{
    $insertverify = "INSERT INTO `rc_number`(`rc_no`, `rc_year`, `shop_id`) VALUES ('".$rcno."', '".$yearinsert[1]."', '".$adminid."')";
    $resultinsertverify = mysqli_query($conn, $insertverify);
}


?>