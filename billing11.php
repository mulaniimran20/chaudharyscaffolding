<?php
session_start();
if(isset($_SESSION['adminsessionid']) && !empty($_SESSION['adminsessionid'])) {
   
}
else{
   header("Location: index.php"); 
}

include('dbcon.php');

$adminid = $_SESSION['adminsessionid'];

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
<form action="savebill.php" method="post" id="formid">
        
  <div>
    <div class="card">
      <div class="card-header">Enter User Details</div>
      <div class="card-body">
          
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <?php 
                    $selectqq = "SELECT DISTINCT `user_name` FROM `user_list` WHERE `user_register_shop_id` = '".$adminid."'";
                    $resultqq = mysqli_query($conn, $selectqq);
                    
                  ?>
                 <select class="form-control" onchange="selectSiteName()" id="sitename">
                   <option value="">Select Site Name</option>
                   <?php
                   while($rowqq = mysqli_fetch_array($resultqq, MYSQLI_ASSOC))
                   {
                   ?>
                                     <option value="<?php echo $rowqq['user_name']; ?>"><?php echo $rowqq['user_name']; ?></option>
                                     <?php
                   }
                                     ?>
                </select>

                  
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-label-group" id="add_user_list">
                  
                  
                  
                </div>
              </div>
            </div>
          </div>

          <div style="width:100%; height:10px; background:#F7F7F7; margin-bottom:2.5em;" class="border">
              
          </div>
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="firstName" name="productname" class="form-control" placeholder="User Name" required="required" autofocus="autofocus">
                  <label for="firstName">User Name</label>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="email" id="lastName" name="productstock" class="form-control" placeholder="Email ID" required="required">
                  <label for="lastName">Email ID</label>
                </div>
              </div>
            </div>
          </div>
         
         
   
     <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="site_name" id="site_name" class="form-control" placeholder="Site Name" required="required" autocomplete="off" spellcheck="false">
                  <label for="site_name">Site Name</label>
                </div>
            </div>
              
         
         
         
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="workorderno" name="workorderno" class="form-control" placeholder="Work Order Number" required="required" autofocus="autofocus">
                  <label for="workorderno">Work Order No.</label>
                </div>
              </div>
              
              
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="date" id="workorderdate" name="workorderdate" class="form-control" placeholder="Work Order Date" required="required">
                  <label for="workorderdate">Work Order Date</label>
                </div>
              </div>
            </div>
          </div>
         
         
         
         
         
         <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="dcno" name="dcno" class="form-control" placeholder="D.C.No" required="required" autofocus="autofocus">
                  <label for="dcno">D. C. No.</label>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="date" id="datedd" name="datedd" class="form-control" placeholder="Date" required="required">
                  <label for="datedd">Date</label>
                </div>
              </div>
            </div>
          </div>
         
         

         
          
          <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="address" id="inputPassword" class="form-control" placeholder="Address" required="required">
                  <label for="inputPassword">Address</label>
                </div>
            </div>
            
            <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="contactname" id="contactname" class="form-control" placeholder="Contact Name" required="required">
                  <label for="contactname">Contact Person Name</label>
                </div>
            </div>
            
            <div class="form-group">
                <div class="form-label-group">
                  <input type="text" name="productprice" id="inputPassword1" class="form-control" placeholder="Contact Number" required="required">
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
                <div class="form-label-group">
                  <input type="text" name="msg" id="msg" class="form-control" placeholder="Delivery Message" required="required">
                  <label for="msg">Delivery Message</label>
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
                  <input type="hidden" name="receiver" id="receiver" class="form-control" placeholder="Receiver sign" value="">
                </div>
            </div>
       
       
           
            
          </div>
          
      </div>
    </div>
  </div>
  
  
  
    <div class="">
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
       
       $getlistquery = "SELECT * FROM `product_table` WHERE `product_owner_shop_id` = '".$adminid."' and `procut_status` = 1";
       
       $result = mysqli_query($conn, $getlistquery);
    
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        
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
      
      
      
          
      </div>
    </div>
  </div>
  <input type="hidden" name="productids" id="pid"/>
  <input type="hidden" name="productquantityt" id="pquantityt"/>
  
          <input type="button" value="Add Product" onClick="submitdata()" class="btn btn-primary btn-block" />
  
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
        
        var chk1 = $('#firstName').val();
        var chk2 = $('#lastName').val();
        var chk3 = $('#inputPassword').val();
        var chk4 = $('#inputPassword1').val();
        var chk5 = $('#inputVehicle').val();
        
              var chk8 = $('#dcno').val();
              var chk9 = $('#datedd').val();
              
              var chk10 = $('#site_name').val();
        
        if(chk1 == "")
        {
            $("#firstName").focus();
            alert("Enter Valid User Name");
        }
        else if(chk3 == "")
        {
            $("#inputPassword").focus();
            alert("Enter Valid Address");
        }
        else if(chk4 == "")
        {
            $("#inputPassword1").focus();
            alert("Enter Valid Contact Number");
        }
        else if(chk5 == "")
        {
            $('#inputVehicle').focus();
            alert("Enter Valid Vehicle Number");
        }
        else if(chk5 == "")
        {
            $('#workorderdate').focus();
            alert("Enter Valid Work Order Date");
        }
        else if(chk8 == "")
        {
            $('#dcno').focus();
            alert("Enter Valid D. C. No.");
        }
        else if(chk9 == "")
        {
            $('#datedd').focus();
            alert("Enter Valid Date");
        }
        else if(chk10 == "")
        {
            $('#site_name').focus();
            alert("Enter Valid Site Name");
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
      
      
    <script type="text/javascript">

$(document).ready(function(){
        
   /*input type char search result*/
   $(document).on('keyup','#site_name',function(){
 
       var keyVal = $(this).val();
       
       var username = $('#firstName').val();
       
       
       if(username != '' & keyVal != '')
       {
            $.ajax({
                url: "search.php",
                type: "post",
                data: {'username':username, 'site_name':keyVal},
                success: function(d) {
                    
                    if(d.length > 2)
                    {
                        
                        var dataaa = d.split(",");
                        
                        var i;
                        for (i = 0; i < dataaa.length; i++) {
                            var dd = dataaa[i].split(":");
                            if(i == 0)
                            {
                                var contactname = dd[1].replace('"','');
                                $('#contactname').val(contactname.replace('"',''));
                            }
                            else if(i == 1)
                            {
                                var lastname = dd[1].replace('"','');
                                $('#lastName').val(lastname.replace('"',''));
                            }
                            else if(i ==2)
                            {
                                var inputPassword1 = dd[1].replace('"','');
                                $('#inputPassword1').val(inputPassword1.replace('"',''));
                            }
                            else if(i == 3)
                            {
                                var add = dd[1].split("}");
                                var inputPassword = add[0].replace('"','')
                                $('#inputPassword').val(inputPassword.replace('"',''));
                            }
                            
                        }
                        
                    }
                }
            });
            
            
                   
       }
       

});

});


function selectSiteName()
{
    var x = document.getElementById("sitename").value;
    var y = "<?php echo $adminid; ?>";
    
    $.ajax({
                url: "getsitename.php",
                type: "post",
                data: {'username':x, 'adminid':y},
                success: function(d) {
                    $("#add_user_list").html(d);
                }
    });
    
}



function addData()
{
    
    $('#firstName').val(document.getElementById("sitename").value);
    
    var id = document.getElementById("addaddress").value;
    
        $.ajax({
                url: "search1.php",
                type: "post",
                data: {'id':id},
                success: function(d) {
                    
                    if(d.length > 2)
                    {
                        
                        var dataaa = d.split(",");
                        
                        var i;
                        for (i = 0; i < dataaa.length; i++) {
                            var dd = dataaa[i].split(":");
                            if(i == 0)
                            {
                                var contactname = dd[1].replace('"','');
                                $('#contactname').val(contactname.replace('"',''));
                            }
                            else if(i == 1)
                            {
                                var lastname = dd[1].replace('"','');
                                $('#lastName').val(lastname.replace('"',''));
                            }
                            else if(i ==2)
                            {
                                var inputPassword1 = dd[1].replace('"','');
                                $('#inputPassword1').val(inputPassword1.replace('"',''));
                            }
                            else if(i == 4)
                            {
                                var add = dd[1].split("}");
                                var inputPassword = add[0].replace('"','')
                                $('#inputPassword').val(inputPassword.replace('"',''));
                            }
                            else if(i == 3)
                            {
                                var site_name = dd[1].replace('"','');
                                $('#site_name').val(site_name.replace('"',''));
                            }
                            
                        }
                        
                    }
                }
            });
        
}

</script>