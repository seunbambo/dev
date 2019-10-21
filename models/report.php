<?php
session_start();
//include('../models/submit.php');

//Transaction History API
$service_url = 'http://apidev.nownowpay.com.ng/mfs-transaction-management/transactionManagement/status';
$curl = curl_init($service_url);
$curl_post_data = array(
    "mfsCommonServiceRequest" => array(
        "mfsAssistedTransaction" => array(),
        "mfsSourceInfo" => array(
            "channelId" => "23",
            "surroundSystem" => "1"
        ),
        "mfsTransactionInfo" => array(
            "requestId" => "84472200611",
            "serviceType" => "0",
            "timestamp" => "90865445666665"

        )
    ),
    "mfsRequestInfo" => array(
        "transactionId" => "549883196918"
    )
);


$curl_post_data = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_URL, $service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Authorization:Bearer a6289e9f-1262-479b-9bad-5610fc662b2f',
    'Content-Type:application/json'
));


$curl_response = curl_exec($curl);
print_r($curl_response) . "<br><br>";
$output = preg_split('/(\r?\n){2}/', $curl_response, 2);

$res = count($output);
//echo $res."<br>";
$i = 0;
$transactions = json_decode($output[0])->mfsCommonServiceResponse->mfsStatusInfo->status;
//$resu = count($transactions);
//echo $resu."<br>";
//$transactionId = $transactions->transactionStatus;
$_SESSION['transactionId'] = $transactions;
echo "TRANS " . $_SESSION['transactionId'];
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



