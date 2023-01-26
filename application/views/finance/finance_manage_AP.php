<main class="content">
    <div class="container-fluid">
        <!-- Tabs navs -->
        <ul class="nav nav-tabs mb-5" id="ex-with-icons" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex-with-icons-tab-1" data-mdb-toggle="tab" href="#ex-with-icons-tabs-1"
                    style="font-size:14px; font-weight:bold" role="tab" aria-controls="ex-with-icons-tabs-1"
                    aria-selected="true"><i class="fas fa-chart-pie fa-fw me-2"></i>Manage Accounts Payable</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-2" data-mdb-toggle="tab" href="#ex-with-icons-tabs-2"
                    role="tab" aria-controls="ex-with-icons-tabs-2" style="font-size:14px; font-weight:bold"
                    aria-selected="false"><i class="fas fa-chart-line fa-fw me-2"></i>Posted Accounts Payable</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-3" data-mdb-toggle="tab" href="#ex-with-icons-tabs-3"
                    role="tab" aria-controls="ex-with-icons-tabs-3" style="font-size:14px; font-weight:bold"
                    aria-selected="false"><i class="fas fa-cogs fa-fw me-2"></i>Manage Official Receipt</a>
            </li>
        </ul>

        <!-- Tabs content -->
        <div class="tab-content" id="ex-with-icons-content">
            <div class="tab-pane fade show active" id="ex-with-icons-tabs-1" role="tabpanel"
                aria-labelledby="ex-with-icons-tab-1">
                <sdiv class=" row">
                    <div class="card border-success mb-3"
                        style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="card-body">
                            <table class="table my-0 w-100 row-border-none" id="manage_invoice">
                                <thead class="mb-2">
                                    <tr>

                                        <th style="">Billing No.</th>
                                        <th style="">Supplier</th>

                                        <th style="">Payment Method</th>
                                        <th style="">Amount</th>
                                        <th style="">Posting Date</th>
                                        <th style="">Due Date</th>

                                        <th style="">Status</th>
                                        <th style="">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_ap as $row) { ?>
                                    <tr>
                                        <td><?=$row->billing_no?></td>
                                        <td><?=$row->supplier_name?></td>
                                        <td><?=Ucfirst($row->payment_method)?></td>
                                        <td><i class="fa-solid fa-peso-sign"></i>
                                            <?= number_format((float)$row->amount, 2, '.', ',');?>
                                        </td>

                                        <td><?=$row->ap_date?></td>
                                        <td><?=$row->due_date?></td>

                                        <td><?=$row->isStatus?></td>
                                        <td>
                                            <a href="<?=site_url('FinanceCtrl/finance_view_AP/'.$row->AP_ID);?>"><i
                                                    class="fa-solid fa-eye fa-lg" data-mdb-toggle="tooltip"
                                                    title="View A.P Details"></i></a>
                                            <span></span>
                                            <a href="<?=site_url('FinanceCtrl/finance_update_AP/'.$row->AP_ID);?>"
                                                data-mdb-toggle="tooltip" title="Update A.P Details">
                                                <i
                                                    class="fa-regular fa-pen-to-square text-center text-center fa-lg"></i></a>
                                        </td>
                                    </tr>

                                    <?php }?>


                                </tbody>
                            </table>
                        </div>
                    </div>

                </sdiv>

            </div>
            <div class="tab-pane fade" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">
                <sdiv class=" row">
                    <div class="card border-success mb-3"
                        style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="card-body">
                            <table class="table my-0 w-100 row-border-none" id="approve">
                                <thead class="mb-2">
                                    <tr>

                                        <th style="">Billing No.</th>
                                        <th style="">Supplier</th>

                                        <th style="">Payment Method</th>
                                        <th style="">Amount</th>
                                        <th style="">Posting Date</th>
                                        <th style="">Due Date</th>

                                        <th style="">Status</th>
                                        <th style="">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_ap1 as $row) { ?>
                                    <tr>
                                        <td><?=$row->billing_no?>
                                            <input type="hidden" name="AP_ID" value="<?=$row->AP_ID?>">
                                        </td>
                                        <td><?=$row->supplier_name?></td>
                                        <td><?=Ucfirst($row->payment_method)?></td>
                                        <td><i class="fa-solid fa-peso-sign"></i>
                                            <?= number_format((float)$row->amount, 2, '.', ',');?>
                                        </td>
                                        <td><?=$row->ap_date?></td>
                                        <td><?=$row->due_date?></td>

                                        <td><?=$row->isStatus?></td>
                                        <td>
                                            <a href="<?=site_url('FinanceCtrl/finance_view_AP/'.$row->AP_ID);?>"><i
                                                    class="fa-solid fa-eye fa-lg" data-mdb-toggle="tooltip"
                                                    title="View A.P Details"></i></a>
                                            <span></span>
                                            <?php if ($row->isHide =="1") {
                                                ?>

                                            <a href="<?=site_url('FinanceCtrl/ap_bills_voucher/'.$row->AP_ID);?>"
                                                onclick="return confirm('Are you sure you want to create voucher?')"
                                                data-mdb-toggle="tooltip" title="Create Voucher"><i
                                                    class="fa-solid fa-share-from-square fa-lg"></i></a>
                                            <?php
                                          
                                           }?>


                                        </td>
                                    </tr>

                                    <?php }?>


                                </tbody>
                            </table>

                        </div>
                    </div>

                </sdiv>


            </div>
            <div class="tab-pane fade" id="ex-with-icons-tabs-3" role="tabpanel" aria-labelledby="ex-with-icons-tab-3">
                <div class=" row">
                    <div class="card border-success mb-3"
                        style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="card-body">
                            <table class="table my-0 w-100 row-border-none" id="manage_ap">
                                <thead class="mb-2">
                                    <tr>

                                        <th>Receipt No.</th>
                                        <th>Payment Voucher No.</th>
                                        <th>Posting Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($payment_receipt as $row) {
                           ?>
                                    <tr>
                                        <td><?=$row->reciept_no?></td>
                                        <td><?=$row->payment_voucher_no?></td>
                                        <td><?=$row->posting_date?></td>
                                        <td><a href="<?=site_url('FinanceCtrl/view_receipt/'.$row->reciept_id);?>"><i
                                                    class="fa-solid fa-eye fa-lg"></i></a>
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
        </div>
        <!-- Tabs content -->


    </div>
</main>