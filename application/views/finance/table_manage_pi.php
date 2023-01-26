<style>
#table_style {
    font-size: 15px;
    font-weight: bold;
    color: black;
}

#bt {
    text-transform: none;
    width: 150px;
}
</style>

<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Manage Purchase Invoice</h1>
        <hr>
        <!--Start-->
        <div class=" row">
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="manage_invoice">
                        <thead class="mb-2">
                            <tr>

                                <th id="table_style">Purchase Invoice No.</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Reference No.</th>
                                <th id="table_style">Supplier</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Total Amount</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Due Date</th>
                                <th id="table_style">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  foreach ($get_purchase_invoice as $row) { ?>

                            <tr>
                                <td><?=$row->purchase_invoice_no?></td>
                                <td><?=$row->purchase_order_no?></td>
                                <td><?=$row->supplier_name?></td>
                                <td><i class="fa-solid fa-peso-sign"></i> <?=$row->total_amount?></td>
                                <td><?=$row->due_date?></td>
                                <td>

                                    <?php if ($row->payable_type == "Gasoline") {
                                ?>
                                    <a href="<?=site_url('FinanceCtrl/finance_view_pi/'.$row->PI_ID);?>"><i
                                            class="fa-solid fa-eye fa-lg"></i></a>

                                    <?php if ($row->sent == "0") {
                                       ?>
                                    <a href="<?=site_url('FinanceCtrl/finance_update_PI/'.$row->PI_ID);?>"><i
                                            class="fa-regular fa-pen-to-square fa-lg"></i></a>
                                    <?php
                                    }?>
                                    <?php
                                   }else{

                                    ?>
                                    <a href="<?=site_url('FinanceCtrl/finance_view_pi_sr/'.$row->PI_ID);?>"><i
                                            class="fa-solid fa-eye fa-lg"></i></a>

                                    <?php if ($row->sent == "0") {
                                       ?>
                                    <a href="<?=site_url('FinanceCtrl/finance_update_PI_sr/'.$row->PI_ID);?>"><i
                                            class="fa-regular fa-pen-to-square fa-lg"></i></a>
                                    <?php
                                    }?>

                                    <?php
                                   }?>



                                </td>

                            </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>
</main>