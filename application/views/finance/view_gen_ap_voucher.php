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
}
</style>


<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark" style=" font-weight: bold; ">View Payment Voucher</h1>
        <!--start select catergory-->
        <hr>

        <div class="row  mb-3">
            <div class="col-3">
                <label for="" style=" font-weight: bold; ">Payment Voucher No.</label>
                <input type="text" value="<?=$ap_view_voucher->payment_voucher_no?>" name="voucher_no" readonly
                    class="form-control" style=" font-weight: bold; ">

            </div>
            <div class="col-3">
                <label for="" style=" font-weight: bold; ">Posting Date</label>
                <input type="text" name="voucher_date" value="<?=$ap_view_voucher->voucher_date?>" class="form-control"
                    readonly style=" font-weight: bold; ">
            </div>
            <div class="col-3 mb-3">
                <label for="" style=" font-weight: bold; ">Supplier</label>
                <input type="text" name="" value="<?=$ap_view_voucher->supplier_name?>" class="form-control" readonly
                    style=" font-weight: bold; ">
            </div>

            <div class="row">
                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Payment Method</label>
                    <input type="text" name="payment_terms" value="<?=ucfirst($ap_view_voucher->payment_method)?>"
                        class="form-control" readonly style=" font-weight: bold; ">
                </div>

                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Requested By</label>
                    <input type="text" name="payment_terms"
                        value="<?=ucfirst($ap_view_voucher->First_Name.' '.$ap_view_voucher->Last_Name)?>"
                        class="form-control" readonly style=" font-weight: bold; ">
                </div>
            </div>


        </div>


        <!--Start Table-->

        <div class="card border-success mt-4" style="max-width:100%;" id="card">
            <div class="card-body text-success" id="card-body">
                <table class="table table-bordered" id="">

                    <thead>
                        <tr>
                            <th id="table_style">Reference No.</th>
                            <th style=" font-weight: bold; ">Total Amount</th>
                            <th id="table_style">Description</th>
                            <th id="table_style">Due Date</th>

                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?=$ap_view_voucher->billing_no?></td>
                            <td><?=$ap_view_voucher->total_amount?></td>

                            <td><?=ucwords($ap_view_voucher->description)?></td>
                            <td><?=$ap_view_voucher->due_date?></td>
                        </tr>
                    </tbody>

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