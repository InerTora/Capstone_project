<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BranchModel extends CI_Model {
    public function get_all_branch(){
        $query = $this->db->get('tbl_branch');
        return $query->result();
    }
   public function add_branch() {
        $data = array (
            'branch_name' => ucwords((string)$this->input->post('txtbranch')),
            'contact' => (string) $this->input->post('txtcontact'),
            'street' => ucwords((string) $this->input->post('txtstreet')),
            'barangay' => ucwords((string) $this->input->post('txtbarangay')),
            'city' => ucwords((string)$this->input->post('txtcity')),
            'province' => ucwords((string)$this->input->post('txtprovince'))
        );
        $response = $this->db->insert('tbl_branch', $data);
        if ($response) {
             return $this->db->insert_id();
        }else{
             return FALSE;
        }
    }
    public function get_branch($id){

        $this->db->where('branch_id',$id);
        $query = $this->db->get('tbl_branch');
        $row = $query->row();
        return $row;
    }

    public function update_branch()
    {
        $branch_id =(int) $this->input->post('branch_id');
     $data =array(

        'branch_name' => ucwords((string) $this->input->post('txtBranch')),
        'contact' => (string) $this->input->post('txtContact'),
        'street' => ucwords((string) $this->input->post('txtStreet')),
        'barangay' => ucwords((string) $this->input->post('txtBarangay')),
        'city' => ucwords((string) $this->input->post('txtCity')),
        'province' => ucwords((string) $this->input->post('txtProvince')),
     );
        $this->db->where('branch_id',$branch_id);
        $response =$this->db->update('tbl_branch',$data);
        if ($response) {
            return $branch_id;
        }else{

            return false;
        }
    }
    
    public function branch_search($data){
        $this->db->select('*');
        $this->db->from('tbl_branch');
        
        if ($data != '') {
            $this->db->like('branch_name',$data);
            $this->db->or_like('branch_id',$data);
            
        }
        return $this->db->get();
    
    }

    public function getStatus($id){

        $data = array(
         'status'=>'deactivated');
        $this->db->where('branch_id',$id);
         
        $response =$this->db->update('tbl_branch',$data);
        
             if ($response) {
                 return $id;
             }else{
                 return false;
             }
       }
     
       public function getStatus_active($id){
     
         $data = array(
          'status'=>'active');
         $this->db->where('branch_id',$id);
          
         $response =$this->db->update('tbl_branch',$data);
         
              if ($response) {
                  return $id;
              }else{
                  return false;
              }
        }
}