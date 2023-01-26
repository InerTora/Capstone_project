<!--START OF SIDEBAR-->
<nav id="sidebar" class="sidebar js-sidebar ">
    <div class="sidebar-content js-simplebar">
        <ul class="sidebar-nav">
            <li class="sidebar-item  mt-6">
                <a class="sidebar-link" href="<?php  echo site_url('ManagerCtrl/dashboard'); ?>">
                    <i class="fa-sharp fa-solid fa-house"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php  echo site_url('User'); ?>">
                    <i class="fa-solid fa-user-tie"></i><span class="align-middle">User</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php  echo site_url('BranchCtrl/'); ?>">
                    <i class="fa-sharp fa-solid fa-people-roof"></i><span class="align-middle">Branches</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php  echo site_url('SupplierCtrl/'); ?>">
                    <i class="fa-solid fa-users"></i><span class="align-middle">Supplier</span>
                </a>
            </li>

            <div class="accordion accordion-flush" id="accordionFlushExample">

                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">

                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#target" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span> <i class="fa-solid fa-calendar-days"></i></span>
                            Payment Schedule
                        </button>
                    </h2>
                    <div id="target" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul>

                                <li> <a href="<?php  echo site_url('ScheduleCtrl'); ?>">Manage Schedule</a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?php  echo site_url('CarCtrl/'); ?>">
                        <i class="fa-solid fa-car"></i><span class="align-middle">Vehicle</span>
                    </a>
                </li>
                <!--Acc-->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">

                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span><i class="fa-solid fa-cart-plus"></i></span>
                            Purchase Request
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul>
                                <li><a href="<?php echo site_url('PurchaseRequestCtrl/tab'); ?>">Create</a>
                                </li>
                                <li> <a href="<?php echo site_url('PurchaseRequestCtrl/gen_manage_PR'); ?>">Manage</a>
                                </li>
                                <li> <a href="<?php echo site_url('PurchaseRequestCtrl/manage_request'); ?>">Manage
                                        Request</a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            <span><i class="fa-solid fa-cart-plus"></i></span>
                            Purchase Order
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul>
                                <li> <a href="<?= site_url('PurchaseOrderCtrl/approved_po');?>">Create</a></li>
                                <li> <a href="<?= site_url('PurchaseOrderCtrl/manage_PO');?>">Manage</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--end Acc-->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= site_url('FinanceCtrl/gen_manage_view_invoice')?>">
                        <i class="fa-solid fa-file-invoice"></i><span class="align-middle">Purchase Invoice</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= site_url('FinanceCtrl/gen_ap_journal');?>">
                        <i class="fa-solid fa-book"></i></i> <span class="align-middle">A.P. Journal</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= site_url('FinanceCtrl/gen_approved_PV');?>">
                        <i class="fa-solid fa-book"></i></i> <span class="align-middle">Payment Voucher</span>
                    </a>
                </li>
                <li>
                    <div class="accordion accordion-flush" id="accordionFlushExample33">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne33">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne33" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <span><i class="fa-solid fa-book"></i>&nbsp<span>Ledger</span></span>
                                </button>
                            </h2>
                            <div id="flush-collapseOne33" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne33" data-bs-parent="#accordionFlushExample23">
                                <div class="accordion-body">
                                    <ul>
                                        <li>
                                            <a href="<?= site_url('financeCtrl/gen_ledger');?>" class="ledger">
                                                <span class="align-middle">A.P
                                                    Ledger</span>
                                            </a>
                                        </li>
                                        <a href="<?= site_url('financeCtrl/gen_manage_PA');?>" class="ledger">
                                            <span class="align-middle">P.A
                                                Ledger</span>
                                        </a>
                                        <li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                </li>
                <div class="accordion-item">
                    <h2 class="accordion-header " id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                            aria-controls="flush-collapseThree">
                            <span><i class="fa-solid fa-file-lines"></i></span>
                            Reports
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse mb-4"
                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul>
                                <li><a href="<?= site_url('ReportsCtrl/report_supplier');?>">Supplier List</a></li>
                                <li> <a href="<?= site_url('ReportsCtrl/report_po');?>">Purchase Order List</a></li>
                                <li><a href="<?= site_url('ReportsCtrl/report_invoice');?>">Purchase Invoice List</a>
                                </li>
                                <li> <a href="<?= site_url('ReportsCtrl/report_voucher');?>">Payment Voucher List</a>
                                </li>
                                <li><a href="<?=site_url('ReportsCtrl/ap_ageing_report');?>">Accounts Payable Aging
                                    </a></li>
                                <li> <a href="<?=site_url('ReportsCtrl/supplier_balance');?>">Supplier Balance to
                                        Date</a></li>
                                <li> <a href="<?=site_url('ReportsCtrl/payment_schedule');?>">Payment Schedule List</a>
                                </li>
                                <li> <a href="<?=site_url('ReportsCtrl/ap_ledger');?>">A.P. Ledger List</a>
                                </li>
                                <li> <a href="<?=site_url('ReportsCtrl/pa_ledger');?>">P.A. Ledger List</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!---->
            <li class="sidebar-item">
                <a class="sidebar-link" href="<?= site_url('BackupCtrl');?>"><i
                        class="fa-solid fa-screwdriver-wrench"></i><span class="align-middle">Backup</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!--END OF SIDEBAR-->
