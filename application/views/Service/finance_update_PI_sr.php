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
        <h1 class="h2 mb-3  text-dark" style=" font-weight: bold; ">Update Purchase Invoice</h1>
        <!--start select catergory-->
        <hr>

        <?php  echo form_open_multipart('FinanceCtrl/finance_update_PI_sr/'.$view_pi->PI_ID,
                array('onsubmit'=>'return confirm(\'Are you sure you want to Update?\')'));?>
        <div class="row  mb-2">
            <div class="col-3">
                <label for="" style=" font-weight: bold; ">Purchase Invoice No.</label>
                <input type="text" value="<?=$view_pi->purchase_invoice_no?>" name="PI_code" readonly
                    class="form-control" style=" font-weight: bold; ">
            </div>
            <div class="col-3">
                <label for="" style=" font-weight: bold; ">Posting Date</label>
                <input type="text" name="invoice_date" value="<?=$view_pi->invoice_date ?>" class="form-control"
                    readonly style=" font-weight: bold; ">
            </div>
            <!--start purchase request no-->
            <div class="col-3">
                <label for="" style=" font-weight: bold; ">Purchase Order No.</label>

                <input type="text" name="" value="<?=$view_pi->purchase_order_no?>" class="form-control" readonly
                    style=" font-weight: bold; ">
            </div>
            <!--start purchase request no-->
        </div>
        <!--end  select catergory-->

        <div class="row mb-2">
            <div class="col-3 form-group">
                <label for="" style=" font-weight: bold; ">Supplier</label>
                <input type="text" name="" value="<?=$view_pi->supplier_name?>" class="form-control" readonly
                    style=" font-weight: bold; ">

            </div>

            <div class="col-3 form-group">
                <label for="" style=" font-weight: bold; ">Due Date</label>
                <input type="date" name="pi_due" id="" class="form-control" style=" font-weight: bold;"
                    value="<?=$view_pi->due_date?>" min="<?=date('Y-m-d');?>" max="<?=date('2025-01-01');?>" required>
                <small style="color:red;"><?php echo form_error('pi_due'); ?></small>
            </div>

            <div class="col-3 form-group">
                <label for="" style=" font-weight: bold; ">Payment Method</label>
                <input type="text" name="payment_terms" class="form-control" readonly style=" font-weight: bold;"
                    value="<?=ucfirst($view_pi->payment_method)?>">
            </div>

        </div>

        <div class="row mb-3">

            <div class="col-4">

                <!-- Button trigger modal -->
                <input type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" value="Attach File">
                <!-- Modal -->


            </div>
        </div>


        <!--Start Table-->

        <div class="card border-success mb-3" style="max-width:100%;" id="card">
            <div class="card-body text-success" id="card-body">
                <table id="tblProducts" class="table table-bordered">
                    <thead>

                        <tr>

                            <th style=" font-weight: bold; ">Item No</th>
                            <th style=" font-weight: bold; ">Description</th>
                            <th style=" font-weight: bold; ">Unit</th>
                            <th style=" font-weight: bold; ">Quantity</th>
                            <th style=" font-weight: bold; ">Unit Price</th>
                            <th style=" font-weight: bold; ">Amount</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($invoice_view_sr as $row) { ?>
                        <input type="hidden" name="pi_code[]" value="<?=$row->invoice_id?> ">
                        <tr>

                            <td>
                                <input type="text" class="pnm form-control" value="<?=$row->item_no?>" name="item_no[]"
                                    style="font-weight:bold; width:100%" readonly />

                                <input type="hidden" class="pnm form-control" value="0" name="plate[]"
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
                                <input type="number" class="price form-control" value="<?=$row->unit_price?>" min="1"
                                    name="price[]" style="font-weight: bold;" required pattern="[0-9,.]+"
                                    title="Unit price should only contain number/s" id="price" step="any" />
                            </td>

                            <td>
                                <input type="number" class="subtot  form-control" value="<?=$row->amount?>"
                                    name="subtot[]" id="subtot" style="font-weight: bold; " readonly />
                            </td>

                        </tr>

                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end" style="font-weight:bold">Total Amount</td>
                            <td><input type="text" class="grdtot form-control" value="<?=$row->total_amount?>"
                                    name="total_amount" id="grdtot" readonly />
                            </td>
                        </tr>
                    </tfoot>
                </table>

            </div>
            <div class=" card-footer bg-transparent border-success text-end">
                <input type="submit" value="Update" name="btn_update_pi" class="btn_save">
                <a href="<?= site_url('FinanceCtrl/finance_manage_PI')?>"><input type="button" value="Back"
                        class="btn_save"></a>
            </div>
            <input type="hidden" name="PI_ID" value="<?=$view_pi->PI_ID?>">
        </div>
        <?=form_close();?>
        <!-- Modal -->

        <zdiv class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Purchase Invoice</h5>
                    </div>

                    <form action="<?= site_url('FinanceCtrl/upload_sr/'.$view_pi->PI_ID);?>" method="post"
                        enctype="multipart/form-data" class="needs-validation" novalidate
                        onsubmit="return confirm('Are you sure you want to Upload?')">
                        <div class="modal-body">
                            <img style="width:100% ;" src="<?= base_url('./upload/Purchase_invoice/'.$view_pi->file)?>"
                                class="mb-3">
                            <input type="hidden" value="<?= $view_pi->PI_ID?>" name="ha" class="mb-3">
                            <input type="file" name="profile_picture" id="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn_save" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="btn_upload" id="" value="Upload" class="btn_save">
                        </div>
                        <?= form_close()?>
                </div>
            </div>
        </zdiv>
    </div>

</main>