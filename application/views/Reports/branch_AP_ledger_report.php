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
    <h1 class="h2 mb-3  text-dark">Accounts Payable Ledger</h1>
    <div class="container mb-5">
        <div>
            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>From Date</label>
                            <input id="from_date" type="text" name="from_date"
                                value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>To Date</label>
                            <input id="to_date" type="text" name="to_date"
                                value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-4 mt-3">
                        <div class="form-group">
                            <button type="button" id="branch_ap_filter" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--Start-->
    <?php  echo form_open_multipart('Export_csv/branch_ap_export',array('onsubmit'=>'return confirm(\'Are you sure you want to export?\')'));?>
    <sdiv class=" row">
        <div class="card border-success mb-3" style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <div class="card-body">

                <table class="table my-0 w-100 row-border-none" id="report_supplier">
                    <thead class="mb-2">
                        <tr>
                            <th>Ledger No.</th>
                            <th>Reference No.</th>
                            <th>Payment Voucher</th>
                            <th>Supplier</th>
                            <th>Invoice Amount</th>
                            <th>Due Date</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($table_ledger as $row) {?>
                        <tr class="branch_ap_data">
                            <td><?=$row->AP_no?></td>
                            <td><?=$row->isReference?></td>
                            <td><?=$row->PV_ID?></td>
                            <td><?=$row->supplier_name?></td>
                            <td><i class="fa-solid fa-peso-sign"></i><?=$row->invoice_amount?>
                            </td>
                            <td><?=$row->isDue_date?></td>
                            <td>
                                <?php if ($row->isStatus == "Paid") {
                                  ?>
                                <span class="badge bg-success"> <?=$row->isStatus?></span>
                                <?php
                                   }else{
                                    ?>
                                <span class="badge bg-danger"> <?=$row->isStatus?></span>
                                <?php
                                   }?>
                            </td>
                        </tr>

                        <?php } ?>

                    </tbody>
                </table>

            </div>
            <div class="card-footer bg-transparent border-success text-center ">
                <input type="submit" name="btn_export" value="Export to Excel" class="btn_save">
                <a href="<?=site_url('ReportsCtrl/branch_print_ap_ledger');?>" target='_blank'
                    onclick="return confirm('Are you sure you want to Print?')"><input type="button" value="Print"
                        class="btn_save"></a>
            </div>
        </div>
    </sdiv>

    <?= form_close()?>

    </div>
</main>
</body>

</html>