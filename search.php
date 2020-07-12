<?php

    include('dbcon.php');

session_start();

    $site_name=$_REQUEST['site_name'];
    $user_name = $_REQUEST['username'];


$adminid = $_SESSION['adminsessionid'];

   $query="SELECT * FROM `user_list` WHERE `user_name` = '".$user_name."' and `site_name` = '".$site_name."' and `user_register_shop_id` = '".$adminid."'";
    $result = mysqli_query($conn, $query);
    
    $count = mysqli_num_rows($result);
    
    if($count > 0)
    {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    
    $arr = array('contacct_person' => $row['contacct_person'], 'user_email' => $row['user_email'], 'user_contact_no' => $row['user_contact_no'], 'user_address' => $row['user_address']);
    }
    else{
        $arr = array();
    }
    
    echo json_encode($arr, JSON_PRETTY_PRINT);

    
    
    
    
?>