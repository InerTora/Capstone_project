<!--START OF SIDEBAR-->
<style>
.ledger {
    background: none;
    text-decoration: none;
    color: rgba(184, 189, 194);
    font-size: 14px;

}
</style>
<nav id="sidebar" class="sidebar js-sidebar mt-3">
    <div class="sidebar-content js-simplebar">
        <ul class="sidebar-nav">
            <li class="sidebar-item  mt-5">
                <a class="sidebar-link" href="<?=site_url('FinanceCtrl/finance_dashboard'); ?>">
                    <i class="fa-sharp fa-solid fa-house"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <!--Acc-->
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">

                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span><i class="fa-solid fa-cart-plus"></i></span>
                            Purchase Invoice
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul>
                                <li><a href="<?=site_url('FinanceCtrl/approved_po'); ?>">Create</a></li>
                                <li> <a href="<?=site_url('FinanceCtrl/finance_manage_PI'); ?>">Manage</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            <span><i class="fa-solid fa-cart-plus"></i></span>
                            A.P. Journal
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul>
                                <li><a href="<?= site_url('financeCtrl/finance_create_AP');?>">Create</a></li>
                                <li> <a href="<?= site_url('financeCtrl/finance_manage_AP');?>">Manage</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!--end Acc-->
                <!--start-->

                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo1" aria-expanded="false"
                            aria-controls="flush-collapseTwo">
                            <span> <i class="fa-solid fa-book"></i></i></span>
                            Payment Voucher
                        </button>
                    </h2>
                    <div id="flush-collapseTwo1" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul>
                                <li><a href="<?= site_url('financeCtrl/finance_approve_PV');?>">Create</a></li>
                                <li> <a href="<?= site_url('financeCtrl/finance_manage_PV');?>">Manage</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--end-->

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
                                            <a href="<?= site_url('financeCtrl/finance_manage_ledger');?>"
                                                class="ledger">
                                                <span class="align-middle">A.P.
                                                    Ledger</span>

                                            </a>
                                        </li>
                                        <a href="<?= site_url('financeCtrl/finance_manage_PA');?>" class="ledger">
                                            <span class="align-middle">P.A.
                                                Ledger</span>
                                        </a>
                                        <li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

            </div>
            <!---->
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
                            <span class="indicator"><?=$fin_notif_voucher?></span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                        aria-labelledby="messagesDropdown">
                        <div class="dropdown-menu-header">


                            <div class="position-relative">
                                <span><?=$fin_notif_voucher?></span> Message Requests
                            </div>

                        </div>
                        <?php foreach ($fin_manage_voucher as $row) {

                            if ($row->payable_type =="Billing") {
                            /*---Start-----*/   
                            ?>
                        <?php if ($row->isPending == "approved") {?>
                        <div class="list-group">
                            <a href="<?=site_url('financeCtrl/ap_view_voucher/'.$row->PV_ID);?>"
                                class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="<?= base_url('includes/Custom/image/not_1.png');?>"
                                            class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark"></div>
                                        <div class="text-muted medium mt-1 text-text-black-50">Approved a payment
                                            voucher request.
                                        </div>
                                        <div class="text-muted small mt-1"><?= $row->voucher_date?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php }else{
                                ?>
                        <div class="list-group">
                            <a href="<?=site_url('financeCtrl/ap_view_voucher/'.$row->PV_ID);?>"
                                class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="<?= base_url('includes/Custom/image/not_1.png');?>"
                                            class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark"></div>
                                        <div class="text-muted medium mt-1 text-text-black-50">Disapproved a payment
                                            voucher request.
                                        </div>
                                        <div class="text-muted small mt-1"><?= $row->voucher_date?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                        }?>
                        <?php
                            /*----End---------*/ 
                            }else{

                                /*---Start------*/ 
?>
                        <?php if ($row->isPending == "approved") {?>
                        <div class="list-group">
                            <a href="<?=site_url('financeCtrl/finance_view_PV/'.$row->PV_ID);?>"
                                class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="<?= base_url('includes/Custom/image/not_1.png');?>"
                                            class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark"></div>
                                        <div class="text-muted medium mt-1 text-text-black-50">Approved a payment
                                            voucher request.
                                        </div>
                                        <div class="text-muted small mt-1"><?= $row->voucher_date?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php }else{
                                ?>
                        <div class="list-group">
                            <a href="<?=site_url('financeCtrl/finance_view_PV/'.$row->PV_ID);?>"
                                class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="<?= base_url('includes/Custom/image/not_1.png');?>"
                                            class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark"></div>
                                        <div class="text-muted medium mt-1 text-text-black-50">Disapproved a payment
                                            voucher request.
                                        </div>
                                        <div class="text-muted small mt-1"><?= $row->voucher_date?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                        }?>
                        <?php
                                /*----End--------*/ 
                            }
                        }?>

                        <div class="dropdown-menu-footer">
                            <a href="<?= site_url('financeCtrl/finance_manage_PV');?>" class="text-muted">Show all
                                messages</a>
                        </div>
                    </div>
                    <!-- TO be continued -->
                </li>

                <ssli class="nav-item dropdown">
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
                            href="<?php echo site_url('ManagerCtrl/finance_profile/'.$_SESSION['User_ID']); ?>"><i
                                class="align-middle me-1" data-feather="user"></i> Profile</a>

                        <a class="dropdown-item" href="<?php  echo site_url('Accounts/logout'); ?>"
                            onclick="return confirm('Are you sure you want to logout?')">
                            <i class="text-danger" data-feather="log-out"></i>Logout</a>

                    </div>
                </ssli>
            </ul>
        </div>
    </nav>
    <!--END OF NAVBAR-->