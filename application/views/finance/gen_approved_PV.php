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
                    style="font-size:14px; font-weight:bold" role="tab" aria-controls="ex-with-icons-tabs-1"
                    aria-selected="true">Payment Voucher Request</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-2" data-mdb-toggle="tab" href="#ex-with-icons-tabs-2"
                    style="font-size:14px; font-weight:bold" role="tab" aria-controls="ex-with-icons-tabs-2"
                    aria-selected="false">Payment Voucher History</a>
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
                            <table class="table my-0 w-100 row-border-none" id="manage_ap">
                                <thead class="mb-2">
                                    <tr>

                                        <th id="table_style">Payment Voucher No.</th>
                                        <th id="table_style">Supplier Name</th>
                                        <th id="table_style">Requested by</th>
                                        <th id="table_style">Branch</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Posting Date</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Status</th>
                                        <th id="table_style">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_voucher as $row) {?>
                                    <tr>
                                        <td><?=$row->payment_voucher_no?></td>
                                        <td><?=$row->supplier_name?></td>
                                        <td><?=$row->First_Name.' '.$row->Last_Name?></td>
                                        <td><?=$row->branch_name?></td>
                                        <td class="d-none d-xl-table-cell"><?=$row->voucher_date?></td>
                                        <td class="d-none d-xl-table-cell"><span
                                                class="badge bg-danger"><?=ucfirst($row->isPending)?></span>
                                        </td>


                                        <td>
                                            <?php if ($row->payable_type == "Billing") {
                                            ?>
                                            <a href="<?=site_url('FinanceCtrl/gen_approved_bills/'.$row->PV_ID);?>"><i
                                                    class="fa-regular fa-pen-to-square text-center text-center fa-lg"></i></a>
                                            <?php
                                          
                                           }else{
                                            ?>

                                            <a href="<?=site_url('FinanceCtrl/gen_approved/'.$row->PV_ID);?>"><i
                                                    class="fa-regular fa-pen-to-square text-center text-center fa-lg"></i></a>
                                            <?php
                                           }?>

                                        </td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">
                <ldiv class=" row">
                    <div class="card border-success mb-3"
                        style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="card-body">
                            <table class="table my-0 w-100 row-border-none" id="approve">
                                <thead class="mb-2">
                                    <tr>

                                        <th id="table_style">Payment Voucher No.</th>
                                        <th id="table_style">Supplier Name.</th>
                                        <th id="table_style">Requested by</th>
                                        <th id="table_style">Branch</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Posting Date</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Status</th>
                                        <th id="table_style">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_voucher1 as $row) {?>
                                    <tr>

                                        <td><?=$row->payment_voucher_no?></td>
                                        <td><?=$row->supplier_name?></td>
                                        <td><?=$row->First_Name.' '.$row->Last_Name?></td>
                                        <td><?=$row->branch_name?></td>
                                        <td class="d-none d-xl-table-cell"><?=$row->voucher_date?></td>

                                        <?php if ($row->isPending =="approved") {
                                           
                                           ?>
                                        <td class="d-none d-xl-table-cell"><span
                                                class="badge bg-success"><?=ucfirst($row->isPending)?></span>
                                        </td>
                                        <?php
                                        }else{
                                            ?>
                                        <td class="d-none d-xl-table-cell"><span
                                                class="badge bg-danger"><?=ucfirst($row->isPending)?></span>
                                        </td>
                                        <?php
                                        }?>


                                        <td>
                                            <?php if ($row->payable_type == "Billing") {
                                            ?>
                                            <a href="<?=site_url('FinanceCtrl/gen_view_ap_voucher/'.$row->PV_ID);?>"><i
                                                    class="fa-solid fa-eye fa-lg"></i></a>
                                            <?php
                                          
                                           }else{
                                            ?>

                                            <a href="<?=site_url('FinanceCtrl/gen_view_voucher/'.$row->PV_ID);?>"><i
                                                    class="fa-solid fa-eye fa-lg"></i></a>
                                            <?php
                                           }?>

                                        </td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </ldiv>
            </div>

        </div>
        <!-- Tabs content -->



        <!--Start-->



    </div>
</main>