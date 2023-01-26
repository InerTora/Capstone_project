<link rel="stylesheet" href="<?=site_url('includes/Custom/css/print.css')?>">
</style>
<div class="container">
    <img src="<?= base_url('includes/Custom/image/Logo.png');?>" alt="alternatetext" class="logo">
    <h1 class="branch">iDrive Driving Tutorial</h1>
    <h2 class="branchname"><?=$get_branch->branch_name?></h2>
    <h3 class="address"><span><?= ucfirst($get_branch->street)?>, <span>Brgy. <?= ucfirst($get_branch->barangay)?>, <br>
                <?= ucfirst($get_branch->city)?> City, <?= ucfirst($get_branch->province)?></span></h3>
    <br>
    <h3 class="Report-Title">Supplier Balance To Date</h3>
    <br>
    <br>
    <br>
    <table class="table-report">
        <thead>
            <tr>

                <th style="font-size:15px; font-weight:400px">Invoice No.</th>
                <th style="font-size:15px; font-weight:400px">Supplier</th>

                <th style="font-size:15px; font-weight:400px">Posting Date</th>
                <th style="font-size:15px; font-weight:400px">Due Date</th>
                <th style="font-size:15px; font-weight:400px"> Days Overdue</th>
                <th style="font-size:15px; font-weight:400px"> Outstanding Balance</th>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($supplier_balance_list as $row) {?>

            <tr class="balance_data">
                <td><?=$row->purchase_invoice_no?></td>
                <td><?=$row->supplier_name?></td>
                <td><?=$row->invoice_date?></td>
                <td><?=$row->due_date?></td>
                <!-- Check if the date is expired and count the days -->
                <?php  
                               if (!$row->balance == "0") {
                                $exp_date = $row->due_date;
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
                               }else{

                                ?>
                <td>0</td>
                <?php
                               }

                                ?>
                <td><?= $row->balance?></td>

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