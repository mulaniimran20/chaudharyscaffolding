<?php

session_start();
include("dbcon.php");

$emailId = $_POST['email'];
$password = $_POST['password'];

$query1 = "SELECT * FROM `login_table` WHERE `login_email` = '".$emailId."' and `login_password` = '".$password."'";


$result1 = mysqli_query($conn, $query1);

$count1 = mysqli_num_rows($result1);

$row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

$adminName = $row1['shop_id'];
    

$query = "SELECT * FROM `admin_details` WHERE `admin_id` = '".$adminName."' and `admin_status` = 1";

$result = mysqli_query($conn, $query);

$count = mysqli_num_rows($result);

if($count >= 1)
{
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $adminName = $row['admin_id'];
    
    $_SESSION["adminsessionid"] = $adminName;
    $_SESSION["usertype"] = $row1['user_type'];
}

header("Location: index.php");
?>