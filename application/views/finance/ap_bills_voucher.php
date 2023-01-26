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
        <h1 class="h2 mb-3  text-dark" style=" font-weight: bold; ">Create Payment Voucher</h1>
        <!--start select catergory-->
        <hr>

        <form action="<?= site_url('FinanceCtrl/ap_bills_voucher/'.$ap_bills_voucher->AP_ID);?>" method="post"
            enctype="multipart/form-data" class="needs-validation" novalidate
            onsubmit="return confirm('Are you sure you want to Create?')">

            <input type="hidden" name="id_pi[]" value="">


            <div class="row  mb-2">
                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Payment Voucher No.</label>
                    <input type="text" value="<?=$display_voucher?>" name="voucher_no" readonly class="form-control"
                        style=" font-weight: bold; ">

                </div>
                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Posting Date</label>
                    <input type="text" name="voucher_date" value="<?=date('Y-m-d'); ?>" class="form-control" readonly
                        style=" font-weight: bold; ">
                </div>
                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Supplier</label>
                    <input type="text" name="" value="<?=$ap_bills_voucher->supplier_name?>" class="form-control"
                        readonly style=" font-weight: bold; ">
                    <input type="hidden" name="supplier_id" value="<?=$ap_bills_voucher->supplier_id?>"
                        class="form-control" readonly style=" font-weight: bold; ">


                </div>
                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Payment Method</label>
                    <input type="text" name="payment_terms" value="<?=ucfirst($ap_bills_voucher->payment_method)?>"
                        class="form-control" readonly style=" font-weight: bold; ">
                </div>
                <input type="hidden" name="category" value="">
                <!--end  select catergory-->
            </div>


            <!--Start Table-->

            <kdiv class="card border-success mt-4" style="max-width:100%;" id="card">
                <div class="card-body text-success" id="card-body">
                    <table class="table table-bordered" id="">


                        <thead>
                            <tr>
                                <th id="table_style">Reference No.</th>
                                <th style=" font-weight: bold; ">Total Amount</th>
                                <th style=" font-weight: bold; ">Description</th>
                                <th id="table_style">Due Date</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td>
                                    <?=$ap_bills_voucher->billing_no?>
                                    <input type="hidden" name="AP_ID" value="<?=$ap_bills_voucher->AP_ID?>">
                                </td>

                                <td>
                                    <?=$ap_bills_voucher->amount?>
                                    <input type="hidden" name="amount" value="<?=$ap_bills_voucher->amount?>">
                                </td>
                                <td><?=$ap_bills_voucher->description?></td>
                                <td><?=$ap_bills_voucher->due_date?></td>
                            </tr>
                        </tbody>

                    </table>
                    <div class="form-outline">
                        <textarea class="form-control" id="textAreaExample" rows="2" name="remarks" required></textarea>
                        <label class="form-label" for="textAreaExample"
                            style="font-size:15px; font-weight:bold;">Remarks</label>
                    </div>
                </div>
                <div class=" card-footer bg-transparent border-success text-end">

                    <input type="submit" value="Create" name="btn_voucher" class="btn_save">


                    <a href="<?= site_url('financeCtrl/finance_manage_AP')?>"><input type="button" value="Back"
                            class="btn_save"></a>
                    <input type="hidden" value="" name="PI_ID">

                    <input class="form-control form-control-lg" type="hidden" name="contact"
                        value="<?=$sms->contact_no?>" />
                    <input class="form-control form-control-lg" type="hidden" name="message"
                        value=" iDrive Driving Tutorial - <?=$sms_branch->branch_name?>, posted a payment voucher request." />
                </div>
            </kdiv>
        </form>
        <!--End Table-->

    </div>

</main>