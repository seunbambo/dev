<?php
//include 'user.php';
$phone = $_POST['email-phone'];
$currentpassword = hash('sha256', $_POST['currentpassword']);
$newpassword = hash('sha256', $_POST['newpassword']);
$confirmpassword = hash('sha256', $_POST['confirmpassword']);

$service_url = 'http://34.254.53.229:8080/admin-panel/partner/changePassword';
$curl = curl_init($service_url);
$curl_post_data = array(

    "loginId" => $_GET['email'],
    "currentPassword" => $currentpassword,
    "newPassword" => $newpassword
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

//print_r($output);

$count = count($output);
//$response = json_decode($output);
$response = json_decode($output[0]);
$message = $response;
$status = $response->status;
// print_r($response->data->msisdn) . "<br><br>";
// print_r($response->data->email) . "<br><br>";
// print_r($response->data->entityid) . "<br><br>";

//echo $res."<br>";
//$i = 0;
//$transactions = json_decode($output[0])->mfsCommonServiceResponse->mfsStatusInfo->status;

curl_close($curl);
