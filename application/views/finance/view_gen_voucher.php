<style>
.btn_save {
    width: 100px;
    height: 35px;
    background-color: #2146C7;
    color: white;
    font-style: normal;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn_save:hover {
    background: green;
}

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
        <h1 class="h2 mb-3  text-dark" style=" font-weight: bold; "> View Payment Voucher</h1>
        <!--start select catergory-->
        <hr>
        <div class="row  mb-2">
            <div class="col-3">
                <label for="" style=" font-weight: bold; ">Payment Voucher No.</label>
                <input type="text" value="<?=$view_pi->payment_voucher_no?>" name="voucher_no" readonly
                    class="form-control" style=" font-weight: bold; ">
            </div>
            <div class="col-3">
                <label for="" style=" font-weight: bold; ">Posting Date</label>
                <input type="text" name="voucher_date" value="<?=date('Y-m-d'); ?>" class="form-control" readonly
                    style=" font-weight: bold; ">
            </div>
            <div class="col-3">
                <label for="" style=" font-weight: bold; ">Supplier</label>
                <input type="text" name="" value="<?=$view_pi->supplier_name?>" class="form-control" readonly
                    style=" font-weight: bold; ">

                <input type="hidden" name="supplier_id" value="<?=$view_pi->supplier_id?>" class="form-control" readonly
                    style=" font-weight: bold; ">
            </div>
        </div>
        <!--end  select catergory-->
        <div class="row">
            <div class="col-3 form-group mb-4">
                <label for="" style=" font-weight: bold; ">Status</label>
                <input type="text" name="voucher_date" value="<?=ucfirst($view_pi->isPending) ?>" class="form-control"
                    readonly style=" font-weight: bold; ">
            </div>
            <div class="col-3 form-group mb-4">
                <label for="" style=" font-weight: bold; ">Payment Method</label>
                <input type="text" name="voucher_date" value="<?=ucfirst($view_pi->payment_method) ?>"
                    class="form-control" readonly style=" font-weight: bold; ">
            </div>
            <div class="col-3 form-group mb-4">
                <label for="" style=" font-weight: bold; ">Requested By</label>
                <input type="text" name="voucher_date"
                    value="<?=ucfirst($view_pi->First_Name.' '.$view_pi->Last_Name) ?>" class="form-control" readonly
                    style=" font-weight: bold; ">
            </div>
        </div>
    </div>

    <!--Start Table-->

    <div class="card border-success mb-3" style="max-width:100%;" id="card">
        <div class="card-body text-success" id="card-body">
            <table class="table table-bordered" id="">
                <tr>

                    <th style=" font-weight: bold; ">Reference No</th>
                    <th style=" font-weight: bold; ">Description</th>
                    <th style=" font-weight: bold; ">Unit</th>
                    <th style=" font-weight: bold; ">Quantity</th>
                    <th style=" font-weight: bold; ">Unit Price</th>
                    <th style=" font-weight: bold; ">Amount</th>

                </tr>
                <?php foreach ($list_voucher as $row) {?>

                <tr>

                    <td>
                        <?=$row->purchase_invoice_no?>
                        <input type="hidden" value="<?=$row->PI_ID?>" name="PI_ID">
                    </td>
                    <td><?=$row->description?></td>
                    <td><?=$row->unit?></td>
                    <td><?=$row->quantity?></td>
                    <td><?=$row->unit_price?></td>
                    <td><?= number_format((float)$row->amount, 2, '.', ',');?></td>

                </tr>

                <?php } ?>
                <tr>

                    <td colspan="5" class="text-end" style="">Total Amount</td>
                    <td>
                        <i class="fa-solid fa-peso-sign"></i>
                        <?= number_format((float)$view_pi->total_amount, 2, '.', ',');?>
                        <input type="hidden" value="<?=$view_pi->total_amount?>" name="total_amount">
                    </td>

                </tr>
            </table>

        </div>

        <div class=" card-footer bg-transparent border-success text-end">

            <a href="<?= site_url('FinanceCtrl/gen_approved_PV')?>"><input type="button" value="Back"
                    class="btn_save"></a>
        </div>
    </div>


    <!--End Table-->

    </div>

</main>