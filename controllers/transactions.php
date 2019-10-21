<?php
locked();
//include_once('models/transactions.php');
error_reporting(E_ERROR | E_PARSE);
//show users list
if (!isset($_GET['transactionid']) && !isset($_GET['del']) && !isset($_GET['add'])) {
    $countPerPage = 20;
    //$totalResultCount = count_users($conn);

    // The ceil function will round floats up.
    $numberOfPages = ceil($totalResultCount / $countPerPage);

    // Check if we have a page number in the _GET parameters
    if (!empty($_GET) && isset($_GET['page'])) {
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    // Check that the page is within our bounds
    if ($page < 0) {
        $page = 1;
    } elseif ($page > $numberOfPages) {
        $page = $numberOfPages;
    }

    //$users = get_users_paging($conn, $page, $countPerPage);
    include('views/view_transactions.php');
} elseif (isset($_GET['transactionid'])) {
    //if form is submitted.

    //$_GET['transactionid'] = array("transactionId" => $_GET['transactionid']);


    // get user record informaation.
    //$user = get_user($conn, $_GET['edit']);
    include('views/view_transactionDetails.php');
}
