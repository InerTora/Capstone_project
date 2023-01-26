<link rel="stylesheet" href="<?=site_url('includes/Custom/css/print.css')?>">
</style>
<div class="container">
    <img src="<?= base_url('includes/Custom/image/Logo.png');?>" alt="alternatetext" class="logo">
    <h1 class="branch">iDrive Driving Tutorial</h1>
    <h2 class="branchname"><?=$get_branch->branch_name?></h2>
    <h3 class="address"><span><?= ucfirst($get_branch->street)?>, <span>Brgy. <?= ucfirst($get_branch->barangay)?>, <br>
                <?= ucfirst($get_branch->city)?>, <?= ucfirst($get_branch->province)?>.</span></h3>
    <h3 class="PO-Title"><u>Purchase Order</u></h3>
    <h3 class="PO-Number">Purchase Order No.: <?=$view_po->purchase_order_no?></h3>
    <h3 class="date">Posting Date: <?=$view_po->po_date?></h3>
    <h3 class="Ref">Reference No.: <?=$view_po->purchase_request_no?></h3>
    <h3 class="supplier">Supplier Name: <?=$view_po->supplier_name?></h3>
    <h3 class="supplier">Address: <span><?= ucwords($view_po->street)?>, <span>Brgy. <?= ucwords($view_po->barangay)?>,
                <?= ucwords($view_po->city)?> City, <?= ucwords($view_po->province)?>.</span></h3>
    <h3 class="supplier">Contact No.: <?=$view_po->contact?></h3>
    <h3 class="supplier">Payment Method: <?=ucwords($view_po->payment_method)?></h3>
    <table class="table-po">
        <thead>
            <tr>

                <th>Plate No.</th>
                <th>Description</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Unit Cost</th>
                <th>Estimated Cost</th>

            </tr>

        </thead>
        <tbody>
            <?php foreach ($get_po as $row) {
    ?>
            <tr>
                <td class="po_style"><?=$row->plate_no?></td>
                <td class="po_style"><?=$row->description?></td>
                <td class="po_style"><?=$row->unit?></td>
                <td class="total_cost1"><?=$row->quantity?></td>
                <td class="total_cost1"><?=$row->unit_cost?></td>
                <td class="total_cost1"> <?= number_format((float)$row->estimated_cost, 2, '.', ',');?></td>
            </tr>
            <?php
        }?>
            <tr class="total_cost_style">
                <td colspan="5" class="total_cost2">Total Cost</td>
                <td class="total_cost3"> <?= number_format((float)$view_po->total_amount, 2, '.', ',');?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <p id="date-generate">Date Generated: <br> <span><?=date('Y-m-d h:i:s A');?></span></p>
    <p id="prepared-by">Prepared By: <br><br>
        <span><?=$_SESSION['First_Name'].' '.$_SESSION['Last_Name']?></span>

    </p>

</div>