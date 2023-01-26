<main class="content">
    <div class="container-fluid p-0">
        <div class="container-fluid">
            <h3 class="mb-3">Date: <span><?= date('M-d-Y');?></span>
            </h3>
            <div class="row">
                <!--Start-->
                <!--Total Purchase Request-->
                <div class="col-xl-3 col-md-6 mb-5 tbl">
                    <div class="card border-left-primary shadow h-100 py-3 card1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 ">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-3"
                                        style="font-size:15px;">
                                        Total Pending Purchase Request</div>
                                    <div class="h5 mb-0  text-gray-800" style="font-size:30px;"><?=$count_request?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-file-signature fa-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Total Purchase Order-->
                <div class="col-xl-3 col-md-6 mb-5 tbl">
                    <div class="card border-left-primary shadow h-100 py-3 card1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 ">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-3"
                                        style="font-size:15px;">
                                        Total Pending Purchase Order</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size:30px;">
                                        <?= $count_PO?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-file-lines fa-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Purchase Invoice-->
                <div class="col-xl-3 col-md-6 mb-5 tbl">
                    <div class="card border-left-primary shadow h-100 py-3 card1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 ">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-3"
                                        style="font-size:15px;">
                                        Total Pending Purchase Invoice</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size:30px;">
                                        <?= $count_PI?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-receipt fa-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Payment Voucher-->
                <div class="col-xl-3 col-md-6 mb-5 tbl">
                    <div class="card border-left-primary shadow h-100 py-3 card1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 ">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-3"
                                        style="font-size:16px;">
                                        Total Pending Payment Voucher </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size:30px;">
                                        <?= $count_voucher?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-file-invoice fa-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <adiv class="row">
                <div class="col-xl-5 col-xxl-5">
                    <div class="card flex-fill w-100%">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Accounts Payable</h5>
                        </div>
                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                <canvas id="chartjs-dashboard-bar"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3">
                    <div class="card flex-fill w-100%">
                        <div class="card-header bg-transparent border-success">
                            <h3 class="text-center">Upcoming Due</h3>
                        </div>

                        <div class="card-body">
                            <a href="#" style="text-decoration: none; color: black">

                                <div class="row">

                                    <?php  foreach ($schedule_table_ledger as $row) {
                                         $exp_date = $row->isDue_date;
                                         $today_date = date('Y-m-d');
                                        
                                         $exp = strtotime($exp_date);
                                         $td = strtotime($today_date);
                                        
                                             $diff = $td-$exp;
                                             $days = abs(floor($diff / (60*60*24)));
                                        if($row->isStatus != 'Paid'){
                                        
                                           if ($days == 3) {
                                          
                                            ?>
                                    <span style="font-size:15px; font-weight:500;"><?=$row->payable_type?> <span>will
                                            due in
                                            <?=$days?> days</span></span>
                                    <hr>

                                    <?php
                                         }
                                        }
                                        
                                        if ($exp < $td ) {
                                           
                                            ?>
                                    <span style="font-size:16px; font-weight:500;"><?=$row->payable_type?> is
                                        <span><?=$days?> day/s overdue </span></span>
                                    <hr>
                                    <?php
                                           
                                        }

                                    }?>
                                </div>
                            </a>

                        </div>





                    </div>
                </div>
                <!-- Bar End -->


                <div class="col-xl-3 col-xxl-3">
                    <div class="card border-success mb-3" style="width: 100%;">
                        <div class="card-header bg-transparent border-success">
                            <h3 class="text-center">Today's Due</h3>
                        </div>

                        <div class="card-body">
                            <a href="#" class="list-group-item">
                                <div class="row">
                                    <?php  foreach ($schedule_table_ledger as $row) {?>
                                    <?php if($row->isDue_date == $today_date){?>
                                    <?php if($row->isStatus != 'Paid'){?>
                                    <div class="col text-center" style="font-size:15px; font-weight:500;">
                                        <?= ucfirst($row->payable_type)?>
                                        <span> <i class="fa-solid fa-peso-sign"> </i>
                                            <span style="font-weight:bold">
                                                <?=$row->invoice_amount?>

                                            </span>

                                        </span>
                                        <hr>
                                        <?php
                                        } ?>
                                        <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Today Due end -->
            </adiv>
        </div>
    </div>
    </div>

    </div>
</main>