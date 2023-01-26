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
    width: 150px;
}
</style>

<main class="content">
    <div class="container-fluid">

        <!-- Tabs navs -->
        <ul class="nav nav-tabs mb-5" id="ex-with-icons" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex-with-icons-tab-1" data-mdb-toggle="tab" href="#ex-with-icons-tabs-1"
                    style="font-size:13px; font-weight:bold" role="tab" aria-controls="ex-with-icons-tabs-1"
                    aria-selected="true">Manage Purchase Request</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-2" style="font-size:13px; font-weight:bold"
                    data-mdb-toggle="tab" href="#ex-with-icons-tabs-2" role="tab" aria-controls="ex-with-icons-tabs-2"
                    aria-selected="false">Manage Driving Instructor
                    Request</a>
            </li>

        </ul>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex-with-icons-content">
            <div class="tab-pane fade show active" id="ex-with-icons-tabs-1" role="tabpanel"
                aria-labelledby="ex-with-icons-tab-1">
                <qdiv class=" row">
                    <div class="card border-success mb-3"
                        style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="card-body">
                            <table class="table my-0 w-100 row-border-none" id="branch_table_pr">
                                <thead class="mb-2">
                                    <tr>

                                        <th id="table_style">Purchase Request No.</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Supplier</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Posting Date</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Status</th>
                                        <th id="table_style">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($manage_manager as $row){?>

                                    <tr>
                                        <td><?=$row->purchase_request_no?></td>
                                        <td class="d-none d-xl-table-cell"><?=$row->supplier_name?></td>
                                        <td class="d-none d-xl-table-cell"><?=$row->posting_date?></td>

                                        <td class="d-none d-xl-table-cell">
                                            <?php if ($row->isPending == "approved"){?>

                                            <span class="badge bg-success">
                                                <?=ucfirst($row->isPending)?>
                                            </span>

                                            <?php
                                    }else
                                    {
                                        ?>
                                            <span class="badge bg-danger">
                                                <?=ucfirst($row->isPending)?>
                                            </span>

                                            <?php
                                    }?>
                                        </td>
                                        <td>
                                            <!-- start -->

                                            <?php if ($row->payable_type =="Gasoline") {


                                                if ($row->isPending == "approved" || $row->isPending =="disapproved") {
                                                /*Gasoline start*/ 
                                            ?>
                                            <a
                                                href="<?=site_url('PurchaseRequestCtrl/view/'.$row->purchase_request_id) ?>"><i
                                                    class="fa-solid fa-eye text-center fa-lg"></i></a>

                                            <?php
                                                /*Gasoline End*/
                                                }else{
                                                ?>
                                            <a
                                                href="<?=site_url('PurchaseRequestCtrl/view/'.$row->purchase_request_id) ?>"><i
                                                    class="fa-solid fa-eye text-center fa-lg"></i></a>

                                            <a
                                                href="<?= site_url('PurchaseRequestCtrl/update_branch_pr/'.$row->purchase_request_id);?>"><i
                                                    class="fa-regular fa-pen-to-square text-center text-center fa-lg"></i></a>
                                            <a href="<?= site_url('PurchaseRequestCtrl/manager_delete_gen_view/'.$row->purchase_request_id);?>"
                                                onclick="return confirm('Are you sure you want to Delete?')"><i
                                                    class="fa-solid fa-trash fa-lg"></i></a>


                                            <?php



                                                }
            /*Service Request*/  
                                            }else{

                                                if ($row->isPending =="approved" || $row->isPending =="disapproved") {
                                                 
                                                    ?>
                                            <a
                                                href="<?=site_url('PurchaseRequestCtrl/view_sr/'.$row->purchase_request_id) ?>"><i
                                                    class="fa-solid fa-eye text-center fa-lg"></i></a>

                                            <?php
                                                }else{

                                                    ?>
                                            <a
                                                href="<?=site_url('PurchaseRequestCtrl/view_sr/'.$row->purchase_request_id) ?>"><i
                                                    class="fa-solid fa-eye text-center fa-lg"></i></a>

                                            <a
                                                href="<?= site_url('PurchaseRequestCtrl/update_branch_SR/'.$row->purchase_request_id);?>"><i
                                                    class="fa-regular fa-pen-to-square text-center text-center fa-lg"></i></a>
                                            <a href="<?= site_url('PurchaseRequestCtrl/manager_delete_gen_view/'.$row->purchase_request_id);?>"
                                                onclick="return confirm('Are you sure you want to Delete?')"><i
                                                    class="fa-solid fa-trash fa-lg"></i></a>

                                            <?php
                                                }

                                            }?>

                                            <!-- End -->

                                        </td>


                                    </tr>

                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </qdiv>
            </div>
            <div class="tab-pane fade" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">
                <qdiv class=" row">
                    <div class="card border-success mb-3"
                        style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="card-body">
                            <table class="table my-0 w-100 row-border-none" id="requesttable">
                                <thead class="mb-2">
                                    <tr>

                                        <th id="table_style">Purchase Request No.</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Supplier</th>

                                        <th id="table_style" class="d-none d-xl-table-cell">Requested By</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Posting Date</th>
                                        <th id="table_style" class="d-none d-xl-table-cell">Status</th>
                                        <th id="table_style">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($driver_instructor as $row){?>

                                    <tr>

                                        <td><?=$row->purchase_request_no?></td>
                                        <td class="d-none d-xl-table-cell"><?=$row->supplier_name?></td>

                                        <td class="d-none d-xl-table-cell">
                                            <?=ucfirst($row->First_Name).' '.ucfirst($row->Last_Name)?>
                                        </td>
                                        <td class="d-none d-xl-table-cell"><?=$row->posting_date?></td>
                                        <td class="d-none d-xl-table-cell">
                                            <?php if ($row->isPending == "approved"){?>

                                            <span class="badge bg-success">
                                                <?=ucfirst($row->isPending)?>
                                            </span>


                                            <?php
                                    }else
                                    {
                                        ?>
                                            <span class="badge bg-danger">
                                                <?=ucfirst($row->isPending)?>
                                            </span>

                                            <?php
                                    }?>
                                        </td>

                                        <td>
                                            <!--start-->
                                            <?php if ($row->payable_type == "Gasoline") {
                                    /*----start------*/ 

                                    ?>
                                            <a href="<?=site_url('PurchaseRequestCtrl/driver_view_pr/'.$row->purchase_request_id) ?>"
                                                data-mdb-toggle="tooltip" title="View Purchase Request Details"><i
                                                    class="fa-solid fa-eye text-center fa-lg"></i></a>

                                            <?php if ($row->forwarded_to == "no" ) {
                                                
                                                if ($row->isPending == "approved" || $row->isPending =="disapproved") {
                                                    ?>
                                            <a href="<?=site_url('PurchaseRequestCtrl/forwarded_to_driver/'.$row->purchase_request_id);?>"
                                                data-mdb-toggle="tooltip" title="Forward to driving instructor"><i
                                                    class="fa-solid fa-share-from-square fa-lg"></i></a>

                                            <?php
                                                }
                                                
                                           }?>

                                            <?php

                                    /*-----End-------*/ 
                                           }else{
                                                /*----start------*/ 

                                                ?>
                                            <a href="<?=site_url('PurchaseRequestCtrl/driver_view_sr/'.$row->purchase_request_id) ?>"
                                                data-mdb-toggle="tooltip" title="View Purchase Request Details"><i
                                                    class="fa-solid fa-eye text-center fa-lg"></i></a>

                                            <?php if ($row->forwarded_to == "no" ) {
     
                                                if ($row->isPending == "approved" || $row->isPending =="disapproved") {
                                                    ?>
                                            <a href="<?=site_url('PurchaseRequestCtrl/forwarded_to_driver_sr/'.$row->purchase_request_id);?>"
                                                data-mdb-toggle="tooltip" title="Forward to driving instructor"><i
                                                    class="fa-solid fa-share-from-square fa-lg"></i></a>

                                            <?php
                                                    }
                                                    
                                                }?>

                                            <?php

                                                    /*-----End-------*/ 

                                            
                                           }?>
                                        </td>
                                        <!--end-->

                                    </tr>

                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>



                </qdiv>
                <?=form_close()?>
            </div>

        </div>
        <!-- Tabs content -->
        <!--Start-->



    </div>
</main>