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
                    style="font-size:12px; font-weight:bold" role="tab" aria-controls="ex-with-icons-tabs-1"
                    aria-selected="true"><i class="fas fa-chart-pie fa-fw me-2"></i>Manage Purchase Order</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-2" data-mdb-toggle="tab" href="#ex-with-icons-tabs-2"
                    role="tab" aria-controls="ex-with-icons-tabs-2" aria-selected="false"
                    style="font-size:12px; font-weight:bold"><i class="fas fa-chart-line fa-fw me-2"></i>Branch Manage
                    Purchase Order</a>
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
                            <table class="table my-0 w-100 row-border-none" id="PRtable">
                                <thead class="mb-2">
                                    <tr>

                                        <th id="table_style">Purchase Order No.</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Supplier</th>

                                        <th id="table_style" class="d-none d-xl-table-cell">Posting Date</th>
                                        <th id="table_style">Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_po as $row){?>
                                    <tr>
                                        <td><?=$row->purchase_order_no?></td>
                                        <td class="d-none d-xl-table-cell"><?=$row->supplier_name?></td>
                                        <td class="d-none d-xl-table-cell"><?=$row->po_date?></td>
                                        <td>
                                            <?php if ($row->payable_type =="Gasoline") {
                                      ?>
                                            <a href="<?= site_url('PurchaseOrderCtrl/view_order/'.$row->PO_ID)?>"><i
                                                    class="fa-solid fa-eye text-center fa-lg"></i></a>
                                            <span>|</span>
                                            <a href="<?= site_url('PurchaseOrderCtrl/print/'.$row->PO_ID);?>"
                                                onclick="return confirm('Are you sure you want to Print?')"
                                                target="_blank"><i class="fa-solid fa-print fa-lg"></i></a>

                                            <?php
                                    }else{

                                        ?>
                                            <a href="<?= site_url('PurchaseOrderCtrl/view_order_sr/'.$row->PO_ID)?>"><i
                                                    class="fa-solid fa-eye text-center fa-lg"></i></a>
                                            <span>|</span>
                                            <a href="<?= site_url('PurchaseOrderCtrl/print_sr/'.$row->PO_ID);?>"
                                                onclick="return confirm('Are you sure you want to Print?')"
                                                target="_blank"><i class="fa-solid fa-print fa-lg"></i></a>
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
                            <table class="table my-0 w-100 row-border-none" id="requesttable">
                                <thead class="mb-2">
                                    <tr>

                                        <th id="table_style">Purchase Order No.</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Supplier</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Created By</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Position</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Branch</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Posting Date</th>

                                        <th id="table_style">Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table_po_branch as $row){?>
                                    <tr>
                                        <td><?=$row->purchase_order_no?></td>
                                        <td class="d-none d-xl-table-cell"><?=$row->supplier_name?></td>
                                        <td class="d-none d-xl-table-cell"><?=$row->First_Name.' '.$row->Last_Name?>
                                        </td>
                                        <td class="d-none d-xl-table-cell"><?=$row->Position?></td>
                                        <td class="d-none d-xl-table-cell"><?=$row->branch_name?></td>
                                        <td class="d-none d-xl-table-cell"><?=$row->po_date?></td>
                                        <td>

                                            <?php if ($row->payable_type =="Gasoline") {
                                          ?>
                                            <a href="<?= site_url('PurchaseOrderCtrl/view_order/'.$row->PO_ID)?>"><i
                                                    class="fa-solid fa-eye text-center fa-lg"></i></a>

                                            <?php
                                           }else{

                                            ?>
                                            <a href="<?= site_url('PurchaseOrderCtrl/view_order_sr/'.$row->PO_ID)?>"><i
                                                    class="fa-solid fa-eye text-center fa-lg"></i></a>

                                            <?php
                                           }?>
                                            </a>

                                        </td>

                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="ex-with-icons-tabs-3" role="tabpanel" aria-labelledby="ex-with-icons-tab-3">
                Tab 3 content
            </div>
        </div>
        <!-- Tabs content -->


        <!--Start-->



    </div>
</main>