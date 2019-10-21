<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

//setting header to json
header('Content-Type: application/json');

include 'submit.php';

$wallet = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->walletInfo->wallet;
$entityId = json_decode($res[0])->mfsResponseInfo->mfsEntityDetailsListInfo->mfsEntityInfo[0]->walletInfo->wallet;

// Taking last element of the array
//$curBalance = end($curBalance)->curBalance;

print_r(json_encode($wallet));

$_SESSION['entityId'] = $entityId;

curl_close($curled);
