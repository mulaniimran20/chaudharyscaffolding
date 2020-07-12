<?php

$billid = $_POST['billid'];

include('dbcon.php');

$timestamp = time();

$name = $_POST['name'];

$billname = $name."_".$billid."_".$timestamp.".pdf";

$pathuploadpdf = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/demo/1/uploads/".$billname;

move_uploaded_file(
    $_FILES['pdf']['tmp_name'], 
    $_SERVER['DOCUMENT_ROOT'] . "/demo/1/uploads/".$billname
);

if($name == "DeliveryChallan")
{
$updatequery = "UPDATE `new_billing_list` SET `bill_pdf_url`='".$pathuploadpdf."' WHERE `billing_recipt_id` = '".$billid."'";
$result = mysqli_query($conn, $updatequery);
}
else{
   $updatequery = "UPDATE `return_data_table` SET `return_challan_url`='".$pathuploadpdf."' WHERE `return_bill_id` = '".$billid."'";
$result = mysqli_query($conn, $updatequery); 

$update1 = "UPDATE `new_billing_list` SET `return_challan_url`='".$pathuploadpdf."' WHERE `billing_recipt_id` = '".$billid."'";
$result1 = mysqli_query($conn, $update1);
}
?>