<link rel="stylesheet" href="<?=site_url('includes/Custom/css/print.css')?>">
</style>
<div class="container">
    <img src="<?= base_url('includes/Custom/image/Logo.png');?>" alt="alternatetext" class="logo">
    <h1 class="branch">iDrive Driving Tutorial</h1>
    <h2 class="branchname"><?=$get_branch->branch_name?></h2>
    <h3 class="address"><span><?= ucfirst($get_branch->street)?>, <span>Brgy. <?= ucfirst($get_branch->barangay)?>, <br>
                <?= ucfirst($get_branch->city)?> City, <?= ucfirst($get_branch->province)?>.</span></h3>
    <br>
    <h2 class="Report-Title">Paid Accounts Ledger</h2>

    <br>
    <table class="table-report">
        <thead>
            <tr>
                <th>Paid Accounts No.</th>
                <th>Payment Voucher No.</th>
                <th>Supplier</th>
                <th>Paid Amount</th>
                <th>Receipt No</th>
                <th>Posting Date</th>


            </tr>

        </thead>
        <tbody>

            <?php foreach ($table_pa as $row) {?>

            <tr>
                <td><?=$row->PA_no?></td>
                <td><?=$row->payment_voucher_no?></td>
                <td><?=$row->supplier_name?></td>
                <td><i class="fa-solid fa-peso-sign"></i>
                    <?= number_format((float)$row->total_amount, 2, '.', ',');?>
                </td>
                <td>
                    <?=$row->reciept_no?>

                </td>

                <td><?=$row->voucher_date?></td>

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
    <p id="date-generate">Date Generated: <br> <span><?=date('Y-m-d h:i:s A');?></span></p>
    <p id="prepared-by">Prepared By: <br><br>
        <span><?=ucwords($_SESSION['First_Name']).' '.ucwords($_SESSION['Last_Name'])?></span>
    </p>
</div>