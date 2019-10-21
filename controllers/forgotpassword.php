<?php
//locked();
//include_once('models/forgotpassword.php');
//error_reporting(E_ERROR | E_PARSE);

//show users list
if (!isset($_GET['edit']) && !isset($_GET['del']) && !isset($_GET['add']) && !isset($_GET['confirm_password'])) {


    include('views/forgotpassword.php');
}
