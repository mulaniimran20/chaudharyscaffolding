<?php

session_start();

include('dbcon.php');

$adminid = $_SESSION['adminsessionid'];

$username = $_POST['productname'];
$emailid = $_POST['productstock'];
$sitename = $_POST['site_name'];
$rcno = $_POST['dcno'];
$challandate = $_POST['datedd'];
$address = $_POST['address'];
$contactname = $_POST['contactname'];
$contactno = $_POST['productprice'];
$vehicleno = $_POST['vehicleno'];
$supervisor = $_POST['supervisor'];

$userid = $_POST['userid'];

$dataquery = "SELECT * FROM `new_billing_list` WHERE `user_id` = '".$userid."' and `billing_from_shop_id` = '".$adminid."'";
$result = mysqli_query($conn, $dataquery);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$billid = $row['billing_recipt_id'];





$selectadminquery = "SELECT * FROM `admin_details` WHERE `admin_id` = '".$adminid."'";
$resultadmin = mysqli_query($conn, $selectadminquery);
$rowa = mysqli_fetch_array($resultadmin, MYSQLI_ASSOC);


$selectquery1 = "SELECT DISTINCT `product_id` FROM `new_billing_list` WHERE `billing_recipt_id` = '".$billid."'";


?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delivery Challan</title>
    <script src="http://thegoviddo.tech/1/garage/js/jquery-2.1.1.min.js" ></script>
 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 20px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
        background-color:#ffffff;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 5px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 40px;
        line-height: 40px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 5px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
        text-align: left;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    
    
    @media print {
    .footer,
    #non-printable {
        display: none !important;
    }
    #printable {
        display: block;
    }
}
    
    @page { size: auto;  margin: 15mm; }
    
    </style>
</head>

<body>
    <div>
        <center><button onclick="downloadclick()" id="downloadbtn">Download</button></center>
    </div>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?php echo $rowa['admin_shop_logo'];?>" style="width:100%; max-width:250px;">
                            </td>
                            
                            <td>
                                <?php echo "<h2 style='color:#DA70D6'>".$rowa['admin_shop_name']."</h2><p style='font-size:12px;'>".$rowa['admin_shop_address']."<br>Email: ".$rowa['admin_email_id']." Mo.No. ".$rowa['admin_contact_no']."</p>"; ?>
                            </td>
                            
                            
                        </tr>
                    </table>
                </td>
            </tr>
        
        
        <tr class="heading">
                <td colspan="5">
                    <h3><center>Return Challan</center></h3>
                </td>
                
                <td>
                    
                </td>
            </tr>
            
        
            <tr class="information">
                <td colspan="5">
                    <table>
                        <tr>
                            <td>
                            
                            </td>
                            
                            <td>
                                <?php echo "<b>R.C No. : ".$rcno."</b><br>";?>
                                <?php echo "<b>Date:-".$challandate."</b>";?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        
    
    

        
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <b>To:<br>
                                M/S. <?php echo $username;?><br>
                                Ship To:- <?php echo $sitename." ".$address;?>
                                </b>
                            </td>
                            
                            <td>
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td colspan="4">
                    Kind Attn:-  <?php echo $contactname." ".$contactno;?>
                </td>
                
                <td>
                    
                </td>
            </tr>
            
            <tr class="heading">
                <td style="text-align:left;">
                    Sr.No
                </td>
                
                <td style="text-align:left;">
                    Particulars
                </td>
                <td style="text-align:left;">
                    Unit
                </td>
                <!--<td style="text-align:left;">
                    Qty
                </td>-->
                 <td style="text-align:left;">
                    R. Qty
                </td>
                <td style="text-align:left;">
                    Remark
                </td>
            </tr>
            
            
