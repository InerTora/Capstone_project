<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager_model extends CI_Model {

    public function verify_login()
    {
        
        $username =(string) $this->input->post('txtusername');
        $password =(string) $this->input->post('txtpassword');

        $this->db->select('*');
        $this->db->from('tbl_user AS user');
        $this->db->join('tbl_branch AS branch','user.branch_id = branch.branch_id');
        $this->db->where('Username',$username);
        $this->db->where('Password',$password);
        $this->db->where('user.Status','active');
        $this->db->where('branch.status','active');
        
        $row = $this->db->get()->row();
        if ($row) 
        {
            $this->set_user_session($row);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

   
    public function set_user_session($row)
        {
            $newdata = array(
                'User_ID'=> $row->User_ID,
                'First_Name'=> ($row->First_Name),
                'Middle_Name'=> ($row->Middle_Name),
                'Last_Name'=> ($row->Last_Name),
                'Position'=> ($row->Position),
                'branch_id'=> ($row->branch_id),
                'Status'=> ($row->Status),
                'Username'=>($row->Username),
                'image'=> $row->image,
                'logged_in'=>TRUE,
                'contact_no'=>($row->contact_no)
            );
            
            $this->session->set_userdata($newdata);
        }

        public function is_user_logged_in(){

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE)
            {
              return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        
        public function logout()
        {
            session_destroy();
        }   
   public function check_email(){

    $email =$this->input->post('txtemail');

    $this->db->select('*');
    $this->db->from('tbl_user');
    $this->db->where('Username',$email);
    $row = $this->db->get()->row();
    return $row;

   }

   public function match_otp($id){
    $this->db->select('*');
    $this->db->from('tbl_user');
    $this->db->where('User_ID',$id);
    return $this->db->get()->row();
}


public function update_user()
{
 $user_id =(int) $this->input->post('user_id');
 $otp_code = rand(100000,999999);
 $data =array(

   
    'First_Name' => ucwords((string)$this->input->post('fname')),
    'Middle_Name' => ucwords((string) $this->input->post('mname')),
    'Last_Name' => ucwords((string) $this->input->post('lname')),
    'Position' => ucwords((string) $this->input->post('position')),
    'branch_id ' => (string)$this->input->post('branch_id'),
    'Username' => (string)$this->input->post('username'),
    'Password' => (string) $this->input->post('password'),
    'OTP'=>$otp_code
   
 );
    $this->db->where('User_ID',$user_id);
    $response =$this->db->update('tbl_user',$data);
    if ($response) {
        return $user_id;
    }else{

        return false;
    }
}


}