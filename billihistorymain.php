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
            Return Invoice</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <?php
                
                $ss = "SELECT DISTINCT `billing_date` FROM `new_billing_list` WHERE `billing_recipt_id` = '".$reciptid."'";
                
                $res = mysqli_query($conn, $ss);
                $cols = "";
                $dates = array();
                while($rr = mysqli_fetch_array($res))
                {
                    $date = explode(" ", $rr['billing_date']);
                    
                    if($olddate != $date[0])
                    {
                    $cols = $cols."<th>".$date[0]."</th>";
                    array_push($dates,$date[0]);
                    }
                    else{
                        
                    }
                    
                    $olddate = $date[0];
                }
                
                
                
                $ss1 = "SELECT DISTINCT `return_date` FROM `return_data_table` WHERE `return_bill_id` = '".$reciptid."'";
                
                $res1 = mysqli_query($conn, $ss1);
                $cols1 = "";
                $dates1 = array();
                $olddate1 = "";
                while($rr1 = mysqli_fetch_array($res1))
                {
                    $date = explode(" ", $rr1['return_date']);
                   
                    if($olddate1 != $date[0])
                    {
                    $cols1 = $cols1."<th>".$date[0]."</th>";
                    array_push($dates1,$date[0]);
                    }
                    else{
                        
                    }
                    
                    $olddate1 = $date[0];
                }
                
                
                $colspancount1 = sizeof($dates);
                $colspancount2 = sizeof($dates1);
                
                
                ?>
                
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th colspan="<?php echo $colspancount1; ?>">Delivered Material</th>
                        <th></th>
                        <th colspan="<?php echo $colspancount2; ?>">Return Material</th>
                        <th></th>
                        <th></th>
                    </tr>
                  <tr>
                    <th>id</th>
                    <th>Product Name</th>
                    <?php echo $cols;?>
                    <th>Total</th>
                    <?php echo $cols1; ?>
                    <th>Total</th>
                    <th>Bal Qty</th>
                  </tr>
                </thead>
                <tfoot>
                 <tr>
                    <th>id</th>
                    <th>Product Name</th>
                    <?php echo $cols;?>
                    <th>Total</th>
                    <?php echo $cols1; ?>
                    <th>Total</th>
                    <th>Bal Qty</th>
                  </tr>
                </tfoot>
                <tbody>
                    
                    <?php
                    
                    $adminid = $_SESSION['adminsessionid'];
                    
                    $reciptid = $reciptid;
                    
                    $selectquery = "SELECT DISTINCT `product_id` FROM `new_billing_list` WHERE `billing_recipt_id` = '".$reciptid."'";
                    
                    $resultc = mysqli_query($conn, $selectquery);
                    $i = 0;
                        
                    while($row = mysqli_fetch_array($resultc, MYSQLI_ASSOC))
                    {
                        $i = $i + 1;
                        $pid = $row['product_id'];
                        
                         $columndata1 = "";
                        $totalmaindispaly = 0;
                        
                        $columndata2 = "";
                        $totalmaindispaly2 = 0;
                        
                         foreach($dates as $dd)
                        {
                            
                        
                       
                        
                        $q1 = "SELECT * FROM `new_billing_list` WHERE `billing_recipt_id` = '".$reciptid."' and `product_id` = '".$pid."' and `billing_date` LIKE '".$dd."%'";
                        $r1 = mysqli_query($conn, $q1);
                        
                        $totaltakenquantity = 0;
                        $pendingquantity = 0;
                        
                        while($row1 = mysqli_fetch_array($r1, MYSQLI_ASSOC))
                        {
                            $q2 = "SELECT * FROM `product_table` WHERE `product_id` = '".$pid."'";
                            $r2 = mysqli_query($conn, $q2);
                            $row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC);
                            
                            $productname = $row2['product_name'];
                            
                            $totaltakenquantity = $totaltakenquantity + $row1['product_quantity'];
                            $pendingquantity = $pendingquantity + $row1['product_pending_quantitis'];
                            
                            
                        }
                        $columndata1 = $columndata1."<td>".$totaltakenquantity."</td>";
                            
                        $totalmaindispaly = $totalmaindispaly + $totaltakenquantity;
                        
                        }
                 
                 
                 
                 
                         foreach($dates1 as $dd)
                        {
                            
                        
                       
                        
                        $q23 = "SELECT * FROM `return_data_table` WHERE `return_product_id` = '".$pid."' and `return_bill_id` = '".$reciptid."' and `return_date` LIKE '".$dd."%'";
                        $r23 = mysqli_query($conn, $q23);
                        
                        $totaltakenquantity = 0;
                        $pendingquantity = 0;
                        
                        while($row1 = mysqli_fetch_array($r23, MYSQLI_ASSOC))
                        {
                            $q2 = "SELECT * FROM `product_table` WHERE `product_id` = '".$pid."'";
                            $r2 = mysqli_query($conn, $q2);
                            $row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC);
                            
                            $productname = $row2['product_name'];
                            
                            $totaltakenquantity = $totaltakenquantity + $row1['return_count'];
                            
                            
                        }
                        $columndata2 = $columndata2."<td>".$totaltakenquantity."</td>";
                            
                        $totalmaindispaly2 = $totalmaindispaly2 + $totaltakenquantity;
                        
                        }
                 
                 
                        $balqty = $totalmaindispaly - $totalmaindispaly2;
                 
                        
                    ?>
                    
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $productname; ?></td>
                    <?php echo $columndata1; ?>
                    <td><?php echo $totalmaindispaly; ?></td>
                    <?php echo $columndata2; ?>
                    <td><?php echo $totalmaindispaly2; ?></td>
                    <td><?php echo $balqty; ?></td>
                    
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
    
    var updateCount = pendingquantity - returnquantity;
    
    $.ajax({
                url: "updatelist.php",
                type: "post",
                data: {'billingid':billingListId, 'productid':productId, 'returnquantity':returnquantity, 'pendingquantity':pendingquantity, 'updateCount':updateCount},
                success: function(d) {
                    location.reload();
                }
            });
    
    $('#P'+billingListId).val(updateCount);
    
}
</script>


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>


<script>
    $(document).ready(function() {
    $('#dataTable').DataTable( {
        dom: 'Bfrtip',
         lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
        ], 
        
    } );
} );
</script>

