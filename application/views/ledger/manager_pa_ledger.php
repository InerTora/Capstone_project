<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Paid Accounts Ledger</h1>
        <hr>
        <!--Start-->
        <div class=" row">
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="manage_invoice">
                        <thead class="mb-2">
                            <tr>
                                <th style="">Paid Accounts No.</th>
                                <th style="">Payment Voucher No.</th>
                                <th style="">Supplier</th>
                                <th style="">Paid Amount</th>
                                <th style="">Receipt No</th>
                                <th style="">Posting Date</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($table_pa as $row) {?>

                            <tr>
                                <td><?=$row->PA_no?></td>
                                <td><?=$row->payment_voucher_no?></td>
                                <td><?=$row->supplier_name?></td>
                                <td><i class="fa-solid fa-peso-sign"></i>
                                    <?= number_format((float)$row->total_amount, 2, '.', ',');?>
                                </td>


                                <td>
                                    <a href="<?=site_url("FinanceCtrl/manager_view_receipt/".$row->reciept_id);?>"
                                        style="text-decoration:none;" data-mdb-toggle="tooltip"
                                        title="View Official Receipt">
                                        <?=$row->reciept_no?></a>

                                </td>



                                <td><?=$row->voucher_date?></td>

                            </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>
</main>