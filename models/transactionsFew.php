<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
include('submit.php');

//****************************** Transaction History API ******************************


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
        "count" => 3,
        "entityId" => $_SESSION['entityId'],
        "walletType" => "1"
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

$transact = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[0];
$transaction_details = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[$i];
$rowcount = json_decode($output[0])->mfsResponseInfo->rowCount;

global $result;
$result = count($transactions);
$count = json_decode($output[0])->count;
//echo $resu."<br>";
//print_r($transactions);
$transactionId = $transaction_details->transactionId;
$_SESSION['transactionId'] = $transactionId;
