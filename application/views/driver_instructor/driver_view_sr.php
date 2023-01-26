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

.btn_po {
    width: 100px;
    height: 35px;
    background-color: #2146C7;
    color: white;
    font-style: normal;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn_po:hover {
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

.txt {
    font-weight: bold;
    font-size: 15px;
}
</style>

<div class="content">
    <div class="container-fluid">
        <h1 class="mb-3">View Purchase Request</h1>
        <?=form_open('PurchaseRequestCtrl/forwarded/'.$select->purchase_request_id,  array('onsubmit'=>'return confirm(\'Are you sure you want to forward?\')'));?>

        <div class="row">

            <div class="col-7">
                <h4 class="txt">Purchase Request No: <span><?=$code->purchase_request_no?></span></h4>
                <h4 class="txt">Supplier Name: <span><?=$select->supplier_name?></span></h4>
            </div>

            <div class="col-5">
                <h4 class="txt">Posting Date: <span><?=$select->posting_date?></span></h4>
                <h4 class="txt">Requested by: <span><?=$select->First_Name.' '.$select->Last_Name?></span></h4>
            </div>

        </div>
        <div class="row">

            <div class="col-5">
                <h4 class="txt">Address:
                    <span><?= $select->street.', &nbspBrgy. '.$select->barangay.',&nbsp'.$select->city.', '.$select->province?>.</span>
                </h4>
                <h4 class="txt">Contact No.: <span><?=$select->contact?></span></h4>
            </div>
        </div>

        <div class="row mb-4">

        </div>

    </div>

    <!--start table-->
    <div class="card border-success mb-3"
        style="max-width: 75rem; border-radius:15px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">

        <div class="card-body text-success">
            <table class="table table-bordered" id="table_field">

                <thead>
                    <th id="table_style">Item No.</th>
                    <th id="table_style">Quantity</th>
                    <th id="table_style">Unit</th>
                    <th id="table_style">Description</th>
                    <th id="table_style">Unit Cost</th>
                    <th id="table_style">Estimated Cost</th>
                    <th id="table_style">Status</th>
                </thead>
                <tbody>
                    <?php foreach ($view_sr as $row) {   ?>
                    <tr>
                        <td><?=$row->item_no ?></td>
                        <td><?=$row->description ?></td>
                        <td><?=$row->unit ?></td>
                        <td><?=$row->quantity ?></td>
                        <td><?=$row->unit_cost ?></td>
                        <td> <?= number_format((float)$row->estimated_cost, 2, '.', ',');?></td>

                        <td class="text-center"><?php if ($row->isStatus =="1" && $row->isPending == "approved") {
                         ?>
                            <span class="badge bg-success">Approved</span>
                            <?php
                        }elseif($row->isStatus == "1" && $row->isPending == "pending"){
                            ?>
                            <span class="badge bg-danger">Pending</span>
                            <?php
                        }else{
                            ?>
                            <span class="badge bg-danger">Disapproved</span>
                            <?php
                        }?>

                        </td>

                    </tr>

                    <?php } ?>

                    <tr>
                        <td colspan="5" class="text-end" style="font-weight:bold">Total Cost</td>

                        <td>
                            <?php if ($row->isPending =="pending" || $row->isPending =="disapproved") {
                            ?>
                            <?= number_format((float)$row->total_cost, 2, '.', ',');?>
                            <?php                        
                        }else{
                            ?>
                            <?= number_format((float)$estimated_cost, 2, '.', ',');?>
                            <?php
                        }?>
                        </td>

                        <td></td>
                    </tr>

                </tbody>
            </table>

            <div class="form-outline mt-5">
                <!-- Start -->
                <?php if ($select->isPending == "approved" || $select->isPending =="disapproved") {
               ?>
                <textarea class="form-control" id="textAreaExample" rows="1" name="purpose"
                    readonly><?=$code->reason?></textarea>
                <label class="form-label" for="textAreaExample" style="font-size:15px; font-weight:bold;">Reason</label>
                <?php

              }else{
                ?>
                <textarea class="form-control" id="textAreaExample" rows="1" name="purpose"
                    readonly><?=$code->purpose?></textarea>
                <label class="form-label" for="textAreaExample"
                    style="font-size:15px; font-weight:bold;">Purpose</label>

                <?php


              }?>

                <!-- End -->

            </div>
        </div>
        <div class="card-footer bg-transparent border-success text-end">
            <?php if ($row->isForwarded == "1") {?>
            <input type="submit" name="btn_forwarded" value="Forward" class="btn_save" data-mdb-toggle="tooltip"
                title="Forward to main branch">
            <?php } ?>

            <a href="<?php echo site_url('PurchaseRequestCtrl/branch_manage_pr'); ?>"><input type="button" value="Back"
                    class="btn_save"></a>

            <input class="form-control form-control-lg" type="hidden" name="contact" value="<?=$sms->contact_no?>" />
            <!-- start -->

            <?php if ($select->payable_type =="Gasoline") {
            ?>
            <input class="form-control form-control-lg" type="hidden" name="message"
                value="iDrive Driving Tutorial - <?=$sms_branch->branch_name?>. <?=$_SESSION['Position'] .' - ' .ucfirst($_SESSION['First_Name']).' '.ucfirst($_SESSION['Last_Name'])?> posted a purchase request." />
            <?php
            }else{

                ?>
            <input class="form-control form-control-lg" type="hidden" name="message"
                value="iDrive Driving Tutorial - <?=$sms_branch->branch_name?>. <?=$_SESSION['Position'] .' - ' .ucfirst($_SESSION['First_Name']).' '.ucfirst($_SESSION['Last_Name'])?> posted a service request." />

            <?php
            }?>


            <!-- end -->
        </div>
        <?=form_close()?>
    </div>



</div>
</div>