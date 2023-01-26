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
        <h1 class="h2 mb-3  text-dark">Manage Supplier</h1>
        <!--Start-->
        <div class=" row">

            <hr>
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="branchtable">
                        <thead class="mb-2">
                            <tr>

                                <th id="table_style">Supplier Name</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Contact</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Street</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Barangay</th>
                                <th id="table_style" class="d-none d-xl-table-cell">City</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Province</th>
                                <th id="table_style">Status</th>
                                <th id="table_style">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($supplier_branch as $row) { ?>
                            <tr class="mb-3">
                                <td>
                                    <?=$row->supplier_name?>
                                </td>
                                <td class="d-none d-xl-table-cell"><?=$row->contact?></td>
                                <td class="d-none d-xl-table-cell"><?=$row->street?></td>
                                <td class="d-none d-xl-table-cell"><?=$row->barangay?></td>
                                <td class="d-none d-xl-table-cell"><?=$row->city?></td>
                                <td class="d-none d-xl-table-cell"><?=$row->province?></td>

                                <?php if ($row->status =="active") {
                                    ?>
                                <td><span class="badge bg-success"><?=ucfirst($row->status)?></span></td>

                                <?php
  
                                    }else{
                                        ?>

                                <td><span class="badge bg-danger"><?=ucfirst($row->status)?></span></td>
                                <?php
                                    }?>



                                <td>

                                    <a href="<?= site_url('SupplierCtrl/branch_view_supplier/'.$row->supplier_id);?>"
                                        data-mdb-toggle="tooltip" title="View Supplier Details"><i
                                            class="fa-solid fa-eye view_btn text-center fa-lg"></i></a>


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