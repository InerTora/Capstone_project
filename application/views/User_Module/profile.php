<main class="content">
    <div class="container-fluid p-0">

        <div class="mb-3">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0 text-center">Profile Details</h5>
                        </div>

                        <?php
                          $img_src =  base_url('includes/Custom/image/not_2.png');
                        if(isset($edituser->image)  && !empty($edituser->image))
                        {
                            if(file_exists('./uploads/'.$edituser->image))
                            {
                                $img_src = base_url('./uploads/'.$edituser->image);
                            }
                           
                        }
                                ?>
                        <div class="card-body text-center">


                            <img style="width: 150px; height:150px;" class=" img-fluid rounded-circle mb-3"
                                src="<?php echo $img_src; ?>" alt="">

                            <h5 class="card-title mb-0">
                                <?= ucfirst($edituser->First_Name). ' '.ucfirst($edituser->Last_Name) ?> </h5>
                            <div class="text-muted mb-2"><?= ucfirst($edituser->Position)?></div>

                        </div>

                    </div>
                </div>

                <div class="col-md-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">

                            <h1 class="card-title mb-0 text-center " style="font-size:20px;"><?= $branch->branch_name ?>
                            </h1>
                        </div>

                        <?php  echo form_open_multipart('UserCtrl/profile/'.$edituser->User_ID,
                array('onsubmit'=>'return confirm(\'Are you sure you want to update this data?\')'));?>

                        <div class="card-body h-100">

                            <div class="d-flex align-items-start">
                                <ddiv class="flex-grow-1">

                                    <div class="form-outline mb-3 mt-2">
                                        <input type="text" class="form-control" style="height:40px" name="fname"
                                            value="<?= $edituser->First_Name?>" />
                                        <label class="form-label" autocomplete="off">First Name</label>
                                    </div>
                                    <small style="color:red;"><?php echo form_error('fname'); ?></small>

                                    <div class="form-outline mb-2 mt-2">
                                        <input type="text" class="form-control" style="height:40px" name="mname"
                                            value="<?= $edituser->Middle_Name?>" />
                                        <label class="form-label" autocomplete="off">Middle Initial</label>
                                    </div>
                                    <small style="color:red;"><?php echo form_error('mname'); ?></small>

                            </div>

                            <div class="col">
                                <div class="form-outline mb-3">
                                    <input type="text" class="form-control" style="height:40px" name="lname"
                                        value="<?= $edituser->Last_Name?>" />
                                    <label class="form-label" autocomplete="off">Last Name</label>
                                </div>
                                <small style="color:red;"><?php echo form_error('lname'); ?></small>


                                <div class="form-outline mb-3 mt-2">
                                    <input type="text" class="form-control" style="height:40px" name="username"
                                        value="<?= $edituser->Username?>" readonly />
                                    <label class="form-label" autocomplete="off">Username</label>
                                </div>
                                <small style="color:red;"><?php echo form_error('username'); ?></small>


                                <div class="form-outline mb-3 mt-2">
                                    <input type="password" class="form-control" style="height:40px" name="password"
                                        value="<?= $edituser->Password?>" />
                                    <label class="form-label" autocomplete="off">Password</label>
                                </div>
                                <small style="color:red;"><?php echo form_error('password'); ?></small>




                            </div>


                        </div>
                        <div class="card-footer bg-transparent border-success text-center ">
                            <input type="submit" class="add mb-2" name="updateProfile" value="Update">

                            <br>

                            <a href="<?= site_url('UserCtrl/change_profile/'.$edituser->User_ID);?>">Change Profile
                                Picture</a>
                        </div>


                    </div>
                    <input type="hidden" name="user_id" value="<?php  echo $edituser->User_ID; ?>">

                    <?= form_close()?>
                </div>
            </div>
        </div>

    </div>
</main>