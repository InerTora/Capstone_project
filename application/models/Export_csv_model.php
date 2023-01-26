<?php

class Export_csv_model extends CI_Model{
    

    public function fetch_all(){

        $this->db->select("supplier_name,street,barangay,city,province,contact");
        $this->db->from('tbl_supplier');
        return $this->db->get();
    }
/*--------Start of Purchase order----------------*/ 
    public function gen_export_po_report(){
        $this->db->select('request.purchase_request_no,order.purchase_order_no,supplier.supplier_name,order.po_date,user.Last_Name,user.Position,branch.branch_name');
        $this->db->from('tbl_purchase_order AS order');
        $this->db->join('tbl_purchase_no AS request','order.purchase_request_id = request.purchase_request_id');
        $this->db->join('tbl_supplier AS supplier','supplier.supplier_id = request.supplier_id');
        $this->db->join('tbl_branch AS br','br.branch_id = order.branch_id');
        $this->db->join('tbl_user AS user','user.User_ID = order.User_ID');
        $this->db->join('tbl_branch as branch','order.branch_id = branch.branch_id');
      
       return $this->db->get();
    }

    public function branch_export_po_report(){
        $this->db->select('request.purchase_request_no,order.purchase_order_no,supplier.supplier_name,order.po_date,user.Last_Name,user.Position');
        $branch = $_SESSION["branch_id"];
        $this->db->from('tbl_purchase_order AS order');
        $this->db->join('tbl_purchase_no AS request','order.purchase_request_id = request.purchase_request_id');
        $this->db->join('tbl_supplier AS supplier','supplier.supplier_id = request.supplier_id');
        $this->db->join('tbl_branch AS br','br.branch_id = order.branch_id');
        $this->db->join('tbl_user AS user','user.User_ID = order.User_ID');
        $this->db->where('order.branch_id',$branch);
      
       return $this->db->get();
    }

    
    /*--------End of Purchase Order--------------*/ 

 /*--------End of Purchase Invoice--------------*/ 
    public function gen_export_invoice(){

        $this->db->select('invoice.purchase_invoice_no,order.purchase_order_no,supplier.supplier_name,invoice.total_amount,invoice.invoice_date,invoice.due_date,user.Last_Name,branch.branch_name');
        $this->db->from('tbl_purchase_order AS order');
        $this->db->join('tbl_purchase_invoice AS invoice','order.PO_ID = invoice.PO_ID');
        $this->db->join('tbl_supplier AS supplier','supplier.supplier_id = order.supplier_id');
        $this->db->join('tbl_branch AS branch','branch.branch_id = order.branch_id');
        $this->db->join('tbl_user AS user','user.User_ID = order.User_ID');
       // $this->db->where('order.branch_id',$branch);
       return $this->db->get();
    
    }
    public function branch_export_invoice(){
        $branch = $_SESSION["branch_id"];
        $this->db->select('invoice.purchase_invoice_no,order.purchase_order_no,supplier.supplier_name,invoice.total_amount,invoice.invoice_date,invoice.due_date,user.Last_Name');
        $this->db->from('tbl_purchase_order AS order');
        $this->db->join('tbl_purchase_invoice AS invoice','order.PO_ID = invoice.PO_ID');
        $this->db->join('tbl_supplier AS supplier','supplier.supplier_id = order.supplier_id');
        $this->db->join('tbl_user AS user','user.User_ID = invoice.User_ID');
       return $this->db->get();
    }

     /*--------End of Purchase Invoice--------------*/ 


    /*------Start Payment Voucher---------------*/  

    public function  gen_export_voucher(){
        $this->db->select('voucher.payment_voucher_no,supplier.supplier_name,voucher.payment_method,voucher.total_amount,voucher.voucher_date,user.Last_Name,branch.branch_name');
        $this->db->from('tbl_payment_voucher AS voucher');
        $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
        $this->db->join('tbl_branch AS branch','branch.branch_id = voucher.branch_id');
        $this->db->join('tbl_user AS user','user.User_ID = voucher.User_ID');
        return $this->db->get();
    
    }

    public function  branch_export_voucher(){
        $branch = $_SESSION["branch_id"];
        $this->db->select('voucher.payment_voucher_no,supplier.supplier_name,voucher.payment_method,voucher.total_amount,voucher.voucher_date,user.Last_Name');
        $this->db->from('tbl_payment_voucher AS voucher');
        $this->db->join('tbl_supplier AS supplier','voucher.supplier_id = supplier.supplier_id');
        $this->db->join('tbl_user AS user','user.User_ID = voucher.User_ID');
        $this->db->where('voucher.branch_id',$branch);
        return $this->db->get();
            
    }

    /*-------AGING Report----------------*/ 

    public function ap_export_ageing(){

        $this->db->select('ledger.isReference,supplier.supplier_name,ledger.isDue_date,ledger.balance,ledger.invoice_amount,user.Last_Name,branch.branch_name');
        $this->db->from('tbl_ledger AS ledger');
        $this->db->join('tbl_supplier as supplier','supplier.supplier_id = ledger.supplier_id');
        $this->db->join('tbl_branch as branch','branch.branch_id = ledger.branch_id');
        $this->db->join('tbl_user AS user','user.User_ID = ledger.User_ID');
        $this->db->where('ledger.isStatus',"Unpaid");
        return $this->db->get();
     
     }

     public function branch_ap_export_ageing(){

        $branch = $_SESSION["branch_id"];

        $this->db->select('ledger.isReference,supplier.supplier_name,ledger.isDue_date,ledger.balance,ledger.invoice_amount,user.Last_Name');
        $this->db->from('tbl_ledger AS ledger');
        $this->db->join('tbl_supplier as supplier','supplier.supplier_id = ledger.supplier_id');
        $this->db->join('tbl_branch as branch','branch.branch_id = ledger.branch_id');
        $this->db->join('tbl_user AS user','user.User_ID = ledger.User_ID');
        $this->db->where('ledger.isStatus',"Unpaid");
        $this->db->where('ledger.branch_id',$branch);
        return $this->db->get();
     
     }
     
