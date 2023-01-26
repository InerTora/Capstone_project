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
        <ul class="nav nav-tabs mb-3" id="ex-with-icons" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex-with-icons-tab-1" data-mdb-toggle="tab" href="#ex-with-icons-tabs-1"
                    style="font-size:12px; font-weight:bold" role="tab" aria-controls="ex-with-icons-tabs-1"
                    aria-selected="true"></i>Manage Purchase Invoice</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-2" data-mdb-toggle="tab" href="#ex-with-icons-tabs-2"
                    role="tab" aria-controls="ex-with-icons-tabs-2" style="font-size:12px; font-weight:bold"
                    aria-selected="false"></i>Other Branch</a>
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

                                        <th id="table_style">Purchase Invoice No.</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Reference No.</th>
                                        <th id="table_style">Supplier</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Created by</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Total Amount</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Due Date</th>
                                        <th id="table_style">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  foreach ($general_pi_only as $row) { ?>

                                    <tr>
                                        <td><?=$row->purchase_invoice_no?></td>
                                        <td><?=$row->purchase_order_no?></td>
                                        <td><?=$row->supplier_name?></td>
                                        <td><?=$row->First_Name.' '.$row->Last_Name?></td>
                                        <td><i class="fa-solid fa-peso-sign"></i> <?=$row->total_amount?></td>
                                        <td><?=$row->due_date?></td>
                                        <td>

                                            <?php  if ($row->payable_type == "Gasoline") {
                                         ?>
                                            <a href="<?=site_url('FinanceCtrl/gen_view_all_PI/'.$row->PI_ID);?>"><i
                                                    class="fa-solid fa-eye fa-lg"></i></a>

                                            <?php
                                        }else{

                                            ?>
                                            <a href="<?=site_url('FinanceCtrl/gen_view_all_PI_sr/'.$row->PI_ID);?>"><i
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

                </div>
            </div>
            <div class="tab-pane fade" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">
                <div class=" row">
                    <div class="card border-success mb-3"
                        style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="card-body">
                            <table class="table my-0 w-100 row-border-none" id="approve">
                                <thead class="mb-2">
                                    <tr>

                                        <th id="table_style">Purchase Invoice No.</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Reference No.</th>
                                        <th id="table_style">Supplier</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Created by</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Branch</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Total Amount</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Due Date</th>
                                        <th id="table_style">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  foreach ($general_pi_branch as $row) { ?>

                                    <tr>
                                        <td><?=$row->purchase_invoice_no?></td>
                                        <td><?=$row->purchase_order_no?></td>
                                        <td><?=$row->supplier_name?></td>
                                        <td><?=$row->First_Name.' '.$row->Last_Name?></td>
                                        <td><?=$row->branch_name?></td>
                                        <td><i class="fa-solid fa-peso-sign"></i> <?=$row->total_amount?></td>
                                        <td><?=$row->due_date?></td>
                                        <td>
                                            <?php  if ($row->payable_type == "Gasoline") {
                                         ?>
                                            <a href="<?=site_url('FinanceCtrl/gen_view_all_PI/'.$row->PI_ID);?>"><i
                                                    class="fa-solid fa-eye fa-lg"></i></a>

                                            <?php
                                        }else{

                                            ?>
                                            <a href="<?=site_url('FinanceCtrl/gen_view_all_PI_sr/'.$row->PI_ID);?>"><i
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

                </div>
            </div>

        </div>
        <!-- Tabs content -->
        <!--Start-->



    </div>
</main>