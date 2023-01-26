<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?php echo base_url('includes/static/css/app.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('includes/fontawesome/css/all.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('includes/Custom/css/login.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('includes/static/mdb/css/mdb.min.css');?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="<?php echo base_url('includes/Custom/js/sweetalert.min.js'); ?>"></script>

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
    </style>

</head>

<body>

    <?php  echo form_open_multipart('Accounts/otpview/'.$reset->User_ID,
                array('onsubmit'=>'return confirm(\'Are you sure you want to proceed?\')'));?>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">

                                    <label class="form-label">Enter OTP</label>
                                    <div class="form-outline mb-3 mt-2">

                                        <input type="text" class="form-control clear" style="height:40px"
                                            name="txtreset" value="<?= set_value('txtreset'); ?>" />

                                        <label class="form-label" autocomplete="off">OTP<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <small style="color:red;"><?= form_error('txtreset'); ?></small>
                                    <div class="text-center mt-3">
                                        <input type="submit" class="btn_save" name="btn_reset" value="Reset">
                                        <a href="<?=site_url('Accounts/forgotpassword');?>"><input type="button"
                                                value="Back" class="btn_save"></a>

                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <?= form_close()?>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="<?php echo base_url('includes/static/js/app.js'); ?>"></script>

    <script src="<?php echo base_url('includes/static/mdb/js/mdb.min.js'); ?>">
    < /scrip> <
    script src = "<?php echo base_url('includes/Custom/js/main.js'); ?>" >
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    <?php if($this->session->flashdata('success')){?>
    Command: toastr["success"]("<?= $this->session->flashdata('success') ?>")

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "5000",
        "timeOut": "7000",
        "extendedTimeOut": "2000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    <?php } ?>

    <?php if($this->session->flashdata('error')){?>
    Command: toastr["error"]("<?= $this->session->flashdata('error') ?>")

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "3000",
        "timeOut": "6000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    <?php } ?>
    </script>

</body>

</html>