<?php

include('dbcon.php');
session_start();

$syear = $_REQUEST['syear'];


if($syear  != "")
{

$adminid = $_SESSION['adminsessionid'];

$query = "SELECT * FROM `dc_number` WHERE `year`='".$syear."' and `shopid` = '".$adminid."' ORDER BY `d_id` DESC LIMIT 1";

$result = mysqli_query($conn, $query);

$count = mysqli_num_rows($result);

if($count == 0)
{
    echo $dcidinsert = "1.".$syear;
}
else{
    
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $dcid = $row['dc_id'];
    
    $exp = explode(".", $dcid);
    
    $dcidinsertm = $exp[0] + 1;
    
 echo $dcidinsert = $dcidinsertm.".".$syear;
    
}

}
?>