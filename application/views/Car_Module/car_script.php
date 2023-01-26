<script>
<?php if($this->session->flashdata('create_user_success'))
        {?>

Command: toastr["success"]("<?= $this->session->flashdata('create_user_success') ?>")

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

<?php if($this->session->flashdata('create_user_error')){?>
toastr.warning("<?= $this->session->flashdata('create_user_error') ?>");
<?php } ?>
</script>

<script>
$("#cartable").DataTable({
    lengthMenu: [
        [10, 15, 25, -1],
        [10, 15, 25, 'All'],
    ]

});
</script>