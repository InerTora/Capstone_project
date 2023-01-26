<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export_csv extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->model('Manager_model');
		$is_logged_in = $this->Manager_model->is_user_logged_in();
		
	if (!$is_logged_in) {
		redirect('Accounts/login');
	}
        $this->load->model('PR_Model');
        $this->load->model('Car_Model');
        $this->load->model('Finance_model');
        $this->load->model('UserModel');
        $this->load->model('Export_csv_model');
		
    }

/*Supplier*/ 
    public function supplier_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Supplier_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $supplier = $this->Export_csv_model->fetch_all();

            $file = fopen('php://output','w');
            $header = array("Supplier Name","Street","Barangay","City","Province","Contact");

            fputcsv($file,$header);

            foreach ($supplier->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;


        }else{
           
        }
    }
/*Purchase Order*/ 
    public function gen_po_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Purchase_Order_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $po_reports = $this->Export_csv_model->gen_export_po_report();

            $file = fopen('php://output','w');
            $header = array("Purchase Request","Purchase Order","Supplier","Posting Date","Created By","Position","Branch");

            fputcsv($file,$header);

            foreach ($po_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    public function branch_po_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Purchase_Order_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $po_reports = $this->Export_csv_model->branch_export_po_report();

            $file = fopen('php://output','w');
            $header = array("Purchase Request","Purchase Order","Supplier","Posting Date","Created By","Position");

            fputcsv($file,$header);

            foreach ($po_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    /*Purchase Invoice*/ 

    public function gen_pi_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Purchase_Invoice_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $pi_reports = $this->Export_csv_model->gen_export_invoice();

            $file = fopen('php://output','w');
            $header = array("Purchase Invoice","Purchase Order","Supplier","Total Amount","Date Posted","Due Date","Created By","Branch");

            fputcsv($file,$header);

            foreach ($pi_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    public function branch_pi_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Purchase_Invoice_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $pi_reports = $this->Export_csv_model->branch_export_invoice();

            $file = fopen('php://output','w');
            $header = array("Purchase Invoice","Purchase Order","Supplier","Total Amount","Date Posted","Due Date","Created By");

            fputcsv($file,$header);

            foreach ($pi_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    /*------Start Voucher---------*/ 
    public function gen_voucher_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Payment_Voucher_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $voucher_reports = $this->Export_csv_model->gen_export_voucher();

            $file = fopen('php://output','w');
            $header = array("Payment Voucher","Supplier","Payment Mehthod","Total Amount","Posting Date","Created by","Branch");

            fputcsv($file,$header);

            foreach ($voucher_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    public function branch_voucher_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Payment_Voucher_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $voucher_reports = $this->Export_csv_model->branch_export_voucher();

            $file = fopen('php://output','w');
            $header = array("Payment Voucher","Supplier","Payment Mehthod","Total Amount","Posting Date","Created by");

            fputcsv($file,$header);

            foreach ($voucher_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    /*----Aging Report-----------*/ 
    public function gen_aging_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Accounts_Payable_Ageing_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $aging_reports = $this->Export_csv_model->ap_export_ageing();

            $file = fopen('php://output','w');
            $header = array("Reference No","Supplier","Due Date","Current Amount","Outstanding Balance","Created by","Branch");

            fputcsv($file,$header);

            foreach ($aging_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    public function branch_aging_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Accounts_Payable_Ageing_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $aging_reports = $this->Export_csv_model->branch_ap_export_ageing();

            $file = fopen('php://output','w');
            $header = array("Reference No","Supplier","Due Date","Current Amount","Outstanding Balance","Created by");

            fputcsv($file,$header);

            foreach ($aging_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    /*Supplier Balance TO date*/ 

    public function gen_balance_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Supplier_Balance_to_date_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $balance_reports = $this->Export_csv_model->gen_export_supplier_balance();

            $file = fopen('php://output','w');
            $header = array("Invoice No","Supplier","Posting Date","Due Date","Ourstanding Balance","Branch");

            fputcsv($file,$header);

            foreach ($balance_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    public function branch_balance_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Supplier_Balance_to_date_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $balance_reports = $this->Export_csv_model->branch_export_supplier_balance();

            $file = fopen('php://output','w');
            $header = array("Invoice No","Supplier","Posting Date","Due Date","Ourstanding Balance");

            fputcsv($file,$header);

            foreach ($balance_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    /*-------Payment Schedule------------*/ 

    public function gen_schedule_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Payment_Schedule_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $schedule_reports = $this->Export_csv_model->gen_export_schedule();

            $file = fopen('php://output','w');
            $header = array("Reference No","Billing Type","Due Date","Status","Branch");

            fputcsv($file,$header);

            foreach ($schedule_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    public function branch_schedule_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Payment_Schedule_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $schedule_reports = $this->Export_csv_model->branch_export_schedule();

            $file = fopen('php://output','w');
            $header = array("Reference No","Billing Type","Due Date","Status");

            fputcsv($file,$header);

            foreach ($schedule_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    public function gen_ap_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Accounts_Payable_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $ap_reports = $this->Export_csv_model->gen_export_ap_ledger();

            $file = fopen('php://output','w');
            $header = array("Ledger No","Reference No","Payment Voucher","Supplier","Invoice Amount","Due Date","Status","Branch");

            fputcsv($file,$header);

            foreach ($ap_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    public function branch_ap_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Accounts_Payable_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $ap_reports = $this->Export_csv_model->branch_export_ap_ledger();

            $file = fopen('php://output','w');
            $header = array("Ledger No","Reference No","Payment Voucher","Supplier","Invoice Amount","Due Date","Status");

            fputcsv($file,$header);

            foreach ($ap_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }

    public function gen_pa_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Paid_Accounts_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $pa_reports = $this->Export_csv_model->gen_export_pa_ledger();

            $file = fopen('php://output','w');
            $header = array("Paid Accounts No","Payment Voucher No","Supplier","Paid Amount","Receipt No","Posting Date","Branch");

            fputcsv($file,$header);

            foreach ($pa_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }
    public function branch_pa_export(){

        if ($this->input->post('btn_export')) {
       
            $file_name = 'Paid_Accounts_Report_on_'.date('Y-m-d').'.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Type: application/csv;");

            $pa_reports = $this->Export_csv_model->branch_export_pa_ledger();

            $file = fopen('php://output','w');
            $header = array("Paid Accounts No","Payment Voucher No","Supplier","Paid Amount","Receipt No","Posting Date");

            fputcsv($file,$header);

            foreach ($pa_reports->result_array() as $key => $value) {
              fputcsv($file,$value);
            }
                fclose($file);
                exit;

        }else{
           
        }
    }
}