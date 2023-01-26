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

<main id="appendable" class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Create Purchase Request</h1>
        <!--start select catergory-->


        <?=form_open('PurchaseRequestCtrl/gen_create_purchase_request/',  array('onsubmit'=>'return confirm(\'Are you sure you want to create?\')'));?>

        <input type="hidden" name="category" value="Gasoline">
        <div class="row mb-3">

            <sdiv class="col-3">
                <label>Supplier Name</label>
                <select class="form-select mb-3" aria-label="Default select example" name="supplier" style="height:40px"
                    required>
                    <option value="" class="text-info invisible">Select Supplier</option>

                    <?php if(!empty($getsupplier)){

                        foreach ($getsupplier as $row) {
                                 if ($row->status != 'deactivate') {

                                 if ($row->payable_type == "Gasoline") {
                                                 ?>
                    <option value="<?= $row->supplier_id?>"><?= $row->supplier_name?></option>

                    <?php
                    }else{
                    ?>
                    <h4>No data found</h4>
                    <?php
                             }

                                 }
                                     }
                                        }else{
                                              ?>
                    <option readonly>No Supplier Found</option>
                    <?php
                                }?>
                </select>


                <small style="color:red;"><?php echo form_error('branch'); ?></small>
            </sdiv>

            <!--start purchase request no-->
            <div class="col-3">
                <label>Purchase Request No</label>
                <input type="text" value="<?= $display_code?>" name="code_no" readonly class="form-control">
            </div>

            <div class="col-3">
                <label>Date Issued</label>
                <input type="text" value="<?=date('Y-m-d');?>" name="date_issued" readonly class="form-control">
            </div>
            <!--start purchase request no-->
        </div>
        <!--Start Table-->

        <ddiv class="card border-success mb-3" style="max-width:100%;" id="card">
            <div class="card-body text-success" id="card-body">
                <table class="table table-bordered" id="table_field">
                    <thead>

                        <tr>
                            <th id="table_style"></th>
                            <th id="table_style">Plate No.</th>
                            <th id="table_style">Quantity</th>
                            <th id="table_style">Unit</th>
                            <th id="table_style">Description</th>
                        </tr>
                    </thead>

                    <tbody class="row_content" id="row_product">
                        <tr>
                            <td><button class="btn btn-danger remove-category"><i
                                        class="fa-solid fa-trash"></i></button></td>
                            <td>
                                <!-- Copy select tag with options -->
                                <select class="form-select mb-1 plate plate_number" name="plate[]" style="height:40px"
                                    required>
                                    <option value="">Select Plate No.</option>
                                    <?php  foreach ($carlist as $row) {?>

                                    <option car_id="<?= $row->car_id?>" value="<?= $row->plate_no?>">
                                        <?= $row->plate_no?></option>


                                    <?php }?>

                                </select>
                            </td>
                            <td><input class="form-control quantity" type="number" name="quantity[]"
                                    id="validationCustom01" pattern="[0-9]+" min="1" max="60" required>
                                <div class="invalid-feedback">
                                    Quantity can only accept number/s
                                </div>

                            </td>
                            <td><input class="form-control unit" type="text" name="unit[]" id="unit" pattern="[a-zA-Z]+"
                                    required>
                                <div class="invalid-feedback">
                                    Unit can only accept character/s
                                </div>
                            </td>
                            <td>
                                <select class="form-select mb-1 plate" name="description[]" style="height:40px"
                                    id="plate" required>
                                    <option value="">Select Description.</option>
                                    <option value="Premium">Premium</option>
                                    <option value="Unleaded">Unleaded</option>
                                    <option value="Diesel">Diesel</option>
                                </select>
                            </td>


                        </tr>

                    </tbody>
                    <tfoot>
                        <td><button type="button" class="btn btn-info" id="btn_pr"><i
                                    class="fa-solid fa-plus"></i></button></td>
                    </tfoot>
                </table>
            </div>

            <div class="card-footer bg-transparent border-success text-end">
                <input type="submit" value="Create" name="btn_create_pr" id="submit_pr" class="btn_save">
                <a href="<?php echo site_url('PurchaseRequestCtrl/gen_manage_PR'); ?>"><input type="button" value="Back"
                        class="btn_save"></a>
            </div>
        </ddiv>

        <input type="hidden" name="branch_id" value="<?php  echo $_SESSION['branch_id']; ?>">
        <?= form_close()?>
        <!--End Table-->
        </form>
    </div>

</main>