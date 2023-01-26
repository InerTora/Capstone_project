<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserCtrl extends CI_Controller {
    
    public function __construct(){
        parent:: __construct();
        $this->load->model('Manager_model');
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
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();

		$title['title'] = "User | iDrive Tutorial";
		$data['page'] = $this->UserModel->page();
		$this->load->view('templates/header',$title);
    	$this->load->view('templates/navbar',$gen_notif);
    	$this->load->view('User_Module/gen_user',$data);
    	$this->load->view('templates/footer');
		$this->load->view('templates/script');
		
	
	}

	public function check_validation(){

		$this->form_validation->set_rules('fname', 'First Name', 'required|callback_alpha_character');
		$this->form_validation->set_rules('mname', 'Middle Name', 'required|callback_alpha_character');
		$this->form_validation->set_rules('lname', 'Last Name','required|callback_alpha_character');
		$this->form_validation->set_rules('branch','Branch','required');
		$this->form_validation->set_rules('position','Position','required');
		$this->form_validation->set_rules('username','Username','trim|required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[5]|max_length[15]');
		$this->form_validation->set_rules('contact','Contact Number','trim|required|is_unique[tbl_user.contact_no]|callback_contact');

		// $this->form_validation->set_rules('contact', 'Contact Number', 'trim|required|regex_match[/^(\+63|0)\d{10}$/]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[5]|max_length[50]');
	}

	public function _isUnique(){

		$this->form_validation->set_rules('fname', 'First Name', 'required|callback_alpha_character');
		$this->form_validation->set_rules('mname', 'Middle Name', 'required|callback_alpha_character');
		$this->form_validation->set_rules('lname', 'Last Name','required|callback_alpha_character');
		$this->form_validation->set_rules('branch','Branch','required');
		$this->form_validation->set_rules('position','Position','required');
		$this->form_validation->set_rules('username','Username','trim|required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[5]|max_length[15]');

	}

	
	public function create_user(){
		
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();

		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$data['title'] = "Create User | iDrive Tutorial";
		$this->create();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/navbar',$gen_notif);
		$data1['branch'] = $this->UserModel->getbranch_list();
		
		$this->load->view('User_Module/adduser',$data1);
        $this->load->view('templates/footer');
		$this->load->view('templates/script');
	}

	public function create() {
	
		if ($this->input->post('AddUser')) {

			$this->check_validation();

			if($this->form_validation->run() != FALSE){

			$response = $this->UserModel->add_user();
			if ($response) {
				$this->session->set_flashdata('create_user_success', 'Successfully Created!');
				
			}else{
				$this->session->set_flashdata('create_user_error', 'Create Failed!');
			}
			redirect('UserCtrl/create_user');
			}

		}
			
	}
	
	public function alpha_character($str){
		if (!preg_match("/^([a-zA-Z ])+$/i",$str)) {
			$this->form_validation->set_message('alpha_character','The %s can only contain alphabet/s');
			return false;
		}else{
			return true;
		}
	}
	
	public function contact($str){
		if (!preg_match("/^(\+63|0)\d{10}$/",$str)) {
			$this->form_validation->set_message('contact','Invalid %s format');
			return false;
		}else{
			
			return true;
		}
	}
	public function update_user($id){
		
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		
		$data['title'] = "Update User | iDrive Tutorial";
		$data['branch'] = $this->UserModel->getbranch_list();
		$this->edit_user_submit($id);
		$this->load->view('templates/header',$data);
    	$this->load->view('templates/navbar',$gen_notif);
		$data['edituser'] = $this->UserModel->get_user($id);
		$this->load->view('User_Module/update_user',$data);
    	$this->load->view('templates/footer');
		$this->load->view('templates/script');
	
		
	}

	public function edit_user_submit($id){
	
		$data['edituser'] = $this->UserModel->get_user($id);
		$db_contact = $data['edituser']->contact_no;
		$contact = $this->input->post('contact');
		
		if($this->input->post('updateUser')){

			if ($db_contact == $contact) {
				
				$this->_isUnique();
				if($this->form_validation->run() != FALSE){
			
					$response = $this->UserModel->update_user();//true
					if ($response) 
					{
						$this->session->set_flashdata('create_user_success','Successfully Updated!');
					}
					else
					{
						$this->session->set_flashdata('create_user_error','Update Failed!');//display message
						
					}
					redirect('UserCtrl/update_user/'.$id);
			}

				
			}else{
				
				$this->check_validation();
				if($this->form_validation->run() != FALSE){
			
					$response = $this->UserModel->update_user();//true
					if ($response) 
					{
						$this->session->set_flashdata('create_user_success','Successfully Updated!');
					}
					else
					{
						$this->session->set_flashdata('create_user_error','Update Failed!');//display message
						
					}
					redirect('UserCtrl/update_user/'.$id);
			}

			}

		}
	
    }


	public function profile($id){
		
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();


		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$data['title'] = "profile | iDrive Tutorial";
		$this->update_profile($id);
		$data['branch'] = $this->UserModel->get_branch($id);
		$this->load->view('templates/header',$data);
		$data['edituser'] = $this->UserModel->get_user($id);
        $this->load->view('templates/navbar',$gen_notif);
		
		$this->load->view('User_Module/profile',$data);
        $this->load->view('templates/footer');
		$this->load->view('templates/script');
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
					$this->session->set_flashdata('create_user_error','Creation failed: Only accepts png or jpeg!');//display message
				
				}
				redirect('UserCtrl/profile/'.$id);
		}
		
		}
}

