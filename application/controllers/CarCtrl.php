<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CarCtrl extends CI_Controller {

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
		
    }

	public function index()
	{
        
        $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $data['table_car'] = $this->Car_Model->table_car();
		$data['title'] = "Car | iDrive Tutorial";
        $this->load->view('templates/header',$data);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('Car_Module/table_car',$data);
        $this->load->view('templates/footer');
		$this->load->view('Car_Module/car_script');
		
	}

    public function add_car(){
        
        $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
        $this->submit_car();
        
        $gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$title['title'] = "Add Car | iDrive Tutorial";

        $data['branch'] = $this->UserModel->getbranch_list();
        $this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('Car_Module/add_car',$data);
        $this->load->view('templates/footer');
		$this->load->view('Car_Module/car_script');

    }

    public function submit_car(){

        if ($this->input->post('addcar')) {
            $this->form_validation->set_rules('plate_no','Plate No.','trim|required|is_unique[tbl_vehicles.plate_no]');
            $this->form_validation->set_rules('branch', 'Branch', 'trim|required');
            $this->form_validation->set_rules('brand', 'Brand', 'trim|required|callback_alpha_character');
            $this->form_validation->set_rules('color', 'Color', 'trim|required|callback_alpha_character');
            $this->form_validation->set_rules('chassis_no','Chassis No','trim|required|is_unique[tbl_vehicles.chassis_no]');

            if($this->form_validation->run() != FALSE){

                $response = $this->Car_Model->add_car();
                
                if ($response) {
    
                    $this->session->set_flashdata('create_user_success', 'Successfully Created!');
                   
                }else{
                    $this->session->set_flashdata('create_user_error', 'Create Failed!');
    
                }
                    redirect('CarCtrl/add_car');
               
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

    public function update_car($id){
        $this->submit_update_car($id);
        
        $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();

        $gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
		$data['title'] = "Car | iDrive Tutorial";
        $data['getcar'] =$this->Car_Model->getcar($id);
        $data['branch'] = $this->UserModel->getbranch_list();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('Car_Module/update_car',$data);
        $this->load->view('templates/footer');
		$this->load->view('Car_Module/car_script');
    }

    public function submit_update_car($id){
        $data['getcar'] =$this->Car_Model->getcar($id);
        $plate_no = $this->input->post('plate_no');
        if ($this->input->post('Updatecar')) {

            if ( $data['getcar']->plate_no == $plate_no ) {
                /*Start*/ 
             $this->form_validation->set_rules('branch','Branch','trim|required');
            $this->form_validation->set_rules('plate_no','Plate No.','trim|required');
            $this->form_validation->set_rules('brand', 'Brand', 'trim|required|callback_alpha_character');
            $this->form_validation->set_rules('color', 'Color', 'trim|required|callback_alpha_character');
            $this->form_validation->set_rules('chassis_no','chassis No','trim|required');
            if($this->form_validation->run() != FALSE){

                $response = $this->Car_Model->update_car();
                
                if ($response) {
    
                    $this->session->set_flashdata('create_user_success', 'Successfully Updated!');
                   
                }else{
                    $this->session->set_flashdata('create_user_error', 'Update Failed!');
    
                }
                    redirect('CarCtrl/update_car/'.$id);		
            }
            /*end*/ 
              
            } else {

                 /*Start*/ 
            $this->form_validation->set_rules('branch','Branch','trim|required');
            $this->form_validation->set_rules('plate_no','Plate No.','trim|required|is_unique[tbl_vehicles.plate_no]');
            $this->form_validation->set_rules('brand', 'Brand', 'trim|required|callback_alpha_character');
            $this->form_validation->set_rules('color', 'Color', 'trim|required|callback_alpha_character');
            $this->form_validation->set_rules('chassis_no','chassis No','trim|required');
            if($this->form_validation->run() != FALSE){

                $response = $this->Car_Model->update_car();
                
                if ($response) {
    
                    $this->session->set_flashdata('create_user_success', 'Successfully Updated!');
                    //redirect('UserCtrl/create_user');
                }else{
                    $this->session->set_flashdata('create_user_error', 'Update Failed!');
    
                }
                    redirect('CarCtrl/update_car/'.$id);		
            }
            /*end*/ 
             
            }
            
        }
    }



    public function delete_car($id){

		
        $response = $this->Car_Model->delete_car($id);
        if ($response) 
            {
                $this->session->set_flashdata('create_user_success','Successfully Deleted!');
            }
            else
            {
            $this->session->set_flashdata('create_user_error',' Delete Failed!');//display message        
            }
        redirect('CarCtrl/');
   
    }

    public function branch_car(){
        $notif['count'] =$this->PR_Model->branch_count_notif();
		$notif['manage_notif'] = $this->PR_Model->approve_by_gen();
        $data['branch_table_car'] = $this->Car_Model->branch_table_car();
		$data['title'] = "Car | iDrive Tutorial";
        $this->load->view('templates/header',$data);
        $this->load->view('branch_temp/navbar',$notif);
		$this->load->view('Car_Module/branch_table_car');
        $this->load->view('templates/footer');
		$this->load->view('Car_Module/car_script');
    }

   
}