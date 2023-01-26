<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BranchCtrl extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->model('Manager_model');
		$is_logged_in = $this->Manager_model->is_user_logged_in();
		
	if (!$is_logged_in) {
		redirect('Accounts/login');
	}
        $this->load->model('BranchModel');
		$this->load->model('PR_Model');
		$this->load->model('Finance_model');
    }
	public function index()
	{
		
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();


		$gen_notif['count'] = $this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$data['title'] = "Branch | iDrive Tutorial";
        $this->load->view('templates/header',$data);
        $this->load->view('templates/navbar',$gen_notif);
        $data['branch'] = $this->BranchModel->get_all_branch();
		$this->load->view('Branch_Module/table_branch',$data);
        $this->load->view('templates/footer');
		$this->load->view('templates/script');
		
        
	}
	public function alpha_character($str){
		if (!preg_match("/^([a-zA-Z ])+$/i",$str)) {
			$this->form_validation->set_message('alpha_character','The %s can only contain alphabet/s');
			return false;
		}else{
			return true;
		}
	}
	public function alpha_num($str){
		if (!preg_match("/^([0-9+])+$/i",$str)) {
			$this->form_validation->set_message('alpha_num','The %s can only contain number/s');
			return false;
		}else{
			return true;
		}
	}

	public function create_branch(){
		
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$gen_notif['count'] =$this->PR_Model->count_notif();
		$data['title'] = "Create Branch | iDrive Tutorial";
		$this->_add_branch();
		$this->load->view('templates/header',$data);
        $this->load->view('templates/navbar',$gen_notif);
		$data['branch'] = $this->BranchModel->get_all_branch();
		$this->load->view('Branch_Module/create_branch',$data);
        $this->load->view('templates/footer');
		$this->load->view('templates/script');

	}

	public function _add_branch() {

		if($this->input->post('btn_branch'))
		{
			
			$this->form_validation->set_rules('txtbranch','Branch Name','trim|required|callback_alpha_character|is_unique[tbl_branch.branch_name]|max_length[19]');
			$this->form_validation->set_rules('txtcontact','Contact Number','required|callback_alpha_num|min_length[11]|max_length[11]');
			$this->form_validation->set_rules('txtstreet','Street','trim|required');
			$this->form_validation->set_rules('txtbarangay','Barangay','trim|required');
			$this->form_validation->set_rules('txtcity','City','trim|required|callback_alpha_character');
			$this->form_validation->set_rules('txtprovince','Province','trim|required|callback_alpha_character');
			
			if($this->form_validation->run() != FALSE){

				$response = $this->BranchModel->add_branch();//true
				if ($response) 
				{
					$this->session->set_flashdata('create_user_success','Successfully Created!');//display message
				}
				else
				{
					$this->session->set_flashdata('create_user_error','Create Failed!');//display message
					
				}
				 redirect('BranchCtrl/create_branch');


			}
		}
	
	}


	public function update_branch($id){
		
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();

		$title['title'] = "Update Branch | iDrive Tutorial";
		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$this->edit_user_submit($id);
		$this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		$data['branch'] = $this->BranchModel->get_branch($id);
		$this->load->view('Branch_Module/update_branch',$data);
        $this->load->view('templates/footer');
		$this->load->view('templates/script');

	}

	
	public function edit_user_submit($id)
	{
		if($this->input->post('updateBranch'))
		{
			
			$this->form_validation->set_rules('txtBranch','Branch Name','trim|required|callback_alpha_character');
			$this->form_validation->set_rules('txtContact','Contact Number','required|callback_alpha_num|min_length[10]|max_length[13]');
			$this->form_validation->set_rules('txtStreet','Street','trim|required');
			$this->form_validation->set_rules('txtBarangay','Barangay','trim|required');
			$this->form_validation->set_rules('txtCity','City','trim|required|callback_alpha_character');
			$this->form_validation->set_rules('txtProvince','Province','trim|required|callback_alpha_character');
			
			if($this->form_validation->run() != FALSE){

				$response = $this->BranchModel->update_branch();
				if ($response) 
				{
					$this->session->set_flashdata('create_user_success','Successfully Updated!');
				}
				else
				{
					$this->session->set_flashdata('create_user_error','Update Failed!');
					
				}
				 redirect('BranchCtrl/update_branch/'.$id);


			}
		}
	

    }
	public function view_branch($id){
		
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();


		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$gen_notif['count'] =$this->PR_Model->count_notif();
		$this->load->view('templates/header');
        $this->load->view('templates/navbar',$gen_notif);
		$data['view_branch'] = $this->BranchModel->get_branch($id);
		$this->load->view('Branch_Module/view_branch',$data);
        $this->load->view('templates/footer');
	
}


	public function status($id){

	$response = $this->BranchModel->getStatus($id);
	if ($response) 
		{
			$this->session->set_flashdata('create_user_success','Successfully Deactivated!');
						
		}
		else
		{
		$this->session->set_flashdata('create_user_error',' Deactivate Failed!');
		}

	redirect('BranchCtrl/');
}
public function status_active($id){

	$response = $this->BranchModel->getStatus_active($id);
	if ($response) 
		{
			$this->session->set_flashdata('create_user_success','Successfully Reactivated!');
		}
		else
		{
		$this->session->set_flashdata('create_user_error',' Reactivate Failed!');
						
		}

	redirect('BranchCtrl/');
}


}