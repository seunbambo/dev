<?php
require_once "Mail.php";

$from = 'software@cg-infotech.com'; //change this to your email address
$to = 'neeraj.panwar@cg-infotech.com'; // change to address
$subject = 'makeifly'; // subject of mail
$body = "Hello world! this is the content of the email"; //content of mail

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'software@cg-infotech.com', //your gmail account
        'password' => 'CG!L1234!@#$' // your password
    ));

// Send the mail
$mail = $smtp->send($to, $headers, $body);

//check mail sent or not
if (PEAR::isError($mail)) {
    echo '<p>'.$mail->getMessage().'</p>';
} else {
    echo '<p>Message successfully sent!</p>';
}
?>