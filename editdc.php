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


<?php

$userid = $_REQUEST['userid'];
$dcid = $_REQUEST['dcid'];
$wno = $_REQUEST['wono'];

$query = "SELECT * FROM `user_list` WHERE `user_id` = '".$userid."'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);



$adminid = $_SESSION['adminsessionid'];
                    $userid = $_REQUEST['userid'];
                    $dcno = $_REQUEST['dcid'];
                    $wono = $_REQUEST['wono'];
                    
                    $getproductlist = "SELECT * FROM `new_billing_list` WHERE `user_id` = '".$userid."' and `billing_from_shop_id` = '".$adminid."' and `dcno` = '".$dcno."' and `workorderno` = '".$wono."'";
                    
                    $getresult = mysqli_query($conn, $getproductlist);
                    
                    $rowres = mysqli_fetch_array($getresult, MYSQLI_ASSOC);
                    
                    $vehicleno = $rowres['entry_vehicle_no'];
                    $msg = $rowres['msg'];
                    $dddate = $rowres['datedd'];
                    $wodate = $rowres['workorderdate'];
                    

?>




<div id="modalRegister" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center"></h4>
            </div>
            <div class="modal-body">
            <div class="form-group">
                <select id="proname" class="form-control" name="proname">
                                        <option value="">Select Product Name</option>

                <?php 
                    $adminid = $_SESSION['adminsessionid'];
                    $prodetailsquery = "SELECT * FROM `product_table` WHERE `product_owner_shop_id` = '".$adminid."' and `procut_status` = '1'";
                    $ress = mysqli_query($conn, $prodetailsquery);
                    
                    while($rows = mysqli_fetch_array($ress, MYSQLI_ASSOC))
                    {
                    
                ?>
                                <option value="<?php echo $rows['product_id']; ?>"><?php echo $rows['product_name']; ?></option>
                <?php
                    }
                ?>
      </select>
      </div>
      <div class="form-group">
      <input type="number" placeholder="Enter Quantity" name="proquant" id="proquant"  class="form-control"/>
      
      </div>
      <div class="form-group">
      <button onclick="addproduct()" class="from-control btn btn-primary">Add New Product</button>
      </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>






