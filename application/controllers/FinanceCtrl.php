<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;
class FinanceCtrl extends CI_Controller {

    public function __construct(){
		parent:: __construct();
		
		$this->load->model('Manager_model');
		$is_logged_in = $this->Manager_model->is_user_logged_in();
		date_default_timezone_set('Asia/Manila');
	if (!$is_logged_in) {
		redirect('user/login');
	}
    $this->load->model('Finance_model');
    $this->load->model('PO_Model');
  
    $this->load->model('PR_Model');

}
	public function index()
	{
		
$this->finance_dashboard();
        
	}
    
    public function finance_dashboard(){
        
        $title['title'] = "Dashboard | iDrive Tutorial";

		date_default_timezone_set('Asia/Manila');
		$data['today_date'] = date('Y-m-d');
        
		$data['count_PO'] =$this->PR_Model->count_purchase_order();
		$data['count_PI'] =$this->PR_Model->count_purchase_invoice();
		$data['count_request'] =$this->PR_Model->count_purchase_request();
		$data['count_voucher'] =$this->PR_Model->count_purchase_voucher();
		$data['schedule_table_ledger'] = $this->Finance_model->schedule_table_ledger();
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();

		$this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('finance/finance_dashboard',$data);
		$this->load->view('templates/footer');
		$this->load->view('templates/Graph_script');
    }
    public function finance_create_PI($id){
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $this->attach_pi();
        $title['title'] = "Create Purchase Invoice | iDrive Tutorial";
        $data['display_PI'] = $this->Finance_model->auto_number_PI();
        $data['get_po_details'] = $this->Finance_model->get_po_details($id);
        $data['get_po'] = $this->PO_Model->get_po($id);
        $data['tot_quant'] = $this->Finance_model->tot_quant($id);
       
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('finance/finance_create_PI',$data);
        $this->load->view('templates/footer');
		$this->load->view('finance_temp/finance_scripts');
    }

    public function finance_create_PI_sr($id){
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $this->attach_pi();
        $title['title'] = "Create Purchase Invoice | iDrive Tutorial";
        $data['display_PI'] = $this->Finance_model->auto_number_PI();
        $data['get_po_details'] = $this->Finance_model->get_po_details($id);
        $data['get_po_sr'] = $this->PO_Model->get_po_sr($id);
        $data['tot_quant'] = $this->Finance_model->tot_quant($id);
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('Service/finance_create_PI_sr',$data);
        $this->load->view('templates/footer');
		$this->load->view('finance_temp/finance_scripts');
    }
   

    public function submit_purchase_invoice(){
        if ($this->input->post('btn_pi')) {

            $response = $this->Finance_model->submit_purchase_invoice();
				if ($response) {
					$this->session->set_flashdata('create_user_success', 'Successfully Created!');
					
				}else{
					$this->session->set_flashdata('create_user_error', 'Created Failed');
	
				}
				redirect('financeCtrl/finance_manage_PI');
        }

    }
    public function approved_PO(){
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $title['title'] = "Create Purchase Invoice | iDrive Tutorial";
        $data['table_po'] = $this->Finance_model->table_po1();
      
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('finance/finance_approved_po',$data);
        $this->load->view('templates/footer');
		$this->load->view('finance_temp/finance_scripts');
    }
    
    public function attach_pi(){
        if ($this->input->post('btn_pi')) {

                $config['upload_path'] = './upload/Purchase_invoice/';
                $config['allowed_types'] = 'jpg|png';
        
                $this->load->library('upload', $config);
        
                if ( ! $this->upload->do_upload('profile_picture'))
                {
                        $this->session->set_flashdata('create_user_error', 'Create Failed!');
    
                }
                else
                {
                    $this->session->set_flashdata('create_user_success','Successfully Created!');
                    
                        $file_name = $this->upload->data('file_name');
                        
                        $response  = $this->Finance_model->attach_pi($file_name);
                        if ($response) 
                        {
                            $this->session->set_flashdata('success','Successfully Created!');//display message
                        }
                        else
                        {
                            $this->session->set_flashdata('error','Unsuccessfully Created!');//display message
                        }
                    
                }
                redirect('FinanceCtrl/approved_po');
		}
		
    }

