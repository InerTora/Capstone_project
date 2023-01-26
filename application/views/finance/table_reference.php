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

#table_style {
    font-size: 15px;
    font-weight: bold;
    color: black;
}

#bt {
    text-transform: none;
    width: 150px;
}
</style>


<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark"> Select Supplier</h1>

        <!--Start-->
        <div class=" row">

            <div class="col-xs-10 col-md-5">
                <div class="input-group mb-3 search">
                    <select class="form-select mb-3" aria-label="Default select example" name="supplier"
                        style="height:40px" id="supplier" onchange="supplier()">
                        <option value="">Select Supplier</option>
                        <?php foreach ($getallsupplier as $row) {?>
                        <option value="<?=$row->supplier_id?>"><?=$row->supplier_name?></option>
                        <?php } ?>
                    </select>
                </div>

            </div>
            <div class="col-xs-10 col-md-3"></div>
            <hr>
        </div>

        <div class="row">
            <div class="col-12" id="supplier_result">
            </div>
        </div>
    </div>

</main>