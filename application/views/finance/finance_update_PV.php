<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Update Payment Voucher</h1>
        <!--start select catergory-->
        <hr>
        <div class="row  mb-2">
            <div class="col-3">
                <label for="">Payment Voucher No</label>
                <input type="text" name="" id="" class="form-control">
            </div>
            <div class="col-3">
                <label for="">Posting Date</label>
                <input type="text" name="" id="" class="form-control">
            </div>
            <!--start purchase request no-->
            <div class="col-3">
                <label for="">Reference No</label>

                <select class="form-select mb-3" aria-label="Default select example" name="branch" style="height:30px">
                    <option value="">PR-2022-01</option>
                    <option value="">PR-2022-03</option>
                </select>
            </div>

            <div class="col-3">
                <label for="">Due Date</label>
                <input type="text" name="" id="" class="form-control" disabled readonly value="02-21-21">

            </div>
            <!--start purchase request no-->
        </div>
        <!--end  select catergory-->
        <div class="card border-success mb-3" style="max-width: 75rem;">
            <div class="card-body text-success" id="card">
                <table class="table table-hover my-0" id="table">
                    <thead>
                        <tr>
                            <th class="text-center text-white" id="tbl_th">PI No.</th>
                            <th class="text-center text-white" id="tbl_th">SUpplier</th>
                            <th class="text-center text-white" id="tbl_th">Quantity</th>
                            <th class="text-center text-white" id="tbl_th">Unit</th>
                            <th class="text-center text-white" id="tbl_th">Description</th>
                            <th class="text-center text-white" id="tbl_th">Unit Price</th>
                            <th class="text-center text-white" id="tbl_th">Amount</th>
                            <th class="text-center text-white" id="tbl_th">Invoice Date</th>
                            <th class="text-center text-white" id="tbl_th">Due Date</th>
                            <th class="text-center text-white" id="tbl_th">Filename</th>


                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">PI-2022-01</td>
                            <td class="text-center">Shell Gasoline</td>
                            <td class="text-center">10</td>
                            <td class="text-center">Liter</td>
                            <td class="text-center">Unleaded</td>
                            <td class="text-center">70.85</td>
                            <td class="text-center">1,275.03</td>
                            <td class="text-center">09-22-22</td>
                            <td class="text-center">09-25-22</td>
                            <td class="text-center">PI-1010101</td>
                        </tr>

                    </tbody>
                </table>
                <div class="card-footer bg-transparent text-center mt-2">

                    <input type="submit" class="btn btn-success" value="Update">
                    <a href="<?=site_url('financeCtrl/finance_manage_PV');?>" class="btn btn-danger">Cancel</a>
                </div>
            </div>



        </div>

</main>