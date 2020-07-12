<?php
session_start();
include('dbcon.php');
if(isset($_SESSION['adminsessionid']) && !empty($_SESSION['adminsessionid'])) {
   
}
else{
   header("Location: index.php"); 
}

$userytype = $_SESSION['usertype'];

$billid = $_REQUEST['billid'];

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
        
        <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                    <th>Edit</th>
                    <th>Date of Purchase</th>
                    <th>Delete </th>
                    <th>Edit</th>
                    <th> </th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>id</th>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                    <th>Edit</th>
                    <th>Date of Purchase</th>
                    <th>Delete </th>
                    <th>Edit</th>
                  </tr>
                </tfoot>
                <tbody>
            
            <?php
            
            
              $query = "SELECT * FROM `save_daily_entry` WHERE `purchase_id` = '".$billid."'";
            
            
            $result = mysqli_query($conn, $query);
            $i = 0;
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
                $i = $i+1;
                
                $queryprodetails = "SELECT * FROM `product_table` WHERE `product_id` = '".$row['product_id']."'";
                $resultpro = mysqli_query($conn, $queryprodetails);
                $rowpro = mysqli_fetch_array($resultpro, MYSQLI_ASSOC);
                ?>
                
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $rowpro['product_name'];?></td>
                    <td><?php echo $row['product_quantity'];?></td>
                    <td> 
                    
                        <div class="form-group">
                        <input type="number" class="form-control input-sm" id="edit_qty-<?php echo $row['id'];?>">
                        </div>
                
                    </td>
                    <td><?php echo $row['purchase_date'];?></td>
                    <td> <a href="delete_daily.php?id=<?php echo $row['id'];?>&proid=<?php echo $row['product_id'];?>"  class="btn btn-primary" style="font-size:24px;color:blue"> <i class="fa fa-trash" style="font-size:20px;color:blue"></i> </a> 
                    </td>
                    <td>
                        <a onclick="editData(this.id)" id="<?php echo $row['id']; ?>"  class="btn btn-primary" style="font-size:24px;color:blue"><i class="fa fa-edit" style="font-size:20px;color:blue"></i> </a> 
                        </td>
                    
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
          function editData(id)
          {
              
              var quantity = $('#edit_qty-'+id).val();
              var id = id;
              
             /* 
              var xmlhttp = new XMLHttpRequest();
               xmlhttp.open("GET", "gethint.php?q=" + id+"&abc="+qnty, true);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.send();
           */
        if(quantity != "")
        {
           $.ajax({
      type: "POST",
      url: "edit_daily.php",
      data: {id: id, qnty :quantity},
      success: function(resultData){
         location.reload();
      }
});
        }
        else{
             alert("Ener Data");
        }
           
              
          }
      </script>