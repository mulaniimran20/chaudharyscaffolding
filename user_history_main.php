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
                    <th style="width: 3%">id</th>
                    <th style="width: 10%">Name</th>
                    <th style="width: 10%">Site Name</th>
                    <th style="width: 10%">Contact Person</th>
                    <th style="width: 10%">User Contact Details</th>
                    <th style="width: 9%">User Address</th>
                    <th style="width: 8%">Download Inventory</th>
                    <th style="width: 8%">Edit Delievery Challan</th>
                    <th style="width: 8%"> Return Challan Data </th>
                    <th style="width: 8%"> Delivery Challan Data </th>
                    <th style="width: 8%">Product Return Date</th>
                    <th>Delete Inventory</th>
                  </tr>
                </thead>
                <tfoot>
                 <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Site Name</th>
                    <th>Contact Person</th>
                    <th>User Contact Details</th>
                    <th>User Address</th>
                    <th>Download Inventory</th>
                    <th>Edit Delivery Challan</th>
                     <th> Return Challaen Data </th>
                     <th> Delivery Challaen Data </th>  
                    <th>Product Return Date</th>
                    <th>Delete Inventory</th>
                  </tr>
                </tfoot>
                <tbody>
                    
                    <?php
                    
                    $adminid = $_SESSION['adminsessionid'];
                    
                   $selectQuery = "SELECT * FROM `new_billing_list` WHERE `billing_from_shop_id` = '".$adminid."' group by `billing_recipt_id`";
                    
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
                    <td><?php echo $rowuserdetails['user_contact_no']; ?> <br> <?php echo $rowuserdetails['user_email']; ?></td>
                    <td><?php echo $rowuserdetails['user_address']; ?></td>
                    <td><a class="btn btn-primary" href="downloaduserinventory.php?reciptid=<?php echo $row['billing_recipt_id']; ?>" style="display:block"><i class="fas fa-download"></i></a></td>
                    <td><a href="deliverychallanlists.php?userid=<?php echo $row['user_id'];?>" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                    <td><a class="btn btn-primary" href="record.php?id=<?php echo $row['user_id'];?>"><i class="fas fa-pager"></i></a></td>
                    <td><a class="btn btn-primary" href="record1.php?id=<?php echo $row['user_id'];?>"><i class="fas fa-pager"></i></a></td>
                    <td><a class="btn btn-primary" onclick="openModal(this.id)" id="<?php echo $row['user_id'];?>"><i class="fas fa-history"></i></a></td>
                    <td><a class="btn btn-primary" href="deleteentry.php?idd=<?php echo $rowuserdetails['user_id']; ?>"><i class="fas fa-trash"></i></a></td>
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
        
        
        <?php include('footer.php'); ?>

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