<?php

/*$page = $_POST['page'];
$mailid = $_POST['to'];

$to = $mailid;

$subject = 'Bill Recipt';

$headers = "From: choudharyscaffolding@yahoo.com\r\n";
$headers .= "Reply-To: choudharyscaffolding@yahoo.com\r\n";
$headers .= "CC: choudharyscaffolding@yahoo.com\r\n";
$headers .= "BCC: mulaniimran27@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";



$s = mail($to, $subject, $page, $headers);

if($s)
{
    echo "Successfully Send";
}
*/


require_once "Mail.php";

$page = $_POST['page'];
$mailid = $_POST['to'];

$ccemail = $_POST['ccemail'];

$from = "Choudhary ScaffOlding <choudharyscaffolding@yahoo.com>";
$to = $mailid;
$subject = "Bill Recipt";
$body = $page;

$host = "ssl://smtp.gmail.com";
$username = "mulaniimran27@gmail.com";
$password = "Imrano18#";

$cc = $ccemail;

$to = $to.",".$cc;

$headers = array ('MIME-Version' => '1.0rn',
                    'Content-Type' => "text/html; charset=ISO-8859-1rn",
                    'From' => $from,
                    'To' => $to,
                    'Subject' => $subject,
                    'Cc' => $cc);
$smtp = Mail::factory('smtp',
  array ('host' => $host,
    'port' => '465',
    'auth' => true,
    'username' => $username,
    'password' => $password));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
} else {
  echo("<p>Message successfully sent!</p>");
}

?>



?>