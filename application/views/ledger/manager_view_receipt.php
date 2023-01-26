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
        <h1 class="h2 mb-3  text-dark">View Official Receipt</h1>

        <hr>

        <div class="card border-success mb-3" style="max-width: 100%; border-radius:10px">
            <div class="card-body ">

                <div class="row  mb-2">
                    <div class="col-3">
                        <label for="">Reference No.</label>
                        <input type="text" name="reciept_no" id="" class="form-control"
                            value="<?=$select_reciept->reciept_no?>" readonly>

                    </div>

                    <div class="col-3">
                        <label for="">Payment Voucher No</label>
                        <input type="text" name="voucher" class="form-control"
                            value="<?=$select_reciept->payment_voucher_no?>" readonly>
                    </div>
                    <!--start purchase request no-->
                    <div class="col-3">
                        <label for="">Posting Date</label>
                        <input type="text" name="posting_date" value="<?=$select_reciept->posting_date?>"
                            class="form-control" readonly>

                    </div>

                    <div class="col-4 mt-4">
                        <input type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" value="View File">
                    </div>
                    <!--start purchase request no-->
                </div>
                <!--end  select catergory-->

            </div>
            <div class="card-footer bg-transparent border-success text-end">
                <a href="<?=site_url('FinanceCtrl/manager_pa_ledger');?>"><input type="button" value="Back"
                        class="btn_save"></a>
            </div>
        </div>

        <zdiv class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View Official Receipt</h5>
                    </div>


                    <div class="modal-body">
                        <img style="width:100% ;" src="<?= base_url('./upload/Reciept/'.$select_reciept->file)?>"
                            class="mb-4">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>


                </div>
            </div>
        </zdiv>
    </div>

</main>