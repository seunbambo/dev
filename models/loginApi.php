<?php

//*************************** login API *****************************

$service_url = 'http://nownowpay.ng/admin-panel/partner/login';
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

// print_r($data->entityid);
// print_r($status);
//die();
curl_close($curl);
