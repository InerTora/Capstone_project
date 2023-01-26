<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportsCtrl extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->model('Manager_model');
        $is_logged_in = $this->Manager_model->is_user_logged_in();

        if (!$is_logged_in) {
            redirect('Accounts/login');
        }

        $this->load->model('PR_Model');
        $this->load->model('PO_Model');
        $this->load->model('ReportModel');
        $this->load->model('Finance_model');
    }


    public function index()
    {

        $gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
        $gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();

        $title['title'] = "Purchase Order Reports | iDrive Tutorial";
        $gen_notif['count'] = $this->PR_Model->count_notif();
        $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $this->load->view('templates/header', $title);
        $this->load->view('templates/navbar', $gen_notif);
        $this->load->view('Reports/report');
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }


    public function report_po()
    {

        $gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
        $gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
        $title['title'] = "Purchase Order Reports | iDrive Tutorial";
        $gen_notif['count'] = $this->PR_Model->count_notif();
        $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $data['po_print'] = $this->ReportModel->gen_print_po_report();
        $this->load->view('templates/header', $title);
        $this->load->view('templates/navbar', $gen_notif);
        $this->load->view('Reports/reports_po', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }

   
    public function print_po()
    {

        $data['po_print'] = $this->ReportModel->gen_print_po_report();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/report_po_list', $data, true);;

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
   
    public function branch_print_po()
    {
        $data['po_print'] = $this->ReportModel->branch_print_po_report();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/report_po_list', $data, true);;

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
  
    public function print_supplier()
    {
        $data['print_report_supplier'] = $this->ReportModel->print_report_supplier();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/print_supplier', $data, true);;

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function branch_print_supplier()
    {
        $data['report_supplier'] = $this->ReportModel->report_supplier();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/print_branch_supplier', $data, true);;
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function print_invoice()
    {
        $data['gen_print_invoice'] = $this->ReportModel->gen_print_invoice();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/print_invoice', $data, true);;

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
    public function branch_print_invoice()
    {

        $data['print_invoice'] = $this->ReportModel->print_invoice();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/print_branch_invoice', $data, true);;

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function print_voucher($id)
    {

        $data['list_voucher'] = $this->ReportModel->list_voucher($id);
        $data['print_voucher'] = $this->ReportModel->print_voucher($id);
        $data['get_branch'] = $this->ReportModel->branch();
        $data['getuser'] = $this->ReportModel->getuser1();
        $html = $this->load->view('Reports/print_voucher', $data, true);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
    public function print_disburse_voucher($id)
    {

        $data['list_voucher'] = $this->ReportModel->list_voucher($id);
        $data['print_voucher'] = $this->ReportModel->print_voucher($id);
        $data['get_branch'] = $this->ReportModel->branch();
        $data['getuser'] = $this->ReportModel->getuser1();
        $html = $this->load->view('Reports/print_disburse_voucher', $data, true);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function print_voucher_bills($id)
    {

        $data['list_voucher'] = $this->ReportModel->list_voucher_bills($id);
        $data['print_voucher'] = $this->ReportModel->print_voucher($id);
        $data['get_branch'] = $this->ReportModel->branch();
        $data['getuser'] = $this->ReportModel->getuser1();
        $html = $this->load->view('Reports/print_voucher_bills', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
    
    public function print_disburse_bills($id)
    {

        $data['list_voucher'] = $this->ReportModel->list_voucher_bills($id);
        $data['print_voucher'] = $this->ReportModel->print_voucher($id);
        $data['get_branch'] = $this->ReportModel->branch();
        $data['getuser'] = $this->ReportModel->getuser1();
        $html = $this->load->view('Reports/print_disburse_bills', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function report_invoice()
    {

        $gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
        $gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();


        $title['title'] = "Purchase Invoice Reports | iDrive Tutorial";
        $gen_notif['count'] = $this->PR_Model->count_notif();
        $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $data['gen_print_invoice'] = $this->ReportModel->gen_print_invoice();
        $this->load->view('templates/header', $title);
        $this->load->view('templates/navbar', $gen_notif);
        $this->load->view('Reports/report_invoice', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }

    public function branch_report_invoice()
    {

        $notif['count'] = $this->PR_Model->count_notif();
        $notif['count'] = $this->PR_Model->branch_count_notif();
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();

        $title['title'] = "Purchase Invoice Reports | iDrive Tutorial";

        $data['print_invoice'] = $this->ReportModel->print_invoice();
        $this->load->view('templates/header', $title);
        $this->load->view('branch_temp/navbar', $notif);
        $this->load->view('Reports/branch_invoice_report', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }

    public function report_voucher()
    {

        $gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
        $gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
        $title['title'] = "Purchase Order Reports | iDrive Tutorial";
        $gen_notif['count'] = $this->PR_Model->count_notif();
        $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $data['gen_reports_voucher'] = $this->ReportModel->gen_reports_voucher();
        $this->load->view('templates/header', $title);
        $this->load->view('templates/navbar', $gen_notif);
        $this->load->view('Reports/report_voucher', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }

    public function branch_report_supplier()
    {

        
        $title['title'] = "Supplier Reports | iDrive Tutorial";
        $notif['count'] = $this->PR_Model->count_notif();
        $notif['count'] = $this->PR_Model->branch_count_notif();
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
        $data['report_supplier'] = $this->ReportModel->report_supplier();
        $this->load->view('templates/header', $title);
        $this->load->view('branch_temp/navbar', $notif);
        $this->load->view('Reports/branch_report_supplier', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }
    public function branch_report_voucher()
    {

        $notif['count'] = $this->PR_Model->count_notif();
        $notif['count'] = $this->PR_Model->branch_count_notif();
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();

        $title['title'] = "Payment Voucher Reports | iDrive Tutorial";

        $data['branch_reports_voucher'] = $this->ReportModel->branch_reports_voucher();
        $this->load->view('templates/header', $title);
        $this->load->view('branch_temp/navbar', $notif);
        $this->load->view('Reports/branch_voucher_reports', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }

    public function branch_report_po()
    {
        $title['title'] = "Purchase Order Reports | iDrive Tutorial";
        $notif['count'] = $this->PR_Model->count_notif();
        $notif['count'] = $this->PR_Model->branch_count_notif();
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
        $data['po_print'] = $this->ReportModel->print_po_report();
        $this->load->view('templates/header', $title);
        $this->load->view('branch_temp/navbar', $notif);
        $this->load->view('Reports/branch_report_po', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }

    public function supplier_balance()
    {

        $gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
        $gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
        $title['title'] = "Purchase Order Reports | iDrive Tutorial";
        $gen_notif['count'] = $this->PR_Model->count_notif();
        $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $data['gen_supplier_balance_list'] = $this->ReportModel->gen_supplier_balance_list();
        $this->load->view('templates/header', $title);
        $this->load->view('templates/navbar', $gen_notif);
        $this->load->view('Reports/supplier_balance', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }

    public function branch_supplier_balance()
    {

        $notif['count'] = $this->PR_Model->count_notif();
        $notif['count'] = $this->PR_Model->branch_count_notif();
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
        $title['title'] = "Purchase Order Reports | iDrive Tutorial";
        $data['supplier_balance_list'] = $this->ReportModel->supplier_balance_list();
        $this->load->view('templates/header', $title);
        $this->load->view('branch_temp/navbar', $notif);
        $this->load->view('Reports/branch_supplier_balance', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }
    
    public function branch_ap_ageing_report()
    {

        $notif['count'] = $this->PR_Model->count_notif();
        $notif['count'] = $this->PR_Model->branch_count_notif();
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();

        $title['title'] = "Accounts Payable Ageing Reports | iDrive Tutorial";

        $data['branch_ap_ageing'] = $this->ReportModel->branch_ap_ageing();
        $this->load->view('templates/header', $title);
        $this->load->view('branch_temp/navbar', $notif);
        $this->load->view('Reports/branch_ageing_report', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }
    public function print_supplier_balance()
    {

        $data['gen_supplier_balance_list'] = $this->ReportModel->gen_supplier_balance_list();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/print_supplier_balance', $data, true);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
    public function branch_print_supplier_balance()
    {

       
        $data['supplier_balance_list'] = $this->ReportModel->supplier_balance_list();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/branch_print_balance', $data, true);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }


    public function payment_schedule()
    {

        $gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
        $gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
        $title['title'] = "Payment Voucher Reports | iDrive Tutorial";
        $gen_notif['count'] = $this->PR_Model->count_notif();
        $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $data['payment_list'] = $this->ReportModel->payment_list();
        $this->load->view('templates/header', $title);
        $this->load->view('templates/navbar', $gen_notif);
        $this->load->view('Reports/payment_report', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }

    public function branch_payment_schedule()
    {

        $notif['count'] = $this->PR_Model->count_notif();
        $notif['count'] = $this->PR_Model->branch_count_notif();
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
        $title['title'] = "Payment Voucher Reports | iDrive Tutorial";
        $data['branch_payment_list'] = $this->ReportModel->branch_payment_list();
        $this->load->view('templates/header', $title);
        $this->load->view('branch_temp/navbar', $notif);
        $this->load->view('Reports/branch_payment', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }
    // public function gen_APL()
    // {

    //     $gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
    //     $gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
    //     $title['title'] = "Accounts Payable Ledger Reports | iDrive Tutorial";
    //     $gen_notif['count'] = $this->PR_Model->count_notif();
    //     $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
    //     $data['payment_list'] = $this->ReportModel->payment_list();
    //     $this->load->view('templates/header', $title);
    //     $this->load->view('templates/navbar', $gen_notif);
    //     $this->load->view('Reports/payment_report', $data);
    //     $this->load->view('templates/footer');
    //     $this->load->view('Reports/report_script');
    // }


    public function print_paysched()
    {

        $data['payment_list'] = $this->ReportModel->payment_list();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/print_paysched', $data, true);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
    public function branch_print_paysched()
    {

        $data['payment_list'] = $this->ReportModel->branch_payment_list();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/branch_print_paysched', $data, true);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function final_voucher()
    {

        $data['gen_reports_voucher'] = $this->ReportModel->gen_reports_vouche_print();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/final_voucher', $data, true);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function branch_final_voucher()
    {

        $data['branch_reports_voucher'] = $this->ReportModel->branch_reports_voucher();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/branch_print_vocher', $data, true);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function ap_ageing_report()
    {

        $gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
        $gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
        $title['title'] = "Accounts Payable Ageing Reports | iDrive Tutorial";
        $gen_notif['count'] = $this->PR_Model->count_notif();
        $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();

        $data['ap_ageing'] = $this->ReportModel->ap_ageing();
        $this->load->view('templates/header', $title);
        $this->load->view('templates/navbar', $gen_notif);
        $this->load->view('Reports/ap_ageing_reports', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }

    public function print_ageing_reports()
    {

        $data['ap_ageing'] = $this->ReportModel->ap_ageing();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/print_ageing_reports', $data, true);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function branch_print_ageing_reports()
    {

        $data['branch_ap_ageing'] = $this->ReportModel->branch_ap_ageing();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/branch_print_aging', $data, true);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }


    public function print_cheque($id)
    {
        $this->load->library('numbertowordconvertsconver');

        $data['print_cheque'] = $this->ReportModel->print_cheque($id);
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/print_cheque', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }


    public function convertnum()
    {

        $val = $this->load->library('numbertowordconvertsconver');
        $number = 10569;
        echo $this->numbertowordconvertsconver->convert_number($number);
    }
    public function date()
    {

        $gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
        $gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
        $title['title'] = "Accounts Payable Ageing Reports | iDrive Tutorial";
        $gen_notif['count'] = $this->PR_Model->count_notif();
        $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();

        $data['ap_ageing'] = $this->ReportModel->ap_ageing();
        $this->load->view('templates/header', $title);
        $this->load->view('templates/navbar', $gen_notif);
        $this->load->view('Reports/date', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }

    /*-------------------Reports For Supplier-----------------*/ 

    function FilterSupplier()
    {
        if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
            $data = $this->ReportModel->gen_SupplierFilter($from_date, $to_date);
            if (count($data) != 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $row = $data[$i];
                   ?>
<tr class="supplier_data">
    <td><?= $row->supplier_name?></td>
    <td> <span> <?= ucwords($row->street) ?>,</span>
        <span>Brgy. <?= ucwords($row->barangay) ?>, </span>
        <span> <?= ucwords($row->city) ?> City, </span>
        <span> <?= ucwords($row->province) ?>.</span>
    </td>
    <td><?= $row->contact ?></td>
    <td><?= $row->status ?></td>
    <td><?= $row->date_created ?></td>



</tr>
<?php

                }
            } else {
               
                ?>
<tr class="supplier_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
            }
        } else {
          
  echo "No Date Submitted";

        }
    }

    
    function branch_FilterSupplier()
    {
        if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
            $branch = $_SESSION['branch_id'];
            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
            $data = $this->ReportModel->SupplierFilter($from_date, $to_date);
            if (count($data) != 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $row = $data[$i];
                   ?>
<tr class="supplier_data">
    <td><?= $row->supplier_name?></td>
    <td> <span> <?= ucwords($row->street) ?>,</span>
        <span>Brgy. <?= ucwords($row->barangay) ?>, </span>
        <span> <?= ucwords($row->city) ?> City, </span>
        <span> <?= ucwords($row->province) ?>.</span>
    </td>
    <td><?= $row->contact ?></td>
    <td><?= $row->status ?></td>
    <td><?= $row->date_created ?></td>

</tr>
<?php

                }
            } else {
               
                ?>
<tr class="supplier_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
            }
        } else {
          
  echo "No Date Submitted";

        }
    }


    public function report_supplier()
    {

        $gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
        $gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
        $title['title'] = "Purchase Order Reports | iDrive Tutorial";
        $gen_notif['count'] = $this->PR_Model->count_notif();
        $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $data['gen_report_supplier'] = $this->ReportModel->gen_report_supplier();
        $this->load->view('templates/header', $title);
        $this->load->view('templates/navbar', $gen_notif);
        $this->load->view('Reports/supplier_reports', $data);
        $this->load->view('templates/footer');
        $this->load->view('Reports/report_script');
    }

    /*----------Purchase Order-------------*/
    
    
    function FilterPO()
    {
        if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
            
            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
            $data = $this->ReportModel->gen_POFilter($from_date, $to_date);
            if (count($data) != 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $row = $data[$i];
                   ?>
<tr class="po_data">
    <td><?=$row->purchase_order_no?></td>
    <td><?=$row->purchase_request_no?></td>
    <td><?=$row->supplier_name?></td>
    <td><?=$row->po_date?></td>
    <td class="d-none d-xl-table-cell"><?=$row->First_Name.' '.$row->Last_Name?>
    <td><?= $row->Position?></td>
    <td><?= $row->branch_name?></td>



</tr>
<?php

                }
            } else {
               
                ?>
<tr class="po_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
            }
        } else {
          
  echo "No Date Submitted";

        }
    }


    function branch_FilterPO()
    {
        if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
            
            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
            $data = $this->ReportModel->POFilter($from_date, $to_date);
            if (count($data) != 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $row = $data[$i];
                   ?>
<tr class="branch_po_data">
    <td><?=$row->purchase_order_no?></td>
    <td><?=$row->purchase_request_no?></td>
    <td><?=$row->supplier_name?></td>
    <td><?=$row->po_date?></td>
    <td class="d-none d-xl-table-cell"><?=$row->First_Name.' '.$row->Last_Name?>
    <td><?= $row->Position?></td>


</tr>
<?php

                }
            } else {
               
                ?>
<tr class="branch_po_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
            }
        } else {
          
  echo "No Date Submitted";

        }
    }

    /*-------------Purchase Invoice Reports-------------------*/ 

    function FilterInvoice()
    {
        if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
            $branch = $_SESSION['branch_id'];
            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
            $data = $this->ReportModel->genInvoiceFilter($from_date, $to_date);
            if (count($data) != 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $row = $data[$i];
                   ?>
<tr class="invoice_data">
    <td><?=$row->purchase_invoice_no?></td>
    <td><?=$row->purchase_order_no?></td>
    <td><?=$row->supplier_name?></td>
    <td><?=$row->total_amount?></td>
    <td><?=$row->invoice_date?></td>
    <td><?=$row->due_date?></td>
    <td class="d-none d-xl-table-cell"><?=$row->First_Name.' '.$row->Last_Name?>
    <td><?= $row->Position?></td>
    <td><?= $row->branch_name?></td>
</tr>
<?php

                }
            } else {
               
                ?>
<tr class="invoice_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
            }
        } else {
          
  echo "No Date Submitted";

        }
    }

    function branch_FilterInvoice()
    {
        if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
           
            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
            $data = $this->ReportModel->InvoiceFilter($from_date, $to_date);
            if (count($data) != 0) {
                for ($i = 0; $i < count($data); $i++) {
                    $row = $data[$i];
                   ?>
<tr class="invoice_data">
    <td><?=$row->purchase_invoice_no?></td>
    <td><?=$row->purchase_order_no?></td>
    <td><?=$row->supplier_name?></td>
    <td><?=$row->total_amount?></td>
    <td><?=$row->invoice_date?></td>
    <td><?=$row->due_date?></td>
    <td class="d-none d-xl-table-cell"><?=$row->First_Name.' '.$row->Last_Name?>

</tr>
<?php

                }
            } else {
               
                ?>
<tr class="invoice_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
            }
        } else {
          
  echo "No Date Submitted";

        }
    }
/*---------Payment Voucher Reports------------*/ 

function FilterVoucher()
{
    if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
        $branch = $_SESSION['branch_id'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $data = $this->ReportModel->VoucherFilter($from_date, $to_date);
        if (count($data) != 0) {
            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
               ?>
<tr class="voucher_data">
    <td><?= $row->payment_voucher_no?></td>
    <td><?= $row->supplier_name?></td>
    <td><?= $row->payment_method?></td>
    <td><?= number_format((float)$row->total_amount, 2, '.', ',');?></td>
    <td><?= $row->voucher_date?></td>
    <td><?=$row->First_Name.' '.$row->Last_Name?>
    <td><?= $row->branch_name?></td>

</tr>
<?php

            }
        } else {
           
            ?>
<tr class="voucher_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
        }
    } else {
      
echo "No Date Submitted";

    }
}
function branch_FilterVoucher()
{
    if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
        $branch = $_SESSION['branch_id'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $data = $this->ReportModel->branch_VoucherFilter($from_date, $to_date);
        if (count($data) != 0) {
            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
               ?>
<tr class="branch_voucher_data">
    <td><?= $row->payment_voucher_no?></td>
    <td><?= $row->supplier_name?></td>
    <td><?= $row->payment_method?></td>
    <td><?= number_format((float)$row->total_amount, 2, '.', ',');?></td>
    <td><?= $row->voucher_date?></td>

    <td class="d-none d-xl-table-cell"><?=$row->First_Name.' '.$row->Last_Name?>


</tr>
<?php

            }
        } else {
           
            ?>
<tr class="voucher_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
        }
    } else {
      
echo "No Date Submitted";

    }
}

/*------------Payment Schedule Report----------------*/ 

function FilterPayment()
{
    if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
        $branch = $_SESSION['branch_id'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $data = $this->ReportModel->PaymentFilter($from_date, $to_date);
        if (count($data) != 0) {
            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
               ?>

<tr class="payment_data">
    <td><?=$row->isReference?></td>
    <td><?=$row->payable_type?></td>
    <td><i class="fa-solid fa-peso-sign"></i>
        <?= number_format((float)$row->invoice_amount, 2, '.', ',');?>
    </td>
    <td><?=$row->isDue_date?></td>
    <?php
                                $exp_date = $row->isDue_date;
                                $today_date = date('Y-m-d');
                                $exp = strtotime($exp_date);
                                $td = strtotime($today_date);

                                if ($td>$exp && $row->isStatus =="Unpaid") {?>

    <td><span class="badge bg-danger">OverDue</span></a></td>

    <?php }else{

                                    if ($row->isStatus == "Unpaid") {
                                      ?>
    <td><span class="badge bg-danger"><?=$row->isStatus?></span></a></td>

    <?php }else{    
                                    ?>
    <td>
        <span class="badge bg-success"><?=$row->isStatus?></span>
    </td>

    <?php
                                    
              }
                                    
} ?>

    <td><?= $row->branch_name?></td>
</tr>

<?php

            }
        } else {
           
            ?>
<tr class="payment_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
        }
    } else {
      
echo "No Date Submitted";

    }
}

function branch_FilterPayment()
{
    if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
        $branch = $_SESSION['branch_id'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $data = $this->ReportModel->branch_PaymentFilter($from_date, $to_date);
        if (count($data) != 0) {
            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
               ?>

<tr class="branch_payment_data">
    <td><?=$row->isReference?></td>
    <td><?=$row->payable_type?></td>
    <td><i class="fa-solid fa-peso-sign"></i>
        <?= number_format((float)$row->invoice_amount, 2, '.', ',');?>
    </td>
    <td><?=$row->isDue_date?></td>
    <?php
                                $exp_date = $row->isDue_date;
                                $today_date = date('Y-m-d');
                                $exp = strtotime($exp_date);
                                $td = strtotime($today_date);

                                if ($td>$exp && $row->isStatus =="Unpaid") {?>

    <td><span class="badge bg-danger">OverDue</span></a></td>

    <?php }else{

                                    if ($row->isStatus == "Unpaid") {
                                      ?>
    <td><span class="badge bg-danger"><?=$row->isStatus?></span></a></td>

    <?php }else{    
                                    ?>
    <td>
        <span class="badge bg-success"><?=$row->isStatus?></span>
    </td>

    <?php
                                    
              }
                                    
} ?>

</tr>

<?php

            }
        } else {
           
            ?>
<tr class="branch_payment_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
        }
    } else {
      
echo "No Date Submitted";

    }
}

/*--------Supplier Balance to date------------*/ 

function FilterBalance()
{
    if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
        $branch = $_SESSION['branch_id'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $data = $this->ReportModel->BalanceFilter($from_date, $to_date);
        if (count($data) != 0) {
            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
               ?>
<tr class="balance_data">
    <td><?=$row->purchase_invoice_no?></td>
    <td><?=$row->supplier_name?></td>
    <td><?=$row->invoice_date?></td>
    <td><?=$row->due_date?></td>
    <!-- Check if the date is expired and count the days -->
    <?php  
                               if (!$row->balance == "0") {
                                $exp_date = $row->due_date;
                                $today_date = date('Y-m-d');

                                $exp = strtotime($exp_date);
                                $td = strtotime($today_date);

                                if ($td > $exp) {
                                    $diff = $td-$exp;
                                    $days = abs(floor($diff / (60*60*24)));
                                   ?>
    <td><?=$days?></td>
    <?php
                                }else{
                                    ?>

    <td>0</td>
    <?php

                                }
                               }else{

                                ?>
    <td>0</td>
    <?php
                               }

                                ?>
    <td><?= $row->balance?></td>
    <td><?= $row->branch_name?></td>
</tr>

<?php

            }
        } else {
           
            ?>
<tr class="balance_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
        }
    } else {
      
echo "No Date Submitted";

    }
}

function branch_FilterBalance()
{
    if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
        $branch = $_SESSION['branch_id'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $data = $this->ReportModel->branch_BalanceFilter($from_date, $to_date);
        if (count($data) != 0) {
            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
               ?>
<tr class="branch_balance_data">
    <td><?=$row->purchase_invoice_no?></td>
    <td><?=$row->supplier_name?></td>
    <td><?=$row->invoice_date?></td>
    <td><?=$row->due_date?></td>
    <!-- Check if the date is expired and count the days -->
    <?php  
                               if (!$row->balance == "0") {
                                $exp_date = $row->due_date;
                                $today_date = date('Y-m-d');

                                $exp = strtotime($exp_date);
                                $td = strtotime($today_date);

                                if ($td > $exp) {
                                    $diff = $td-$exp;
                                    $days = abs(floor($diff / (60*60*24)));
                                   ?>
    <td><?=$days?></td>
    <?php
                                }else{
                                    ?>

    <td>0</td>
    <?php

                                }
                               }else{

                                ?>
    <td>0</td>
    <?php
                               }

                                ?>
    <td><?= $row->balance?></td>

</tr>

<?php

            }
        } else {
           
            ?>
<tr class="branch_balance_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
        }
    } else {
      
echo "No Date Submitted";

    }
}


/*--------Accounts Payable Ageing Reports---------------*/ 

function FilterAgeing()
{
    if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
        $branch = $_SESSION['branch_id'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $data = $this->ReportModel->AgeingFilter($from_date, $to_date);
        if (count($data) != 0) {
            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
               ?>
<tr class="ageing_data">
    <td><?=$row->isReference?></td>
    <td><?=$row->supplier_name?></td>

    <td><?=$row->isDue_date?></td>
    <td><i class="fa-solid fa-peso-sign"></i> <?=$row->invoice_amount?></td>
    <!-- Count 1-15 days-->
    <?php  
                                
                                $exp_date = $row->isDue_date;
                                $today_date = date('Y-m-d');

                                $exp = strtotime($exp_date);
                                $td = strtotime($today_date);

                                if ($td > $exp) {
                                    $diff = $td-$exp;
                                    $days = abs(floor($diff / (60*60*24)));
                                   ?>
    <td><?=$days?></td>
    <?php
                                }else{
                                    ?>

    <td>0</td>
    <?php

                                }
                                ?>
    <td><i class="fa-solid fa-peso-sign"></i> <?=$row->balance?></td>
    <td class="d-none d-xl-table-cell"><?=$row->First_Name.' '.$row->Last_Name?>
    <td> <?=$row->branch_name?></td>

</tr>

<?php

            }
        } else {
           
            ?>
<tr class="ageing_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
        }
    } else {
      
echo "No Date Submitted";

    }
}

function branch_FilterAgeing()
{
    if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
        $branch = $_SESSION['branch_id'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $data = $this->ReportModel->branch_AgeingFilter($from_date, $to_date);
        if (count($data) != 0) {
            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
               ?>
<tr class="branch_ageing_data">
    <td><?=$row->isReference?></td>
    <td><?=$row->supplier_name?></td>
    <td><?=$row->isDue_date?></td>
    <td><i class="fa-solid fa-peso-sign"></i> <?=$row->invoice_amount?></td>
    <!-- Count 1-15 days-->
    <?php  
                                
                                $exp_date = $row->isDue_date;
                                $today_date = date('Y-m-d');

                                $exp = strtotime($exp_date);
                                $td = strtotime($today_date);

                                if ($td > $exp) {
                                    $diff = $td-$exp;
                                    $days = abs(floor($diff / (60*60*24)));
                                   ?>
    <td><?=$days?></td>
    <?php
                                }else{
                                    ?>

    <td>0</td>
    <?php

                                }
                                ?>
    <td><i class="fa-solid fa-peso-sign"></i> <?=$row->balance?></td>
    <td class="d-none d-xl-table-cell"><?=$row->First_Name.' '.$row->Last_Name?>
</tr>

<?php

            }
        } else {
           
            ?>
<tr class="branch_ageing_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
        }
    } else {
      
echo "No Date Submitted";

    }
}


/*------ACCOUNTS PAYABLE LEDGER---------------------*/ 


public function ap_ledger()
{

    $gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
    $gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
    $title['title'] = "Accounts Payable Ledger Reports | iDrive Tutorial";
    $gen_notif['count'] = $this->PR_Model->count_notif();
    $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
    $data['table_ledger1'] = $this->Finance_model->table_ledger1();
    $this->load->view('templates/header', $title);
    $this->load->view('templates/navbar', $gen_notif);
    $this->load->view('Reports/gen_AP_ledger_report',$data);
    $this->load->view('templates/footer');
    $this->load->view('Reports/report_script');
}
 public function print_ap_ledger()
    {
        $data['table_ledger1'] = $this->Finance_model->table_ledger1();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/print_ap_ledger', $data, true);;

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }


    public function branch_ap_ledger()
{

    $notif['count'] = $this->PR_Model->count_notif();
    $notif['count'] = $this->PR_Model->branch_count_notif();
    $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
    $title['title'] = "Accounts Payable Ledger Reports | iDrive Tutorial";
    $data['table_ledger'] = $this->Finance_model->table_ledger();
    $this->load->view('templates/header', $title);
    $this->load->view('branch_temp/navbar', $notif);
    $this->load->view('Reports/branch_AP_ledger_report',$data);
    $this->load->view('templates/footer');
    $this->load->view('Reports/report_script');
}
 public function branch_print_ap_ledger()
    {
        $data['table_ledger'] = $this->Finance_model->table_ledger();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/branch_print_ap_ledger', $data, true);;

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }


    /*-----PAID Accounts ledger----------*/ 

    
public function pa_ledger()
{

    $gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
    $gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
    $title['title'] = "Paid Accounts Ledger Reports | iDrive Tutorial";
    $gen_notif['count'] = $this->PR_Model->count_notif();
    $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
    $data['table_pa'] = $this->Finance_model->gen_table_pa();
    $this->load->view('templates/header', $title);
    $this->load->view('templates/navbar', $gen_notif);
    $this->load->view('Reports/gen_PA_ledger',$data);
    $this->load->view('templates/footer');
    $this->load->view('Reports/report_script');
}
 public function print_pa_ledger()
    {
        $data['table_pa'] = $this->Finance_model->gen_table_pa();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/print_pa_ledger', $data, true);;

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function branch_pa_ledger()
{

    $gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
    $gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
    $title['title'] = "Paid Accounts Ledger Reports | iDrive Tutorial";
    $gen_notif['count'] = $this->PR_Model->count_notif();
    $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
    $data['table_pa'] = $this->Finance_model->table_pa();
    $this->load->view('templates/header', $title);
    $this->load->view('templates/navbar', $gen_notif);
    $this->load->view('Reports/branch_PA_ledger',$data);
    $this->load->view('templates/footer');
    $this->load->view('Reports/report_script');
}
 public function branch_print_pa_ledger()
    {
        $data['table_pa'] = $this->Finance_model->table_pa();
        $data['get_branch'] = $this->ReportModel->branch();
        $html = $this->load->view('Reports/branch_print_pa_ledger', $data, true);;

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }


    function gen_ap_ledger_filter()
{
    if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
        $branch = $_SESSION['branch_id'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $data = $this->ReportModel->gen_filter_AP_ledger($from_date, $to_date);
        if (count($data) != 0) {
            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
               ?>
<tr class="gen_ap_data">

    <td><?=$row->AP_no?></td>
    <td><?=$row->isReference?></td>
    <td><?=$row->PV_ID?></td>
    <td><?=$row->supplier_name?></td>
    <td><i class="fa-solid fa-peso-sign"></i><?=$row->invoice_amount?>
    </td>
    <td><?=$row->isDue_date?></td>
    <td>
        <?php if ($row->isStatus == "Paid") {
                                  ?>
        <span class="badge bg-success"> <?=$row->isStatus?></span>
        <?php
                                   }else{
                                    ?>
        <span class="badge bg-danger"> <?=$row->isStatus?></span>
        <?php
                                   }?>
    </td>

    <td><?=$row->branch_name?></td>


</tr>
<?php

            }
        } else {
           
            ?>
<tr class="gen_ap_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
        }
    } else {
      
echo "No Date Submitted";

    }
}

function branch_ap_ledger_filter()
{
    if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
        $branch = $_SESSION['branch_id'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $data = $this->ReportModel->branch_filter_AP_ledger($from_date, $to_date);
        if (count($data) != 0) {
            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
               ?>
<tr class="branch_ap_data">

    <td><?=$row->AP_no?></td>
    <td><?=$row->isReference?></td>
    <td><?=$row->PV_ID?></td>
    <td><?=$row->supplier_name?></td>
    <td><i class="fa-solid fa-peso-sign"></i><?=$row->invoice_amount?>
    </td>
    <td><?=$row->isDue_date?></td>
    <td>
        <?php if ($row->isStatus == "Paid") {
                                  ?>
        <span class="badge bg-success"> <?=$row->isStatus?></span>
        <?php
                                   }else{
                                    ?>
        <span class="badge bg-danger"> <?=$row->isStatus?></span>
        <?php
                                   }?>
    </td>



</tr>
<?php

            }
        } else {
           
            ?>
<tr class="branch_ap_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
        }
    } else {
      
echo "No Date Submitted";

    }
}

function gen_pa_ledger_filter()
{
    if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
        $branch = $_SESSION['branch_id'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $data = $this->ReportModel->gen_filter_PA_ledger($from_date, $to_date);
        if (count($data) != 0) {
            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
               ?>
<tr class="gen_pa_data">

<tr>
    <td><?=$row->PA_no?></td>
    <td><?=$row->payment_voucher_no?></td>
    <td><?=$row->supplier_name?></td>
    <td><i class="fa-solid fa-peso-sign"></i>
        <?= number_format((float)$row->paid_amount, 2, '.', ',');?>
    </td>
    <td>
        <?=$row->reciept_no?>

    </td>

    <td><?=$row->voucher_date?></td>
    <td><?=$row->branch_name?></td>
</tr>



</tr>
<?php

            }
        } else {
           
            ?>
<tr class="gen_pa_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
        }
    } else {
      
echo "No Date Submitted";

    }
}

function branch_pa_ledger_filter()
{
    if ((isset($_GET['from_date']) && isset($_GET['to_date']))&&($_GET['to_date']!=""||$_GET['from_date']!="")) {
        $branch = $_SESSION['branch_id'];
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        $data = $this->ReportModel->branch_filter_PA_ledger($from_date, $to_date);
        if (count($data) != 0) {
            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
               ?>
<tr class="branch_pa_data">

<tr>
    <td><?=$row->PA_no?></td>
    <td><?=$row->payment_voucher_no?></td>
    <td><?=$row->supplier_name?></td>
    <td><i class="fa-solid fa-peso-sign"></i>
        <?= number_format((float)$row->paid_amount, 2, '.', ',');?>
    </td>
    <td>
        <?=$row->reciept_no?>

    </td>

    <td><?=$row->voucher_date?></td>

</tr>



</tr>
<?php

            }
        } else {
           
            ?>
<tr class="branch_pa_data">
    <td colspan="5">No Record found from <?=$from_date .' upto ' . $to_date?></td>
</tr>
<?php
        }
    } else {
      
echo "No Date Submitted";

    }
}
}