<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

//setting header to json
header('Content-Type: application/json');

if (isset($_POST['submit'])) {
    $msisdn = $_POST['msisdn'];
    $entitytype = $_POST['entitytype'];
    $accesscode = $_POST['accesscode'];

    $_SESSION['msisdn'] = $msisdn;
    $_SESSION['entitytype'] = $entitytype;
    $_SESSION['accesscode'] = $accesscode;

    $_SESSIOn['last_login_timestamp'] = time();

    $url = 'index.php?controller=dashboard';
    //header('Location: '.$url);
    //exit();
}

$msisdn = $_SESSION['msisdn'];
$entitytype = $_SESSION['entitytype'];
$accesscode = $_SESSION['accesscode'];

/*
if (isset($_POST['msisdn'])) {
    
    $entitytype = $_POST['entitytype'];
    $msisdn = $_POST['msisdn'];
    $accesscode = $_POST['accesscode'];
    //$access = $access. "Dbbwjvj$%)GE$5SGr@3VsHYUMas2323E4d57vfBfFSTRU@!DSH(*%FDSdfg13sgfsg";
    //$accesscode = md5($access);

}


echo "ENTITY TYPE: " . $entitytype . "<br><br>";
echo "MSIDN: " . $msisdn . "<br><br>";
echo "ACCESS CODE: " . $accesscode . "<br><br>";

 //$_SESSION['entitytype'] = $entitytype;
 //$_SESSION['msisdn'] = $msisdn;
 //$_SESSION['accesscode'] = $accesscode;
*/


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

//echo "TOKEN ".$tokenstatus;

/*
echo "<br><br>";
print_r($auth_token);
echo "<br><br>";
*/
//$p = json_encode($response);
//$auth_token = $p[1]->mfsResponseInfo->token;

//var_dump($auth_token);

curl_close($curlInitialize);


$header = array(
    'Authorization:Bearer ' . $auth_token,
    'Content-Type:application/json'
);


//-------------------login API

$service_url = 'http://api.nownowpay.ng/mfs-transaction-management/loginManagement/verifyMpin';
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
        "accessCode" => $accesscode,
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

//echo "VERIFY ".$verifystatus;







$entityId = json_decode($output[0])->mfsResponseInfo->entityId;

$_SESSION['entityId'] = $entityId;
//$entityId = $entityId->entityId;

//$_SESSION['entityId'] = $entityId;

//echo "STATUS<br>".$status;
/*
        echo "<br>";
        print_r($entityId);
        echo "<br><br>";
        */
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
$wallet = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->walletInfo->wallet;
$firstname = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->firstName;
$entityId = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->walletInfo->wallet;

// Taking last element of the array
//$curBalance = end($curBalance)->curBalance;
$wt1balance = $wallet[0]->curBalance;
$wt2balance = $wallet[1]->curBalance;
$wt3balance = $wallet[2]->curBalance;
$wt4balance = $wallet[3]->curBalance;
$entityId = $entityId[0]->entityId;
$_SESSION['firstname'] = $firstname;

print_r(json_encode($wallet));

//session_start();




//$entityId = $entityId->entityId;

$_SESSION['entityId'] = $entityId;
//echo "ENTITY =".$_SESSION['entityId'];
/*
        echo "STATUS FOR GRTUSER<br>".print_r($status);
echo "<br><br>";
echo "CURRENT BALANCE: ".$curbalance;
echo "<br><br>";
echo "FIRST NAME: ".$firstname;

echo "<br>";
        //print_r($entityId);
        */
curl_close($curled);

