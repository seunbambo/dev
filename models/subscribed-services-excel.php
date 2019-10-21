<?php
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';
require_once 'subscribed_services.php';

//create PHPExcel object
$excel = new PHPExcel();

$excel->setActiveSheetIndex(0);
$excel->getActiveSheet()->setTitle("Subscribed Services");
$row = 2;

for ($i = 0; $i < $count; $i++) {
    //echo $i;




    $subscribedServices = json_decode($output[0])->data[$i];



    $serviceName = $subscribedServices->SERVICE_NAME;
    $fee = $subscribedServices->FEE_VALUE;
    $fee_min = $subscribedServices->FEE_MIN;
    $fee_max = $subscribedServices->FEE_MAX;
    $commission = $subscribedServices->COMMISSION_VALUE;
    $commission_min = $subscribedServices->COMMISSION_MIN;
    $commission_max = $subscribedServices->COMMISSION_MAX;




    $excel->getActiveSheet()
        ->setCellValue('A' . $row, $serviceName)
        ->setCellValue('B' . $row, $fee)
        ->setCellValue('C' . $row, $fee_min)
        ->setCellValue('D' . $row, $fee_max)
        ->setCellValue('E' . $row, $commission)
        ->setCellValue('F' . $row, $commission_min)
        ->setCellValue('G' . $row, $commission_max);
    //increament for row
    $row++;
}

//set column width
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(80);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);



//make table headers
$excel->getActiveSheet()
    ->setCellValue('A1', 'Service Name')
    ->setCellValue('B1', 'Fee')
    ->setCellValue('C1', 'Fee Min.')
    ->setCellValue('D1', 'Fee Max.')
    ->setCellValue('E1', 'Commission')
    ->setCellValue('F1', 'Commission Min.')
    ->setCellValue('G1', 'Commission Max');

//merging title cells
$excel->getActiveSheet()->getStyle('A1:G1');

//aligning
$lastrow = $excel->getActiveSheet()->getHighestRow();
$excel->getActiveSheet()->getStyle('A1:G' . $lastrow)->getAlignment()->setHorizontal('center');


//styling
$excel->getActiveSheet()->getStyle('A1:G' . $lastrow)->applyFromArray(
    array(
        'font' => array(
            'size' => 10,
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
header('Content-disposition: attachment; filename=subscribed-services' . date('Y-m-d H-i-s') . '.xls');
//write the result to a file
$write = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$write->save('php://output');
