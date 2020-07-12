<?php

include('dbcon.php');
session_start();

$syear = $_REQUEST['syear'];


if($syear  != "")
{

$adminid = $_SESSION['adminsessionid'];

$query = "SELECT * FROM `rc_number` WHERE `rc_year`='".$syear."' and `shop_id` = '".$adminid."' ORDER BY `r_id` DESC LIMIT 1";

$result = mysqli_query($conn, $query);

$count = mysqli_num_rows($result);

if($count == 0)
{
    echo $dcidinsert = "1.".$syear;
}
else{
    
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $dcid = $row['rc_no'];
    
    $exp = explode(".", $dcid);
    
    $dcidinsertm = $exp[0] + 1;
    
 echo $dcidinsert = $dcidinsertm.".".$syear;
    
}

}
?>