<style>
.btn_save {
    width: 80px;
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

<div class="content">
    <div class="container-fluid">
        <h1 class="mb-3">View Purchase Invoice Details</h1>


        <div class="row">
            <div class="col-7 mb-1">
                <h4 class="txt">Purchase Invoice No: <span><?=$view_pi->purchase_invoice_no?></span></h4>
                <h4 class="txt">Reference No: <span><?=$view_pi->purchase_order_no?></span></h4>
                <h4 class="txt">Supplier Name: <span><?=$view_pi->supplier_name?></span></h4>
            </div>
            <div class="col-5">
                <h4 class="txt">Posting Date: <span><?=$view_pi->invoice_date?></span></h4>
                <h4 class="txt">Created By: <span><?=$view_pi->First_Name.' '.$view_pi->Last_Name?></span></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-5">
                <h4 class="txt">Address:
                    <span><?=$view_pi->street.', &nbspBrgy. '.$view_pi->barangay.',&nbsp'.$view_pi->city.', '.$view_pi->province?>.</span>
                </h4>
                <h4 class="txt">Contact No.: <span><?=$view_pi->contact?></span></h4>
                <h4 class="txt">Payment Method: <span><?=ucfirst($view_pi->payment_method)?></span></h4>

            </div>
        </div>

    </div>

    <!--start table-->
    <div class="card border-success mb-3"
        style="max-width: 100%; border-radius:15px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">

        <div class="card-body text-success">
            <table class="table table-bordered" id="table_field">
                <thead>
                    <tr>

                        <th id="table_style">Plate No</th>
                        <th id="table_style">Quantity</th>
                        <th id="table_style">Unit</th>
                        <th id="table_style">Description</th>
                        <th id="table_style">Unit Price</th>
                        <th id="table_style">Amount</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoice_view as $row) { ?>
                    <tr>
                        <td><?=$row->plate_no?></td>
                        <td><?=$row->quantity?></td>
                        <td><?=$row->unit?></td>
                        <td><?=$row->description?></td>
                        <td><?=$row->unit_price?></td>
                        <td><?= number_format((float)$row->amount, 2, '.', ',');?></td>
                    </tr>

                    <?php } ?>

                </tbody>

                <tfoot>
                    <tr>

                        <td colspan="5" class="text-end" style="font-weight:bold">Total Amount</td>
                        <td><?=$view_pi->total_amount?>
                            <input type="hidden" name="balance" value="<?=$view_pi->total_amount?>">
                        </td>

                    </tr>
                </tfoot>

            </table>

        </div>
        <div class=" card-footer bg-transparent border-success text-end">

            <a href="<?= site_url('FinanceCtrl/manager_view_invoice')?>"><input type="button" value="Back"
                    class="btn_save"></a>
        </div>


    </div>

    <!--START TABLE-->

</div>
</div>