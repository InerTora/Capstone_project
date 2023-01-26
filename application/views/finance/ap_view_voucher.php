<style>
.btn_save {
    width: 120px;
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
        <form action="<?= site_url('FinanceCtrl/Post_to_paledger');?>" method="post" enctype="multipart/form-data"
            class="needs-validation" novalidate onsubmit="return confirm('Are you sure you want to post?')">
            <div class="row  mb-2">
                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Payment Voucher No.</label>
                    <input type="text" value="<?=$ap_view_voucher->payment_voucher_no?>" name="voucher_no" readonly
                        class="form-control" style=" font-weight: bold; ">

                </div>
                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Posting Date</label>
                    <input type="text" name="voucher_date" value="<?=$ap_view_voucher->voucher_date?>"
                        class="form-control" readonly style=" font-weight: bold; ">
                </div>
                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Supplier</label>
                    <input type="text" name="" value="<?=$ap_view_voucher->supplier_name?>" class="form-control"
                        readonly style=" font-weight: bold; ">


                </div>
                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Payment Method</label>
                    <input type="text" name="payment_terms" value="<?=ucfirst($ap_view_voucher->payment_method)?>"
                        class="form-control" readonly style=" font-weight: bold; ">
                </div>
                <input type="hidden" name="category" value="">
                <!--end  select catergory-->
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



                    <div class="form-outline">

                        <?php if ($ap_view_voucher->isPending =="disapproved") {
                            ?>
                        <textarea class="form-control" id="textAreaExample" rows="2" readonly
                            name="reason"><?=$ap_view_voucher->reason?></textarea>
                        <label class="form-label" for="textAreaExample"
                            style="font-size:15px; font-weight:bold;">Reason</label>
                        <?php
                      
                    }?>

                    </div>
                </div>
                <div class=" card-footer bg-transparent border-success text-end">

                    <?php  if ($ap_view_voucher->hide == "1" && $ap_view_voucher->isPending == "approved") {
                           ?>
                    <a href="<?= site_url('FinanceCtrl/finance_create_ap_reciept/'.$ap_view_voucher->PV_ID)?>"><input
                            type="button" value="Upload Receipt" class="btn_save"
                            onclick="return confirm('Are you sure you want to create receipt?')"></a>

                    <?php
                        }?>

                    <a href="<?= site_url('FinanceCtrl/finance_manage_PV')?>"><input type="button" value="Back"
                            class="btn_save"></a>
                </div>
            </div>
            <!--End Table-->

    </div>

</main>