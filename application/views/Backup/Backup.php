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
    font-weight: 400px
}

#bt {
    text-transform: none;
    width: 150px;
}
</style>
<main class="content">
    <div class="container-fluid">
        <div class="card border-success mb-3" style="max-width: 100%;">
            <div class="card-header bg-transparent border-success">
                <h3>Backup & Restore</h3>
            </div>
            <div class="card-body text-success">
                <a href="<?= site_url('BackupCtrl/export');?>"
                    onclick="return confirm('Are you sure you want to backup?')" class="btn btn-primary">Create
                    Backup</a>
                <br>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Restore
                </button>
            </div>

        </div>


        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?= site_url('BackupCtrl/import');?>" method="post" enctype="multipart/form-data"
                    class="needs-validation" novalidate onsubmit="return confirm('Are you sure you want to Restore?')">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <input type="file" name="import" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary btsupplier" value="Import" name="btn_import">
                        </div>
                    </div>
                    <?= form_close()?>
            </div>
        </div>
    </div>
</main>