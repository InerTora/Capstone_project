<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PR_Model extends CI_Model{
 
  public function getallsupplier(){

    $branch = $_SESSION['branch_id'];
    $this->db->select('*');
    $this->db->from('tbl_supplier');
    $this->db->where('branch_id',$branch);
    $this->db->where('status','active');
    $query = $this->db->get()->result();
    return $query;
   }
   
/*To Select all the suppier list*/
 public function gasoline_supplier(){
  $branch = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_supplier');
  //$this->db->where('branch_id',$branch);
  $this->db->where('status','active');
  $this->db->where('payable_type','Gasoline');
  $query = $this->db->get()->result();
  return $query;
 }

 public function repair_supplier(){
  $branch = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_supplier');
  //$this->db->where('branch_id',$branch);
  $this->db->where('status','active');
  $this->db->where('payable_type','Repair and Maintenance');
  $query = $this->db->get()->result();
  return $query;
 }
 public function billing_supplier(){
  $branch = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_supplier');
  //$this->db->where('branch_id',$branch);
  $this->db->where('status','active');
  $this->db->where('payable_type','billing');
  $query = $this->db->get()->result();
  return $query;
 }
 
    
/*To select all purchase number */
  public function get_PR_branch(){
    $query = $this->db->get('tbl_purchase_no');
    return $query->result();

  }

/*To Insert to the database tbl_purchase_no and tbl_purchase_request*/
    public function insert(){
      $position = $_SESSION['Position'];
      $user = $_SESSION['User_ID'];
    $purchase =[
        'purchase_request_no' =>$this->input->post('code_no'),
        'supplier_id' =>$this->input->post('supplier'),
        'posting_date' =>date('Y-m-d'),
        'branch_id' =>$this->input->post('branch_id'),
        'category' =>$this->input->post('category'),
        'request_by' =>$position,
        'purpose' =>$this->input->post('purpose'),
        'total_cost' =>$this->input->post('total_cost'),
        'User_ID' =>$this->input->post('user_id'),
        'isForwarded' =>$this->input->post('isForwarded'),
        'forwardedby'=>$user,
        
        
    ];
  
    $this->db->insert('tbl_purchase_no',$purchase);

      $last_id = $this->db->insert_id();

      $plate = $this->input->post('plate');
      $item_no = $this->input->post('item_no');
      $quantity = $this->input->post('quantity');
      $unit = $this->input->post('unit');
      $description = $this->input->post('description');
      $unit_cost = $this->input->post('unit_cost');
      $estimated_cost = $this->input->post('estimated_cost');
      
        
        foreach ($plate as $index => $plates){

          $arr_plate = $plates;
          $arr_quant = $quantity[$index];
          $arr_unit = $unit[$index];
          $arr_desc = $description[$index];
          $arr_unit_cost = $unit_cost[$index];
          $arr_estimated_cost = $estimated_cost[$index];

          $data =[
            'purchase_request_no'=>$last_id,
            'car_id' => $arr_plate,
            'item_no' => 'N/A',
            'quantity' => $arr_quant,
            'unit' =>$arr_unit,
            'description' => ucwords($arr_desc),
            'unit_cost' =>$arr_unit_cost,
            'estimated_cost' =>$arr_estimated_cost,
          ];
          $this->db->insert('tbl_purchase_request',$data);

        }
        
        return $this->db->insert_id();
    }
 

    /*--------SERVICE REQUEST----------*/ 
    public function service_request_insert(){
      $position = $_SESSION['Position'];
      $user = $_SESSION['User_ID'];
    $purchase =[
        'purchase_request_no' =>$this->input->post('code_no'),
        'supplier_id' =>$this->input->post('supplier'),
        'posting_date' =>date('Y-m-d'),
        'branch_id' =>$this->input->post('branch_id'),
        'category' =>$this->input->post('category'),
        'request_by' =>$position,
        'purpose' =>$this->input->post('purpose'),
        'total_cost' =>$this->input->post('total_cost'),
        'User_ID' =>$this->input->post('user_id'),
        'isForwarded' =>$this->input->post('isForwarded'),
        'forwardedby'=>$user
        
    ];
  
    $this->db->insert('tbl_purchase_no',$purchase);

      $last_id = $this->db->insert_id();

      $plate = $this->input->post('plate');
      $item_no = $this->input->post('item_no');
      $quantity = $this->input->post('quantity');
      $unit = $this->input->post('unit');
      $description = $this->input->post('description');
      $unit_cost = $this->input->post('unit_cost');
      $estimated_cost = $this->input->post('estimated_cost');
      
        
        foreach ($item_no as $index => $item_no){

         // $arr_plate = $plates;
          $arr_item_no = $item_no;
          $arr_quant = $quantity[$index];
          $arr_unit = $unit[$index];
          $arr_desc = $description[$index];
          $arr_unit_cost = $unit_cost[$index];
          $arr_estimated_cost = $estimated_cost[$index];

          $data =[
            'purchase_request_no'=>$last_id,
            //'car_id' => $arr_plate,
            'item_no' => $arr_item_no,
            'quantity' => $arr_quant,
            'unit' =>$arr_unit,
            'description' => ucwords($arr_desc),
            'unit_cost' =>$arr_unit_cost,
            'estimated_cost' =>$arr_estimated_cost,
          ];
          $this->db->insert('tbl_purchase_request',$data);

        }
        
        return $this->db->insert_id();
    }
/*To Generate auto increment purchase no */
    public function auto_number_PR(){
        $year = date('Y');
        $text = "PR".'-'.$year;
        $query = "SELECT max(purchase_request_no) as code_auto from tbl_purchase_no";
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
/*Join supplier table and tbl_purchase_no to display all data*/
    public function view_all(){
      $this->db->select('purc.*,supplier.supplier_name');
      $this->db->from('tbl_purchase_no AS purc');
      $this->db->join('tbl_supplier AS supplier','purc.supplier_id = supplier.supplier_id');
      $query = $this->db->get()->result();
      return $query;
}
   
/*Join tbl_purchase_request table and tbl_purchase_no to display all data*/
public function view_all_PR($id){
  $this->db->select('*');
  $this->db->from('tbl_purchase_no AS purc');
  $this->db->join('tbl_purchase_request AS PR','purc.purchase_request_id= PR.purchase_request_no');
  $this->db->join('tbl_vehicles AS vehicles','PR.car_id = vehicles.car_id');
  $this->db->join('tbl_user AS user','purc.User_ID = user.User_ID');
  $this->db->where('purchase_request_id',$id);
  $query = $this->db->get();
  return $query->result();
}

public function view_all_SR($id){
  $this->db->select('*');
  $this->db->from('tbl_purchase_no AS purc');
  $this->db->join('tbl_purchase_request AS PR','purc.purchase_request_id= PR.purchase_request_no');
  $this->db->join('tbl_user AS user','purc.User_ID = user.User_ID');
  $this->db->where('purchase_request_id',$id);
  $query = $this->db->get();
  return $query->result();
}

/*Join supplier table and tbl_purchase_no to display one data base on thier id*/
public function Select_one($id){
  $this->db->select('*');
  $this->db->from('tbl_supplier AS supplier');
  $this->db->join('tbl_purchase_no AS purc','purc.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_purchase_request AS PR','purc.purchase_request_id= PR.purchase_request_no');
  $this->db->join('tbl_user AS user','purc.User_ID = user.User_ID');
  $this->db->where('purchase_request_id',$id);
  $query = $this->db->get()->row();
  return $query;
}

public function branch_sms($id){

  $this->db->select('*');
  $this->db->from('tbl_supplier AS supplier');
  $this->db->join('tbl_purchase_no AS purc','purc.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_purchase_request AS PR','purc.purchase_request_id= PR.purchase_request_no');
  $this->db->join('tbl_user AS user','purc.forwardedby = user.User_ID');
  $this->db->where('purchase_request_id',$id);
  $query = $this->db->get()->row();
  return $query;


}

public function Select_one2($id){
  $this->db->select('purc.*,branch.*');
  $this->db->from('tbl_purchase_no AS purc');
  $this->db->join('tbl_branch AS branch','purc.branch_id= branch.branch_id');
  $this->db->where('purchase_request_id',$id);
  $query = $this->db->get()->row();
  return $query;
}
public function code($id){
  $this->db->select('*');
  $this->db->from('tbl_purchase_no');
  $this->db->where('purchase_request_id',$id);
  $query = $this->db->get()->row();
  return $query;
}
   
/*To update purchase request*/
  public function update_PR(){
  $purchase_id =(int) $this->input->post('purchase_id');
  $purchase =[
  
    'supplier_id' =>(string) $this->input->post('supplier'),
    'purpose' =>  (string) $this->input->post('purpose'),
    'total_cost' =>  (string) $this->input->post('total_cost')

    ];

        $this->db->where('purchase_request_id',$purchase_id);
        $this->db->update('tbl_purchase_no',$purchase);
 

        $pr_code = $this->input->post('pr_code');
        $plate = $this->input->post('plate');
        $quantity = $this->input->post('quantity');
        $unit = $this->input->post('unit');
        $description = $this->input->post('description');
        $unit_cost = $this->input->post('unit_cost');
        $estimated_cost = $this->input->post('estimated_cost');
  
  foreach ($plate as $index => $plates) {
        $arr_plate = $plates;
        $arr_quant = $quantity[$index];
        $arr_unit = $unit[$index];
        $arr_desc = $description[$index];
        $arr_code = $pr_code[$index];
        $arr_unit_cost = $unit_cost[$index];
        $arr_estimated_cost = $estimated_cost[$index];


      $this->db->set('car_id',$arr_plate);
      $this->db->set('quantity',$arr_quant);
      $this->db->set('unit',$arr_unit);
      $this->db->set('description',$arr_desc);
      $this->db->set('unit_cost',$arr_unit_cost);
      $this->db->set('estimated_cost',$arr_estimated_cost);
      $this->db->where('purchase_request_no',$purchase_id);
      $this->db->where('PR_ID',$arr_code);
      $this->db->update('tbl_purchase_request');
  }
  return   $purchase_id;
}


/*----------UPDATE SERVICE REQUEST--------------------*/ 

public function update_SR(){
  $purchase_id =(int) $this->input->post('purchase_id');
  $purchase =[
  
    'supplier_id' =>(string) $this->input->post('supplier'),
    'purpose' =>  (string) $this->input->post('purpose'),
    'total_cost' =>  (string) $this->input->post('total_cost')

    ];

        $this->db->where('purchase_request_id',$purchase_id);
        $this->db->update('tbl_purchase_no',$purchase);
 

        $pr_code = $this->input->post('pr_code');
        $item_no = $this->input->post('item_no');
        $quantity = $this->input->post('quantity');
        $unit = $this->input->post('unit');
        $description = $this->input->post('description');
        $unit_cost = $this->input->post('unit_cost');
        $estimated_cost = $this->input->post('estimated_cost');
  
  foreach ($item_no as $index => $item_no) {
        $arr_item_no = $item_no;
        $arr_quant = $quantity[$index];
        $arr_unit = $unit[$index];
        $arr_desc = $description[$index];
        $arr_code = $pr_code[$index];
        $arr_unit_cost = $unit_cost[$index];
        $arr_estimated_cost = $estimated_cost[$index];


      //$this->db->set('car_id',$arr_plate);
      $this->db->set('quantity',$arr_quant);
      $this->db->set('unit',$arr_unit);
      $this->db->set('description',$arr_desc);
      $this->db->set('unit_cost',$arr_unit_cost);
      $this->db->set('estimated_cost',$arr_estimated_cost);
      $this->db->where('purchase_request_no',$purchase_id);
      $this->db->where('PR_ID',$arr_code);
      $this->db->update('tbl_purchase_request');
  }
  return   $purchase_id;
}



/*Join supplier table and tbl_purchase_no to display all data*/
    public function manage_branch(){
  
      $branch = $_SESSION['branch_id'];
      $this->db->select('*');
      $this->db->from('tbl_purchase_no');
      $this->db->join('tbl_supplier','tbl_purchase_no.supplier_id = tbl_supplier.supplier_id');
      $this->db->where('tbl_purchase_no.branch_id',$branch);
      $this->db->where('isCancel','no');
      $query = $this->db->get()->result();
      return $query;
}
public function manage_driver_request(){
  $branch = $_SESSION['branch_id'];
  $user = $_SESSION['User_ID'];
  $this->db->select('*');
  $this->db->from('tbl_purchase_no as purc');
  $this->db->join('tbl_supplier as supplier','purc.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user as user','purc.USER_ID = user.USER_ID');
  $this->db->where('user.Position',"Driving Instructor");
  $this->db->where('user.User_ID',$user);
  $this->db->where('purc.branch_id',$branch);
  $this->db->where('isCancel','no');
  $query = $this->db->get()->result();
  return $query;
}

public function manage_manager(){
  $branch = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_purchase_no as purc');
  $this->db->join('tbl_supplier as supplier','purc.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user as user','purc.USER_ID = user.USER_ID');
  $this->db->where('user.Position',"Manager");
  $this->db->where('purc.branch_id',$branch);
  $this->db->where('isCancel','no');
  $query = $this->db->get()->result();
  return $query;
}

public function driver_instructor(){
  $branch = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_purchase_no as purc');
  $this->db->join('tbl_supplier as supplier','purc.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user as user','purc.USER_ID = user.USER_ID');
  $this->db->where('user.Position',"Driving Instructor");
  $this->db->where('purc.branch_id',$branch);
  $this->db->where('isCancel','no');
  $query = $this->db->get()->result();
  return $query;
}


public function manage_other_branch_request(){
 $branch = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_purchase_no as purc');
  $this->db->join('tbl_supplier as supplier','purc.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_branch AS branch','purc.branch_id= branch.branch_id');
  $this->db->join('tbl_user as user','purc.USER_ID = user.USER_ID');
  $this->db->where_not_in('purc.branch_id',$branch);
  $this->db->where('isCancel','no');
  $query = $this->db->get()->result();
  return $query;
}


  public function request(){
  
  $this->db->select('*');
  $this->db->from('tbl_purchase_no AS pr');
  $this->db->join('tbl_branch  As branch','pr.branch_id = branch.branch_id');
  $this->db->join('tbl_supplier AS supplier','pr.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user AS user','pr.User_ID = user.User_ID');
  $this->db->where('isPending','pending');
  $this->db->where('isCancel','no');
  $this->db->where('supplier.status','active');
  $this->db->where('pr.isForwarded','0');
  

   $query = $this->db->get()->result();
   return $query;
} 

public function request_history(){
  
  $this->db->select('*');
  $this->db->from('tbl_purchase_no AS pr');
  $this->db->join('tbl_branch  As branch','pr.branch_id = branch.branch_id');
  $this->db->join('tbl_supplier AS supplier','pr.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user AS user','pr.User_ID = user.User_ID');
  $this->db->where('post','1');
  $this->db->or_where('isPending','disapproved');
  $this->db->where('isCancel','no');
  $this->db->where('supplier.status','active');
   $query = $this->db->get()->result();
   return $query;
}


/*Count the notification*/
public function count_notif(){
$branch = $_SESSION['branch_id'];
$position = $_SESSION['Position'];

if ($position == "General Manager" ) {

  $this->db->count_all_results('tbl_purchase_no');
  $this->db->like('isRead', 'no');
  $this->db->from('tbl_purchase_no as purc');
  $this->db->join('tbl_supplier AS supplier','purc.supplier_id = supplier.supplier_id');
  $this->db->where('request_by','Manager');
  $this->db->or_where('isForwarded','0');
  $this->db->where('isCancel','no');
  $this->db->where('isPending','pending');
  $this->db->where('supplier.status','active');
$query= $this->db->count_all_results();
 return $query;
}

}

/*Count the approve notification*/
public function branch_count_notif(){
  $branch = $_SESSION['branch_id'];
  $position = $_SESSION['Position'];
  
  if ($position == "Manager" ) {
  
    $this->db->count_all_results('tbl_purchase_no');
    $this->db->like('isRead', 'yes');
    $this->db->from('tbl_purchase_no');
    // $this->db->where('request_by','manager');
    $this->db->where('branch_id',$branch);
  $query= $this->db->count_all_results();
   return $query;
  }
  }
  public function driver_count_notif(){
    $branch = $_SESSION['branch_id'];
  
      $this->db->count_all_results('tbl_purchase_no');
      $this->db->like('notif', '2');
      $this->db->from('tbl_purchase_no');
      // $this->db->where('request_by','manager');
      $this->db->where('branch_id',$branch);
    $query= $this->db->count_all_results();
     return $query;
    
    }

    public function driver_forward_notif(){

      $branch = $_SESSION['branch_id'];
      $position = $_SESSION['Position'];
      $this->db->select('*');
      $this->db->from('tbl_purchase_no AS purc');
      $this->db->join('tbl_supplier AS supplier','purc.supplier_id = supplier.supplier_id');
      $this->db->where('notif','2'); 
      $this->db->where('purc.branch_id',$branch);
       $query = $this->db->get()->result() ;
       return $query;
     }

   
/*To approve the pending purchase request from other branch*/

public function approve_request(){
  $approved_by = $_SESSION['First_Name'] .' '. $_SESSION['Last_Name'];
  
  $purchase_id =(int) $this->input->post('purchase_id');
  $status = $this->input->post('status');
  $reason = $this->input->post('reason');
  $purchase =[
    'isPending'=>$status,
    'post' =>'1',
    'isRead' =>'yes',
    'reason' =>$reason,
    'approved_by'=>$approved_by

];
        $this->db->where('purchase_request_id',$purchase_id);
        $response =$this->db->update('tbl_purchase_no',$purchase);
        if ($response) {
          return $purchase_id;
      }else{

          return false;
      }
}

public function check_approved($check_id){

  
  $check = array(
    'isStatus' =>  '0'
  );
  $this->db->where_in('PR_ID',$check_id);
  $response =$this->db->update('tbl_purchase_request',$check);
  if ($response) {
    return $check_id;
}else{

    return false;
}

}

public function check_estimated_cost($id){
  
  $purchase_id = $this->input->post('purchase_request_id');
  $this->db->select_sum('estimated_cost');
  $this->db->from('tbl_purchase_request as req');
  $this->db->join('tbl_purchase_no as purc','req.purchase_request_no = purc.purchase_request_id');
  
  $this->db->where('req.purchase_request_no',$id);
  $this->db->where('isStatus','1');
  $this->db->where('isPending','approved');
  $query = $this->db->get();
  return $query->row()->estimated_cost;

}

/*To display all requested from other branch*/
   public function manage_notif(){

    $branch = $_SESSION['branch_id'];
    $position = $_SESSION['Position'];
    
    $this->db->select('*');
    $this->db->from('tbl_purchase_no AS purc');
    $this->db->join('tbl_branch AS branch','purc.branch_id = branch.branch_id');
    $this->db->join('tbl_supplier AS supplier','purc.supplier_id = supplier.supplier_id');
    $this->db->where('isRead','no');
    $this->db->where('isCancel','no');
     $this->db->where('request_by','Manager');
     $this->db->or_where('isForwarded','0');
     $this->db->where('isPending','pending');

     $this->db->where('supplier.status','active');
     $query = $this->db->get()->result() ;
     return $query;
   }
   /*To display all approved requested from other branch*/
   public function approve_by_gen(){

    $branch = $_SESSION['branch_id'];
    $position = $_SESSION['Position'];
    $this->db->select('*');
    $this->db->from('tbl_purchase_no AS purc');
    $this->db->join('tbl_supplier AS supplier','purc.supplier_id = supplier.supplier_id');
    // $this->db->where('request_by','Manager');
    $this->db->where('isRead','yes'); 
    $this->db->where('purc.branch_id',$branch);
     $query = $this->db->get()->result() ;
     return $query;
   }
/*To get all the car base on their branch id*/

public function getcarlist(){
  $branch = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_vehicles');
  $this->db->where('branch_id',$branch);
  $this->db->where('status','active');

  $query = $this->db->get()->result();
  return $query;
}

public function plate_filterer($plate_list){
  $branch = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_vehicles');
  $this->db->where('branch_id',$branch);
   $this->db->where_not_in("car_id",$plate_list); 
  $this->db->where('status','active');

  $query = $this->db->get()->result();
  return $query;
}

public function unread($id){
  $data = array(
    'isRead'=>'seen');
   $this->db->where('purchase_request_id',$id);
   $response =$this->db->update('tbl_purchase_no',$data);
        if ($response) {
            return $id;
        }else{
            return false;
        }
}

public function driver_unread($id){
  $data = array(
    'notif'=>'3');
   $this->db->where('purchase_request_id',$id);
   $response =$this->db->update('tbl_purchase_no',$data);
        if ($response) {
            return $id;
        }else{
            return false;
        }
}

public function delete_branch_pr($id){
  $data = array(
    'isCancel'=>'yes');
   $this->db->where('purchase_request_id',$id);
   $response =$this->db->update('tbl_purchase_no',$data);
        if ($response) {
            return $id;
        }else{
            return false;
        }
}


    /*------------SMS FEATURE------------- */
 public function get_user(){

        $this->db->where('user_id',1);
        $query = $this->db->get('tbl_user');
        $row = $query->row();
        return $row;
    }

    public function sms_contact_user(){
      $branch = $_SESSION['branch_id'];
       $this->db->select('*');
       $this->db->from('tbl_purchase_no as purc');
       $this->db->join('tbl_user as user','purc.User_ID = user.User_ID');
       $this->db->where('purc.branch_id',$branch);

       $query = $this->db->get()->row();
            return $query;
        }




    public function sms_branch(){
      $branch = $_SESSION['branch_id'];
      $this->db->select('*');
      $this->db->from('tbl_user as user');
      $this->db->join('tbl_branch as branch','branch.branch_id = user.branch_id');
      $this->db->where('branch.branch_id',$branch);

      $query = $this->db->get()->row();
           return $query;
        }
        
      
    /*------------SMS FEATURE------------- */

    /*------------Count all purchase order------------- */
    public function count_purchase_order(){
      $branch = $_SESSION['branch_id'];
        $this->db->count_all_results('tbl_purchase_order');
        $this->db->from('tbl_purchase_order');
        $this->db->where('isCreated',1);
        $this->db->where('isReference',0);
        $this->db->where('branch_id',$branch);
      $query= $this->db->count_all_results();
       return $query;
      }
      
      public function count_purchase_invoice(){
        $branch = $_SESSION['branch_id'];
          $this->db->count_all_results('tbl_purchase_invoice');
          $this->db->from('tbl_purchase_invoice');
          $this->db->where('sent','0');
          $this->db->where('branch_id',$branch);
        $query= $this->db->count_all_results();
         return $query;
        }
        public function count_purchase_voucher(){
          $branch = $_SESSION['branch_id'];
            $this->db->count_all_results('tbl_payment_voucher');
            $this->db->from('tbl_payment_voucher');
            $this->db->where('isPending','pending');
            $this->db->where('isCancel','no');
            $this->db->where('branch_id',$branch);
          $query= $this->db->count_all_results();
           return $query;
          }
          public function count_purchase_request(){
            $branch = $_SESSION['branch_id'];
              $this->db->count_all_results('tbl_purchase_no');
              $this->db->from('tbl_purchase_no');
              $this->db->where('isPending','pending');
              $this->db->where('isCancel','no');
              $this->db->where('branch_id',$branch);
            $query= $this->db->count_all_results();
             return $query;
            }

            public function isforwarded($id){
              $user = $_SESSION['User_ID'];
              $data = array(
               'isForwarded'=>'0',
               'forwardedby'=>$user
              
              );
              $this->db->where('purchase_request_id',$id);
               
              $response =$this->db->update('tbl_purchase_no',$data);
              
                   if ($response) {
                       return $id;
                   }else{
                       return false;
                   }
             }


             public function forwarded($id){
           $txt_yes = $this->input->post('txt_yes');
              $data = array(
               'forwarded_to'=> 'yes',
               'notif'=>'2'
              );
              
              $this->db->where('purchase_request_id',$id);
               
              $response =$this->db->update('tbl_purchase_no',$data);
              
                   if ($response) {
                       return $id;
                   }else{
                       return false;
                   }
             }
}