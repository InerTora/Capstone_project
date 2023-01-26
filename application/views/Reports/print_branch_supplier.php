<link rel="stylesheet" href="<?=site_url('includes/Custom/css/print.css')?>">
</style>
<div class="container">
    <img src="<?= base_url('includes/Custom/image/Logo.png');?>" alt="alternatetext" class="logo">
    <h1 class="branch">iDrive Driving Tutorial</h1>
    <h2 class="branchname"><?=$get_branch->branch_name?></h2>
    <h3 class="address"><span><?= ucfirst($get_branch->street)?>, <span>Brgy. <?= ucfirst($get_branch->barangay)?>, <br>
                <?= ucfirst($get_branch->city)?> City, <?= ucfirst($get_branch->province)?>.</span></h3>
    <br>
    <h2 class="Report-Title">Supplier List</h2>

    <br>
    <table class="table-report">
        <thead>
            <tr>
                <th>Supplier Name</th>
                <th>Address</th>
                <th>Contact</th>

            </tr>

        </thead>
        <tbody>

            <?php foreach ($report_supplier as $row) {?>

            <tr>
                <td><?=$row->supplier_name?></td>
                <td><span><?=ucfirst($row->street)?></span>, Brgy. <span><?=ucfirst($row->barangay)?></span>,
                    <span><?=ucfirst($row->city)?> City</span>,
                    <span><?=ucfirst($row->province)?></span>.
                </td>
                <!--trims the 0 number-->

                <td><?=$row->contact?></td>
            </tr>

            <?php } ?>

        </tbody>
    </table>
    <br>
    <br>
    <p class="space" id="date-generate">Date Generated: <br> <span><?=date('Y-m-d h:i:s A');?></span></p>
    <p class="space" id="prepared-by">Prepared By: <br>
        <span><?=ucwords($_SESSION['First_Name']).' '.ucwords($_SESSION['Last_Name'])?></span>
    </p>
</div>