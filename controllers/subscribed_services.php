<?php
locked();
//include_once('models/transactions.php');
error_reporting(E_ERROR | E_PARSE);
//show users list
if (!isset($_GET['edit']) && !isset($_GET['del']) && !isset($_GET['add'])) {

    include('views/view_subscribedservices.php');
} elseif (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    //if form is submitted.

    $_GET['edit'] = array("transactionId" => $_GET['edit']);


    // get user record information.
    //$user = get_user($conn, $_GET['edit']);
    include('views/view_transactiondetails.php');
}