    /*------Supplier Balance to date-----------*/  

    public function gen_export_supplier_balance(){
    
        $this->db->select('invoice.purchase_invoice_no,supplier_name,invoice.due_date,invoice.invoice_date,ledger.balance,branch.branch_name');
        $this->db->from('tbl_ledger as ledger');
        $this->db->join('tbl_purchase_invoice as invoice','invoice.PI_ID = ledger.PI_ID');
        $this->db->join('tbl_supplier AS supplier', 'supplier.supplier_id = ledger.supplier_id');
        $this->db->join('tbl_branch AS branch','branch.branch_id = ledger.branch_id');
        return $this->db->get();
    }

    public function branch_export_supplier_balance(){
        $branch = $_SESSION["branch_id"];
        $this->db->select('invoice.purchase_invoice_no,supplier_name,invoice.due_date,invoice.invoice_date,ledger.balance');
        $this->db->from('tbl_ledger as ledger');
        $this->db->join('tbl_purchase_invoice as invoice','invoice.PI_ID = ledger.PI_ID');
        $this->db->join('tbl_supplier AS supplier', 'supplier.supplier_id = ledger.supplier_id');
        $this->db->join('tbl_branch AS branch','branch.branch_id = ledger.branch_id');
        $this->db->where('ledger.branch_id',$branch);
        return $this->db->get();
    }


    /*Payment schedule*/ 

    
    public function gen_export_schedule(){
        $this->db->select('ledger.isReference,supplier.payable_type,ledger.isDue_date,ledger.isStatus,branch.branch_name');
        $this->db->from('tbl_ledger AS ledger');
        $this->db->join('tbl_supplier as supplier','supplier.supplier_id = ledger.supplier_id');
       $this->db->join('tbl_branch as branch','branch.branch_id = ledger.branch_id');
        return $this->db->get();

    }
   
    public function branch_export_schedule(){
        $branch = $_SESSION["branch_id"];
        $this->db->select('ledger.isReference,supplier.payable_type,ledger.isDue_date,ledger.isStatus');
        $this->db->from('tbl_ledger AS ledger');
        $this->db->join('tbl_supplier as supplier','supplier.supplier_id = ledger.supplier_id');
        $this->db->join('tbl_branch as branch','branch.branch_id = ledger.branch_id');
        $this->db->where('ledger.branch_id',$branch);
        return $this->db->get();

    }

    public function gen_export_ap_ledger(){

        $this->db->select('ledger.AP_no,ledger.isReference,ledger.PV_ID,supplier.supplier_name,ledger.invoice_amount,ledger.isDue_date,ledger.isStatus,branch.branch_name');
        $this->db->from('tbl_ledger AS ledger');
        $this->db->join('tbl_supplier as supplier','ledger.supplier_id = supplier.supplier_id');
        $this->db->join('tbl_branch as branch','branch.branch_id = ledger.branch_id');
        $this->db->where('isStatus','Unpaid');

        return $this->db->get();
  
      }
      public function branch_export_ap_ledger(){
        $branch = $_SESSION["branch_id"];
        $this->db->select('ledger.AP_no,ledger.isReference,ledger.PV_ID,supplier.supplier_name,ledger.invoice_amount,ledger.isDue_date,ledger.isStatus');
        $this->db->from('tbl_ledger AS ledger');
        //$this->db->join('tbl_purchase_invoice as invoice','ledger.PI_ID = invoice.PI_ID');
        $this->db->join('tbl_supplier as supplier','ledger.supplier_id = supplier.supplier_id');
  
        $this->db->join('tbl_branch as branch','branch.branch_id = ledger.branch_id');
        $this->db->where('isStatus','Unpaid');
        $this->db->where('ledger.branch_id',$branch);
        return $this->db->get();
  
      }

      public function gen_export_pa_ledger(){
        $this->db->select('ledger.PA_no,voucher.payment_voucher_no,supplier.supplier_name,ledger.paid_amount,reciept.reciept_no,voucher.voucher_date,branch.branch_name');
        $this->db->from('tbl_pa_ledger AS ledger');
        $this->db->join('tbl_payment_voucher AS voucher', 'ledger.PV_ID = voucher.PV_ID');
        $this->db->join('tbl_supplier as supplier','supplier.supplier_id = voucher.supplier_id');
        $this->db->join('tbl_reciept as reciept','ledger.reciept_id = reciept.reciept_id');
        $this->db->join('tbl_branch as branch','voucher.branch_id = branch.branch_id');
        $this->db->where('voucher.isPending',"approved");
        return $this->db->get();
  
      }

      public function branch_export_pa_ledger(){

        $branch = $_SESSION["branch_id"];
        $this->db->select('ledger.PA_no,voucher.payment_voucher_no,supplier.supplier_name,ledger.paid_amount,reciept.reciept_no,voucher.voucher_date');
        $this->db->from('tbl_pa_ledger AS ledger');
        $this->db->join('tbl_payment_voucher AS voucher', 'ledger.PV_ID = voucher.PV_ID');
        $this->db->join('tbl_supplier as supplier','supplier.supplier_id = voucher.supplier_id');
        $this->db->join('tbl_reciept as reciept','ledger.reciept_id = reciept.reciept_id');
        $this->db->join('tbl_branch as branch','voucher.branch_id = branch.branch_id');
        $this->db->where('voucher.isPending',"approved");
        $this->db->where('voucher.branch_id',$branch);
        return $this->db->get();
  
      }

}

?>