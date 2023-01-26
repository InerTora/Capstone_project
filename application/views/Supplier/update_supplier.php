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
        <span>
            <?php 
                if($this->session->flashdata('success')){
                    echo $this->session->flashdata('success');
                }
                elseif($this->session->flashdata('error'))
                {
                    echo $this->session->flashdata('error');
                }
            ?>

        </span>
        <div class="card border-success mb-3" style="max-width: 100%;">
            <div class="card-header bg-transparent border-success" style="font-size:25px;">Update Supplier Details</div>

            <?php  echo form_open_multipart('SupplierCtrl/update_supplier/'.$supplier->supplier_id,
                array('onsubmit'=>'return confirm(\'Are you sure you want to update?\')'));?>


            <div class="card-body text-success">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <div class="form-outline mb-3 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="payable_type" readonly
                                    value="<?php  echo set_value('supplier_name',$supplier->payable_type);?>" />
                                <label class="form-label" autocomplete="off">Payable Type</label>
                            </div>

                            <small style="color:red;"><?= form_error('payable_type'); ?></small>
                            <!-- Supplier Name -->
                            <div class="form-outline mb-3 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="supplier_name"
                                    value="<?php  echo set_value('supplier_name',$supplier->supplier_name);?>" />
                                <label class="form-label" autocomplete="off">Supplier Name</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('supplier_name'); ?></small>

                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="contact"
                                    value="<?php  echo set_value('contact',$supplier->contact);?>" />
                                <label class="form-label" autocomplete="off">Contact Number</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('contact'); ?></small>
                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="street"
                                    value="<?php  echo set_value('street',$supplier->street);?>" />
                                <label class="form-label" autocomplete="off">Street</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('street'); ?></small>
                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="barangay"
                                    value="<?php  echo set_value('barangay',$supplier->barangay);?>" />
                                <label class="form-label" autocomplete="off">Barangay</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('barangay'); ?></small>

                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="city"
                                    value="<?php  echo set_value('city',$supplier->city);?>" />
                                <label class="form-label" autocomplete="off">City</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('city'); ?></small>
                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="province"
                                    value="<?php  echo set_value('province',$supplier->province);?>" />
                                <label class="form-label" autocomplete="off">Province</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('province'); ?></small>


                        </div>


                    </div>
                </div>

                <div class="card-footer bg-transparent border-success text-end ">
                    <input type="submit" class="btn_save" name="updateSupplier" value="Update">

                    <a href="<?php echo site_url('SupplierCtrl/'); ?>"><input type="button" value="Back"
                            class="btn_save">
                    </a>
                </div>
                <input type="hidden" name="supplier_id" value="<?php  echo $supplier->supplier_id; ?>">
                <?= form_close()?>
            </div>
        </div>

</main>