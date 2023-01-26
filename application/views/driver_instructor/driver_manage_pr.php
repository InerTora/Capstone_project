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
        <h1 class="h2 mb-3  text-dark">Manage Purchase Request</h1>
        <hr>
        <!--Start-->
        <div class=" row">
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="branchtable">
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
                            <?php foreach ($manage_driver_request as $row){?>

                            <tr>
                                <td><?=$row->purchase_request_no?></td>
                                <td class="d-none d-xl-table-cell"><?=$row->supplier_name?></td>
                                <td class="d-none d-xl-table-cell"><?=$row->posting_date?></td>

                                <td class="d-none d-xl-table-cell">
                                    <?php if ($row->forwarded_to == "no" && $row->isPending = "pending"){?>

                                    <span class="badge bg-danger">
                                        Pending
                                    </span>

                                    <?php
                                    }elseif($row->forwarded_to =="yes" && $row->isPending =="disapproved")
                                    {
                                        ?>
                                    <span class="badge bg-danger">
                                        Disapproved
                                    </span>
                                    <?php
                                    }elseif($row->forwarded_to =="yes" && $row->isPending == "approved"){
                                        ?>
                                    <span class="badge bg-success">
                                        Approved
                                    </span>
                                    <?php
                                    }?>
                                </td>

                                <td>
                                    <!-- Start -->

                                    <?php  if ($row->payable_type == "Gasoline") {

                                            if($row->isPending == "approved" || $row->isPending == "disapproved" ) {
                                            ?>

                                    <a
                                        href="<?=site_url('PurchaseRequestCtrl/driver_instructor_view/'.$row->purchase_request_id) ?>"><i
                                            class="fa-solid fa-eye text-center fa-lg"></i></a>
                                    <?php
                                        }else{
                                ?>
                                    <a
                                        href="<?=site_url('PurchaseRequestCtrl/driver_instructor_view/'.$row->purchase_request_id) ?>"><i
                                            class="fa-solid fa-eye text-center fa-lg"></i></a>

                                    <a
                                        href="<?= site_url('PurchaseRequestCtrl/driver_update_pr/'.$row->purchase_request_id);?>"><i
                                            class="fa-regular fa-pen-to-square text-center text-center fa-lg"></i></a>
                                    <a href="<?= site_url('PurchaseRequestCtrl/driver_delete/'.$row->purchase_request_id);?>"
                                        onclick="return confirm('Are you sure you want to Delete?')"><i
                                            class="fa-solid fa-trash fa-lg"></i></a>
                                    <?php

                                        }


                                   
                                    }else{
                                            if($row->isPending == "approved" || $row->isPending == "disapproved" ) {
                                            ?>

                                    <a
                                        href="<?=site_url('PurchaseRequestCtrl/driver_instructor_view_sr/'.$row->purchase_request_id) ?>"><i
                                            class="fa-solid fa-eye text-center fa-lg"></i></a>
                                    <?php
                                        }else{
                                ?>
                                    <a
                                        href="<?=site_url('PurchaseRequestCtrl/driver_instructor_view_sr/'.$row->purchase_request_id) ?>"><i
                                            class="fa-solid fa-eye text-center fa-lg"></i></a>

                                    <a
                                        href="<?= site_url('PurchaseRequestCtrl/driver_update_sr/'.$row->purchase_request_id);?>"><i
                                            class="fa-regular fa-pen-to-square text-center text-center fa-lg"></i></a>
                                    <a href="<?= site_url('PurchaseRequestCtrl/driver_delete/'.$row->purchase_request_id);?>"
                                        onclick="return confirm('Are you sure you want to Delete?')"><i
                                            class="fa-solid fa-trash fa-lg"></i></a>
                                    <?php

                                        }

                                    }?>

                                    <!-- End  -->


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