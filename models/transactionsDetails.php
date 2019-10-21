<?php
session_start();
//include('submit.php');
include('transactions.php');

if (isset($_GET['transactionid'])) {
    $transId = $_GET['transactionid'];
}


//Transaction History API
$service_url = 'http://api.nownowpay.ng/mfs-transaction-management/transactionManagement/status';
//$service_url = 'http://apidev.nownowpay.com.ng/mfs-transaction-management/transactionManagement/status';
$curl_trans = curl_init($service_url);
$curl_trans_data = array(
    "mfsCommonServiceRequest" => array(
        "mfsSourceInfo" => array(
            "channelId" => 23,
            "surroundSystem" => 1
        ),
        "mfsTransactionInfo" => array(
            "requestId" => 84472200611,
            "serviceType" => "0",
            "timestamp" => 90865445666665

        )
    ),
    "mfsRequestInfo" => array(
        "transactionId" => $transId
    )
);


$curl_trans_data = json_encode($curl_trans_data);
curl_setopt($curl_trans, CURLOPT_URL, $service_url);
curl_setopt($curl_trans, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_trans, CURLOPT_POST, true);
curl_setopt($curl_trans, CURLOPT_POSTFIELDS, $curl_trans_data);
curl_setopt($curl_trans, CURLOPT_HTTPHEADER, $header);


$curl_response = curl_exec($curl_trans);
//print_r($curl_response);
$output = preg_split('/(\r?\n){2}/', $curl_response, 2);

$res = count($output);
//echo $res."<br>";
$i = 0;
$transactions = json_decode($output[0])->mfsResponseInfo->transactionCommissionAmount;
$mfsResponseInfo = json_decode($output[0])->mfsResponseInfo;
$mfsOptionalInfo = json_decode($output[0])->mfsOptionalInfo;
$count = $transact_bank = count(json_decode($output[0])->mfsOptionalInfo->info);
for ($i = 0; $i < $count; $i++) {
    $trans_details = json_decode($output[0])->mfsOptionalInfo->info[$i]->key;
    if ($trans_details === "bankName") {
        $bankName = json_decode($output[0])->mfsOptionalInfo->info[$i]->value;
    }
    if ($trans_details === "beneficiaryAccountNumber") {
        $beneficiaryAccountNumber = json_decode($output[0])->mfsOptionalInfo->info[$i]->value;
    }
    if ($trans_details === "Principal_Agent_Name") {
        $principalAgentName = json_decode($output[0])->mfsOptionalInfo->info[$i]->value;
    }
    if ($trans_details === "Agent_Id") {
        $agentId = json_decode($output[0])->mfsOptionalInfo->info[$i]->value;
    }
    if ($trans_details === "txn name") {
        $txnName = json_decode($output[0])->mfsOptionalInfo->info[$i]->value;
    }
    if ($trans_details === "beneficiaryAccountName") {
        $beneficiaryAccountName = json_decode($output[0])->mfsOptionalInfo->info[$i]->value;
    }
    if ($trans_details === "sessionID") {
        $sessionID = json_decode($output[0])->mfsOptionalInfo->info[$i]->value;
    }
    if ($trans_details === "serviceName") {
        $serviceName = json_decode($output[0])->mfsOptionalInfo->info[$i]->value;
    }
    if ($trans_details === "coustomerRefNumber") {
        $coustomerRefNumber = json_decode($output[0])->mfsOptionalInfo->info[$i]->value;
    }
}

curl_close($curl_trans);
