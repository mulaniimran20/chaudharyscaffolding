<?php
include ('dbcon.php');
include ('header.php');

$userid= $_REQUEST['id'];
$type = $_REQUEST['']

?>
    <div id="content-wrapper">

      <div class="container-fluid">


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
                    <th>User Address</th>
                    <th>Return Entry Date</th>
                    <th>Download</th>
                  </tr>
                </thead>
                <tfoot>
                 <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Site Name</th>
                    <th>User Address</th>
                    <th>Return Entry Date</th>
                    <th>Download</th>
                  </tr>
                </tfoot>
                <tbody>
                
                
                <?php
                    
                    $adminid = $_SESSION['adminsessionid'];
                    
                    
                   $selectQuery = "SELECT * FROM `return_challan_data` WHERE `file_user_id` = '".$userid."' and `file_type` = 2";
                    
                    $result = mysqli_query($conn, $selectQuery);
                    $i = 0;
                    
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                    $i = $i + 1;
                    
                    $getuserdetails = "SELECT * FROM `user_list` WHERE `user_id` = '".$userid."'";
                    
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
                    <td><?php echo $rowuserdetails['user_address']; ?></td>
                    <td><?php echo $row['file_upload_date']; ?></td>
                    <td><a href="<?php echo $row['file_path']; ?>" class="btn btn-primary" target="_blank"><i class="fas fa-download"></i></a></td>
                    </tr>
                    <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>


     
      </div>
      <!-- /.container-fluid -->

      <?php include('footer.php'); ?>
      
                    




?>