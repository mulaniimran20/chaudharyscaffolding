
   
<?php
session_start();
include('dbcon.php');
 include('header.php');
 
 $type = $_REQUEST['type'];
 
 ?>
 <html>
     <head>
          <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
         </head>
     <body>
 <div id="content-wrapper">

      <div class="container-fluid">
          
           <div class="card mb-3">
          <div class="card-header">
               <div class="page-header">
                   <button type="button" class="btn btn-info btn-lg" style="text-align: center; margin: 20px;  margin-left: 35%; size: 30px;">
             Uploade File
              </button>
              </div>
               <form action="uploadm.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="userid" value="<?php echo $_REQUEST['userid'];?>" />
 <input id="fileUpload" class="btn btn-info btn-lg" name="fileUpload" multiple="" type="file" style="text-align: center; margin: 20px;  margin-left: 20%;" />
 
<input type="hidden" name="sel1" value="<?php echo $type; ?>" />            

        <!--    <select class="form-control" id="sel1" name="sel1" REQUIRED>-->
        <!--<option value=""  selected>select option</option>-->
        <!--<option value="1">return challaen</option>-->
        <!--<option value="2">delivery challaen</option>-->
        <!--    </select>-->
            
            <br>
  <div class="card-body" style="margin-left:40%;">
     
      
<img src="" id="profile-img-tag" width="200px" />

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#fileUpload").change(function(){
        readURL(this);
    });
    
    
</script>
<br>

<input type="submit" value="Upload Image" id="submit" name="submit" style="text-align: center; margin: 20px; margin-left:4%; " >
 </form>
 

</div>
 </div>
 </div>
 </div>
 </body>
 </html>
 <?php include('footer.php'); ?>





