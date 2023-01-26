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

.btn_po {
    width: 100px;
    height: 35px;
    background-color: #2146C7;
    color: white;
    font-style: normal;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn_po:hover {
    background: green;
}

#table_style {
    font-size: 15px;
    font-weight: bold;
    color: black;
}

#bt {
    text-transform: none;
    width: 150px;
}
</style>

<div class="content">
    <div class="container-fluid">
        <h1 class="mb-3">View Purchase Order</h1>

        <div class="row">
            <div class="col-7 mb-1">
                <h4 class="txt">Purchase Order No: <span><?=$view_po->purchase_order_no?></span></h4>
                <h4 class="txt">Reference No: <?=$view_po->purchase_request_no?></h4>

                <h4 class="txt">Supplier Name: <span><?=$view_po->supplier_name?></span></h4>
            </div>
            <div class="col-5">
                <h4 class="txt">Posting Date: <?=$view_po->posting_date?></h4>
                <h4 class="txt">Created by: <span><?=$view_po->First_Name.' '.$view_po->Last_Name?></span></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <h4 class="txt">Address:
                    <span><?= ucfirst($view_po->street)?>&nbsp<span><?= ucfirst($view_po->barangay)?>&nbsp
                            <?= ucfirst($view_po->city)?>&nbsp<?= ucfirst($view_po->province)?></span>
                </h4>
                <h4 class="txt ">Contact #: <span><?=$view_po->contact?></span></h4>
            </div>
        </div>

    </div>


    <!--start table-->
    <div class="card border-success mb-3"
        style="max-width: 100%; border-radius:15px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">

        <div class="card-body text-success">
            <table class="table table-bordered" id="table_field">
                <thead>

                    <tr>

                        <th id="table_style">Item No.</th>
                        <th id="table_style">Description</th>
                        <th id="table_style">Unit</th>
                        <th id="table_style">Quantity</th>
                        <th id="table_style">Unit Cost</th>
                        <th id="table_style">Estimated Cost</th>

                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($get_po_sr as $row) {?>
                    <tr>
                        <td><?=$row->item_no?></td>
                        <td><?=$row->description?></td>
                        <td><?=$row->unit?></td>
                        <td><?=$row->quantity?></td>
                        <td><?=$row->unit_cost?></td>
                        <td> <?= number_format((float)$row->estimated_cost, 2, '.', ',');?></td>
                    </tr>
                    <?php } ?>

                    <tr>
                        <td colspan="5" class="text-end" style="font-weight:bold">Total Cost</td>
                        <td> <?= number_format((float)$view_po->total_amount, 2, '.', ',');?></td>
                    </tr>

                </tbody>
            </table>

        </div>

        <div class="card-footer bg-transparent border-success text-end ">

            <a href="<?= site_url('PurchaseOrderCtrl/manage_PO');?>"><input type="button" value="Back"
                    class="btn_save"></a>
        </div>

        <!--START TABLE-->

    </div>
</div>