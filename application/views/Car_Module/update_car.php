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

        <div class="card border-success mb-3" style="max-width: 100%;">
            <div class="card-header bg-transparent border-success" style="font-size:25px;">Update Vehicle Details</div>
            <?php  echo form_open_multipart('CarCtrl/update_car/'.$getcar->car_id,
                array('onsubmit'=>'return confirm(\'Are you sure you want to update?\')'));?>
            <div class="card-body text-success">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <select class="form-select mb-3 input_style" aria-label="Default select example"
                                name="branch" required>
                                <option value="<?=$getcar->branch_id?>" class="invisible"><?=$getcar->branch_name?>
                                </option>
                                <?php foreach ($branch as $row){?>
                                <?php 
                                   ?>
                                <option value="<?=$row->branch_id?>"><?=$row->branch_name?>
                                    <?php
                                        ?>
                                    <?php } ?>
                            </select>

                            <small style="color:red;"><?= form_error('branch'); ?></small>


                            <div class="form-outline mb-3 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="plate_no"
                                    value="<?php  echo set_value('plate_no',$getcar->plate_no);?>" />
                                <label class="form-label" autocomplete="off">Plate No</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('plate_no'); ?></small>

                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="brand"
                                    value="<?php  echo set_value('brand',$getcar->brand);?>" />
                                <label class="form-label" autocomplete="off">Brand</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('brand'); ?></small>
                            <div class="form-outline mb-2 mt-2">

                                <input type="text" class="form-control" style="height:40px" name="color"
                                    value="<?php  echo set_value('color',$getcar->color);?>" />
                                <label class="form-label" autocomplete="off">Color</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('color'); ?></small>

                            <div class="form-outline mb-2 mt-2">

                                <input type="text" class="form-control" style="height:40px" name="chassis_no"
                                    value="<?php  echo set_value('chassis_no',$getcar->chassis_no);?>" />
                                <label class="form-label" autocomplete="off">Chassis No</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('chassis_no'); ?></small>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent border-success text-end ">
                    <input type="submit" class="btn_save" name="Updatecar" value="Update">

                    <a href="<?php echo site_url('CarCtrl/'); ?>"><input type="button" value="Back" class="btn_save">
                    </a>

                </div>

                <input type="hidden" name="car_id" id="" value="<?= $getcar->car_id;?>">
                <?= form_close()?>
            </div>
        </div>

</main>