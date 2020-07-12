







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
                    <th>RC User Name</th>
                    <th>RC Site Name</th>
                    <th>RC Site Address</th>
                    <th>Entry Date Time</th>
                    <th>Download Return Challan</th>
                  </tr>
                </thead>
                
                <tfoot>
                 <tr>
                    <th>id</th>
                    <th>RC User Name</th>
                    <th>RC Site Name</th>
                    <th>RC Site Address</th>
                    <th>Entry Date Time</th>
                    <th>Download Return Challan</th>
                  </tr>
                </tfoot>
                <tbody>
   
    <?php                  
   
   $date = $_REQUEST['date'];
   
                    $query = "SELECT * FROM `return_challan_data` WHERE DATE(`file_upload_date`) = '".$date."' and `file_type` = 1" ;

$result = mysqli_query($conn, $query);

$count = 0;
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $count = $count + 1;
    $s = $row['file_upload_date'];
    $time = strtotime($s);
    $date = date('Y-m-d', $time);
    
    $userid = $row['file_user_id'];
    $path = $row['file_path'];
    
    $selectuserdetails = "SELECT * FROM `user_list` WHERE `user_id` = '".$userid."'";
    $resultm = mysqli_query($conn, $selectuserdetails);
    $rowm = mysqli_fetch_array($resultm, MYSQLI_ASSOC);
    
    $username = $rowm['user_name'];
    $sitename = $rowm['site_name'];
    $siteaddress = $rowm['user_address'];
    
    ?>
    
             <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $sitename; ?></td>
                    <td><?php echo $siteaddress; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><a class="btn btn-primary" href="<?php echo $path; ?>" target="_blank"><i class="fas fa-download"></i></a></td>
                    
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
      