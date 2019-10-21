<?php
include('head.php');
include('models/transactionsDetails.php');

?>


<div class="content" id="details">
    <div class="container-fluid">
        <h3 class="text-primary">Transaction Details</h3>
        <a href="index.php?controller=transactions&count=10" class="btn btn-custom"><i class="fa fa-arrow-circle-left"></i> Back</a>

        <div class="row">

            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-sm">
                                    <thead class=" text-primary" style="background: #e6e1e6;">
                                        <th style="font-size: 15px; font-weight: 400; width: 150px;">Transaction ID</th>
                                        <th style="font-size: 15px; font-weight: 400; width: 150px;">Transaction Status</th>
                                        <th style="font-size: 15px; font-weight: 400; width: 150px;">Transaction Amount</th>
                                        <th style="font-size: 15px; font-weight: 400; width: 150px;">Transaction Date</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $mfsResponseInfo->transactionId; ?>
                                            </td>
                                            <td>
                                                <?php echo $mfsResponseInfo->transactionStatus; ?>
                                            </td>
                                            <td>&#8358;
                                                <?php echo number_format($mfsResponseInfo->transactionAmount); ?>
                                            </td>
                                            <td>
                                                <?php echo substr($mfsResponseInfo->transactionDate, 0, 19); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br><br>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-sm">

                                    <thead class="text-primary" style="background: #e6e1e6;">
                                        <th style="font-size: 15px; font-weight: 400; width: 150px;">Transaction Fee</th>
                                        <th style="font-size: 15px; font-weight: 400; width: 150px;">Sender Name</th>
                                        <th style="font-size: 15px; font-weight: 400; width: 150px;">Sender MSISDN</th>
                                        <th style="font-size: 15px; font-weight: 400; width: 150px;">Service Name</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php if (!empty($mfsResponseInfo->senderName)) {
                                                    echo '&#8358; ' . number_format($mfsResponseInfo->transactionFees);
                                                } else {
                                                    echo "<i class='text-muted'>NULL</i>";
                                                }; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($mfsResponseInfo->senderName)) {
                                                    echo 'Test';
                                                } else {
                                                    echo "<i class='text-muted'>NULL</i>";
                                                }; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($mfsResponseInfo->senderMsisdn)) {
                                                    echo '08165666666';
                                                } else {
                                                    echo "<i class='text-muted'>NULL</i>";
                                                }; ?>
                                            </td>
                                            <td>
                                                <?php
                                                //$bankName = $transact_bank->info[5]->key;
                                                if (!empty($serviceName)) {
                                                    echo 'Test';
                                                } else {
                                                    echo "<i class='text-muted'>NULL</i>";
                                                } ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <br><br>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-sm">

                                    <thead class="text-primary" style="background: #e6e1e6;">
                                        <th style="font-size: 15px; font-weight: 400; width: 150px;">Transaction Info</th>
                                        <th style="font-size: 15px; font-weight: 400; width: 150px;">Receiver MSISDN</th>
                                        <th style="font-size: 15px; font-weight: 400; width: 150px;">Bank Name</th>
                                        <th style="font-size: 15px; font-weight: 400; width: 150px;">Beneficiary Account ID</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php if (!empty($mfsResponseInfo->transactionInfo)) {
                                                    echo $mfsResponseInfo->transactionInfo;
                                                } else {
                                                    echo 'NULL';
                                                }; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($mfsResponseInfo->receiverMsisdn)) {
                                                    echo '080555555555';
                                                } else {
                                                    echo 'NULL';
                                                }; ?>
                                            </td>
                                            <td>
                                                <?php
                                                //$bankName = $transact_bank->info[5]->key;
                                                if (!empty($bankName)) {
                                                    echo 'First Bank';
                                                } else {
                                                    echo "<i class='text-muted'>NULL</i>";
                                                } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (!empty($beneficiaryAccountNumber)) {
                                                    echo '01234567890';
                                                } else {
                                                    echo "<i class='text-muted'>NULL</i>";
                                                } ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br><br>

                    </div>
                </div>



                <?php
                include_once('footer.php');
                ?>