<script>
<?php if ($this->session->flashdata('create_user_success')) { ?>

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

<?php if ($this->session->flashdata('create_user_error')) { ?>
toastr.error("<?= $this->session->flashdata('create_user_error') ?>");
<?php } ?>
</script>


<script>
//This button is modified coppy this 
$(document).on('click', '#btn_pr', function() {

    var is_empty = false;

    for (let i = 0; i < $(".plate_number").length; i++) {

        if ($(".plate_number")[i].value == "") {
            $(".plate_number")[i].style.borderColor = "red";
            is_empty = true;

        } else {
            $(".plate_number")[i].style.borderColor = "gray";

        }
    }
    if (!is_empty) {
        var dups = checkDups() + []
        requestList(dups)
    } else {
        toastr.error("Please make sure you select all of selections available")
    }
});

function checkDups() {
    var ids = []
    for (let i = 0; i < $(".plate_number").length; i++) {
        ids.push($(".plate_number")[i].selectedOptions[0].attributes.car_id.value)
    }
    return ids
}
$('#table_field').on('click', '.remove-category', function(e) {
    e.preventDefault();

    if ($('#table_field .row_content').find('tr').length > 1) {
        //alert();
        $(this).closest('tr').remove();
        $("#btn_pr").removeAttr("disabled")
    } else {
        toastr.error('Cannot be deleted');
    }
});

async function requestList(dups) {

    $.ajax({
        type: "get",
        url: '<?= site_url('PurchaseRequestCtrl/get_plate_list'); ?>',
        data: {
            "plate_list": dups
        },
        success: function(response) {

            var data = JSON.parse(response)

            if (data.carlist.length != 0) {
                var elem = $('#table_field tbody').find('tr:first').clone();
                var input_elem = $('.row_content').find('tr:last');
                var val = input_elem.find('input').val();
                $('.row_content').append(elem);
                elem.find('input').addClass('empty');
                elem.find('input').val('');
                $(".qty_control_pr")[$(".qty_control_pr").length - 1].setAttribute("id",
                    "qty_control_pr-" + $(
                        ".qty_control_pr")
                    .length)
                $(".unit_cost_control_pr")[$(".unit_cost_control_pr").length - 1].setAttribute("id",
                    "unit_cost_control_pr-" + $(
                        ".unit_cost_control_pr")
                    .length)
                $(".estimated_cost_control_pr")[$(".estimated_cost_control_pr").length - 1]
                    .setAttribute("id",
                        "estimated_cost_control_pr-" + $(".estimated_cost_control_pr")
                        .length)
                var item_num = $(".plate_number").length - 1;

                $('.txt_liters').val('Liters');
                $(".plate_number")[item_num].setAttribute("id", "option" + item_num)
                $("#option" + item_num).empty()
                $("#option" + item_num).append(' <option value=""></option>')
                for (let i = 0; i < data.carlist.length; i++) {
                    $("#option" + item_num).append("<option car_id='" + data.carlist[i].car_id +
                        "' value='" + data.carlist[i].car_id + "'>" + data.carlist[i].plate_no +
                        ' ' +
                        '(' +
                        data.carlist[i].brand + ')' +
                        "</option>");
                }
                if (data.carlist.length - 1 == 0) {
                    $("#btn_pr").attr("disabled", "disabled")
                }
            } else {
                alert("All available plates was selected already!")
            }
        }
    });
}
</script>


<script type="text/javascript">
function calculate_pr(event) {
    var row = event.id.split("-")[1];
    var qty = "qty_control_pr-" + row;
    var unit_cost = "unit_cost_control_pr-" + row;
    var estimated_cost = "estimated_cost_control_pr-" + row;
    var val1 = parseFloat($("#" + qty).val());
    var val2 = parseFloat($("#" + unit_cost).val());

    var result = val1 * val2;
    var subtot = result.toFixed(2);
    if (!isNaN(subtot)) {
        $("#" + estimated_cost).val(subtot)
    } else {
        $("#" + estimated_cost).val(0.0)
    }
    $("#total_cost_pr").val(getTotalCost_pr().toFixed(2))
}

function getTotalCost_pr() {
    let data = 0;
    for (let i = 0; i < $(".estimated_cost_control_pr").length; i++) {
        data = data + parseFloat($(".estimated_cost_control_pr")[i].value)
    }
    return parseFloat(data)
}
</script>


<script>
$("#usertable").DataTable({
    lengthMenu: [
        [10, 15, 25, -1],
        [10, 15, 25, 'All'],
    ],

});
$("#branchtable").DataTable({
    lengthMenu: [
        [10, 15, 25, -1],
        [10, 15, 25, 'All'],
    ]

});
$("#tablebill").DataTable({
    lengthMenu: [
        [10, 15, 25, -1],
        [10, 15, 25, 'All'],
    ]

});
</script>

<script>
//add multiple data




//add
$(document).on('click', '#btn_sr', function() {

    var elem = $('#table_field_sr tbody').find('tr:first').clone();
    var input_elem = $('.row_content_sr').find('tr:last');
    var val = input_elem.find('input').val();
    $('.row_content_sr').append(elem);
    elem.find('input').addClass('empty');
    elem.find('input').val('');
    // $('.auto_no').val(y);

    let num = $('.auto_no').length;
    $('.auto_no')[num - 1].value = num;
    $(".qty_control")[$(".qty_control").length - 1].setAttribute("id", "qty_control-" + $(".qty_control")
        .length)
    $(".unit_cost_control")[$(".unit_cost_control").length - 1].setAttribute("id", "unit_cost_control-" + $(
            ".unit_cost_control")
        .length)
    $(".estimated_cost_control")[$(".estimated_cost_control").length - 1].setAttribute("id",
        "estimated_cost_control-" + $(".estimated_cost_control")
        .length)

});
//remove data

$('#table_field_sr').on('click', '.remove-category_sr', function(e) {
    e.preventDefault();

    if ($('#table_field_sr .row_content_sr').find('tr').length > 1) {
        //alert();
        $(this).closest('tr').remove();
    } else {
        toastr.error('Cannot deleted');
    }
});
</script>

<script type="text/javascript">
function calculate(event) {
    var row = event.id.split("-")[1];
    var qty = "qty_control-" + row;
    var unit_cost = "unit_cost_control-" + row;
    var estimated_cost = "estimated_cost_control-" + row;
    var val1 = parseFloat($("#" + qty).val());
    var val2 = parseFloat($("#" + unit_cost).val());

    var result = val1 * val2;
    var subtot = result.toFixed(2);
    if (!isNaN(subtot)) {
        $("#" + estimated_cost).val(subtot)
    } else {
        $("#" + estimated_cost).val(0.0)
    }
    $("#total_cost").val(getTotalCost().toFixed(2))
}

function getTotalCost() {
    let data = 0;
    for (let i = 0; i < $(".estimated_cost_control").length; i++) {
        data = data + parseFloat($(".estimated_cost_control")[i].value)
    }
    return parseFloat(data)
}
</script>

<script>
function myFunction() {
    var x = document.getElementById("mySelect").value;
    document.getElementById("demo").innerHTML = x;


}
</script>

<script>

</script>