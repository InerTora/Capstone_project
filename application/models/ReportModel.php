<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportModel extends CI_Model {

    public function branch(){
        $branch = $_SESSION['branch_id'];
        $this->db->select('*');
        $this->db->from('tbl_branch');
        $this->db->where('branch_id',$branch);
       return $this->db->get()->row();
       
    }
    public function print_voucher($id){
        $this->db->select('*');
        $this->db->from('tbl_payment_voucher AS voucher');
        //$this->db->join('tbl_purchase_invoice AS invoice', 'invoice.PI_ID = voucher.PI_ID');voucher
        $this->db->join('tbl_supplier AS supplier', 'supplier.supplier_id = voucher.supplier_id');
        $this->db->where('voucher.PV_ID',$id);
        return $this->db->get()->row();
      }

      public function list_voucher($id){
        $this->db->select('*');
        $this->db->from('tbl_payment_voucher AS voucher');
        $this->db->join('tbl_pv_reference AS ref','voucher.PV_ID = ref.PV_ID');
        $this->db->join('tbl_purchase_invoice AS invoice','ref.PI_ID = invoice.PI_ID');
        $this->db->where('voucher.PV_ID',$id);
        return $this->db->get()->result();
    }
    public function list_voucher_bills($id){
        $this->db->select('*');
        $this->db->from('tbl_payment_voucher AS voucher');
        $this->db->join('tbl_accounts_payable AS ap','voucher.AP_ID = ap.AP_ID');
       // $this->db->join('tbl_purchase_invoice AS invoice','ref.PI_ID = invoice.PI_ID');
        $this->db->where('voucher.PV_ID',$id);
        return $this->db->get()->result();
    }



    public function print_cheque($id){
        $this->db->select('*');
        $this->db->from('tbl_payment_voucher AS voucher');
        //$this->db->join('tbl_purchase_invoice AS invoice', 'invoice.PI_ID = voucher.PI_ID');voucher
        $this->db->join('tbl_supplier AS supplier', 'supplier.supplier_id = voucher.supplier_id');
        $this->db->where('voucher.PV_ID',$id);
        return $this->db->get()->row();
      }

    /*---------Supplier Reports----------------*/   

    public function SupplierFilter($from_date,$to_date){
        $branch = $_SESSION['branch_id'];
        $this->db->select("*");
        $this->db->from("tbl_supplier");
        $this->db->where("date_created BETWEEN '$from_date' AND '$to_date'");
        return $this->db->get()->result();
    }  
    public function gen_SupplierFilter($from_date,$to_date){
        $this->db->select("*");
        $this->db->from("tbl_supplier as supplier");
        $this->db->join('tbl_branch as branch','supplier.branch_id = branch.branch_id');
        $this->db->where("date_created BETWEEN '$from_date' AND '$to_date'");
        return $this->db->get()->result();
    } 
    public function report_supplier(){
        $branch = $_SESSION['branch_id'];
        $this->db->select('*');
        $this->db->from('tbl_supplier');
        // $this->db->where('branch_id',$branch);
       return $this->db->get()->result();
    }
    public function print_report_supplier(){
      
        $this->db->select('*');
        $this->db->from('tbl_supplier as supplier');
        $this->db->join('tbl_branch as branch','supplier.branch_id = branch.branch_id');
       
       return $this->db->get()->result();
    }
 public function gen_report_supplier(){
        $this->db->select('*');
        $this->db->from('tbl_supplier as supplier');
        $this->db->join('tbl_branch as branch','supplier.branch_id = branch.branch_id');
       return $this->db->get()->result();
    }
    /*-----------Purchase Order-----------------*/ 

    public function POFilter($from_date,$to_date){
        $branch = $_SESSION['branch_id'];
        $this->db->select("*");
        $this->db->from("tbl_purchase_order as order");
       $this->db->join('tbl_purchase_no AS request','order.purchase_request_id = request.purchase_request_id');
        $this->db->join('tbl_supplier AS supplier','supplier.supplier_id = request.supplier_id');
        $this->db->join('tbl_User as user','user.User_ID = order.User_ID');
        $this->db->where("po_date BETWEEN '$from_date' AND '$to_date' AND  order.branch_id = $branch");
        return $this->db->get()->result();
    }   
    public function gen_POFilter($from_date,$to_date){
   
        $this->db->select("*");
        $this->db->from("tbl_purchase_order as order");
        $this->db->join('tbl_purchase_no AS request','order.purchase_request_id = request.purchase_request_id');
        $this->db->join('tbl_supplier AS supplier','supplier.supplier_id = request.supplier_id');
        $this->db->join('tbl_branch as branch','order.branch_id = branch.branch_id');
        $this->db->join('tbl_User as user','user.User_ID = order.User_ID');
        $this->db->where("po_date BETWEEN '$from_date' AND '$to_date'");
        return $this->db->get()->result();
    }  
    public function print_po_report(){

        $branch = $_SESSION['branch_id'];
        $this->db->select('*');
        $this->db->from('tbl_purchase_order AS order');
        $this->db->join('tbl_purchase_no AS request','order.purchase_request_id = request.purchase_request_id');
        $this->db->join('tbl_supplier AS supplier','supplier.supplier_id = request.supplier_id');
        $this->db->join('tbl_branch AS br','br.branch_id = order.branch_id');
        $this->db->join('tbl_user AS user','user.User_ID = order.User_ID');
       $this->db->where('order.branch_id',$branch);
       return $this->db->get()->result();
    }

    public function gen_print_po_report(){
        $this->db->select('*');
        $this->db->from('tbl_purchase_order AS order');
        $this->db->join('tbl_purchase_no AS request','order.purchase_request_id = request.purchase_request_id');
        $this->db->join('tbl_supplier AS supplier','supplier.supplier_id = request.supplier_id');
        $this->db->join('tbl_branch AS br','br.branch_id = order.branch_id');
        $this->db->join('tbl_user AS user','user.User_ID = order.User_ID');
        $this->db->join('tbl_branch as branch','order.branch_id = branch.branch_id');
      
       return $this->db->get()->result();
    }

    
    public function branch_print_po_report(){
        $branch = $_SESSION['branch_id'];
        $this->db->select('*');
        $this->db->from('tbl_purchase_order AS order');
        $this->db->join('tbl_purchase_no AS request','order.purchase_request_id = request.purchase_request_id');
        $this->db->join('tbl_supplier AS supplier','supplier.supplier_id = request.supplier_id');
        $this->db->join('tbl_branch AS br','br.branch_id = order.branch_id');
        $this->db->join('tbl_user AS user','user.User_ID = order.User_ID');
        $this->db->join('tbl_branch as branch','order.branch_id = branch.branch_id');
        $this->db->where('order.branch_id',$branch);
       return $this->db->get()->result();
    }
    /*-------------Purchase Invoice--------------------*/ 

        public function InvoiceFilter($from_date,$to_date){
            $branch = $_SESSION['branch_id'];
        $this->db->select("*");

        $this->db->from('tbl_purchase_order AS order');
        $this->db->join('tbl_purchase_invoice AS invoice','order.PO_ID = invoice.PO_ID');
        $this->db->join('tbl_supplier AS supplier','supplier.supplier_id = invoice.supplier_id');
        $this->db->join('tbl_user AS user','user.User_ID = invoice.User_ID');
        $this->db->where("invoice.due_date BETWEEN '$from_date' AND '$to_date' AND invoice.branch_id = $branch");
        return $this->db->get()->result();
    }

    public function genInvoiceFilter($from_date,$to_date){
   
        $this->db->select("*");
        $this->db->from('tbl_purchase_order AS order');
        $this->db->join('tbl_purchase_invoice AS invoice','order.PO_ID = invoice.PO_ID');
        $this->db->join('tbl_supplier AS supplier','supplier.supplier_id = invoice.supplier_id');
        $this->db->join('tbl_branch AS br','br.branch_id = invoice.branch_id');
        $this->db->join('tbl_user AS user','user.User_ID = invoice.User_ID');

        $this->db->where("due_date BETWEEN '$from_date' AND '$to_date'");
        return $this->db->get()->result();
    }


    public function print_invoice(){

        $branch = $_SESSION['branch_id'];
        $this->db->select('*');
        $this->db->from('tbl_purchase_order AS order');
        $this->db->join('tbl_purchase_invoice AS invoice','order.PO_ID = invoice.PO_ID');
        $this->db->join('tbl_supplier AS supplier','supplier.supplier_id = invoice.supplier_id');
        $this->db->join('tbl_branch AS br','br.branch_id = invoice.branch_id');
        $this->db->join('tbl_user AS user','user.User_ID = invoice.User_ID');
       $this->db->where('order.branch_id',$branch);
       return $this->db->get()->result();
    
    }

    public function gen_print_invoice(){

        $this->db->select('*');
        $this->db->from('tbl_purchase_order AS order');
        $this->db->join('tbl_purchase_invoice AS invoice','order.PO_ID = invoice.PO_ID');
        $this->db->join('tbl_supplier AS supplier','supplier.supplier_id = order.supplier_id');
        $this->db->join('tbl_branch AS br','br.branch_id = order.branch_id');
        $this->db->join('tbl_user AS user','user.User_ID = invoice.User_ID');
       return $this->db->get()->result();
    
    }
    
    /*-------Payment Voucher Reports-----------------*/ 


    public function VoucherFilter($from_date,$to_date){

        $branch = $_SESSION['branch_id'];
        $this->db->select("*");
        $this->db->from('tbl_payment_voucher AS voucher');
        $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
        $this->db->join('tbl_branch AS br','br.branch_id = voucher.branch_id');
         $this->db->join('tbl_user AS user','user.User_ID = voucher.User_ID');
        $this->db->where("voucher_date BETWEEN '$from_date' AND '$to_date'");
        return $this->db->get()->result();
    }  
    public function branch_VoucherFilter($from_date,$to_date){

        $branch = $_SESSION['branch_id'];
        $this->db->select("*");
        $this->db->from('tbl_payment_voucher AS voucher');
        $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
        $this->db->join('tbl_branch AS br','br.branch_id = voucher.branch_id');
         $this->db->join('tbl_user AS user','user.User_ID = voucher.User_ID');
        $this->db->where("voucher_date BETWEEN '$from_date' AND '$to_date' AND voucher.branch_id =$branch");
        return $this->db->get()->result();
    }  

    public function  branch_reports_voucher(){
    $branch = $_SESSION['branch_id'];
    $this->db->select('*');
    $this->db->from('tbl_payment_voucher AS voucher');
    $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
    $this->db->join('tbl_branch AS br','br.branch_id = voucher.branch_id');
    $this->db->join('tbl_user AS user','user.User_ID = voucher.User_ID');
    $this->db->where('voucher.branch_id',$branch);
    
    return $this->db->get()->result();
        }
        public function  gen_reports_vouche_print(){
            $branch = $_SESSION['branch_id'];
            $this->db->select('*');
            $this->db->from('tbl_payment_voucher AS voucher');
            $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
            $this->db->join('tbl_branch AS br','br.branch_id = voucher.branch_id');
            $this->db->join('tbl_user AS user','user.User_ID = voucher.User_ID');
           
            return $this->db->get()->result();
        
                }
        


    public function  gen_reports_voucher(){//General View Display
            $this->db->select('*');
            $this->db->from('tbl_payment_voucher AS voucher');
            $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
            $this->db->join('tbl_branch AS br','br.branch_id = voucher.branch_id');
            $this->db->join('tbl_user AS user','user.User_ID = voucher.User_ID');
            return $this->db->get()->result();
        
                }

        /*--------Payment Schedule Reports--------------*/ 

        public function payment_list(){
            $this->db->select('*');
            $this->db->from('tbl_ledger AS ledger');
            $this->db->join('tbl_supplier as supplier','supplier.supplier_id = ledger.supplier_id');
           $this->db->join('tbl_branch as branch','branch.branch_id = ledger.branch_id');
           
            return $this->db->get()->result();
        }
        public function branch_payment_list(){
            $branch = $_SESSION['branch_id'];
            $this->db->select('*');
            $this->db->from('tbl_ledger AS ledger');
            $this->db->join('tbl_supplier as supplier','supplier.supplier_id = ledger.supplier_id');
            $this->db->join('tbl_branch as branch','branch.branch_id = ledger.branch_id');
            $this->db->where('ledger.branch_id',$branch);
            return $this->db->get()->result();
        }

        public function PaymentFilter($from_date,$to_date){
            $branch = $_SESSION['branch_id'];
            $this->db->select("*");
            $this->db->from('tbl_ledger AS ledger');
            $this->db->join('tbl_supplier as supplier','supplier.supplier_id = ledger.supplier_id');
            $this->db->join('tbl_branch as branch','branch.branch_id = ledger.branch_id');
            $this->db->where("isDue_date BETWEEN '$from_date' AND '$to_date'");
            return $this->db->get()->result();
        }  
        public function branch_PaymentFilter($from_date,$to_date){
            $branch = $_SESSION['branch_id'];
            $this->db->select("*");
            $this->db->from('tbl_ledger AS ledger');
            $this->db->join('tbl_supplier as supplier','supplier.supplier_id = ledger.supplier_id');
            $this->db->join('tbl_branch as branch','branch.branch_id = ledger.branch_id');
            $this->db->where("isDue_date BETWEEN '$from_date' AND '$to_date' AND ledger.branch_id = $branch");
            return $this->db->get()->result();
        }  
    
/*----------Supplier Balance To Date----------------*/ 

public function supplier_balance_list(){
    $branch = $_SESSION['branch_id'];
    $this->db->select('*');

    $this->db->from('tbl_ledger as ledger');
    $this->db->join('tbl_purchase_invoice as invoice','invoice.PI_ID = ledger.PI_ID');
    $this->db->join('tbl_supplier AS supplier', 'supplier.supplier_id = ledger.supplier_id');
    $this->db->join('tbl_branch AS br','br.branch_id = ledger.branch_id');
    $this->db->where('ledger.branch_id',$branch);
    return $this->db->get()->result();
}
public function gen_supplier_balance_list(){
    
    $this->db->select('*');
    $this->db->from('tbl_ledger as ledger');
    $this->db->join('tbl_purchase_invoice as invoice','invoice.PI_ID = ledger.PI_ID');
    $this->db->join('tbl_supplier AS supplier', 'supplier.supplier_id = ledger.supplier_id');
    $this->db->join('tbl_branch AS br','br.branch_id = ledger.branch_id');
    return $this->db->get()->result();
}


public function BalanceFilter($from_date,$to_date){
    $branch = $_SESSION['branch_id'];
    $this->db->select("*");
     $this->db->from('tbl_ledger as ledger');
    $this->db->join('tbl_purchase_invoice as invoice','invoice.PI_ID = ledger.PI_ID');
    $this->db->join('tbl_supplier AS supplier', 'supplier.supplier_id = ledger.supplier_id');
    $this->db->join('tbl_branch AS br','br.branch_id = ledger.branch_id');
   
    $this->db->where("invoice.due_date BETWEEN '$from_date' AND '$to_date'");
    return $this->db->get()->result();
}  

public function branch_BalanceFilter($from_date,$to_date){
    $branch = $_SESSION['branch_id'];
    $this->db->select("*");
     $this->db->from('tbl_ledger as ledger');
    $this->db->join('tbl_purchase_invoice as invoice','invoice.PI_ID = ledger.PI_ID');
    $this->db->join('tbl_supplier AS supplier', 'supplier.supplier_id = ledger.supplier_id');
    $this->db->join('tbl_branch AS br','br.branch_id = ledger.branch_id');
   
    $this->db->where("invoice.due_date BETWEEN '$from_date' AND '$to_date' AND ledger.branch_id = $branch");
    return $this->db->get()->result();
}  

/*-------Accounts Payable Ageing------------*/ 

public function ap_ageing(){

    $this->db->select('*');
    $this->db->from('tbl_ledger AS ledger');
    $this->db->join('tbl_supplier as supplier','supplier.supplier_id = ledger.supplier_id');
    $this->db->join('tbl_branch as branch','branch.branch_id = ledger.branch_id');
    $this->db->join('tbl_user AS user','user.User_ID = ledger.User_ID');
    $this->db->where('ledger.isStatus',"Unpaid");
    return $this->db->get()->result();
 
 }
 
 public function branch_ap_ageing(){
    $branch = $_SESSION['branch_id'];
    $this->db->select('*');
    $this->db->from('tbl_ledger AS ledger');
    $this->db->join('tbl_supplier as supplier','supplier.supplier_id = ledger.supplier_id');
    $this->db->join('tbl_user AS user','user.User_ID = ledger.User_ID');
    $this->db->where('ledger.isStatus',"Unpaid");
    $this->db->where('ledger.branch_id',$branch);
    return $this->db->get()->result();
 
 }
 public function gen_ap_ageing(){
    $branch = $_SESSION['branch_id'];
 $this->db->select('*');

 $this->db->from('tbl_ledger as ledger');
 $this->db->join('tbl_purchase_invoice as invoice','invoice.PI_ID = ledger.PI_ID');
 $this->db->join('tbl_supplier AS supplier', 'supplier.supplier_id = ledger.supplier_id');
 $this->db->join('tbl_branch AS br','br.branch_id = ledger.branch_id');
 $this->db->join('tbl_user AS user','user.User_ID = ledger.User_ID');
 $this->db->where('ledger.branch_id',$branch);
 $this->db->where('ledger.isStatus',"Unpaid");
 return $this->db->get()->result();
 }
 
 public function AgeingFilter($from_date,$to_date){
    $branch = $_SESSION['branch_id'];
    $this->db->select("*");

    $this->db->from('tbl_ledger as ledger');
    $this->db->join('tbl_supplier AS supplier', 'supplier.supplier_id = ledger.supplier_id');
    $this->db->join('tbl_branch AS br','br.branch_id = ledger.branch_id');
    $this->db->join('tbl_user AS user','user.User_ID = ledger.User_ID');
    $this->db->where("isDue_date BETWEEN '$from_date' AND '$to_date'");
    return $this->db->get()->result();
}  


public function branch_AgeingFilter($from_date,$to_date){
    $branch = $_SESSION['branch_id'];
    $this->db->select("*");

    $this->db->from('tbl_ledger as ledger');
    $this->db->join('tbl_purchase_invoice as invoice','invoice.PI_ID = ledger.PI_ID');
    $this->db->join('tbl_supplier AS supplier', 'supplier.supplier_id = ledger.supplier_id');
    $this->db->join('tbl_user AS user','user.User_ID = ledger.User_ID');
    $this->db->where("isDue_date BETWEEN '$from_date' AND '$to_date' AND  ledger.branch_id = $branch");
    return $this->db->get()->result();
} 
public function getuser1(){
    
          $this->db->where('User_ID',1);
          $query = $this->db->get('tbl_user');
          $row = $query->row();
          return $row;
      }


      public function gen_filter_AP_ledger($from_date,$to_date){
       
        $this->db->select('*');
        $this->db->from('tbl_ledger AS ledger');
        $this->db->join('tbl_supplier as supplier','ledger.supplier_id = supplier.supplier_id');
  
        $this->db->join('tbl_branch as branch','branch.branch_id = ledger.branch_id');
        $this->db->where("isDue_date BETWEEN '$from_date' AND '$to_date'");
        $this->db->where('isStatus','Unpaid');
        return $this->db->get()->result();
  
      }

      public function branch_filter_AP_ledger($from_date,$to_date){
        $branch = $_SESSION['branch_id'];
        $this->db->select('*');
        $this->db->from('tbl_ledger AS ledger');
        $this->db->join('tbl_supplier as supplier','ledger.supplier_id = supplier.supplier_id');
        $this->db->where("isDue_date BETWEEN '$from_date' AND '$to_date' AND  ledger.branch_id = $branch");
        $this->db->where('isStatus','Unpaid');
        return $this->db->get()->result();
  
      }

      public function gen_filter_PA_ledger($from_date,$to_date){
        $this->db->select('*');
        $this->db->from('tbl_pa_ledger AS ledger');
        $this->db->join('tbl_payment_voucher AS voucher', 'ledger.PV_ID = voucher.PV_ID');
        $this->db->join('tbl_supplier as supplier','supplier.supplier_id = voucher.supplier_id');
        $this->db->join('tbl_reciept as reciept','ledger.reciept_id = reciept.reciept_id');
        $this->db->join('tbl_branch as branch','voucher.branch_id = branch.branch_id');
        $this->db->where("voucher_date BETWEEN '$from_date' AND '$to_date'");
        $this->db->where('voucher.isPending',"approved");
        return $this->db->get()->result();
      }

      public function branch_filter_PA_ledger($from_date,$to_date){
        $branch = $_SESSION['branch_id'];
        $this->db->select('*');
        $this->db->from('tbl_pa_ledger AS ledger');
        $this->db->join('tbl_payment_voucher AS voucher', 'ledger.PV_ID = voucher.PV_ID');
        $this->db->join('tbl_supplier as supplier','supplier.supplier_id = voucher.supplier_id');
        $this->db->join('tbl_reciept as reciept','ledger.reciept_id = reciept.reciept_id');
        $this->db->join('tbl_branch as branch','voucher.branch_id = branch.branch_id');
        $this->db->where("voucher_date BETWEEN '$from_date' AND '$to_date'  AND  voucher.branch_id = $branch");
        $this->db->where('voucher.isPending',"approved");
        return $this->db->get()->result();
      }

}