<main class="content">
    <div class="container-fluid p-0">

        <div class="mb-3">

            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0 text-center">Profile Details</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="<?php echo base_url('includes/Custom/image/not_2.png');?>" alt="Christina Mason"
                                class="img-fluid rounded-circle mb-2" width="128" height="128" />
                            <h5 class="card-title mb-0">Iner Tora</h5>
                            <div class="text-muted mb-2"><?php echo ucfirst($profile->position);?></div>

                        </div>

                    </div>
                </div>

                <div class="col-md-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">

                            <h4 class="card-title mb-0 text-center"><?php echo $profile->branch_id ?></h4>
                        </div>

                        <?php  echo form_open_multipart('UserCtrl/profile/'.$profile->user_id,
                array('onsubmit'=>'return confirm(\'Are you sure you want to update this data?\')'));?>

                        <div class="card-body h-100">

                            <div class="d-flex align-items-start">
                                <ddiv class="flex-grow-1">
                                    <div class="form-outline mb-3 mt-2">
                                        <input type="text" class="form-control" style="height:40px" name="fname"
                                            value="<?php  echo set_value('fname',$profile->firstname);?>" />
                                        <label class="form-label" autocomplete="off">First Name</label>
                                    </div>
                                    <small style="color:red;"><?php echo form_error('fname'); ?></small>

                                    <div class="form-outline mb-2 mt-2">
                                        <input type="text" class="form-control" style="height:40px" name="mname"
                                            value="<?php  echo set_value('mname',$profile->middlename);?>" />
                                        <label class="form-label" autocomplete="off">Middle Initial</label>
                                    </div>
                                    <small style="color:red;"><?php echo form_error('mname'); ?></small>

                            </div>

                            <div class="col">
                                <div class="form-outline mb-3">
                                    <input type="text" class="form-control" style="height:40px" name="lname"
                                        value="<?php  echo set_value('lname',$profile->lastname);?>" />
                                    <label class="form-label" autocomplete="off">Last Name</label>
                                </div>
                                <small style="color:red;"><?php echo form_error('lname'); ?></small>


                                <div class="form-outline mb-3 mt-2">
                                    <input type="text" class="form-control" style="height:40px" name="username"
                                        value="<?php  echo set_value('username',$profile->username);?>" />
                                    <label class="form-label" autocomplete="off">Username</label>
                                </div>
                                <small style="color:red;"><?php echo form_error('username'); ?></small>


                                <div class="form-outline mb-3 mt-2">
                                    <input type="text" class="form-control" style="height:40px" name="password"
                                        value="<?php  echo set_value('password',$profile->password);?>" />
                                    <label class="form-label" autocomplete="off">Password</label>
                                </div>
                                <small style="color:red;"><?php echo form_error('password'); ?></small>




                                </ddiv>


                            </div>
                            <div class="card-footer bg-transparent border-success text-center ">
                                <input type="submit" class="add" name="updateProfile" value="Update">
                            </div>


                        </div>

                        <input type="hiddenx" name="profile_id" value="<?php  echo $_SESSION['user_id']; ?>">
                        <?= form_close()?>
                    </div>
                </div>
            </div>

        </div>
</main>