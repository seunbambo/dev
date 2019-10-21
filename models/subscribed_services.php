<?php
//session_start();
include('trans.php');

//Transaction History API
$service_url = 'http://nownowpay.ng/admin-panel/partner/enabledServices';
$curl = curl_init($service_url);
$curl_post_data = array(

    'entityId'  => $entityId
);


$curl_post_data = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_URL, $service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json',
    'token:B4BC4BA0A8E1CD8F1DBDEE86AC3CBF31F59C32C25C9162F02EFFA6ED966'
));


$curl_response = curl_exec($curl);
//print_r($curl_response);
curl_close($curl);




$output = preg_split('/(\r?\n){2}/', $curl_response, 2);


$count = json_decode($output[0])->count;

//echo $count;

//print_r($count);
//$transaction_details = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[$i];
//$rowcount = json_decode($output[0])->mfsResponseInfo->rowCount;

//echo $_SESSION['entityId'];


/*
if ($status == 'Success') {
            echo "<br>  Successful";
    header("Location: http://localhost/nownow/index.php?controller=dashboard");
} else {
    echo "Failed";
}
 */
