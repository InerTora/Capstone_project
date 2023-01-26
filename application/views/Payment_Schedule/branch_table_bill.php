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
    width: 180px;
}
</style>

<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Billing Type</h1>
        <!--Start-->
        <div class=" row">
            <div class="col-5 mb-3">
                <div class="col-6">
                    <a href="<?php echo site_url('ScheduleCtrl/branch_add_billing'); ?>" class="btn btn-primary"
                        style="text-decoration:none; font-size: 15px; color:white;" id="bt"><i
                            class="fa-solid fa-plus"></i> Add
                        Billing Type</a>
                </div>
            </div>
            <hr>
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="paymenttable">
                        <thead class="mb-2">
                            <tr>

                                <th style="font-size:15px; font-weight:400px" class="text-center">Billing Type</th>

                                <th style="font-size:15px; font-weight:400px" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($table_bills as $row) { ?>

                            <tr>
                                <td class="text-center"><?= ucwords($row->Type)?></td>
                                <td class="text-center">
                                    <a href="<?= site_url('ScheduleCtrl/branch_update_bill/'.$row->billing_type_id);?>"><i
                                            class="fa-regular fa-pen-to-square text-center fa-lg"></i></a>
                                    <a href="<?= site_url('ScheduleCtrl/delete_bill/'.$row->billing_type_id);?>"
                                        onclick="return confirm('Are you sure you want to Cancel?')"><i
                                            class="fa-solid fa-trash fa-lg"></i></a>
                                </td>
                                </td>

                            </tr>
                            <?php
                        }?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>
</main>