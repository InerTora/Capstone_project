<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance_model extends CI_Model {

   
  public function getallsupplier(){

    $branch = $_SESSION['branch_id'];
    $this->db->select('*');
    $this->db->from('tbl_supplier');
    //$this->db->where('branch_id',$branch);
    $this->db->where('status','active');
    $this->db->where_not_in('payable_type','Billing');
    $query = $this->db->get()->result();
    return $query;
   }

    public function auto_number_PI(){
 
        $year = date('Y');
        $text = "PI"."-".$year;
        $query = "SELECT max(purchase_invoice_no) as code_auto from tbl_purchase_invoice";
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
/*------auto increement purchase invoice--------*/ 

public function PV_no(){
$year = date('Y');
  $text = "1";
  $query = "SELECT max(payment_voucher_no) as code_auto from tbl_payment_voucher";
  $data = $this->db->query($query)->row_array();
  if($data["code_auto"]!=NULL){
  $max_code = $data['code_auto'];
  $max_code2 =  (int)substr($max_code,8,5);
  $codecount = $max_code2+1;
  $code_auto = $codecount;
  return $code_auto;
  }
    else{
        return $text;
    }
}
/**/ 
public function get_po_details($id){
  $this->db->select('*');
  $this->db->from('tbl_purchase_order as order');
  $this->db->join('tbl_supplier as supplier','order.supplier_id = supplier.supplier_id','left');
  $this->db->where('PO_ID',$id);
  return $this->db->get()->row();
}

public function total_quant($id){
  $sql = "SELECT SUM(quantity) As quantity FROM tbl_purchase_request where purchase_request_no = $id";
  $result = $this->db->query($sql);
  return $result->row()->quantity;
}
/**/ 
public function attach_pi($file_name){
  $this->ref();
  //$this->insert_ap_ledger();
  $branch_id = $_SESSION['branch_id'];
  $pi_code = $this->input->post('PI_code');
  $invoice_date = $this->input->post('invoice_date');
  $PO_no = $this->input->post('PO_no');
  $PO_ID = $this->input->post('PO_ID');
  $supplier_id = (int) $this->input->post('supplier_id');
  $pi_due = $this->input->post('pi_due');
  $payment_terms = $this->input->post('payment_terms');
  $total_amount = $this->input->post('total_amount');
  $user_id = $this->input->post('User_ID');
  $invoice = array(
    'file' =>$file_name,
    'branch_id'=>$branch_id,
    'purchase_invoice_no' => $pi_code,
    'PO_ID' => $PO_ID,
    'supplier_id' => $supplier_id,
    'invoice_date' =>$invoice_date,
    'due_date'=>$pi_due,
    'total_amount'=>$total_amount,
    'User_ID'=>$user_id
  );
  $this->db->insert('tbl_purchase_invoice',$invoice);
  
      $last_id = $this->db->insert_id();
      $plate = $this->input->post('plate');
      $quantity = $this->input->post('qty');
      $unit = $this->input->post('unit');
      $description = $this->input->post('description');
      $unit_price = $this->input->post('price');
      $amount = $this->input->post('subtot');
      $item_no = $this->input->post('item_no');
    
        foreach ($plate as $index => $plates) {
          $arr_plate = $plates;
          $arr_quant = $quantity[$index];
          $arr_unit = $unit[$index];
          $arr_desc = $description[$index];
          $arr_Uprice = $unit_price[$index];
          $arr_amount = $amount[$index];
          $arr_item_no = $item_no[$index];
          $data =[
            'PI_ID'=>$last_id,
            'item_no' => $arr_item_no,
            'car_id' => $arr_plate,
            'quantity' => $arr_quant,
            'unit' =>$arr_unit,
            'description' => $arr_desc,
            'unit_price' => $arr_Uprice,
            'amount' => $arr_amount,
          ];
          $this->db->insert('tbl_invoice_id',$data);

        }
        
        return $this->db->insert_id();
}


public function ref(){
  $po = $this->input->post('PO_ID');
  $ref = array(
    'isReference' => '1'
  );
  
  $this->db->where('PO_ID',$po);
  $this->db->update('tbl_purchase_order',$ref);

  return $po;
}



/*----------------APPROVE PURCHASE INVOICE--------------*/ 
public function table_po1(){
  $branch = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_purchase_order as order');
  $this->db->join('tbl_supplier AS supplier','order.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user AS user','order.User_ID = user.User_ID');
  $this->db->where('order.branch_id',$branch);
  $this->db->where('order.isReference','0');
 $this->db->where('order.isCreated',true);
 return $this->db->get()->result();
}

/*--------Insert AP Ledger--------*/ 
public function insert_ap_ledger(){
  $user = $_SESSION['User_ID'];
  $this->update_sent();
  $branch = $_SESSION['branch_id'];
  $ledger_no = $this->input->post('ledger_no');
  $PI_ID = $this->input->post('PI_ID');
  $ledger_supplier_id = $this->input->post('ledger_supplier_id');
  $amount = $this->input->post('balance');
  $reference = $this->input->post('reference');
  $due_date = $this->input->post('due_date');
  $ledger = array(
    'AP_no' => $ledger_no,
    'PI_ID' => $PI_ID,
    'supplier_id' => $ledger_supplier_id,
    'balance' => $amount,
    'invoice_amount' => $amount,
    'branch_id' => $branch,
    'isReference' => $reference,
    'isDue_date' => $due_date,
    'User_ID' => $user
  );
  $response =$this->db->insert('tbl_ledger',$ledger);
  if ($response) {
      return $this->db->insert_id();
  }else{

      return FALSE;
  }
}

public function update_sent(){
  $PI_ID = $this->input->post('PI_ID');
  $ref = array(
    'sent' => '1'
  );
  
  $this->db->where('PI_ID',$PI_ID);
  $this->db->update('tbl_purchase_invoice',$ref);

  return $PI_ID;
}

/*--AP Bills----*/

public function insert_bills_ledger(){
  $user = $_SESSION['User_ID'];
  $this->isHide();
  $branch = $_SESSION['branch_id'];
  $ledger_no = $this->input->post('ledger_no');
  $AP_ID = $this->input->post('AP_ID');
  $supplier_id = $this->input->post('supplier_id');
  $amount = $this->input->post('amount');
  $reference = $this->input->post('reference');
  $due_date = $this->input->post('due_date');
  $ledger = array(
    'AP_no' => $ledger_no,
    // 'PI_ID' => "0",
    'supplier_id' => $supplier_id,
    'balance' => $amount,
    'invoice_amount' => $amount,
    'branch_id' => $branch,
    'AP_ID' => $AP_ID,
    'isReference' => $reference,
    'isDue_date' => $due_date,
    'User_ID' => $user

  );
  $response =$this->db->insert('tbl_ledger',$ledger);
  if ($response) {
      return $this->db->insert_id();
  }else{

      return FALSE;
  }
}
public function isHide(){
  $isHide = $this->input->post('isHide');
  $ref = array(
    'isHide' => '1'
  );
  
  $this->db->where('AP_ID',$isHide);
  $this->db->update('tbl_accounts_payable',$ref);

  return $isHide;
}


public function get_purchase_invoice(){
  
$branch = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_purchase_order as order');
  $this->db->join('tbl_purchase_invoice as invoice','invoice.PO_ID = order.PO_ID');
  $this->db->join('tbl_supplier AS supplier','invoice.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user AS user','invoice.User_ID = user.User_ID');
  $this->db->where('invoice.branch_id',$branch);
 // $this->db->where('');
  return $this->db->get()->result();
}

public function general_pi_only(){
  
  $branch = $_SESSION['branch_id'];
    $this->db->select('*');
    $this->db->from('tbl_purchase_order as order');
    $this->db->join('tbl_purchase_invoice as invoice','invoice.PO_ID = order.PO_ID');
    $this->db->join('tbl_supplier AS supplier','invoice.supplier_id = supplier.supplier_id');
    $this->db->join('tbl_user AS user','invoice.User_ID = user.User_ID');
    $this->db->where('invoice.branch_id',$branch);
   // $this->db->where('');
    return $this->db->get()->result();
  }
  public function general_pi_branch(){
  
    $branch = $_SESSION['branch_id'];
      $this->db->select('*');
      $this->db->from('tbl_purchase_order as order');
      $this->db->join('tbl_purchase_invoice as invoice','invoice.PO_ID = order.PO_ID');
      $this->db->join('tbl_supplier AS supplier','invoice.supplier_id = supplier.supplier_id');
      $this->db->join('tbl_user AS user','invoice.User_ID = user.User_ID');
      $this->db->join('tbl_branch AS branch','invoice.branch_id = branch.branch_id');
     // $this->db->where('');
      return $this->db->get()->result();
    }
  
public function view_purchase_invoice($id){

  $this->db->select('*');
  $this->db->from('tbl_purchase_order as order');
  $this->db->join('tbl_purchase_invoice as invoice','order.PO_ID = invoice.PO_ID','right');
  $this->db->join('tbl_supplier AS supplier','invoice.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user AS user','invoice.User_ID = user.User_ID');
  $this->db->where('PI_ID',$id);
  return $this->db->get()->row();
}
public function invoice_view($id){
  $this->db->select('*');
  $this->db->from('tbl_purchase_invoice as invoice');
  $this->db->join('tbl_invoice_id as invoice_id','invoice.PI_ID = invoice_id.PI_ID');
  $this->db->join('tbl_vehicles as vehicles','invoice_id.car_id = vehicles.car_id');
  $this->db->where('invoice.PI_ID',$id);
  return $this->db->get()->result();
}
public function invoice_view_sr($id){
  $this->db->select('*');
  $this->db->from('tbl_purchase_invoice as invoice');
  $this->db->join('tbl_invoice_id as invoice_id','invoice.PI_ID = invoice_id.PI_ID');

  $this->db->where('invoice.PI_ID',$id);
  return $this->db->get()->result();
}

public function update_attach_pi(){
  $PI_ID =(int) $this->input->post('PI_ID');
  $invoice =[
    'due_date' =>$this->input->post('pi_due'),
    'total_amount' =>$this->input->post('total_amount'),
];
        $this->db->where('PI_ID',$PI_ID);
        $this->db->update('tbl_purchase_invoice',$invoice);
 
        $pi_code = $this->input->post('pi_code');
        $plate = $this->input->post('plate');
        $quantity = $this->input->post('qty');
        $unit = $this->input->post('unit');
        $description = $this->input->post('description');
        $unit_price = $this->input->post('price');
        $amount = $this->input->post('subtot');
       
        foreach ($plate as $index => $plates) {
          //$arr_plate = $plates;
          $arr_quant = $quantity[$index];
          $arr_Uprice = $unit_price[$index];
          $arr_amount = $amount[$index];
          $arr_code = $pi_code[$index];

      $this->db->set('quantity',$arr_quant);
      $this->db->set('unit_price',$arr_Uprice);
      $this->db->set('amount',$arr_amount);
      $this->db->where('invoice_id',$arr_code);
      $this->db->where('PI_ID',$PI_ID);
      $this->db->update('tbl_invoice_id');
  }
  return $PI_ID;
  }
  
  public function update_image($file_name){
    
      $pi_id = $this->input->post('ha');
     
      $data = array(
    
        'file' =>$file_name
      );
      $this->db->where('PI_ID',$pi_id);
    $this->db->update('tbl_purchase_invoice',$data);
   return  $pi_id;
    
    }
    
    /*-----------------ACCOUNTS PAYABLES JOURNAL--------------------------- */
    public function auto_number_Bill(){
          $year = date('Y');
          $text = "BN".'-'.$year;
          $query = "SELECT max(billing_no) as code_auto from tbl_accounts_payable";
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

public function add_ap($file_name){

  $branch_id = $_SESSION['branch_id'];
  $user = $_SESSION['User_ID'];
  $billing_no =$this->input->post('billing_no');
  $billing_type =$this->input->post('billing_type');
  $posting_date =$this->input->post('posting_date');
  $Supplier =$this->input->post('supplier');
  $total_amount =$this->input->post('total_amount');
  $due_date =$this->input->post('due_date');
  $payment_terms =$this->input->post('payment_terms');
  $description =$this->input->post('description');

  $data = array(
    'file'=>$file_name,
    'branch_id'=>$branch_id,
    'User_ID'=>$user,
    'billing_no'=>$billing_no,
    'ap_date' =>$posting_date,
    'supplier_id' =>$Supplier,
    'amount' =>$total_amount,
    'due_date' =>$due_date,
    'payment_method' =>$payment_terms,
    'description' =>$description
  );
    $response =$this->db->insert('tbl_accounts_payable',$data);
    if ($response) {
        return $this->db->insert_id();
    }else{
  
        return FALSE;
    }
}

public function table_ap(){
  $branch_id = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_accounts_payable AS ap');
  $this->db->join('tbl_supplier AS supplier','ap.supplier_id = supplier.supplier_id');
  $this->db->where('ap.branch_id',$branch_id);
  $this->db->where('ap.isHide','0');

  return $this->db->get()->result();
}

public function table_ap1(){
  $branch_id = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_accounts_payable AS ap');
  $this->db->join('tbl_supplier AS supplier','ap.supplier_id = supplier.supplier_id');
  $this->db->where('ap.branch_id',$branch_id);
  $this->db->where_not_in('ap.isHide','0');
  return $this->db->get()->result();
}
public function manager_table_ap(){
  $branch_id = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_accounts_payable AS ap');
  $this->db->join('tbl_supplier AS supplier','ap.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user AS user','ap.user_id = user.user_id');
  $this->db->where('ap.branch_id',$branch_id);
  return $this->db->get()->result();
}

public function gen_table_ap(){
  
  $this->db->select('*');
  $this->db->from('tbl_accounts_payable AS ap');
  $this->db->join('tbl_supplier AS supplier','ap.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user AS user','ap.User_ID = user.User_ID');
  $this->db->join('tbl_branch AS branch','ap.branch_id = branch.branch_id');
  return $this->db->get()->result();
}

public function select_ap($id){
  $branch_id = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_accounts_payable AS ap');
  $this->db->join('tbl_supplier AS supplier','ap.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user AS user','ap.User_ID = user.User_ID');
  $this->db->where('AP_ID',$id);
  $this->db->where('ap.branch_id',$branch_id);
  return $this->db->get()->row();
}

public function gen_select_ap($id){
  
  $this->db->select('*');
  $this->db->from('tbl_accounts_payable AS ap');
  $this->db->join('tbl_supplier AS supplier','ap.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user AS user','ap.User_ID = user.User_ID');
  $this->db->where('AP_ID',$id);
  return $this->db->get()->row();
}


public function update_ap($id){
 
  $billing_type = $this->input->post('billing_type');
  $supplier = $this->input->post('supplier');
  $amount = $this->input->post('amount');
  $due_date = $this->input->post('due_date');
  $payment_terms = $this->input->post('payment_terms');

  $data = array(
    
    'supplier_id' => $supplier,
    'amount' => $amount,
    'due_date'=> $due_date,
    'payment_method' => $payment_terms
    
  );
  $this->db->where('AP_ID',$id);
  $this->db->update('tbl_accounts_payable',$data);
 return  $id;
}


public function update_image_ap($file_name){
    
  $pi_id = $this->input->post('ha');
 
  $data = array(

    'file' =>$file_name
  );
  $this->db->where('AP_ID',$pi_id);
$this->db->update('tbl_accounts_payable',$data);
return  $pi_id;

}

public function delete_AP($id){

  $data = array(
   'isRemoved'=>'yes');
  $this->db->where('AP_ID',$id);
   
  $response =$this->db->update('tbl_accounts_payable',$data);
  
       if ($response) {
           return $id;
       }else{
           return false;
       }
 }

  /*-----------------PAYMENT VOUCHER--------------------------- */

  public function auto_number_voucher(){

    $year = date('Y');
    $text = "PV".'-'.$year;
    $query = "SELECT max(payment_voucher_no) as code_auto from tbl_payment_voucher";
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



public function tbl_voucher(){

$branch_id = $_SESSION['branch_id'];

$this->db->select('*');
$this->db->from('tbl_payment_voucher AS voucher');
$this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');

$this->db->where('voucher.branch_id',$branch_id);
$this->db->where('voucher.isPending','pending');
$this->db->where('voucher.isCancel','no');
return $this->db->get()->result();
}

public function manager_tbl_voucher(){

  $branch_id = $_SESSION['branch_id'];
  
  $this->db->select('*');
  $this->db->from('tbl_payment_voucher AS voucher');
  $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
  $this->db->join('tbl_user AS user','voucher.User_ID = user.User_ID');
  $this->db->where('voucher.branch_id',$branch_id);
  $this->db->where('voucher.isCancel','no');
  return $this->db->get()->result();
  }

public function tbl_voucher_approved(){

  $branch_id = $_SESSION['branch_id'];
  $this->db->select('*');
  $this->db->from('tbl_payment_voucher AS voucher');
  $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
  
  $this->db->where('voucher.branch_id',$branch_id);
  $this->db->where('voucher.isPending','approved');
  $this->db->or_where('voucher.isPending','disapproved');
  $this->db->where('voucher.isCancel','no');
  return $this->db->get()->result();
  }
  


public function view_voucher($id){

      $this->db->select('*');
      $this->db->from('tbl_payment_voucher AS voucher');
      $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
      $this->db->join('tbl_user as user','voucher.User_ID = user.User_ID');
      $this->db->where('PV_ID',$id);
      return $this->db->get()->row();
  }
  public function view_ap_voucher1($id){

    $this->db->select('*');
    $this->db->from('tbl_payment_voucher AS voucher');
    $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
    $this->db->join('tbl_accounts_payable AS payable','voucher.AP_ID = payable.AP_ID');
    $this->db->join('tbl_user as user','voucher.User_ID = user.User_ID');
    $this->db->where('PV_ID',$id);
    return $this->db->get()->row();
}

  public function list_voucher($id){
    $this->db->select('*');
    $this->db->from('tbl_payment_voucher AS voucher');
    $this->db->join('tbl_pv_reference AS ref','voucher.PV_ID = ref.PV_ID');
    $this->db->join('tbl_purchase_invoice AS invoice','ref.PI_ID = invoice.PI_ID');
    //$this->db->join('tbl_vehicles AS vehicles','ref.car_id = vehicles.car_id');
    
    $this->db->where('voucher.PV_ID',$id);
    return $this->db->get()->result();
}
public function list_voucher1($id){

  $query = $this->db->select('ref.PI_ID')
                ->distinct('ref.PI_ID')
                ->from('tbl_payment_voucher as voucher')
                ->join('tbl_pv_reference as ref','voucher.PV_ID = ref.PV_ID')
                ->where('voucher.PV_ID',$id)
                ->get();
               
 return $query->result();
}


  public function table_approved_voucher(){
  
    $this->db->select('*');
    $this->db->from('tbl_payment_voucher AS voucher');
    $this->db->join('tbl_branch AS branch','voucher.branch_id = branch.branch_id');
    $this->db->join('tbl_user AS user','voucher.User_ID = user.User_ID');
    $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
    $this->db->where('voucher.isPending','pending');
    $this->db->where('voucher.isCancel','no');
    return $this->db->get()->result();
    }

    public function table_approved_voucher1(){
  
      $this->db->select('*');
      $this->db->from('tbl_payment_voucher AS voucher');
      $this->db->join('tbl_branch AS branch','voucher.branch_id = branch.branch_id');
      $this->db->join('tbl_user AS user','voucher.User_ID = user.User_ID');
      $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
      $this->db->where('voucher.isPending','approved');
      $this->db->or_where('voucher.isPending','disapproved');
      $this->db->where('voucher.isCancel','no');
      return $this->db->get()->result();
      }

  public function update_status(){

   $status = $this->input->post('status');

   $pv_id = $this->input->post('PV_ID');
$reason = $this->input->post('reason');
  $data =array(
    'isPending' =>$status,
    'reason' =>$reason,
    'sent' => '1',
    'hide' => '1'
  );

  $this->db->where('PV_ID',$pv_id);
  $this->db->update('tbl_payment_voucher',$data);

  return $pv_id;
  }

  public function delete_pv($id){

    $this->update_invoice($id);
    $data = array(
      'isCancel'=>'yes');
     $this->db->where('PV_ID',$id);
      
     $response =$this->db->update('tbl_payment_voucher',$data);
     
          if ($response) {
              return $id;
          }else{
              return false;
          }
  }

public function update_invoice($id){
    
    $data = array(
      'Reference'=>'0');
     $this->db->where('PI_ID',$id);
      
     $response =$this->db->update('tbl_purchase_invoice',$data);
     
          if ($response) {
              return $id;
          }else{
              return false;
          }
  }

    /*-----------------Reciept--------------------------- */

    public function auto_number_reciept(){
      $year = date('Y');
      $text = "RN".'-'.$year;
      $query = "SELECT max(reciept_no) as code_auto from tbl_reciept";
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

  public function reciept_no(){
    $year = date('Y');
    $text = "1";
    $query = "SELECT max(reciept_no) as code_auto from tbl_reciept";
    $data = $this->db->query($query)->row_array();
    if($data["code_auto"]!=NULL){
    $max_code = $data['code_auto'];
    $max_code2 =  (int)substr($max_code,8,5);
    $codecount = $max_code2+1;
    $code_auto = $codecount;
    return $code_auto;
    }
      else{
        return $text;
      }
}


public function select_reciept($id){

  $this->db->select('*');
  $this->db->from('tbl_reciept as reciept');
  $this->db->join('tbl_payment_voucher as voucher','reciept.PV_ID = voucher.PV_ID');
  $this->db->where('reciept_id',$id);
 
  return $this->db->get()->row();


}
  public function ref_voucher(){
    $branch = $_SESSION['branch_id'];
    $this->db->select('*');
    $this->db->from('tbl_payment_voucher');
    $this->db->where('branch_id',$branch);
    $this->db->where('reciept','pending');
    $this->db->where('isPending','approved');
    
    return $this->db->get()->result();
  }

  public function get_voucher_receipt($id){
    $this->db->select('*');
    $this->db->from('tbl_payment_voucher as voucher');
    $this->db->where('PV_ID',$id);
    return $this->db->get()->row();
  }
   
  public function insert_reciept($file_name){
      $this->update_voucher_reciept();
      $branch_id = $_SESSION['branch_id'];
      $reciept_no = $this->input->post('reciept_no');
      $ref_voucher = (int) $this->input->post('ref_voucher');
      $posting_date = $this->input->post('posting_date');
      
      $data = array(
    
        'file' =>$file_name,
        'branch_id'=>$branch_id,
        'reciept_no' => $reciept_no,
        'PV_ID' => $ref_voucher,
        'posting_date' =>$posting_date
      );
    
      $response =$this->db->insert('tbl_reciept',$data);
      if ($response) {
          return $this->db->insert_id();
      }else{
    
          return FALSE;
      }
    }
    
    public function update_voucher_reciept(){
      
      $ref_voucher = (int) $this->input->post('ref_voucher');
      $reciept_no = $this->input->post('reciept_no');
      $ref = array(
        'reciept' => $reciept_no,
        'isPaid' =>'paid',
       
      );
      
      $this->db->where('PV_ID', $ref_voucher);
      $this->db->update('tbl_payment_voucher',$ref);
    
      return $ref_voucher;
    }
   
    /*-------Manage Payment Receipt----------*/ 

    public function payment_receipt(){

      $branch_id = $_SESSION['branch_id'];
      $this->db->select('*');
      $this->db->from('tbl_reciept AS receipt');
      $this->db->join('tbl_payment_voucher as voucher','receipt.PV_ID = voucher.PV_ID');
      $this->db->where('receipt.branch_id',$branch_id);
      return $this->db->get()->result();

    }
    public function table_ledger(){

      $branch_id = $_SESSION['branch_id'];
      $this->db->select('*');
      $this->db->from('tbl_ledger AS ledger');
     // $this->db->join('tbl_accounts_payable as bills','ledger.AP_ID = bills.AP_ID');
      $this->db->join('tbl_supplier as supplier','ledger.supplier_id = supplier.supplier_id');
      $this->db->where('ledger.branch_id',$branch_id);
      $this->db->where('ledger.isStatus','Unpaid');
      return $this->db->get()->result();
    }

    public function schedule_table_ledger(){

      $branch_id = $_SESSION['branch_id'];
      $this->db->select('*');
      $this->db->from('tbl_ledger AS ledger');
      $this->db->join('tbl_supplier as supplier','ledger.supplier_id = supplier.supplier_id');
      $this->db->where('ledger.branch_id',$branch_id);
      $this->db->where('ledger.isStatus','Unpaid');
      return $this->db->get()->result();
    }


    public function select_receipt($id){
      $branch_id = $_SESSION['branch_id'];
      $this->db->select('*');
      $this->db->from('tbl_reciept');
     
      $this->db->where('AP_ID',$id);
      $this->db->where('ap.branch_id',$branch_id);
      return $this->db->get()->row();
    }
    
    public function table_ledger1(){
      $branch_id = $_SESSION['branch_id'];
      $this->db->select('*');
      $this->db->from('tbl_ledger AS ledger');
      $this->db->join('tbl_supplier as supplier','ledger.supplier_id = supplier.supplier_id');

      $this->db->join('tbl_branch as branch','branch.branch_id = ledger.branch_id');
      $this->db->where('isStatus','Unpaid');
      return $this->db->get()->result();

    }

      public function check_amount($checked_id){

        $this->db->select_sum('amount');
        $this->db->from('tbl_invoice_id');
        $this->db->where_in('PI_ID',$checked_id);
        $query = $this->db->get();
        return $query->row()->amount;

      }
      
       public function getPV($checked_id){
        $branch = $_SESSION['branch_id'];
        $this->db->select('*');
        $this->db->from('tbl_invoice_id as inv');
        $this->db->join('tbl_purchase_invoice as invoice','inv.PI_ID = invoice.PI_ID');
        $this->db->where_in('invoice.PI_ID',$checked_id);
        //$this->db->where('Reference',"0");
        return $this->db->get()->result();
       }
       public function getPV1($checked_id){
        $branch = $_SESSION['branch_id'];
        $this->db->select('*');
        $this->db->from('tbl_purchase_invoice');
        $this->db->where_in('PI_ID',$checked_id);
        //$this->db->where('Reference',"0");
        return $this->db->get()->result();
       }

       public function get_supplier_pv($checked_id){
        $this->db->select('*');
        $this->db->from('tbl_purchase_invoice as invoice');
        $this->db->join('tbl_supplier as supplier','invoice.supplier_id = supplier.supplier_id');
        $this->db->join('tbl_purchase_order as order','order.PO_ID = invoice.PO_ID');
        $this->db->where_in('PI_ID',$checked_id);
       
        return $this->db->get()->row();

       }
      public function gen_count_voucher_notif(){
        
        $branch = $_SESSION['branch_id'];
      
          $this->db->count_all_results('tbl_payment_voucher');
          $this->db->like('isPending', 'pending');
          $this->db->from('tbl_payment_voucher');
         $this->db->where('isCancel','no');
        $query= $this->db->count_all_results();
         return $query;
        }
        public function manage_voucher_notif(){

         // $branch = $_SESSION['branch_id'];
          $position = $_SESSION['Position'];
          $this->db->select('*');
          $this->db->from('tbl_payment_voucher AS voucher');
          $this->db->join('tbl_branch AS branch','voucher.branch_id = branch.branch_id');
          $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
           $this->db->where('isPending','pending');
           $this->db->where('isCancel','no');
           $query = $this->db->get()->result() ;
           return $query;
      
         }

         public function fin_count_voucher_notif(){
          $branch = $_SESSION['branch_id'];
          $this->db->count_all_results('tbl_payment_voucher');
         $this->db->like('sent', '1');
          $this->db->from('tbl_payment_voucher');
         $this->db->where('isCancel','no');
         $this->db->where('branch_id', $branch);
        $query= $this->db->count_all_results();
         return $query;

          }
          public function fin_manage_voucher_notif(){
           
            $branch = $_SESSION['branch_id'];
            $position = $_SESSION['Position'];
            $this->db->select('*');
            $this->db->from('tbl_payment_voucher AS voucher');
            $this->db->join('tbl_branch AS branch','voucher.branch_id = branch.branch_id');
            $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
            $this->db->where('voucher.sent','1');
            $this->db->where('voucher.isCancel','no');
            $this->db->where('voucher.branch_id',$branch);
            $query = $this->db->get()->result() ;
            return $query;
            }

            public function unseen($id){

              $data = array(
                'sent'=>'3');
               $this->db->where('PV_ID',$id);
                
               $response =$this->db->update('tbl_payment_voucher',$data);
               
                    if ($response) {
                        return $id;
                    }else{
                        return false;
                    }
             }
             public function supplier_search($data){
              $branch =$_SESSION['branch_id'];
              $this->db->select('*');
              $this->db->from('tbl_purchase_order as order');
              $this->db->join('tbl_purchase_invoice as invoice','order.PO_ID = invoice.PO_ID');
            $this->db->where('.invoice.branch_id',$branch);
             $this->db->where('Reference','0');
             $this->db->where('sent','1');
              if ($data != '') {
                  $this->db->like('invoice.supplier_id',$data);
               
              }else{
                  
              }
              return $this->db->get();
        
          }

          public function add_voucher(){
             
            $branch = $_SESSION['branch_id'];
            $user = $_SESSION['User_ID'];
            $remarks = $this->input->post('remarks');

         
          $voucher =[
              'payment_voucher_no' =>$this->input->post('voucher_no'),
              'supplier_id' =>$this->input->post('supplier_id'),
              'voucher_date' =>$this->input->post('voucher_date'),
              'branch_id' =>$branch,
              'total_amount' =>$this->input->post('total_amount'),
              'payment_method' =>$this->input->post('payment_terms'),
              'User_ID' =>$user,
              'remarks'=> $remarks

              
          ];
        
          $this->db->insert('tbl_payment_voucher',$voucher);
      
            $last_id = $this->db->insert_id();
      
            //$plate = $this->input->post('');
            $quantity = $this->input->post('quantity');
            $unit = $this->input->post('unit');
            $description = $this->input->post('description');
            $unit_price = $this->input->post('unit_price');
            $amount = $this->input->post('amount');
            $pi_id = $this->input->post('pi_id');
           // $car_id = $this->input->post('car_id');

              foreach ($quantity as $index => $quantity) {
                $arr_quantity = $quantity;
                $arr_unit = $unit[$index];
                $arr_desc = $description[$index];
                $arr_unit_price= $unit_price[$index];
                $arr_amount = $amount[$index];
                $arr_pi_id = $pi_id[$index];
                $data =[
                  'PV_ID'=>$last_id,
                  'PI_ID'=>$arr_pi_id,
                  'quantity' => $arr_quantity,
                  'unit' => $arr_unit,
                  'description' =>$arr_desc,
                  'unit_price' => $arr_unit_price,
                  'amount' => $arr_amount,
                  //'car_id' => '0'

                ];
                $this->db->insert('tbl_pv_reference',$data);
      
              }
              
              return $this->db->insert_id();
          }
       
          /*---------------Insert PA Ledger----------------------*/ 
          public function add_pa_ledger(){
            $this->update_voucher_ref();
            $this->Paid_ap_bills();
            $branch = $_SESSION['branch_id'];
           $user = $_SESSION['User_ID'];
          $pa_ledger =[
              'PA_no' =>$this->input->post('paledger_no'),
              'reciept_id' =>$this->input->post('reciept_id'),
              'PV_ID' =>$this->input->post('ref_voucher'),
              'paid_amount' =>$this->input->post('amount'),
              'User_ID'=>$user
        
              
          ];

          $response =$this->db->insert('tbl_pa_ledger',$pa_ledger);
          if ($response) {
              return $this->db->insert_id();
          }else{
        
              return FALSE;
          }
         
          }
          public function update_voucher_ref(){

            $voucher_id = $this->input->post('PV_ID');

            $data = array(
              'hide'=>'2');
             $this->db->where('PV_ID',$voucher_id);
              
             $response =$this->db->update('tbl_payment_voucher',$data);
             
                  if ($response) {
                      return $voucher_id;
                  }else{
                      return false;
                  }
           }

          public function update_ref($check){
             $data = array(
               'Reference'=>'2');
              $this->db->where_in('PI_ID',$check);
               
              $response =$this->db->update('tbl_purchase_invoice',$data);
              
                   if ($response) {
                       return $check;
                   }else{
                       return false;
                   }
            }
 
            public function update_ledger($check){
             $voucher = $this->input->post('voucher');
             
             $data = array(
               'PV_ID'=>$voucher,
               'isStatus' => 'Paid',
               'balance' => '0',
             );
              $this->db->where_in('PI_ID',$check);
               
              $response =$this->db->update('tbl_ledger',$data);
              
                   if ($response) {
                       return $check;
                   }else{
                       return false;
                   }
            }

/*-----------INSERT AP BILLS TO LEDGER------------------*/ 


public function update_ledger_bills(){
  $voucher = $this->input->post('voucher');
  $bills = $this->input->post('AP_ID');
  
  $data = array(
    'PV_ID'=>$voucher,
    'isStatus' => 'Paid',
    'balance'=> '0'
  );
   $this->db->where('AP_ID',$bills);
    
   $response =$this->db->update('tbl_ledger',$data);
   
        if ($response) {
            return $bills;
        }else{
            return false;
        }
 }
 public function Paid_ap_bills(){

  $bills = $this->input->post('AP_ID');
  
  $data = array(
  
    'isStatus' => 'Paid'
  );
   $this->db->where('AP_ID',$bills);
    
   $response =$this->db->update('tbl_accounts_payable',$data);
   
        if ($response) {
            return $bills;
        }else{
            return false;
        }
 }



        /*----------------Ledger Number--------------------*/ 
        public function auto_number_ledger(){
    
          $year = date('Y');
          $text = "AP".'-'.$year;
          $query = "SELECT max(AP_no) as code_auto from tbl_ledger";
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

      public function auto_number_pa_ledger(){

        $year = date('Y');
        $text = "PA".'-'.$year;
        $query = "SELECT max(PA_no) as code_auto from tbl_pa_ledger";
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
    

      public function table_pa(){

      $branch_id = $_SESSION['branch_id'];
      $this->db->select('*');
      $this->db->from('tbl_pa_ledger AS ledger');
      $this->db->join('tbl_payment_voucher AS voucher', 'ledger.PV_ID = voucher.PV_ID');
      $this->db->join('tbl_supplier as supplier','supplier.supplier_id = voucher.supplier_id');
      $this->db->join('tbl_reciept as reciept','ledger.reciept_id = reciept.reciept_id');
      $this->db->join('tbl_branch as branch','voucher.branch_id = branch.branch_id');
      $this->db->where('voucher.isPending',"approved");
      $this->db->where('voucher.branch_id',$branch_id);
      //$this->db->where('voucher.isCancel','no');
      return $this->db->get()->result();

    }
    public function gen_table_pa(){
      $this->db->select('*');
      $this->db->from('tbl_pa_ledger AS ledger');
      $this->db->join('tbl_payment_voucher AS voucher', 'ledger.PV_ID = voucher.PV_ID');
      $this->db->join('tbl_supplier as supplier','supplier.supplier_id = voucher.supplier_id');
      $this->db->join('tbl_reciept as reciept','ledger.reciept_id = reciept.reciept_id');
      $this->db->join('tbl_branch as branch','voucher.branch_id = branch.branch_id');
      $this->db->where('voucher.isPending',"approved");
      return $this->db->get()->result();
    }
    
    /**********Get the total Quantity*************/ 

    public function tot_quant($id){
      //$id = $this->input->post('req_ID');
      $sql = "SELECT SUM(quantity) As quantity FROM tbl_purchase_request where purchase_request_no = $id";
      $result = $this->db->query($sql);
      return $result->row()->quantity;
    }

    /**********SMS FEATURE*************/ 
    public function Select_contact($id){
      $this->db->select('*');
      $this->db->from('tbl_payment_voucher AS voucher');
      $this->db->join('tbl_branch AS branch','voucher.branch_id = branch.branch_id');
      $this->db->join('tbl_user AS user','voucher.User_ID = user.User_ID');
      $this->db->where('voucher.PV_ID',$id);
      $query = $this->db->get()->row();
      return $query;
    }

    public function get_branch(){
      $branch = $_SESSION['branch_id'];
            $this->db->where('branch_id',1);
            $query = $this->db->get('tbl_branch');
            $row = $query->row();
            return $row;
        }
        public function sms_contact(){
        $branch = $this->input->post('contact_id');
           $this->db->where('branch_id',$branch);
                $query = $this->db->get('tbl_branch');
                $row = $query->row();
                return $row;
            }
        public function sms_branch(){
          $branch = $_SESSION['branch_id'];
            $this->db->where('branch_id',$branch);
            $query = $this->db->get('tbl_branch');
            $row = $query->row();
            return $row;
            }

          /**********SMS FEATURE*************/  



          /*-------AP BILLS TO VOUCHERS----------*/ 

          public function ap_bills_voucher($id){
            $this->db->select('*');
            $this->db->from('tbl_accounts_payable as ap');
            $this->db->join('tbl_supplier as supplier','ap.supplier_id = supplier.supplier_id');
            $this->db->where('AP_ID',$id);
            return $this->db->get()->row();
          }

          public function ap_view_voucher($id){
            $this->db->select('*');
            $this->db->from('tbl_payment_voucher as voucher');
            $this->db->join('tbl_supplier as supplier','voucher.supplier_id = supplier.supplier_id');
            $this->db->join('tbl_accounts_payable as ap','voucher.AP_ID = ap.AP_ID');
            $this->db->join('tbl_user as user','voucher.User_ID = user.User_ID');
            $this->db->where('PV_ID',$id);
            return $this->db->get()->row();
          }

          public function submit_bills(){
            $this->isHide1();
            $branch = $_SESSION['branch_id'];
            $user = $_SESSION['User_ID'];
            $remarks = $this->input->post('remarks');

            $data = array(

              'payment_voucher_no' =>$this->input->post('voucher_no'),
              'supplier_id' =>$this->input->post('supplier_id'),
              'voucher_date' =>$this->input->post('voucher_date'),
              'branch_id' =>$branch,
              'total_amount' =>$this->input->post('amount'),
              'payment_method' =>$this->input->post('payment_terms'),
              'AP_ID' =>$this->input->post('AP_ID'),
              'User_ID' =>$user,
              'remarks' =>$remarks
            );

            $response =$this->db->insert('tbl_payment_voucher',$data);
            if ($response) {
                return $this->db->insert_id();
            }else{
          
                return FALSE;
            }

          }

          public function isHide1(){
            $AP_ID = $this->input->post('AP_ID');
            $ref = array(
              'isHide' => '3'
            );
            
            $this->db->where('AP_ID',$AP_ID);
            $this->db->update('tbl_accounts_payable',$ref);
          
            return $AP_ID;
          }
          
}