<?php
ini_set('display_errors', 1);
require 'fpdf/fpdf.php';

class myPDF extends FPDF
{
    function header()
    {
        $actual_link = 'http://' . $_SERVER['HTTP_HOST'];
        //$actual_link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        //echo $actual_link;
        //$this->image($actual_link . '/nownowpartnerportal/img/nownow-trans.png', 20, 15, 250);
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
        $this->SetFont('Arial', 'B', 10);
        $this->cell(30, 10, 'Transaction Id', 1, 0, 'C');
        $this->cell(35, 10, 'Date', 1, 0, 'C');
        $this->cell(55, 10, 'Service Name', 1, 0, 'C');
        $this->cell(40, 10, 'Account ID', 1, 0, 'C');
        $this->cell(20, 10, 'Opening', 1, 0, 'C');
        $this->cell(20, 10, 'Closing', 1, 0, 'C');
        $this->cell(25, 10, 'Amount', 1, 0, 'C');
        $this->cell(15, 10, 'Chages', 1, 0, 'C');
        $this->cell(15, 10, 'Comm.', 1, 0, 'C');
        $this->cell(25, 10, 'Status', 1, 0, 'C');
        $this->Ln();
    }
    function viewTable()
    {

        require_once 'transactionExport.php';
        $this->SetFont('Arial', '', 9);


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



            $this->cell(30, 10, $transactionId, 1, 0, 'C');
            $this->cell(35, 10, substr($transactionDate, 0, 19), 1, 0, 'C');
            $this->cell(55, 10, $serviceName, 1, 0, 'C');
            $this->cell(40, 10, $senderName, 1, 0, 'C');
            $this->cell(20, 10, number_format($openingBalance), 1, 0, 'C');
            $this->cell(20, 10, number_format($closingBalance), 1, 0, 'C');
            $this->cell(25, 10, number_format($transactionAmount), 1, 0, 'C');
            $this->cell(15, 10, number_format($transactionCharges), 1, 0, 'C');
            $this->cell(15, 10, number_format($transactionCommission), 1, 0, 'C');
            $this->cell(25, 10, $transactionStatus, 1, 0, 'C');
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
