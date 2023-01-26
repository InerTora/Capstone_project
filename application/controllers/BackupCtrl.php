<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackupCtrl extends CI_Controller {


    public function __construct(){
        parent:: __construct();
        $this->load->model('Manager_model');
		$is_logged_in = $this->Manager_model->is_user_logged_in();
		
	if (!$is_logged_in) {
		redirect('Accounts/login');
	}
        $this->load->model('PR_Model');
        $this->load->model('Car_Model');
        $this->load->model('Finance_Model');
		
    }
	public function index()
	{
                $gen_notif['notif_voucher'] =$this->Finance_Model->gen_count_voucher_notif();
		$gen_notif['manage_voucher'] =$this->Finance_Model->manage_voucher_notif();
                
                $gen_notif['count'] =$this->PR_Model->count_notif();
                $gen_notif['manage_notif'] = $this->PR_Model->manage_notif();
                $data['title'] = "Backup & Restore | iDrive Tutorial";
                $this->load->view('templates/header',$data);
                $this->load->view('templates/navbar',$gen_notif);
                $this->load->view('Backup/Backup');
                $this->load->view('templates/footer');
                $this->load->view('templates/script');
	}

    public function export(){
        //load helpers
                $this->load->helper('file');
                $this->load->helper('download');
                $this->load->library('zip');
        //load database
                $this->load->dbutil();
        //create format
                $db_format = array('format' => '.sql', 'filename' => 'idrive_database.sql');
                $backup = &$this->dbutil->backup($db_format);
        // file name
                $dbname ='idrive_database.sql';
                $save = '.assets/db_backup/' . $dbname;
        // write file
                write_file($save, $backup);
        
        // and force download
                force_download($dbname, $backup);
        }

        public function import(){

                if ($this->input->post('btn_import')) {
                        $config['upload_path'] = './upload/database/';
                        $config['allowed_types'] = '*';
                        $config['overwrite'] = TRUE;
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('import')){
                                $this->session->set_flashdata('create_user_error', 'Backup Failed!');
                        }
                        else
                        {
                            $this->import2();
                            $this->session->set_flashdata('create_user_success','Backup Successfully Restored!');
                        }
                        redirect('BackupCtrl/');
                    }       
        }


        public function import2(){
 
                $host = 'mysql5030.site4now.net';//DB Hosting Name
                $UN  = 'a8e5ce_idrive'; //Db Username
                $pwd='skylie2121'; // Db Password
                $database_name = 'db_a8e5ce_idrive'; // Db Name
                $db_file = $this->input->post('back');
                $connection = mysqli_connect($host, $UN, $pwd, $database_name);
               

               $filename = 'h:/root/home/skylie2121-001/www/site1/idrive_driving_tutorial.com/upload/database/idrive_database.sql';//File Path with default sql file name

               $handle = fopen($filename,"r+");
               $contents = fread($handle,filesize($filename));
               
               $sql = explode(';',$contents);
               foreach($sql as $query){
               $result = mysqli_query($connection,$query);    
               }
               fclose($handle);   	             
}

public function import3(){
 
        $host = 'localhost';//DB Hosting Name
        $UN  = 'root'; //Db Username
        $pwd=''; // Db Password
        $database_name = 'idrive_database'; // Db Name
        $db_file = $this->input->post('back');
        $connection = mysqli_connect($host, $UN, $pwd, $database_name);
       

       $filename = 'C:/xampp/htdocs/iDrive_Driving_Tutorial.com/upload/database/idrive_database.sql';//File Path with default sql file name

       $handle = fopen($filename,"r+");
       $contents = fread($handle,filesize($filename));
       
       $sql = explode(';',$contents);
       foreach($sql as $query){
       $result = mysqli_query($connection,$query);
       
            
       }	
       fclose($handle);   
}

}