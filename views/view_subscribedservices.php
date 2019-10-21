<?php 
include_once('head.php');
//include('models/transdetails.php');
include('models/subscribed_services.php');


?>


<div class="content">
    <div class="container-fluid">



        <div class="col-md-12">
           <a href="models/subscribed-services-pdf.php"><img id="pdf2" src="img/pdf.png" alt="pdf-download"></a>
            <a href="models/subscribed-services-excel.php"><img id="excel2" src="img/excel.png" alt="excel-download"></a>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-12 tabletop" id="reporthead">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">
                            Subscribed Services
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-hover">
                            <table id="myTable" class="table table-bordered table-sm">
                                <thead class="text-primary">
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(0)">Service Name</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(1)">Fee</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(2)">Fee Min.</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(3)">Fee Max.</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(4)">Commission</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(5)">Commission Min.</th>
                                    <th style="font-size: 15px; font-weight: 400;" onclick="sortTable(6)">Commission Max.</th>
                                </thead>
                                <tbody>
                                    <?php


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




                                            echo "<tr>
                                                    <td style='text-align: left;'>$serviceName</td>
                                                    <td>$fee</td>
                                                    <td>$fee_min</td>
                                                    <td>$fee_max</td>
                                                    <td>$commission</td>
                                                    <td>$commission_min</td>
                                                    <td>$commission_max</td>
                                       
                                                 </tr >";

                                        //curl_close($curl);
                                    }


                                    ?>


                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
               

                
    <?php
    include_once('footer.php')
    ?> 