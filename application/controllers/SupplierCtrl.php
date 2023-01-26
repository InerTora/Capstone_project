<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SupplierCtrl extends CI_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->model('Manager_model');
		$is_logged_in = $this->Manager_model->is_user_logged_in();
		
	if (!$is_logged_in) {
		redirect('Accounts/login');
	}
        $this->load->model('SupplierModel');
		$this->load->model('PR_Model');
		$this->load->model('Finance_model');
		$this->load->model('UserModel');
    }
	public function index()
	{
	
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$data['supplier'] = $this->SupplierModel->supplier_table();
		$title['title'] = "Supplier | iDrive Tutorial";
        $this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('Supplier/gen_table_supplier',$data);
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
		if (!preg_match("/^([0-9])+$/i",$str)) {
			$this->form_validation->set_message('alpha_num','The %s can only contain number/s');
			return false;
		}else{
			return true;
		}
	}


	public function create_supplier(){
		
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
		$data['branch'] = $this->UserModel->getbranch_list();
		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$title['title'] = "Create Supplier | iDrive Tutorial";
		$this->_add_supplier();
		$this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('Supplier/create_supplier',$data);
        $this->load->view('templates/footer');
		$this->load->view('templates/script');
		
	}

	
	
	public function _add_supplier() {


		if ($this->input->post('Addsupplier')) {
			$this->form_validation->set_rules('supplier_name','Supplier Name','trim|is_unique[tbl_supplier.supplier_name]|required|min_length[1]');
			$this->form_validation->set_rules('contact','Contact Number','required|callback_alpha_num|min_length[11]|max_length[11]');
			$this->form_validation->set_rules('street',' Street','trim|required');
			$this->form_validation->set_rules('barangay','Barangay','trim|required');
			$this->form_validation->set_rules('city','city','trim|required|callback_alpha_character');
			$this->form_validation->set_rules('province','Province','trim|required|callback_alpha_character');
			
			if($this->form_validation->run() != FALSE){

			$response = $this->SupplierModel->add_supplier();
			
			if ($response) {

				$this->session->set_flashdata('create_user_success', 'Successfully Created!');
			}else{
				$this->session->set_flashdata('create_user_error', 'Create Failed!');
			}
			redirect('SupplierCtrl/create_supplier');
			
			}

		}

	}

		public function update_supplier($id){
			
			$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
			$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
			$gen_notif['count'] =$this->PR_Model->count_notif();
			$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
			$data['title'] = "Update Supplier | iDrive Tutorial";
			$this->edit_supplier_submit($id);
			$this->load->view('templates/header',$data);
			$this->load->view('templates/navbar',$gen_notif);
			$data['supplier'] = $this->SupplierModel->get_supplier($id);
			$data['branch'] = $this->UserModel->getbranch_list();
			$this->load->view('Supplier/update_supplier',$data);
			$this->load->view('templates/footer');
			$this->load->view('templates/script');
	
		}

		public function edit_supplier_submit($id)
		{
			$supplier = $this->input->post('supplier_name');
			if($this->input->post('updateSupplier'))
			{
				$data['supplier'] = $this->SupplierModel->get_supplier($id);

				if ($data['supplier']->supplier_name == $supplier) {
					

					$this->form_validation->set_rules('contact','Contact Number','required|callback_alpha_num|min_length[11]|max_length[11]');
					$this->form_validation->set_rules('street',' Street','trim|required');
					$this->form_validation->set_rules('barangay','Barangay','trim|required');
					$this->form_validation->set_rules('city','city','trim|required|callback_alpha_character');
					$this->form_validation->set_rules('province','Province','trim|required|callback_alpha_character');
			
					if($this->form_validation->run() != FALSE){

					$response = $this->SupplierModel->update_supplier1();//true
				if ($response) 
				{
					$this->session->set_flashdata('create_user_success','Successfully Updated!');//display message
				}
			
				else
				{
					$this->session->set_flashdata('create_user_error','Update Failed!');//display message
					
				}
				 redirect('SupplierCtrl/update_supplier/'.$id); 
			
			}

				} else {
					

					$this->form_validation->set_rules('supplier_name','Supplier Name','trim|required|is_unique[tbl_supplier.supplier_name]');
					$this->form_validation->set_rules('contact','Contact Number','required|callback_alpha_num|min_length[11]|max_length[11]');
					$this->form_validation->set_rules('street',' Street','trim|required');
					$this->form_validation->set_rules('barangay','Barangay','trim|required');
					$this->form_validation->set_rules('city','city','trim|required|callback_alpha_character');
					$this->form_validation->set_rules('province','Province','trim|required|callback_alpha_character');
			
					

					if($this->form_validation->run() != FALSE){
					$response = $this->SupplierModel->update_supplier();//true
				if ($response) 
				{
					$this->session->set_flashdata('create_user_success','Successfully Updated!');//display message
				}
				else
				{
					$this->session->set_flashdata('create_user_error','Update Failed!');//display message
					
				}
				 redirect('SupplierCtrl/update_supplier/'.$id); 
				}
				
			}
			}
    
    }

	public function branch_supplier(){
		$notif['count'] =$this->PR_Model->branch_count_notif();
		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		
		$data['title'] = "Supplier | iDrive Tutorial";
		$this->load->view('templates/header',$data);
        $this->load->view('branch_temp/navbar',$notif);
		$data['supplier_branch'] = $this->SupplierModel->supplier_branch();
		$this->load->view('Supplier/manager_table',$data);
        $this->load->view('templates/footer');
		$this->load->view('templates/script');
	}


	public function view_supplier($id){
		
		$gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();

		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$data['title'] = "Supplier | iDrive Tutorial";
		$this->load->view('templates/header',$data);
        $this->load->view('templates/navbar',$gen_notif);
		$data['view_supplier'] = $this->SupplierModel->get_supplier($id);
		$this->load->view('Supplier/view_supplier',$data);
        $this->load->view('templates/footer');
	
}
public function branch_view_supplier($id){
	$notif['count'] =$this->PR_Model->branch_count_notif();
	$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
	$data['title'] = "Supplier | iDrive Tutorial";
	$this->load->view('templates/header',$data);
	$this->load->view('branch_temp/navbar',$notif);
	$data['view_supplier'] = $this->SupplierModel->get_supplier($id);
	$this->load->view('Supplier/branch_view_supplier',$data);
	$this->load->view('templates/footer');

}


public function status($id){

	$response = $this->SupplierModel->getStatus($id);
	if ($response) 
		{
			$this->session->set_flashdata('create_user_success','Successfully Deactivated!');//display message
						
		}
		else
		{
		$this->session->set_flashdata('create_user_error','Deactivate Failed!');//display message
						
		}

	redirect('SupplierCtrl/');
	
}
	

public function status_active($id){

	$response = $this->SupplierModel->getStatus_active($id);
	if ($response) 
		{
			$this->session->set_flashdata('create_user_success','Successfully Activated!');
						
		}
		else
		{
		$this->session->set_flashdata('create_user_error',' Reactivate Failed!');
						
		}

	redirect('SupplierCtrl');
	

}

}