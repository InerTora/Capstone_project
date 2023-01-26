<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Car_Model extends CI_Model {
public function add_car(){
   
    $data = array (
        'branch_id' =>strtoupper((string)$this->input->post('branch')),
        'plate_no' => strtoupper((string)$this->input->post('plate_no')),
        'brand' => ucwords((string) $this->input->post('brand')),
        'color' => ucwords((string) $this->input->post('color')),
        'chassis_no' => strtoupper((string) $this->input->post('chassis_no')),
        'date_Created ' => date('Y-m-d')
    );
    $response = $this->db->insert('tbl_vehicles', $data);
    if ($response) {

         return $this->db->insert_id();
    }else{
         return FALSE;
    }
}

public function table_car(){
    $this->db->select('*');
    $this->db->from('tbl_vehicles as vehicles');
    $this->db->join('tbl_branch as branch','vehicles.branch_id = branch.branch_id');
    $this->db->where('vehicles.status','active');
    $query = $this->db->get();
    return $query->result();
}

public function branch_table_car(){
    $branch = $_SESSION['branch_id'];
    $this->db->select('*');
    $this->db->from('tbl_vehicles');
    $this->db->where('status','active');
    $this->db->where('branch_id',$branch);
    $query = $this->db->get();
    return $query->result();
}



public function getcar($id){

    $this->db->select('*');
    $this->db->from('tbl_vehicles as vehicles');
    $this->db->where('car_id',$id);
    $this->db->join('tbl_branch as branch','vehicles.branch_id = branch.branch_id');
    $query = $this->db->get()->row();
    return $query;
}

public function update_car(){
    $car_id =(int) $this->input->post('car_id');
    $data = array (
        'branch_id' => strtoupper((string)$this->input->post('branch')),
        'plate_no' => strtoupper((string)$this->input->post('plate_no')),
        'brand' => ucwords((string) $this->input->post('brand')),
        'color' => ucwords((string) $this->input->post('color')),
        'chassis_no' => strtoupper((string) $this->input->post('chassis_no')),
        'date_updated' =>date('Y-m-d')
    );

    $this->db->where('car_id',$car_id);
        $response =$this->db->update('tbl_vehicles',$data);
        if ($response) {
            return $car_id;
        }else{

            return false;
        }
}

public function delete_car($id){

    $data = array(
     'status'=>'deactivated');
    $this->db->where('car_id',$id);
     
    $response =$this->db->update('tbl_vehicles',$data);
    
         if ($response) {
             return $id;
         }else{
             return false;
         }
   }
}