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
        <h1 class="h2 mb-3  text-dark" style=" font-weight: bold; ">Create Accounts Payable</h1>
        <!--start select catergory-->
        <hr>
        <?php  echo form_open_multipart('FinanceCtrl/finance_create_AP',
                array('onsubmit'=>'return confirm(\'Are you sure you want to Create?\')'));?>
        <div class="card border-success mb-3" style="max-width: 100%; border-radius:10px">
            <div class="card-body ">

                <div class="row  mb-2">
                    <div class="col-3">
                        <label for="">Billing No.</label>
                        <input type="text" value="<?= $display_bill?>" name="billing_no" class="form-control" readonly>
                    </div>

                    <div class="col-3 form-group">
                        <label for="">Supplier</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="supplier"
                            style="height:40px" required title="Supplier is required">
                            <option value="" class="text-info invisible">Select Supplier</option>

                            <?php foreach ($billing_supplier as $row) {?>
                            <option value="<?=$row->supplier_id?>"><?=$row->supplier_name?></option>
                            <?php }?>
                        </select>

                    </div>

                    <!--start purchase request no-->
                    <div class="col-3">
                        <label for="">Posting Date</label>
                        <input type="" name="posting_date" id="" class="form-control" value="<?= date('Y-m-d');?>"
                            readonly min="<?=date('Y-m-d');?>" title="This date is not allowed">

                    </div>

                    <!--start purchase request no-->
                </div>
                <!--end  select catergory-->

                <div class="row mb-2">


                    <div class="col-3 form-group">
                        <label for="">Total Amount</label>
                        <input type="text" name="total_amount" pattern="[0-9,.]+" class="form-control" required
                            title="Total amount should only accept number">

                    </div>

                    <div class="col-3 form-group">
                        <label for="">Due Date</label>
                        <input type="date" name="due_date" id="" class="form-control" min="<?=date('Y-m-d');?>" required
                            max="<?=date('2025-01-01');?>">
                    </div>
                    <div class="col-3 mt-2">
                        <label for="">Payment Method</label>
                        <select class="form-select" aria-label="Default select example" name="payment_terms"
                            style="height:30px">
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">


                    <div class="col-4">
                        <label for="formFile" class="form-label">Attach File</label>
                        <input class="form-control" type="file" id="formFile" name="image_ap" style="height:30px">
                    </div>

                    <div class="col-4">
                        <label for="formFile" class="form-label">Description</label>
                        <input class="form-control" type="text" id="formFile" name="description">
                    </div>
                </div>

            </div>
            <div class="card-footer bg-transparent border-success text-end">
                <input type="submit" name="btn_ap" id="" class="btn_save" value="Create" class="btn_save">
                <a href="<?=site_url('financeCtrl/finance_manage_AP');?>"><input type="button" value="Back"
                        class="btn_save"></a>
            </div>
        </div>
        <?= form_close()?>
    </div>

</main>