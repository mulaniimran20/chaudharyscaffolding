<?php
session_start();
include('dbcon.php');
if(isset($_SESSION['adminsessionid']) && !empty($_SESSION['adminsessionid'])) {
   
}
else{
   header("Location: index.php"); 
}

$userytype = $_SESSION['usertype'];


?>

<?php include('header.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Example</div>
          <div class="card-body">
        
        <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Site Name</th>
                    <th>Contact Person</th>
                    <th>Contact Number</th>
                    <th>Purchase Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>id</th>
                    <th>Site Name</th>
                    <th>Contact Person</th>
                    <th>Contact Number</th>
                    <th>Purchase Date</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
            
            <?php
            
            
              $query = "SELECT * FROM `save_daily_entry` GROUP BY `purchase_id`";
            
            
            $result = mysqli_query($conn, $query);
            $i = 0;
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                $i = $i + 1;
                ?>
                
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['site_name'];?></td>
                    <td><?php echo $row['contact_person'];?></td>
                    <td><?php echo $row['contact_number'];?></td>
                    <td><?php echo $row['purchase_date']; ?></td>
                    <td><a class="btn btn-primary" href="daily_bill_details.php?billid=<?php echo $row['purchase_id']; ?>"><i class="fas fa-history"></i></a></td>
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