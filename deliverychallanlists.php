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
                    <th>Name</th>
                    <th>Site Name</th>
                    <th>Work Order No</th>
                    <th>Work Order Date</th>
                    <th>D. C. No.</th>
                    <th>D. Date</th>
                    <th>Edit Challan</th>
                    <th>Download Challan</th>
                    <th>Delete Challan</th>
                  </tr>
                </thead>
                <tfoot>
                 <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Site Name</th>
                    <th>Work Order No</th>
                    <th>Work Order Date</th>
                    <th>D. C. No.</th>
                    <th>D. Date</th>
                    <th>Edit Challan</th>
                    <th>Download Challan</th>
                    <th>Delete Challan</th>
                  </tr>
                </tfoot>
                <tbody>
                    
                    <?php
                    
                    $adminid = $_SESSION['adminsessionid'];
                    $userid = $_REQUEST['userid'];
                    
                    $userdetails = "SELECT * FROM `user_list` WHERE `user_id` = '".$userid."' and `user_register_shop_id` = '".$adminid."'";
                    $resultuser = mysqli_query($conn, $userdetails);
                    $rowuser = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);
                    
                    $name = $rowuser['user_name'];
                    $sitename = $rowuser['site_name']." ".$rowuser['user_address'];
                    
                    $select = "SELECT DISTINCT `dcno` FROM `new_billing_list` WHERE `user_id` = '".$userid."' and `billing_from_shop_id` = '".$adminid."'";
                    $result = mysqli_query($conn, $select);
                    $i = 0;
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        $i = $i + 1;
                        
                        $selectdata = "SELECT * FROM `new_billing_list` WHERE `dcno` = '".$row['dcno']."'";
                        $resultdata = mysqli_query($conn, $selectdata);
                        while($rowdata = mysqli_fetch_array($resultdata, MYSQLI_ASSOC))
                        {
                            $workorderno = $rowdata['workorderno'];
                            $workorderdate = $rowdata['workorderdate'];
                            $dcno = $rowdata['dcno'];
                            $dddate = $rowdata['datedd'];
                            $billnodd = $rowdata['billing_recipt_id'];
                        }
                       
                       ?>
                       
                        <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $sitename; ?></td>
                    <td><?php echo $workorderno; ?></td>
                    <td><?php echo $workorderdate; ?></td>
                    <td><?php echo $dcno; ?></td>
                    <td><?php echo $dddate; ?></td>
                    <td><a class="btn btn-primary" href="editdc.php?dcid=<?php echo $dcno; ?>&userid=<?php echo $_REQUEST['userid']; ?>&wono=<?php echo $workorderno; ?>"><i class="fas fa-edit"></i></a></td>
                    <td><a class="btn btn-primary" href="billpdf.php?billid=<?php echo $billnodd; ?>&dcno=<?php echo $dcno;?>&ccemail="><i class="fas fa-download"></i></a></td>
                    
                    <td><a class="btn btn-danger" href="deletechallan.php?dcid=<?php echo $dcno; ?>"><i class="fas fa-trash-alt"></i></a></td>
                    
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