<form action="updatedata.php" method="post" id="formid">
        
  <div>
    <div class="card">
      <div class="card-header">Enter User Details</div>
      <div class="card-body">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="firstName" name="productname" class="form-control" placeholder="User Name" required="required" autofocus="autofocus" value="<?php echo $row['user_name']; ?>" readonly>
                  <label for="firstName">User Name</label>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="email" id="lastName" name="productstock" class="form-control" placeholder="Email ID" value="<?php echo $row['user_email']; ?>" readonly>
                  <label for="lastName">Email ID</label>
                </div>
              </div>
            </div>
          </div>
         
         
   
     <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="site_name" id="site_name" class="form-control" placeholder="Site Name" required="required" value="<?php echo $row['site_name']; ?>" readonly>
                  <label for="site_name">Site Name</label>
                </div>
            </div>
              
         
         
         
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="workorderno" name="workorderno" class="form-control" placeholder="Work Order Number" autofocus="autofocus" value="<?php echo $_REQUEST['wono']; ?>">
                  <label for="workorderno">Work Order No.</label>
                </div>
              </div>
              
              
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="date" id="workorderdate" name="workorderdate" class="form-control" placeholder="Work Order Date" value="<?php echo $wodate; ?>">
                  <label for="workorderdate">Work Order Date</label>
                </div>
              </div>
            </div>
          </div>
         
         
         
         
         
         <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="dcno" name="dcno" class="form-control" placeholder="D.C.No" required="required" autofocus="autofocus" value="<?php echo $_REQUEST['dcid']; ?>" readonly>
                  <label for="dcno">D. C. No.</label>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="date" id="datedd" name="datedd" class="form-control" placeholder="Date"  value="<?php echo $dddate; ?>" readonly>
                  <label for="datedd">Date</label>
                </div>
              </div>
            </div>
          </div>
         
         

         
          
          <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="address" id="inputPassword" class="form-control" placeholder="Address" required="required" value="<?php echo $row['user_address']; ?>" readonly>
                  <label for="inputPassword">Address</label>
                </div>
            </div>
            
            <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="contactname" id="contactname" class="form-control" placeholder="Contact Name" value="<?php echo $row['contacct_person']; ?>" readonly>
                  <label for="contactname">Contact Person Name</label>
                </div>
            </div>
            
            <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="productprice" id="inputPassword1" class="form-control" placeholder="Contact Number" value="<?php echo $row['user_contact_no']; ?>" readonly>
                  <label for="inputPassword1">Contact Number</label>
                </div>
            </div>
          
            <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="vehicleno" id="inputVehicle" class="form-control" placeholder="Vehicle Number" value="<?php echo $vehicleno; ?>">
                  <label for="inputVehicle">Vehicle Number</label>
                </div>
            </div>
            
             <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="msg" id="msg" class="form-control" placeholder="Delivery Message"  value="<?php echo $msg; ?>">
                  <label for="msg">Delivery Message</label>
                </div>
            </div>
       <input type="hidden" value="<?php echo $_REQUEST['userid']; ?>" name="userid">
       <input type="hidden" name="oldwno" value="<?php echo $_REQUEST['wono']; ?>">
         <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="submit" class="form-control btn btn-primary" value="Update">
                </div>
              </div>
            </div>
          </div>
         
            
       
           
            
          </div>
          
      </div>
    </div>
  </div>
  

        
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Products Details <a class="btn btn-primary" style="float:right" data-toggle="modal" data-target="#modalRegister"><i class="fas fa-add"></i>Add Product</a></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Product Name</th>
                    <th>Product Quantity Old Order</th>
                    <th>Product Updated Quantity</th>
                    <th>Product Pending Quantity</th>
                    <th>Action</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tfoot>
                 <tr>
                    <th>id</th>
                    <th>Product Name</th>
                    <th>Product Quantity Old Order</th>
                    <th>Product Updated Quantity</th>
                    <th>Product Pending Quantity</th>
                    <th>Action</th>
                    <th>Delete</th>
                  </tr>
                </tfoot>
                <tbody>
                    
                    <?php
                    
                    $adminid = $_SESSION['adminsessionid'];
                    $userid = $_REQUEST['userid'];
                    $dcno = $_REQUEST['dcid'];
                    $wono = $_REQUEST['wono'];
                    
                    $getproductlist = "SELECT * FROM `new_billing_list` WHERE `user_id` = '".$userid."' and `billing_from_shop_id` = '".$adminid."' and `dcno` = '".$dcno."'";
                    
                    $getresult = mysqli_query($conn, $getproductlist);
                    $i = 0;
                    while($row = mysqli_fetch_array($getresult, MYSQLI_ASSOC))
                    {
                        $i = $i + 1;
                        $getproductdetails = "SELECT * FROM `product_table` WHERE `product_id` = '".$row['product_id']."'";
                        $resultprodetails = mysqli_query($conn, $getproductdetails);
                        $rowdetails = mysqli_fetch_array($resultprodetails, MYSQLI_ASSOC);
                
                        $productname = $rowdetails['product_name'];
                        $productmainstockavailable = $rowdetails['product_available_stock'];
                        
                        $productquant = $row['product_quantity'];
                        $pendingquant = $row['product_pending_quantitis'];
                       
                       ?>
                       
                       
                    <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $productname; ?></td>
                    <td><input type="text" value="<?php echo $productquant; ?>" class="form-control" id="D-<?php echo $row['billing_product_id'];?>" readonly/></td>
                    <td><input type="number" placeholder="Enter Updated Quantity" class="form-control" id="E-<?php echo $row['billing_product_id'];?>"></td>
                    <td><input type="text" value="<?php echo $pendingquant; ?>" class="form-control" id="P-<?php echo $row['billing_product_id'];?>" readonly/></td>
                    <td><button class="btn btn-primary" id="<?php echo $row['billing_product_id']; ?>" onclick="updatedata(this.id)">Update</button></td>
                    <td><a class="btn btn-primary" href="deleteproid.php?dcid=<?php echo $_REQUEST['dcid'] ?>&userid=<?php echo $_REQUEST['userid'] ?>&wono=<?php echo $_REQUEST['wono'] ?>&id=<?php echo $row['billing_product_id']; ?>"><i class="fas fa-trash"></i></a></td>
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
      
      <script>
          function updatedata(id)
          {
              
              
              var oldquant = $('#D-'+id).val();
              var newquant = $('#E-'+id).val();
              var pendquant = $('#P-'+id).val();
              
              var deliverquant = oldquant - pendquant;
              var pending = newquant - deliverquant;
              
            var updateid = id;
            
            
            $.ajax({
                url: "updatedc.php",
                type: "post",
                data: {'updateid':updateid, 'oldquant':oldquant, 'newquant':newquant, 'pendingquantity':pending, 'oldpendingquantity': pendquant},
                success: function(d) {
                   // alert(d);
                    location.reload();
                }
            });

            
              
          }
          
          
          function addproduct()
          {
           
           var dcno = "<?php echo $_REQUEST['dcid']; ?>";
           var userid = "<?php echo $_REQUEST['userid']; ?>";
           var wono = "<?php echo $_REQUEST['wono']; ?>";
           var adminid = <?php echo $adminid; ?>;
              
              var getproductname = $('#proname').val();
             
              var productquantity = $('#proquant').val();
              
              if(getproductname == "")
              {
                  alert("Please Select Product First");
              }
              else{
               
               $.ajax({
                url: "addnewproductinlist.php",
                type: "post",
                data: {'dcno':dcno, 'userid':userid, 'wono':wono, 'getproductname':getproductname, 'productquantity': productquantity, 'adminid': adminid},
                success: function(d) {
                    
                    location.reload();
                }
            });
                  
              }
              
        }
          
      </script>
      