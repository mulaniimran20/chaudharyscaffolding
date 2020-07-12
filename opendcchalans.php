







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

              
              
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                 <tr>
                    <th>id</th>
                    <th>DC NO</th>
                    <th>User Name</th>
                    <th>Site Name</th>
                    <th>Work Order Date</th>
                    <th>Entry Date Time</th>
                    <th>Download Delivery Challan</th>
                  </tr>
                </thead>
                
                <tfoot>
                 <tr>
                    <th>id</th>
                    <th>DC NO</th>
                    <th>User Name</th>
                    <th>Site Name</th>
                    <th>Work Order Date</th>
                    <th>Entry Date Time</th>
                    <th>Download Delivery Challan</th>
                  </tr>
                </tfoot>
                <tbody>
   
    <?php                  
   
   $date = $_REQUEST['date'];
   
                    $query = "SELECT * FROM `new_billing_list` WHERE DATE(`billing_date`) = '".$date."' and `billing_from_shop_id` = '".$adminid."' GROUP BY `dcno`";

$result = mysqli_query($conn, $query);

$count = 0;
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $count = $count + 1;
    $s = $row['billing_date'];
    $time = strtotime($s);
    $date = date('Y-m-d', $time);
    
    $dcno = $row['dcno'];
    
    $userid = $row['user_id'];
    $selectfromuser = "SELECT * FROM `user_list` WHERE `user_id` = '".$userid."'";
    $resusltuser = mysqli_query($conn, $selectfromuser);
    $rowuser = mysqli_fetch_array($resusltuser, MYSQLI_ASSOC);
    
    $username = $rowuser['user_name'];
    $sitename = $rowuser['site_name'].$rowuser['user_address'];
    
    $workorderno = $row['workorderno'];
    $wororderdate = $row['workorderdate'];
    
    $dddate = $row['billing_date'];
    $billnodd = $row['billing_recipt_id'];
    
    
    ?>
    
             <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $dcno; ?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $sitename; ?></td>
                    <td><?php echo $wororderdate; ?></td>
                    <td><?php echo $dddate; ?></td>
                    <td><a class="btn btn-primary" href="billpdf.php?billid=<?php echo $billnodd; ?>&dcno=<?php echo $dcno;?>&ccemail="><i class="fas fa-download"></i></a></td>
                    
                  </tr>

    
    <?
    
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
      