<?php
session_start();
include('submit.php');

//Transaction History API
$service_url = 'http://apidev.nownowpay.com.ng/mfs-transaction-management/transactionManagement/history';
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
        "count" => 4,
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
//echo "ROOOOOOOOOOOOOOOOOOOOOW: ";
//print_r($rowcount);
global $resu;
$resu = count($transactions);
//echo $resu."<br>";
$transactionId = $transaction_details->transactionId;
$_SESSION['transactionId'] = $transactionId;
//echo "TRANS ".$_SESSION['transactionId'];
//curl_close($curl);

//echo $_SESSION['entityId'];


/*
if ($status == 'Success') {
            echo "<br>  Successful";
    header("Location: http://localhost/nownow/index.php?controller=dashboard");
} else {
    echo "Failed";
}
 */
