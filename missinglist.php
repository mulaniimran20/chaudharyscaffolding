<?php
session_start();
include('dbcon.php');

if(isset($_SESSION['adminsessionid']) && !empty($_SESSION['adminsessionid'])) {
   
}
else{
   header("Location: index.php"); 
}

$pid = $_REQUEST['pid'];

?>

<?php include('header.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">User History List</a>
          </li>
          <li class="breadcrumb-item active">Return List</li>
        </ol>

        
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Products Stock Available</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>User Name</th>
                    <th>User Contact No</th>
                    <th>User Email Id</th>
                    <th>User Address</th>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                  </tr>
                </thead>
                <tfoot>
                 <tr>
                    <th>id</th>
                    <th>User Name</th>
                    <th>User Contact No</th>
                    <th>User Email Id</th>
                    <th>User Address</th>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                  </tr>
                </tfoot>
                <tbody>
                    
                    <?php
                    
                    $adminid = $_SESSION['adminsessionid'];
                    
                   $selectQuery = "SELECT DISTINCT `missing_by_user_id` FROM `missing_data_entry` WHERE `missing_from_admin` = '".$adminid."' and `missing_product_id` = '".$pid."' and `missing_status` = '1'";
                    
                    $result = mysqli_query($conn, $selectQuery);
                    $i = 0;
                    
                    
                    $selectproductdetailsquery = "SELECT * FROM `product_table` WHERE `product_id` = '".$pid."'";
                    $resultproductdetails = mysqli_query($conn, $selectproductdetailsquery);
                    $rowproductdetails = mysqli_fetch_array($resultproductdetails, MYSQLI_ASSOC);
                    
                    $proname = $rowproductdetails['product_name'];
                    
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                    $i = $i + 1;
                    
                    $getuserdetails = "SELECT * FROM `user_list` WHERE `user_id` = '".$row['missing_by_user_id']."'";
                    
                    $resultgetuserdetails = mysqli_query($conn, $getuserdetails);
                    
                    $rowuserdetails = mysqli_fetch_array($resultgetuserdetails, MYSQLI_ASSOC);
                    
                    
                    
                    $proquantity = "SELECT * FROM `missing_data_entry` WHERE `missing_by_user_id` = '".$row['missing_by_user_id']."' and `missing_product_id` = '".$pid."' and `missing_from_admin` = '".$adminid."'";
                    
                    $resultproquant = mysqli_query($conn, $proquantity);
                    
                    $misquant = 0;
                    while($rowquant = mysqli_fetch_array($resultproquant, MYSQLI_ASSOC))
                    {
                        $misquant = $misquant + $rowquant['missing_quantity'];
                    }
                    
                                        ?>
                    
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $rowuserdetails['user_name']; ?></td>
                    <td><?php echo $rowuserdetails['user_contact_no']; ?></td>
                    <td><?php echo $rowuserdetails['user_email']; ?></td>
                    <td><?php echo $rowuserdetails['user_address']; ?></td>
                    <td><?php echo $proname; ?></td>
                    <td><?php echo $misquant; ?></td>
                  </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <?php include('footer.php'); ?>