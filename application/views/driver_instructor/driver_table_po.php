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
        <h1 class="h2 mb-3  text-dark">Create Purchase Order</h1>
        <hr>
        <!--Start-->
        <div class=" row">
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="branchtable">
                        <thead class="mb-2">
                            <tr>

                                <th id="table_style">Purchase Request No.</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Supplier</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Posting Date</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Status</th>
                                <th id="table_style">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($driver_table_po as $row) {?>

                            <tr>
                                <td><?=$row->purchase_request_no?></td>
                                <td><?=$row->supplier_name?></td>
                                <td><?=$row->posting_date?></td>
                                <td><span class="badge bg-success"><?=ucfirst($row->isPending)?></span></td>
                                <td>

                                    <?php if ($row->payable_type == "Gasoline") {
                                ?>
                                    <a href="<?= site_url('PurchaseOrderCtrl/driver_create_po/'.$row->purchase_request_id);?>"
                                        data-mdb-toggle="tooltip" title="Create P.O"><i
                                            class="fa-solid fa-arrow-up-right-from-square fa-lg"></i></a>

                                    <?php
                                  }else{
                    ?>
                                    <a href="<?= site_url('PurchaseOrderCtrl/driver_create_sr/'.$row->purchase_request_id);?>"
                                        data-mdb-toggle="tooltip" title="Create P.O"><i
                                            class="fa-solid fa-arrow-up-right-from-square fa-lg"></i></a>

                                    <?php


                                  }?>
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