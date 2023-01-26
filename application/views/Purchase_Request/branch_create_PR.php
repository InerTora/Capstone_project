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

<div class="content">
    <div class="container-fluid">
        <!-- Tabs navs -->
        <ul class="nav nav-tabs mb-3" id="ex-with-icons" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex-with-icons-tab-1" data-mdb-toggle="tab" href="#ex-with-icons-tabs-1"
                    style="font-size:15px; font-weight:bold" role="tab" aria-controls="ex-with-icons-tabs-1"
                    aria-selected="true"><i class="fa-solid fa-gas-pump"></i> Gasoline</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex-with-icons-tab-2" data-mdb-toggle="tab" href="#ex-with-icons-tabs-2"
                    style="font-size:15px; font-weight:bold" role="tab" aria-controls="ex-with-icons-tabs-2"
                    aria-selected="false"><i class="fa-solid fa-screwdriver-wrench"></i> Service Request</a>
            </li>

        </ul>
        <!-- Tabs navs -->

        <!--Start Gasoline-->
        <div class="tab-content" id="ex-with-icons-content">
            <div class="tab-pane fade show active" id="ex-with-icons-tabs-1" role="tabpanel"
                aria-labelledby="ex-with-icons-tab-1">
                <?=form_open('PurchaseRequestCtrl/branch_create_PR/',  array('onsubmit'=>'return confirm(\'Are you sure you want to create?\')'));?>
                <input type="hidden" name="category" value="Gasoline">
                <div class="row">
                    <div class="col-3">
                        <!-- Supplier -->
                        <label style="font-size:15px; font-weight:bold;">Supplier Name</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="supplier"
                            style="height:40px" required>
                            <option value="">Select Supplier</option>
                            <?php 
                            foreach ($gasoline_supplier as $row) {
                           ?>
                            <option value="<?=$row->supplier_id?>"><?=$row->supplier_name?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <small style="color:red;"><?php echo form_error('supplier'); ?></small>
                    </div>

                    <!-- Purchase Request No -->
                    <div class="col-3">
                        <label style="font-size:15px; font-weight:bold;">Purchase Request No</label>
                        <input type="text" value="<?=$display_code?>" name="code_no" readonly class="form-control">
                    </div>
                    <!--Posting Date -->
                    <div class="col-3">
                        <label style="font-size:15px; font-weight:bold;">Posting Date</label>
                        <input type="text" value="<?=date('Y-m-d');?>" name="posting_date" readonly
                            class="form-control">
                    </div>

                    <!--table -->
                    <ddiv class="card border-success mb-3 mt-4" style="max-width:100%;" id="card">
                        <div class="card-body text-success mb-3" id="card-body">
                            <table class="table table-bordered" id="table_field">
                                <thead>

                                    <tr>
                                        <th id="table_style"></th>
                                        <th id="table_style" style="width:20%">Plate No.</th>
                                        <th id="table_style" style="width:15%">Description</th>
                                        <th id="table_style">Unit</th>
                                        <th id="table_style">Quantity</th>
                                        <th id="table_style">Unit Cost</th>
                                        <th id="table_style">Estimated Cost</th>

                                    </tr>
                                </thead>

                                <tbody class="row_content" id="row_product">
                                    <tr>
                                        <td><button class="btn btn-danger remove-category"><i
                                                    class="fa-solid fa-trash"></i></button></td>
                                        <td>
                                            <!-- Copy select tag with options -->
                                            <select class="form-select mb-1 plate plate_number" name="plate[]"
                                                style="height:40px" required>
                                                <option value=""></option>
                                                <?php  foreach ($carlist as $row) {
                                                   ?>
                                                <option car_id="<?= $row->car_id?>" value="<?= $row->car_id?>">
                                                    <?= $row->plate_no.' '.'('.$row->brand.')'?></option>
                                                <?php
                                                }?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select mb-1 plate" name="description[]"
                                                style="height:40px" id="plate" required>
                                                <option value=""></option>
                                                <option value="Premium">Premium</option>
                                                <option value="Unleaded">Unleaded</option>
                                                <option value="Diesel">Diesel</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control unit txt_liters" type="text" name="unit[]"
                                                id="unit" pattern="[a-zA-Z]+" value="Liters" readonly>

                                        </td>
                                        <td>
                                            <input type="text" name="quantity[]" class="form-control qty_control_pr"
                                                oninput="calculate_pr(this);" id="qty_control_pr-1">

                                        </td>

                                        <td>
                                            <input type="text" name="unit_cost[]" oninput="calculate_pr(this);"
                                                class="form-control unit_cost_control_pr unit_cost"
                                                id="unit_cost_control_pr-1" step="any">
                                        </td>
                                        <td>
                                            <input type="text" name="estimated_cost[]"
                                                class="form-control estimated_cost_control_pr estimated_cost"
                                                value="0.00" readonly id="estimated_cost_control_pr-1">
                                        </td>

                                    </tr>

                                </tbody>
                                <tfoot>
                                    <td><button type="button" class="btn btn-info" id="btn_pr"><i
                                                class="fa-solid fa-plus"></i></button></td>
                                    <td colspan="5">
                                        <span></span>
                                    </td>
                                    <td>
                                        <span>Total Cost</span>
                                        <input type="number" class="form-control" name="total_cost" step="0.01" readonly
                                            id="total_cost_pr">
                                    </td>
                                </tfoot>
                            </table>
                            <!-- Purpose -->
                            <div class="form-outline">
                                <textarea class="form-control" id="textAreaExample" rows="2" name="purpose"
                                    required></textarea>
                                <label class="form-label" for="textAreaExample"
                                    style="font-size:15px; font-weight:bold;">Purpose</label>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent border-success text-end">
                            <input type="submit" value="Create" name="btn_create_pr" id="submit_pr" class="btn_save">
                            <a href="<?php echo site_url('PurchaseRequestCtrl/branch_manage_PR'); ?>"><input
                                    type="button" value="Back" class="btn_save"></a>
                        </div>
                    </ddiv>

                </div>

                <input class="form-control form-control-lg" type="hidden" name="contact"
                    value="<?=$sms->contact_no?>" />
                <input class="form-control form-control-lg" type="hidden" name="message"
                    value="iDrive Driving Tutorial - <?=$sms_branch->branch_name?>, posted a purchase request." />

                <input type="hidden" name="branch_id" value="<?php  echo $_SESSION['branch_id']; ?>">
                <input type="hidden" name="user_id" value="<?php  echo $_SESSION['User_ID']; ?>">
                <input type="hidden" name="isForwarded" value="<?= 0?>">
                <?=form_close()?>


            </div>
            <!--End Gasoline-->

            <div class="tab-pane fade" id="ex-with-icons-tabs-2" role="tabpanel" aria-labelledby="ex-with-icons-tab-2">

                <?=form_open('PurchaseRequestCtrl/branch_create_SR/',array('onsubmit'=>'return confirm(\'Are you sure you want to create?\')'));?>
                <input type="hidden" name="category" value="Repair and Maintenance">
                <div class="row">
                    <div class="col-3">
                        <!-- Supplier -->
                        <label style="font-size:15px; font-weight:bold;">Supplier Name</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="supplier"
                            style="height:40px" required>
                            <option value="">Select Supplier</option>
                            <?php 
                            foreach ($repair_supplier as $row) {
                           ?>
                            <option value="<?=$row->supplier_id?>"><?=$row->supplier_name?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <small style="color:red;"><?php echo form_error('supplier'); ?></small>
                    </div>

                    <!-- Purchase Request No -->
                    <div class="col-3">
                        <label style="font-size:15px; font-weight:bold;">Purchase Request No</label>
                        <input type="text" value="<?=$display_code?>" name="code_no" readonly class="form-control">
                    </div>
                    <!--Posting Date -->
                    <div class="col-3 mb-4">
                        <label style="font-size:15px; font-weight:bold;">Posting Date</label>
                        <input type="text" value="<?=date('Y-m-d');?>" name="posting_date" readonly
                            class="form-control">
                    </div>
                    <!--Start Table-->

                    <ddiv class="card border-success mb-3 mt-4" style="max-width:100%;" id="card">
                        <div class="card-body text-success" id="card-body">
                            <table class="table table-bordered" id="table_field_sr">
                                <thead>

                                    <tr>
                                        <th id="table_style"></th>
                                        <th style="width:8%" id="table_style">Item No.</th>
                                        <th style="width:20%" id="table_style">Item Description</th>
                                        <th id="table_style">Unit</th>
                                        <th id="table_style">Quantity</th>
                                        <th id="table_style">Unit Cost</th>
                                        <th style="width:15%" id="table_style">Estimated Cost</th>
                                    </tr>
                                </thead>

                                <tbody class="row_content_sr" id="row_product_sr">
                                    <tr>
                                        <td><button class="btn btn-danger remove-category_sr"><i
                                                    class="fa-solid fa-trash"></i></button>

                                        </td>
                                        <td>
                                            <input type="text" name="item_no[]" class="form-control auto_no" value="1"
                                                readonly>
                                            <input type="hidden" name="plate[]" class="form-control" value="N/A"
                                                readonly>
                                        </td>

                                        <td>
                                            <input type="text" name="description[]" class="form-control">
                                        </td>

                                        <td>
                                            <input type="text" name="unit[]" class="form-control">
                                        </td>

                                        <td>
                                            <input type="number" name="quantity[]" class="form-control qty_control"
                                                oninput="calculate(this);" id="qty_control-1" min="1">
                                        </td>

                                        <td>
                                            <input type="number" name="unit_cost[]" oninput="calculate(this);"
                                                class="form-control unit_cost_control unit_cost"
                                                id="unit_cost_control-1" min="1" step="any">
                                        </td>
                                        <td>
                                            <input type="text" name="estimated_cost[]"
                                                class="form-control estimated_cost_control estimated_cost" value="0.00"
                                                readonly id="estimated_cost_control-1">
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <td><button type="button" class="btn btn-info" id="btn_sr"><i
                                                class="fa-solid fa-plus"></i></button></td>
                                    <td colspan="5">
                                        <span></span>
                                    </td>
                                    <td>
                                        <span>Total Cost</span>
                                        <input type="number" class="form-control" name="total_cost" step="any" readonly
                                            id="total_cost">
                                    </td>
                                </tfoot>
                            </table>

                            <!-- Purpose -->
                            <div class="form-outline">
                                <textarea class="form-control" id="textAreaExample" rows="2" name="purpose"
                                    required></textarea>
                                <label class="form-label" for="textAreaExample"
                                    style="font-size:15px; font-weight:bold;">Purpose</label>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent border-success text-end">
                            <input type="submit" value="Create" name="btn_create_pr" id="submit_pr" class="btn_save">
                            <a href="<?php echo site_url('PurchaseRequestCtrl/branch_manage_PR'); ?>"><input
                                    type="button" value="Back" class="btn_save"></a>
                        </div>
                    </ddiv>

                </div>

                <input class="form-control form-control-lg" type="hidden" name="contact"
                    value="<?=$sms->contact_no?>" />


                <input class="form-control form-control-lg" type="hidden" name="message"
                    value="iDrive Driving Tutorial - <?=$sms_branch->branch_name?>, posted a service request." />

                <input type="hidden" name="branch_id" value="<?php  echo $_SESSION['branch_id']; ?>">
                <input type="hidden" name="user_id" value="<?php  echo $_SESSION['User_ID']; ?>">
                <input type="hidden" name="isForwarded" value="<?= 0?>">
                <?=form_close()?>
            </div>

        </div>
        <!-- Tabs content -->
    </div>
</div>