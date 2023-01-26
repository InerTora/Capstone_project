<link rel="stylesheet" href="<?=site_url('includes/Custom/css/print.css')?>">
</style>
<div class="container">
    <img src="<?= base_url('includes/Custom/image/Logo.png');?>" alt="alternatetext" class="logo">
    <h1 class="branch">iDrive Driving Tutorial</h1>
    <h2 class="branchname"><?=$get_branch->branch_name?></h2>
    <h3 class="address"><span><?= ucfirst($get_branch->street)?>, <span>Brgy. <?= ucfirst($get_branch->barangay)?>, <br>
                <?= ucfirst($get_branch->city)?> City, <?= ucfirst($get_branch->province)?>.</span></h3>
    <br>
    <h2 class="Report-Title">Accounts Payable Ledger</h2>

    <br>
    <table class="table-report">
        <thead>
            <tr>
                <th>Ledger No.</th>
                <th>Reference No.</th>
                <th>Payment Voucher</th>
                <th>Supplier</th>
                <th>Invoice Amount</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Branch</th>

            </tr>

        </thead>
        <tbody>


            <?php foreach ($table_ledger1 as $row) {?>
            <tr>
                <td><?=$row->AP_no?></td>
                <td><?=$row->isReference?></td>
                <td><?=$row->PV_ID?></td>
                <td><?=$row->supplier_name?></td>
                <td><i class="fa-solid fa-peso-sign"></i><?=$row->invoice_amount?>
                </td>
                <td><?=$row->isDue_date?></td>
                <td>
                    <?php if ($row->isStatus == "Paid") {
                                  ?>
                    <span class="badge bg-success"> <?=$row->isStatus?></span>
                    <?php
                                   }else{
                                    ?>
                    <span class="badge bg-danger"> <?=$row->isStatus?></span>
                    <?php
                                   }?>
                </td>

                <td><?=$row->branch_name?></td>

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