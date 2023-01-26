<link rel="stylesheet" href="<?=site_url('includes/Custom/css/print.css')?>">
</style>
<div class="container">
    <img src="<?= base_url('includes/Custom/image/Logo.png');?>" alt="alternatetext" class="logo">
    <h1 class="branch">iDrive Driving Tutorial</h1>
    <h2 class="branchname"><?=$get_branch->branch_name?></h2>
    <h3 class="address"><span><?= ucfirst($get_branch->street)?>, <span>Brgy. <?= ucfirst($get_branch->barangay)?>, <br>
                <?= ucfirst($get_branch->city)?> City, <?= ucfirst($get_branch->province)?>.</span></h3>
    <br>
    <h2 class="Report-Title">Payment Schedule List</h2>

    <br>
    <table class="table-report">
        <thead>
            <tr>
                <th>Reference No.</th>
                <th>Billing Type</th>
                <th>Total Amount</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Branch</th>
            </tr>

        </thead>
        <tbody>
            <?php foreach ($payment_list as $row) {?>

            <tr>
                <td><?=$row->isReference?></td>
                <td><?=$row->payable_type?></td>
                <td><i class="fa-solid fa-peso-sign"></i>
                    <?= number_format((float)$row->invoice_amount, 2, '.', ',');?>
                </td>
                <td><?=$row->isDue_date?></td>
                <?php
                                $exp_date = $row->isDue_date;
                                $today_date = date('Y-m-d');
                                $exp = strtotime($exp_date);
                                $td = strtotime($today_date);

                                if ($td>$exp && $row->isStatus =="Unpaid") {?>

                <td><span class="badge bg-danger">OverDue</span></a></td>

                <?php }else{

                                    if ($row->isStatus == "Unpaid") {
                                      ?>
                <td><span class="badge bg-danger"><?=$row->isStatus?></span></a></td>

                <?php }else{
                                    ?>
                <td>
                    <span class="badge bg-success"><?=$row->isStatus?></span>
                </td>

                <?php
                                    
                                }
                                    
                                } ?>
                <!-- <td class="d-none d-xl-table-cell"><?=$row->First_Name.' '.$row->Last_Name?>
                            <td><?= $row->Position?></td> -->
                <td><?= $row->branch_name?></td>

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