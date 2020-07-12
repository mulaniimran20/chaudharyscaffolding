



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

$shopid = $adminid;

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
              
              
              <select required="" name="syear" id="syear" class="form-control">
                  <option value="">Select Year</option>
                  <option value="15-16">15-16</option>
                  <option value="16-17">16-17</option>
                  <option value="17-18">17-18</option>
                  <option value="18-19">18-19</option>
                  <option value="19-20">19-20</option>
                  <option value="">Remove Year Filter</option>
             </select>
             
             <br><br><br>
             
             
              
            <div class="table-responsive">

 



              <table class="table table-bordered" id="dataTableNewSort" width="100%" cellspacing="0">
                <thead>
                 <tr>
                    <th>id</th>
                    <th>User Name</th>
                    <th>Site Name</th>
                    <th>Site Address</th>
                    <th>Chalan No</th>
                    <th>Chalan No 1</th>
                    <th>Chalan Dae</th>
                    <th>Workorder No</th>
                    <th>Inventory Detais</th>
                  </tr>
                </thead>
                
                <tfoot>
                 <tr>
                    <th>id</th>
                    <th>User Name</th>
                    <th>Site Name</th>
                    <th>Site Address</th>
                    <th>Chalan No</th>
                    <th>Chalan No 1</th>
                    <th>Chalan Dae</th>
                    <th>Workorder No</th>
                    <th>Inventory Detais</th>
                  </tr>
                </tfoot>
                <tbody>
   <?php         
   
   
   
                


    $count = 0;
    
    $filteryear = $_REQUEST['syear'];
    
    if($filteryear == "")
    {
    $selectq = "SELECT * FROM `new_billing_list` WHERE `billing_from_shop_id` = '".$shopid."' GROUP BY `dcno` ORDER BY `user_id`";
    }
    else{
    $selectq = "SELECT * FROM `new_billing_list` WHERE `billing_from_shop_id` = '".$shopid."' and `dcno` LIKE '%.".$filteryear."%' GROUP BY `dcno` ORDER BY `user_id`";
    }
    $resumt = mysqli_query($conn, $selectq);
    
    while($row = mysqli_fetch_array($resumt, MYSQLI_ASSOC))
    {
     $count = $count + 1;
   
    $challanno = $row['dcno'];
    
    $challanno1arr = explode(".", $challanno);
    $challanno1 = (int)$challanno1arr[0];
    
    $challandate = $row['datedd'];
    $woroderdate = $row['workorderdate'];
    $workorderno = $row['workorderno'];
    $user_id = $row['user_id'];
   
   $selectuserquery = "SELECT * FROM `user_list` WHERE `user_id` = '".$user_id."'";
   $userdetails = mysqli_query($conn, $selectuserquery);
   $rowqueryuser = mysqli_fetch_array($userdetails, MYSQLI_ASSOC);
   
    ?>
    
             <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $rowqueryuser['user_name']; ?></td>
                    <td><?php echo $rowqueryuser['site_name'];?></td>
                    <td><?php echo $rowqueryuser['user_address'];?></td>
                    
                    <td><?php echo $challanno; ?></td>
                    <td><?php echo $challanno1; ?></td>
                    <td><?php echo $challandate;?></td>
                    <td><?php echo $workorderno;?></td>
                    <td><a class="btn btn-primary" href="downloaduserinventory.php?reciptid=<?php echo $row['billing_recipt_id']?>" style="display:block"><i class="fas fa-download"></i></a></td>
                    
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
      
      <script>
          $('#syear').on('change', function() {
              var syear = this.value;
              var url = new URL("https://choudharyscaffolding.tech/all_challan_list.php");
              url.searchParams.append('syear', syear);
              window.location.replace(url);


        });
        
        
        $(document).ready(function() {
            $('#dataTableNewSort').DataTable( {
                "order": [[ 5, "asc" ]]
            } );
        } );
        
        
      </script>
     
 
      