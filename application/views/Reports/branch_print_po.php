<link rel="stylesheet" href="<?=site_url('includes/Custom/css/print.css')?>">
</style>
<div class="container">
    <img src="<?= base_url('includes/Custom/image/Logo.png');?>" alt="alternatetext" class="logo">
    <h1 class="branch">iDrive Driving Tutorial</h1>
    <h2 class="branchname"><?=$get_branch->branch_name?></h2>
    <h3 class="address"><span><?= ucfirst($get_branch->street)?>, <span>Brgy. <?= ucfirst($get_branch->barangay)?>, <br>
                <?= ucfirst($get_branch->city)?> City, <?= ucfirst($get_branch->province)?>.</span></h3>
    <br>
    <h3 class="Report-Title">Purchase Order List</h3>

    <br>
    <br>
    <br>
    <table class="table-report">
        <thead>
            <tr>
                <th>Purchase Request No</th>
                <th>Purchase Order No</th>
                <th>Supplier</th>
                <th>Posting Date</th>
                <th>Created By</th>
                <th>Position</th>

            </tr>

        </thead>
        <tbody>

            <?php foreach ($po_print as $row) { ?>
            <tr>
                <td><?=$row->purchase_request_no?></td>
                <td><?=$row->purchase_order_no?></td>
                <td><?=$row->supplier_name?></td>
                <td><?=$row->po_date?></td>
                <td><?=$row->First_Name.' '.$row->Last_Name?>
                <td><?= $row->Position?></td>

            </tr>

            <?php } ?>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <p id="date-generate">Date Generated: <br> <span><?=date('Y-m-d h:i:s A');?></span></p>
    <p id="prepared-by">Prepared By: <br>
        <span><?=ucwords($_SESSION['First_Name']).' '.ucwords($_SESSION['Last_Name'])?></span>
    </p>
</div>