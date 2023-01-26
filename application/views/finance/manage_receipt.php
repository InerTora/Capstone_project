<main class="content">
    <div class="container-fluid">
        <h1 class="h2 mb-3  text-dark">Manage Payment Receipt</h1>
        <hr>
        <!--Start-->
        <div class=" row">
            <div class="card border-success mb-3"
                style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="card-body">
                    <table class="table my-0 w-100 row-border-none" id="manage_invoice">
                        <thead class="mb-2">
                            <tr>

                                <th>Receipt No.</th>
                                <th>Payment Voucher No.</th>
                                <th>Posting Date</th>
                                <th>File</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($payment_receipt as $row) {
                           ?>
                            <tr>
                                <td><?=$row->reciept_no?></td>
                                <td><?=$row->payment_voucher_no?></td>
                                <td><?=$row->posting_date?></td>
                            </tr>
                            <?php
                        }?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>
</main>