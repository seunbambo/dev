<?php
include_once 'head.php';
include 'models/funding.php';
include 'models/functions.php';


?>
<div class="content">
    <div class="container-fluid">

        <div class="col-md-12">
            <form action="index.php?controller=funding&count=10" method="POST" id="criteria2">
                <ul class="search-criteria2">

                    <li class="left2">
                        <table style="width: 100%;">
                            <!--    <tr>
                            <td style="text-align: right; width: 200px; padding-right: 10px;">Wallet Type:</td>
                            <td><input type="text"></td>
                        </tr>
                        -->
                            <tr>

                                <div class="container" id="date">Date Range: </div>
                                <td id="range"><input type="text" name="fundingstart" placeholder="From:"></td>
                                <td id="range"><input type="text" name="fundingend" placeholder="To:"></td>

                                <td id="range-reset-button"><input type="submit" class="btn btn-warning btn-round" name="clear" onclick="reset()" value="Reset"></td>
                                <td id="range-search-button"><input type="submit" class="btn bg-secondary btn-round" name="search" value="Filter"></td>

                                <script type="text/javascript">
                                    $(function() {

                                        $('input[name="fundingstart"]').daterangepicker({
                                            autoUpdateInput: false,
                                            singleDatePicker: true,
                                            weekStart: 1,
                                            color: 'red',
                                            opens: 'right',
                                            locale: {
                                                cancelLabel: 'Clear'
                                            }
                                        });
                                        $('input[name="fundingend"]').daterangepicker({
                                            autoUpdateInput: false,
                                            singleDatePicker: true,
                                            weekStart: 1,
                                            color: 'red',
                                            opens: 'right',
                                            locale: {
                                                cancelLabel: 'Clear'
                                            }
                                        });

                                        $('input[name="fundingstart"]').on('apply.daterangepicker', function(ev, picker) {
                                            $(this).val(picker.startDate.format('DD/MM/YYYY'));
                                        });
                                        $('input[name="fundingend"]').on('apply.daterangepicker', function(ev, picker) {
                                            $(this).val(picker.startDate.format('DD/MM/YYYY'));
                                        });

                                        $('input[name="fundingstart"]').on('cancel.daterangepicker', function(ev, picker) {
                                            $(this).val('');
                                        });
                                        $('input[name="fundingend"]').on('cancel.daterangepicker', function(ev, picker) {
                                            $(this).val('');
                                        });

                                    });
                                    //console.clear();
                                </script>
                                </td>
                            </tr>
                        </table>
                    </li>

                    <li class="">
                        <table>

                        </table>
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
                                        <form action="index.php?controller=funding&count=10" method="POST">


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
                                                <label for="">Date Range:</label>
                                                <input type="text" class="form-control" name="fundingstart" placeholder="From:">

                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="fundingend" placeholder="To:">
                                            </div>


                                            <input type="submit" class="btn btn-warning" name="clear" onclick="reset()" value="Reset" style="width: 100%;">
                                            <input type="submit" class="btn btn-primary" name="search" value="Filter" style="width: 100%;">

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


            <div data-toggle='modal' data-target='#modal-view' id="filter">
                <button type="button" class="btn btn-primary" data-toggle='modal' data-target='#modal-view'>
                    <i class="fa fa-filter"></i><span></span>
                </button>
            </div>





        </div>


        <div class="col-md-12">
            <a href="models/fundingPdf.php"><img id="pdf" src="img/pdf.png" alt="pdf-download"></a>
            <a href="models/fundingExcel.php"><img id="excel" src="img/excel.png" alt="excel-download"></a>
        </div><br><br>

        <div class="row">
            <div class="col-md-12 tabletop">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">
                            <?php echo ucfirst($_GET['controller']) . " History"; ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-hover">
                            <table id="myTable" class="table table-bordered table-sm">
                                <thead class=" text-primary" style="border-top: 1px solid #dddcdd;">
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(0)">Transaction ID</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(1)">Transaction Date</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(2)">Status</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(3)">Amount</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(4)">Sender</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(5)">Commission (&#8358;)</th>
                                </thead>
                                <tbody>
                                    <?php

                                    for ($i = 0; $i < $result; $i++) {

                                        $transaction = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[$i];
                                        $transactionId = $transaction->transactionId;
                                        $transactionDate = $transaction->transactionDate;
                                        $transactionStatus = $transaction->transactionStatus;
                                        $transactionAmount = $transaction->transactionAmount;
                                        $senderName = 'Test';
                                        $transactionCommission = $transaction->transactionCommission;

                                        echo "<tr>
                                <td>$transactionId</td>
                                <td>" . substr($transactionDate, 0, 19) . "</td>
                                <td>$transactionStatus</td>
                                <td>&#8358;" . number_format($transactionAmount) . "</td>
                                <td>$senderName</td>
                                <td>$transactionCommission</td>
                        
                                </tr>";
                                    }

                                    ?>

                                </tbody>
                            </table>

                            <?php
                            paging($controller, $model);
                            ?>
                        </div>
                    </div>
                </div>

                <?php
                include_once('footer.php');
                ?>