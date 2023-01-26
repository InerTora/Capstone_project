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
        <h1 class="mb-2">Manage Request</h1>

        <?=form_open('PurchaseRequestCtrl/approve_request/'.$select->purchase_request_id,  array('onsubmit'=>'return confirm(\'Are you sure?\')'));?>


        <div class="row">
            <div class="col-7">
                <h3 class="txt">Purchase Request No: <span><?=$code->purchase_request_no?></span></h3>
            </div>

            <div class="col-5">
                <h4 class="txt">Posting Date: <span><?=$select->posting_date?></span></h4>
            </div>
        </div>
        <!-- Next  -->

        <div class="row">
            <div class="col-7">
                <h4 class="txt">Supplier Name: <span><?=$select->supplier_name?></span></h4>
            </div>
            <div class="col-5">
                <h4 class="txt">Requested by: <span><?=$select->First_Name.' '.$select->Last_Name?></span></h4>
            </div>

            <div class="col-5">
                <h4 class="txt">Address:
                    <span><?= ucwords($select->street).', &nbspBrgy. '.ucwords($select->barangay).',&nbsp'.ucwords($select->city).' City, '.ucwords($select->province)?>.</span>
                </h4>
                <h4 class="txt">Contact No.: <span><?=$select->contact?></span></h4>
            </div>
        </div>
        <!-- Next -->
        <div class="row mb-4 mr-2">
            <div class="col-1">
                <h4 class="txt">Status</h4>
                <select class="form-select" aria-label="Default select example" style="width:150px" name="status"
                    id="mySelect" required>
                    <option value=""> <?=ucfirst($select->isPending)?></option>
                    <option value="approved">Approved</option>
                    <option value="disapproved">Disapproved</option>
                </select>
            </div>

        </div>
        <!-- Next is for table -->
        <div class="card border-success mb-3"
            style="max-width: 100%; border-radius:15px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">

            <div class="card-body text-success">
                <table class="table table-bordered" id="table_field">
                    <thead>

                        <tr>
                            <th id="table_style">Plate No.</th>
                            <th id="table_style">Description</th>
                            <th id="table_style">Unit</th>
                            <th id="table_style">Quantity</th>
                            <th id="table_style">Unit Cost</th>
                            <th id="table_style">Estimated Cost</th>
                            <th id="table_style" data-mdb-toggle="tooltip" title="Select item to disapproved"
                                style="cursor:pointer;" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($view as $row) {?>
                        <tr>

                            <td><?= $row->plate_no; ?></td>
                            <td><?= $row->description; ?></td>
                            <td><?= $row->unit; ?></td>
                            <td><?= $row->quantity; ?></td>
                            <td><?= $row->unit_cost; ?></td>
                            <td><?= number_format((float)$row->estimated_cost, 2, '.', ',');?></td>
                            <td class="text-center"><input type="checkbox" style="cursor:pointer" name="checkbox[]"
                                    value="<?=$row->PR_ID?>"></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="5" class="text-end" style="font-weight:bold">Total Cost</td>
                            <td>
                                <?= number_format((float)$row->total_cost, 2, '.', ',');?>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-outline mt-4 mb-3">
                    <textarea class="form-control" id="textAreaExample" rows="1" name="purpose"
                        readonly><?=$code->purpose?></textarea>
                    <label class="form-label" for="textAreaExample"
                        style="font-size:15px; font-weight:bold;">Purpose</label>
                </div>
                <!-- Reason For Disapproved Request -->
                <div class="form-outline mt-4 mb-3">
                    <textarea class="form-control" id="textAreaExample" rows="2" name="reason"></textarea>
                    <label class="form-label" for="textAreaExample" style="font-size:15px; font-weight:bold;">Reason
                        (Optional)</label>
                </div>
                <!-- end -->
            </div>
            <div class="card-footer bg-transparent border-success text-end ">
                <input type="submit" value="Post" name="btn_save" class="btn_save">
                <a href="<?php echo site_url('PurchaserequestCtrl/manage_request'); ?>"><input type="button"
                        value="Back" class="btn_save"></a>
            </div>
        </div>
        <input type="hidden" name="purchase_id" value="<?= $select->purchase_request_id; ?>">


        <input class="form-control form-control-lg" type="hidden" name="contact"
            value="<?= $branch_sms->contact_no; ?>" />

        <input type="hidden" value="<?=ucfirst($select->First_Name).' '.ucfirst($branch_sms->Last_Name)?>"
            name="txt_username">
        <?php if ($select->payable_type =="Gasoline") {
       ?>
        <input type="hidden" value=" a purchase request of " name="message">
        <?php
       }else{
        ?>
        <input type="hidden" value=" a service request of " name="message">

        <?php
       }?>

        <?=form_close()?>


    </div>

</main>