<div class="main">
    <!--START NAVBAR-->
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">
                <li class="nav-item dropdown">

                    <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                        <div class="position-relative">

                            <i class="align-middle" data-feather="bell"></i>
                            <span class="indicator"><?=$count + $notif_voucher?></span>

                        </div>
                    </a>

                    <sdiv class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                        aria-labelledby="messagesDropdown">
                        <div class="dropdown-menu-header">
                            <?php if($count > 0 || $notif_voucher > 0){?>
                            <div class="position-relative">
                                <span><?=$count + $notif_voucher?></span> Message Requests
                            </div>
                            <?php
                        }else{

                            ?>
                            <div class="position-relative">
                                No Message Requests
                            </div>
                            <?php
                        }
                        
                        ?>

                        </div>

                        <?php foreach ($manage_notif as $row) {?>

                        <div class="list-group">
                            <?php if ($row->payable_type == "Gasoline") {
                                ?>
                            <a href="<?= site_url('PurchaseRequestCtrl/approve_request/'.$row->purchase_request_id)?>"
                                class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="<?= base_url('includes/Custom/image/not_1.png');?>"
                                            class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark"><?= $row->branch_name?></div>
                                        <div class="text-muted small mt-1 text-text-black-50">Posted a purchase request.
                                        </div>
                                        <div class="text-muted small mt-1"><?= $row->posting_date?></div>
                                    </div>
                                </div>
                            </a>
                            <?php
                            }else{
                                ?>
                            <a href="<?= site_url('PurchaseRequestCtrl/approve_request_sr/'.$row->purchase_request_id)?>"
                                class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="<?= base_url('includes/Custom/image/not_1.png');?>"
                                            class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark"><?= $row->branch_name?></div>
                                        <div class="text-muted small mt-1 text-text-black-50">Posted a purchase request.
                                        </div>
                                        <div class="text-muted small mt-1"><?= $row->posting_date?></div>
                                    </div>
                                </div>
                            </a>
                            <?php
                            }?>
                        </div>
                        <?php }?>
                        <?php foreach ($manage_voucher as $row) {?>
                        <div class="list-group">
                            <?php if ($row->payable_type == "Billing") {
                       ?>
                            <a href="<?=site_url('FinanceCtrl/gen_approved_bills/'.$row->PV_ID);?>"
                                class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="<?= base_url('includes/Custom/image/not_1.png');?>"
                                            class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark"><?= $row->branch_name?></div>
                                        <div class="text-muted small mt-1 text-text-black-50">Posted a payment voucher
                                            request.
                                        </div>
                                        <div class="text-muted small mt-1"></div>
                                    </div>
                                </div>
                            </a>
                            <?php
                           }else{
?>
                            <a href="<?=site_url('FinanceCtrl/gen_approved/'.$row->PV_ID);?>" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="<?= base_url('includes/Custom/image/not_1.png');?>"
                                            class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark"><?= $row->branch_name?></div>
                                        <div class="text-muted small mt-1 text-text-black-50">Posted a payment voucher
                                            request.
                                        </div>
                                        <div class="text-muted small mt-1"></div>
                                    </div>
                                </div>
                            </a>

                            <?php


                           }?>
                        </div>
                        <?php }?>

                        <div class="dropdown-menu-footer">
                            <a href="<?= site_url('PurchaserequestCtrl/manage_request');?>" class="text-muted">Show all
                                messages</a>
                        </div>
                    </sdiv>
                </li>

                <li class="nav-item dropdown">
                    <a class=" dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                        <i class="align-middle" data-feather="settings"></i>
                    </a>

                    <?php
                          $img_src =  base_url('includes/Custom/image/not_2.png');
                        if(isset($_SESSION['image'])  && !empty($_SESSION['image']))
                        {
                            if(file_exists('./uploads/'.$_SESSION['image']))
                            {
                                $img_src = base_url('./uploads/'.$_SESSION['image']);
                            }
                           
                        }
                                ?>

                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" data-bs-toggle="dropdown">

                        <img src="<?php echo $img_src; ?>" class="avatar img-fluid rounded-circle " alt="" /> <small
                            class="text-dark"
                            style="font-size:14px;"><?= ucfirst($_SESSION['First_Name']) .' '. ucfirst($_SESSION['Last_Name']);?></small>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item"
                            href="<?php echo site_url('UserCtrl/profile/'.$_SESSION['User_ID']); ?>"><i
                                class="align-middle me-1" data-feather="user"></i> Profile</a>

                        <a class="dropdown-item" href="<?php  echo site_url('Accounts/logout'); ?>"
                            onclick="return confirm('Are you sure you want to logout?')">
                            <i class="text-danger" data-feather="log-out"></i>Logout</a>

                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!--END OF NAVBAR-->