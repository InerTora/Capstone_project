<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Mailjet\Resources;

class Accounts extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('Manager_model');
	}
	public function index()
	{
        $this->load->view('Manager/login');
	}
    public function login()
	{
		$this->_login_submit();
		$this->load->view('Manager/login');
	}

	public function _login_submit()
	{
		if ($this->input->post('submit')) 
		{
			$txtusername = $this->form_validation->set_rules('txtpassword','Password','trim|required');
			$txtusername = $this->form_validation->set_rules('txtusername','Username','trim|required');
		

		if ($txtusername) {
			$this->session->set_flashdata('error','Fill all the required field');	
		}

			if ($this->form_validation->run() != FALSE)
			
			{
			
				$response = $this->Manager_model->verify_login();

				if($response)
			{
						if (isset($_SESSION['Position']) && ($_SESSION['Position'] == 'Manager')) {
							
							redirect('ManagerCtrl/branch_dashboard');
						}elseif(isset($_SESSION['Position']) && ($_SESSION['Position'] == 'General Manager')){
							
							redirect('ManagerCtrl/dashboard');	

						}elseif(isset($_SESSION['Position']) && ($_SESSION['Position'] == 'Driving Instructor')){
							redirect('PurchaseRequestCtrl/driver_purchase_request');

						}else{
						
							redirect('FinanceCtrl/finance_dashboard');
						}
				}
				else
				{
					$this->session->set_flashdata('error','Incorrect Username or Password');
					
				}
				redirect('Accounts/login');
			}
		}
	}

	public function logout(){
		$this->load->model('Manager_model');
		$this->Manager_model->logout();
		redirect('Accounts/login');
	}

	
public function forgotpassword(){
	$this->submit_password();
	$this->load->view('Manager/forgotpass');
}

public function submit_password(){
	
	if ($this->input->post('btnsubmit')) {
		$this->form_validation->set_rules('txtemail', 'Email', 'trim|required');
		if($this->form_validation->run() != FALSE){

			$response = $this->Manager_model->check_email();
			if ($response) 
		{
			$this->sendmail();
			
			$this->session->set_flashdata('success','OTP has been sent, Please see the email in your inbox make sure to check your SPAM/PROMOTION folder');
			redirect('accounts/otpview/'.$response->User_ID);
			
		}
		else
		{
			$this->session->set_flashdata('error','Email does not exist!');
						
		}
			
		}
		
	}
}
	
public function otpview($id){
	$this->submit_reset($id);
	$data['reset'] = $this->Manager_model->match_otp($id);
	$this->load->view('Manager/otpview',$data);
}

public function submit_reset($id){
	$reset = $this->input->post('txtreset');
	if ($this->input->post('btn_reset')) {
		$this->form_validation->set_rules('txtreset', 'OTP', 'trim|required');
		if($this->form_validation->run() != FALSE){

			$response = $this->Manager_model->match_otp($id);
			if ($response) 
		{
			if ($response->OTP == $reset) {
				
			redirect('accounts/changepass/'.$response->User_ID);
			
			}else{
				$this->session->set_flashdata('error','Verification code does not match!');
				
			}
		}
		else
		{
			$this->session->set_flashdata('error','Email does not exist!');
						
		}
		
		}
		
	}
}

public function changepass($id){
	$this->submit_pwd();
	$data['reset'] = $this->Manager_model->match_otp($id);
	$this->load->view('Manager/change_Pass_view',$data);
}
public function submit_pwd(){

	if ($this->input->post('btn_pass')) {
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]');

		if($this->form_validation->run() != FALSE){

			$response = $this->Manager_model->update_user();

			if ($response) {

				$this->session->set_flashdata('success','Password successfully changed!');
			}

			redirect('accounts/');
		}


	}else{
		
	}
}
public function sendmail(){
	$response = $this->Manager_model->check_email();
	$reciever = $this->input->post('txtemail');
	$mj = new \Mailjet\Client('d891311012ef78b36869484cba0d70ca','f87ee5f7873a118f9b351643ea6f33ca',true,['version' => 'v3.1']);
	$body = [
	  'Messages' => [
		[
		  'From' => [
			'Email' => "idrivedrivingtutorialkoronadal@gmail.com",
			'Name' => "iDrive Driving Tutorial"
		  ],
		  'To' => [
			[
			  'Email' => $reciever,
			  'Name' => ""
			]
		  ],
		  'Subject' => "Forgot Password OTP",
		  'TextPart' => "",
		  'HTMLPart' => "OTP Verification Code - ".$response->OTP,
		  'CustomID' => ""
		]
	  ]
	];
	$response = $mj->post(Resources::$Email, ['body' => $body]);
	$response->success() && ($response->getData());
}
}	
	