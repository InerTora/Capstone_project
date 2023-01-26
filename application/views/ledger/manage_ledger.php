<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Accounts Payable Ledger</h1>
        <hr>
        <!--Start-->
        <div class=" row">
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="manage_invoice">
                        <thead class="mb-2">
                            <tr>
                                <th style="">Ledger No.</th>
                                <th style="">Reference No.</th>
                                <th style="">Payment Voucher</th>
                                <th style="">Supplier</th>
                                <th style="">Amount</th>
                                <th style="">Due Date</th>
                                <th style="">Status</th>

                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach ($table_ledger as $row) {?>
                            <tr>
                                <td><?=$row->AP_no?></td>
                                <td><?=$row->isReference?></td>
                                <td><?=$row->PV_ID?></td>
                                <td><?=$row->supplier_name?></td>
                                <td><i class="fa-solid fa-peso-sign"></i> <?=$row->invoice_amount?>
                                </td>
                                <td><?=$row->isDue_date?></td>
                                <td>
                                    <?php if ($row->isStatus =="Paid") {
                                       ?>
                                    <span class="badge bg-success"> <?=$row->isStatus?></span>
                                    <?php
                                    }else{

                                        ?>
                                    <span class="badge bg-danger"> <?=$row->isStatus?></span>
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