<?php

session_start();

include('dbcon.php');

$adminid = $_SESSION['adminsessionid'];

$workorderno = $_POST['workorderno'];
$workorderdate = $_POST['workorderdate'];
$dcno = $_POST['dcno'];
$datedd = $_POST['datedd'];

$vehicleno = $_POST['vehicleno'];
$msg = $_POST['msg'];
$userid = $_POST['userid'];

$oldwono = $_POST['oldwno'];


$query = "UPDATE `new_billing_list` SET `entry_vehicle_no`='".$vehicleno."',`workorderno`='".$workorderno."',`workorderdate`='".$workorderdate."',`msg`='".$msg."' WHERE `user_id` = '".$userid."' and `billing_from_shop_id` = '".$adminid."' and `workorderno` = '".$oldwono."' and `dcno` = '".$dcno."'";

$result = mysqli_query($conn, $query);

header('Location: deliverychallanlists.php?userid='.$userid);

?>