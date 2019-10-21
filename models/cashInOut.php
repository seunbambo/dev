<?php
error_reporting(E_ERROR | E_PARSE);
//session_start();
//ini_set('session.cache_limiter', 'public');
//session_cache_limiter(false);
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
        //"count" => 10,
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

$res = count($output);
//echo $res."<br>";
$i = 0;
$transactions = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo;
$transaction_details = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[$i];
$rowcount = json_decode($output[0])->mfsResponseInfo->rowCount;
global $result;
$result = count($transactions);
//$count = json_decode($output[0])->count;
//echo $rowcount;
//echo $resu."<br>";
//print_r($transactions);
$date = date("Y-m-d");
for ($i = 0; $i < $result; $i++) {
    $transaction = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[$i];
    $transactionId = $transaction_details->transactionId;

    $transactionDate = $transaction->transactionDate;
    $transactionAmount = $transaction->transactionAmount;
    $transactionStatus = $transaction->transactionStatus;
    //$serviceName = $transaction->serviceName;
    $transactionType = $transaction->transactionType;
    $transactionDate = substr($transactionDate, 0, 10);
    //echo $transactionDate . '<br>';
    $date = date("Y-m-d");
    //$date = date_format(date_create("2019-08-13"), "Y-m-d");
    $outwardCash = "509";
    $service510 = "510";
    $service810 = "810";
    $cashOut = $transactionType;
    $cashIn = $transactionType;
    //$str = '';
    if ($date == $transactionDate && $outwardCash == $cashOut && $transactionStatus == 'SUCCESS') {

        $cashOutServiceArray = array();

        $cashOutServiceAmount .= $transactionAmount . ',';
        $cashOutName .= $transactionType . ',';
        //echo $transactionDate;

        array_push($cashOutServiceArray, $cashOutServiceAmount);
        array_push($cashOutServiceArray, $cashOutName);
    }

    if ($date == $transactionDate && ($service510 == $cashIn || $service810 == $cashIn)  && $transactionStatus == 'SUCCESS') {

        $cashInServiceArray = array();

        $cashInServiceAmount .= $transactionAmount . ',';

        $cashInName .= $transactionType . ',';
        //echo $transactionDate
        array_push($cashInServiceArray, $cashInServiceAmount);
        array_push($cashInServiceArray, $cashInName);
    }
}

$cashOutAmount = explode(',', $cashOutServiceAmount, -1);
$cashInAmount = explode(',', $cashInServiceAmount, -1);
$cashOutService = explode(',', $cashOutName, -1);
$cashInService = explode(',', $cashInName, -1);
