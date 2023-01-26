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

.etxt {
    font-weight: bold;
}
</style>


<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark" style=" font-weight: bold; ">View Payment Voucher</h1>
        <!--start select catergory-->
        <hr>

        <div class="row">
            <div class="col-7 mb-1">
                <h4 class="etxt">Payment Voucher No: <span><?=$ap_view_voucher->payment_voucher_no?></span></h4>
                <h4 class="etxt">Supplier Name: <span><?=$ap_view_voucher->supplier_name?></span></h4>
                <h4 class="etxt">Payment Method: <span><?=$ap_view_voucher->payment_method?></span></h4>
            </div>
            <div class="col-5">
                <h4 class="etxt">Posting Date: <span><?=$ap_view_voucher->voucher_date?></span></h4>
                <h4 class="etxt">Created By:
                    <span><?=$ap_view_voucher->First_Name.' '.$ap_view_voucher->Last_Name?></span>
                </h4>
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


                <a href="<?= site_url('FinanceCtrl/manager_table_voucher')?>"><input type="button" value="Back"
                        class="btn_save"></a>
            </div>
        </div>
        <!--End Table-->

    </div>

</main>