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

        <div class="card border-success mb-3"
            style="max-width: 100%; border-radius:10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
            <div class="card-header bg-transparent border-success" style="font-size:25px;">Branch Details</div>
            <div class="card-body text-success">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <label for="">
                                <h3>Branch Name:</h3>
                            </label>
                            <label for="">
                                <h4>iDrive Driving Tutorial - <?= $view_branch->branch_name ?></h4>
                            </label>
                        </div>
                        <div class="col-12">
                            <label for="">
                                <h3>Contact:</h3>
                            </label>
                            <label for="">
                                <h4><?= $view_branch->contact ?></h4>
                            </label>
                        </div>
                        <div class="col-12">
                            <label for="">
                                <h3>Address:</h3>
                            </label>
                            <label for="">
                                <h4><span><?= $view_branch->street?>,</span>
                                    <span>Brgy. <?= $view_branch->barangay;?>,</span><span>
                                        <?= $view_branch->city; ?>,</span>
                                    <?= $view_branch->province;?>.
                                </h4>
                            </label>
                        </div>

                        <div class="col-12">
                            <label for="">
                                <h3>Status:</h3>
                            </label>
                            <label for="">
                                <?php if($view_branch->status == 'active'){ ?>
                                <h4 class="text-black"><span
                                        class="badge bg-success text-capitalize"><?= $view_branch->status ?></span>
                                </h4>

                                <?php }else{ ?>

                                <h4 class="text-black"><span
                                        class="badge bg-danger text-capitalize"><?= $view_branch->status ?></span>
                                </h4>

                                <?php

                                } ?>
                            </label>

                        </div>

                    </div>
                    <div class="card-footer bg-transparent border-success text-end ">
                        <a href="<?= site_url('BranchCtrl/'); ?>"><input type="button" value="Back"
                                class="btn_save"></a>

                    </div>


                </div>


            </div>

</main>