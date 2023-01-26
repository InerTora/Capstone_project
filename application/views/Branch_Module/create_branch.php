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
</style>



<main class="content">
    <div class="container-fluid">
        <div class="card border-success mb-3" style="max-width: 100%;">
            <div class="card-header bg-transparent border-success" style="font-size:25px;">Register New Branch</div>
            <?php  echo form_open_multipart('BranchCtrl/create_branch',array('onsubmit'=>'return confirm(\'Are you sure you want to Create?\')'));?>
            <div class="card-body text-success">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <div class="form-outline mb-3 mt-2">
                                <input type="text" class="form-control clear" style="height:40px" name="txtbranch"
                                    maxlength="20" value="<?php  echo set_value('txtbranch');?>" />
                                <label class="form-label" id="txt">Branch Name <span
                                        class="text-danger">*</span></label>
                            </div>
                            <small style="color:red;"><?php echo form_error('txtbranch'); ?></small>

                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control clear" style="height:40px" name="txtcontact"
                                    value="<?php  echo set_value('txtcontact');?>" />
                                <label class="form-label" id="txt">Contact Number<span
                                        class="text-danger">*</span></label>
                            </div>
                            <small style="color:red;"><?php echo form_error('txtcontact'); ?></small>
                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control clear" style="height:40px" name="txtstreet"
                                    value="<?php  echo set_value('txtstreet');?>" />
                                <label class="form-label" id="txt">Street<span class="text-danger">*</span></label>
                            </div>
                            <small style="color:red;"><?php echo form_error('txtstreet'); ?></small>
                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control clear" style="height:40px" name="txtbarangay"
                                    value="<?php  echo set_value('txtbarangay');?>" />
                                <label class="form-label" id="txt">Barangay<span class="text-danger">*</span></label>
                            </div>
                            <small style="color:red;"><?php echo form_error('txtbarangay'); ?></small>

                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control clear" style="height:40px" name="txtcity"
                                    value="<?php  echo set_value('txtcity');?>" />
                                <label class="form-label" id="txt">City<span class="text-danger">*</span></label>
                            </div>
                            <small style="color:red;"><?php echo form_error('txtcity'); ?></small>
                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control clear" style="height:40px" name="txtprovince"
                                    value="<?php  echo set_value('txtprovince');?>" />
                                <label class="form-label" id="txt">Province<span class="text-danger">*</span></label>
                            </div>
                            <small style="color:red;"><?php echo form_error('txtprovince'); ?></small>
                        </div>


                    </div>
                </div>

                <div class="card-footer bg-transparent border-success text-end ">
                    <input type="submit" class="btn_save" name="btn_branch" value="Create">

                    <a href="<?php echo site_url('BranchCtrl/'); ?>"><input type="button" value="Back" class="btn_save">
                    </a>
                </div>
                <?= form_close()?>
            </div>
        </div>

</main>