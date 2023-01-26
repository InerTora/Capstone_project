<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class PurchaseOrderCtrl extends CI_Controller {

        public function __construct(){
                parent:: __construct();
               
                $this->load->model('Manager_model');
                        $is_logged_in = $this->Manager_model->is_user_logged_in();
                        
                if (!$is_logged_in) {
                        redirect('Accounts/login');
                }
                date_default_timezone_set('Asia/Manila');
               $this->load->model('PR_Model');
               $this->load->model('PO_Model');
               $this->load->model('Finance_model');
            }
        
	public function index()
	{
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
		$notif['count'] =$this->PR_Model->branch_count_notif();
            $title['title'] = "Create Purchase Order | iDrive Tutorial";
            $this->load->view('templates/header',$title);
            $this->load->view('branch_temp/navbar',$notif);
            $this->load->view('Purchase_Order/Branch_create_PO');
            $this->load->view('templates/footer');
            $this->load->view('templates/script');
        }
	    public function create_PO($id)
        {
                $this->submit_PO($id);
                $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
                $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
                $title['title'] = "Create Purchase Order | iDrive Tutorial";
                $gen_notif['count'] =$this->PR_Model->count_notif();
                $data['code'] = $this->PR_Model->code($id);
                $data['select'] = $this->PR_Model->select_one($id);
                $data['view'] = $this->PO_Model->view_all_PR($id);
                $data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
                $data['display_code'] =$this->PO_Model->auto_number_PO();
                $this->load->view('templates/header',$title);
                $this->load->view('templates/navbar',$gen_notif);
                $this->load->view('Purchase_Order/create_PO',$data);
                $this->load->view('templates/footer');
                $this->load->view('templates/script');
        }
        public function create_po_sr($id)
        {
                $this->submit_PO($id);
                $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
                $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
                $title['title'] = "Create Purchase Order | iDrive Tutorial";
                $gen_notif['count'] =$this->PR_Model->count_notif();
                $data['code'] = $this->PR_Model->code($id);
                $data['select'] = $this->PR_Model->select_one($id);
                $data['view_sr'] = $this->PO_Model->view_all_SR($id);
                $data['display_code'] =$this->PO_Model->auto_number_PO();
                $data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
                $this->load->view('templates/header',$title);
                $this->load->view('templates/navbar',$gen_notif);
                $this->load->view('Purchase_Order/create_po_sr',$data);
                $this->load->view('templates/footer');
                $this->load->view('templates/script');
        }

        
        public function submit_PO($id){
                
                if ($this->input->post('submit_po')) {

                       $response =$this->PO_Model->create_po();
                        if ($response) {
                                $this->session->set_flashdata('create_user_success','Successfully Created');
                                
                        }else{
                                $this->session->set_flashdata('create_user_error', 'Create Failed'); 
                        
                }
                redirect('PurchaseOrderCtrl/approved_po');
                }
        }

        public function branch_create_PO($id)
        {
                $this->branch_submit_PO();
                $title['title'] = "Create Purchase Order | iDrive Tutorial";
                $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
                $notif['count'] =$this->PR_Model->branch_count_notif();
                $data['code'] = $this->PR_Model->code($id);
                $data['select'] = $this->PR_Model->select_one($id);
                //$data['view'] = $this->PR_Model->view_all_PR($id);
                $data['get_branch'] = $this->PO_Model->branch($id);
                $data['display_code'] =$this->PO_Model->auto_number_PO();
                $data['view'] = $this->PO_Model->view_all_PR($id);
                $data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
                $this->load->view('templates/header',$title);
                $this->load->view('branch_temp/navbar',$notif);
                $this->load->view('Purchase_Order/Branch_create_PO',$data);
                $this->load->view('templates/footer');
                $this->load->view('templates/script');
        }
        public function branch_create_po_sr($id)
        {
                $this->branch_submit_PO();
                $title['title'] = "Create Purchase Order | iDrive Tutorial";
                $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
                $notif['count'] =$this->PR_Model->branch_count_notif();
                $data['code'] = $this->PR_Model->code($id);
                $data['select'] = $this->PR_Model->select_one($id);
                $data['view_sr'] = $this->PO_Model->view_all_SR($id);
                $data['get_branch'] = $this->PO_Model->branch($id);
                $data['display_code'] =$this->PO_Model->auto_number_PO();
                $data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
                $this->load->view('templates/header',$title);
                $this->load->view('branch_temp/navbar',$notif);
                $this->load->view('Purchase_Order/Branch_create_po_sr',$data);
                $this->load->view('templates/footer');
                $this->load->view('templates/script');
        }
        public function branch_submit_PO(){
                
                if ($this->input->post('submit_po')) {
    
                       $response = $this->PO_Model->create_po();
                       if ($response) {
                        $this->session->set_flashdata('create_user_success','Successfully Created');
                        
                }else{
                        $this->session->set_flashdata('create_user_error', 'Create Failed'); 

                }
                redirect('PurchaseOrderCtrl/branch_approved_po');
                }
        }


        public function manage_PO()
        {
                
                $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();

                $title['title'] = "Create Purchase Order | iDrive Tutorial";
                $gen_notif['count'] =$this->PR_Model->count_notif();
                $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
                $data['table_po'] = $this->PO_Model->table_po();
                $data['table_po_branch'] = $this->PO_Model->table_po_branch();
                $this->load->view('templates/header',$title);
                $this->load->view('templates/navbar',$gen_notif);
                $this->load->view('Purchase_Order/table_po',$data);
                $this->load->view('templates/footer');
                $this->load->view('Purchase_Request/purchase_script');
               
        }

        public function view_ledger()
        {
                
                $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
                $gen_notif['count'] =$this->PR_Model->count_notif();
		$gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
                $this->load->view('templates/header');
                $this->load->view('templates/navbar',$gen_notif);
                $this->load->view('ledger/view_ledger');
                $this->load->view('templates/footer');
                $this->load->view('templates/script');
        }


        public function view_order($id)
        {
                
                $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
                $title['title'] = "View Purchase Order | iDrive Tutorial";
                $data['code'] = $this->PR_Model->code($id);
                $gen_notif['count'] =$this->PR_Model->count_notif();
                $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
                $data['view_po'] = $this->PO_Model->View_oder($id);
                $data['get_po'] = $this->PO_Model->get_po($id);
                $data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
                $this->load->view('templates/header',$title);
                $this->load->view('templates/navbar',$gen_notif);
                 $this->load->view('Purchase_Order/View_PO',$data);
                $this->load->view('templates/footer');
                $this->load->view('templates/script');
             
        }
        public function view_order_sr($id)
        {
                
                $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
                $title['title'] = "View Purchase Order | iDrive Tutorial";
                $data['code'] = $this->PR_Model->code($id);
                $gen_notif['count'] =$this->PR_Model->count_notif();
                $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
                $data['view_po'] = $this->PO_Model->View_oder($id);
                $data['get_po_sr'] = $this->PO_Model->get_po_sr($id);
                $data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
                $this->load->view('templates/header',$title);
                $this->load->view('templates/navbar',$gen_notif);
                 $this->load->view('Purchase_Order/view_order_sr',$data);
                $this->load->view('templates/footer');
                $this->load->view('templates/script');
             
        }
       public function branch_manage_PO()
       {
               $title['title'] = "Create Purchase Order | iDrive Tutorial";
               $notif['count'] =$this->PR_Model->branch_count_notif();
               $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
               $data['table_po'] = $this->PO_Model->table_po();
               $this->load->view('templates/header',$title);
               $this->load->view('branch_temp/navbar',$notif);
               $this->load->view('Purchase_Order/branch_table_po',$data);
               $this->load->view('templates/footer');
               $this->load->view('Purchase_Request/purchase_script');
       }

       

public function branch_view_order($id)
{
        
        $title['title'] = "View Purchase Order | iDrive Tutorial";
        $this->load->view('templates/header',$title);
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
	$notif['count'] =$this->PR_Model->branch_count_notif();
        $data['view_po'] = $this->PO_Model->View_oder($id);
        $data['get_branch'] = $this->PO_Model->branch($id);
        $data['code'] = $this->PR_Model->code($id);
        $data['get_po'] = $this->PO_Model->get_po($id);
        $data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
        $this->load->view('branch_temp/navbar',$notif);
         $this->load->view('Purchase_Order/branch_view_PO',$data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script');
}

public function branch_view_order_sr($id)
{
        
        $title['title'] = "View Purchase Order | iDrive Tutorial";
        $this->load->view('templates/header',$title);
        $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
	$notif['count'] =$this->PR_Model->branch_count_notif();
        $data['view_po'] = $this->PO_Model->View_oder($id);
        $data['get_branch'] = $this->PO_Model->branch($id);
        $data['code'] = $this->PR_Model->code($id);
        $data['get_po_sr'] = $this->PO_Model->get_po_sr($id);
        $data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
        $this->load->view('branch_temp/navbar',$notif);
         $this->load->view('Purchase_Order/branch_view_order_sr',$data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script');
}

public function print($id){
  date_default_timezone_set('Asia/Manila');
    $data['approve_by'] = $this->PO_Model->approved_by($id);
    $data['get_po'] = $this->PO_Model->get_po($id);
   
    $data['get_branch'] = $this->PO_Model->print_po_details();
    $data['view_po'] = $this->PO_Model->View_oder($id);
    $html = $this->load->view('Purchase_Order/print_po',$data,true);
    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [ 203.2, 279.4]]);
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML( $html);
    $mpdf->Output();
   }

   public function driver_print_po($id){
        date_default_timezone_set('Asia/Manila');
          $data['approve_by'] = $this->PO_Model->approved_by($id);
          $data['get_po'] = $this->PO_Model->get_po($id);
          
          $data['get_branch'] = $this->PO_Model->driver_print_po_details();
          $data['view_po'] = $this->PO_Model->View_oder($id);
          $html = $this->load->view('Purchase_Order/driver_print_po',$data,true);
         // $mpdf = new \Mpdf\Mpdf();
         $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [ 203.2, 279.4]]);
          $mpdf->WriteHTML( $html);
          $mpdf->Output();
         }
   public function print_sr($id){
        date_default_timezone_set('Asia/Manila');
          $data['approve_by'] = $this->PO_Model->approved_by($id);
          $data['get_po_sr'] = $this->PO_Model->get_po_sr($id);
        
          $data['get_branch'] = $this->PO_Model->print_po_details();
          $data['view_po'] = $this->PO_Model->View_oder($id);
        
          $html = $this->load->view('Purchase_Order/print_sr',$data,true);
          $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [ 203.2, 279.4]]);
          $mpdf = new \Mpdf\Mpdf();
          $mpdf->WriteHTML( $html);
          $mpdf->Output();
         }
         public function driver_print_sr($id){
                date_default_timezone_set('Asia/Manila');
                  $data['approve_by'] = $this->PO_Model->approved_by($id);
                  $data['get_po_sr'] = $this->PO_Model->get_po_sr($id);
                  $data['get_branch'] = $this->PO_Model->print_po_details();
                  $data['view_po'] = $this->PO_Model->View_oder($id);
                
                  $html = $this->load->view('Purchase_Order/driver_print_po_sr',$data,true);
                 
                  $mpdf = new \Mpdf\Mpdf();
                  $mpdf->WriteHTML( $html);
                  $mpdf->Output();
                 }

   public function approved_po()
   {
           $gen_notif['notif_voucher'] =$this->Finance_model->gen_count_voucher_notif();
           $gen_notif['manage_voucher'] =$this->Finance_model->manage_voucher_notif();
           $title['title'] = "Create Purchase Order | iDrive Tutorial";
           $gen_notif['count'] =$this->PR_Model->count_notif();
           $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
           $data['table_approved_po'] = $this->PO_Model->table_approved_po();
           $this->load->view('templates/header',$title);
           $this->load->view('templates/navbar',$gen_notif);
           $this->load->view('Purchase_Order/approved_po',$data);
           $this->load->view('templates/footer');
           $this->load->view('templates/script');
   }
   public function branch_approved_po()
   {
           $notif['manage_notif'] = $this->PR_Model->approve_by_gen();
	   $notif['count'] =$this->PR_Model->branch_count_notif();
           $title['title'] = "Create Purchase Order | iDrive Tutorial";
          
           $data['table_approved_po'] = $this->PO_Model->table_approved_po();
           $this->load->view('templates/header',$title);
           $this->load->view('branch_temp/navbar',$notif);
           $this->load->view('Purchase_Order/branch_approved_po',$data);
           $this->load->view('templates/footer');
           $this->load->view('templates/script');
   }

