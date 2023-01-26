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

.etxt {
    font-weight: bold;
}

</
</style>

<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark" style=" font-weight: bold; "> View Payment Voucher</h1>
        <!--start select catergory-->
        <hr>

        <div class="row mb-4">
            <div class="col-7 mb-1">
                <h4 class="etxt">Payment Voucher No: <span><?=$view_pi->payment_voucher_no?></span></h4>
                <h4 class="etxt">Supplier Name: <span><?=$view_pi->supplier_name?></span></h4>
                <h4 class="etxt">Payment Method: <span><?=$view_pi->payment_method?></span></h4>
            </div>
            <div class="col-5">
                <h4 class="etxt">Posting Date: <span><?=$view_pi->voucher_date?></span></h4>
                <h4 class="etxt">Created By:
                    <span><?=$view_pi->First_Name.' '.$view_pi->Last_Name?></span>
                </h4>
            </div>
        </div>
    </div>
    <!--Start Table-->

    <div class="card border-success mb-3" style="max-width:100%;" id="card">
        <div class="card-body text-success" id="card-body">
            <table class="table table-bordered" id="">
                <tr>

                    <th style=" font-weight: bold; ">Reference No</th>
                    <th style=" font-weight: bold; ">Quantity</th>
                    <th style=" font-weight: bold; ">Unit</th>
                    <th style=" font-weight: bold; ">Description</th>
                    <th style=" font-weight: bold; ">Unit Price</th>
                    <th style=" font-weight: bold; ">Amount</th>

                </tr>
                <?php foreach ($list_voucher as $row) {?>

                <tr>

                    <td>
                        <?=$row->purchase_invoice_no?>
                        <input type="hidden" value="<?=$row->PI_ID?>" name="PI_ID">
                    </td>

                    <td><?=$row->quantity?></td>
                    <td><?=$row->unit?></td>
                    <td><?=$row->description?></td>
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

            <a href="<?= site_url('FinanceCtrl/manager_table_voucher')?>"><input type="button" value="Back"
                    class="btn_save"></a>
        </div>
    </div>
    <div class="container">
        <div class="col-2">

            <input type="hidden" value="<?=$display_paledger?>" name="paledger_no" readonly class="form-control"
                style=" font-weight: bold; ">
            <input type="hidden" value="<?=$view_pi->PV_ID?>" name="PV_ID" readonly class="form-control"
                style=" font-weight: bold; ">

        </div>
    </div>

    <!--End Table-->

    </div>

</main>