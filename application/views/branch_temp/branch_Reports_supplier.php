<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Supplier List</h1>

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
                                <th class="d-none d-xl-table-cell txt" id="tbl_th">Supplier ID</th>
                                <th class="txt" id="tbl_th">Supplier Name</th>
                                <th class="d-none d-md-table-cell txt" id="tbl_th">Address</th>
                                <th class="d-none d-xl-table-cell txt" id="tbl_th">Contact Number</th>
                                <th class="txt" id="tbl_th">Status</th>
                                <th class="d-none d-md-table-cell text-center txt" id="tbl_th">Action</th>



                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="text-center">01</td>
                                <td class="text-center">KCC</td>
                                <td class="text-center">09464003615</td>
                                <td class="text-center">Kalikasan Paraiso</td>
                                <td class="text-center">Active</td>
                                <td class="text-center">
                                    <a href="#"><i class="fa-solid fa-eye text-center" data-bs-toggle="modal"
                                            data-bs-target="#report_supplier"></i></a>
                                    <a href="<?php echo site_url('SupplierCtrl/update_supplier/'); ?>"><i
                                            class="fa-regular fa-pen-to-square"></i></a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--END START TABLE-->

        <!--Modal-->
        <!--End Modal-->

        <div class="modal fade" id="report_supplier" data-mdb-backdrop="static" data-mdb-keyboard="false"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="title">View Supplier List</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- form -->
                    <form class="txt-form">
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">Supplier Name:</label>
                                <label for="recipient-name" class="col-form-label" id="t_supplier">KCC</label>
                            </div>
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">Contact No.:</label>
                                <label for="recipient-name" class="col-form-label" id="t_contact">09464003615</label>
                            </div>
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">Address:</label>
                                <label for="recipient-name" class="col-form-label" id="t_address">Kalikasan
                                    Paraiso</label>
                            </div>
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">Status:</label>
                                <label for="recipient-name" class="col-form-label" id="t_status">Active</label>
                            </div>
                        </div>
                        <div class="modal-footer">


                        </div>
                </div>
                </form>
            </div>
        </div>
        <!--END OF modal-->


    </div>

</main>