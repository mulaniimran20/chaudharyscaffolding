<?php
session_start();
include('dbcon.php');

if(isset($_SESSION['adminsessionid']) && !empty($_SESSION['adminsessionid'])) {
   
}
else{
   header("Location: index.php"); 
}


$reciptid = $_REQUEST['reciptid'];

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
            Return Invoice <a style="float:right" href="returninvoice.php?reciptid=<?php echo $_REQUEST['reciptid']; ?>" class="btn btn-primary"><i class="fas fa-download"></i> Download Return Invoice</a></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                    <th>Returned Quantity</th>
                    <th>Returning Quantity</th>
                    <th>Product Remaining Quantity</th>
                    
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                 <tr>
                    <th>id</th>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                    <th>Returned Quantity</th>
                    <th>Returning Quantity</th>
                    <th>Product Remaining Quantity</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                    
                    <?php
                    
                    $adminid = $_SESSION['adminsessionid'];
                    
                    $fquery = "SELECT DISTINCT `product_id` FROM `new_billing_list` WHERE  `billing_recipt_id` = '".$reciptid."'";
                    $fresult = mysqli_query($conn, $fquery);
                    $i = 0;
                    
                    while($frow = mysqli_fetch_array($fresult, MYSQLI_ASSOC))
                    {
                        
                    
                    $i = $i + 1;
                    
                    $proquant = 0;
                    $propend = 0;
                    
                    
                   $selectQuery = "SELECT * FROM `new_billing_list` WHERE  `billing_recipt_id` = '".$reciptid."' and `product_id` = '".$frow['product_id']."'";
                    
                    $result = mysqli_query($conn, $selectQuery);
                    
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                        
                        $proquant = $proquant + $row['product_quantity'];
                        $propend = $propend + $row['product_pending_quantitis'];
                        
                    $getuserdetails = "SELECT * FROM `product_table` WHERE `product_id` = '".$row['product_id']."'";
                    
                    $resultgetuserdetails = mysqli_query($conn, $getuserdetails);
                    
                    $rowuserdetails = mysqli_fetch_array($resultgetuserdetails, MYSQLI_ASSOC);
                    
                    $totaltakenquantity = $row['product_quantity'];
                    $pendingquantity = $row['product_pending_quantitis'];
                    $takendate = $row['datedd'];
                    
                    $productname = $rowuserdetails['product_name'];
                    $productprice = $product_price['product_price'];
                    $bid = $row['billing_product_id'];
                    
                    
                    if($propend == 0)
                    {
                        $show = "value='0' readonly";
                    }
                    else{
                        $show = "";
                    }
                    }
                    ?>
                    
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $productname; ?></td>
                    <td><span id="T<?php echo $bid;?>"><?php echo $proquant; ?></span></td>
                    
                    <td><span id="RR<?php echo $bid;?>"><?php echo $proquant-$propend; ?></span></td>
                    
                    <td><input <?php echo $show; ?> type="number" name="returnquantity" placeholder="Enter Return Quantity" class="form-control" id="R<?php echo $bid;?>" /></td>
                    <td><input readonly class="form-control" type="number" name="pendingquantity" id="P<?php echo $bid;?>" value="<?php echo $propend; ?>" /></td>
                    
                    <td><button class="btn btn-primary" onClick="updateList(this.id)" id="B=<?php echo $bid.'='.$row['product_id']; ?>">Return</button></td>
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
<script>
function updateList(value) {
    
    var ids = value.split("=");
    
    var billingListId = ids[1];
    var productId = ids[2];
    
    var returnquantity = $('#R'+billingListId).val();
    var pendingquantity = $('#P'+billingListId).val();
    
    var vno = "<?php echo $_REQUEST['vno'];?>";
    var rcno = "<?php echo $_REQUEST['rcno']; ?>"
    
    var updateCount = pendingquantity - returnquantity;
    
    $.ajax({
                url: "updatelist.php",
                type: "post",
                data: {'billingid':billingListId, 'productid':productId, 'returnquantity':returnquantity, 'pendingquantity':pendingquantity, 'updateCount':updateCount, 'vno' : vno, 'rcno': rcno},
                success: function(d) {
                    //alert(d);
                    location.reload();
                }
            });
    
    $('#P'+billingListId).val(updateCount);
    
}
</script>



<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" id="modalLoginForm">
  <div class="modal-dialog" role="document">
      <form action="" method="get">
    <div class="modal-content">
      
      <input type="hidden" name="reciptid" value="<?php echo $_REQUEST['reciptid']; ?>" />
      
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="text" name="vno" id="defaultForm-email" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Vehicle Number</label>
        </div>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="text" name="rcno" id="defaultForm-rcno" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-rcno">RC Number</label>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <input type="submit" value="Submit" class="btn btn-primary" />
      </div>
    </div>
    </form>
  </div>
</div>



      <?php include('footer.php'); ?>
      

    
<script>
        var chkk = "<?php echo $_REQUEST['vno'];?>";
        
        if(chkk == "")
        {
             $('#modalLoginForm').modal('show');  
        }
</script>