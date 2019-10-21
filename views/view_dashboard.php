<?php
//session_start();

include_once('head.php');
include_once('models/submit.php');
include('models/transactionsFew.php');
include('models/cashInOut.php');

// Calculate balance after deducting charges 
$transactionCharges = $transact->transactionCharges;
$walletBalance = $wt1balance - $transactionCharges;
?>
<div class="content">
    <!--
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="#"><?php echo ucfirst($_GET['controller']); ?></a>
    </div>
-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <p class="card-category">Primary Wallet</p>
                        <h3 class="card-title">&#8358;<?php print_r(number_format($wt1balance, 2)); ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats pt-3">
                            .
                        </div>
                    </div>
                </div>
            </div>

            <?php

            if ($_SESSION['entityId'] == "82000001366") {
                echo '
                
                <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card">

                    <iframe src="https://reports.nownowpay.ng/public/question/4a163f58-9937-402f-b56a-3a807ec9331a" frameborder="0" allowtransparency></iframe>

                </div>
            </div>

                ';
            } else {

                echo '
                
                <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <p class="card-category">Stock Wallet</p>
                        <h3 class="card-title">&#8358;' . number_format($wt2balance, 2) . ' </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats pt-3">
                            .
                        </div>
                    </div>
                </div>
            </div>

                ';
            }

            ?>




            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card card-stats" id="cashinout">
                    <div class="table-responsive">
                        <table id="myTable" class="table  table-sm">
                            <thead class="text-primary">
                                <th style="font-size: 15px;">Transaction Type</th>
                                <th style="font-size: 15px;">Count</th>
                                <th style="font-size: 15px;">Amount</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cash In (today)</td>
                                    <td><?php if (!empty($cashInAmount)) {
                                            echo count($cashInAmount);
                                        } else {
                                            echo 0;
                                        } ?></td>
                                    <td><?php if (!empty($cashInAmount)) {
                                            echo '&#8358;' . number_format(array_sum($cashInAmount), 2);
                                        } else {
                                            echo '&#8358;' . 0;
                                        } ?></td>
                                </tr>
                                <tr>
                                    <td>Cash Out (today)</td>
                                    <td><?php if (!empty($cashOutAmount)) {
                                            echo count($cashOutAmount);
                                        } else {
                                            echo 0;
                                        } ?></td>
                                    <td><?php if (!empty($cashOutAmount)) {
                                            echo '&#8358;' . number_format(array_sum($cashOutAmount), 2);
                                        } else {
                                            echo '&#8358;' . 0;
                                        } ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            <div class="col-lg-6 col-md-6 col-sm-6" id="dash">

                <div class="card-2 card-stats">

                    <!-- ChartJS -->
                    <div class="chart-container">
                        <div class="line-chart-container">
                            <canvas id="line-chartcanvas2"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-6" id="dash">
                <div class="card-2 card-stats">
                    <!-- ChartJS -->
                    <div class="chart tab-pane active">
                        <canvas id="doughnut-chartcanvas-1"></canvas>
                    </div>
                </div>
            </div>



            <div class="col-lg-6 col-md-6 col-sm-6" id="dash">

                <div class="card-2 card-stats">
                    <!-- ChartJS -->
                    <div class="chart tab-pane active">
                        <canvas id="mycanvas"></canvas>
                    </div>
                </div>
            </div>






            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card-3">


                    <div class="card-body">
                        <h6 class="card-title">
                            Recent Transactions
                        </h6>
                        <div class="table-responsive" id="recenttransaction">
                            <table id="myTable" class="table  table-sm">
                                <thead class="text-primary">
                                    <th style="font-size: 15px;">Date</th>
                                    <th style="font-size: 15px;">Service Name</th>
                                    <th style="font-size: 15px;">Amount</th>
                                </thead>
                                <tbody>
                                    <?php

                                    for ($i = 0; $i < 3; $i++) {
                                        //echo $i;




                                        $transaction = json_decode($output[0])->mfsResponseInfo->transactionListInfo->transactionInfo[$i];

                                        //$resu = count($transaction);
                                        //echo $resu . "<br>";


                                        //$eid = $_ESSION[transactionId'];

                                        $transactionId = $transaction->transactionId;
                                        $transactionDate = $transaction->transactionDate;
                                        $serviceName = $transaction->serviceName;
                                        $transactionAmount = $transaction->transactionAmount;
                                        $transId = $_GET['edit'];

                                        echo "<tr>
                                                    <td>" . substr($transactionDate, 0, 10) . "</td>
                                                    <td>$serviceName</td>
                                                    <td>&#8358;" . number_format($transactionAmount) . "</td>
                                                    
                                                    </tr>";

                                        //curl_close($curl);

                                        //echo $transactionId."<br>";
                                    }

                                    ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <script type="text/javascript" src="js/jquery.min.js"></script>
                <script type="text/javascript" src="js/Chart.min.js"></script>
                <script type="text/javascript" src="js/transaction-line.js"></script>
                <script type="text/javascript" src="js/doughnut.js"></script>
                <script type="text/javascript" src="js/bar.js"></script>


                <?php
                include_once('footer.php');
                ?>