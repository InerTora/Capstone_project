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
        <h1 class="h2 mb-3  text-dark">Payment Voucher List</h1>
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
                                <button type="button" id="btn_voucher" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </sdiv>
        <!--Start-->
        <?php  echo form_open_multipart('Export_csv/gen_voucher_export',array('onsubmit'=>'return confirm(\'Are you sure you want to export?\')'));?>
        <div class=" row">
            <div class=" row">
                <div class="card border-success mb-3"
                    style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                    <div class="card-body">
                        <table class="table my-0 w-100 row-border-none" id="report_po">
                            <thead class="mb-2">
                                <tr>
                                    <th id="table_style" class="d-none d-xl-table-cell">Payment Voucher No.</th>
                                    <th id="table_style" class="d-none d-xl-table-cell">Supplier</th>
                                    <th id="table_style" class="d-none d-xl-table-cell">Payment Method</th>
                                    <th id="table_style" class="d-none d-xl-table-cell">Total Amount</th>
                                    <th id="table_style" class="d-none d-xl-table-cell">Posting Date</th>
                                    <th id="table_style" class="d-none d-xl-table-cell">Created By</th>

                                    <th id="table_style" class="d-none d-xl-table-cell">Branch</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($gen_reports_voucher as $row) { ?>
                                <tr class="voucher_data">
                                    <td><?= $row->payment_voucher_no?></td>
                                    <td><?= $row->supplier_name?></td>
                                    <td><?= $row->payment_method?></td>
                                    <td><i
                                            class="fa-solid fa-peso-sign"></i><?= number_format((float)$row->total_amount, 2, '.', ',');?>
                                    </td>

                                    <td><?= $row->voucher_date?></td>
                                    <td class="d-none d-xl-table-cell"><?=$row->First_Name.' '.$row->Last_Name?>

                                    <td><?= $row->branch_name?></td>
                                </tr>

                                <?php }?>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-transparent border-success text-center ">

                        <input type="submit" name="btn_export" value="Export to Excel" class="btn_save">
                        <a href="<?=site_url('ReportsCtrl/final_voucher');?>" target="_blank"
                            onclick="return confirm('Are you sure you want to print?')"><input type="button"
                                value="Print" class="btn_save"></a>
                    </div>
                </div>

            </div>

            <?= form_close()?>

        </div>
</main>