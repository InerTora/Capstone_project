<style>
.name {
    margin-top: 23px;
    padding: -20px;
    margin-left: 120px;

}

.amount {
    margin-top: 27px;
    padding: -20px;
    text-align: right;
    margin-right: 80px;
}

.date {
    margin-top: -220px;
    margin-bottom: -100px;
    text-align: right;
    margin-right: 80px;
}

.word {
    margin-top: 23px;

    margin-left: 120px;

}
</style>
<?php
$this->load->library('numbertowordconvertsconver');
$number = $print_cheque->total_amount;

?>
<div class="container">
    <!-- <img src="<?=site_url('includes/Custom/image/cheque.jpg')?>" alt=""> -->
    <div class="col-4">

        <p class="date"><?=$print_cheque->voucher_date?></p>
        <p class="name">***<?=ucwords($_SESSION['First_Name'].' '.$_SESSION['Last_Name']) ?>***</p>
        <p class="amount">***<?=$print_cheque->total_amount?>***</p>
        <p class="word">***<?=$this->numbertowordconvertsconver->convert_number($number);?> Only***</p>
    </div>
    <?php

    ?>