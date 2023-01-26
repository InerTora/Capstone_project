<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManagerCtrl extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		
		$this->load->model('Manager_model');
		$this->load->model('Finance_model');
		$is_logged_in = $this->Manager_model->is_user_logged_in();
		
	if (!$is_logged_in) {
		redirect('Accounts/login');
	}
	
	$this->load->model('UserModel');
	$this->load->model('PR_Model');
	$this->load->model('Finance_model');
	}
	public function index()
	{
		$this->load->view('Manager/login');
		
	}
	
    public function dashboard()
	{
		
		$title['title'] = "Dashboard | iDrive Tutorial";
	
		date_default_timezone_set('Asia/Manila');
		$data['today_date'] = date('Y-m-d');
		$gen_notif['count'] =$this->PR_Model->count_notif();
		$data['count_PO'] =$this->PR_Model->count_purchase_order();
		$data['count_PI'] =$this->PR_Model->count_purchase_invoice();
		$data['count_voucher'] =$this->PR_Model->count_purchase_voucher();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
		$data['schedule_table_ledger'] = $this->Finance_model->schedule_table_ledger();
		//$this->send_sms();
		//$this->sms_sched();
		$this->load->view('templates/header',$title);
		$this->load->view('templates/navbar',$gen_notif);
		$this->load->view('Manager/dashboard',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/Graph_script');

}
public function branch_dashboard(){
	
		date_default_timezone_set('Asia/Manila');
		$data['count_PO'] =$this->PR_Model->count_purchase_order();
		$data['count_PI'] =$this->PR_Model->count_purchase_invoice();
		$data['count_request'] =$this->PR_Model->count_purchase_request();
		$data['count_voucher'] =$this->PR_Model->count_purchase_voucher();
		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		//$this->send_sms();
		//$this->execute_sms();
		//$this->sms_sched();
		$notif['count'] =$this->PR_Model->branch_count_notif();
	
		$data['today_date'] = date('Y-m-d');
	
		$data['schedule_table_ledger'] = $this->Finance_model->schedule_table_ledger();
		$title['title'] = "Dashboard | iDrive Tutorial";
		$this->load->view('branch_temp/branch_header',$title);
		$this->load->view('branch_temp/navbar',$notif);
		$this->load->view('branch_temp/branch_dashboard',$data);
		$this->load->view('branch_temp/branch_footer');
		$this->load->view('templates/Graph_script');
		
		
}

public function execute_sms(){
	$data['schedule_table_ledger'] = $this->Finance_model->schedule_table_ledger();
	$payment = $data['schedule_table_ledger'];

	foreach ($payment as $row) {
		
		$exp_date = $row->isDue_date;
		$today_date = date('Y-m-d');
	   
		$exp = strtotime($exp_date);
		$td = strtotime($today_date);
	   
			$diff = $td-$exp;
			$days = abs(floor($diff / (60*60*24)));

			if ($row->isStatus !="Paid") {
				if ($days == 3) {
					$this->send_sms();
				}
			}
	}

}

public function send_sms(){
	
	$contact_num = $_SESSION['contact_no'];
	$name = $_SESSION['First_Name'].' '. $_SESSION['Last_Name'];
	
	
	$data['schedule_table_ledger'] = $this->Finance_model->schedule_table_ledger();
	$payment = $data['schedule_table_ledger'];

	foreach ($payment as $row) {
		
		$exp_date = $row->isDue_date;
		$today_date = date('Y-m-d');
	   
		$exp = strtotime($exp_date);
		$td = strtotime($today_date);
	   
			$diff = $td-$exp;
			$days = abs(floor($diff / (60*60*24)));

			if ($row->isStatus !="Paid") {
				if ($days == 3) {
					try {
						$ch = curl_init();
						$message = $this->input->post('message');  #Message Content base on input
						$contact = $this->input->post('contact');
						$parameters = array(
							'apikey' =>'495b8ee36bed3ad1517df986861e5f0d', //Your API KEY
							'number' =>$contact_num,
							'message' =>'Good Day '.$name.', '.$row->isReference.' is due at '.$days. ' day/s ',
							'sendername' => 'SEMAPHORE'
						);
						curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
						curl_setopt( $ch, CURLOPT_POST, 1 );
						
						
						//Send the parameters set above with the request
						curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
						
						// Receive response from server
						curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
						$output = curl_exec( $ch );
						echo '<script>alert(SMS has been sent!)</script>';
						curl_close ($ch);
						}  catch (Exception $ex) {
							//echo 'SMS failed due to ' . $ex->getMessage(); #Change to Notification instead of message
							echo '<script>alert(SMS failed to send please try again!)</script>';
						}

				}
			}
	}
}

public function sms_sched(){
	$contact_num = $_SESSION['contact_no'];
	$name = $_SESSION['First_Name'].' '. $_SESSION['Last_Name'];
	$branch_id = ucwords($_SESSION['First_Name']).' '.ucwords($_SESSION['Last_Name']);
	$data['schedule_table_ledger'] = $this->Finance_model->schedule_table_ledger();
	$payment = $data['schedule_table_ledger'];

	foreach ($payment as $row) {
		
		$exp_date = $row->isDue_date;
		$today_date = date('Y-m-d');
	   
		$exp = strtotime($exp_date);
		$td = strtotime($today_date);
	   
			$diff = $td-$exp;
			$days = abs(floor($diff / (60*60*24)));
			
			if ($row->isStatus !="Paid") {
				if ($exp == $td) {
					try {
						$ch = curl_init();
						$message = $this->input->post('message');  #Message Content base on input
						$contact = $this->input->post('contact');
						$parameters = array(
							'apikey' =>'495b8ee36bed3ad1517df986861e5f0d', //Your API KEY
							'number' =>$contact_num,
							'message' =>'Good Day '.$branch_id.', '.$row->isReference. ' is due today, please settle your balance with an amount of '.$row->invoice_amount,
							'sendername' => 'SEMAPHORE'
						);
						curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
						curl_setopt( $ch, CURLOPT_POST, 1 );
						
						
						//Send the parameters set above with the request
						curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
						
						// Receive response from server
						curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
						$output = curl_exec( $ch );
						echo '<script>alert(SMS has been sent!)</script>';
						curl_close ($ch);
						}  catch (Exception $ex) {
							//echo 'SMS failed due to ' . $ex->getMessage(); #Change to Notification instead of message
							echo '<script>alert(SMS failed to send please try again!)</script>';
						}

				}
			}
}
	
	
}
public function branch_profile($id){

		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] =$this->PR_Model->branch_count_notif();
		$data['title'] = "profile | iDrive Tutorial";
		$this->update_profile($id);
		$data['other_branch'] = $this->UserModel->other_branch($id);
		$data['edituser'] = $this->UserModel->get_user($id);
		$this->load->view('templates/header',$data);
		$this->load->view('branch_temp/navbar',$notif);
		$this->load->view('branch_temp/branch_profile',$data);
		$this->load->view('templates/footer');
}



