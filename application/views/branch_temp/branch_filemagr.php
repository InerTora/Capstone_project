<div class="content">
    <div class="container-fluid">
        <h3 class="">File Management</h3>
        <!--Start Search-->
        <div class="row">
            <div class="col-5">
                <div class="input-group mb-3 search">
                    <span class="input-group-text font-weight-bold">Search</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default">
                </div>
            </div>
            <div class="col-3"></div>
            <!--Start select category-->
            <div class="col-4">
                <select class="form-select mb-3" aria-label="Default select example" name="branch" style="height:30px">
                    <option value="">Select Category</option>
                    <option value="">Purchase Invoice</option>
                    <option value="">Payment Voucher</option>
                </select>
            </div>
            <!--end select category-->
        </div>
        <!--end Search-->
        <hr>
        <!--START TABLE-->
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill" id="card">
                    <table class="table table-hover my-0" id="table">
                        <thead>
                            <tr>
                                <th id="tbl_th">Branch</th>
                                <th class="txt" id="tbl_th">Filename</th>
                                <th id="tbl_th">Type</th>
                                <th id="tbl_th">Date Upload</th>
                                <th class="txt" id="tbl_th">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="text-center">iDrive Driving Tutorial Korondal</td>
                                <td class="text-center">invoice.png</td>
                                <td class="text-center">image</td>
                                <td class="text-center"><span class="">09-22-22</td>
                                <td class="text-center">
                                    <a href="#" data-toggle="modal" data-target="#exampleModalCenter"><i
                                            class="fa-solid fa-eye view_btn"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--END START TABLE-->
        <!--start modal-->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <img class="align-item-center" src="" style="width:400px; height:400px">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal-->


    </div>
</div>