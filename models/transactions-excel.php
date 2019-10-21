<?php
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'transactions.php';


//create PHPExcel object
$excel = new PHPExcel();

$excel->setActiveSheetIndex(0);
$excel->getActiveSheet()->setTitle("Transactions");
$row = 2;

for ($i = 0; $i < $result; $i++) {


    $transaction = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[$i];


    $transactionId = $transaction->transactionId;
    $transactionDate = $transaction->transactionDate;
    $serviceName = $transaction->serviceName;
    $receiverMsisdn = $transaction->receiverMsisdn;
    $accountId = $transaction->accountId;
    $transactionAmount = $transaction->transactionAmount;
    $transactionCommission = $transaction->transactionCommission;
    $transactionStatus = $transaction->transactionStatus;



    //$transactionDate = $transaction_details->transactionDate;
    $transactionDate = substr($transactionDate, 0, 19);

    $excel->getActiveSheet()
        ->setCellValue('A' . $row, $transactionId)
        ->setCellValue('B' . $row, $transactionDate)
        ->setCellValue('C' . $row, $serviceName)
        ->setCellValue('D' . $row, $receiverMsisdn)
        ->setCellValue('E' . $row, $transactionAmount)
        ->setCellValue('F' . $row, $transactionCommission)
        ->setCellValue('G' . $row, $transactionStatus);
    //increament for row
    $row++;
}

//set column width
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);



//make table headers
$excel->getActiveSheet()
    ->setCellValue('A1', 'Transaction ID')
    ->setCellValue('B1', 'Transaction Date')
    ->setCellValue('C1', 'Service Name')
    ->setCellValue('D1', 'Receiver MSISDN')
    ->setCellValue('E1', 'Amount')
    ->setCellValue('F1', 'Commission')
    ->setCellValue('G1', 'Transaction Status');


//merging title cells
$excel->getActiveSheet()->getStyle('A1:G1');

//aligning
$lastrow = $excel->getActiveSheet()->getHighestRow();
$excel->getActiveSheet()->getStyle('A1:G' . $lastrow)->getAlignment()->setHorizontal('center');


//styling
$excel->getActiveSheet()->getStyle('A1:G' . $lastrow)->applyFromArray(
    array(
        'font' => array(
            'size' => 11,
            'name' => 'Arial',
        )
    )
);

$excel->getActiveSheet()->getStyle('A1:G1')->applyFromArray(
    array(
        'font' => array(
            'bold' => 'true'
        )
    )
);

//--------------------------------------------------

header('Content-Type: application/vnd.vnd.ms-excel');
header('Content-Transfer-Encoding: base64');
header('Content-disposition: attachment; filename=transaction' . date('Y-m-d H-i-s') . '.xls');
//write the result to a file
$write = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$write->save('php://output');
