<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
//ini_set('session.cache_limiter', 'public');
//session_cache_limiter(false);
include('submit.php');

if (isset($_POST['clear'])) {
    $_SESSION['from'] = "";
    $_SESSION['to'] = "";
    // $_POST['msisdn'] = "";
    // $_POST['transactionid'] = "";
    $_SESSION['status'] = "";
    $_GET['transactionid'] = $_POST['transactionid'];
    $_SESSION['transactionid'] = $_GET['transactionid'];
}
if (isset($_POST['search'])) {
    $_SESSION['from'] = $_POST['start'];
    $_SESSION['to'] = $_POST['end'];
    $_GET['transactionid'] = $_POST['transactionid'];
    //$_GET['status'] = $_POST['status'];
    $_SESSION['status'] = $_POST['status'];
    $_GET['msisdn'] = $_POST['msisdn'];
    $_SESSION['transactionid'] = $_GET['transactionid'];
}

//****************************** Transaction History API ******************************


$service_url = 'http://api.nownowpay.ng/mfs-transaction-management/transactionManagement/history';
//$service_url = 'http://apidev.nownowpay.com.ng/mfs-transaction-management/transactionManagement/history';
$curl = curl_init($service_url);
$curl_post_data = array(
    "mfsCommonServiceRequest" => array(
        "mfsSourceInfo" => array(
            "channelId" => 23,
            "surroundSystem" => 1
        ),
        "mfsTransactionInfo" => array(
            "requestId" => 3434343234,
            "serviceType" => "0",
            "timestamp" => 1525771577101
        )
    ),
    "mfsRequestInfo" => array(
        "count" => $_GET['count'],
        "entityId" => $_SESSION['entityId'],
        "offSet" => $_GET['offset'],
        "walletType" => "1",
        "fromDate"  =>  $_SESSION['from'],
        "toDate"    =>  $_SESSION['to'],
        "transactionId" => $_SESSION['transactionid'],
        "receiverMsisdn" => $_GET['msisdn'],
        "transactionStatus" => $_SESSION['status']
    )
);


$curl_post_data = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_URL, $service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);


$curl_response = curl_exec($curl);
//print_r($curl_response) . "<br><br>";
$output = preg_split('/(\r?\n){2}/', $curl_response, 2);

$res = count($output);
//echo $res."<br>";
$i = 0;
$transactions = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo;
$transaction_details = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[$i];
$rowcount = json_decode($output[0])->mfsResponseInfo->rowCount;

global $result;
$result = count($transactions);
$count = json_decode($output[0])->count;
//echo $resu."<br>";
//print_r($transactions);
$transactionId = $transaction_details->transactionId;
$_SESSION['transactionId'] = $transactionId;
