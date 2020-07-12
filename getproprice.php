<?php

include('dbcon.php');

$proid = $_REQUEST['proid'];

$query = "SELECT * FROM `product_table` WHERE `product_id` = '".$proid."'";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

echo $row['product_price'];

?>