<?php
            
            $rrss = mysqli_query($conn, $selectquery1);
            $i = 0;
            $totalquantity = 0;
            while($rrww = mysqli_fetch_array($rrss))
            {
            
            $selectquery = "SELECT * FROM `new_billing_list` WHERE `billing_recipt_id` = '".$billid."' and `product_id` = '".$rrww['product_id']."'";
            
            $result = mysqli_query($conn, $selectquery);
            $i = $i + 1;
            
            $dispquant = 0;
            
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
            
            $dispquant = $dispquant + $row['product_pending_quantitis'];
            
            $totalquantity = $totalquantity + $row['product_pending_quantitis'];
            
            
            }
            
            $getprodetailsquery = "SELECT * FROM `product_table` WHERE `product_id` = '".$rrww['product_id']."'";
            $resultpro = mysqli_query($conn, $getprodetailsquery);
            $rowpro = mysqli_fetch_array($resultpro, MYSQLI_ASSOC);
            
            
            ?>
            
            <tr class="item">
                <td>
                    <?php echo $i; ?>
                </td>
                <td>
                    <?php echo $rowpro['product_name']; ?>
                </td>
                <td>
                    Nos
                </td>
                <!--<td>
                    <?php echo $dispquant; ?>
                </td>-->
                <td>
                    
                </td>
                <td>
                    
                </td>
            </tr>
            <?php
            }
            ?>
            
            <tr class="total">
                <td></td>
                
                <td>
                   Total: 
                </td>
                <td>
                    
                </td>
               <!-- <td>
                    <?php echo $totalquantity; ?>
                </td>-->
                <td>
                    
                </td>
            </tr>
            
            <tr class="heading">
                <td colspan="5">
                    Note:- This Material only on Returnable basis, Not for sale
                </td>
            </tr>
            
         <tr class="total">
                <td colspan="5">
                    &nbsp;
                </td>
            </tr>
     
         <tr class="heading">
                <td colspan="5">
                    Vehicle No: <?php echo $vehicleno; ?>
                </td>
            </tr>
            
            
             <tr class="heading">
                <td colspan="3">
                    For Choudhary Scaffolding Contractor
                </td>
                <td colspan="2">
                    Receiver Signed & Stamped
                </td>
            </tr>
            
            <tr class="total">
                <td colspan="5">
                    &nbsp;
                </td>
            </tr>
            <tr class="total">
                <td colspan="5">
                    &nbsp;
                </td>
            </tr>
            <tr class="total">
                <td colspan="5">
                    &nbsp;
                </td>
            </tr>
            
            
            
            <tr class="heading">
                <td>
                    
                </td>
                <td >
                    <?php echo $supervisor; ?>
                </td>
                <td colspan="2">
                </td>
                <td>
                    
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Authorised sign
                </td>
                <td >
                    Supervisor sign
                </td>
                <td colspan="2">
                </td>
                <td>
                    Receiver sign
                </td>
            </tr>
            
            
            
            
        
        
        
        
        </table>
    </div>
</body>


<script>
        function downloadclick()
        {
            
        
         var billid = <?php echo $billid; ?>;
    const filename  = 'DeliveryChalan_'+billid+'.pdf';

	
		let pdf = new jsPDF('p', 'mm', 'a4');
		 var options = {};
		
		pdf.addHTML($(".invoice-box"), 5, 15, options, function() {
         //pdf.save(filename);
		});
         
         $('#downloadbtn').toggle();
         document.title = ".";
         window.print();
         
         
           
            
    
        }
    </script>
    


<script>

$(document).ready(function(){
    setTimeout(function() { demoSave(); }, 1000);
    
});


function demoSave()
{
    var billid = <?php echo $billid; ?>;
    const filename  = 'DeliveryChalan_'+billid+'.pdf';

	/*	html2canvas(document.querySelector('.invoice-box')).then(canvas => {
			let pdf = new jsPDF('p', 'mm', 'a4');
			pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
			pdf.save(filename);
		});
	*/
		let pdf = new jsPDF('p', 'mm', 'a4');
		 var options = {};
		
		pdf.addHTML($(".invoice-box"), 5, 15, options, function() {
         //pdf.save(filename);
    
    var blob = pdf.output('blob');

            var formData = new FormData();
            formData.append('pdf', blob);
            formData.append('billid', billid);
            formData.append('name', 'DeliveryChallan')

            $.ajax('upload.php',
            {
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data){
                    
                   // alert(data);
                    
                   // $('#cover-spin').hide();
                   //location.replace("user_history.php");
                    
                },
                error: function(data){console.log(data)}
            });
    
    
  });
  
    
    
    //window.print();
    //window.location = "user_history.php";
}
</script>

</html>
