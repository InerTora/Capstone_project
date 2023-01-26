<script>
$("#report_supplier").DataTable({
    lengthMenu: [
        [10, 15, 25, -1],
        [10, 15, 25, 'All'],
    ]


});
$("#report_po").DataTable({
    lengthMenu: [
        [10, 15, 25, -1],
        [10, 15, 25, 'All'],
    ]

});
</script>

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#filter_report").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/FilterSupplier');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".supplier_data").remove()
                    $("#report_supplier").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#branch_filter_report").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/branch_FilterSupplier');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".supplier_data").remove()
                    $("#report_supplier").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>


<!-- Purchase Order Reports -->

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#btn_po").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/FilterPO');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".po_data").remove()
                    $("#report_po").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>
<!-- Purchase Order Reports -->

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#branch_btn_po").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/branch_FilterPO');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".branch_po_data").remove()
                    $("#branch_report_po").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>
<!-- Puchase Invoice Reports -->

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#btn_invoice").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/FilterInvoice');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".invoice_data").remove()
                    $("#report_po").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>
<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#branch_btn_invoice").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/branch_FilterInvoice');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".invoice_data").remove()
                    $("#report_po").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>
<!-- Payment Voucher Reports -->

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#btn_voucher").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/FilterVoucher');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".voucher_data").remove()
                    $("#report_po").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>
<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#branch_btn_voucher").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/branch_FilterVoucher');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".branch_voucher_data").remove()
                    $("#report_po").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>
<!-- Payment Schedule Reports -->

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#btn_payment").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/FilterPayment');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".payment_data").remove()
                    $("#report_supplier").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>
<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#branch_btn_payment").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/branch_FilterPayment');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".branch_payment_data").remove()
                    $("#report_supplier").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>

<!-- Supplier Balance to Date -->

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#btn_balance").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/FilterBalance');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".balance_data").remove()
                    $("#report_po").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>


<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#branch_btn_balance").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/branch_FilterBalance');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".branch_balance_data").remove()
                    $("#report_po").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>
<!-- Account Payable Ageing Reports -->

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#btn_ageing").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/FilterAgeing');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".ageing_data").remove()
                    $("#report_po").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#branch_btn_ageing").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/branch_FilterAgeing');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".branch_ageing_data").remove()
                    $("#report_po").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#gen_ap_filter").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/gen_ap_ledger_filter');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".gen_ap_data").remove()
                    $("#report_supplier").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#branch_ap_filter").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/branch_ap_ledger_filter');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".branch_ap_data").remove()
                    $("#report_supplier").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#gen_pa_filter").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/gen_pa_ledger_filter');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".gen_pa_data").remove()
                    $("#report_supplier").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>

<script>
$(document).ready(function() {
    $.datepicker.setDefaults({

        dateFormat: 'yy-mm-dd'
    });
    $("#branch_pa_filter").on("click", (event) => {
        $.ajax({
            type: "get",
            url: "<?=site_url('ReportsCtrl/branch_pa_ledger_filter');?>",
            data: {
                "from_date": $("#from_date").val(),
                "to_date": $("#to_date").val()
            },
            success: function(response) {
                if (response == "No Date Submitted") {
                    toastr.error("Please select dates first")
                } else {
                    $(".branch_pa_data").remove()
                    $("#report_supplier").append(response)
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    })

    $(function() {
        $("#from_date").datepicker();
        $("#to_date").datepicker();
    });

});
</script>