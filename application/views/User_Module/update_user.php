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
</style>
<main class="content">
    <div class="container-fluid">

        <div class="card border-success mb-3" style="max-width: 100%;">
            <div class="card-header bg-transparent border-success" style="font-size:25px;">Update User Details</div>


            <?php  echo form_open_multipart('UserCtrl/update_user/'.$edituser->User_ID,  array('onsubmit'=>'return confirm(\'Are you sure you want to update?\')'));?>


            <div class="card-body text-success">
                <div class="container">
                    <div class="row">
                        <div class="col">


                            <select class="form-select mb-3" aria-label="Default select example" name="branch"
                                style="height:40px">

                                <option class="text-info invisible" value="<?php echo $edituser->branch_id ?>">
                                    <?= $edituser->branch_name;?>
                                </option>

                                <?php  foreach ($branch as $row) {
                               ?>
                                <option value="<?=$row->branch_id?>"><?=$row->branch_name?></option>
                                <?php
                              }?>

                            </select>
                            <small style="color:red;"><?php echo form_error('branch'); ?></small>

                            <select class="form-select mb-3 mt-2" aria-label="Default select example" name="position"
                                style="height:40px">
                                <option value="<?=$edituser->Position?>" class="invisible">
                                    <?=ucfirst($edituser->Position)?>
                                </option>
                                <option value="Manager">Manager</option>
                                <option value="Finance Clerk">Finance Clerk</option>
                                <option value="Driving Instructor">Driving Instructor</option>

                            </select>



                            <div class="form-outline mb-3 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="fname"
                                    value="<?php  echo set_value('fname',$edituser->First_Name);?>" />
                                <label class="form-label" id="txt">First Name</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('fname'); ?></small>

                            <div class="form-outline mb-2 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="mname"
                                    value="<?php  echo set_value('mname',$edituser->Middle_Name);?>" />
                                <label class="form-label" id="txt">Middle Initial</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('mname'); ?></small>

                        </div>

                        <div class="col">
                            <div class="form-outline mb-3">
                                <input type="text" class="form-control" style="height:40px" name="lname"
                                    value="<?php  echo set_value('lname',$edituser->Last_Name);?>" />
                                <label class="form-label" id="txt">Last Name</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('lname'); ?></small>

                            <div class="form-outline mb-3 mt-2">
                                <input type="text" class="form-control" style="height:40px" name="contact"
                                    value="<?php  echo set_value('contact',$edituser->contact_no);?>" />

                                <label class="form-label" id="txt">Contact No</label>
                            </div>

                            <small style="color:red;"><?php echo form_error('contact'); ?></small>
                            <div class="form-outline mb-3 mt-2">
                                <input type="email" class="form-control" style="height:40px" name="username" readonly
                                    value="<?php  echo set_value('username',$edituser->Username);?>" />
                                <label class="form-label" id="txt">Email</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('username'); ?></small>


                            <div class="form-outline mb-3 mt-2">
                                <input type="password" class="form-control" style="height:40px" name="password"
                                    value="<?php  echo set_value('password',$edituser->Password);?>" />
                                <label class="form-label" id="txt">Password</label>
                            </div>
                            <small style="color:red;"><?php echo form_error('password'); ?></small>


                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-success text-end ">
                        <input type="submit" class="btn_save" name="updateUser" value="Update">

                        <a href="<?php echo site_url('UserCtrl/'); ?>"><input type="button" value="Back"
                                class="btn_save">
                        </a>
                    </div>
                    <input type="hidden" name="user_id" value="<?php  echo $edituser->User_ID; ?>">
                    <?= form_close()?>
                </div>


                <!--Start Modal-->

                <!-- Button trigger modal -->

                <!-- Modal -->

                <!--End Modal-->



            </div>

</main>