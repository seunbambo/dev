<?php
session_start();

if (isset($_POST['submit']) && $_POST['msisdn'] == 'testme' && $_POST['password'] == '@dm!n123') {
    $msisdn = '1231231212';
    //$entitytype = $_POST['entitytype'];
    //hash("sha256", $password);
    $password = '3eb96e2b98d7fc2df2257aa4a2fa0af4';
    $password = hash("sha256", $password);
    //$password = hash("sha256", $_POST['password']);

    $_SESSION['msisdn'] = $msisdn;
    //$_SESSION['entitytype'] = $entitytype;
    $_SESSION['password'] = $password;

    $_SESSION['last_login_timestamp'] = time();

    $url = 'index.php?controller=dashboard';
} else {
    $url = 'index.php?login=fail';
}

$msisdn = $_SESSION['msisdn'];
//$entitytype = $_SESSION['entitytype'];
$password = $_SESSION['password'];


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
$fromapi = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0];
$wt1balance = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->walletInfo->wallet;
$wt2balance = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->walletInfo->wallet;
$firstname = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->firstName;
$entityId = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->walletInfo->wallet;
$wallet = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->walletInfo->wallet;
$email = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->email;
$phone = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->msisdn;

// Taking last element of the array
//$curBalance = end($curBalance)->curBalance;
$wt1balance = $wt1balance[0]->curBalance;
$wt2balance = $wt2balance[1]->curBalance;
$entityId = $wallet[0]->entityId;
$entityType = $fromapi->entityType;
//print_r($entityType);
$_SESSION['firstname'] = $firstname;



$_SESSION['entityId'] = $entityId;

curl_close($curled);


//*************************** login API *****************************

$service_url = 'http://nownowpay.ng/admin-panel/partner/login';
//$service_url = 'http://34.254.53.229:8080/admin-panel/partner/login';
$curl = curl_init($service_url);
$curl_post_data = array(
    "password" => $password,
    "loginId" => $msisdn
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
$output = preg_split('/(\r?\n){2}/', $curl_response, 2);

//$verifystatus = json_decode($output[0]);
//print_r(json_decode($output[0])->data);
$data = json_decode($output[0])->data;
$status = json_decode($output[0])->status;

$entityId = $data->entityid;

$_SESSION['entityId'] = $entityId;

curl_close($curl);


$time = $_SERVER['REQUEST_TIME'];

$timeout_duration = 1800;

if (
    isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration
) {
    echo '<script>window.location="index.php?controller=logout"</script>';
}

$_SESSION['LAST_ACTIVITY'] = $time;
