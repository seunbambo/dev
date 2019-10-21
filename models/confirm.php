<?php

include '../restapi/readapi.php';
$email = $_GET["email"];

if (isset($_GET["email"]) && isset($_GET["token"]) || !isset($_POST['password'])) {

    global $email;
    $email = $_GET["email"];
    $token = $_GET["token"];


    //$data = $conn->query("SELECT user_id FROM users WHERE user_email = '$email' AND token = '$token'");


    //error_reporting(0);
    //$password1 = $_POST['password'];
    if (isset($_POST['password']) && isset($_POST['confirmpassword'])) {

        if ($_POST['password'] == $_POST['confirmpassword']) {
            $str = "0123456789qwertzdlgkgja";
            $str = str_shuffle($str);
            $str = substr($str, 0, 15);
            $url = "http://localhost/restapi/resetpassword.php?password=true&email=$email";

            $password = md5($_POST['password']);
            include '../restapi/api.php';
            echo '<div class="alert alert-success alert-dismissible fade show">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Password changed successfully!
            </div>';
            header("Location: index.php");
        } else {

            echo '<div class="alert alert-danger alert-dismissible fade show">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Password does not match!
            </div>';
        }
    }
} else {
    header("Location: index.php");
    exit();
}
