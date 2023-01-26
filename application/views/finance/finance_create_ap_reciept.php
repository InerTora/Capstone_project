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
    font-weight: 400px
}
</style>

<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Upload Official Receipt</h1>

        <hr>

        <?php  echo form_open_multipart('FinanceCtrl/finance_create_ap_reciept/'.$get_voucher_receipt->PV_ID,
                array('onsubmit'=>'return confirm(\'Are you sure you want to Create?\')'));?>
        <div class="card border-success mb-3" style="max-width: 100%; border-radius:10px">
            <div class="card-body ">

                <div class="row  mb-2">
                    <div class="col-3">
                        <label for="">Reference No.</label>
                        <input type="text" name="reciept_no" id="" class="form-control" value="<?= $display_reciept?>"
                            readonly>
                        <input type="hidden" name="reciept_id" id="" class="form-control" value="<?= $reciept_no?>"
                            readonly>


                    </div>

                    <div class="col-3">
                        <label for="">Payment Voucher No</label>
                        <input type="text" name="voucher" class="form-control"
                            value="<?=$get_voucher_receipt->payment_voucher_no?>" readonly>


                        <input type="hidden" name="ref_voucher" id="" class="form-control"
                            value="<?=$get_voucher_receipt->PV_ID?>" readonly>
                    </div>
                    <!--start purchase request no-->
                    <div class="col-3">
                        <label for="">Posting Date</label>
                        <input type="text" name="posting_date" value="<?=date('Y-m-d');?>" class="form-control"
                            readonly>


                    </div>
                    <!--start purchase request no-->
                </div>
                <!--end  select catergory-->

                <div class="row mb-3">
                    <div class="col-4">
                        <label for="formFile" class="form-label">Attach File</label>
                        <input class="form-control" type="file" id="formFile" style="height:30px" name="reciept_image">
                    </div>
                </div>

            </div>
            <div class="card-footer bg-transparent border-success text-end">
                <input type="submit" name="btn_reciept" class="btn_save" value="Upload">
            </div>
        </div>


        <!-- End -->
        <input type="hidden" value="<?=$view_pi->AP_ID?>" name="AP_ID">
        <input type="hidden" value="<?=$view_pi->total_amount?>" name="amount">
        <input type="hidden" value="<?=$auto_number_pa_ledger?>" name="paledger_no">
        <input type="hidden" value="<?=$view_pi->PV_ID?>" name="PV_ID">
        <?=form_close();?>
    </div>

</main>