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

#txt {
    font-weight: bold;
    color: black;
}

#req {
    color: red;
}
</style>
<main class="content">
    <div class="container-fluid">

        <div class="card border-success " style="max-width: 100%;">
            <div class="card-header bg-transparent border-success" style="font-size:25px;">Register New Supplier</div>
            <?php  echo form_open_multipart('SupplierCtrl/create_supplier',
                array('onsubmit'=>'return confirm(\'Are you sure you want to Create?\')'));?>

            <div class="card-body text-success">
                <div class="container">
                    <div class="row">

                        <div class="col">

                            <div class=" mb-3 mt-2">
                                <select class="form-select mb-3" aria-label="Default select example" name="payable_type"
                                    style="height:40px" required>
                                    <option value="">Select Type</option>
                                    <option value="Repair and Maintenance">Repair and Maintenance</option>
                                    <option value="Gasoline">Gasoline</option>
                                    <option value="Billing">Billing</option>
                                </select>
                                <small style="color:red;"><?= form_error('payable_type'); ?></small>
                            </div>

                            <div class="form-outline mb-3 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="supplier_name"
                                    value="<?php  echo set_value('supplier_name');?>" />
                                <label class="form-label" id="txt">Supplier Name <span id="req">*</span></label>
                            </div>
                            <small style="color:red;"><?php echo form_error('supplier_name'); ?></small>

                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="contact"
                                    value="<?php  echo set_value('contact');?>" />
                                <label class="form-label" id="txt">Contact <span id="req">*</span></label>
                            </div>
                            <small style="color:red;"><?php echo form_error('contact'); ?></small>
                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="street"
                                    value="<?php  echo set_value('street');?>" />
                                <label class="form-label" id="txt">Street<span id="req"> *</span></label>
                            </div>
                            <small style="color:red;"><?php echo form_error('street'); ?></small>
                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="barangay"
                                    value="<?php  echo set_value('barangay');?>" />
                                <label class="form-label" id="txt">Barangay <span id="req">*</span></label>
                            </div>
                            <small style="color:red;"><?php echo form_error('barangay'); ?></small>

                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="city"
                                    value="<?php  echo set_value('city');?>" />
                                <label class="form-label" id="txt">City <span id="req">*</span></label>
                            </div>
                            <small style="color:red;"><?php echo form_error('city'); ?></small>
                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="province"
                                    value="<?php  echo set_value('province');?>" />
                                <label class="form-label" id="txt">Province <span id="req">*</span></label>
                            </div>
                            <small style="color:red;"><?php echo form_error('province'); ?></small>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent border-success text-end ">
                    <input type="submit" class="btn_save" name="Addsupplier" value="Create">
                    <a href="<?php echo site_url('SupplierCtrl/'); ?>"><input type="button" value="Back"
                            class="btn_save">
                    </a>
                </div>
                <input type="hidden" name="branch_id" id="" value="<?=ucfirst($_SESSION['branch_id']);?>">
                <?= form_close()?>
            </div>
        </div>
</main>