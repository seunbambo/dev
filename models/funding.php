<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
include('submit.php');
if (isset($_POST['clear'])) {
    $_SESSION['fundingstart'] = "";
    $_SESSION['fundingend'] = "";
}

if (isset($_POST['search'])) {
    $_GET['fundingstart'] = $_POST['fundingstart'];
    $_GET['fundingend'] = $_POST['fundingend'];
    $_SESSION['fundingstart'] = $_GET['fundingstart'];
    $_SESSION['fundingend'] = $_GET['fundingend'];
}

//******************************* Transaction History API ****************************

$service_url = 'http://api.nownowpay.ng/mfs-transaction-management/transactionManagement/history';
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
        "count"     => $_GET['count'],
        "entityId"  => $_SESSION['entityId'],
        "offSet"    => $_GET['offset'],
        "serviceId" => 601,
        "fromDate"  =>  $_SESSION['fundingstart'],
        "toDate"    =>  $_SESSION['fundingend']
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

$result = count($transactions);
//echo $resu."<br>";
$transactionId = $transaction_details->transactionId;
$_SESSION['transactionId'] = $transactionId;
