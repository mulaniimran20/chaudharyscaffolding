<?php
session_start();
include('dbcon.php');

if(isset($_SESSION['adminsessionid']) && !empty($_SESSION['adminsessionid'])) {
   
}
else{
   header("Location: index.php"); 
}


$reciptid = $_REQUEST['reciptid'];

?>










<?php

include('dbcon.php');

$billid = $_REQUEST['reciptid'];

$selectquery = "SELECT * FROM `new_billing_list` WHERE `billing_recipt_id` = '".$billid."'";

$getuserdetails = "SELECT * FROM `new_billing_list` WHERE `billing_recipt_id` = '".$billid."'";

$result1 = mysqli_query($conn, $getuserdetails);
$row = mysqli_fetch_array($result1, MYSQLI_ASSOC);

$authorised  = $row['authorizer'];
$supervisor  = $row['supervisor'];
$reciver  = $row['reciver'];

if($authorised == "")
{
    $authorised = "&nbsp;";
}

if($supervisor == "")
{
    $supervisor = "&nbsp;";   
}

if($reciver == "")
{
    $reciver = "&nbsp;";   
}




$userid = $row['user_id'];
$adminid = $row['billing_from_shop_id'];

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
    <title>Delivery Challan</title>
    <script src="https://choudharyscaffolding.tech/js/jquery-2.1.1.min.js" ></script>
 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		
		
		<script src="https://choudharyscaffolding.tech/dist/jquery.table2excel.min.js"></script>

    <style>
    .invoice-box {
        max-width: 1200px;
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
    
    .invoice-box table tr.heading th {
        background: #eee;
        border: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border: 1px solid #eee;
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
    
    .first-col {
    position: absolute;
    width: 5em;
}


    
    </style>
</head>



            <?php
                
                $ss = "SELECT DISTINCT `datedd` FROM `new_billing_list` WHERE `billing_recipt_id` = '".$reciptid."'";
                
                $res = mysqli_query($conn, $ss);
                $cols = "";
                $dates = array();
                $dcarray = array();
                while($rr = mysqli_fetch_array($res))
                {
                    $date = explode(" ", $rr['datedd']);

                    
                    if($olddate != $date[0])
                    {
                        
                    $originalDate = $date[0];
                    $newDateMM = date("d-m-Y", strtotime($originalDate));
                   
                    $mr = "SELECT DISTINCT `dcno` FROM `new_billing_list` WHERE `billing_recipt_id`  = '".$reciptid."' and `datedd` = '".$originalDate."'";
                   $qr = mysqli_query($conn, $mr);
                   while($rowqr = mysqli_fetch_array($qr))  
                   {
                   $ms = explode("-", $rowqr['dcno']);
                   $mm = $ms[0]."&rarr;".$ms[1];
                    $cols = $cols."<th><b>".str_replace("-","/",$newDateMM)."<br>".$mm."</th>";
                    array_push($dates,$date[0]);
                    array_push($dcarray, $rowqr['dcno']);
                    
                   }
                    }
                    else{
                        
                    }
                     
                    $olddate = $date[0];
                }
                
                
                
                $ss1 = "SELECT DISTINCT `return_date` FROM `return_data_table` WHERE `return_bill_id` = '".$reciptid."'";
                
                $res1 = mysqli_query($conn, $ss1);
                $cols1 = "";
                $dates1 = array();
                $olddate1 = "";
                 $dcarray1 = array();
               
                while($rr1 = mysqli_fetch_array($res1))
                {
                    $date = explode(" ", $rr1['return_date']);
                   
                    if($olddate1 != $date[0])
                    {
                        
                         $originalDate = $date[0];
                    $newDateMM = date("d-m-Y", strtotime($originalDate));
                   
                    $mr = "SELECT DISTINCT `rc_challan_no` FROM `return_data_table` WHERE `return_bill_id`  = '".$reciptid."' and `return_date` = '".$rr1['return_date']."'";
                   $qr = mysqli_query($conn, $mr);
                   while($rowqr = mysqli_fetch_array($qr))  
                   {
                   $ms = explode("-", $rowqr['rc_challan_no']);
                   $mm = $ms[0]."&rarr;".$ms[1];
                    $cols1 = $cols1."<th><b>".str_replace("-","/",$newDateMM)."<br>".$mm."</th>";
                    array_push($dates1,$date[0]);
                    array_push($dcarray1, $rowqr['rc_challan_no']);
                    
                   }
                        
                        
                    }
                    else{
                        
                    }
                    
                    $olddate1 = $date[0];
                }
                
                
                if(sizeof($dates1) == 0)
                 {
                     $cols1 = "<th></th>";
                 }
                
                $colspancount1 = sizeof($dates);
                $colspancount2 = sizeof($dates1);
                
                if(sizeof($dates1) == 0)
                 {
                     $colspancount2 = 1;
                 }
                
                $maincolspan = $colspancount1 + $colspancount2 + 5;
                
                ?>
               


<body>
    
    
    <div>
        <center>
           <!-- <button onclick="downloadclick()">Download</button>--> 
    <button onclick="exportTableToExcel()">Export Table Data To Excel File</button>
        </center>
    </div>
    <div class="row invoice-box">
    <div class=" table-responsive col-md-12" style="overflow-x:auto;">
        <table cellpadding="0" cellspacing="0" class="table" id="tableexport">
                        <tr class="top" style="height:255px;">
                            <td class="title" colspan="3">
                                <img src="<?php echo $rowa['admin_shop_logo'];?>" style="width:180px; height:150px;">
                            </td>
                            
                            <?php
                            
                            
                            
                            
                            if (strpos($rowa['admin_shop_name'], 'COSTRUCTOR') !== false) {
                                 $bgcolor = "color: #8F5A16 !important;";
                                 $visibiity = "display: none;";
                            }
                            else{
                                $bgcolor = "color: #DA70D6 !important;";
                                $visibiity = "";
                            }
                            
                            ?>
                            
                            
                            <td colspan="<?php echo $maincolspan-3; ?>">
                                <b><?php echo "<h2 style='".$bgcolor."'>".$rowa['admin_shop_name']."</h2><p style='font-size:12px;'>".$rowa['admin_shop_address']."<br>Email: ".$rowa['admin_email_id']." Mo.No. ".$rowa['admin_contact_no']."</p>"; ?></b>
                            </td>
                            
                        </tr>
                    
                
        
            
        
                        <tr class="information" rowspan="3">
                            <td colspan="<?php echo $maincolspan; ?>" style="height:118px;">
                                <b>To:<br>
                                M/S. <?php echo $rowu['user_name'];?><br>
                                Ship To:- <?php echo $rowu['site_name']." ".$rowu['user_address'];?>
                                </b>
                            </td>
                        </tr>
            
            <tr class="heading">
                <td colspan="<?php echo $maincolspan; ?>">
                    <b>Kind Attn:-  <?php echo $rowu['contacct_person']." ".$rowu['user_contact_no'];?></b>
                </td>
                
            </tr>
            
        
        
         
                    <tr class="heading">
                        <th></th>
                        <th></th>
                        <th colspan="<?php echo $colspancount1; ?>"><b>Delivered&nbsp;Material</b></th>
                        <th></th>
                        <th colspan="<?php echo $colspancount2; ?>"><b>Return&nbsp;Material</b></th>
                        <th></th>
                        <th></th>
                    </tr>
                  <tr class="heading">
                    <th><b>id</b></th>
                    <th><b>Product&nbsp;Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;</b></th>
                    <?php echo $cols;?>
                    <th><b>Total</b></th>
                    <?php echo $cols1; ?>
                    <th><b>Total<b></th>
                    <th><b>Bal&nbsp;Qty</b></th>
                  </tr>
            <?php
            $percentfinder = $colspancount1 + $colspancount2 + 5;
            
            ?>
                    
                    <?php
                    
                    $adminid = $_SESSION['adminsessionid'];
                    
                    $reciptid = $reciptid;
                    
                    $selectquery = "SELECT DISTINCT `product_id` FROM `new_billing_list` WHERE `billing_recipt_id` = '".$reciptid."'";
                    
                    $resultc = mysqli_query($conn, $selectquery);
                    $i = 0;
                        
                    while($row = mysqli_fetch_array($resultc, MYSQLI_ASSOC))
                    {
                        $i = $i + 1;
                        $pid = $row['product_id'];
                        
                         $columndata1 = "";
                        $totalmaindispaly = 0;
                        
                        $columndata2 = "";
                        $totalmaindispaly2 = 0;
                        $nm = 0;
                         foreach($dates as $dd)
                        {
                            
                        
                       
                        
                        $q1 = "SELECT * FROM `new_billing_list` WHERE `billing_recipt_id` = '".$reciptid."' and `product_id` = '".$pid."' and `dcno` = '".$dcarray[$nm]."' and `datedd` LIKE '".$dd."%'";
                        $nm = $nm +1;
                        $r1 = mysqli_query($conn, $q1);
                        
                        $totaltakenquantity = 0;
                        $pendingquantity = 0;
                        
                        while($row1 = mysqli_fetch_array($r1, MYSQLI_ASSOC))
                        {
                            $q2 = "SELECT * FROM `product_table` WHERE `product_id` = '".$pid."'";
                            $r2 = mysqli_query($conn, $q2);
                            $row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC);
                            
                            $productname = $row2['product_name'];
                            
                            $totaltakenquantity = $totaltakenquantity + $row1['product_quantity'];
                            $pendingquantity = $pendingquantity + $row1['product_pending_quantitis'];
                            
                            
                        }
                        $columndata1 = $columndata1."<td>".$totaltakenquantity."</td>";
                            
                        $totalmaindispaly = $totalmaindispaly + $totaltakenquantity;
                        
                        }
                 
                 
                 
                 
                         foreach($dates1 as $dd)
                        {
                            
                        
                       
                        
                        $q23 = "SELECT * FROM `return_data_table` WHERE `return_product_id` = '".$pid."' and `return_bill_id` = '".$reciptid."' and `return_date` LIKE '".$dd."%'";
                        $r23 = mysqli_query($conn, $q23);
                        
                        $totaltakenquantity = 0;
                        $pendingquantity = 0;
                        
                        while($row1 = mysqli_fetch_array($r23, MYSQLI_ASSOC))
                        {
                            $q2 = "SELECT * FROM `product_table` WHERE `product_id` = '".$pid."'";
                            $r2 = mysqli_query($conn, $q2);
                            $row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC);
                            
                            $productname = $row2['product_name'];
                            
                            $totaltakenquantity = $totaltakenquantity + $row1['return_count'];
                            
                            
                        }
                        $columndata2 = $columndata2."<td >".$totaltakenquantity."</td>";
                            
                        $totalmaindispaly2 = $totalmaindispaly2 + $totaltakenquantity;
                        
                        }
                 
                 if(sizeof($dates1) == 0)
                 {
                     $columndata2 = "<td ></td>";
                 }
                 
                        $balqty = $totalmaindispaly - $totalmaindispaly2;
                 
                        
                    ?>
                    
                  <tr class="item">
                    <td ><?php echo $i; ?></td>
                    <td ><?php echo $productname; ?></td>
                    <?php echo $columndata1; ?>
                    <td ><?php echo $totalmaindispaly; ?></td>
                    <?php echo $columndata2; ?>
                    <td ><?php echo $totalmaindispaly2; ?></td>
                    <td ><?php echo $balqty; ?></td>
                    
                  </tr>
                  <?php
                    }
                  ?>
            
        
        
        
            
        
            
            <tr class="heading">
                <td colspan="<?php echo $maincolspan; ?>">
                    <b style="<?php echo $visibiity; ?>">Note:- This Material only on Returnable basis, Not for sale</b>
                </td>
            </tr>
            
         <tr class="total">
                <td colspan="<?php echo $maincolspan; ?>">
                    &nbsp;
                </td>
            </tr>
            
            
            
        
        
        
        
        </table>
    </div>
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
         pdf.save(filename);
    
        });
        }
    </script>
    

<script>


$(document).ready(function(){
    setTimeout(function() { demoSave(); }, 1000);

var countsave = <?php echo $percentfinder; ?>;
	
	if(countsave > 12)
	{
	     $( ".invoice-box" ).css( "maxWidth", "2000px" );
	    
	}
	
    
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
	

		let pdf = new jsPDF('p', 'mm', 'tabloid');
		 var options = {};
		
		pdf.addHTML($(".invoice-box"), 5, 15, options, function() {
        // pdf.save(filename);
    
    var blob = pdf.output('blob');

            var formData = new FormData();
            formData.append('pdf', blob);
            formData.append('billid', billid);
            formData.append('name', 'DeliveryChallan')

        
    
  });
  
    
    
    //window.print();
    //window.location = "user_history.php";
}



function exportTableToExcel(){
    
//   $("#tableexport").table2excel({
//     exclude: "",
//     name: "Worksheet Name",
//     filename: "SomeFile", //do not include extension
//     exclude_img: false
// }); 
    
				$("#tableexport").table2excel({
					exclude: "",
					name: "Worksheet Name",
					filename: "myFileName" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
					exclude_img: false
				});

    
}




</script>

</html>
