<?php

require 'fpdf/fpdf.php';

class myPDF extends FPDF
{
    function header()
    {
        $this->image('../img/nownow-trans.png', 20, 15, 250);
        $this->Cell(80);
        $this->SetFont('Arial', 'B', 15);
        $this->cell(120, 20, 'Subscribed Services', 0, 0, 'C');
        $this->Ln(15);
    }
    function footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 0);
        //$this->cell(0,10,'Page '.$this->PageNo.'/{nb}',0,0,'C');
    }
    function headerTable()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->cell(135, 10, 'Service Name', 1, 0, 'L');
        $this->cell(10, 10, 'Fee', 1, 0, 'C');
        $this->cell(20, 10, 'Fee Min.', 1, 0, 'C');
        $this->cell(20, 10, 'Fee Max.', 1, 0, 'C');
        $this->cell(30, 10, 'Commission', 1, 0, 'C');
        $this->cell(35, 10, 'Commission Min.', 1, 0, 'C');
        $this->cell(35, 10, 'Commission Max.', 1, 0, 'C');
        $this->Ln();
    }
    function viewTable()
    {
        require 'subscribed_services.php';
        $this->SetFont('Arial', '', 12);


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





            $this->cell(135, 10, $serviceName, 1, 0, 'L');
            $this->cell(10, 10, $fee, 1, 0, 'C');
            $this->cell(20, 10, $fee_min, 1, 0, 'C');
            $this->cell(20, 10, $fee_max, 1, 0, 'C');
            $this->cell(30, 10, $commission, 1, 0, 'C');
            $this->cell(35, 10, $commission_min, 1, 0, 'C');
            $this->cell(35, 10, $commission_max, 1, 0, 'C');
            $this->Ln();
        }
    }
}


$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->headerTable();
$pdf->viewTable();
$pdf->output();
