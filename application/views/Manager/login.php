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
</head>

<body>
    <?php  echo form_open_multipart('Accounts/login');?>
    <div class="l-form animate__animated">
        <div class="form">
            <div class="text-center mb-3">
                <img src="<?php echo base_url('includes/Custom/image/Logo.png'); ?>" alt="business logo"
                    class="img-fluid" />
            </div>
            <!-- Email input -->
            <div class="form-outline mb-4 ">
                <input type="email" id="form2Example1" class="form-control"
                    value="<?php  echo set_value('txtusername');?>" name="txtusername" />
                <label class="form-label is-invalid" for="form2Example1" autocomplete="off">Email<span
                        class="text-danger">*</span></label>

            </div>

            <!-- Password input -->
            <div class="form-outline mb-4 error">
                <input type="password" id="form2Example2" class="form-control" name="txtpassword" />
                <label class="form-label is-invalid" for="form2Example2" autocomplete="off">Password
                    <span class="text-danger">*</span></label>

            </div>

            <input type="submit" value="Login" class="btn-block login mt-3 mb-3" name="submit">
            <a href="<?= site_url('Accounts/forgotpassword');?>" class="mt-3">Forgot password?</a>

        </div>
    </div>
    <?= form_close()?>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="<?php echo base_url('includes/static/js/app.js'); ?>"></script>

    <script src="<?php echo base_url('includes/static/mdb/js/mdb.min.js'); ?>">
    < /scrip> <
    script src = "<?php echo base_url('includes/Custom/js/main.js'); ?>" >
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    <?php if($this->session->flashdata('error')){?>
    Command: toastr["warning"]("<?= $this->session->flashdata('error') ?>")

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    <?php } ?>

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
        "hideDuration": "1000",
        "timeOut": "5000",
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