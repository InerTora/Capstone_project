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
</style>

<main class="content">
    <div class="container-fluid">

        <div class="card border-success mb-3" style="max-width: 100%;">
            <div class="card-header bg-transparent border-success" style="font-size:25px;">Update Branch Details</div>

            <?php  echo form_open_multipart('BranchCtrl/update_branch/'.$branch->branch_id,
                array('onsubmit'=>'return confirm(\'Are you sure you want to update?\')'));?>

            <div class="card-body text-success">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <div class="form-outline mb-3 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="txtBranch" readonly
                                    value="<?php  echo set_value('txtBranch',ucfirst($branch->branch_name));?>" />
                                <label class="form-label" autocomplete="off">Branch Name</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('txtBranch'); ?></small>

                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="txtContact"
                                    value="<?php  echo set_value('txtContact',$branch->contact);?>" />
                                <label class="form-label" autocomplete="off">Contact Number</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('txtContact'); ?></small>
                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="txtStreet"
                                    value="<?php  echo set_value('txtStreet',ucfirst($branch->street));?>" />
                                <label class="form-label" autocomplete="off">Street</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('txtStreet'); ?></small>
                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="txtBarangay"
                                    value="<?php  echo set_value('txtBarangay',ucfirst($branch->barangay));?>" />
                                <label class="form-label" autocomplete="off">Barangay</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('txtBarangay'); ?></small>

                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="txtCity"
                                    value="<?php  echo set_value('txtCity',ucfirst($branch->city));?>" />
                                <label class="form-label" autocomplete="off">City</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('txtCity'); ?></small>
                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="txtProvince"
                                    value="<?php  echo set_value('txtProvince',ucfirst($branch->province));?>" />
                                <label class="form-label" autocomplete="off">Province</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('txtProvince'); ?></small>


                        </div>


                    </div>
                </div>

                <div class="card-footer bg-transparent border-success text-end ">
                    <input type="submit" class="btn_save" name="updateBranch" value="Update">

                    <a href="<?php echo site_url('BranchCtrl/'); ?>"><input type="button" value="Back" class="btn_save">
                    </a>
                </div>
                <input type="hidden" name="branch_id" value="<?php  echo $branch->branch_id; ?>">
                <?= form_close()?>
            </div>
        </div>

</main>