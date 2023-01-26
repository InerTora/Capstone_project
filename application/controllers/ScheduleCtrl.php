<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ScheduleCtrl extends CI_Controller {


	public function __construct(){

        parent:: __construct();
        $this->load->model('Manager_model');
		$is_logged_in = $this->Manager_model->is_user_logged_in();
		date_default_timezone_set('Asia/Manila');
	if (!$is_logged_in) {
		redirect('Accounts/login');
	}
      
		$this->load->model('PR_Model');
		$this->load->model('Finance_model');
    }

	public function index()
	{
		
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$title['title'] = "Payment Schedule | iDrive Tutorial";

		$data['schedule_table_ledger'] = $this->Finance_model->schedule_table_ledger();
		$this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		
		$this->load->view('Payment_Schedule/table_payment',$data);
        $this->load->view('templates/footer');
		$this->load->view('templates/script');
		$this->load->view('Payment_Schedule/payment_script');
	}

	
//Branch Manager Schedule
	public function branch_payment()
{       $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] =$this->PR_Model->branch_count_notif();
		$data['title'] = "Payment Schedule | iDrive Tutorial";
		$this->load->view('templates/header',$data);
		$this->load->view('branch_temp/navbar',$notif);
		
		$data['schedule_table_ledger'] = $this->Finance_model->schedule_table_ledger();
		$this->load->view('Payment_Schedule/branch_table_payment',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/script');
		$this->load->view('Payment_Schedule/payment_script');
		
	}

}