<link rel="stylesheet" href="<?=site_url('includes/Custom/css/print.css')?>">
</style>
<div class="container">
    <img src="<?= base_url('includes/Custom/image/Logo.png');?>" alt="alternatetext" class="logo">
    <h1 class="branch">iDrive Driving Tutorial</h1>
    <h2 class="branchname"><?=$get_branch->branch_name?></h2>
    <h3 class="address"><span><?= ucfirst($get_branch->street)?>, <span>Brgy. <?= ucfirst($get_branch->barangay)?>, <br>
                <?= ucfirst($get_branch->city)?> City, <?= ucfirst($get_branch->province)?>.</span></h3>
    <br>
    <h3 class="Report-Title">Payment Voucher List</h3>

    <br>
    <br>
    <br>
    <table class="table-report">
        <thead>
            <tr>

                <th>Payment Voucher No.</th>
                <th>Supplier</th>
                <th>Payment Method</th>
                <th>Total Amount</th>
                <th>Posting Date</th>
                <th>Requested By</th>
                <th>Branch</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($gen_reports_voucher as $row) { ?>
            <tr>
                <td><?= $row->payment_voucher_no?></td>
                <td><?= $row->supplier_name?></td>
                <td><?= $row->payment_method?></td>
                <td><?= number_format((float)$row->total_amount, 2, '.', ',');?></td>
                <td><?= $row->voucher_date?></td>
                <td><?=$row->First_Name.' '.$row->Last_Name?>

                <td><?= $row->branch_name?></td>

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