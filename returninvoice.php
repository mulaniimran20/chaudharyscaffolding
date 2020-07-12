<?php

include('dbcon.php');

$billid = $_REQUEST['reciptid'];

$selectquery = "SELECT * FROM `new_billing_list` WHERE `billing_recipt_id` = '".$billid."'";

$getuserdetails = "SELECT * FROM `new_billing_list` WHERE `billing_recipt_id` = '".$billid."'";

$result1 = mysqli_query($conn, $getuserdetails);
$row = mysqli_fetch_array($result1, MYSQLI_ASSOC);

$userid = $row['user_id'];
$adminid = $row['billing_from_shop_id'];

$vno = $row['return_vehicle_no'];

$selectuserquery = "SELECT * FROM `user_list` WHERE `user_id` = '".$userid."'";
$resultuser = mysqli_query($conn, $selectuserquery);
$rowu = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);

$selectadminquery = "SELECT * FROM `admin_details` WHERE `admin_id` = '".$adminid."'";
$resultadmin = mysqli_query($conn, $selectadminquery);
$rowa = mysqli_fetch_array($resultadmin, MYSQLI_ASSOC);

?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Return Material Challan</title>
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
    
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6">
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
        
            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td>
                            
                            </td>
                            
                            <td>
                                <?php echo "<b>Work Order No:-".$billid."</b><br>";?>
                                <?php echo "<b>Work order Date:-".$row['billing_date']."</b><br>";?>
                                <?php echo "<b>D.C No. : CSC/18-19/AJ 101/941</b><br>";?>
                                <?php echo "<b>Date:-".date('d/m/Y', time())."</b>";?>
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
                                M/S. <br>
                                Ship To:-
                                </b>
                            </td>
                            
                            <td>
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td colspan="5">
                    Kind Attn:-  <?php echo $rowu['user_name']." ".$rowu['user_contact_no'];?>
                </td>
                
                <td>
                    
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Sr.No
                </td>
                
                <td>
                    Particulars
                </td>
                <td>
                    Unit
                </td>
                <td>
                    D. Qty
                </td>
                <td>
                    R. Qty
                </td>
                <td>
                    Remark
                </td>
            </tr>
            
            
<?php
            
            $result = mysqli_query($conn, $selectquery);
            $i = 0;
            
            $totalquantity = 0;
            
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
            $i = $i + 1;
            
            $totalquantity = $totalquantity + $row['product_quantity'];
            
            $getprodetailsquery = "SELECT * FROM `product_table` WHERE `product_id` = '".$row['product_id']."'";
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
                <td>
                    <?php echo $row['product_quantity']; ?>
                </td>
                <td>
                    <?php echo $row['product_quantity'] - $row['product_pending_quantitis']; ?>
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
                
                <td>
                    <?php echo $totalquantity; ?>
                </td>
                <td>
                    
                </td>
                <td>
                    
                </td>
            </tr>
            
            <tr class="heading">
                <td colspan="6">
                    Note:- This Material only on Returnable basis, Not for sale
                </td>
            </tr>
            
         <tr class="total">
                <td colspan="6">
                    &nbsp;
                </td>
            </tr>
            
         <tr class="heading">
                <td colspan="6">
                    Vehicle No: <?php echo $vno; ?>
                </td>
            </tr>
            
            
             <tr class="heading">
                <td colspan="3">
                    For Choudhary Scaffolding Contractor
                </td>
                <td colspan="3">
                    Receiver Signed & Stamped
                </td>
            </tr>
            
            <tr class="total">
                <td colspan="6">
                    &nbsp;
                </td>
            </tr>
            <tr class="total">
                <td colspan="6">
                    &nbsp;
                </td>
            </tr>
            <tr class="total">
                <td colspan="6">
                    &nbsp;
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Authorised sign
                </td>
                <td>
                    Supervisor sign
                </td>
                <td colspan="2">
                    Security sign
                </td>
                <td colspan="2">
                    Receiver sign
                </td>
            </tr>
            
            
            
            
        
        
        
        
        </table>
    </div>
</body>


<script>

$(document).ready(function(){
    setTimeout(function() { demoSave(); }, 2000);
    
});


function demoSave()
{
    
    var billid = <?php echo $billid; ?>;
    const filename  = 'ReturnChalan_'+billid+'.pdf';

	/*	html2canvas(document.querySelector('.invoice-box')).then(canvas => {
			let pdf = new jsPDF('p', 'mm', 'a4');
			pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
			pdf.save(filename);
		});
	*/
		let pdf = new jsPDF('p', 'mm', 'a4');
		 var options = {};
		
		pdf.addHTML($(".invoice-box"), 5, 15, options, function() {
         pdf.save(filename);
    
    var blob = pdf.output('blob');

            var formData = new FormData();
            formData.append('pdf', blob);
            formData.append('billid', billid);
            formData.append('name', 'ReturnChallan')

            $.ajax('upload.php',
            {
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data){
                    
                   // alert(data);
                    
                   // $('#cover-spin').hide();
                   location.replace("user_history.php");
                    
                },
                error: function(data){console.log(data)}
            });
    
    
  });
   
}
</script>

</html>