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

#bt {
    text-transform: none;
    width: 150px;
}
</style>

<main class="content">
    <div class="container-fluid">

        <div class="card border-success mb-3 offset-1" style="max-width: 100%;">
            <div class="card-header bg-transparent border-success" style="font-size:25px;">Create Vehicle Details</div>
            <?php  echo form_open_multipart('CarCtrl/branch_add_car',
                array('onsubmit'=>'return confirm(\'Are you sure you want to Create?\')'));?>
            <div class="card-body text-success">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <div class="form-outline mb-3 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="plate_no"
                                    value="<?php  echo set_value('plate_no');?>" maxlength="15" />
                                <label class="form-label" autocomplete="off">Plate No/MV File</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('plate_no'); ?></small>

                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="brand"
                                    value="<?php  echo set_value('brand');?>" />
                                <label class="form-label" autocomplete="off">Brand</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('brand'); ?></small>
                            <div class="form-outline mb-2 mt-2">

                                <input type="text" class="form-control" style="height:40px" name="color"
                                    value="<?php  echo set_value('color');?>" />
                                <label class="form-label" autocomplete="off">Color</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('color'); ?></small>

                            <div class="form-outline mb-2 mt-2">

                                <input type="text" class="form-control" style="height:40px" name="VIN"
                                    value="<?php  echo set_value('VIN');?>" maxlength="17" />
                                <label class="form-label" autocomplete="off">VIN</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('VIN'); ?></small>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent border-success text-end ">
                    <input type="submit" class="btn_save" name="branch_addcar" value="Save">
                    <a href="<?php echo site_url('CarCtrl/branch_car'); ?>"><input type="button" value="Back"
                            class="btn_save">
                    </a>
                </div>
                <input type="hidden" name="branch_id" id="" value="<?=ucfirst($_SESSION['branch_id']);?>">
                <?= form_close()?>
            </div>
        </div>

</main>