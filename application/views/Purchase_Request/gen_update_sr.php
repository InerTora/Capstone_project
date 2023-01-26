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

        <h1 class="h2 mb-3  text-dark">Update Service Request</h1>
        <!--start select catergory-->
        <?php  echo form_open_multipart('PurchaseRequestCtrl/gen_update_sr/'.$select->purchase_request_id,
                array('onsubmit'=>'return confirm(\'Are you sure you want to update?\')'));?>
        <div class="row">
            <div class="col-3">
                <label for="">Supplier Name</label>

                <select class="form-select mb-3" aria-label="Default select example" name="supplier" style="height:40px"
                    required>

                    <option class="text-info invisible" value="<?php echo $select->supplier_id ?>">
                        <?= $select->supplier_name;?>
                    </option>
                    <?php foreach ($repair_supplier as $row) {
                       ?>
                    <option value="<?=$row->supplier_id?>"><?=$row->supplier_name?></option>

                    <?php

                    }?>
                </select>

            </div>
            <!--start purchase request no-->
            <div class="col-3">
                <label for="">Purchase Request No</label>
                <input type="text" class="form-control" value="<?=$code->purchase_request_no ?>" readonly>
            </div>
            <div class="col-3">
                <label for="">Posting Date</label>
                <input type="text" class="form-control" value="<?=$code->posting_date ?>" readonly>
            </div>
            <!--start purchase request no-->
        </div>

        <!--Start Table-->

        <div class="card border-success mb-3" style="max-width:100%;" id="card">
            <div class="card-body text-success" id="card-body">
                <table class="table table-bordered" id="tblProducts">

                    <thead>
                        <tr>
                            <th id="table_style">Item No.</th>
                            <th id="table_style">Item Description</th>
                            <th id="table_style">Unit</th>
                            <th id="table_style">Quantity</th>
                            <th id="table_style">Unit Cost</th>
                            <th id="table_style">Estimated Cost</th>

                        </tr>

                    </thead>
                    <tbody>
                        <?php foreach ($view_sr as $row) {?>
                        <input type="hidden" name="pr_code[]" value="<?=$row->PR_ID?> ">
                        <tr>

                            <td> <input class="form-control" type="text" name="item_no[]" value="<?=$row->item_no?>"
                                    readonly>
                            </td>


                            <td><input type="text" name="description[]" value="<?=$row->description?>"
                                    class="form-control"></td>

                            <td>
                                <input class="form-control" type="text" name="unit[]" value="<?=$row->unit?>" readonly
                                    required title="Unit should only contain character/s">
                            </td>


                            <td>
                                <input class="form-control" type="number" name="quantity[]" value="<?= $row->quantity?>"
                                    id="qty" required pattern="[0-9]+" min="1" max="60">
                                <div class="invalid-feedback">
                                    Quantity can only accept number/s
                                </div>
                            </td>

                            <td>
                                <input class="price form-control" type="text" name="unit_cost[]"
                                    value="<?=$row->unit_cost?>" id="price">
                            </td>
                            <td>
                                <input class="subtot form-control" type="text" name="estimated_cost[]"
                                    value="<?=$row->estimated_cost?>" readonly id="subtot">
                            </td>
                        </tr>
                        <?php  }?>
                        <tr>
                            <td colspan="5" class="text-end" style="font-weight:bold">Total Cost</td>
                            <td><input type="text" name="total_cost" class="grdtot form-control"
                                    value="<?=$code->total_cost?>" id="grdtot" readonly>


                            </td>

                        </tr>
                    </tbody>

                </table>
                <div class="form-outline mt-5">
                    <textarea class="form-control" id="textAreaExample" rows="2"
                        name="purpose"><?=$code->purpose?></textarea>
                    <label class="form-label" for="textAreaExample"
                        style="font-size:15px; font-weight:bold;">Purpose</label>
                </div>
            </div>


            <div class="card-footer bg-transparent border-success text-end ">
                <input type="submit" value="Update" name="update_pr" class="btn_save">
                <a href="<?php echo site_url('PurchaseRequestCtrl/gen_manage_PR'); ?>"><input type="button" value="Back"
                        class="btn_save"></a>
            </div>

        </div>
        <!--End Table-->
        <input type="hidden" name="branch_id" value="<?php  echo $_SESSION['branch_id']; ?>">
        <input type="hidden" name="purchase_id" value="<?php  echo $select->purchase_request_no; ?>">
        <?=form_close();?>
    </div>

</main>