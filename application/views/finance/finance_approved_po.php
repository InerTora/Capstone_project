<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Approved Purchase Order</h1>
        <hr>
        <!--Start-->
        <div class=" row">
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="approve">
                        <thead class="mb-2">
                            <tr>

                                <th style="font-size:15px; font-weight:bold">Purchase Request No.</th>
                                <th style="font-size:15px; font-weight:bold">Supplier</th>
                                <th style="font-size:15px; font-weight:bold">Created by</th>
                                <th style="font-size:15px; font-weight:bold">Position</th>
                                <th style="font-size:15px; font-weight:bold">Posting Date</th>
                                <th style="font-size:15px; font-weight:bold" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($table_po as $row){?>
                            <tr>
                                <td style="font-weight: bold;"><?=$row->purchase_order_no?></td>
                                <td style="font-weight: bold;"><?=$row->supplier_name?></td>
                                <td style="font-weight: bold;"><?=$row->First_Name.' '.$row->Last_Name?></td>
                                <td style="font-weight: bold;"><?=$row->Position?></td>
                                <td style="font-weight: bold;"><?=$row->po_date?></td>
                                <td style="font-weight: bold;" class="text-center">


                                    <?php if ($row->payable_type == "Gasoline") {
                                   ?>
                                    <a href="<?= site_url('FinanceCtrl/finance_create_PI/'.$row->PO_ID)?>"><i
                                            class="fa-sharp fa-solid fa-file-invoice fa-lg"></i></a>

                                    <?php
                                 }else{

                                    ?>

                                    <a href="<?= site_url('FinanceCtrl/finance_create_PI_sr/'.$row->PO_ID)?>"><i
                                            class="fa-sharp fa-solid fa-file-invoice fa-lg"></i></a>
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