public function update_profile($id){

		if($this->input->post('updateProfile'))
{

		$this->form_validation->set_rules('fname','First Name','trim|required');
		$this->form_validation->set_rules('mname','Middle Name','trim|required');
		$this->form_validation->set_rules('lname','Last Name','trim|required');
		$this->form_validation->set_rules('username','Username','trim|required');


	if($this->form_validation->run() != FALSE)
{

	$response = $this->UserModel->update_profile();//true
		if ($response)
		{
			$this->session->set_flashdata('create_user_success','Successfully Updated!');

}
else
{
$this->session->set_flashdata('create_user_error','Failed Update!');//display message

}
redirect('ManagerCtrl/branch_profile/'.$id);
}

}
}

public function driver_profile($id){

	$driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
	$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();


	$data['title'] = "profile | iDrive Tutorial";
	$this->update_profile($id);
	$data['other_branch'] = $this->UserModel->other_branch($id);
	$data['edituser'] = $this->UserModel->get_user($id);
	$this->load->view('templates/header',$data);
	$this->load->view('driver_instructor/driver_nav',$driver_notif);
	$this->load->view('driver_instructor/driver_profile',$data);
	$this->load->view('templates/footer');
}

public function branch_change_profile($id){
			
	$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] =$this->PR_Model->branch_count_notif();

		$data['edituser'] = $this->UserModel->get_user($id);
		$this->upload_profile($id);
		$data['title'] = "Change Profile Picture | iDrive Tutorial";
		$data['profile'] = $this->UserModel->get_user($id);
		$this->load->view('templates/header',$data);
		$this->load->view('branch_temp/navbar',$notif);
		$this->load->view('branch_temp/branch_change_profile',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/script');

}