/*------------Driving Instructor----------------------*/


public function driver_table_po()
{
        $driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
	$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();
        $title['title'] = "Manage Purchase Request | iDrive Tutorial";
        $data['driver_table_po'] = $this->PO_Model->driver_table_po();
        $this->load->view('templates/header', $title);
        $this->load->view('Driver_Instructor/driver_nav', $driver_notif);
        $this->load->view('Driver_Instructor/driver_table_po',$data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script');

}

public function driver_create_po($id)
{
        $this->driver_submit_po();
        $title['title'] = "Create Purchase Order | iDrive Tutorial";
        $driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
	$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();
        $data['code'] = $this->PR_Model->code($id);
        $data['select'] = $this->PR_Model->select_one($id);
        $data['view'] = $this->PO_Model->view_all_PR($id);
        $data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
        $data['get_branch'] = $this->PO_Model->branch($id);
        $data['display_code'] =$this->PO_Model->auto_number_PO();
        $this->load->view('templates/header', $title);
        $this->load->view('Driver_Instructor/driver_nav', $driver_notif);
        $this->load->view('Driver_Instructor/driver_create_po',$data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script');
}

public function driver_submit_po(){
                
        if ($this->input->post('submit_po')) {

               $response = $this->PO_Model->create_po();
               if ($response) {
                $this->session->set_flashdata('create_user_success','Successfully Created');
                
        }else{
                $this->session->set_flashdata('create_user_error', 'Create Failed'); 

        }
        redirect('PurchaseOrderCtrl/driver_table_po');
        }
}


public function driver_create_sr($id)
{
        $this->driver_submit_sr();
        $title['title'] = "Create Purchase Order | iDrive Tutorial";
        $driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
	$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();
        $data['code'] = $this->PR_Model->code($id);
        $data['select'] = $this->PR_Model->select_one($id);
        $data['view_sr'] = $this->PO_Model->view_all_SR($id);
        $data['estimated_cost'] = $this->PR_Model->check_estimated_cost($id);
        $data['get_branch'] = $this->PO_Model->branch($id);
        $data['display_code'] =$this->PO_Model->auto_number_PO();
        $this->load->view('templates/header', $title);
        $this->load->view('Driver_Instructor/driver_nav', $driver_notif);
        $this->load->view('Driver_Instructor/driver_create_sr',$data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script');
}

public function driver_submit_sr(){
                
        if ($this->input->post('submit_po')) {

               $response = $this->PO_Model->create_po();
               if ($response) {
                $this->session->set_flashdata('create_user_success','Successfully Created');
                
        }else{
                $this->session->set_flashdata('create_user_error', 'Create Failed'); 

        }
        redirect('PurchaseOrderCtrl/driver_table_po');
        }
}


public function driver_manage_po()
{
        $title['title'] = "Create Purchase Order | iDrive Tutorial";
        $driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
	$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();
        $data['driver_manage_po'] = $this->PO_Model->driver_manage_po();

        $this->load->view('templates/header', $title);
        $this->load->view('Driver_Instructor/driver_nav', $driver_notif);
        $this->load->view('Driver_Instructor/driver_manage_po',$data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script');
}


        public function driver_view_po($id){
        
        $title['title'] = "View Purchase Order | iDrive Tutorial";
      
        $driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
	$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();
        $data['view_po'] = $this->PO_Model->View_oder($id);
        $data['get_branch'] = $this->PO_Model->branch($id);
        $data['code'] = $this->PR_Model->code($id);
        $data['get_po'] = $this->PO_Model->get_po($id);

         $this->load->view('templates/header', $title);
        $this->load->view('Driver_Instructor/driver_nav', $driver_notif);
        $this->load->view('Driver_Instructor/driver_view_po',$data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script');
     
}
        public function driver_view_po_sr($id){
        
        $title['title'] = "View Purchase Order | iDrive Tutorial";
      
        $driver_notif['manage_notif'] = $this->PR_Model->driver_forward_notif();
	$driver_notif['driver_count'] = $this->PR_Model->driver_count_notif();
        $data['view_po'] = $this->PO_Model->View_oder($id);
        $data['get_branch'] = $this->PO_Model->branch($id);
        $data['code'] = $this->PR_Model->code($id);
        $data['get_po_sr'] = $this->PO_Model->get_po_sr($id);

         $this->load->view('templates/header', $title);
        $this->load->view('Driver_Instructor/driver_nav', $driver_notif);
        $this->load->view('Driver_Instructor/driver_view_po_sr',$data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script');
     
}

}