<main class="content">
    <div class="container-fluid">
        <!-- Tabs navs -->
        <h3>Manage Accounts Payable Journal</h3>
        <hr>
        <sdiv class=" row">
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="approve">
                        <thead class="mb-2">
                            <tr>

                                <th style="">Billing No.</th>
                                <th style="">Supplier</th>
                                <th style="">Created By</th>
                                <th style="">Payment Method</th>
                                <th style="">Amount</th>
                                <th style="">Posting Date</th>
                                <th style="">Due Date</th>
                                <th style="">Status</th>
                                <th style="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($manager_table_ap as $row) { ?>
                            <tr>
                                <td><?=$row->billing_no?></td>
                                <td><?=$row->supplier_name?></td>
                                <td><?=$row->First_Name.' '.$row->Last_Name?></td>
                                <td><?=Ucfirst($row->payment_method)?></td>
                                <td><i class="fa-solid fa-peso-sign"></i>
                                    <?= number_format((float)$row->amount, 2, '.', ',');?>
                                </td>
                                <td><?=$row->ap_date?></td>
                                <td><?=$row->due_date?></td>
                                <td>
                                    <?php if ($row->isStatus == "Paid") {
                                       ?>
                                    <span class="badge bg-success">Paid</span>
                                    <?php
                                    }else{
                                        ?>
                                    <span class="badge bg-danger">Unpaid</span>
                                    <?php
                                    }
                                    
                                    ?>

                                </td>
                                <td>
                                    <a href="<?=site_url('FinanceCtrl/manager_view_ap_journal/'.$row->AP_ID);?>"><i
                                            class="fa-solid fa-eye fa-lg" data-mdb-toggle="tooltip"
                                            title="View A.P Details"></i></a>
                                </td>
                            </tr>

                            <?php }?>

                        </tbody>
                    </table>

                </div>
            </div>

        </sdiv>


    </div>
</main>