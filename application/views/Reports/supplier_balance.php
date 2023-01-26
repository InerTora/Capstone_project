<style>
.btn_save {
    width: 120px;
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
    width: 150px;
}
</style>

<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Supplier Balance To Date List</h1>

        <hr>
        <sdiv class="container mb-5">
            <div>
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>From Date</label>
                                <input id="from_date" type="text" name="from_date" required
                                    value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>To Date</label>
                                <input id="to_date" type="text" name="to_date" required
                                    value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-4 mt-3">
                            <div class="form-group">
                                <button type="button" id="btn_balance" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </sdiv>
        <!--Start-->
        <?php  echo form_open_multipart('Export_csv/gen_balance_export',array('onsubmit'=>'return confirm(\'Are you sure you want to export?\')'));?>
        <div class=" row">
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">

                    <table class="table my-0 w-100 row-border-none" id="report_po">
                        <thead>
                            <tr>

                                <th style="font-size:15px; font-weight:400px">Invoice No.</th>
                                <th style="font-size:15px; font-weight:400px">Supplier</th>

                                <th style="font-size:15px; font-weight:400px">Posting Date</th>
                                <th style="font-size:15px; font-weight:400px">Due Date</th>
                                <th style="font-size:15px; font-weight:400px"> Days Overdue</th>
                                <th style="font-size:15px; font-weight:400px"> Outstanding Balance</th>
                                <th style="font-size:15px; font-weight:400px"> Branch</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($gen_supplier_balance_list as $row) {?>

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
                                <td><?=$row->branch_name?></td>

                                <?php } ?>

                            </tr>
                        </tbody>

                        </tbody>
                    </table>
                    <div class="card-footer bg-transparent border-success text-center ">
                        <input type="submit" name="btn_export" value="Export to Excel" class="btn_save">
                        <a href="<?=site_url('ReportsCtrl/print_supplier_balance');?>" target='_blank'
                            onclick="return confirm('Are you sure you want to print?')"><input type="button"
                                value="Print" class="btn_save"></a>
                    </div>
                </div>
            </div>
        </div>

        <?= form_close()?>

    </div>
</main>