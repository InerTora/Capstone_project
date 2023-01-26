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
        <h1 class="h2 mb-3  text-dark" style=" font-weight: bold; ">Create Purchase Invoice</h1>
        <!--start select catergory-->
        <hr>

        <?php  echo form_open_multipart('FinanceCtrl/finance_create_PI/'.$get_po_details->PO_ID,
                array('onsubmit'=>'return confirm(\'Are you sure you want to Create?\')'));?>
        <div class="row  mb-2">
            <div class="col-3">
                <label for="" style=" font-weight: bold; ">Purchase Invoice No.</label>
                <input type="text" value="<?=$display_PI?>" name="PI_code" readonly class="form-control"
                    style=" font-weight: bold; ">
            </div>
            <div class="col-3">
                <label for="" style=" font-weight: bold; ">Posting Date</label>
                <input type="text" name="invoice_date" value="<?=date('Y-m-d'); ?>" class="form-control" readonly
                    style=" font-weight: bold; ">
            </div>
            <!--start purchase request no-->
            <div class="col-3">
                <label for="" style=" font-weight: bold; ">Purchase Order No.</label>

                <input type="text" name="" value="<?=$get_po_details->purchase_order_no?>" class="form-control" readonly
                    style=" font-weight: bold; ">
                <input type="hidden" name="PO_no" value="<?=$get_po_details->PO_ID?>" class="form-control" readonly
                    style=" font-weight: bold; ">


            </div>
            <!--start purchase request no-->
        </div>
        <!--end  select catergory-->

        <div class="row mb-2">
            <div class="col-3 form-group">
                <label for="" style=" font-weight: bold; ">Supplier</label>
                <input type="text" name="" value="<?=$get_po_details->supplier_name?>" class="form-control" readonly
                    style=" font-weight: bold; ">

                <input type="hidden" name="supplier_id" value="<?=$get_po_details->supplier_id?>" class="form-control"
                    readonly style=" font-weight:bold;">
            </div>

            <div class="col-3 form-group">
                <label for="" style=" font-weight: bold; ">Due Date</label>
                <input type="date" name="pi_due" id="" class="form-control" style=" font-weight: bold;"
                    min="<?=date('Y-m-d');?>" max="<?=date('2025-01-01');?>" required>
                <small style="color:red;"><?php echo form_error('pi_due'); ?></small>
            </div>

            <div class="col-3 form-group">
                <label for="" style=" font-weight: bold; ">Payment Method</label>
                <input type="text" name="payment_terms" class="form-control" readonly style=" font-weight: bold;"
                    value="<?=ucfirst($get_po_details->payment_method)?>">
            </div>

        </div>

        <div class="row mb-3">
            <div class="col-4">
                <label for="formFile" class="form-label " style=" font-weight: bold; ">Attach File</label>
                <input class="form-control" type="file" id="formFile" name="profile_picture">

            </div>
        </div>

        <!--Start Table-->

        <div class="card border-success mb-3" style="max-width:100%;" id="card">
            <div class="card-body text-success" id="card-body">
                <table id="tblProducts" class="table table-bordered">
                    <thead>
                        <tr>
                            <th style=" font-weight: bold; ">Plate No</th>
                            <th style=" font-weight: bold; ">Description</th>
                            <th style=" font-weight: bold; ">Unit</th>
                            <th style=" font-weight: bold; ">Quantity</th>
                            <th style=" font-weight: bold; ">Unit Price</th>
                            <th style=" font-weight: bold; ">Amount</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($get_po as $row) { ?>

                        <tr>

                            <td>
                                <input type="hidden" name="item_no[]" class="form-control" value="0" readonly>
                                <input type="text" class="pnm form-control" value="<?=$row->plate_no?>" name=""
                                    style="font-weight:bold; width:100%" readonly />
                                <input type="hidden" class="pnm form-control" value="<?=$row->car_id?>" name="plate[]"
                                    style="font-weight:bold; width:100%" readonly />
                            </td>
                            <td>
                                <input type="text" class="form-control" value="<?=$row->description?>"
                                    name="description[]" style="font-weight: bold; " readonly />
                            </td>


                            <td>
                                <input type="text" class="form-control" value="<?=$row->unit?>" name="unit[]"
                                    style="font-weight: bold;" readonly />
                            </td>
                            <td>
                                <input type="number" class="qty form-control" min="1" max="<?=$row->quantity?>"
                                    title="P.O" value="<?=$row->quantity?>" name="qty[]" id="qty"
                                    style="font-weight: bold;" />
                            </td>

                            <td>
                                <input type="number" class="price form-control" value="0" min="1" name="price[]"
                                    style="font-weight: bold;" required pattern="[0-9,.]+" step="any"
                                    title="Unit price should only contain number/s" id="price" />
                            </td>

                            <td>
                                <input type="number" class="subtot  form-control" value="0" name="subtot[]" id="subtot"
                                    style="font-weight: bold; " readonly />
                            </td>

                        </tr>

                        <?php } ?>

                    </tbody>
                    <tfoot>

                        <tr>
                            <td colspan="5" class="text-end" style="font-weight:bold">Total Amount</td>
                            <td><input type="text" class="grdtot form-control" value="0" name="total_amount" id="grdtot"
                                    readonly />
                            </td>
                        </tr>
                    </tfoot>
                </table>

            </div>
            <div class=" card-footer bg-transparent border-success text-end">
                <input type="submit" value="Create" name="btn_pi" class="btn_save">
                <a href="<?= site_url('FinanceCtrl/approved_po')?>"><input type="button" value="Back"
                        class="btn_save"></a>
            </div>
        </div>
        <input type="hidden" value="<?=$get_po_details->PO_ID?>" name="PO_ID">
        <input type="hidden" value="<?=$get_po_details->purchase_request_id?>" name="request_id">
        <input type="hidden" name="User_ID" value="<?=$_SESSION['User_ID']?>">
        <?=form_close();?>
        <!--End Table-->

    </div>

</main>