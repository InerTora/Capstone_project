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
    <h1 class="h2 mb-3  text-dark">Supplier List</h1>

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
                            <button type="button" id="filter_report" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </sdiv>
    <!--Start-->

    <?php  echo form_open_multipart('Export_csv/supplier_export',array('onsubmit'=>'return confirm(\'Are you sure you want to export?\')'));?>
    <sdiv class=" row">
        <div class="card border-success mb-3" style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <div class="card-body">

                <table class="table my-0 w-100 row-border-none" id="report_supplier">
                    <thead class="mb-2">
                        <tr>
                            <th style="font-size:15px; font-weight:400px">Supplier Name</th>
                            <th style="font-size:15px; font-weight:400px">Address</th>
                            <th style="font-size:15px; font-weight:400px">Contact</th>
                            <th style="font-size:15px; font-weight:400px">Status</th>
                            <th style="font-size:15px; font-weight:400px">Date Created</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                             foreach($gen_report_supplier as $row)
                             {
                                 ?>
                        <tr class="supplier_data">
                            <td><?= $row->supplier_name?></td>
                            <td> <span> <?=$row->street ?>,</span>
                                <span>Brgy. <?= $row->barangay ?>, </span>
                                <span> <?= $row->city?>, </span>
                                <span> <?= $row->province ?>.</span>
                            </td>
                            <td><?= $row->contact ?></td>
                            <td><?=ucfirst( $row->status) ?></td>
                            <td><?= $row->date_created ?></td>

                        </tr>
                        <?php
                             }
                       
                            ?>

                    </tbody>
                </table>

            </div>
            <div class="card-footer bg-transparent border-success text-center ">
                <input type="submit" name="btn_export" value="Export to Excel" class="btn_save">
                <a href="<?=site_url('ReportsCtrl/print_supplier');?>" target='_blank'
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