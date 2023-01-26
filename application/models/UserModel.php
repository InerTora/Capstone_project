<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function getbranch_list(){
        $this->db->select('*');
        $this->db->from('tbl_branch');
        $this->db->where('status','active');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_branch($id){
        $this->db->where('branch_id',$id);
        $query = $this->db->get('tbl_branch');
        $row = $query->row();
        return $row;
    }
    public function other_branch(){
        $branch = $_SESSION['branch_id'];
        $this->db->select('*');
        $this->db->from('tbl_branch');
        $this->db->where('branch_id',$branch);
        return $this->db->get()->row();
    }
    
    public function add_user() {
        $otp_code = rand(100000,999999);
        $data = array (

            'First_Name' => ucwords((string)$this->input->post('fname')),
            'Middle_Name' => ucwords((string) $this->input->post('mname')),
            'Last_Name' => ucwords((string) $this->input->post('lname')),
            'Position' => (string) $this->input->post('position'),
            'branch_id ' => (string)$this->input->post('branch'),
            'Username' => (string)$this->input->post('username'),
            'Password' => (string) $this->input->post('password'),
            'contact_no' => (string) $this->input->post('contact'),
            'OTP' => $otp_code
        );
        $response = $this->db->insert('tbl_user', $data);
        if ($response) {

             return $this->db->insert_id();
        }else{
             return FALSE;
        }
    }

    public function get_user($id){
        $this->db->select('*');
        $this->db->from('tbl_user user');
        $this->db->join('tbl_branch branch','user.branch_id = branch.branch_id');
        $this->db->where('User_ID',$id);
        $query = $this->db->get();
        return $query->row();
    }
    public function update_user()
    {
     $user_id =(int) $this->input->post('user_id');
     $data =array(

        'First_Name' => ucwords((string)$this->input->post('fname')),
        'Middle_Name' => ucwords((string) $this->input->post('mname')),
        'Last_Name' => ucwords((string) $this->input->post('lname')),
        'Position' => (string) $this->input->post('position'),
        'branch_id ' => (string)$this->input->post('branch'),
        'Username' => (string)$this->input->post('username'),
        'Password' => (string) $this->input->post('password'),
        'contact_no' => (string) $this->input->post('contact'),
     );
        $this->db->where('User_ID',$user_id);
        $response =$this->db->update('tbl_user',$data);
        if ($response) {
            return $user_id;
        }else{

            return false;
        }
    }

    public function update_profile()
    {
        $user_id =(int) $this->input->post('user_id');
     $data =array(

        'First_Name' => (string)$this->input->post('fname'),
        'Middle_Name' => (string) $this->input->post('mname'),
        'Last_Name' => (string) $this->input->post('lname'),
        'Username' => (string)$this->input->post('username'),
        'Password' => (string) $this->input->post('password'),
     );
        $this->db->where('User_ID',$user_id);
        $response =$this->db->update('tbl_user',$data);
        if ($response) {
            return $user_id;
        }else{

            return false;
        }
    }

  public function is_personal_information_exist($id)
  {
      $this->db->where('user_id',$id);
      $query  = $this->db->get('tbl_user');
      $row = $query->row();

      if($row){
        return TRUE;
      }
      return  FALSE;
      }

  
  public function update_profile_picture_post($file_name)
  {
      $user_id = (int) $this->input->post('user_id');
      
     $this->delete_actual_profile_picture($user_id);

     
      $data = array(
          'user_id' => $user_id,
          'image' => $file_name
      );
      if ($this->is_personal_information_exist($user_id))
      {
          $this->db->where('user_id',$user_id);
          $response =$this->db->update('tbl_user',$data);
          if ($response) {
              return $user_id;
          }else{
  
              return false;
          }
          
      }else{
          
          $response =$this->db->insert('tbl_user',$data);
          if ($response) {
              return $this->db->insert_id();
          }else{
  
              return FALSE;
          }

      }
  
  }

  public function delete_actual_profile_picture($id)
  {
      $data = $this->get_user($id);
      if(isset($data->image) && !empty($data->image)) {

          $file_name = './uploads/'.$data->image;
      
              if(file_exists($file_name))
              {
                  return unlink($file_name);
          }
          return true;
      }

  }
  
  public function getStatus($id){

    $data = array(
     'Status'=>'deactivated');
    $this->db->where('User_ID',$id);
     
    $response =$this->db->update('tbl_user',$data);
    
         if ($response) {
             return $id;
         }else{
             return false;
         }
   }
 
   public function getStatus_active($id){
 
     $data = array(
      'Status'=>'active');
     $this->db->where('User_ID',$id);
      
     $response =$this->db->update('tbl_user',$data);
     
          if ($response) {
              return $id;
          }else{
              return false;
          }
    }

    public function page(){
        
        $this->db->select('*');
        $this->db->from('tbl_user AS user');
        $this->db->join('tbl_branch AS branch', 'user.branch_id = branch.branch_id');
        return $this->db->get()->result();
    }
}