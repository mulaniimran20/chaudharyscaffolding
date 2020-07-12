
 <?php
 
 include('dbcon.php');
 
 
 
 $uri = $_SERVER['REQUEST_URI'];
$uri; // Outputs: URI
 
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
 
$url = $protocol . $_SERVER['HTTP_HOST'];
$url = $url."/"; // Outputs: Full URL
 
 
 
 
 
 
 $target_dir = "return_challans/";
 $fnamet = time();
 $pretarget_file =basename($_FILES["fileUpload"]["name"]);
 
 
 
 $userid = $_REQUEST['userid'];
 $option = $_REQUEST['sel1'];
 
 
 $imageFileType = strtolower(pathinfo($pretarget_file,PATHINFO_EXTENSION));
$target_file = $target_dir . $fnamet.".".$imageFileType ;
$posttarget_file = $fnamet. $imageFileType ;
$uploadOk = 1;

$uplodafilename = $url.$target_file;

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
        echo "The file ". $posttarget_file . " has been uploaded.";
        
        $query = "INSERT INTO `return_challan_data`(`file_path`, `file_user_id`, `file_type`) VALUES ('".$uplodafilename."','".$userid."','".$option."')";
        $rsult = mysqli_query($conn, $query);
        
        if($rsult)
        {
            header("Location: user_history.php");
        }
        
        
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
 