    public function finance_manage_PI(){
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $title['title'] = "Manage Purchase Invoice | iDrive Tutorial";
        $this->load->view('templates/header',$title);
        $data['get_purchase_invoice'] = $this->Finance_model->get_purchase_invoice();
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('finance/table_manage_pi',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }

    /*---------Manager View Invoice--------------*/ 

    public function manager_view_invoice(){
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] = $this->PR_Model->branch_count_notif();
        $title['title'] = "Manage Purchase Invoice | iDrive Tutorial";
        $this->load->view('templates/header',$title);
        $data['get_purchase_invoice'] = $this->Finance_model->get_purchase_invoice();
        $this->load->view('branch_temp/navbar',$notif);
		$this->load->view('finance/manager_view_invoice',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }

    /*-------------------General Manager View---------------------------*/ 


    public function gen_manage_view_invoice(){
        $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();

		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $title['title'] = "Manage Purchase Invoice | iDrive Tutorial";
        $this->load->view('templates/header',$title);
        $data['general_pi_only'] = $this->Finance_model->general_pi_only();
        $data['general_pi_branch'] = $this->Finance_model->general_pi_branch();
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('finance/gen_manage_view_invoice',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }


        public function manager_view_pi($id){
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
        $notif['count'] = $this->PR_Model->branch_count_notif();
        $title['title'] = "Manage Purchase Invoice | iDrive Tutorial";
        $data['ledger_no'] = $this->Finance_model->auto_number_ledger();
        $data['view_pi'] = $this->Finance_model->view_purchase_invoice($id);
        $data['invoice_view'] = $this->Finance_model->invoice_view($id);
        $this->load->view('templates/header',$title);
        $this->load->view('branch_temp/navbar',$notif);
		$this->load->view('finance/manager_view_pi',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
		
    }
    
    public function manager_view_pi_sr($id){
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
        $notif['count'] = $this->PR_Model->branch_count_notif();
        $title['title'] = "Manage Purchase Invoice | iDrive Tutorial";
        $data['ledger_no'] = $this->Finance_model->auto_number_ledger();
        $data['view_pi'] = $this->Finance_model->view_purchase_invoice($id);
        $data['invoice_view_sr'] = $this->Finance_model->invoice_view_sr($id);
        $this->load->view('templates/header',$title);
        $this->load->view('branch_temp/navbar',$notif);
		$this->load->view('finance/manager_view_pi_sr',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
		
    }
    
    /*------------General Manager---------------*/ 
    public function gen_view_all_PI($id){
       
        $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();

		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $title['title'] = "Manage Purchase Invoice | iDrive Tutorial";
        $data['ledger_no'] = $this->Finance_model->auto_number_ledger();
        $data['view_pi'] = $this->Finance_model->view_purchase_invoice($id);
        $data['invoice_view'] = $this->Finance_model->invoice_view($id);
        $this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('finance/gen_view_all_PI',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
		
    }
    public function gen_view_all_PI_sr($id){
       
        $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();

		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $title['title'] = "Manage Purchase Invoice | iDrive Tutorial";
        $data['ledger_no'] = $this->Finance_model->auto_number_ledger();
        $data['view_pi'] = $this->Finance_model->view_purchase_invoice($id);
        $data['invoice_view_sr'] = $this->Finance_model->invoice_view_sr($id);
        $this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('Service/gen_view_all_PI_sr',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');

    }
    public function finance_update_PI($id){
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $this->update_PI($id);
        $title['title'] = "Manage Purchase Invoice | iDrive Tutorial";
        $data['view_pi'] = $this->Finance_model->view_purchase_invoice($id);
        $data['invoice_view'] = $this->Finance_model->invoice_view($id);
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('finance/finance_update_PI',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
		
    }

    public function finance_update_PI_sr($id){
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $this->update_PI_sr($id);
        $title['title'] = "Manage Purchase Invoice | iDrive Tutorial";
        $data['view_pi'] = $this->Finance_model->view_purchase_invoice($id);
        $data['invoice_view_sr'] = $this->Finance_model->invoice_view_sr($id);
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('Service/finance_update_PI_sr',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
		
    }


   public function update_PI($id){

    if ($this->input->post('btn_update_pi')) {

            $response  = $this->Finance_model->update_attach_pi();
            if ($response) 
            {
                $this->session->set_flashdata('create_user_success','Successfully Updated!');
            }
            else
            {
                $this->session->set_flashdata('create_user_error','Unsuccessfully Created!');
            }
            redirect('FinanceCtrl/finance_update_PI/'.$id);
}

   }


   public function update_PI_sr($id){

    if ($this->input->post('btn_update_pi')) {

            $response  = $this->Finance_model->update_attach_pi();
            if ($response) 
            {
                $this->session->set_flashdata('create_user_success','Successfully Updated!');
            }
            else
            {
                $this->session->set_flashdata('create_user_error','Unsuccessfully Created!');
            }
            redirect('FinanceCtrl/finance_update_PI_sr/'.$id);
}

   }

   public function alpha_num($str){
    if (!preg_match("/^([0-9,.])+$/i",$str)) {
        $this->form_validation->set_message('alpha_num','The %s can only contains number/s');
        return false;
    }else{
        return true;
    }
}

   public function upload($id){
    if ($this->input->post('btn_upload')) {
        $config['upload_path'] = './upload/Purchase_invoice/';
        $config['allowed_types'] = 'jpg|png';


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('profile_picture'))
        {
                $this->session->set_flashdata('create_user_error', 'Create Failed!');

        }
        else
        {
            $this->session->set_flashdata('create_user_success','Successfully Created!');
            
                $file_name = $this->upload->data('file_name');
                
                $response  = $this->Finance_model->update_image($file_name);
                if ($response) 
                {
                    $this->session->set_flashdata('success','Successfully Created!');//display message
                }
                else
                {
                    $this->session->set_flashdata('error','Unsuccessfully Created!');//display message
                }
        }
        redirect('FinanceCtrl/finance_update_PI/'.$id);
    }
    
}
public function upload_sr($id){
    if ($this->input->post('btn_upload')) {
        $config['upload_path'] = './upload/Purchase_invoice/';
        $config['allowed_types'] = 'jpg|png';


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('profile_picture'))
        {
                $this->session->set_flashdata('create_user_error', 'Create Failed!');

        }
        else
        {
            $this->session->set_flashdata('create_user_success','Successfully Created!');
            
                $file_name = $this->upload->data('file_name');
                
                $response  = $this->Finance_model->update_image($file_name);
                if ($response) 
                {
                    $this->session->set_flashdata('success','Successfully Created!');//display message
                }
                else
                {
                    $this->session->set_flashdata('error','Unsuccessfully Created!');//display message
                }
        }
        redirect('FinanceCtrl/finance_update_PI_sr/'.$id);
    }
    
}
    public function finance_create_AP(){
        
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $this->submit_ap();
        $title['title'] = "Accounts Payable Journal | iDrive Tutorial";
        $data['billing_supplier'] =$this->PR_Model->billing_supplier();
        $data['display_bill'] = $this->Finance_model->auto_number_Bill();
        
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('finance/finance_create_AP',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }
    public function submit_ap(){
        if ($this->input->post('btn_ap')) {

            $total_amount =$this->input->post('total_amount');
            if (!$total_amount <=0) {

                $config['upload_path'] = './upload/Bills/';
                $config['allowed_types'] = 'jpg|png';
        
        
                $this->load->library('upload', $config);
        
                if ( ! $this->upload->do_upload('image_ap'))
                {
                        $this->session->set_flashdata('create_user_error', 'Create Failed!');
        
                }
                else
                {
                    $this->session->set_flashdata('create_user_success','Successfully Created!');
                    
                        $file_name = $this->upload->data('file_name');
                        
                        $response  = $this->Finance_model->add_ap($file_name);
                        if ($response) 
                        {
                            $this->session->set_flashdata('create_user_success','Successfully Created!');//display message
                        }
                        else
                        {
                            $this->session->set_flashdata('create_user_error','Create Failed!');//display message
                        }
                    
                }
                redirect('FinanceCtrl/finance_create_AP');
                
            }else{

                $this->session->set_flashdata('create_user_error', 'The amount should not be less than 0');

            }
        }

    }
   
    public function finance_view_pi($id){
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $title['title'] = "Manage Purchase Invoice | iDrive Tutorial";
        $data['ledger_no'] = $this->Finance_model->auto_number_ledger();
        $data['view_pi'] = $this->Finance_model->view_purchase_invoice($id);
        $data['invoice_view'] = $this->Finance_model->invoice_view($id);
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('finance/finance_view_PI',$data);
        $this->load->view('templates/footer');
		
    }

    public function finance_view_pi_sr($id){
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $title['title'] = "Manage Purchase Invoice | iDrive Tutorial";
        $data['ledger_no'] = $this->Finance_model->auto_number_ledger();
        $data['view_pi'] = $this->Finance_model->view_purchase_invoice($id);
        $data['invoice_view_sr'] = $this->Finance_model->invoice_view_sr($id);
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('Service/finance_view_PI_sr',$data);
        $this->load->view('templates/footer');
		
    }
    public function finance_manage_AP(){
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $title['title'] = "Manage Accounts Payable | iDrive Tutorial";
        $data['table_ap'] = $this->Finance_model->table_ap();  
        $data['table_ap1'] = $this->Finance_model->table_ap1();  
        $data['payment_receipt'] = $this->Finance_model->payment_receipt(); 
      
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('finance/finance_manage_AP',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
		
    }

    public function manager_ap_journal(){
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
        $notif['count'] =$this->PR_Model->branch_count_notif();
        $title['title'] = "Manage Accounts Payable | iDrive Tutorial";
        $data['manager_table_ap'] = $this->Finance_model->manager_table_ap();  
        $this->load->view('templates/header',$title);
        $this->load->view('branch_temp/navbar',$notif);
		$this->load->view('branch_temp/manager_ap_journal',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
		
    }
    public function manager_view_ap_journal($id){
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
        $notif['count'] =$this->PR_Model->branch_count_notif();
        $data['ledger_no'] = $this->Finance_model->auto_number_ledger();
        $title['title'] = " View Accounts Payable Journal | iDrive Tutorial";
      
        $data['select_ap'] = $this->Finance_model->select_ap($id);
        $this->load->view('templates/header',$title);
        $this->load->view('branch_temp/navbar',$notif);
		$this->load->view('branch_temp/manager_view_ap_journal',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }

    public function gen_ap_journal(){
        $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
		$gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $title['title'] = "Manage Accounts Payable | iDrive Tutorial";
        $data['gen_table_ap'] = $this->Finance_model->gen_table_ap();  
        $this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('branch_temp/gen_ap_journal',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
		
    }

    public function gen_view_ap_journal($id){
        $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
		$gen_notif['count'] =$this->PR_Model->count_notif();
       
        $title['title'] = " View Accounts Payable Journal | iDrive Tutorial";
       
        $data['gen_select_ap'] = $this->Finance_model->gen_select_ap($id);
        $this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('branch_temp/gen_view_ap_journal',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }
    public function finance_update_AP($id){
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $this->update_AP($id);
        $title['title'] = "Accounts Payable Journal | iDrive Tutorial";
        $data['billing_supplier'] =$this->PR_Model->billing_supplier();
        
        $data['select_ap'] = $this->Finance_model->select_ap($id);
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('finance/finance_update_AP',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
		
    }

    public function update_AP($id){

        if ($this->input->post('btn_update_ap')) {
            $amount =$this->input->post('amount');
            if (!$amount <=0) {

                $this->form_validation->set_rules('amount','Amount','required|callback_alpha_num');

                if($this->form_validation->run() != FALSE){
    
                    $response  = $this->Finance_model->update_ap($id);
                    if ($response) 
                    {
                        $this->session->set_flashdata('create_user_success','Successfully Updated!');
                    }
                    else
                    {
                        $this->session->set_flashdata('create_user_error','Unsuccessfully Created!');
                    }
                  redirect('FinanceCtrl/finance_update_AP/'.$id);
        
                }

            }else{
                
                $this->session->set_flashdata('create_user_error', 'The amount should not be less than 0');
                
            }
           

            }
               
       }
    
       public function upload_ap($id){
        if ($this->input->post('btn_upload')) {
            $config['upload_path'] = './upload/Bills/';
            $config['allowed_types'] = 'jpg|png';
    
    
            $this->load->library('upload', $config);
    
            if ( ! $this->upload->do_upload('ap_image'))
            {
                    $this->session->set_flashdata('create_user_error', 'Update Failed!');
    
            }
            else
            {
                $this->session->set_flashdata('create_user_success','Successfully Updated!');
                
                    $file_name = $this->upload->data('file_name');
                    
                    $response  = $this->Finance_model->update_image_ap($file_name);
                    if ($response) 
                    {
                        $this->session->set_flashdata('success','Successfully Updated!');//display message
                    }
                    else
                    {
                        $this->session->set_flashdata('error','Unsuccessfully Updated!');//display message
                    }
                
            }
            redirect('FinanceCtrl/finance_update_AP/'.$id);
        } 
    }

    /*------------AP BILLS Post To ledger------------------*/ 


    public function posting_ap($id){

        if ($this->input->post('btn_post')) {
            $response = $this->Finance_model->insert_bills_ledger();
    
            if ($response) 
        {
            $this->session->set_flashdata('create_user_success','Successfully Posted!');
                        
        }
        else
        {
        $this->session->set_flashdata('create_user_error',' Create Failed!');		
        }
    
    redirect('FinanceCtrl/finance_manage_AP');
        }
    }

public function delete_AP($id){
    
    $response = $this->Finance_model->delete_AP($id);
    if ($response) 
        {
            $this->session->set_flashdata('create_user_success','Successfully Deleted!');
        }
        else
        {
        $this->session->set_flashdata('create_user_error',' Delete Failed!');//display message        
        }
    redirect('FinanceCtrl/finance_manage_AP');
}

    public function finance_view_AP($id){
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $data['ledger_no'] = $this->Finance_model->auto_number_ledger();
        $title['title'] = " View Accounts Payable Journal | iDrive Tutorial";
      
        $data['select_ap'] = $this->Finance_model->select_ap($id);
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('finance/finance_view_AP',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }
    
    public function finance_approve_PV(){
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $data['get_purchase_invoice'] = $this->Finance_model->get_purchase_invoice();
        $data['getallsupplier'] =$this->Finance_model->getallsupplier();
        $title['title'] = " Payment Voucher | iDrive Tutorial"; 
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('finance/table_reference',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
		
    }
  
public function finance_manage_PV(){
    $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
    $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
    $title['title'] = " Manage Payment Voucher | iDrive Tutorial"; 
    $data['table_voucher'] = $this->Finance_model->tbl_voucher();
    $data['tbl_voucher_approved'] = $this->Finance_model->tbl_voucher_approved();
    $this->load->view('templates/header',$title);
    $this->load->view('finance_temp/navbar',$fin_notif);
    $this->load->view('finance/finance_manage_PV',$data);
    $this->load->view('templates/footer');
    $this->load->view('finance_temp/finance_scripts');

}

    public function finance_view_PV($id){
      $this->unseen($id);
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $data['display_paledger'] = $this->Finance_model->auto_number_pa_ledger();
        $title['title'] = " Manage Payment Voucher | iDrive Tutorial"; 
        $data['view_pi'] = $this->Finance_model->view_voucher($id);
        $data['list_voucher'] = $this->Finance_model->list_voucher($id);
        $data['list_voucher1'] = $this->Finance_model->list_voucher1($id);
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
		$this->load->view('finance/finance_view_PV',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }

    public function gen_view_voucher($id){
      
        $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
        $gen_notif['count'] =$this->PR_Model->count_notif();
        $title['title'] = " Manage Payment Voucher | iDrive Tutorial"; 
        $data['view_pi'] = $this->Finance_model->view_voucher($id);
        $data['list_voucher'] = $this->Finance_model->list_voucher($id);
        $data['list_voucher1'] = $this->Finance_model->list_voucher1($id);
        $this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('finance/view_gen_voucher',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }

    
    public function gen_view_ap_voucher($id){
      
        $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
        $gen_notif['count'] =$this->PR_Model->count_notif();
        $title['title'] = " Manage Payment Voucher | iDrive Tutorial"; 
        $data['ap_view_voucher'] = $this->Finance_model->ap_view_voucher($id);
        
        $this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('finance/view_gen_ap_voucher',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }

    public function gen_approved_PV(){
        $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
        $gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $data['table_voucher'] = $this->Finance_model->table_approved_voucher();
        $data['table_voucher1'] = $this->Finance_model->table_approved_voucher1();
        $title['title'] = " Manage Payment Voucher Request | iDrive Tutorial"; 
        $this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('finance/gen_approved_PV',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
		
    }
    

    public function gen_approved($id){
        $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
        $this->gen_submit();
        $title['title'] = " Manage Payment Voucher Request | iDrive Tutorial"; 

       // $data['cont'] =$this->Finance_model->sms_contact($id);
		//$data['sms'] = $this->PR_Model->sms_contact_user($id);
		$data['sms_branch'] = $this->PR_Model->sms_branch();
        $data['selectcontact'] = $this->Finance_model->Select_contact($id);//Select the Contact

        $data['view_pi'] = $this->Finance_model->view_voucher($id);
        $data['list_voucher'] = $this->Finance_model->list_voucher($id);
      
        $gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('finance/gen_manage_approved',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
		
    }

    
    public function gen_submit(){

        if ($this->input->post('btn_approved')) {
           
            $response = $this->Finance_model->update_status();
            if ($response) {
               //$this->send_sms1();
                $this->session->set_flashdata('create_user_success', 'Successfully Posted!');
                 
            }else{
                $this->session->set_flashdata('create_user_error', 'Post Failed');

            }
        redirect('FinanceCtrl/gen_approved_PV');
            
        }
    }
/*----------------------SMS--------------------------------*/ 

public function send_sms1(){
    $status =$this->input->post('status');
    $user = $this->input->post('user');
    if ($status == "approved") {
    try {
    $ch = curl_init();
    //$message = $this->input->post('message');  #Message Content base on input
    $contact = $this->input->post('contact');
    $parameters = array(
        'apikey' =>'495b8ee36bed3ad1517df986861e5f0d', //Your API KEY
        'number' => $contact,
        'message' =>'iDrive Driving Tutorial Koronadal, approved a payment voucher request of '.$user.'.',
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
        'message' =>'iDrive Driving Tutorial Koronadal, disapproved a payment voucher request of '.$user.'.',
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

    
    public function gen_approved_bills($id){
        $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
        $this->gen_submit();
        $title['title'] = " Manage Payment Voucher Request | iDrive Tutorial"; 

        $data['cont'] =$this->Finance_model->sms_contact($id);
		$data['sms'] = $this->Finance_model->get_branch();
		$data['sms_branch'] = $this->Finance_model->sms_branch();
        $data['selectcontact'] = $this->Finance_model->Select_contact($id);//Select the Contact
        $data['ap_bills_voucher'] = $this->Finance_model->view_ap_voucher1($id);
       // $data['view_pi'] = $this->Finance_model->view_voucher($id);
       
      
        $gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
        $this->load->view('templates/header',$title);
        $this->load->view('templates/navbar',$gen_notif);
		$this->load->view('finance/gen_manage_approved_bills',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
		
    }




    public function delete_pv($id){
        
        $response = $this->Finance_model->delete_pv($id);

        if ($response) 
    {
        $this->session->set_flashdata('create_user_success','Successfully Deleted!');
                    
    }
    else
    {
    $this->session->set_flashdata('create_user_error',' Delete Failed!');		
    }

redirect('FinanceCtrl/finance_manage_PV');
    }


/*CREATE PAYMENT RECEIPT FOR GASOLINE AND REPAIR MAINTENANCE*/ 
public function finance_create_Reciept($id){

    
    $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
    $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
    $this->submit_reciept($id);
    $title['title'] = " Create Reciept | iDrive Tutorial"; 
    $data['view_pi'] = $this->Finance_model->view_voucher($id);
    $data['display_reciept'] = $this->Finance_model->auto_number_reciept();
    $data['reciept_no'] = $this->Finance_model->reciept_no();
    $data['auto_number_pa_ledger'] = $this->Finance_model->auto_number_pa_ledger();
    $data['get_voucher_receipt'] = $this->Finance_model->get_voucher_receipt($id);
    $data['list_voucher'] = $this->Finance_model->list_voucher($id);
    $data['list_voucher1'] = $this->Finance_model->list_voucher1($id);
    $this->load->view('templates/header',$title);
    $this->load->view('finance_temp/navbar',$fin_notif);
    $this->load->view('finance/finance_create_reciept',$data);
    $this->load->view('templates/footer');
    $this->load->view('finance_temp/finance_scripts');
    
}

public function submit_reciept($id){
    if ($this->input->post('btn_reciept')) {
        $config['upload_path'] = './upload/Reciept/';
        $config['allowed_types'] = 'jpg|png';


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('reciept_image'))
        {
                $this->session->set_flashdata('create_user_error', 'Create Failed!');

        }
        else
        {

            $this->session->set_flashdata('create_user_success','Successfully Created!');
            
            $ref_pid = $this->input->post('ref_pid');
            $check =array();
       
               foreach ($ref_pid as $row) {
                   array_push($check,$row);
               }
                $file_name = $this->upload->data('file_name');
                $response  = $this->Finance_model->insert_reciept($file_name);
                $this->Finance_model->add_pa_ledger();
                $this->Finance_model->update_ledger($check);
                if ($response) 
                {
                    $this->session->set_flashdata('success','Successfully Created!');//display message
                }
                else
                {
                    $this->session->set_flashdata('error','Create Failed!');//display message
                }
            
        }
        redirect('FinanceCtrl/finance_manage_AP');
    }
}






/*CREATE PAYMENT RECEIPT FOR UTILITIES BILLS*/ 
public function finance_create_ap_reciept($id){

    
    $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
    $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
    $this->submit_reciept1($id);
    $title['title'] = " Create Reciept | iDrive Tutorial"; 
    $data['view_pi'] = $this->Finance_model->view_voucher($id);
    $data['display_reciept'] = $this->Finance_model->auto_number_reciept();
    $data['reciept_no'] = $this->Finance_model->reciept_no();
    $data['auto_number_pa_ledger'] = $this->Finance_model->auto_number_pa_ledger();
    $data['get_voucher_receipt'] = $this->Finance_model->get_voucher_receipt($id);
    $this->load->view('templates/header',$title);
    $this->load->view('finance_temp/navbar',$fin_notif);
    $this->load->view('finance/finance_create_ap_reciept',$data);
    $this->load->view('templates/footer');
    $this->load->view('finance_temp/finance_scripts');
    
}


public function submit_reciept1($id){
    if ($this->input->post('btn_reciept')) {
        $config['upload_path'] = './upload/Reciept/';
        $config['allowed_types'] = 'jpg|png';


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('reciept_image'))
        {
                $this->session->set_flashdata('create_user_error', 'Create Failed!');

        }
        else
        {

            $this->session->set_flashdata('create_user_success','Successfully Created!');
            
            $ref_pid = $this->input->post('ref_pid');
            $check =array();
       
               foreach ($ref_pid as $row) {
                   array_push($check,$row);
               }
                $file_name = $this->upload->data('file_name');
                $response  = $this->Finance_model->insert_reciept($file_name);
                $this->Finance_model->add_pa_ledger();
                $this->Finance_model->update_ledger_bills();
                if ($response) 
                {
                    $this->session->set_flashdata('success','Successfully Created!');//display message
                }
                else
                {
                    $this->session->set_flashdata('error','Create Failed!');//display message
                }
            
        }
        redirect('FinanceCtrl/finance_manage_AP');
    }
}

/*------------VIEW PAYMENT RECIEPT------------------*/ 

public function view_receipt($id){

    $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
    $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
    $data['select_reciept'] = $this->Finance_model->select_reciept($id);
    $title['title'] = " Create Reciept | iDrive Tutorial"; 
    $this->load->view('templates/header',$title);
    $this->load->view('finance_temp/navbar',$fin_notif);
    $this->load->view('finance/finance_view_reciept',$data);
    $this->load->view('templates/footer');
    $this->load->view('finance_temp/finance_scripts');
}


public function gen_view_receipt($id){

    $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
    $gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
    $gen_notif['count'] =$this->PR_Model->count_notif();

    $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
    
    $data['select_reciept'] = $this->Finance_model->select_reciept($id);
    $title['title'] = " Create Reciept | iDrive Tutorial"; 
    $this->load->view('templates/header',$title);
    $this->load->view('templates/navbar',$gen_notif);
    $this->load->view('ledger/gen_view_reciept',$data);
    $this->load->view('templates/footer');
    $this->load->view('finance_temp/finance_scripts');
}
public function manager_view_receipt($id){

    $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
    $notif['count'] =$this->PR_Model->branch_count_notif();
    $data['select_reciept'] = $this->Finance_model->select_reciept($id);
    $title['title'] = " Create Reciept | iDrive Tutorial"; 
    $this->load->view('templates/header',$title);
    $this->load->view('branch_temp/navbar',$notif);
    $this->load->view('ledger/manager_view_receipt',$data);
    $this->load->view('templates/footer');
    $this->load->view('finance_temp/finance_scripts');
}

/*-------POST TO PAID ACCOUNT LEDGER-------*/ 

public function Post_to_paledger(){

    if ($this->input->post('btn_post')) {
      
        $ref_pid = $this->input->post('ref_pid');
     $check =array();

        foreach ($ref_pid as $row) {
            array_push($check,$row);
        }
        
        $this->Finance_model->update_ledger($check);
        $response = $this->Finance_model->add_pa_ledger();
        if ($response) 
        {
            $this->session->set_flashdata('create_user_success','Successfully Created!');
        }
        else
        {
            $this->session->set_flashdata('create_user_error','Create Failed!');
        }
        redirect('FinanceCtrl/finance_manage_PV');
    }

    
}


/*---------------------Manage Receipt---------------------*/ 

public function manage_receipt(){
    $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
    $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
    $title['title'] = " Manage payment receipt | iDrive Tutorial";
    $data['payment_receipt'] = $this->Finance_model->payment_receipt();
    $this->load->view('templates/header' ,$title);
    $this->load->view('finance_temp/navbar',$fin_notif);
    $this->load->view('finance/manage_receipt',$data);
    $this->load->view('templates/footer');
    $this->load->view('finance_temp/finance_scripts');
    
}
public function finance_manage_ledger(){
    $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
    $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
    $title['title'] = " Manage Ledger | iDrive Tutorial";
    $data['table_ledger'] = $this->Finance_model->table_ledger();
    $this->load->view('templates/header' ,$title);
    $this->load->view('finance_temp/navbar',$fin_notif);
    $this->load->view('ledger/manage_ledger',$data);
    $this->load->view('templates/footer');
    $this->load->view('finance_temp/finance_scripts');
}



public function gen_ledger(){
    
    $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
	$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
    $title['title'] = " Manage Ledger | iDrive Tutorial";
    $gen_notif['count'] =$this->PR_Model->count_notif();
    $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
    $data['table_ledger1'] = $this->Finance_model->table_ledger1();
    
    $this->load->view('templates/header' ,$title);
    $this->load->view('templates/navbar',$gen_notif);
    $this->load->view('ledger/gen_ledger',$data);
    $this->load->view('templates/footer');
    $this->load->view('finance_temp/finance_scripts');
}
public function manager_ap_ledger(){
    $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
    $notif['count'] =$this->PR_Model->branch_count_notif();
    $title['title'] = " Manage Ledger | iDrive Tutorial";
    $data['table_ledger'] = $this->Finance_model->table_ledger();
    $this->load->view('templates/header' ,$title);
    $this->load->view('branch_temp/navbar',$notif);
    $this->load->view('ledger/manager_ap_ledger',$data);
    $this->load->view('templates/footer');
    $this->load->view('finance_temp/finance_scripts');
}


public function checkbox(){
    $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
    $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
    $data['display_voucher'] = $this->Finance_model->auto_number_voucher();

   $data['sms'] = $this->PR_Model->get_user();//sms
	$data['sms_branch'] = $this->PR_Model->sms_branch();//sms
  
    $title['title'] = "Voucher | iDrive Tutorial";

    if (isset($_POST['btn_check'])) {

     if(!empty($this->input->post('check_value'))){

        $checked = $this->input->post('check_value');
        $checked_id=array();

        foreach ($checked as $row) {
          array_push($checked_id, $row);
        }
        $data['getPV'] = $this->Finance_model->getPV($checked_id);
        $data['getPV1'] = $this->Finance_model->getPV1($checked_id);
        $data['check_amount'] = $this->Finance_model->check_amount($checked_id);
        $data['get_supplier_pv'] = $this->Finance_model->get_supplier_pv($checked_id);
        $this->add_payment_voucher();
           $this->load->view('templates/header',$title);
           $this->load->view('finance_temp/navbar',$fin_notif);
           $this->load->view('finance/finance_create_PV',$data);
           $this->load->view('templates/footer');
           $this->load->view('finance_temp/finance_scripts');

     }else{

        $this->session->set_flashdata('create_user_error','Select atleast one Purchase Invoice');
        redirect('FinanceCtrl/finance_approve_PV');
     }
    }
}


public function add_payment_voucher(){

    if ($this->input->post('btn_voucher')) {

        $id_pi = $this->input->post('id_pi');
        $check =array();

        foreach ($id_pi as $row) {
            array_push($check,$row);
        }
        $this->Finance_model->update_ref($check);
        $response = $this->Finance_model->add_voucher();

        if ($response) 
        {
            //$this->send_sms();
            $this->session->set_flashdata('create_user_success','Successfully Created!');
        }
        else
        {
            $this->session->set_flashdata('create_user_error','Create Failed!');
        }
        redirect('FinanceCtrl/finance_approve_PV');
    }

}

public function unseen($id){

    $this->Finance_model->unseen($id);
    
}
public function finance_manage_PA(){

    $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
    $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
    $title['title'] = "Paid Accounts | iDrive Tutorial";
    $data['table_pa'] = $this->Finance_model->table_pa();
    $this->load->view('templates/header',$title);
    $this->load->view('finance_temp/navbar',$fin_notif);
    $this->load->view('ledger/finance_manage_PA',$data);
    $this->load->view('templates/footer');
    $this->load->view('finance_temp/finance_scripts');
}


public function manager_pa_ledger(){

    $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
	$notif['count'] =$this->PR_Model->branch_count_notif();
    $title['title'] = "Paid Accounts | iDrive Tutorial";
    $data['table_pa'] = $this->Finance_model->table_pa();
    $this->load->view('templates/header',$title);
    $this->load->view('branch_temp/navbar',$notif);
    $this->load->view('ledger/manager_pa_ledger',$data);
    $this->load->view('templates/footer');
    $this->load->view('finance_temp/finance_scripts');
}
public function gen_manage_PA(){

    $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
	$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
    $title['title'] = " Manage Ledger | iDrive Tutorial";
    $gen_notif['count'] =$this->PR_Model->count_notif();
    $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
    $data['table_pa'] = $this->Finance_model->gen_table_pa();
    $this->load->view('templates/header',$title);
    $this->load->view('templates/navbar',$gen_notif);
    $this->load->view('ledger/gen_pa_ledger',$data);
    $this->load->view('templates/footer');
    $this->load->view('finance_temp/finance_scripts');

}

// Select supplier
public function autosearch_supplier(){
	$query ='';

	if ($this->input->post('supplier')) {
		$query = $this->input->post('supplier');
	}

	$data = $this->Finance_model->supplier_search($query);

	if ($data->num_rows() > 0)
	 {
        /*------Start--------*/ 
		?>

<!-- Purchasing Type -->
<div class=" row">
    <div class="card border-success mb-3" style="max-width: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <?=form_open('FinanceCtrl/checkbox')?>
        <div class="card-body">
            <table class="table my-0 w-100 row-border-none" id="approve">
                <thead class="mb-2">
                    <tr>
                        <th id="table_style">Purchase Invoice No.</th>
                        <th id="table_style" class="d-none d-xl-table-cell">Total Amount</th>
                        <th id="table_style" class="d-none d-xl-table-cell">Payment Method</th>
                        <th id="table_style" class="d-none d-xl-table-cell">Due Date</th>
                        <th id="table_style" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data->result() as $row) {
                                ?>
                    <tr>
                        <td><?=$row->purchase_invoice_no?></td>
                        <td class="d-none d-xl-table-cell"><i class="fa-solid fa-peso-sign"></i><?=$row->total_amount?>
                        </td>
                        <td class="d-none d-xl-table-cell"><?=ucfirst($row->payment_method)?></td>
                        <td class="d-none d-xl-table-cell"><?=$row->due_date?></td>

                        <td class="text-center">
                            <input type="checkbox" name="check_value[]" value="<?=$row->PI_ID?>"
                                style="cursor:pointer;">

                        </td>

                    </tr>


                    <?php

}?>
                </tbody>
            </table>
            <div class="text-end mt-3">
                <input type="submit" name="btn_check" value="Proceed" class="btn_save">
            </div>
        </div>
        <?=form_close();?>
    </div>
</div>

<?php
/*---------End-------------*/ 
}
else
{
?>
<div>

    <h2 class="text-center text-danger mt-4"><i class="fa-solid fa-circle-exclamation fa-2xl"></i><br><br>No Data
        Found
    </h2>
</div>
<?php
}
}


/*-------POST TO ACCOUNTS PAYABLE LEDGER-------*/ 

public function Post_to_ledger(){

    if ($this->input->post('btn_post')) {
        $response = $this->Finance_model->insert_ap_ledger();

        if ($response) 
    {
        $this->session->set_flashdata('create_user_success','Successfully Posted!');
                    
    }
    else
    {
    $this->session->set_flashdata('create_user_error',' Create Failed!');		
    }

redirect('FinanceCtrl/finance_manage_PI');
    }
}


/*-------SMS FEATURE-------*/ 
public function send_sms_twillio()
	{
		$message = $this->input->post('message');  #Message Content base on input
		$contact = $this->input->post('contact');
		$sid = 'AC29558b400ac09971309daf828558026f';
		$token = 'cc2224ef6eea93a635018f1b188ce852';
		$twilio_client = new Client($sid, $token);
		$phone = '+12512734601'; #Twilio Default No.

		#This section creates the message body
		try {                                   #change reciever no.
			$twilio_client->messages->create('+63' . $contact, [
				'body' => $message,
				'from' => $phone
			]);
			echo '<script>alert(SMS has been sent!)</script>';
			 #Change to Notification instead of message
		} catch (Exception $ex) {
			//echo 'SMS failed due to ' . $ex->getMessage(); #Change to Notification instead of message
			echo '<script>alert(SMS failed to send please try again)</script>';
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
		$output = curl_exec( $ch );
        echo '<script>alert(SMS has been sent!)</script>';
		curl_close ($ch);
		}  catch (Exception $ex) {
			//echo 'SMS failed due to ' . $ex->getMessage(); #Change to Notification instead of message
			echo '<script>alert(SMS failed to send please try again!)</script>';
		}
		
	}

/*-------SMS FEATURE-------*/ 

/*AP BILLS TO VOUCHER*/ 

    public function ap_bills_voucher($id){
        $this->submit_ap_bills_voucher();
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $data['display_voucher'] = $this->Finance_model->auto_number_voucher();
        $data['ap_bills_voucher'] = $this->Finance_model->ap_bills_voucher($id);
        $title['title'] = "Voucher | iDrive Tutorial";
        
   $data['sms'] = $this->PR_Model->get_user();//sms
   $data['sms_branch'] = $this->PR_Model->sms_branch();//sms
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
        $this->load->view('finance/ap_bills_voucher',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
}
    public function submit_ap_bills_voucher(){

        if ($this->input->post('btn_voucher')) {

            $response = $this->Finance_model->submit_bills();
            if ($response) 
            {
                //$this->send_sms();
                $this->session->set_flashdata('create_user_success','Successfully Created!');
            }
            else
            {
                $this->session->set_flashdata('create_user_error','Create Failed!');
            }
            redirect('FinanceCtrl/finance_manage_AP');
        }

    }

    public function ap_view_voucher($id){
        $this->unseen($id);
        $fin_notif['fin_notif_voucher'] =$this->Finance_model->fin_count_voucher_notif();
        $fin_notif['fin_manage_voucher'] =$this->Finance_model->fin_manage_voucher_notif();
        $title['title'] = "Voucher | iDrive Tutorial";
        $data['ap_view_voucher'] = $this->Finance_model->ap_view_voucher($id);
        $this->load->view('templates/header',$title);
        $this->load->view('finance_temp/navbar',$fin_notif);
        $this->load->view('finance/ap_view_voucher',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }



    public function manager_ap_view_voucher($id){

        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] =$this->PR_Model->branch_count_notif();
        $title['title'] = "Voucher | iDrive Tutorial";
        $data['ap_view_voucher'] = $this->Finance_model->ap_view_voucher($id);
        $this->load->view('templates/header',$title);
        $this->load->view('branch_temp/navbar',$notif);
        $this->load->view('finance/manager_view_ap_voucher',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }

    public function manager_view_PV($id){
      
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] =$this->PR_Model->branch_count_notif();
        $data['display_paledger'] = $this->Finance_model->auto_number_pa_ledger();
        $title['title'] = " Manage Payment Voucher | iDrive Tutorial"; 
        $data['view_pi'] = $this->Finance_model->view_voucher($id);
        $data['list_voucher'] = $this->Finance_model->list_voucher($id);
        $data['list_voucher1'] = $this->Finance_model->list_voucher1($id);
        $this->load->view('templates/header',$title);
        $this->load->view('branch_temp/navbar',$notif);
		$this->load->view('finance/manager_view_voucher',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }
    public function manager_table_voucher(){

        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] =$this->PR_Model->branch_count_notif();
        $title['title'] = "Voucher | iDrive Tutorial";
        $data['manager_tbl_voucher'] = $this->Finance_model->manager_tbl_voucher();
        $this->load->view('templates/header',$title);
        $this->load->view('branch_temp/navbar',$notif);
        $this->load->view('finance/manager_table_voucher',$data);
        $this->load->view('templates/footer');
        $this->load->view('finance_temp/finance_scripts');
    }
   
}