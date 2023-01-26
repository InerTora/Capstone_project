<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">User</h1>
        <!--Start-->
        <div class=" row">
            <div class="col-5 mb-3">
                <div class="col-xs-10 col-md-2 add">
                    <a href="<?php echo site_url('UserCtrl/create_user'); ?>" class="btn btn-primary bt"><i
                            class="fa-solid fa-plus"></i> Add User</a>
                </div>
            </div>
            <hr>
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="usertable">
                        <thead class="mb-2">
                            <tr>

                                <th style="font-size:15px; font-weight:400px">Name</th>
                                <th style="font-size:15px; font-weight:400px" class="d-none d-xl-table-cell">Username
                                </th>
                                <th style="font-size:15px; font-weight:400px" class="d-none d-xl-table-cell">Position
                                </th>
                                <th style="font-size:15px; font-weight:400px" class="d-none d-xl-table-cell">Branch Name
                                </th>
                                <th style="font-size:15px; font-weight:400px">Status</th>
                                <th style="font-size:15px; font-weight:400px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($page as $row) { ?>

                            <?php if($row->User_ID != $_SESSION['User_ID']) {?>
                            <tr class="mb-3">
                                <td>
                                    <?=ucwords($row->First_Name).' '. ucwords(mb_substr($row->Middle_Name, 0 , 1)). '. '. ucwords($row->Last_Name)?>
                                </td>
                                <td class="d-none d-xl-table-cell"><?=($row->Username)?></td>
                                <td class="d-none d-xl-table-cell"><?=ucwords($row->Position)?></td>
                                <td class="d-none d-xl-table-cell"><?=ucwords($row->branch_name)?></td>
                                <td>

                                    <?php if ($row->Status =="active") {  ?>
                                    <span class="badge bg-success">
                                        <a href="<?=site_url('UserCtrl/status/'.$row->User_ID);?>"
                                            onclick="return confirm('Are you sure you want to Deactivate?')"
                                            style="color:White; text-decoration:none;">
                                            <?=ucwords($row->Status)?></a>
                                    </span>
                                    <?php
                                    }else{
                                        ?>
                                    <span class="badge bg-danger"> <a
                                            href="<?=site_url('UserCtrl/status_active/'.$row->User_ID);?>"
                                            onclick="return confirm('Are you sure you want to Activate?')"
                                            style="color:White; text-decoration:none;">
                                            <?=ucwords($row->Status)?></a></span>

                                    <?php
                                    }

                                    ?>
                                </td>


                                <td>
                                    <a href="<?= site_url('userCtrl/view_user/'.$row->User_ID);?>"
                                        data-mdb-toggle="tooltip" title="View User Details"> <i
                                            class="fa-solid fa-eye fa-lg"></i> </a>
                                    <span>&nbsp </span>

                                    <a href="<?php echo site_url('UserCtrl/update_user/'.$row->User_ID); ?>"
                                        data-mdb-toggle="tooltip" title="Update User Details"> <i
                                            class="fa-solid fa-pen-to-square fa-lg"></i> </a>
                                </td>
                            </tr>

                            <?php } ?>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>
</main>