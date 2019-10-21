<?php



$email = $_GET["email"];
$str = "0123456789qwertzdlgkgja";
$str = str_shuffle($str);
$str = substr($str, 0, 15);

if ($_GET["msisdn"] && $_GET["token"]) {

    global $email;
    $email = $_GET["email"];
    $token = $_GET["token"];
    $password = $_POST['newpassword'];

    if (isset($_POST['currentpassword']) && (isset($_POST['newpassword']) == isset($_POST['confirmpassword']))) {


        if ($_POST['newpassword'] != $_POST['confirmpassword']) {
            print_r('<div class="alert alert-danger alert-dismissible fade show">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Password/confirm password does not match!
            </div>');
        }
        if (($status != true) && ($_POST['newpassword'] == $_POST['confirmpassword'])) {
            include 'changePassword.php';
            print_r('<div class="alert alert-danger alert-dismissible fade show">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                ' . $message->message . '
            </div>');
        }
        if ($status == true && ($_POST['newpassword'] == $_POST['confirmpassword'])) {
            include 'changePassword.php';
            print_r('<div class="alert alert-success alert-dismissible fade show">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                ' . $message->status . '
            </div>');
            header("Location: index.php");
            exit();
        }
    }
}
