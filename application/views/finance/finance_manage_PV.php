<style>
#table_style {
    font-size: 15px;
    font-weight: bold;
    color: black;
}

#bt {
    text-transform: none;
    width: 150px;
}
</style>


<main class="content">
    <div class="container-fluid">
        <!-- Tabs navs -->
        <ul class="nav nav-tabs mb-5" id="ex-with-icons" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex-with-icons-tab-1" data-mdb-toggle="tab" href="#ex-with-icons-tabs-1"
                    role="tab" aria-controls="ex-with-icons-tabs-1" aria-selected="true">Payment Voucher Request</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-2" data-mdb-toggle="tab" href="#ex-with-icons-tabs-2"
                    role="tab" aria-controls="ex-with-icons-tabs-2" aria-selected="false">Manage Payment Voucher</a>
            </li>

        </ul>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex-with-icons-content">
            <div class="tab-pane fade show active" id="ex-with-icons-tabs-1" role="tabpanel"
                aria-labelledby="ex-with-icons-tab-1">
                <div class=" row">
                    <div class="card border-success mb-3"
                        style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="card-body">
                            <table class="table my-0 w-100 row-border-none" id="manage_invoice">
                                <thead class="mb-2">
                                    <tr>

                                        <th id="table_style">Payment Voucher No.</th>

                                        <th id="table_style">Supplier</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Payment Method</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Total Amount</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Posting Date</th>

                                        <th id="table_style" class="d-none d-xl-table-cell">Status</th>
                                        <th id="table_style">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_voucher as $row) {?>
                                    <tr>
                                        <td><?= $row->payment_voucher_no?></td>
                                        <td><?= $row->supplier_name?></td>

                                        <td><?= ucfirst($row->payment_method)?></td>
                                        <td class="d-none d-xl-table-cell"><i class="fa-solid fa-peso-sign"></i>
                                            <?= number_format((float)$row->total_amount, 2, '.', ',');?></td>
                                        <td class="d-none d-xl-table-cell"><?= $row->voucher_date?></td>
                                        <?php if ($row->isPending == "approved") {?>

                                        <td class="d-none d-xl-table-cell"><span
                                                class="badge bg-success"><?= ucfirst($row->isPending)?></span>
                                        </td>

                                        <?php }else{
                                ?>
                                        <td class="d-none d-xl-table-cell"><span
                                                class="badge bg-danger"><?= ucfirst($row->isPending)?></span>
                                        </td>
                                        <?php
                                             } ?>
                                        <td>
                                            <!-- Start -->
                                            <?php   if ($row->payable_type =="Billing") {
                                            ?>
                                            <a href="<?=site_url('FinanceCtrl/ap_view_voucher/'.$row->PV_ID);?>"> <i
                                                    class="fa-solid fa-eye fa-lg" data-mdb-toggle="tooltip"
                                                    title="View Voucher Details"></i></a>

                                            <?php
  
                                        }else{

                                            ?>
                                            <a href="<?=site_url('FinanceCtrl/finance_view_PV/'.$row->PV_ID);?>"
                                                data-mdb-toggle="tooltip" title="View Voucher Details"> <i
                                                    class="fa-solid fa-eye fa-lg"></i></a>

                                            <?php
                                        }?>

                                            <!-- End -->
                                        </td>

                                    </tr>
                                    <?php

                            }?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">
                <?=form_open('ReportsCtrl/converttoword')?>
                <div class=" row">
                    <div class="card border-success mb-3"
                        style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="card-body">
                            <table class="table my-0 w-100 row-border-none" id="manage_ap">
                                <thead class="mb-2">
                                    <tr>

                                        <th id="table_style">Payment Voucher No.</th>
                                        <th id="table_style">Supplier</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Payment Method</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Total Amount</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Posting Date</th>

                                        <th id="table_style" class="d-none d-xl-table-cell">Status</th>
                                        <th id="table_style">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tbl_voucher_approved as $row) {?>
                                    <tr>
                                        <td><?= $row->payment_voucher_no?></td>
                                        <td><?= $row->supplier_name?></td>
                                        <td><?= ucfirst($row->payment_method)?></td>
                                        <td class="d-none d-xl-table-cell"><i class="fa-solid fa-peso-sign"></i>
                                            <?= number_format((float)$row->total_amount, 2, '.', ',');?></td>
                                        <td class="d-none d-xl-table-cell"><?= $row->voucher_date?></td>
                                        <?php if ($row->isPending == "approved") {?>

                                        <td class="d-none d-xl-table-cell"><span
                                                class="badge bg-success"><?= ucfirst($row->isPending)?></span>
                                        </td>

                                        <?php }else{
                                ?>
                                        <td class="d-none d-xl-table-cell"><span
                                                class="badge bg-danger"><?= ucfirst($row->isPending)?></span>
                                        </td>
                                        <?php
                                             } ?>
                                        <td>
                                            <!-- Start -->
                                            <?php   if ($row->payable_type =="Billing") {
                                            ?>
                                            <a href="<?=site_url('FinanceCtrl/ap_view_voucher/'.$row->PV_ID);?>"> <i
                                                    class="fa-solid fa-eye fa-lg" data-mdb-toggle="tooltip"
                                                    title="View Voucher Details"></i></a>

                                            <!-- Start -->
                                            <?php if ($row->payment_method =="Cash") {
                                            ?>

                                            <?php if ($row->isPending == "approved") {
                                                  ?>
                                            <a href="<?= site_url('ReportsCtrl/print_voucher_bills/'.$row->PV_ID);?>"
                                                target="_blank"
                                                onclick="return confirm('Are you sure you want to Print?')">
                                                <i class="fa-solid fa-print fa-lg" data-mdb-toggle="tooltip"
                                                    title="Print Voucher"></i></a>

                                            <?php
                                                } ?>


                                            <?php

                                        }else{

                                            ?>
                                            <?php  if ($row->isPending == "approved") {
                                          ?>
                                            <a href="<?= site_url('ReportsCtrl/print_disburse_bills/'.$row->PV_ID);?>"
                                                target="_blank"
                                                onclick="return confirm('Are you sure you want to Print?')">
                                                <i class="fa-solid fa-print fa-lg" data-mdb-toggle="tooltip"
                                                    title="Print Disburse Voucher"></i></a>

                                            <a href="<?= site_url('ReportsCtrl/print_cheque/'.$row->PV_ID);?>"
                                                target="_blank"
                                                onclick="return confirm('Are you sure you want to Print?')">
                                                <i class="fa-sharp fa-solid fa-money-check fa-lg"
                                                    data-mdb-toggle="tooltip" title="Print Cheque"></i></a>

                                            <?php
                                           }?>

                                            </a>

                                            <?php
                                        }?>

                                            <!-- End -->



                                            <?php
  
                                        }else{

                                            ?>
                                            <a href="<?=site_url('FinanceCtrl/finance_view_PV/'.$row->PV_ID);?>"> <i
                                                    class="fa-solid fa-eye fa-lg" data-mdb-toggle="tooltip"
                                                    title="View Voucher Details"></i></a>


                                            <!-- Start -->
                                            <?php if ($row->payment_method =="Cash") {
                                            ?>

                                            <?php  if ($row->isPending == "approved") {
                                            ?>
                                            <a href="<?= site_url('ReportsCtrl/print_voucher/'.$row->PV_ID);?>"
                                                target="_blank"
                                                onclick="return confirm('Are you sure you want to Print?')">
                                                <i class="fa-solid fa-print fa-lg" data-mdb-toggle="tooltip"
                                                    title="Print Voucher"></i></a>

                                            <?php
                                           }?>

                                            <?php

                                        }else{

                                            ?>
                                            <?php  if ($row->isPending == "approved") {
                                            ?>

                                            <a href="<?= site_url('ReportsCtrl/print_disburse_voucher/'.$row->PV_ID);?>"
                                                target="_blank"
                                                onclick="return confirm('Are you sure you want to Print?')">
                                                <i class="fa-solid fa-print fa-lg" data-mdb-toggle="tooltip"
                                                    title="Print Disburse Voucher"></i></a>
                                            <a href="<?= site_url('ReportsCtrl/print_cheque/'.$row->PV_ID);?>"
                                                target="_blank"
                                                onclick="return confirm('Are you sure you want to Print?')">
                                                <i class="fa-sharp fa-solid fa-money-check fa-lg"
                                                    data-mdb-toggle="tooltip" title="Print Cheque"></i>

                                            </a>
                                            <?php
                                           }?>

                                            <?php
                                        }?>

                                            <!-- End -->

                                            <?php
                                        }?>

                                            <!-- End -->
                                        </td>

                                    </tr>
                                    <?php

                            }?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?=form_close()?>
            </div>

        </div>



    </div>
</main>