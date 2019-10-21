<?php
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'funding.php';


//create PHPExcel object
$excel = new PHPExcel();

$excel->setActiveSheetIndex(0);
$excel->getActiveSheet()->setTitle("Funding");
$row = 2;

for ($i = 0; $i < $result; $i++) {

    $transaction = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[$i];


    $transactionDate = $transaction_details->transactionDate;
    $transactionDate = substr($transactionDate, 0, 19);




    $excel->getActiveSheet()
        ->setCellValue('A' . $row, $transaction->transactionId)
        ->setCellValue('B' . $row, $transactionDate)
        ->setCellValue('C' . $row, $transaction->transactionStatus)
        ->setCellValue('D' . $row, $transaction->transactionAmount)
        ->setCellValue('E' . $row, $transaction->senderName)
        ->setCellValue('F' . $row, $transaction->transactionCommission);
    //increament for row
    $row++;
}


//set column width
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(40);



//make table headers
$excel->getActiveSheet()
    ->setCellValue('A1', 'Transaction ID')
    ->setCellValue('B1', 'Date/Time')
    ->setCellValue('C1', 'Status')
    ->setCellValue('D1', 'Amount')
    ->setCellValue('E1', 'Sender')
    ->setCellValue('F1', 'Consumer Commission (N)');

//merging title cells
$excel->getActiveSheet()->getStyle('A1:F1');

//aligning
$lastrow = $excel->getActiveSheet()->getHighestRow();
$excel->getActiveSheet()->getStyle('A1:F' . $lastrow)->getAlignment()->setHorizontal('center');


//styling
$excel->getActiveSheet()->getStyle('A1:F' . $lastrow)->applyFromArray(
    array(
        'font' => array(
            'size' => 11,
            'name' => 'Arial',
        )
    )
);

$excel->getActiveSheet()->getStyle('A1:F1')->applyFromArray(
    array(
        'font' => array(
            'bold' => 'true'
        )
    )
);

//--------------------------------------------------

header('Content-Type: application/vnd.vnd.ms-excel');
header('Content-Transfer-Encoding: base64');
header('Content-disposition: attachment; filename=funding_history' . date('Y-m-d H-i-s') . '.xls');
//write the result to a file
$write = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$write->save('php://output');
