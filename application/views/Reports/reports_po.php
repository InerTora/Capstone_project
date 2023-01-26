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
    <h1 class="h2 mb-3  text-dark">Purchase Order List</h1>
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
                            <button type="button" id="btn_po" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </sdiv>
    <!--Start-->
    <?php  echo form_open_multipart('Export_csv/gen_po_export',array('onsubmit'=>'return confirm(\'Are you sure you want to export?\')'));?>
    <sdiv class=" row">
        <div class="card border-success mb-3" style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <div class="card-body">

                <table class="table my-0 w-100 row-border-none" id="report_po">
                    <thead class="mb-2">
                        <tr>

                            <th style="font-size:15px; font-weight:400px">Purchase Request No.</th>
                            <th style="font-size:15px; font-weight:400px">Purchase Order No.</th>
                            <th style="font-size:15px; font-weight:400px">Supplier</th>
                            <th style="font-size:15px; font-weight:400px">Posting Date</th>
                            <th style="font-size:15px; font-weight:400px">Created By</th>
                            <th style="font-size:15px; font-weight:400px">Position</th>
                            <th style="font-size:15px; font-weight:400px">Branch</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($po_print as $row) { ?>
                        <tr class="po_data">

                            <td><?=$row->purchase_request_no?></td>
                            <td><?=$row->purchase_order_no?></td>
                            <td><?=$row->supplier_name?></td>
                            <td><?=$row->po_date?></td>
                            <td class="d-none d-xl-table-cell"><?=$row->First_Name.' '.$row->Last_Name?>
                            <td><?= $row->Position?></td>
                            <td><?=$row->branch_name?></td>
                        </tr>

                        <?php } ?>

                    </tbody>
                </table>

            </div>

            <div class="card-footer bg-transparent border-success text-center ">
                <input type="submit" name="btn_export" value="Export to Excel" class="btn_save">
                <a href="<?=site_url('ReportsCtrl/print_po');?>" target="_blank"
                    onclick="return confirm('Are you sure you want to print?')"><input type="button" value="Print"
                        class="btn_save"></a>
            </div>
        </div>


    </sdiv>
    <?= form_close()?>

    </div>
</main>
</body>

</html>