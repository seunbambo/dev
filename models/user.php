<?php


//******************** Access token *****************

$request = array(
    "mfsCommonServiceRequest" => array(
        "mfsSourceInfo" => array(
            "channelId" => "22",
            "surroundSystem" => "1"
        ),
        "mfsTransactionInfo" => array(
            "requestId" => "9086544566665",
            "serviceType" => "0",
            "timestamp" => "1517218465350"
        )
    )
);

$jsonRequest = json_encode($request);

$curlInitialize = curl_init();
curl_setopt($curlInitialize, CURLOPT_URL, 'http://api.nownowpay.ng/mfs-transaction-management/authManagement/get');
curl_setopt($curlInitialize, CURLOPT_HEADER, true);
curl_setopt($curlInitialize, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curlInitialize, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curlInitialize, CURLOPT_POST, true);
curl_setopt($curlInitialize, CURLOPT_POSTFIELDS, $jsonRequest);
curl_setopt($curlInitialize, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json',
    'Authorization:Basic YXBpQ2xpZW50OmFwaUNsaWVudFNlY3JldA=='
));

$response = curl_exec($curlInitialize);
//echo $response . "<br><br>";
$out = preg_split('/(\r?\n){2}/', $response, 2);
$auth_token = json_decode($out[1])->mfsResponseInfo->token;
$tokenstatus = json_decode($out[1])->mfsCommonServiceResponse->mfsStatusInfo->status;


curl_close($curlInitialize);


$header = array(
    'Authorization:Bearer ' . $auth_token,
    'Content-Type:application/json'
);




//********************************** Get User API **********************************/

$url = 'http://api.nownowpay.ng/mfs-transaction-management/userManagement/getUserInfo';
$curled = curl_init($url);
$header = array(
    'Authorization:Bearer ' . $auth_token,
    'Content-Type:application/json'
);
$payload = array(
    "mfsCommonServiceRequest" => array(
        "mfsSourceInfo" => array(
            "channelId" => 23,
            "surroundSystem" => 1
        ),
        "mfsTransactionInfo" => array(
            "requestId" => "8447220015329561229817922271",
            "serviceType" => "0",
            "timestamp" => 1532956122367

        )
    ),
    "mfsRequestInfo" => array(
        "customerMsisdn" => $_POST['msisdn']
    )
);


$payload = json_encode($payload);
curl_setopt($curled, CURLOPT_URL, $url);
curl_setopt($curled, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curled, CURLOPT_POST, true);
curl_setopt($curled, CURLOPT_POSTFIELDS, $payload);
curl_setopt($curled, CURLOPT_HTTPHEADER, $header);

$curl_res = curl_exec($curled);
//echo $curl_res."<br><br>";
$res = preg_split('/(\r?\n){2}/', $curl_res, 2);

$status = json_decode($res[0])->mfsCommonServiceResponse->mfsStatusInfo->status;
$email = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->email;
$phone = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->msisdn;


curl_close($curled);
