<?php

require_once "Mail.php";

$page = $_POST['page'];
$mailid = $_POST['to'];


$from = "Choudhary ScaffOlding <choudharyscaffolding@yahoo.com>";
$to = $mailid;
$subject = "Bill Recipt";
$body = $page;

$host = "ssl://smtp.gmail.com";
$username = "mulaniimran27@gmail.com";
$password = "Imrano18#";

$headers = array ('MIME-Version' => '1.0rn',
                    'Content-Type' => "text/html; charset=ISO-8859-1rn",
                    'From' => $from,
                    'To' => $to,
                    'Subject' => $subject);
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