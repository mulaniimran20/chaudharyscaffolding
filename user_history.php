<?php
session_start();
include('dbcon.php');

if(isset($_SESSION['adminsessionid']) && !empty($_SESSION['adminsessionid'])) {
   
}
else{
   header("Location: index.php"); 
}



$usertype = $_SESSION['usertype'];

if($usertype != 1)
{
    $disp = "display:none";
}
else{
    $disp = "display:block";
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
                    <th>Contact Person</th>
                    <th>User Contact No</th>
                    <th>User Email Id</th>
                    <th>User Address</th>
                    <th>Generate Return Challan</th>
                    <th>Action</th>
                    <th> Scanner</th>
                  </tr>
                </thead>
                <tfoot>
                 <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Site Name</th>
                    <th>Contact Person</th>
                    <th>User Contact No</th>
                    <th>User Email Id</th>
                    <th>User Address</th>
                    <th>Generate Return Challan</th>
                    <th>Action</th>
                    <th> Scanner</th>
                  </tr>
                </tfoot>
                <tbody>
                    
                    <?php
                    
                    $adminid = $_SESSION['adminsessionid'];
                    
                   $selectQuery = "SELECT * FROM `new_billing_list` WHERE `billing_from_shop_id` = '".$adminid."' and `product_pending_quantitis` > 0 group by `billing_recipt_id`";
                    
                    $result = mysqli_query($conn, $selectQuery);
                    $i = 0;
                    
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                    $i = $i + 1;
                    
                    $getuserdetails = "SELECT * FROM `user_list` WHERE `user_id` = '".$row['user_id']."'";
                    
                    $resultgetuserdetails = mysqli_query($conn, $getuserdetails);
                    
                    $rowuserdetails = mysqli_fetch_array($resultgetuserdetails, MYSQLI_ASSOC);
                    
                    if($row['return_challan_url'] == null)
                    {
                        $displayreturn = "style='display:none'";
                    }
                    else{
                        $displayreturn = "style='display:block'";
                    }
                    
                    if($row['bill_pdf_url'] == null)
                    {
                       $displaydelivery = "style='display:none'";
                    }
                    else{
                        $displaydelivery = "style='display:block'";
                    }
                    
                    ?>
                    
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $rowuserdetails['user_name']; ?></td>
                    <td><?php echo $rowuserdetails['site_name']; ?></td>
                    <td><?php echo $rowuserdetails['contacct_person']; ?></td>
                    <td><?php echo $rowuserdetails['user_contact_no']; ?></td>
                    <td><?php echo $rowuserdetails['user_email']; ?></td>
                    <td><?php echo $rowuserdetails['user_address']; ?></td>
                    <td><a class="btn btn-primary" href="generatereturnchallan.php?userid=<?php echo $row['user_id'];?>"><i class="fas fa-download"></i></a></td>
                    <td style="<?php echo $disp;?>" ><a class="btn btn-primary" href="billihistory.php?reciptid=<?php echo $row['billing_recipt_id']; ?>" style="display:block"><i class="fas fa-undo"></i></a>
                    </td> 
                    <td><a class="btn btn-primary" href="scanning.php?userid=<?php echo $row['user_id'];?>&type=1"><i class="fas fa-upload"></i></a>
                    </td>
                    
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

      <?php include 'footer.php'; ?>
      