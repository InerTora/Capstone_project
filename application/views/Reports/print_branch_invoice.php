<link rel="stylesheet" href="<?=site_url('includes/Custom/css/print.css')?>">
</style>
<div class="container">
    <img src="<?= base_url('includes/Custom/image/Logo.png');?>" alt="alternatetext" class="logo">
    <h1 class="branch">iDrive Driving Tutorial</h1>
    <h2 class="branchname"><?=$get_branch->branch_name?></h2>
    <h3 class="address"><span><?= ucfirst($get_branch->street)?>, <span>Brgy. <?= ucfirst($get_branch->barangay)?>, <br>
                <?= ucfirst($get_branch->city)?> City, <?= ucfirst($get_branch->province)?>.</span></h3>
    <br>
    <h3 class="Report-Title">Purchase Invoice List</h3>

    <br>
    <br>
    <br>
    <table class="table-report">
        <thead>
            <tr>

                <th>Purchase Invoice No.</th>
                <th>Purchase Order No.</th>
                <th>Supplier</th>
                <th>Total Amount</th>
                <th>Date Posted</th>
                <th>Due Date</th>
                <th>Created By</th>

            </tr>

        </thead>
        <tbody>
            <?php foreach ($print_invoice as $row) {?>
            <tr>
                <td><?=$row->purchase_invoice_no?></td>
                <td><?=$row->purchase_order_no?></td>
                <td><?=$row->supplier_name?></td>
                <td><?=$row->total_amount?></td>
                <td><?=$row->invoice_date?></td>
                <td><?=$row->due_date?></td>
                <td class="d-none d-xl-table-cell"><?=$row->First_Name.' '.$row->Last_Name?>


            </tr>

            <?php }?>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <p id="date-generate">Date Generated: <br> <span><?=date('Y-m-d h:i:s A');?></span></p>
    <p id="prepared-by">Prepared By: <br><br>
        <span><?=ucwords($_SESSION['First_Name']).' '.ucwords($_SESSION['Last_Name'])?></span>
    </p>
</div>