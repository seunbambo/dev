<?php 
include_once('head.php');
include('models/transactions.php');




?>
<div class="content">
    <div class="container-fluid">

        <form action="index.php?controller=report&count=10" method="POST" id="criteria">
            <ul class="search-criteria">

                <li class="left">
                    <table style="width: 400px;">
                        <tr>
                            <td style="text-align: right; width: 200px; padding-right: 10px;">Wallet Type:</td>
                            <td><input type="text"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right; padding: 25px 10px;">Date Range:</td>
                            <td><input type="text" name="start" placeholder="From:" style="width: 120px; margin-left: -130px;"></td>
                            <td><input type="text" name="end" placeholder="To:" style="width: 120px; margin-left: -120px;"></td>






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
                            </script>
                            </td>
                        </tr>



                        <tr>
                            <td><input type="submit" class="btn btn-primary" name="search" id="button" value="Search" style="height: 40px; width: 120px; margin-right: -270px;"></td>
                            <td><input type="button" class="btn btn-warning" onclick="reset()" value="Reset" style="height: 40px; width: 118px; margin-right: -135px;"></td>

                        </tr>
                    </table>
                </li>

                <li class="right">
                    <table>

                        <tr>
                            <td style="text-align: right; padding: 16px 10px;">Recent Transactions:</td>
                            <td style="text-align: left;"><input type="text"></td>
                        </tr>
                        <tr>
                            <td style="text-align: right; padding: 20px 10px; width: 150px;">Status:</td>
                            <td style="text-align: center;"><select name="status" id="status" style="text-align: center; height: 40px; width: 250px;">
                                    <option value="" style="text-align: center;" selected>Please Select</option>
                                    <option value="FAILED" style="text-align: center;">FAILED</option>
                                    <option value="SUCCESS" style="text-align: center;">SUCCESS</option>
                                </select></td>

                        </tr>

                    </table>




                </li>








            </ul>



        </form>

        <div class="col-md-12">
            <a href="models/reportpdf.php"><img id="pdf" src="img/pdf.png" alt="pdf-download"></a>
            <a href="models/report-excel.php"><img id="excel" src="img/excel.png" alt="excel-download"></a>
        </div><br><br>

        <div class="row">
            <div class="col-md-12 tabletop">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">
                            <?php echo ucfirst($_GET['controller']) . "s & Analytics"; ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-hover">
                            <table id="myTable" class="table table-bordered table-sm">
                                <thead class=" text-primary" style="border-top: 1px solid #dddcdd;">
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(0)">Transaction Id</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(1)">Transaction Date</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(2)">Status</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(3)">Amount</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(4)">Sender</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(5)">Commission (%)</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(6)">Commission (&#8358;)</th>
                                </thead>
                                <tbody>
                                    <?php

                                    for ($i = 0; $i < $resu; $i++) {
                                        //echo $i;




                                        $transaction = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[$i];

                                        //$resu = count($transaction);
                                        //echo $resu . "<br>";

                                        $transactionId = $transaction->transactionId;
                                        $transactionDate = $transaction->transactionDate;
                                        $transactionStatus = $transaction->transactionStatus;
                                        $transactionAmount = $transaction->transactionAmount;
                                        $senderName = $transaction->senderName;
                                        $transactionCommission = $transaction->transactionCommission;

                                        echo "<tr>
                                        <td>$transactionId</td>
                                        <td>" . substr($transactionDate, 0, 19) . "</td>
                                        <td>$transactionStatus</td>
                                        <td>&#8358;" . number_format($transactionAmount) . "</td>
                                        <td>$senderName</td>
                                        <td>$transactionCommission</td>
                                        <td></td>
                                
                                        </tr>";

                                        //curl_close($curl);

                                        //echo $transactionId."<br>";
                                    }

                                    ?>


                                </tbody>
                            </table>

                            <?php
                            $limit = 10;
                            if (isset($_GET['count'])) {
                                $page = $_GET["count"];
                            } else {
                                $page = 10;
                            }
                            $start_from = ($page - 1) * $limit;

                            ?>


                            <div class="paging">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $page = @$_GET['page'];
                                            if ($page == 0 || $page == 1) {
                                                @$page = 0;
                                            } else {
                                                $page1 = ($page * 4) - 4;
                                            }
                                            ?>

                                        </div>


                                        <ul class="pagination">

                                            <?php 
                                            $links = 5;
                                            $last = ceil($rowcount / $limit);
                                            $start = (($page - $links) > 0) ? $page - $links : 1;
                                            $end = (($page + $links) < $last) ? $page + $links : $last;

                                            $class = ($page == 1) ? "disabled" : "";

                                            $previous_page = ($page > 1) ?
                                                '<li class="' . $class . '"><a href="index.php?controller=report&count=' . ($page - 1) . '&page=' . ($page - 1) . '">&laquo;</a></li>' : '<li class="page-item disabled"><a href="">&laquo;</a></li>';
                                            echo $previous_page;

                                            if ($start > 1) {
                                                echo '<li class="page-item"><a class="page-link" href="index.php?controller=report&count=' . 1 . '&page=' . 1 . '">' . 1 . '</a></li>';
                                                echo '<li class="disabled"><span>...</span></li>';
                                            }


                                            for ($i = $start; $i <= $end; $i++) {
                                                $class = ($page == $i) ? "active" : "";
                                                echo '<li class="page-item ' . $class . '"><a class="page-link" href="index.php?controller=report&count=10&offset=' . ($i * 10) . '&page=' . $i . '">' . $i . '</a></li>';
                                            }


                                            if ($end < $last) {
                                                echo '<li class="page-item disabled"><span>...</span></li>';
                                                echo '<li class="page-item"><a class="page-link" href="index.php?controller=report&count=10&offset=' . ($last * 10) . '&page=' . $last . '">' . $last . '</a></li>';
                                            }

                                            $next_page = ($page == $last * 10) ?
                                                '<li class="page-item disabled"><a class="page-link" href="">&raquo;</a></li>' : '<li class="' . $class . '"><a class="page-link" href="index.php?controller=report&count=10&offset=' . ($i * 10) . '&page=' . ($i + 1) . '">&raquo;</a></li>';
                                            echo $next_page;
                                            ?>
                                        </ul>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <?php 
                include_once('footer.php');
                ?> 