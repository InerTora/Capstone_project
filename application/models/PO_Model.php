<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PO_Model extends CI_Model {

  public function approved_by($id){
    $this->db->select('*');
    $this->db->from('tbl_purchase_no');
    $this->db->where('purchase_request_id',$id);
    $query = $this->db->get()->row();
    return $query;
  }
    public function auto_number_PO(){
       $year = date('Y');
        $text = "PO".'-'.$year;
        $query = "SELECT max(Purchase_order_No) as code_auto from tbl_purchase_order";
        $data = $this->db->query($query)->row_array();
        if($data["code_auto"]!=NULL){
        $max_code = $data['code_auto'];
        $max_code2 =  (int)substr($max_code,8,5);
        $codecount = $max_code2+1;
        $code_auto = $text.'-'.sprintf('%03s',$codecount);
        return $code_auto;
        }
          else{
              return $text.'-'.sprintf('%03s',1 );
          }
}

public function create_po(){
  $this->updateRef();
    $payment = $this->input->post('payment_terms');
    $PO_Code = $this->input->post('PO_code');
    $pr_id = $this->input->post('PR_id');
    $date = $this->input->post('date');
    $branch_id = $_SESSION['branch_id'];
    $supplier_id = $this->input->post('supplier_id');
    $User_ID = $this->input->post('user_id');
    $total_amount = $this->input->post('total_amount');
    $data = array(
        'payment_method' =>(string)$payment,
        'purchase_order_no' =>(string)$PO_Code,
        'po_date' =>$date,
        'purchase_request_id'=>$pr_id,
        'branch_id'=>$branch_id,
        'supplier_id' =>$supplier_id,
        'isCreated'=>true,
        'User_ID'=>$User_ID,
        'total_amount'=>$total_amount,
        

    );
    $response = $this->db->insert('tbl_purchase_order', $data);

    if ($response) {

         return $this->db->insert_id();
    }else{
         return FALSE;
    }
}
public function view_all_PR($id){
  $this->db->select('*');
  $this->db->from('tbl_purchase_no AS purc');
  $this->db->join('tbl_purchase_request AS PR','purc.purchase_request_id= PR.purchase_request_no');
  $this->db->join('tbl_vehicles AS vehicles','PR.car_id = vehicles.car_id');
  $this->db->join('tbl_user AS user','purc.User_ID = user.User_ID');
  $this->db->where('purchase_request_id',$id);
  $this->db->where('isStatus','1');
  $this->db->where('isPending','approved');

  
  $query = $this->db->get();
  return $query->result();
}

public function view_all_SR($id){
  $this->db->select('*');
  $this->db->from('tbl_purchase_no AS purc');
  $this->db->join('tbl_purchase_request AS PR','purc.purchase_request_id= PR.purchase_request_no');
  $this->db->join('tbl_user AS user','purc.User_ID = user.User_ID');
  $this->db->where('purchase_request_id',$id);
  $this->db->where('isStatus','1');
  $this->db->where('isPending','approved');

  $query = $this->db->get();
  return $query->result();
}
public function updateRef()
{
  $pr_id = $this->input->post('PR_id');
  $ref = array(
    'pr_ref' =>true
  );
  $this->db->where('purchase_request_id',$pr_id);
  $this->db->update('tbl_purchase_no',$ref);
  return $pr_id;
}
public function manage_po($data){
    $branch = $_SESSION['branch_id'];
    $this->db->select('order.*,supplier.supplier_name, purc.*');
    $this->db->from('tbl_purchase_no AS purc');
    $this->db->join('tbl_purchase_order AS order','purc.purchase_request_id = order.purchase_request_id');
    $this->db->join('tbl_supplier AS supplier','purc.supplier_id = supplier.supplier_id');
   $this->db->where('order.branch_id',$branch);
     if ($data != '') {
      //$this->db->like('purchase_request_no',$data);
      $this->db->like('PO_ID',$data);
      $this->db->where('order.branch_id',$branch);
      $this->db->or_like('Purchase_order_No',$data);
      $this->db->where('order.branch_id',$branch);
      $this->db->or_like('supplier_name',$data);
      $this->db->where('order.branch_id',$branch);
  }
  return $this->db->get();
  }
/*TO JOIN Purchase order table and supplier table*/ 
  public function table_po(){
    $branch = $_SESSION['branch_id'];
    $this->db->select('*');
    $this->db->from('tbl_purchase_order as order');
    $this->db->join('tbl_supplier AS supplier','order.supplier_id = supplier.supplier_id');
    $this->db->join('tbl_user AS user','order.User_ID = user.User_ID');
    $this->db->where('order.branch_id',$branch);
   return $this->db->get()->result();
  }
  
  public function table_po_branch(){
    $branch = $_SESSION['branch_id'];
    $this->db->select('*');
    $this->db->from('tbl_purchase_order as order');
    $this->db->join('tbl_supplier AS supplier','order.supplier_id = supplier.supplier_id');
    $this->db->join('tbl_branch AS branch','order.branch_id = branch.branch_id');
    $this->db->join('tbl_user AS user','order.User_ID = user.User_ID');
    $this->db->where_not_in('order.branch_id',$branch);
   return $this->db->get()->result();
  }
  
  public function View_oder($id){

    $this->db->select('*');
    $this->db->from('tbl_purchase_no AS purc');
    $this->db->join('tbl_purchase_order AS order','purc.purchase_request_id = order.purchase_request_id');
    $this->db->join('tbl_user AS user','order.User_ID = user.User_ID');
    $this->db->join('tbl_supplier AS supplier','purc.supplier_id = supplier.supplier_id');
    $this->db->where('PO_ID',$id);
    return $this->db->get()->row();
  }  
  public function print_po_details(){
    $branch = $_SESSION['branch_id'];
    $this->db->select('*');
    $this->db->from('tbl_purchase_no AS purc');
    $this->db->join('tbl_branch AS branch','purc.branch_id = branch.branch_id');
    
    $this->db->where('purc.branch_id',$branch);
    return $this->db->get()->row();
  }
  public function driver_print_po_details(){
    $branch = $_SESSION['branch_id'];
    $this->db->select('*');
    $this->db->from('tbl_purchase_no AS purc');
    $this->db->join('tbl_branch AS branch','purc.branch_id = branch.branch_id');
    //$this->db->join('tbl_user AS user','purc.forwardedby = user.User_ID');
    
    $this->db->where('purc.branch_id',$branch);
    return $this->db->get()->row();
  }


  public function get_po($id){
    $this->db->select('*');
    $this->db->from('tbl_purchase_no AS purc');
    $this->db->join('tbl_purchase_order AS order','purc.purchase_request_id = order.purchase_request_id');
    $this->db->join('tbl_purchase_request AS request','purc.purchase_request_id = request.purchase_request_no');
    $this->db->join('tbl_vehicles AS vehicles','request.car_id = vehicles.car_id');
    $this->db->where('PO_ID',$id);
    $this->db->where('isStatus','1');
    $this->db->where('isPending','approved');
    return $this->db->get()->result();
  }

  public function get_po_sr($id){
    $this->db->select('*');
    $this->db->from('tbl_purchase_no AS purc');
    $this->db->join('tbl_purchase_order AS order','purc.purchase_request_id = order.purchase_request_id');
    $this->db->join('tbl_purchase_request AS request','purc.purchase_request_id = request.purchase_request_no');
    $this->db->where('PO_ID',$id);
    $this->db->where('isStatus','1');
    $this->db->where('isPending','approved');
    return $this->db->get()->result();
  }

  public function branch($id){
    $this->db->where('branch_id',$id);
    $query = $this->db->get('tbl_branch');
    $row = $query->row();
    return $row;
}
public function getTotalRows(){
 $query =  $this->db->get('tbl_purchase_order');
  return $query->num_rows();
  
}

public function table_approved_po(){
  
  
  $branch = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_purchase_no');
  $this->db->join('tbl_supplier','tbl_purchase_no.supplier_id = tbl_supplier.supplier_id');
  $this->db->where('tbl_purchase_no.branch_id',$branch);
  $this->db->where('isPending','approved');
  $this->db->where('pr_ref',false);
  $this->db->where('isCancel','no');
  $query = $this->db->get()->result();
  return $query;
}


/*--------Driving Instructor---------------*/ 


public function driver_table_po(){
  $branch = $_SESSION['branch_id'];
  $user = $_SESSION['User_ID'];
  $this->db->select('*');
  $this->db->from('tbl_purchase_no as purc');
  $this->db->join('tbl_supplier as supplier','purc.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user as user','purc.USER_ID = user.USER_ID');
  $this->db->where('user.User_ID',$user);
  $this->db->where('purc.branch_id',$branch);
  $this->db->where('isCancel','no');
  $this->db->where('isPending','approved');
  $this->db->where('pr_ref',false);
  $query = $this->db->get()->result();
  return $query;
}
  public function driver_manage_po(){
    $user = $_SESSION['User_ID'];
  $branch = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_purchase_order as order');
  $this->db->join('tbl_supplier AS supplier','order.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user as user','order.USER_ID = user.USER_ID');
  $this->db->where('order.branch_id',$branch);
  $this->db->where('order.User_ID',$user);
  return $this->db->get()->result();
}

}