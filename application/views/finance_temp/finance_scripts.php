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
toastr.error("<?= $this->session->flashdata('create_user_error') ?>");
<?php } ?>
</script>


<script>
$("#approve").DataTable({
    lengthMenu: [
        [10, 15, 25, -1],
        [10, 15, 25, 'All'],
    ]

});

$("#manage_invoice").DataTable({
    lengthMenu: [
        [10, 15, 25, -1],
        [10, 15, 25, 'All'],
    ]

});
$("#manage_ap").DataTable({
    lengthMenu: [
        [10, 15, 25, -1],
        [10, 15, 25, 'All'],
    ]

});
</script>
<!-- 
<script>

function mult(value) {
    var x;
    var total;

    var quant = document.getElementById('quantity').value;
    x = quant * value;
    total = x.toLocaleString(2);

    document.getElementById('out').value = total;
    //let num = 12674.45;
    //let text = num.toLocaleString();
}
</script>
 -->

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

                $('.grdtot').val(grandTotal.toLocaleString(2));
            }
        });
    });
});
</script>


<script>
$(".amount_item").on("input", (event) => {
    var amount = add_amount();
    if (!isNaN(amount)) {
        $("#grdtot").val(amount.toLocaleString(2));
    } else {

    }
})

function add_amount() {
    let amount = 0;
    for (let i = 0; i < $(".amount_item").length; i++) {
        amount = parseFloat(amount) + parseFloat($(".amount_item")[i].value)
    }
    return amount;
}
</script>

<script>
//Supplier
$(document).ready(function() {

    $('#supplier_search').keyup(function(e) {

        var supplier = $(this).val();

        if (supplier != "") {
            $.ajax({
                type: "POST",
                url: "<?php  echo base_url('financeCtrl/autosearch_supplier')?>",
                data: {
                    supplier: supplier
                },
                success: function(data) {
                    $('#supplier_result').html(data);
                    $('#supplier_result').css("display", "block");
                }
            });
        } else {
            $('#supplier_result').css("display", "none");
        }

    });
});
</script>

<script>
function supplier() {
    var supplier = document.getElementById('supplier').value;
    //alert(supplier);

    $.ajax({
        type: "POST",
        url: "<?php  echo base_url('financeCtrl/autosearch_supplier')?>",
        data: {
            supplier: supplier
        },

        success: function(data) {
            $('#supplier_result').html(data);
            $('#supplier_result').css("display", "block");
        }
    });

}
</script>