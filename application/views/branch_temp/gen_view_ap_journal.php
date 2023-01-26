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
        <h1 class="h2 mb-3  text-dark">View Accounts Payable</h1>
        <!--start select catergory-->
        <hr>
        <form action="<?= site_url('FinanceCtrl/posting_ap/');?>" method="post" class="needs-validation" novalidate
            onsubmit="return confirm('Are you sure?')">


            <div class="card border-success mb-3"
                style="max-width: 100%; border-radius:10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                <div class="card-body ">

                    <rdiv class="row  mb-2">
                        <div class="col-3">
                            <label for="">Billing No.</label>
                            <input type="text" value="<?=$gen_select_ap->billing_no?>" name="reference"
                                class="form-control" readonly>

                        </div>

                        <div class="col-3">
                            <label for="">Supplier</label>
                            <input type="" name="" id="" class="form-control" value="<?=$gen_select_ap->supplier_name?>"
                                readonly>

                        </div>

                        <!--start purchase request no-->
                        <div class="col-3">
                            <label for="">Posting Date</label>
                            <input type="" name="posting_date" id="" class="form-control"
                                value="<?=$gen_select_ap->ap_date?>" readonly>

                        </div>
                        <!--start purchase request no-->
                    </rdiv>
                    <!--end  select catergory-->

                    <div class="row mb-2">


                        <div class="col-3 form-group needs-validation">
                            <label for="">Total Amount</label>
                            <input type="text" name="amount" class="form-control" value="<?=$gen_select_ap->amount?>"
                                readonly>

                        </div>

                        <div class="col-3 form-group">
                            <label for="">Due Date</label>
                            <input type="text" name="due_date" id="" class="form-control" min="<?=date('Y-m-d');?>"
                                value="<?=$gen_select_ap->due_date?>" readonly>
                        </div>

                        <div class="col-3 mt-1">
                            <label for="">Payment Method</label>
                            <input type="text" name="" id="" class="form-control"
                                value="<?=$gen_select_ap->payment_method?>" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-3 mt-1">
                            <label for="">Description</label>
                            <input type="text" name="" id="" class="form-control"
                                value="<?=$gen_select_ap->description?>" readonly>
                        </div>
                        <div class="col-3 mt-1">
                            <label for="">Created By</label>
                            <input type="text" name="" id="" class="form-control"
                                value="<?=$gen_select_ap->First_Name.' '.$gen_select_ap->Last_Name?>" readonly>
                        </div>
                        <div class="col-4 mt-4">
                            <input type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                value="View File">
                        </div>

                    </div>
                </div>
                <div class="card-footer bg-transparent border-success text-end">

                    <a href="<?=site_url('FinanceCtrl/gen_ap_journal');?>"><input type="button" value="Back"
                            class="btn_save"></a>
                </div>
            </div>

        </form>

        <!-- Another Modal Form -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View Accounts Payable Details</h5>
                    </div>

                    <form action="<?= site_url('FinanceCtrl/upload_ap/');?>" method="post" enctype="multipart/form-data"
                        class="needs-validation" novalidate onsubmit="return confirm('Are you sure?')">
                        <div class="modal-body">
                            <img style="width:100% ;" src="<?= base_url('./upload/Bills/'.$gen_select_ap->file)?>"
                                class="mb-4">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</main>