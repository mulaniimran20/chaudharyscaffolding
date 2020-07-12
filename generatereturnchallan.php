<?php
session_start();
if(isset($_SESSION['adminsessionid']) && !empty($_SESSION['adminsessionid'])) {
   
}
else{
   header("Location: index.php"); 
}

include('dbcon.php');

$adminid = $_SESSION['adminsessionid'];

$userid = $_REQUEST['userid'];


$query = "SELECT * FROM `user_list` WHERE `user_id` = '".$userid."' and `user_register_shop_id` = '".$adminid."'";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);





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
            Generate New Bill</div>
          <div class="card-body">


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Billing</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
<form action="generatereturnpdf.php" method="post" id="formid">
        
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
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" id="dcno" name="dcno" class="form-control" placeholder="R.C.No" required="required" autofocus="autofocus">
                  <label for="dcno">R. C. No.</label>
                </div>
              </div>
              
              
              <div class="col-md-4">
                <select required="" name="syear" id="syear" class="form-control">
                  <option value="">Select Year</option>
                  <option value="15-16">15-16</option>
                  <option value="16-17">16-17</option>
                  <option value="17-18">17-18</option>
                  <option value="18-19">18-19</option>
                  <option value="19-20">19-20</option>
                </select>
              </div>
              
              
              
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="date" id="datedd" name="datedd" class="form-control" placeholder="Date" required="required" value="<?php echo date("Y-m-d");?>">
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
                  <input type="text" name="contactname" id="contactname" class="form-control" placeholder="Contact Name" required="required" value="<?php echo $row['contacct_person']; ?>" readonly>
                  <label for="contactname">Contact Person Name</label>
                </div>
            </div>
            
            <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="productprice" id="inputPassword1" class="form-control" placeholder="Contact Number" required="required" value="<?php echo $row['user_contact_no']; ?>" readonly>
                  <label for="inputPassword1">Contact Number</label>
                </div>
            </div>
          
            <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="vehicleno" id="inputVehicle" class="form-control" placeholder="Vehicle Number" required="required">
                  <label for="inputVehicle">Vehicle Number</label>
                </div>
            </div>
            
         <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="text" id="supervisor" name="supervisor" class="form-control" placeholder="Supervisor sign" required="required">
                  <label for="supervisor">Supervisor sign</label>
                </div>
              </div>
            </div>
          </div>
         
             <div class="form-group">
                <div class="form-label-group">
                  <input type="hidden" name="userid" value="<?php echo $userid; ?>" value="">
                </div>
            </div>
       
       
           
            
          </div>
          
      </div>
    </div>
  </div>
  
          <input type="submit" value="Generate Return Challan" class="btn btn-primary btn-block" />
  
</form>


 
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  
  

</body>

</html>



          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <?php include('footer.php'); ?>
      
      
      <script>
    
    $('#syear').on('change', function() {
  var syear = this.value;
  
  
  
  $.ajax({
     type: "POST",
     url: 'get_rc_id.php',
     data: {"syear":syear},
     success: function(data) {
          $('#dcno').val(data);
     }
});
  
});

    
</script>
