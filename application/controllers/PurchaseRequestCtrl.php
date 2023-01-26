<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Twilio\Rest\Client;

class PurchaseRequestCtrl extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Manager_model');
		$is_logged_in = $this->Manager_model->is_user_logged_in();
		date_default_timezone_set('Asia/Manila');
		if (!$is_logged_in) {
			redirect('Accounts/login');
		}
		$this->load->model('PR_Model');
		$this->load->model('BranchModel');
		$this->load->model('Finance_model');
		$this->load->helper('cookie');
		date_default_timezone_set('Asia/Manila');
	}

	public function view($id)
	{
		$this->unread($id);
		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] = $this->PR_Model->branch_count_notif();
		$data['title'] = "View Purchase Request | iDrive Tutorial";
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['view'] = $this->PR_Model->view_all_PR($id);
		$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
		$this->load->view('templates/header', $data);
		$this->load->view('branch_temp/navbar', $notif);
		$this->load->view('Purchase_Request/branch_view_pr', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}

/*-------------Branch View SR-------------*/ 

public function view_sr($id)
{
	$this->unread($id);
	$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
	$notif['count'] = $this->PR_Model->branch_count_notif();
	$data['title'] = "View Purchase Request | iDrive Tutorial";
	$data['code'] = $this->PR_Model->code($id);
	$data['select'] = $this->PR_Model->select_one($id);
	$data['view_sr'] = $this->PR_Model->view_all_SR($id);
	$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
	$this->load->view('templates/header', $data);
	$this->load->view('branch_temp/navbar', $notif);
	$this->load->view('Purchase_Request/branch_view_sr', $data);
	$this->load->view('templates/footer');
	$this->load->view('Purchase_Request/purchase_script');
}


