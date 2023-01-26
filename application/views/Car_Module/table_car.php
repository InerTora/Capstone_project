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
        <h1 class="h2 mb-3  text-dark">Manage Vehicles</h1>
        <!--Start-->
        <div class=" row">
            <div class="col-5 mb-3">
                <div class="col-xs-10 col-md-2 add">
                    <a href="<?php echo site_url('CarCtrl/add_car'); ?>" class="btn btn-primary btsupplier" id="bt"><i
                            class="fa-solid fa-plus"></i> Add Vehicle</a>
                </div>
            </div>
            <hr>
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="cartable">
                        <thead class="mb-2">
                            <tr>
                                <th id="table_style">Plate No/MV File</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Brand</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Color</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Chassis No</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Branch</th>
                                <th id="table_style">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($table_car as $row) {?>
                            <tr>
                                <td><?=$row->plate_no?></td>
                                <td class="d-none d-xl-table-cell"><?=$row->brand?></td>
                                <td class="d-none d-xl-table-cell"> <?=$row->color?></td>
                                <td class="d-none d-xl-table-cell"><?=$row->chassis_no?></td>
                                <td class="d-none d-xl-table-cell"><?=$row->branch_name?></td>
                                <td>
                                    <a href="<?= site_url('carCtrl/update_car/'.$row->car_id);?>"
                                        data-mdb-toggle="tooltip" title="Update Car Details"><i
                                            class="fa-regular fa-pen-to-square text-center fa-lg"></i></a>
                                    <a href="<?= site_url('CarCtrl/delete_car/'.$row->car_id);?>"
                                        data-mdb-toggle="tooltip" title="Delete Car Details"
                                        onclick="return confirm('Are you sure you want to delete?')"><i
                                            class="fa-solid fa-trash fa-lg"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>
</main>