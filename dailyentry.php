



<!--$innerquery = "SELECT * FROM `new_billing_list` WHERE DATE(`billing_date`) = '2019-05-24' GROUP BY `billing_recipt_id`";-->





<?php
session_start();
include('dbcon.php');

if(isset($_SESSION['adminsessionid']) && !empty($_SESSION['adminsessionid'])) {
   
}
else{
   header("Location: index.php"); 
}


$adminid = $_SESSION['adminsessionid'];
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

          <select id="mySelect" onchange="myFunction()" class="form-control">
<option value="">Select Days</option>
  <option value="7">7 Days</option>
  <option value="15">15 Days</option>
  <option value="30">30 Days</option>
  <option value="45">45 Days</option>
  <option value="60">60 Days</option>
</select>



<script>
function myFunction() {
  var x = document.getElementById("mySelect").value;
  var url = "https://choudharyscaffolding.tech/dailyentry.php?dcount="+x;
  window.location.href = url;
}
</script>
              
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                 <tr>
                    <th>id</th>
                    <th>Date</th>
                    <th> All Delivery Challan List</th>
                    <th> All Return Challan List</th>
                  </tr>
                </thead>
                
                <tfoot>
                 <tr>
                    <th>id</th>
                    <th>Date</th>
                    <th> All Delivery Challan List</th>
                    <th> All Return Challan List</th>
                  </tr>
                </tfoot>
                <tbody>
   <?php         
   
   
   
                
$count = 0;
$n = $_REQUEST['dcount'];

if($n == "")
{
    $n = 7;
}

for($i=0; $i<$n; $i++)
{
    $count = $count + 1;
    $m = "-".$i." days";
    $date = date('Y-m-d', strtotime($m));
    
    
    $selectq = "SELECT * FROM `new_billing_list` WHERE DATE(`billing_date`) = '".$date."' and `billing_from_shop_id` = '".$adminid."'";
    $resumt = mysqli_query($conn, $selectq);
    $rowcount = mysqli_num_rows($resumt);
    
    if($rowcount > 0)
    {
    
    ?>
    
             <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><a class="btn btn-primary" href="opendcchalans.php?date=<?php echo $date; ?>&adminid=<?php echo $adminid; ?>"><i class="fas fa-edit"></i></a>
                    </td>
                    
                    <td><a class="btn btn-primary" href="openreturnchallans.php?date=<?php echo $date; ?>&adminid=<?php echo $adminid; ?>"><i class="fas fa-edit"></i></a>
                    </td>
                    
                  </tr>

    
    <?
    }
    else{
        $selectq1 = "SELECT * FROM `return_challan_data` WHERE DATE(`file_upload_date`) = '".$date."'";
    $resumt1 = mysqli_query($conn, $selectq1);
    $rowcount1 = mysqli_num_rows($resumt1);
    
    if($rowcount1 > 0)
    {
        ?>
        
        <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><a class="btn btn-primary" href="opendcchalans.php?date=<?php echo $date; ?>&adminid=<?php echo $adminid; ?>"><i class="fas fa-edit"></i></a>
                    </td>
                    
                    <td><a class="btn btn-primary" href="openreturnchallans.php?date=<?php echo $date; ?>&adminid=<?php echo $adminid; ?>"><i class="fas fa-edit"></i></a>
                    </td>
                    
                  </tr>
        
        <?php

    }
    }
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
     
 
      