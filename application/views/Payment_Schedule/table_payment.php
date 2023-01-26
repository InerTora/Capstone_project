<style>
.btn_save {
    width: 80px;
    height: 35px;
    background-color: #2146C7;
    color: white;
    font-style: normal;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn_save:hover {
    background: green;
}

#table_style {
    font-size: 15px;
    font-weight: 400px
}

#bt {
    text-transform: none;
    width: 180px;
}
</style>

<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Payment Schedule</h1>
        <!--Start-->
        <hr>
        <div class=" row">

            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="paymenttable">
                        <thead class="mb-2">
                            <tr>
                                <th id="table_style">Accounts Payable No.</th>
                                <th id="table_style">Billing Type</th>
                                <th id="table_style">Supplier</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Total Amount</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Due Date</th>
                                <th id="table_style" class="d-none d-xl-table-cell">Days Overdue</th>
                                <th id="table_style">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($schedule_table_ledger as $row) {?>
                            <tr>
                                <td><?=$row->isReference?></td>
                                <td><?=$row->payable_type?></td>
                                <td><?=$row->supplier_name?></td>
                                <td><i class="fa-solid fa-peso-sign"></i> <?=$row->invoice_amount?>
                                </td>

                                <td><?=$row->isDue_date?></td>
                                <td>
                                    <?php  
                                
                                $exp_date = $row->isDue_date;
                                $today_date = date('Y-m-d');

                                $exp = strtotime($exp_date);
                                $td = strtotime($today_date);

                                if ($td >= $exp && $row->isStatus =="Unpaid") {
                                    $diff = $td-$exp;
                                    $days = abs(floor($diff / (60*60*24)));
                                   ?>

                                    <span><?=$days?></span>
                                    <?php
                                }else{
                                    ?>

                                    <span>0</span>
                                    <?php

                                }
                                ?>
                                </td>
                                <?php 
                                $exp_date = $row->isDue_date;
                                $today_date = date('Y-m-d');
                                $exp = strtotime($exp_date);
                                $td = strtotime($today_date);
                                if ($td>$exp && $row->isStatus =="Unpaid") {
                                 ?>
                                <td>
                                    <span class="badge bg-danger">Overdue</span>

                                    <?php
                                }else{

                                   if ($row->isStatus == "Unpaid") {
                                  
                                    ?>
                                <td>
                                    <span class="badge bg-danger"><?=$row->isStatus?></span>

                                    <?php

                                   }else{
?>
                                <td>
                                    <span class="badge bg-success"><?=$row->isStatus?></span>
                                </td>

                                <?php
                                    
                                   }
                                }
                                
                                ?>

                            </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</main>