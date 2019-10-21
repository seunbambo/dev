<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

if (isset($_POST['submit'])) {
    $msisdn = $_POST['msisdn'];
    $entitytype = $_POST['entitytype'];
    $password = $_POST['password'];

    $_SESSION['msisdn'] = $msisdn;
    $_SESSION['entitytype'] = $entitytype;
    $_SESSION['password'] = $password;

    $url = 'index.php?controller=dashboard';
}

$msisdn = $_SESSION['msisdn'];
$entitytype = $_SESSION['entitytype'];
$password = $_SESSION['password'];

// Access token

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


//-------------------login API

$service_url = 'http://nownowpay.ng/admin-panel/partner/login';
$curl = curl_init($service_url);
$curl_post_data = array(
    "mfsCommonServiceRequest" => array(
        "mfsSourceInfo" => array(
            "channelId" => 22,
            "surroundSystem" => 1
        ),
        "mfsTransactionInfo" => array(
            "requestId" => "840085561115293860125929823229",
            "serviceType" => "0",
            "timestamp" => 1529386012

        )
    ),
    "mfsRequestInfo" => array(
        "password" => $password,
        "msisdn" => $msisdn,
        "entityType" => $entitytype
    )
);


$curl_post_data = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_URL, $service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);


$curl_response = curl_exec($curl);
//echo $curl_response."<br><br>";
$output = preg_split('/(\r?\n){2}/', $curl_response, 2);

$verifystatus = json_decode($output[0])->mfsCommonServiceResponse->mfsStatusInfo->status;

$entityId = json_decode($output[0])->mfsResponseInfo->entityId;

$_SESSION['entityId'] = $entityId;

curl_close($curl);


if ($verifystatus === "Failure.") {
    header("Location: ../index.php");
    exit();
}











$url = 'http://api.nownowpay.ng/mfs-transaction-management/userManagement/getUserInfo';
$curled = curl_init($url);
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
        "customerMsisdn" => $_SESSION['msisdn']
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
$curBalance = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->walletInfo->wallet;
$availBalance = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->walletInfo->wallet;
$reservedBalance = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->walletInfo->wallet;
$firstname = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->firstName;
$entityId = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->walletInfo->wallet;

// Taking last element of the array
$curBalance = $curBalance[0]->curBalance;
$availBalance = $availBalance[0]->availBalance;
$reservedBalance = $reservedBalance[0]->reservedBalance;
$entityId = $entityId[0]->entityId;
$_SESSION['firstname'] = $firstname;

//session_start();




//$entityId = $entityId->entityId;

$_SESSION['entityId'] = $entityId;

curl_close($curled);
