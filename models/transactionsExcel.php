<?php
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'transactionExport.php';


//create PHPExcel object
$excel = new PHPExcel();

$excel->setActiveSheetIndex(0);
$excel->getActiveSheet()->setTitle("Transactions");
$row = 2;

for ($i = 0; $i < $result; $i++) {
    //echo $i;

    $transaction = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[$i];
    $previousTransaction = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[$i - 1];

    $transactionId = $transaction->transactionId;
    $transactionDate = $transaction->transactionDate;
    $serviceName = $transaction->serviceName;
    $senderName = 'Test';
    $receiverMsisdn = '080555555555';
    $senderMsisdn = '08165666666';
    $accountId = '01234567890';
    $transactionAmount = $transaction->transactionAmount;
    $transactionType = $transaction->transactionType;
    $transactionCharges = $transaction->transactionCharges;
    $openingBalance = $transaction->openingBalance;
    $closingBalance = $transaction->closingBalance;
    //$closingBalances = $transaction->closingBalance;
    //$totalDeduction = $transactionAmount + $transactionCharges;
    $previousOpeningBalance = $previousTransaction->openingBalance;
    //$closingBalance = $previousTransaction->openingBalance;
    $closingBalanceCharge = $closingBalance - $transactionCharges;
    $transactionCommission = $transaction->transactionCommission;
    $transactionStatus = $transaction->transactionStatus;

    if (($transactionType == "510" || $transactionType == "810") && ($senderName != '' || !empty($senderName))) {

        $accountId = $senderName;
    } else if ($transactionType == "509") {
        $accountId = $accountId;
    } else {
        $accountId = $receiverMsisdn;
    }

    if ($i < 1 && ($transactionType == "509" || $transactionType == "508")) {
        $closingBalance = $closingBalanceCharge;
    } else if ($i < 1) {
        $closingBalance = $closingBalance;
    } else {
        $closingBalance = $previousOpeningBalance;
    }


    $excel->getActiveSheet()
        ->setCellValue('A' . $row, $transactionId)
        ->setCellValue('B' . $row, $transactionDate)
        ->setCellValue('C' . $row, $serviceName)
        ->setCellValue('D' . $row, $senderName)
        ->setCellValue('E' . $row, $openingBalance)
        ->setCellValue('F' . $row, $closingBalance)
        ->setCellValue('G' . $row, $transactionAmount)
        ->setCellValue('H' . $row, $transactionCharges)
        ->setCellValue('I' . $row, $transactionCommission)
        ->setCellValue('J' . $row, $transactionStatus);
    //increament for row
    $row++;
}

//set column width
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);



//make table headers
$excel->getActiveSheet()
    ->setCellValue('A1', 'Transaction ID')
    ->setCellValue('B1', 'Transaction Date')
    ->setCellValue('C1', 'Service Name')
    ->setCellValue('D1', 'AccountID/MSISDN')
    ->setCellValue('E1', 'Opening Balance')
    ->setCellValue('F1', 'Closing Balance')
    ->setCellValue('G1', 'Amount')
    ->setCellValue('H1', 'Charges')
    ->setCellValue('I1', 'Commission')
    ->setCellValue('J1', 'Transaction Status');


//merging title cells
$excel->getActiveSheet()->getStyle('A1:J1');

//aligning
$lastrow = $excel->getActiveSheet()->getHighestRow();
$excel->getActiveSheet()->getStyle('A1:J' . $lastrow)->getAlignment()->setHorizontal('center');


//styling
$excel->getActiveSheet()->getStyle('A1:J' . $lastrow)->applyFromArray(
    array(
        'font' => array(
            'size' => 10,
            'name' => 'Arial',
        )
    )
);

$excel->getActiveSheet()->getStyle('A1:J1')->applyFromArray(
    array(
        'font' => array(
            'bold' => 'true'
        )
    )
);

//--------------------------------------------------

header('Content-Type: application/vnd.vnd.ms-excel');
header('Content-Transfer-Encoding: base64');
header('Content-disposition: attachment; filename=transactions_history' . date('Y-m-d H-i-s') . '.xls');
//write the result to a file
$write = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$write->save('php://output');
