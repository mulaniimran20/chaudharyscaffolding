<?php
session_start();
if(isset($_SESSION['adminsessionid']) && !empty($_SESSION['adminsessionid'])) {
   
}
else{
   header("Location: index.php"); 
}

include('dbcon.php');

$adminid = $_SESSION['adminsessionid'];

$rit = $_REQUEST['rid'];
$vno = $_REQUEST['vno'];

if($rit == "" and $vno == "")
{
    $visi = "display:none;";
    $visi1 = "display:block;";
}
else{
    $visi = "display:block;";
    $visi1 = "display:none;";
}

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


<body class="bg-dark">
    
    
     <div>
    <div class="card" style="<?php echo $visi1; ?>">
      <div class="card-header">Enter User Details</div>
      <div class="card-body">
          
           <form action="#" method="get" id="formidm">
            <div class="form-group">
                <div class="form-group">
                  <input type="text" name="rid" id="inputPasswordm" class="form-control" placeholder="Enter Order Number" required="required">
                </div>
            </div>
          
            <div class="form-group">
                <div class="form-group">
                  <input type="text" name="vno" id="inputVehiclem" class="form-control" placeholder="Vehicle Number" >
                </div>
            </div>
           
            <div class="form-group">
                <div class="form-group">
                  <input type="submit" name="Submit" id="inputReciptm" class="form-control" value="Submit">
                </div>
            </div>
    </form>
 
            
          </div>
          
      </div>
    </div>
    
 
    
    
<form action="savemissing.php" method="post" id="formid" style="<?php echo $visi; ?>">
        
  <div>
    <div class="card">
      <div class="card-header">Enter User Details</div>
      <div class="card-body">
          
            <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="productprice" id="inputPassword1" class="form-control" placeholder="Missing From Recipt Number" required="required" value="<?php echo $rit; ?>" readonly>
                  <label for="inputPassword1">Missing Receipt Number</label>
                </div>
            </div>
          
            <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="vehicleno" id="inputVehicle" class="form-control" placeholder="Vehicle Number" required="required" value="<?php echo $vno; ?>" readonly>
                  <label for="inputVehicle">Vehicle Number</label>
                </div>
            </div>
           
          </div>
          
      </div>
    </div>
  </div>
  
  
  
    <div class="" style="<?php echo $visi; ?>>
    <div class="card">
      <div class="card-header">Enter Products Details</div>
      <div class="card-body">
          
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
      <table class="table table-bordered table-hover" id="tab_logic">
        <thead>
          <tr>
            <th class="text-center"> # </th>
            <th class="text-center"> Product </th>
            <th class="text-center"> Qty </th>
          </tr>
        </thead>
        <tbody>
          <tr id='addr0'>
            <td>1</td>
            
            <td>
              <select class="selectpicker form-control" data-show-subtext="true" data-live-search="true" name="product[]" onchange="jsfunction()" required>
       <option value="">Select Product</option>
       
       <?php 
       
       $getlistquery = "SELECT DISTINCT `product_id` FROM `new_billing_list` WHERE `billing_recipt_id` = '".$rit."' and `product_pending_quantitis` != 0";
       
       $result = mysqli_query($conn, $getlistquery);
       
       while($trow = mysqli_fetch_array($result, MYSQLI_ASSOC))
       {
       $queryrt = "SELECT * FROM `product_table` WHERE `product_id` = '".$trow['product_id']."'"; 
       $resultrt = mysqli_query($conn, $queryrt);
       
        $row = mysqli_fetch_array($resultrt, MYSQLI_ASSOC);
        
       ?>
       
        <option value="<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></option>
       
       <?php
    
    
    }
       ?>
      </select>
      
    
            </td>
            
            <td><input required type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
          </tr>
          <tr id='addr1'></tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-12">
      <input type="button" id="add_row" class="pull-left btn btn-primary" value="Add Row"></input>
      <input type="button" id='delete_row' class="btn btn-primary" value="Delete Row"></input>
    </div>
  </div>
  <div class="row clearfix" style="margin-top:20px">
    <div class="pull-right col-md-4">
     
    </div>
  </div>
</div>
      
      
      
        
  <input type="hidden" name="productids" id="pid"/>
  <input type="hidden" name="productquantityt" id="pquantityt"/>
          <input type="button" value="Add Product" onClick="submitdata()" class="btn btn-primary btn-block" />  
      </div>
    </div>
  </div>
  
  
</form>

 
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

<script>

    
        
    function submitdata()
    {
        
        var chk4 = $('#inputPassword1').val();
        var chk5 = $('#inputVehicle').val();
        
        if(chk4 == "")
        {
            
            $("#inputPassword1").focus();
            alert("Enter Valid Contact Number");
        }
        else if(chk5 == "")
        {
            $('#inputVehicle').focus();
            alert("Enter Valid Vehicle Number");
        }
        else{
        
        var rowCount = $('#tab_logic tbody tr').length;
        var k = +rowCount-1;
        var j;

var submit = false;

var product = [];
var productquantityarr = [];

       for(j = 0; j < k; j++){
    
            var productid = $('#addr'+j).find('.selectpicker').val();
            var productquantity = $('#addr'+j).find('.qty').val();
            
            if(productid == "" || productquantity == "")
            {
                alert("Please Fill Proper Product Details");
                submit = true;
            }
            else{
                product.push(productid);
                productquantityarr.push(productquantity);
            }
            
            
        }
        
        if(submit)
            {
                
            }
            else{

            var productid = $('#pid').val(product);
            var productquantity = $('#pquantityt').val(productquantityarr);
            

    setTimeout(function () {
  
                $("#formid").submit();                
  
   }, 1000);
  
            }



            
        }
        
        
    }


    $(document).ready(function(){
    var i=1;
    
    var t = document.getElementById('addr'+i);
    
    $("#add_row").click(function(){
        b=i-1;
        
      	$('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
      	$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
        i++; 
  	});
  	
    $("#delete_row").click(function(){
    	if(i>1){
		$("#addr"+(i-1)).html('');
		i--;
		}
		jsfunction();
		//calc();
	});

	$('#tab_logic tbody').on('keyup change',function(){
		//calc();
	});
	$('#tax').on('keyup change',function(){
		//calc_total();
	});
	

});



function jsfunction()
{

var prices = [];
            

var rowCount = $('#tab_logic tbody tr').length;
var k = +rowCount-1;
var j;


   for(j = 0; j < k; j++){
    var productid = $('#addr'+j).find('.selectpicker').val();
    jQuery.ajax({
        url: 'getproprice.php?proid='+productid,
        type: 'get',
        success:function(data)
        {
            prices.push(data);

        } 
     });
    
   }
    
    setTimeout(function () {
   
   
    var j;


   for(j = 0; j < prices.length; j++){
//	$('#addr'+j).find('.price').val(prices[j]);
   }
   }, 1000);
     
}


</script>

</html>



          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <?php include('footer.php'); ?>