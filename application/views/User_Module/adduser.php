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

#txt {
    font-weight: bold;
    color: black;
}

.input_style {
    height: 40px;
}
</style>

<main class="content">
    <div class="container-fluid">
        <div class="card border-success mb-3" style="width: 100%;">
            <div class="card-header bg-transparent border-success" style="font-size:25px;">Register New User</div>
            <?php  echo form_open_multipart('UserCtrl/create_user',array('onsubmit'=>'return confirm(\'Are you sure you want to Create?\')'));?>
            <div class="card-body text-success">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <select class="form-select mb-3 input_style" aria-label="Default select example"
                                name="branch" required>
                                <option value="">Select Branch</option>
                                <?php foreach ($branch as $row){?>
                                <?php 
                                   ?>
                                <option value="<?= $row->branch_id;?>"><?= $row->branch_name;?>
                                    <?php
                                        ?>
                                    <?php } ?>
                            </select>

                            <small style="color:red;"><?= form_error('branch'); ?></small>

                            <select class="form-select mb-3 mt-2 input_style" aria-label="Default select example"
                                name="position" value="<?= set_value('position');?>">
                                <option value="">Select Position</option>
                                <option value="Manager">Manager</option>
                                <option value="Finance Clerk">Finance Clerk</option>
                                <option value="Driving Instructor">Driving Instructor</option>
                            </select>
                            <small style="color:red; font-size:15px"><?= form_error('position'); ?></small>

                            <div class="form-outline mb-3 mt-2">
                                <input type="text" class="form-control input_style" name="fname"
                                    value="<?= set_value('fname');?>" />
                                <label class="form-label" id="txt">First
                                    Name<span class="text-danger">*</span></label>
                            </div>
                            <small style="color:red;"><?= form_error('fname'); ?></small>

                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control input_style" name="mname"
                                    value="<?= set_value('mname');?>" />
                                <label class="form-label" id="txt">Middle Initial<span
                                        class="text-danger">*</span></label>
                            </div>
                            <small style="color:red;"><?= form_error('mname'); ?></small>
                            <!--  -->
                            <div class="form-outline mb-3 mt-3">
                                <input type="text" class="form-control input_style" name="lname"
                                    value="<?= set_value('lname');?>" />
                                <label class="form-label" id="txt">Last Name<span class="text-danger">*</span></label>
                            </div>
                            <small style="color:red;"><?= form_error('lname'); ?></small>

                        </div>

                        <div class="col">

                            <div class="form-outline mb-3">
                                <input type="text" class="form-control input_style" name="contact"
                                    value="<?= set_value('contact');?>" />
                                <label class="form-label" id="txt">Contact No<span class="text-danger">*</span></label>
                            </div>
                            <small style="color:red;"><?= form_error('contact'); ?></small>


                            <div class="form-outline mb-3 mt-2">
                                <input type="email" class="form-control input_style" name="username"
                                    value="<?= set_value('username');?>" />
                                <label class="form-label" id="txt">Email<span class="text-danger">*</span></label>
                            </div>
                            <small style="color:red;"><?= form_error('username'); ?></small>


                            <div class="form-outline mb-3 mt-2">
                                <input type="password" class="form-control input_style" name="password" />
                                <label class="form-label" id="txt">Password<span class="text-danger">*</span></label>
                            </div>
                            <small style="color:red;"><?= form_error('password'); ?></small>

                            <div class="form-outline mb-2 mt-2">
                                <input type="password" class="form-control input_style" name="cpassword" />
                                <label class="form-label" id="txt">Confirm Password<span
                                        class="text-danger">*</span></label>

                            </div>
                            <small style="color:red;"><?= form_error('cpassword'); ?></small>

                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent border-success text-end ">
                    <input type="submit" class="btn_save" name="AddUser" value="Create">
                    <a href="<?= site_url('UserCtrl/'); ?>"><input type="button" value="Back" class="btn_save">
                    </a>

                </div>

                <?= form_close()?>
            </div>
        </div>

</main>