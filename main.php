<?php
session_start();
include('dbcon.php');
if(isset($_SESSION['adminsessionid']) && !empty($_SESSION['adminsessionid'])) {
   
}
else{
   header("Location: index.php"); 
}

$userytype = $_SESSION['usertype'];

if($userytype != 1)
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
        
        <div class="table-responsive" style="<?php echo $disp; ?>">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Email Id</th>
                    <th>Password</th>
                    <th>usertype</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>id</th>
                    <th>Email Id</th>
                    <th>Password</th>
                    <th>usertype</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
            
            <?php
            
            if($_SESSION['adminsessionid'] == 1)
            {
            
              $query = "SELECT * FROM `login_table`";
            }
            else{
              $query = "SELECT * FROM `login_table` WHERE `shop_id` = '".$_SESSION['adminsessionid']."'";  
            }
            
            
            $result = mysqli_query($conn, $query);
            $i = 0;
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                $i = 1;
                ?>
                
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['login_email'];?></td>
                    <td><?php echo $row['login_password'];?></td>
                    <td><?php echo $row['user_type'];?></td>
                    <td>Action</td>
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

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Todays Return Material Site</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTableNew" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Site Name</th>
                    <th>Contact Person</th>
                    <th>User Contact No</th>
                    <th>User Email Id</th>
                    <th>User Address</th>
                    <th>Return Date</th>
                    <th>Download Inventory</th>
                    <th>Generate Return Challan</th>
                    <th>Product Return Date</th>
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
                    <th>Return Date</th>
                    <th>Download Inventory</th>
                    <th>Generate Return Challan</th>
                    <th>Product Return Date</th>
                  </tr>
                </tfoot>
                <tbody>
                    
                    <?php
                    
                    $adminid = $_SESSION['adminsessionid'];
                    
                    date_default_timezone_set('Asia/Kolkata');
                    $datecom = time();
                    
                   $selectQuery = "SELECT * FROM `new_billing_list` WHERE `billing_from_shop_id` = '".$adminid."' and `return_product_date` != '' and `product_pending_quantitis` > 0 group by `billing_recipt_id`";
                    
                    $result = mysqli_query($conn, $selectQuery);
                    $i = 0;
                    
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                    $i = $i + 1;
                    
                    $getuserdetails = "SELECT * FROM `user_list` WHERE `user_id` = '".$row['user_id']."'";
                    
                    $resultgetuserdetails = mysqli_query($conn, $getuserdetails);
                    
                    $rowuserdetails = mysqli_fetch_array($resultgetuserdetails, MYSQLI_ASSOC);
                    
                    
                    $datechk = $row['return_product_date'];
                    $chktime = strtotime("$datechk 00:00:00");
                    
                    if($chktime < $datecom)
                    {
                    
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
                    <td><?php echo $datechk; ?></td>
                    <td><a class="btn btn-primary" href="downloaduserinventory.php?reciptid=<?php echo $row['billing_recipt_id']; ?>" style="display:block"><i class="fas fa-download"></i></a></td>
                    <td><a href="generatereturnchallan.php?userid=<?php echo $row['user_id'];?>" class="btn btn-primary"><i class="fas fa-download"></i></a></td>
                    <td><a class="btn btn-primary" onclick="openModal(this.id)" id="<?php echo $row['user_id'];?>"><i class="fas fa-history"></i></a></td>
                  </tr>
                  <?php
                    }
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>


<div class="modal fade" id="myReturnDateModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="post" action="return_date.php">
              <input type="date" placeholder="return date" name="returndate" id="returndate" class="form-control">
              <br>
              <input type="hidden" name="userid" id="useridforreturn" >
              <input type="submit" name="submit" value="Submit" class="btn btn-primary form-control">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  



      </div>
      <!-- /.container-fluid -->

      <?php include('footer.php'); ?>
      
      
      
      <script>
          function openModal(id)
          {
              
              var now = new Date();
            
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            
            var today = now.getFullYear() + "-" + (month) + "-" + (day);
            
            $('#returndate').attr('min', today);
            

              $('#useridforreturn').val(id);
              $('#myReturnDateModal').modal('show');
          }
          
         

          
      </script>