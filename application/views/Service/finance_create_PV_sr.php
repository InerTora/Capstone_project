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

        <form action="<?= site_url('FinanceCtrl/add_payment_voucher');?>" method="post" enctype="multipart/form-data"
            class="needs-validation" novalidate onsubmit="return confirm('Are you sure you want to Create?')">
            <?php foreach ($getPV1 as $row) {
  ?>
            <input type="hidden" name="id_pi[]" value="<?=$row->PI_ID?>">

            <?php
}?>
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
                    <input type="text" name="" value="<?=$get_supplier_pv->supplier_name?>" class="form-control"
                        readonly style=" font-weight: bold; ">

                    <input type="hidden" name="supplier_id" value="<?=$get_supplier_pv->supplier_id?>"
                        class="form-control" readonly style=" font-weight: bold; ">

                </div>
                <div class="col-3">
                    <label for="" style=" font-weight: bold; ">Payment Method</label>
                    <input type="text" name="payment_terms" value="<?=ucfirst($get_supplier_pv->payment_method)?>"
                        class="form-control" readonly style=" font-weight: bold; ">
                </div>
                <input type="hidden" name="category" value="<?=$get_supplier_pv->category?>">
                <!--end  select catergory-->
            </div>


            <!--Start Table-->

            <div class="card border-success mt-4" style="max-width:100%;" id="card">
                <div class="card-body text-success" id="card-body">
                    <table class="table table-bordered" id="">
                        <tbody>
                            <tr>

                                <th id="table_style">Reference No.</th>
                                <th style=" font-weight: bold; ">Plate No</th>
                                <th id="table_style">Description</th>
                                <th id="table_style">Unit</th>
                                <th id="table_style">Quantity</th>
                                <th id="table_style">Unit Price</th>
                                <th id="table_style">Amount</th>

                            </tr>

                            <?php foreach ($getPV as $row) {?>

                            <tr>
                                <td>
                                    <?=$row->purchase_invoice_no?>
                                    <input type="hidden" value="<?=$row->PI_ID?>" name="pi_id[]">
                                </td>


                                <td>
                                    <?=$row->plate_no?>
                                    <input type="hidden" value="<?=$row->car_id?>" name="car_id[]">
                                </td>

                                <td>
                                    <?=$row->quantity?>
                                    <input type="hidden" value="<?=$row->quantity?>" name="quantity[]">
                                </td>
                                <td>
                                    <?=$row->unit?>
                                    <input type="hidden" value="<?=$row->unit?>" name="unit[]">
                                </td>
                                <td>
                                    <?=$row->description?>
                                    <input type="hidden" value="<?=$row->description?>" name="description[]">
                                </td>
                                <td>
                                    <?=$row->unit_price?>
                                    <input type="hidden" value="<?=$row->unit_price?>" name="unit_price[]">
                                </td>
                                <td>
                                    <input type="hidden" value="<?=$row->amount?>" name="amount[]">
                                    <?= number_format((float)$row->amount, 2, '.', ',');?>

                                </td>

                                <?php }?>
                            </tr>
                            <tr>

                                <td colspan="6" class="text-end" id="table_style">Total Amount</td>
                                <td>
                                    <input type="hidden" value="<?=$check_amount?>" name="total_amount">
                                    <?= number_format((float)$check_amount, 2, '.', ',');?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class=" card-footer bg-transparent border-success text-end">
                    <input type="submit" value="Create" name="btn_voucher" class="btn_save">
                    <a href="<?= site_url('financeCtrl/finance_approve_PV')?>"><input type="button" value="Back"
                            class="btn_save"></a>
                    <input type="hidden" value="" name="PI_ID">

                    <input class="form-control form-control-lg" type="hidden" name="contact"
                        value="<?=$sms->contact_no?>" />
                    <input class="form-control form-control-lg" type="hidden" name="message"
                        value=" iDrive Driving Tutorial - <?=$sms_branch->branch_name?>, posted a payment voucher request." />
                </div>
            </div>
        </form>
        <!--End Table-->

    </div>

</main>