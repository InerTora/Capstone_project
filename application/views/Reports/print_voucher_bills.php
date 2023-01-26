<link rel="stylesheet" href="<?=site_url('includes/Custom/css/print.css')?>">
</style>

<div class="container">
    <h1 class="text_head"> <u>Payment Voucher</h1>
    <p class="Source">Payment Voucher No: <span class="datafield"><?=$print_voucher->payment_voucher_no?></span></p>

    <p class="Source">Posting Date:<span class="datafield"> <?=$print_voucher->voucher_date?></span></p>
    <br>
    <p class="source2">Paid to: <span><?=ucfirst($print_voucher->supplier_name)?></span></p>
    <p class="source2">Address: <span><?=ucfirst($print_voucher->street)?>,</span>
        <span>Brgy. <?=ucfirst($print_voucher->barangay)?>, </span><span><?=ucfirst($print_voucher->city)?> City,</span>
        <span><?=ucfirst($print_voucher->province)?>.</span>
    </p>
    <p class="source2">Contact No: <span><?=$print_voucher->contact?></span></p>

    <p class="source2">Payment Method: <span> <?=$print_voucher->payment_method?></span></p>
    </p>
    </p>
    <table class="table-pv">
        <thead>
            <tr>
                <th>For the payment of:</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>

                <td class="data-details">
                    <?php foreach ($list_voucher as $row) { ?>
                    <?=$row->description?><span></span>
                    <span></span> <br>
                    <?php }?>
                </td>

                <td class="data-details">
                    <?php foreach ($list_voucher as $row) { ?>
                    <?= number_format((float)$row->amount, 2, '.', ',');?>
                    <br>
                    <?php }?>
                </td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th>Total</th>
                <th>Php </th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="data-total"></td>
                <td class="data-php"><?= number_format((float)$print_voucher->total_amount, 2, '.', ',');?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <p id="prepared-by">By:
        <?=$getuser->First_Name.' '. $getuser->Last_Name?></p>
    <br>
    <p id="signature">Authorized Signature</p>
</div>