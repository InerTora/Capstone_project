<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Purchase Order List</h1>

        <!--Start-->
        <div class=" row">
            <div class="col-xs-10 col-md-5">
                <div class="input-group mb-3 search">
                    <span class="input-group-text font-weight-bold">Search</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default">
                </div>
            </div>

        </div>
        <!--End-->
        <hr>
        <!--START TABLE-->
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill " id="card">
                    <table class="table table-hover my-0" id="table">
                        <thead>
                            <tr>
                                <th class="text-center text-white" id="tbl_th">PO No.</th>
                                <th class="text-center text-white" id="tbl_th">Supplier</th>
                                <th class="text-center text-white" id="tbl_th">Quantity</th>
                                <th class="text-center text-white" id="tbl_th">Unit</th>
                                <th class="text-center text-white" id="tbl_th">Description</th>
                                <th class="text-center text-white" id="tbl_th">Date Created</th>
                                <th class="text-center text-white" id="tbl_th">Action</th>


                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="text-center">PO-2022-23</td>
                                <td class="text-center">Riavin</td>
                                <td class="text-center">10</td>
                                <td class="text-center">Liter</td>
                                <td class="text-center">Unleaded</td>
                                <td class="text-center">09-27-22</td>
                                <td class="text-center">
                                    <a href="#"><i class="fa-solid fa-eye text-center" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop"></i></a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--END START TABLE-->

        <!--Modal-->
        <!-- Button trigger modal -->

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="staticBackdropLabel">View Purchase Order</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-7">
                                <label for=""><span>PO-2022-01</span></label>
                            </div>
                            <div class="col-5">
                                <label for="">PR-2022-01:</label><br>
                                <label for="">Date Created: 07-24-22</label>
                            </div>
                            <div class="col-7">
                                <label for="">Supplier: <span>Riavin</span></label><br>
                                <label for="">Address: <span>Francisco Zulluta St, Brgy Zone III, Koronadal City South
                                        Cotabato</span></label>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="">Contact No: <span>09464003615</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>

                                            <th class="text-center text-white"
                                                style=" background-color:rgba(34, 46, 60);">Quantity</th>
                                            <th class="text-center text-white"
                                                style=" background-color:rgba(34, 46, 60);">Unit</th>
                                            <th class="text-center text-white"
                                                style=" background-color:rgba(34, 46, 60);">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="text-center">23</td>
                                            <td class="text-center">Liter</td>
                                            <td class="text-center"><span class="">Unleaded</td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </div>
                    <!--END START TABLE-->

                </div>
            </div>
        </div>
        <!-- Modal -->

    </div>

</main>