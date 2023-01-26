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
        <!-- Tabs navs -->
        <ul class="nav nav-tabs mb-3" id="ex-with-icons" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex-with-icons-tab-1" data-mdb-toggle="tab" href="#ex-with-icons-tabs-1"
                    style="font-size:12px; font-weight:bold" role="tab" aria-controls="ex-with-icons-tabs-1"
                    aria-selected="true"><i class="fas fa-chart-pie fa-fw me-2"></i>Branch Manage Request</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-2" data-mdb-toggle="tab" href="#ex-with-icons-tabs-2"
                    role="tab" aria-controls="ex-with-icons-tabs-2" style="font-size:12px; font-weight:bold"
                    aria-selected="false"><i class="fas fa-chart-line fa-fw me-2"></i>Purchase Request History</a>
            </li>

        </ul>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex-with-icons-content">
            <div class="tab-pane fade show active" id="ex-with-icons-tabs-1" role="tabpanel"
                aria-labelledby="ex-with-icons-tab-1">

                <!--Start-->
                <div class="row mt-5">
                    <div class="card border-success mb-3"
                        style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="card-body">
                            <table class="table my-0 w-100 row-border-none" id="requesttable">
                                <thead class="mb-2">
                                    <tr>

                                        <th id="table_style">Purchase Request No.</th>
                                        <th id="table_style">Requested by</th>
                                        <th id="table_style">Position</th>
                                        <th id="table_style">Branch</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Posting Date</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Status</th>
                                        <th id="table_style">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($request as $row) { ?>
                                    <tr>
                                        <td><?= $row->purchase_request_no?></td>
                                        <td><?= $row->First_Name.' '.$row->Last_Name?></td>
                                        <td><?= $row->Position?></td>
                                        <td><?= $row->branch_name?></td>
                                        <td class="d-none d-xl-table-cell"><?= $row->posting_date?></td>
                                        <td class="d-none d-xl-table-cell"><span
                                                class="badge  bg-danger"><?=ucfirst($row->isPending)?></span></td>

                                        <td>
                                            <!-- Start -->

                                            <?php if ($row->payable_type =="Gasoline") {
                                              ?>
                                            <a
                                                href="<?=site_url('PurchaseRequestCtrl/approve_request/'.$row->purchase_request_id); ?>"><i
                                                    class="fa-regular fa-pen-to-square text-center text-center fa-lg"></i></a>


                                            <?php
                                            }else{

                                                ?>
                                            <a
                                                href="<?=site_url('PurchaseRequestCtrl/approve_request_sr/'.$row->purchase_request_id); ?>"><i
                                                    class="fa-regular fa-pen-to-square text-center text-center fa-lg"></i></a>


                                            <?php

                                            }?>

                                            <!-- End -->
                                        </td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End -->
            </div>
            <div class="tab-pane fade" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">
                <!--Start-->
                <ddiv class="row mt-5">
                    <div class="card border-success mb-3"
                        style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="card-body">
                            <table class="table my-0 w-100 row-border-none" id="PRtable">
                                <thead class="mb-2">
                                    <tr>

                                        <th id="table_style">Purchase Request No.</th>
                                        <th id="table_style">Requested by</th>
                                        <th id="table_style">Position</th>
                                        <th id="table_style">Branch</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Posting Date</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Status</th>
                                        <th id="table_style">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($request_history as $row) { ?>
                                    <tr>
                                        <td><?= $row->purchase_request_no?></td>
                                        <td><?= $row->First_Name.' '.$row->Last_Name?></td>
                                        <td><?= $row->Position?></td>
                                        <td><?= $row->branch_name?></td>
                                        <td class="d-none d-xl-table-cell"><?= $row->posting_date?></td>
                                        <td class="d-none d-xl-table-cell">
                                            <?php if ($row->isPending == "approved") {
                                          ?>
                                            <span class="badge bg-success">Approved</span>
                                            <?php
                                        }else{
                                            ?>
                                            <span class="badge bg-danger">Disapproved</span>
                                            <?php
                                        }?>


                                        </td>
                                        <td>

                                            <!-- Start -->

                                            <?php if ($row->payable_type =="Gasoline") {
                                              ?>
                                            <a
                                                href="<?=site_url('PurchaseRequestCtrl/transaction_history/'.$row->purchase_request_id); ?>"><i
                                                    class="fa-solid fa-eye fa-lg"></i></a>


                                            <?php
                                            }else{

                                                ?>
                                            <a
                                                href="<?=site_url('PurchaseRequestCtrl/transaction_history_sr/'.$row->purchase_request_id); ?>"><i
                                                    class="fa-solid fa-eye fa-lg"></i></a>



                                            <?php

                                            }?>

                                            <!-- End -->
                                        </td>

                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </ddiv>

                <!-- End -->
            </div>

        </div>
        <!-- Tabs content -->

    </div>
</main>