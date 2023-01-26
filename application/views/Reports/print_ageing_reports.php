<link rel="stylesheet" href="<?=site_url('includes/Custom/css/print.css')?>">
</style>
<div class="container">
    <img src="<?= base_url('includes/Custom/image/Logo.png');?>" alt="alternatetext" class="logo">
    <h1 class="branch">iDrive Driving Tutorial</h1>
    <h2 class="branchname"><?=$get_branch->branch_name?></h2>
    <h3 class="address"><span><?= ucfirst($get_branch->street)?>, <span>Brgy. <?= ucfirst($get_branch->barangay)?>, <br>
                <?= ucfirst($get_branch->city)?> City, <?= ucfirst($get_branch->province)?>.</span></h3>
    <br>
    <h3 class="Report-Title">Accounts Payable Ageing List</h3>

    <br>
    <br>
    <br>
    <table class="table-report">
        <thead>
            <tr>
                <th style="font-size:15px; font-weight:400px">Reference No</th>
                <th style="font-size:15px; font-weight:400px">Supplier</th>
                <th style="font-size:15px; font-weight:400px">Due Date</th>
                <th style="font-size:15px; font-weight:400px">Current Amount</th>
                <th style="font-size:15px; font-weight:400px">Days Overdue</th>
                <th style="font-size:15px; font-weight:400px">Outstanding Balance</th>
                <th style="font-size:15px; font-weight:400px">Created By</th>
                <th style="font-size:15px; font-weight:400px">Branch</th>

            </tr>

        </thead>
        <tbody>
            <?php foreach ($ap_ageing as $row) { ?>
            <tr>
                <td><?=$row->isReference?></td>
                <td><?=$row->supplier_name?></td>

                <td><?=$row->isDue_date?></td>
                <td><i class="fa-solid fa-peso-sign"></i> <?=$row->invoice_amount?></td>
                <?php  
                                
                                $exp_date = $row->isDue_date;
                                $today_date = date('Y-m-d');

                                $exp = strtotime($exp_date);
                                $td = strtotime($today_date);

                                if ($td > $exp) {
                                    $diff = $td-$exp;
                                    $days = abs(floor($diff / (60*60*24)));
                                   ?>
                <td><?=$days?></td>
                <?php
                                }else{
                                    ?>

                <td>0</td>
                <?php

                                }
                                ?>

                <td><i class="fa-solid fa-peso-sign"></i> <?=$row->balance?></td>
                <td class="d-none d-xl-table-cell"><?=$row->First_Name.' '.$row->Last_Name?>
                <td><?=$row->branch_name?></td>
            </tr>

            <?php } ?>


        </tbody>



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