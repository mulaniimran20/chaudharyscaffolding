<?php


include('dbcon.php');

$username = $_REQUEST['username'];
$adminid = $_REQUEST['adminid'];


$select = "SELECT * FROM `user_list` WHERE `user_name` = '".$username."' and `user_register_shop_id` = '".$adminid."'";
$result = mysqli_query($conn, $select);

$data = "<select class='form-control' id='addaddress' onchange='addData()'><option value=''>Select Site Name</option>";
$data1 = "";
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{

$data1 = $data1."<option value='".$row['user_id']."'>".$row['site_name']."=>".$row['user_address']."</option>";

}

$data = $data.$data1."</select>";

echo $data;

?>