<?php
include_once 'head.php';
include 'models/transactions.php';
include 'models/functions.php';

?>


<div class="content criteria">
    <div class="container-fluid">
        <form action="index.php?controller=transactions&count=10" method="POST" id="criteria">
            <ul class="search-criteria">

                <li class="left col-md-6">
                    <table style="width: 400px;">

                        <tr>
                            <td id="msisdn2" style="text-align: right; width: 200px; padding: 22px 10px 15px 10px;">MSISDN:</td>
                            <td><input type="text" name="msisdn" id="msisdn"></td>
                        </tr>

                        <tr>
                            <td style="text-align: right; padding: 18px 10px;">Date Range:</td>
                            <td><input type="text" name="start" id="date-start" placeholder="From:" style="width: 120px; margin-left: -130px;"></td>
                            <td><input type="text" name="end" id="date-end" placeholder="To:" style="width: 120px; margin-left: -125px;"></td>

                            <script type="text/javascript">
                                $(function() {


                                    //$('.datepicker').datepicker()
                                    $('input[name="start"]').daterangepicker({
                                        autoUpdateInput: false,
                                        singleDatePicker: true,
                                        weekStart: 1,
                                        color: 'red',
                                        opens: 'right',
                                        locale: {
                                            cancelLabel: 'Clear'
                                        }
                                    });
                                    $('input[name="end"]').daterangepicker({
                                        autoUpdateInput: false,
                                        singleDatePicker: true,
                                        weekStart: 1,
                                        color: 'red',
                                        opens: 'right',
                                        locale: {
                                            cancelLabel: 'Clear'
                                        }
                                    });



                                    $('input[name="start"]').on('apply.daterangepicker', function(ev, picker) {
                                        $(this).val(picker.startDate.format('DD/MM/YYYY'));
                                    });
                                    $('input[name="end"]').on('apply.daterangepicker', function(ev, picker) {
                                        $(this).val(picker.startDate.format('DD/MM/YYYY'));
                                    });

                                    $('input[name="start"]').on('cancel.daterangepicker', function(ev, picker) {
                                        $(this).val('');
                                    });
                                    $('input[name="end"]').on('cancel.daterangepicker', function(ev, picker) {
                                        $(this).val('');
                                    });

                                });
                                //console.clear();
                            </script>

                            </td>
                        </tr>


                        <tr style="mar">
                            <td></td>
                            <td><input type="submit" class="btn btn-warning btn-round" id="range-reset-button2" name="clear" onclick="reset()" value="Reset"></td>
                            <td><input type="submit" class="btn bg-secondary btn-round" id="range-search-button2" name="search" value="Filter"></td>
                        </tr>

                    </table>
                </li>


                <li class="right col-md-6">
                    <table>
                        <tr>
                            <td style="text-align: right; padding: 17px 10px;">Transaction Id:</td>
                            <td style="text-align: left;"><input type="text" id="transactionid" name="transactionid"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right; padding: 5px 10px;">Status:</td>
                            <td style="text-align: center;"><select name="status" id="status" type="text" id="status" style="text-align: center; width: 250px;">
                                    <option value="" style="text-align: center;" selected>Please Select</option>
                                    <option value="FAILED" style="text-align: center;">FAILED</option>
                                    <option value="IN_PROGRESS" style="text-align: center;">IN PROGRESS</option>
                                    <option value="SUCCESS" style="text-align: center;">SUCCESS</option>
                                </select></td>

                        </tr>

                    </table>
                </li>
            </ul>
        </form>


        <!----------------- Modal ---------------->
        <div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="text-primary">Filter</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="width: 100%;">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="card-body">
                                    <form action="index.php?controller=transactions&count=10" method="POST">

                                        <script type="text/javascript">
                                            $(function() {


                                                //$('.datepicker').datepicker()
                                                $('input[name="start"]').daterangepicker({
                                                    autoUpdateInput: false,
                                                    singleDatePicker: true,
                                                    weekStart: 1,
                                                    color: 'red',
                                                    opens: 'right',
                                                    locale: {
                                                        cancelLabel: 'Clear'
                                                    }
                                                });
                                                $('input[name="end"]').daterangepicker({
                                                    autoUpdateInput: false,
                                                    singleDatePicker: true,
                                                    weekStart: 1,
                                                    color: 'red',
                                                    opens: 'right',
                                                    locale: {
                                                        cancelLabel: 'Clear'
                                                    }
                                                });



                                                $('input[name="start"]').on('apply.daterangepicker', function(ev, picker) {
                                                    $(this).val(picker.startDate.format('DD/MM/YYYY'));
                                                });
                                                $('input[name="end"]').on('apply.daterangepicker', function(ev, picker) {
                                                    $(this).val(picker.startDate.format('DD/MM/YYYY'));
                                                });

                                                $('input[name="start"]').on('cancel.daterangepicker', function(ev, picker) {
                                                    $(this).val('');
                                                });
                                                $('input[name="end"]').on('cancel.daterangepicker', function(ev, picker) {
                                                    $(this).val('');
                                                });

                                            });
                                            //console.clear();
                                        </script>

                                        <div class="form-group">
                                            <label for="">MSISDN:</label>
                                            <input type="text" class="form-control" aria-describedby="emailHelp" name="msisdn">

                                        </div>

                                        <div class="form-group">
                                            <label for="">Transaction Id:</label>
                                            <input type="text" name="transactionid" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Date Range:</label>
                                            <input type="text" name="start" class="form-control" placeholder="From">
                                        </div>
                                        <div class="form-group">

                                            <input type="text" name="end" class="form-control" placeholder="To">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Status:</label><br>
                                            <select name="status" id="status" type="text" id="status" class="form-control">
                                                <option value="" style="text-align: center;" selected>Please Select</option>
                                                <option value="FAILED" style="text-align: center;">FAILED</option>
                                                <option value="IN_PROGRESS" style="text-align: center;">IN PROGRESS</option>
                                                <option value="SUCCESS" style="text-align: center;">SUCCESS</option>
                                            </select>
                                        </div>


                                        <input type="submit" id="button" class="btn btn-warning" name="clear" onclick="reset()" value="Reset" style="height: 50px; width: 100%;">
                                        <input type="submit" id="button" class="btn btn-primary" name="search" value="Filter" style="height: 50px; width: 100%;">

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div data-toggle='modal' data-target='#modal-view' id="filter">
        <button type="button" class="btn btn-primary" data-toggle='modal' data-target='#modal-view'>
            <i class="fa fa-filter"></i><span></span>
        </button>
    </div>



    <div class="col-md-12">
        <a href="models/transactionsPdf.php" name="search"><img id="pdf" src="img/pdf.png" alt="pdf-download"></a>
        <a href="models/transactionsExcel.php" name="search"><img id="excel" src="img/excel.png" alt="excel-download"></a>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-12 tabletop">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">
                        Transactions
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-hover">
                        <?php

                        function lists()
                        {
                            include('models/transactions.php');


                            ?>
                            <table id="myTable" class="table table-bordered table-sm">
                                <thead class="text-primary">
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(0)">Transaction ID</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(1)">Transaction Date</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(2)">Service Name</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(3)">Account ID/MSISDN</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(4)">Opening Balance</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(5)">Closing Balance</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(6)">Amount</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(7)">Charges</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(8)">Commission</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(9)">Status</th>
                                    <th style="font-size: 15px; font-weight: 400;">Details</th>
                                </thead>
                                <tbody>
                                    <?php

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


                                            echo "<tr>
                                                    <td>$transactionId</td>
                                                    <td>" . substr($transactionDate, 0, 19) . "</td>
                                                    <td>$serviceName</td>
                                                    <td>$accountId</td>";
                                            echo  "<td>&#8358;" . number_format($openingBalance) . "</td>";
                                            echo  "<td>&#8358;" . number_format($closingBalance) . "</td>";
                                            echo  "<td>&#8358;" . number_format($transactionAmount) . "</td>";
                                            echo  "<td>&#8358;" . number_format($transactionCharges) . "</td>";
                                            echo  "<td>&#8358;" . number_format($transactionCommission) . "</td>
                                                    <td>" . ucfirst($transactionStatus) . "</td>
                                                    <td>
                                                        <a href='index.php?controller=transactions&transactionid=$transactionId'>
                                                            View
                                                        </a>
                                                    </td>

                                                </tr>";
                                        }

                                        ?>

                                </tbody>
                            </table>
                        <?php
                        }
                        echo lists();
                        paging($controller, $model);
                        ?>
                    </div>
                </div>

                <?php
                include_once('footer.php')
                ?>