public function gen_view_sr($id)
{
	$this->unread($id);
	$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
	$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
	$gen_notif['count'] = $this->PR_Model->count_notif();
	$data['title'] = "View Purchase Request | iDrive Tutorial";
	$data['code'] = $this->PR_Model->code($id);
	$data['select'] = $this->PR_Model->select_one($id);
	$data['view_sr'] = $this->PR_Model->view_all_SR($id);
	$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
	$this->load->view('templates/header', $data);
	$this->load->view('templates/navbar', $gen_notif);
	$this->load->view('Purchase_Request/gen_view_sr', $data);
	$this->load->view('templates/footer');
	$this->load->view('Purchase_Request/purchase_script');
}

	public function unread($id)
	{

		$response = $this->PR_Model->unread($id);
	}
	
	public function branch_manage_PR()
	{
		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] = $this->PR_Model->branch_count_notif();
		$data['sms_branch'] = $this->PR_Model->sms_branch();
		$data['sms_branch'] = $this->PR_Model->sms_branch();
		$data['title'] = "Manage Purchase Request | iDrive Tutorial";
		$data['manage_manager'] = $this->PR_Model->manage_manager();
		$data['driver_instructor'] = $this->PR_Model->driver_instructor();
		$this->load->view('templates/header', $data);
		$this->load->view('branch_temp/navbar', $notif);
		$this->load->view('Purchase_Request/branch_table_request', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}

	public function branch_create_PR()
	{
		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] = $this->PR_Model->branch_count_notif();
		$this->insert2();

		$title['title'] = "Create Purchase Request | iDrive Tutorial";

		$data['sms'] = $this->PR_Model->get_user();
		$data['sms_branch'] = $this->PR_Model->sms_branch();
		// $data['sms_status'] = $this->PR_Model->sms_status();

		$data['gasoline_supplier'] = $this->PR_Model->gasoline_supplier();
		$data['repair_supplier'] = $this->PR_Model->repair_supplier();
		$data['carlist'] = $this->PR_Model->getcarlist();
		$data['display_code'] = $this->PR_Model->auto_number_PR();
		$this->load->view('templates/header', $title);
		$this->load->view('branch_temp/navbar', $notif);
		$this->load->view('Purchase_Request/branch_create_PR', $data);
		$this->load->view('templates/footer');
		$this->load->view('templates/script');
	}


	public function insert2()
	{

		if ($this->input->post('btn_create_pr')) {

			$response = $this->PR_Model->insert();
			if ($response) {
				//$this->send_sms();
				$this->session->set_flashdata('create_user_success', 'Successfully Created!');
			} else {
				$this->session->set_flashdata('create_user_error', 'Created Failed');
			}

			redirect('PurchaseRequestCtrl/branch_create_PR');
		}
	}

	public function update_branch_pr($id)
	{
		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] = $this->PR_Model->branch_count_notif();
		$this->update_submit_pr($id);
		$data['carlist'] = $this->PR_Model->getcarlist();
		$title['title'] = "Update Request | iDrive Tutorial";
		$data['gasoline_supplier'] = $this->PR_Model->gasoline_supplier();
		$data['repair_supplier'] = $this->PR_Model->repair_supplier();
		$data['view'] = $this->PR_Model->view_all_PR($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['code'] = $this->PR_Model->code($id);
		$this->load->view('templates/header', $title);
		$this->load->view('branch_temp/navbar', $notif);
		$this->load->view('Purchase_Request/branch_update_PR', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}

	public function update_submit_pr($id)
	{

		if ($this->input->post('update_pr')) {

			$response = $this->PR_Model->update_PR();

			if ($response) {

				$this->session->set_flashdata('create_user_success', 'Successfully Updated!');
			} else {
				$this->session->set_flashdata('create_user_error', 'Create Failed');
			}
			redirect('PurchaseRequestCtrl/update_branch_pr/' . $id);
		}
	}


	public function tab(){
		$this->gen_insert2();

		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();

		$gen_notif['count'] = $this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$title['title'] = "Create Purchase Request | iDrive Tutorial";
		$data['carlist'] = $this->PR_Model->getcarlist();
		$data['gasoline_supplier'] = $this->PR_Model->gasoline_supplier();
		$data['repair_supplier'] = $this->PR_Model->repair_supplier();
		$data['display_code'] = $this->PR_Model->auto_number_PR();
		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar', $gen_notif);
		$this->load->view('Purchase_Request/tab',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/script');
	}
	public function  get_plate_list()
	{
		$this->gen_insert2();
		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();

		$gen_notif['count'] = $this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$title['title'] = "Create Purchase Request | iDrive Tutorial";
		$data['carlist'] = $this->PR_Model->plate_filterer(array_map('intval', explode(',', $_GET["plate_list"])));
		
		$data['display_code'] = $this->PR_Model->auto_number_PR();
		echo json_encode($data);
	}
	
	public function gen_insert2()
	{

		if ($this->input->post('btn_create_pr')) {

			$response = $this->PR_Model->insert();
			if ($response) {

				$this->session->set_flashdata('create_user_success', 'Successfully Created!');
			} else {
				$this->session->set_flashdata('create_user_error', 'Created Failed');
			}

			redirect('PurchaseRequestCtrl/tab');
		}
	}

	
	public function gen_manage_PR()
	{
		$gen_notif['count'] = $this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$title['title'] = "Manage Purchase Request | iDrive Tutorial";
		$data['manage_branch'] = $this->PR_Model->manage_branch();
		$data['manage_other_branch_request'] = $this->PR_Model->manage_other_branch_request();
		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar', $gen_notif);
		$this->load->view('Purchase_Request/table_po_request', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}

	public function gen_view($id)
	{
		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
		$gen_notif['count'] = $this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$title['title'] = "View Purchase Request | iDrive Tutorial";
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['view'] = $this->PR_Model->view_all_PR($id);
		$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar', $gen_notif);
		$this->load->view('Purchase_Request/View_Purchase_Request', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}


/*TRANSACTION HISTORY*/ 


public function transaction_history($id)
	{
	
		
		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
		$gen_notif['count'] = $this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$title['title'] = "View Purchase Request | iDrive Tutorial";
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['view'] = $this->PR_Model->view_all_PR($id);
		
		$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar', $gen_notif);
		$this->load->view('Purchase_Request/view_transaction', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}

	public function transaction_history_sr($id)
	{
		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
		$gen_notif['count'] = $this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$title['title'] = "View Purchase Request | iDrive Tutorial";
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['view_sr'] = $this->PR_Model->view_all_SR($id);
		$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar', $gen_notif);
		$this->load->view('Purchase_Request/view_transaction_sr', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}

	public function Branch_Request_PR($id)
	{
		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
		$gen_notif['count'] = $this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$title['title'] = "View Purchase Request | iDrive Tutorial";
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['view'] = $this->PR_Model->view_all_PR($id);
		$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar', $gen_notif);
		$this->load->view('Purchase_Request/gen_view_pr', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}

	
	public function Branch_Request_SR($id)
	{
		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
		$gen_notif['count'] = $this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$title['title'] = "View Purchase Request | iDrive Tutorial";
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['view_sr'] = $this->PR_Model->view_all_SR($id);
		$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar', $gen_notif);
		$this->load->view('Purchase_Request/gen_view_sr', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}


	public function gen_update($id)
	{
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$gen_notif['count'] = $this->PR_Model->count_notif();
		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
		$this->gen_submit_pr($id);
		$data['carlist'] = $this->PR_Model->getcarlist();
		$title['title'] = "Update Purchase Request | iDrive Tutorial";
		$data['gasoline_supplier'] = $this->PR_Model->gasoline_supplier();
		$data['repair_supplier'] = $this->PR_Model->repair_supplier();
		$data['view'] = $this->PR_Model->view_all_PR($id);
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar', $gen_notif);
		$this->load->view('Purchase_Request/gen_update_PR', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}



	public function gen_submit_pr($id)
	{

		if ($this->input->post('update_pr')) {


			$response = $this->PR_Model->update_PR();

			if ($response) {

				$this->session->set_flashdata('create_user_success', 'Successfully Updated!');
			} else {
				$this->session->set_flashdata('create_user_error', 'Update Failed');
			}
			redirect('PurchaseRequestCtrl/gen_update/' . $id);
		}
	}

	/*--Update Service Request---*/ 

	
	public function gen_update_sr($id)
	{
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$gen_notif['count'] = $this->PR_Model->count_notif();
		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
		$this->gen_submit_sr($id);
		$data['carlist'] = $this->PR_Model->getcarlist();
		$title['title'] = "Update Purchase Request | iDrive Tutorial";
		$data['gasoline_supplier'] = $this->PR_Model->gasoline_supplier();
		$data['repair_supplier'] = $this->PR_Model->repair_supplier();
		$data['view_sr'] = $this->PR_Model->view_all_SR($id);
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar', $gen_notif);
		$this->load->view('Purchase_Request/gen_update_sr', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}
	public function gen_submit_sr($id)
	{

		if ($this->input->post('update_pr')) {


			$response = $this->PR_Model->update_SR();

			if ($response) {

				$this->session->set_flashdata('create_user_success', 'Successfully Updated!');
			} else {
				$this->session->set_flashdata('create_user_error', 'Update Failed');
			}
			redirect('PurchaseRequestCtrl/gen_update_sr/' . $id);
		}
	}

	public function manage_request()
	{
		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();

		$gen_notif['count'] = $this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$title['title'] = "Update Purchase Request | iDrive Tutorial";
		$data['request'] = $this->PR_Model->request();
		$data['request_history'] = $this->PR_Model->request_history();
		

		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar', $gen_notif);
		$this->load->view('Purchase_Request/table_manage_request', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}

	public function approve_request($id)
	
	{

		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$data['sms'] = $this->PR_Model->sms_contact_user($id);
		$data['sms_branch'] = $this->PR_Model->sms_branch();
		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
		$this->submit_approve();
		$gen_notif['count'] = $this->PR_Model->count_notif();
		$title['title'] = "Approve Purchase Request | iDrive Tutorial";
		$data['code'] = $this->PR_Model->code($id);
		$data['branch_sms'] = $this->PR_Model->branch_sms($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['select2'] = $this->PR_Model->select_one2($id);
		$data['view'] = $this->PR_Model->view_all_PR($id);
		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar', $gen_notif);
		$this->load->view('Purchase_Request/approve_request', $data);
		$this->load->view('templates/footer');
		$this->load->view('templates/script');
	}

	public function approve_request_sr($id)
	{

		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$data['sms'] = $this->PR_Model->sms_contact_user($id);
		$data['sms_branch'] = $this->PR_Model->sms_branch();
		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();
		$this->submit_approve();
		$gen_notif['count'] = $this->PR_Model->count_notif();
		$title['title'] = "Approve Purchase Request | iDrive Tutorial";
		$data['code'] = $this->PR_Model->code($id);
		$data['branch_sms'] = $this->PR_Model->branch_sms($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['select2'] = $this->PR_Model->select_one2($id);
		$data['view_sr'] = $this->PR_Model->view_all_SR($id);
		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar', $gen_notif);
		$this->load->view('Purchase_Request/approve_request_SR', $data);
		$this->load->view('templates/footer');
		$this->load->view('templates/script');
	}

	public function submit_approve()
	{
		$check_box = $this->input->post('checkbox');

		if ($this->input->post('btn_save')) {

			if (!empty($check_box)) {

				$check_approved = $check_box;
				$check_id = array();
				foreach ($check_approved as $row) {
				array_push($check_id, $row);
				}
				
			    $this->PR_Model->check_approved($check_id);
				
				$response = $this->PR_Model->approve_request();

				if ($response) {
				//$this->send_sms1();
					$this->session->set_flashdata('create_user_success', 'Successfully Posted');
				} else {
					$this->session->set_flashdata('create_user_error', 'Posted Failed!');
				}
				redirect('PurchaseRequestCtrl/manage_request');

			}else{

				$response = $this->PR_Model->approve_request();

				if ($response) {
				//$this->send_sms1();
					$this->session->set_flashdata('create_user_success', 'Successfully Posted');
				} else {
					$this->session->set_flashdata('create_user_error', 'Posted Failed!');
				}
				redirect('PurchaseRequestCtrl/manage_request');
				
			}
			

		
		}
	}

	
	
	public function send_sms1(){
		$status =$this->input->post('status');
		$txt_username =$this->input->post('txt_username');
		$message =$this->input->post('message');
		if ($status == "approved") {
		try {
		$ch = curl_init();
		//$message = $this->input->post('message');  #Message Content base on input
		$contact = $this->input->post('contact');
		$parameters = array(
			'apikey' =>'495b8ee36bed3ad1517df986861e5f0d', //Your API KEY
			'number' => $contact,
			'message' =>'iDrive Driving Tutorial Koronadal, approved '.$message.' '.$txt_username,
			'sendername' => 'SEMAPHORE'
		);
		curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		
		
		//Send the parameters set above with the request
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
		
		// Receive response from server
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		echo '<script>alert(SMS has been sent!)</script>';
		$output = curl_exec( $ch );
		curl_close ($ch);
		}  catch (Exception $ex) {
			//echo 'SMS failed due to ' . $ex->getMessage(); #Change to Notification instead of message
			echo '<script>alert(SMS failed to send please try again!)</script>';
		}

	}else{

	try {
		$ch = curl_init();
		//$message = $this->input->post('message');  #Message Content base on input
		$contact = $this->input->post('contact');
		$parameters = array(
			'apikey' =>'495b8ee36bed3ad1517df986861e5f0d', //Your API KEY
			'number' => $contact,
			'message' =>'iDrive Driving Tutorial Koronadal, disapproved '.$message.' '.$txt_username,
			'sendername' => 'SEMAPHORE'
		);
		curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		
		
		//Send the parameters set above with the request
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
		
		// Receive response from server
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		echo '<script>alert(SMS has been sent!)</script>';
		$output = curl_exec( $ch );
		curl_close ($ch);
		}  catch (Exception $ex) {
			//echo 'SMS failed due to ' . $ex->getMessage(); #Change to Notification instead of message
			echo '<script>alert(SMS failed to send please try again!)</script>';
		}



	}


	}

	public function delete_branch_pr($id)
	{

		$response = $this->PR_Model->delete_branch_pr($id);

		if ($response) {
			$this->session->set_flashdata('create_user_success', 'Successfully Deleted!'); //display message

		} else {
			$this->session->set_flashdata('create_user_error', ' Delete Failed!'); //display message			
		}

		redirect('PurchaseRequestCtrl/branch_manage_pr/');
	}


	public function delete_gen_view($id)
	{

		$response = $this->PR_Model->delete_branch_pr($id);

		if ($response) {
			$this->session->set_flashdata('create_user_success', 'Successfully Deleted!'); //display message

		} else {
			$this->session->set_flashdata('create_user_error', ' Delete Failed!'); //display message			
		}

		redirect('PurchaseRequestCtrl/gen_manage_PR');
	}

	public function manager_delete_gen_view($id)
	{

		$response = $this->PR_Model->delete_branch_pr($id);

		if ($response) {
			$this->session->set_flashdata('create_user_success', 'Successfully Deleted!'); //display message

		} else {
			$this->session->set_flashdata('create_user_error', ' Delete Failed!'); //display message			
		}

		redirect('PurchaseRequestCtrl/branch_manage_PR');
	}

	public function driver_delete($id)
	{

		$response = $this->PR_Model->delete_branch_pr($id);

		if ($response) {
			$this->session->set_flashdata('create_user_success', 'Successfully Deleted!'); //display message

		} else {
			$this->session->set_flashdata('create_user_error', ' Delete Failed!'); //display message			
		}

		redirect('PurchaseRequestCtrl/driver_manage_pr');
	}
	/*SMS */


	/*--------------------SERVICE REQUEST-------------------------------*/
	public function branch_create_SR()
	{
		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] = $this->PR_Model->branch_count_notif();
		$this->insert_SR();

		$title['title'] = "Create Purchase Request | iDrive Tutorial";

		$data['sms'] = $this->PR_Model->get_user();
		$data['sms_branch'] = $this->PR_Model->sms_branch();
		$data['repair_supplier'] = $this->PR_Model->repair_supplier();

		$data['carlist'] = $this->PR_Model->getcarlist();
		$data['display_code'] = $this->PR_Model->auto_number_PR();
		$this->load->view('templates/header', $title);
		$this->load->view('branch_temp/navbar', $notif);
		$this->load->view('Purchase_Request/branch_create_PR', $data);
		$this->load->view('templates/footer');
		$this->load->view('templates/script');
	}

	public function insert_SR()
	{

		if ($this->input->post('btn_create_pr')) {

			$response = $this->PR_Model->service_request_insert();
			if ($response) {
				//$this->send_sms();
				$this->session->set_flashdata('create_user_success', 'Successfully Created!');
			} else {
				$this->session->set_flashdata('create_user_error', 'Created Failed');
			}

			redirect('PurchaseRequestCtrl/branch_create_PR');
		}
	}

	/*----------UPDATE SERVICE REQUEST--------------------*/

	public function update_branch_SR($id)
	{
		
		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] = $this->PR_Model->branch_count_notif();
		$this->update_submit_sr($id);
		$data['carlist'] = $this->PR_Model->getcarlist();
		$title['title'] = "Update Request | iDrive Tutorial";
		$data['gasoline_supplier'] = $this->PR_Model->gasoline_supplier();
		$data['repair_supplier'] = $this->PR_Model->repair_supplier();
		$data['view_sr'] = $this->PR_Model->view_all_SR($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['code'] = $this->PR_Model->code($id);
		$this->load->view('templates/header', $title);
		$this->load->view('branch_temp/navbar', $notif);
		$this->load->view('Purchase_Request/branch_update_SR', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}


	public function update_submit_sr($id)
	{

		if ($this->input->post('update_pr')) {

			$response = $this->PR_Model->update_SR();

			if ($response) {

				$this->session->set_flashdata('create_user_success', 'Successfully Updated!');
			} else {
				$this->session->set_flashdata('create_user_error', 'Create Failed');
			}
			redirect('PurchaseRequestCtrl/update_branch_SR/'.$id);
		}
	}

	/*--------CREATE SERVICE REQUEST FOR GENERAL MANAGER-----------------------*/

	public function gen_create_SR()
	{
		$gen_notif['notif_voucher'] = $this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] = $this->Finance_model->manage_voucher_notif();

		$gen_notif['count'] = $this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$this->gen_insert_SR();

		$title['title'] = "Create Purchase Request | iDrive Tutorial";
		$data['sms'] = $this->PR_Model->get_user();
		$data['sms_branch'] = $this->PR_Model->sms_branch();
		$data['repair_supplier'] = $this->PR_Model->repair_supplier();
		$data['carlist'] = $this->PR_Model->getcarlist();
		$data['display_code'] = $this->PR_Model->auto_number_PR();
		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar', $gen_notif);
		$this->load->view('Purchase_Request/gen_create_SR', $data);
		$this->load->view('templates/footer');
		$this->load->view('templates/sr_script');
	}

	public function gen_insert_SR()
	{

		if ($this->input->post('btn_create_pr')) {

			$response = $this->PR_Model->service_request_insert();
			if ($response) {
				//$this->send_sms();
				$this->session->set_flashdata('create_user_success', 'Successfully Created!');
			} else {
				$this->session->set_flashdata('create_user_error', 'Created Failed');
			}

			redirect('PurchaseRequestCtrl/tab');
		}
	}

	
	public function send_sms(){
		try {
		$ch = curl_init();
		$message = $this->input->post('message');  #Message Content base on input
		$contact = $this->input->post('contact');
		$parameters = array(
			'apikey' =>'495b8ee36bed3ad1517df986861e5f0d', //Your API KEY
			'number' =>$contact,
			'message' =>$message,
			'sendername' => 'SEMAPHORE'
		);
		curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		
		
		//Send the parameters set above with the request
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
		
		// Receive response from server
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		echo '<script>alert(SMS has been sent!)</script>';
		$output = curl_exec( $ch );
		curl_close ($ch);
		}  catch (Exception $ex) {
			//echo 'SMS failed due to ' . $ex->getMessage(); #Change to Notification instead of message
			echo '<script>alert(SMS failed to send please try again!)</script>';
		}
		
	}

	/*-----------Driver Instructor Module----------------*/ 

	public function driver_purchase_request()
	{
		$driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
		$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();
		//$data['sms'] = $this->PR_Model->sms_contact_user();
		$data['sms_branch'] = $this->PR_Model->sms_branch();
		$title['title'] = "Manage Purchase Request | iDrive Tutorial";
		$data['display_code'] = $this->PR_Model->auto_number_PR();
		$data['gasoline_supplier'] = $this->PR_Model->gasoline_supplier();
		$data['repair_supplier'] = $this->PR_Model->repair_supplier();
		$data['carlist'] = $this->PR_Model->getcarlist();
		//$data['manage_branch'] = $this->PR_Model->manage_branch();
		$this->driver_insert_pr();
		$this->load->view('templates/header', $title);
		$this->load->view('Driver_Instructor/driver_nav', $driver_notif);
		$this->load->view('Driver_Instructor/driver_purchase_request',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/script');
	
	}

	public function driver_insert_pr()
	{

		if ($this->input->post('btn_create_pr')) {

			$response = $this->PR_Model->insert();
			if ($response) {
				//$this->send_sms();
				$this->session->set_flashdata('create_user_success', 'Successfully Created!');
			} else {
				$this->session->set_flashdata('create_user_error', 'Created Failed');
			}

			redirect('PurchaseRequestCtrl/driver_purchase_request');
		}
	}

	/*-------Driver Create Service----------*/ 

	public function driver_purchase_request_sr()
	{
		$driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
		$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();
		$data['sms_branch'] = $this->PR_Model->sms_branch();
		$title['title'] = "Manage Purchase Request | iDrive Tutorial";
		$data['display_code'] = $this->PR_Model->auto_number_PR();
		$data['gasoline_supplier'] = $this->PR_Model->gasoline_supplier();
		$data['repair_supplier'] = $this->PR_Model->repair_supplier();
		$data['carlist'] = $this->PR_Model->getcarlist();
		$this->driver_insert_sr();
		$this->load->view('templates/header', $title);
		$this->load->view('Driver_Instructor/driver_nav', $driver_notif);
		$this->load->view('Driver_Instructor/driver_purchase_request',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/script');

	}

	public function driver_insert_sr()
	{

		if ($this->input->post('btn_create_pr')) {

			$response = $this->PR_Model->service_request_insert();
			if ($response) {
				//$this->send_sms();
				$this->session->set_flashdata('create_user_success', 'Successfully Created!');
			} else {
				$this->session->set_flashdata('create_user_error', 'Created Failed');
			}

			redirect('PurchaseRequestCtrl/driver_purchase_request');
		}
	}


	public function driver_manage_pr()
	{
		$driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
		$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();
		$title['title'] = "Manage Purchase Request | iDrive Tutorial";
		$data['manage_driver_request'] = $this->PR_Model->manage_driver_request();
		$this->load->view('templates/header', $title);
		$this->load->view('Driver_Instructor/driver_nav', $driver_notif);
		$this->load->view('Driver_Instructor/driver_manage_pr',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/script');
	
	}


	public function driver_view_pr($id)
	{
		
		
		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] = $this->PR_Model->branch_count_notif();
		$title['title'] = "View Purchase Request | iDrive Tutorial";
		$data['sms_branch'] = $this->PR_Model->sms_branch();
		$data['sms'] = $this->PR_Model->get_user();
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['view'] = $this->PR_Model->view_all_PR($id);
		$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
		$this->load->view('templates/header', $title);
		$this->load->view('branch_temp/navbar', $notif);
		$this->load->view('driver_instructor/driver_view_pr', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}

	public function driver_view_sr($id)
	{
		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] = $this->PR_Model->branch_count_notif();
		$title['title'] = "View Purchase Request | iDrive Tutorial";
		$data['sms_branch'] = $this->PR_Model->sms_branch();
		$data['sms'] = $this->PR_Model->get_user();
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['view_sr'] = $this->PR_Model->view_all_SR($id);
		$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
		$this->load->view('templates/header', $title);
		$this->load->view('branch_temp/navbar', $notif);
		$this->load->view('driver_instructor/driver_view_sr', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}


	public function driver_instructor_view($id)
	{
		$this->driver_unread($id);
		$driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
		$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();
		$title['title'] = "View Purchase Request | iDrive Tutorial";
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['view'] = $this->PR_Model->view_all_PR($id);
		$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
		$this->load->view('templates/header', $title);
		$this->load->view('driver_instructor/driver_nav',$driver_notif);
		$this->load->view('driver_instructor/driver_instructor_view', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}


	public function driver_instructor_view_sr($id)
	{
		$this->driver_unread($id);
		$driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
		$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();
		$title['title'] = "View Purchase Request | iDrive Tutorial";
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['view_sr'] = $this->PR_Model->view_all_SR($id);
		$this->load->view('templates/header', $title);
		$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
		$this->load->view('driver_instructor/driver_nav',$driver_notif);
		$this->load->view('driver_instructor/driver_instructor_view_sr', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}
	public function forwarded($id){

		if ($this->input->post('btn_forwarded')) {
		//$this->send_sms();
		$response = $this->PR_Model->isforwarded($id);
	if ($response) 
		{
			$this->session->set_flashdata('create_user_success','Successfully forwarded!');
						
		}
		else
		{
		$this->session->set_flashdata('create_user_error',' Update Failed!');//display message
						
		}

	redirect('PurchaseRequestCtrl/branch_manage_pr');
		}


	}

	public function forwarded_to_driver($id)
	{
		$this->forwarded_to($id);
		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] = $this->PR_Model->branch_count_notif();
		$title['title'] = "View Purchase Request | iDrive Tutorial";
		$data['sms_branch'] = $this->PR_Model->sms_branch();
		$data['sms'] = $this->PR_Model->get_user();
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['view'] = $this->PR_Model->view_all_PR($id);
		$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
		$this->load->view('templates/header', $title);
		$this->load->view('branch_temp/navbar', $notif);
		$this->load->view('driver_instructor/forwarded_to_driver', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}

	public function forwarded_to_driver_sr($id)
	{
		$this->forwarded_to($id);
		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] = $this->PR_Model->branch_count_notif();
		$title['title'] = "View Purchase Request | iDrive Tutorial";
		$data['sms_branch'] = $this->PR_Model->sms_branch();
		$data['sms'] = $this->PR_Model->get_user();
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$data['view_sr'] = $this->PR_Model->view_all_SR($id);
		$data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
		$this->load->view('templates/header', $title);
		$this->load->view('branch_temp/navbar', $notif);
		$this->load->view('driver_instructor/forwarded_to_driver_sr', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}

	public function forwarded_to($id){

		if ($this->input->post('btn_forwarded')) {
			//$this->send_sms();
			$response = $this->PR_Model->forwarded($id);

			if ($response) 
		{
			$this->session->set_flashdata('create_user_success','Successfully forwarded!');
						
		}
		else
		{
		$this->session->set_flashdata('create_user_error',' Update Failed!');//display message
						
		}

	redirect('PurchaseRequestCtrl/branch_manage_pr');
		}

	}


	public function driver_update_pr($id)
	{
		$driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
		$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();
		$this->driver_submit_pr($id);
		$data['carlist'] = $this->PR_Model->getcarlist();
		$title['title'] = "Update Purchase Request | iDrive Tutorial";
		$data['gasoline_supplier'] = $this->PR_Model->gasoline_supplier();
		$data['repair_supplier'] = $this->PR_Model->repair_supplier();
		
		$data['view'] = $this->PR_Model->view_all_PR($id);
		$data['code'] = $this->PR_Model->code($id);
		$data['select'] = $this->PR_Model->select_one($id);
		$this->load->view('templates/header', $title);
		$this->load->view('driver_instructor/driver_nav',$driver_notif);
		$this->load->view('driver_instructor/driver_update_pr', $data);
		$this->load->view('templates/footer');
		$this->load->view('Purchase_Request/purchase_script');
	}

	public function driver_submit_pr($id)
	{
		if ($this->input->post('update_pr')) {
			$response = $this->PR_Model->update_PR();

			if ($response) {

				$this->session->set_flashdata('create_user_success', 'Successfully Updated!');
			} else {
				$this->session->set_flashdata('create_user_error', 'Update Failed');
			}
			redirect('PurchaseRequestCtrl/driver_update_pr/'.$id);
		}
	}

/*---------Update Service Request---------------*/ 


public function driver_update_sr($id)
{
	$driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
	$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();
	$this->driver_update_submit_sr($id);
	$data['carlist'] = $this->PR_Model->getcarlist();
	$title['title'] = "Update Purchase Request | iDrive Tutorial";
	$data['gasoline_supplier'] = $this->PR_Model->gasoline_supplier();
	$data['repair_supplier'] = $this->PR_Model->repair_supplier();
	
	$data['view_sr'] = $this->PR_Model->view_all_SR($id);
	$data['code'] = $this->PR_Model->code($id);
	$data['select'] = $this->PR_Model->select_one($id);
	$this->load->view('templates/header', $title);
	$this->load->view('driver_instructor/driver_nav',$driver_notif);
	$this->load->view('driver_instructor/driver_update_sr', $data);
	$this->load->view('templates/footer');
	$this->load->view('Purchase_Request/purchase_script');
}

public function driver_update_submit_sr($id)
	{

		if ($this->input->post('update_pr')) {

			$response = $this->PR_Model->update_SR();

			if ($response) {

				$this->session->set_flashdata('create_user_success', 'Successfully Updated!');
			} else {
				$this->session->set_flashdata('create_user_error', 'Create Failed');
			}
			redirect('PurchaseRequestCtrl/driver_update_sr/'.$id);
		}
	}
	public function driver_unread($id)
	{

		$response = $this->PR_Model->driver_unread($id);
	}
	
}