<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Manage Purchase Order</h1>
        <hr>
        <!--Start-->
        <div class=" row">
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="PRtable">
                        <thead class="mb-2">
                            <tr>

                                <th style="font-size:15px; font-weight:400px">Purchase Order No</th>
                                <th style="font-size:15px; font-weight:400px">Supplier</th>
                                <th style="font-size:15px; font-weight:400px">Created By</th>
                                <th style="font-size:15px; font-weight:400px">Posting Date</th>
                                <th style="font-size:15px; font-weight:400px">Status</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($table_po as $row){?>
                            <tr>
                                <td><?=$row->purchase_order_no?></td>
                                <td><?=$row->supplier_name?></td>
                                <td><?=$row->First_Name.' '.$row->Last_Name?></td>
                                <td><?=$row->po_date?></td>
                                <td>
                                    <?php if ($row->payable_type =="Gasoline") {
                                      ?>
                                    <a href="<?= site_url('PurchaseOrderCtrl/branch_view_order/'.$row->PO_ID)?>"><i
                                            class="fa-solid fa-eye text-center fa-lg"></i></a>
                                    <span>|</span>
                                    <a href="<?= site_url('PurchaseOrderCtrl/print/'.$row->PO_ID);?>"
                                        onclick="return confirm('Are you sure you want to Print?')" target="_blank"><i
                                            class="fa-solid fa-print fa-lg"></i></a>

                                    <?php
                                    }else{

                                        ?>
                                    <a href="<?= site_url('PurchaseOrderCtrl/branch_view_order_sr/'.$row->PO_ID)?>"><i
                                            class="fa-solid fa-eye text-center fa-lg"></i></a>
                                    <span>|</span>
                                    <a href="<?= site_url('PurchaseOrderCtrl/print_sr/'.$row->PO_ID);?>"
                                        onclick="return confirm('Are you sure you want to Print?')" target="_blank"><i
                                            class="fa-solid fa-print fa-lg"></i></a>
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
</main>