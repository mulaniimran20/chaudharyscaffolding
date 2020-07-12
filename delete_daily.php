
<?php
include 'dbcon.php';
$id = $_REQUEST['id'];
$proid = $_REQUEST['proid'];

 $select = "SELECT * FROM `save_daily_entry` WHERE `id` = '".$id."'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$proqunt = $row['product_quantity'];
$billid = $row['purchase_id'];

echo "<br>";

  $sql = "DELETE FROM `save_daily_entry` WHERE `id` = '".$id."'" ;
 $result1 = mysqli_query($conn, $sql);

 echo "<br>";
 
$select1 = "SELECT * FROM `product_table` WHERE `product_id` = '".$proid."'";
$resultp = mysqli_query($conn, $select1);
$row = mysqli_fetch_array($resultp, MYSQLI_ASSOC);
$proquntp = $row['product_available_stock'];

$productqty= $proqunt + $proquntp;


$sql1= "UPDATE `product_table` SET `product_available_stock`='".$productqty."' WHERE `product_id` = '".$proid."'";

 $result2 = mysqli_query($conn, $sql1);

header("Location: daily_bill_details.php?billid=".$billid);

?>

