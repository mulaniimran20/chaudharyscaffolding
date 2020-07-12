<?php
session_start();
include('dbcon.php');



if(isset($_SESSION['adminsessionid']) && !empty($_SESSION['adminsessionid'])) {
   
}
else{
   header("Location: index.php"); 
}
?>

<?php include('header.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Stock List</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Products Stock Details<a class="btn btn-primary" style="float:right;" href="addmissingentry.php">Add Missing Entry</a></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Product Name</th>
                    <th>Total Stock</th>
                    <th>Available Stock</th>
                    <th>Damaged or Missing Stock</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>id</th>
                    <th>Product Name</th>
                    <th>Total Stock</th>
                    <th>Available Stock</th>
                    <th>Damaged or Missing Stock</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                    
                    <?php
                    
                    $adminid = $_SESSION['adminsessionid'];
                    
                    $selectQuery = "SELECT * FROM `product_table` WHERE `procut_status` = 1 and `product_owner_shop_id` = '".$adminid."'";
                    
                    $result = mysqli_query($conn, $selectQuery);
                    $i = 0;
                    
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        
                        $productid = $row['product_id'];
                        
                        $selectchkqueryp = "SELECT * FROM `missing_data_entry` WHERE `missing_product_id` = '".$productid."' and `missing_from_admin` = '".$adminid."'";
                        $resultckm = mysqli_query($conn, $selectchkqueryp);
                        
                        $dispaypendings = 0;
                        
                        while($rowm = mysqli_fetch_array($resultckm, MYSQLI_ASSOC))
                        {
                            $dispaypendings = $dispaypendings + $rowm['missing_quantity'];
                        }
                        
                    $i = $i + 1;
                    ?>
                    
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['product_quantity']; ?></td>
                    <td><?php echo $row['product_available_stock']; ?></td>
                    <td><?php echo $dispaypendings; ?></td>
                    <td><a class="btn btn-primary" href="missinglist.php?pid=<?php echo $productid;?>">Missing Details</a></td>
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