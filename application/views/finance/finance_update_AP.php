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
        <h1 class="h2 mb-3  text-dark">Update Accounts Payable</h1>
        <!--start select catergory-->
        <hr>

        <?php  echo form_open_multipart('FinanceCtrl/finance_update_AP/'.$select_ap->AP_ID,
                array('onsubmit'=>'return confirm(\'Are you sure you want to update?\')'));?>
        <div class="card border-success mb-3" style="max-width: 100%; border-radius:10px">
            <div class="card-body ">

                <div class="row  mb-2">
                    <div class="col-3">
                        <label for="">Billing No.</label>
                        <input type="text" value="<?=$select_ap->billing_no?>" name="billing_no" class="form-control"
                            readonly>
                    </div>
                    <div class="col-3 form-group">
                        <label for="">Supplier</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="supplier"
                            style="height:40px" required title="Supplier is required">
                            <option value="<?=$select_ap->supplier_id?>" class="text-info invisible">
                                <?=$select_ap->supplier_name?></option>

                            <?php foreach ($billing_supplier as $row) {?>
                            <option value="<?=$row->supplier_id?>"><?=$row->supplier_name?></option>
                            <?php }?>
                        </select>

                    </div>
                    <!--start purchase request no-->
                    <div class="col-3">
                        <label for="">Posting Date</label>
                        <input type="" name="posting_date" id="" class="form-control" value="<?= $select_ap->ap_date?>"
                            readonly>

                    </div>
                    <!--start purchase request no-->
                </div>
                <!--end  select catergory-->

                <div class="row mb-2">


                    <div class="col-3 form-group needs-validation">
                        <label for="">Total Amount</label>
                        <input type="text" name="amount" class="form-control" value="<?=$select_ap->amount?>"
                            pattern="[0-9,.]+" required title="Total amount should only accept number">

                    </div>

                    <div class="col-3 form-group">
                        <label for="">Due Date</label>
                        <input type="date" name="due_date" id="" class="form-control" min="<?=date('Y-m-d');?>"
                            value="<?=$select_ap->due_date?>" max="<?=date('2025-01-01');?>" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3 mt-1">
                        <label for="">Payment Method</label>
                        <select class="form-select" aria-label="Default select example" name="payment_terms"
                            style="height:30px">
                            <option value="<?=$select_ap->payment_method?>" class="invisible">
                                <?=$select_ap->payment_method?></option>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>
                    <div class="col-4 mt-4">
                        <input type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" value="Attach File">
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-success text-end">
                <input type="submit" name="btn_update_ap" value="Update" class="btn_save">
                <a href="<?=site_url('FinanceCtrl/finance_manage_AP');?>"><input type="button" value="Back"
                        class="btn_save"></a>
            </div>
        </div>
        </form>

        <!-- Another Modal Form -->
        <zdiv class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View Accounts Payable Details</h5>
                    </div>

                    <form action="<?= site_url('FinanceCtrl/upload_ap/'.$select_ap->AP_ID);?>" method="post"
                        enctype="multipart/form-data" class="needs-validation" novalidate
                        onsubmit="return confirm('Are you sure you want to Upload?')">
                        <div class="modal-body">
                            <img style="width:100% ;" src="<?= base_url('./upload/Bills/'.$select_ap->file)?>"
                                class="mb-4">
                            <input type="hidden" value="<?= $select_ap->AP_ID?>" name="ha" class="mb-3">
                            <input type="file" name="ap_image" id="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="btn_upload" id="" value="Upload">
                        </div>

                        <?=form_close()?>
                </div>
            </div>
        </zdiv>
    </div>

</main>