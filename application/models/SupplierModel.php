<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SupplierModel extends CI_Model {

    public function getbranch_list(){
        $query = $this->db->get('tbl_supplier');
        return $query->result();
    }

    public function add_supplier() {
        $branch = $_SESSION['branch_id'];
        $data = array (
            'payable_type' =>(string)$this->input->post('payable_type'),
            'supplier_name' =>ucwords((string) $this->input->post('supplier_name')),
            'branch_id' => $branch,
            'contact' => (string) $this->input->post('contact'),
            'street' => ucwords((string) $this->input->post('street')),
            'barangay' => ucwords((string) $this->input->post('barangay')),
            'city' => ucwords((string)$this->input->post('city')),
            'province' => ucwords((string)$this->input->post('province')),
            'date_created' =>date('Y-m-d')
        
        
        );
        $response = $this->db->insert('tbl_supplier', $data);
        if ($response) {
             return $this->db->insert_id();
        }else{
             return FALSE;
        }
    }


    public function get_supplier($id){

        $this->db->select('*');
        $this->db->from('tbl_branch as branch');
        $this->db->join('tbl_supplier as supplier','supplier.branch_id = branch.branch_id');
        $this->db->where('supplier_id',$id);
        $row =  $this->db->get()->row();
        return $row;
    }


    public function update_supplier(){

        $branch = $_SESSION['branch_id'];
        $supplier_id =(int) $this->input->post('supplier_id');
     $data =array(
        'payable_type' =>(string)$this->input->post('payable_type'),
        'supplier_name' => ucwords((string) $this->input->post('supplier_name')),
        'contact' => (string) $this->input->post('contact'),
        'street' => (string) $this->input->post('street'),
        'barangay' => ucwords((string) $this->input->post('barangay')),
        'city' => ucwords((string)$this->input->post('city')),
        'province' => ucwords((string)$this->input->post('province')),
        'branch_id' => $branch
        
     );
        $this->db->where('supplier_id',$supplier_id);
        $response =$this->db->update('tbl_supplier',$data);
        if ($response) {
            return $supplier_id;
        }else{

            return false;
        }
    }
    public function update_supplier1(){
        $branch = $_SESSION['branch_id'];
        $supplier_id =(int) $this->input->post('supplier_id');
     $data =array(
        'payable_type' =>(string)$this->input->post('payable_type'),
        'contact' => (string) $this->input->post('contact'),
        'street' => ucwords((string) $this->input->post('street')),
        'barangay' => ucwords((string) $this->input->post('barangay')),
        'city' => ucwords((string)$this->input->post('city')),
        'province' => ucwords((string)$this->input->post('province')),
        'branch_id' => $branch
        
     );
        $this->db->where('supplier_id',$supplier_id);
        $response =$this->db->update('tbl_supplier',$data);
        if ($response) {
            return $supplier_id;
        }else{

            return false;
        }
    }


    public function getStatus($id){

        $data = array(
         'status'=>'deactivated');
        $this->db->where('supplier_id',$id);
         
        $response =$this->db->update('tbl_supplier',$data);
        
             if ($response) {
                 return $id;
             }else{
                 return false;
             }
       }
     
       public function getStatus_active($id){
     
         $data = array(
          'status'=>'active');
         $this->db->where('supplier_id',$id);
          
         $response =$this->db->update('tbl_supplier',$data);
         
              if ($response) {
                  return $id;
              }else{
                  return false;
              }
        }

        public function supplier_table(){
            $branch = $_SESSION['branch_id'];
            $this->db->select('*');
            $this->db->from('tbl_branch as branch');
            $this->db->join('tbl_supplier as supplier','supplier.branch_id = branch.branch_id');
            return $this->db->get()->result();
        }

        public function supplier_branch(){
            $branch = $_SESSION['branch_id'];
            $this->db->select('*');
            $this->db->from('tbl_supplier');
            return $this->db->get()->result();
        }

  
}