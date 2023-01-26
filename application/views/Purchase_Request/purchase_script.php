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
$("#PRtable").DataTable({
    lengthMenu: [
        [10, 15, 25, -1],
        [10, 15, 25, 'All'],
    ]

});

$("#branch_table_pr").DataTable({
    lengthMenu: [
        [10, 15, 25, -1],
        [10, 15, 25, 'All'],
    ]

});

$("#requesttable").DataTable({
    lengthMenu: [
        [10, 15, 25, -1],
        [10, 15, 25, 'All'],
    ]

});
</script>


<!-- Update -->
<script type="text/javascript">
$(function() {
    $('.price, .subtot, .grdtot').prop(true);
    var $tblrows = $("#tblProducts tbody tr");

    $tblrows.each(function(index) {
        var $tblrow = $(this);

        $tblrow.find('.price').on('keyup', function() {

            var qty = $tblrow.find("[id=qty]").val();
            var price = $tblrow.find("[id=price]").val();
            var subTotal = qty * price;

            if (!isNaN(subTotal)) {

                $tblrow.find('.subtot').val(subTotal.toFixed(2));
                var grandTotal = 0;

                $(".subtot").each(function() {
                    var stval = parseFloat($(this).val());
                    grandTotal += isNaN(stval) ? 0 : stval;
                });

                $('.grdtot').val(grandTotal);
            }
        });
    });
});
</script>