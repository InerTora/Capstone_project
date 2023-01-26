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
        <h1 class="h2 mb-3  text-dark">Create Purchase Order</h1>
        <!--start select catergory-->
        <hr>

        <?=form_open('PurchaseOrderCtrl/branch_create_PO/'.$code->purchase_request_id,  array('onsubmit'=>'return confirm(\'Are you sure you want to create?\')'));?>
        <div class="row  mb-2">
            <div class="col-3">
                <label for="">Purchase Order No</label>
                <input type="text" value="<?= $display_code?>" name="PO_code" readonly class="form-control">
            </div>
            <div class="col-3">
                <label for="">Date of Purchase</label>
                <input type="text" name="date" id="" class="form-control" value="<?=date('Y-m-d');?>" readonly>
            </div>
            <!--start purchase request no-->
            <div class="col-3">
                <label for="">Purchase Request No</label>
                <input type="text" value="<?= $code->purchase_request_no?>" name="code_no" readonly
                    class="form-control">

            </div>
            <!--start purchase request no-->
        </div>
        <!--end  select catergory-->

        <div class="row mb-4">
            <div class="col-3 form-group">
                <label for="">Supplier</label>
                <input type="text" name="" id="" class="form-control" value="<?=$select->supplier_name ?>" readonly>
                <input type="hidden" value="<?=$select->supplier_id?>" name="supplier_id">
            </div>

            <div class="col-3 form-group mt-3">
                <select class="form-select" aria-label="Default select example" name="payment_terms" required>
                    <option value="">Select Payment</option>
                    <option value="cash">Cash</option>
                    <option value="cheque">Cheque</option>

                </select>
                <input type="hidden" name="category" value="<?=$code->category?>">
            </div>


        </div>
        <!--Start Table-->

        <div class="card border-success mb-3"
            style="max-width: 75rem; border-radius:15px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">

            <div class="card-body text-success">
                <table class="table table-bordered" id="table_field">
                    <thead>

                        <tr>

                            <th id="table_style">Plate No.</th>
                            <th id="table_style">Description</th>
                            <th id="table_style">Unit</th>
                            <th id="table_style">Quantity</th>
                            <th id="table_style">Unit Cost</th>
                            <th id="table_style">Estimated Cost</th>
                        </tr>

                    </thead>

                    <tbody>
                        <?php foreach ($view as $row) {
                                ?>
                        <tr>

                            <td><?= $row->plate_no; ?></td>
                            <td><?= $row->description; ?></td>
                            <td><?= $row->unit; ?></td>
                            <td><?= $row->quantity; ?></td>
                            <td><?= $row->unit_cost; ?></td>
                            <td> <?= number_format((float)$row->estimated_cost, 2, '.', ',');?></td>

                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="5" class="text-end" style="font-weight:bold">Total Cost</td>
                            <td> <?= number_format((float)$estimated_cost, 2, '.', ',');?>
                                <input type="hidden" value="<?=$estimated_cost?>" name="total_amount">
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="card-footer bg-transparent border-success text-end">
                <input type="submit" value="Create" name="submit_po" class="btn_save">
                <a href="<?php echo site_url('PurchaseOrderCtrl/branch_approved_po'); ?>"><input type="button"
                        value="Back" class="btn_save"></a>
            </div>
        </div>

        <!--End Table-->
        <input type="hidden" name="PR_id" value="<?=$row->purchase_request_id?>">
        <input type="hidden" name="user_id" value="<?= $_SESSION['User_ID']?>">
        </form>
    </div>

</main>