public function upload_profile($id){

			if ($this->input->post('upload')) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|png';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('profile_picture'))
			{
			$this->session->set_flashdata('create_user_error', 'Opps Something Wrong!');

			}
			else
			{
			$this->session->set_flashdata('create_user_success','Profile Picture Successfully upload!');

			$file_name = $this->upload->data('file_name');

			$response = $this->UserModel->update_profile_picture_post($file_name);
			if ($response)
			{
			$this->session->set_flashdata('success','Profile picture was successfully inserted.');//display message

			}
			else
			{
			$this->session->set_flashdata('error','Opps Something Wrong');//display message

			}


			}
			redirect('ManagerCtrl/branch_change_profile/'.$id);
			}
}
/*Finance change profile picture*/ 

public function finance_profile($id){

	$this->finance_update_profile($id);
	$fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
	$fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
	$data['title'] = "profile | iDrive Tutorial";
	$data['other_branch'] = $this->UserModel->other_branch();
	$data['edituser'] = $this->UserModel->get_user($id);
	$this->load->view('templates/header',$data);
	$this->load->view('finance_temp/navbar',$fin_notif);
	$this->load->view('finance_temp/finance_profile',$data);
	$this->load->view('templates/footer');
	$this->load->view('templates/script');
}

public function finance_update_profile($id){

	if($this->input->post('updateProfile'))
{

	$this->form_validation->set_rules('fname','First Name','trim|required');
	$this->form_validation->set_rules('mname','Middle Name','trim|required');
	$this->form_validation->set_rules('lname','Last Name','trim|required');
	$this->form_validation->set_rules('username','Username','trim|required');


if($this->form_validation->run() != FALSE)
{

$response = $this->UserModel->update_profile();//true
	if ($response)
	{
		$this->session->set_flashdata('create_user_success','Successfully Updated!');

}
else
{
$this->session->set_flashdata('create_user_error','Failed Update!');//display message

}
redirect('ManagerCtrl/finance_profile/'.$id);
}

}
}

public function finance_change_profile($id){
			
	$fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
	$fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();

		$data['edituser'] = $this->UserModel->get_user($id);
		$this->finance_upload_profile($id);
		$data['title'] = "Change Profile Picture | iDrive Tutorial";
		$data['profile'] = $this->UserModel->get_user($id);
		$this->load->view('templates/header',$data);
		$this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('finance_temp/finance_change_profile',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/script');

}

public function finance_upload_profile($id){

	if ($this->input->post('upload')) {
	$config['upload_path'] = './uploads/';
	$config['allowed_types'] = 'jpg|png';

	$this->load->library('upload', $config);

	if ( ! $this->upload->do_upload('profile_picture'))
	{
	$this->session->set_flashdata('create_user_error', 'Opps Something Wrong!');

	}
	else
	{
	$this->session->set_flashdata('create_user_success','Profile Picture Successfully upload!');

	$file_name = $this->upload->data('file_name');

	$response = $this->UserModel->update_profile_picture_post($file_name);
	if ($response)
	{
	$this->session->set_flashdata('success','Profile picture was successfully inserted.');//display message

	}
	else
	{
	$this->session->set_flashdata('error','Opps Something Wrong');//display message

	}


	}
	redirect('ManagerCtrl/finance_change_profile/'.$id);
	}


}
public function gen_notif(){
		$title['title'] = "Notification Purchase Request | iDrive Tutorial";
		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$this->load->view('templates/header',$title);
		$this->load->view('templates/navbar',$notif);
		//$this->load->view('branch_temp/branch_notification',$data);
		$this->load->view('templates/footer');
}



public function branch_ledger()
{
		$this->load->view('templates/header');
		$this->load->view('branch_temp/navbar');
		$this->load->view('branch_temp/branch_ledger');
		$this->load->view('templates/footer');
}

public function branch_Reports_supplier()
{
$this->load->view('templates/header');
$this->load->view('branch_temp/navbar');
$this->load->view('branch_temp/branch_reports_supplier');
$this->load->view('templates/footer');
}

public function branch_Reports_PO()
{
$this->load->view('templates/header');
$this->load->view('branch_temp/navbar');
$this->load->view('branch_temp/branch_reports_PO');
$this->load->view('templates/footer');
}

}