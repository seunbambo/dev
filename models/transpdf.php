<?php

require 'fpdf/fpdf.php';

class myPDF extends FPDF
{
    function header()
    {
        $this->image('../img/nownow-logo.png', 250, 15, 35);
        $this->Cell(80);
        $this->SetFont('Arial', 'B', 15);
        $this->cell(120, 20, 'Transactions History', 0, 0, 'C');
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
        $this->SetFont('Times', 'B', 12);
        $this->cell(35, 10, 'Transaction Id', 1, 0, 'C');
        $this->cell(45, 10, 'Date', 1, 0, 'C');
        $this->cell(55, 10, 'Service Name', 1, 0, 'C');
        $this->cell(40, 10, 'Receiver MSISDN', 1, 0, 'C');
        $this->cell(35, 10, 'Amount(N)', 1, 0, 'C');
        $this->cell(40, 10, 'Commission(N)', 1, 0, 'C');
        $this->cell(30, 10, 'Status', 1, 0, 'C');
        $this->Ln();
    }
    function viewTable()
    {
        include 'transactions.php';
        $this->SetFont('Times', '', 12);


        for ($i = 0; $i < $result; $i++) {
            //echo $i;

            $transaction = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[$i];

            $transactionId = $transaction->transactionId;
            $transactionDate = $transaction->transactionDate;
            $serviceName = $transaction->serviceName;
            $receiverMsisdn = $transaction->receiverMsisdn;
            //$accountId = $transaction->accountId;
            $transactionAmount = $transaction->transactionAmount;
            $transactionCommission = $transaction->transactionCommission;
            $transactionStatus = $transaction->transactionStatus;





            $this->cell(35, 10, $transactionId, 1, 0, 'C');
            $this->cell(45, 10, substr($transactionDate, 0, 19), 1, 0, 'C');
            $this->cell(55, 10, $serviceName, 1, 0, 'C');
            $this->cell(40, 10, $receiverMsisdn, 1, 0, 'C');
            $this->cell(35, 10, number_format($transactionAmount), 1, 0, 'C');
            $this->cell(40, 10, number_format($transactionCommission), 1, 0, 'C');
            $this->cell(30, 10, $transactionStatus, 1, 0, 'C');
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
