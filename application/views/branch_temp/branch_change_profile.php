<div class="content">
    <div class="container-fluid">
        <div class="card border-success mb-3 " style="max-width: 35rem;">
            <div class="card-header bg-transparent border-success">
                <h3>Change Profile Picture</h3>
            </div>
            <div class="card-body text-success">
                <?php  echo form_open_multipart('ManagerCtrl/branch_change_profile/'.$profile->User_ID,
                array('onsubmit'=>'return confirm(\'Are you sure you want to update this data?\')'));?>

                <div>
                    <label for="formFileLg" class="form-label">Upload Profile Picture</label>
                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="profile_picture">
                </div>

            </div>
            <div class="card-footer bg-transparent border-success">
                <input type="submit" class="add mb-2" name="upload" value="Upload">
            </div>

            <input type="hidden" name="user_id" value="<?php  echo $profile->User_ID; ?>">


            <?= form_close()?>
        </div>

    </div>
</div>