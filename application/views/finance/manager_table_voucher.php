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
        <h1 class="h2 mb-3  text-dark">Manage Payment Voucher</h1>
        <!--Start-->
        <hr>
        <div class=" row">
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="manage_invoice">
                        <thead class="mb-2">
                            <tr>

                                <th id="table_style">Payment Voucher No.</th>
                                <th id="table_style">Supplier</th>
                                <th id="table_style">Created By</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Payment Method</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Total Amount</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Posting Date</th>

                                <th id="table_style" class="d-none d-xl-table-cell">Status</th>
                                <th id="table_style">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($manager_tbl_voucher as $row) { ?>

                            <tr>
                                <td><?= $row->payment_voucher_no?></td>
                                <td><?= $row->supplier_name?></td>
                                <td><?= $row->First_Name.' '.$row->Last_Name?></td>
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
                                    <a href="<?=site_url('FinanceCtrl/manager_ap_view_voucher/'.$row->PV_ID);?>"> <i
                                            class="fa-solid fa-eye fa-lg"></i></a>

                                    <?php
  
                                        }else{

                                            ?>
                                    <a href="<?=site_url('FinanceCtrl/manager_view_PV/'.$row->PV_ID);?>"> <i
                                            class="fa-solid fa-eye fa-lg"></i></a>

                                    <?php
                                        }?>

                                    <!-- End -->
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