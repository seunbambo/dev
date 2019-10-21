<?php

include 'user.php';
require_once "Mail.php";

$actual_link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
//echo $actual_link;

$from = 'software@cg-infotech.com'; //change this to your email address
$to = $email; // change to address

$subject = 'Change Password'; // subject of mail


$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject,
    'MIME-Version' => '1.0',
    'Content-type' => 'text/html; charset=iso-8859-1'
);

$smtp = Mail::factory('smtp', array(
    'host' => 'ssl://smtp.gmail.com',
    'port' => '465',
    'auth' => true,
    'username' => 'software@cg-infotech.com', //your gmail account
    'password' => 'CG!L1234!@#$' // your password
));

if (isset($_POST["forgotPass"])) {

    if ($_POST['msisdn'] == $phone) {

        $str = "0123456789qwertyijhgfsdaklxmc";
        $str = str_shuffle($str);
        $str = substr($str, 0, 10);
        $url = $actual_link . "?controller=confirmpassword&token=$str&msisdn=$phone";
        $message = '<html><body style="color: #666; font-size:0.9rem; font-family: Verdana;">';
        $message .= '<p>Dear Partner,';
        $message .= '<br />';
        $message .= '<p>Kindly click <b><a href="' . $url . '" style="color: #ffa500;">this link</a></b> to change your password or copy the link below to your browser: </p>';
        $message .= $url;
        $message .= '<br /><br /><br />';
        $message .= '<p style="color:#7e287e">NowNow.</p>';
        $message .= '</body></html>';

        // Send the mail
        $mail = $smtp->send($to, $headers, $message);

        print_r('<div class="alert alert-success alert-dismissible fade show">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Please check your email for your password.
        </div>');
    } else {
        print_r('<div class="alert alert-danger alert-dismissible fade show">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Invalid phone number.
        </div>');
    }
}
