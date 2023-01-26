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
        <h1 class="h2 mb-3  text-dark">Vehicle Details</h1>
        <!--Start-->
        <div class=" row">

            <hr>
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="cartable">
                        <thead class="mb-2">
                            <tr>
                                <th id="table_style">Plate No/MV File</th>
                                <th id="table_style">Brand</th>
                                <th id="table_style">Color</th>
                                <th id="table_style">Chassis No</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($branch_table_car as $row) {?>
                            <tr>
                                <td><?=$row->plate_no?></td>
                                <td><?=$row->brand?></td>
                                <td><?=$row->color?></td>
                                <td><?=$row->chassis_no?></td>

                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>
</main>