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

<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark" style=" font-weight: bold; ">Payment Voucher Request</h1>
        <!--start select catergory-->
        <hr>
        <form action="<?= site_url('FinanceCtrl/gen_approved/'.$ap_bills_voucher->PV_ID);?>" method="post"
            enctype="multipart/form-data" class="needs-validation" novalidate
            onsubmit="return confirm('Are you sure you want to Update?')">
            <div class="row  mb-2">
                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Payment Voucher No.</label>
                    <input type="text" value="<?=$ap_bills_voucher->payment_voucher_no?>" name="voucher_no" readonly
                        class="form-control" style=" font-weight: bold; ">
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

                    <input type="hidden" name="supplier_id" value="" class="form-control" readonly
                        style=" font-weight: bold; ">
                </div>

                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Payment Method</label>
                    <input type="text" name="" value="<?=$ap_bills_voucher->payment_method?>" class="form-control"
                        readonly style=" font-weight: bold; ">

                </div>
            </div>
            <!--end  select catergory-->

            <div class="row">
                <div class="col-3 form-group mb-4">
                    <label for="" style=" font-weight: bold; ">Status</label>
                    <select class="form-select" aria-label="Default select example" style="width:150px" name="status">
                        <option value="<?=$ap_bills_voucher->isPending?>">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="disapproved">Disapproved</option>
                    </select>
                </div>

                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Requested by</label>
                    <input type="text" name=""
                        value="<?=$ap_bills_voucher->First_Name.' '.$ap_bills_voucher->Last_Name?>" class="form-control"
                        readonly style=" font-weight: bold; ">

                </div>
            </div>

    </div>


    <!--Start Table-->

    <div class="card border-success mb-3" style="max-width:100%;" id="card">
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
            <div class="form-outline mb-3">
                <textarea class="form-control" id="textAreaExample" rows="1" name="remarks" readonly
                    required><?=$ap_bills_voucher->remarks?></textarea>
                <label class="form-label" for="textAreaExample"
                    style="font-size:15px; font-weight:bold;">Remarks</label>
            </div>


            <div class="form-outline mb-3">
                <textarea class="form-control" id="textAreaExample" rows="2" name="reason"></textarea>
                <label class="form-label" for="textAreaExample" style="font-size:15px; font-weight:bold;">Reason
                    (optional)</label>
            </div>
        </div>
        <div class=" card-footer bg-transparent border-success text-end">
            <input type="submit" name="btn_approved" value="Post" class="btn_save">
            <a href="<?= site_url('FinanceCtrl/gen_approved_PV')?>"><input type="button" value="Back"
                    class="btn_save"></a>
        </div>
    </div>
    <input type="hidden" name="PV_ID" value="<?=$ap_bills_voucher->PV_ID?>">

    <input class="form-control form-control-lg" type="hidden" name="contact" value="<?=$selectcontact->contact_no?>" />

    <input class="form-control form-control-lg" type="hidden" name="user"
        value="<?=$selectcontact->First_Name.' '.$selectcontact->Last_Name?>" />


    </form>
    <!--End Table-->

    </div>

</main>