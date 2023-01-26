<!--START OF SIDEBAR-->
<nav id="sidebar" class="sidebar js-sidebar mt-3 ">
    <div class="sidebar-content js-simplebar">
        <ul class="sidebar-nav">
            <!--Acc-->
            <div class="accordion accordion-flush mt-5" id="accordionFlushExample">

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
                                <li><a href="<?= site_url('PurchaseRequestCtrl/driver_purchase_request');?>">Create</a>
                                </li>

                                <li> <a href="<?= site_url('PurchaseRequestCtrl/driver_manage_pr');?>">Manage</a></li>
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
                                <li> <a href="<?= site_url('PurchaseOrderCtrl/driver_table_po');?>">Create</a></li>
                                <li> <a href="<?= site_url('PurchaseOrderCtrl/driver_manage_po');?>">Manage</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

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




        <div class="navbar-collapse collapse nav-1">
            <ul class="navbar-nav navbar-align nav-2">
                <!--Notification-->

                <sali class="nav-item dropdown">

                    <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                        <div class="position-relative">
                            <i class="align-middle" data-feather="bell"></i>
                            <span class="indicator"><?=$driver_count?></span>
                        </div>
                    </a>

                    <sdiv class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                        aria-labelledby="messagesDropdown">
                        <div class="dropdown-menu-header">
                            <?php if($driver_count > 0){?>

                            <div class="position-relative">
                                <span><?=$driver_count?></span> Message Requests
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

                        <?php if ($row->isPending == "approved" || $row->isPending =="disapproved") {

                            if ($row->payable_type == "Gasoline") {
                               ?>
                        <div class="list-group">
                            <a href="<?= site_url('PurchaseRequestCtrl/driver_instructor_view/'.$row->purchase_request_id)?>"
                                class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="<?= base_url('includes/Custom/image/not_1.png');?>"
                                            class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark"></div>
                                        <div class="text-muted medium mt-1 text-text-black-50">Forward a purchase
                                            request.
                                        </div>
                                        <div class="text-muted small mt-1"><?= $row->posting_date?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                            }else{

                                ?>
                        <div class="list-group">
                            <a href="<?= site_url('PurchaseRequestCtrl/driver_instructor_view_sr/'.$row->purchase_request_id)?>"
                                class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <img src="<?= base_url('includes/Custom/image/not_1.png');?>"
                                            class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                    </div>
                                    <div class="col-10 ps-2">
                                        <div class="text-dark"></div>
                                        <div class="text-muted medium mt-1 text-text-black-50">Forward a purchase
                                            request.
                                        </div>
                                        <div class="text-muted small mt-1"><?= $row->posting_date?></div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <?php
                            }

                        }?>

                        <?php }?>

                        <div class="dropdown-menu-footer">
                            <a href="<?=site_url('PurchaseRequestCtrl/driver_manage_pr');?>" class="text-muted">Show all
                                Request</a>
                        </div>
                    </sdiv>
                </sali>
                <!--dropdown-->
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
                            href="<?php echo site_url('ManagerCtrl/driver_profile/'.$_SESSION['User_ID']); ?>"><i
                                class="align-middle me-1" data-feather="user"></i> Profile</a>

                        <a class="dropdown-item" href="<?php  echo site_url('Accounts/logout'); ?>"
                            onclick="return confirm('Are you sure you want to logout?')">
                            <i class="text-danger" data-feather="log-out"></i>Logout</a>

                    </div>
                </li>
                <!--dropdown-->
            </ul>
        </div>

    </nav>
    <!--END OF NAVBAR-->