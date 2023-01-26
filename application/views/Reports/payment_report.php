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
        <h1 class="h2 mb-3  text-dark">Payment Schedule List</h1>
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
                                <button type="button" id="btn_payment" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </sdiv>
        <!--Start-->

        <?php  echo form_open_multipart('Export_csv/gen_schedule_export',array('onsubmit'=>'return confirm(\'Are you sure you want to export?\')'));?>
        <sdiv class=" row">
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table cellspacing="5" cellpadding="5" border="0">
                        <tbody>

                        </tbody>
                    </table>
                    <table class="table my-0 w-100 row-border-none" id="report_supplier">
                        <thead class="mb-2">
                            <tr>
                                <th style="">Reference No.</th>
                                <th style="font-size:15px; font-weight:400px">Billing Type</th>
                                <th style="font-size:15px; font-weight:400px">Total Amount</th>
                                <th style="font-size:15px; font-weight:400px">Due Date</th>
                                <th style="font-size:15px; font-weight:400px">Status</th>
                                <th style="font-size:15px; font-weight:400px">Branch</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payment_list as $row) {?>

                            <tr class="payment_data">
                                <td><?=$row->isReference?></td>
                                <td><?=$row->payable_type?></td>
                                <td><i class="fa-solid fa-peso-sign"></i>
                                    <?= $row->invoice_amount;?>
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
                </div>
                <div class="card-footer bg-transparent border-success text-center ">
                    <input type="submit" name="btn_export" value="Export to Excel" class="btn_save">
                    <a href="<?=site_url('ReportsCtrl/print_paysched');?>" target="_blank"
                        onclick="return confirm('Are you sure you want to print?')"><input type="button" value="Print"
                            class="btn_save"></a>
                </div>
            </div>
        </sdiv>

        <?= form_close()?>
    </div>
</main>