public function Change_Profile($id){
	
	$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();


	$gen_notif['count'] =$this->PR_Model->count_notif();
	$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
	$data['edituser'] = $this->UserModel->get_user($id);
	$this->upload_profile($id);
	$data['title'] = "Change Profile Picture | iDrive Tutorial";
	$data['profile'] = $this->UserModel->get_user($id);
	$this->load->view('templates/header',$data);
	$this->load->view('templates/navbar',$gen_notif);
	$this->load->view('User_Module/change_profile',$data);
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
				$this->session->set_flashdata('create_user_error','Creation failed: Only accepts png or jpeg!');//display message

			}
			else
			{
				$this->session->set_flashdata('create_user_success','Profile Picture Successfully upload!');
				
					$file_name = $this->upload->data('file_name');
					
					$response  = $this->UserModel->update_profile_picture_post($file_name);
					if ($response) 
					{
						$this->session->set_flashdata('success','Successfully Created!');//display message
						
					}
					else
					{
						$this->session->set_flashdata('create_user_error','Creation failed: Only accepts png or jpeg!');//display message
						
					}
			}
			redirect('UserCtrl/change_profile/'.$id);
		}
		
	
}


	public function view_user($id){
		
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();


		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$data['title'] = "User | iDrive Tutorial";
		$this->load->view('templates/header',$data);
        $this->load->view('templates/navbar',$gen_notif);
		$data['view_user'] = $this->UserModel->get_user($id);
		$this->load->view('User_Module/view_user',$data);
        $this->load->view('templates/footer');
	
}

	public function status($id){

		$response = $this->UserModel->getStatus($id);
			if ($response) 
					{
				$this->session->set_flashdata('create_user_success','Successfully Deactivated!');
							
			}
			else
			{
			$this->session->set_flashdata('create_user_error','Deactivate Failed!');		
			}

			redirect('UserCtrl/');
}
public function status_active($id){

	$response = $this->UserModel->getStatus_active($id);
	if ($response) 
		{
			$this->session->set_flashdata('create_user_success','Successfully Reactivated!');//display message
						
		}
		else
		{
		$this->session->set_flashdata('create_user_error',' Reactivate Failed!');//display message
						
		}

	redirect('UserCtrl/');
}

}