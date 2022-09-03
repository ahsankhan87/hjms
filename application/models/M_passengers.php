<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_passengers extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    //get all passengers and also only one passenger and active and inactive too.
    public function get_passengers($id = FALSE)
    {
        $from_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_START_DATE')));
        $to_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_END_DATE')));
        
        $this->db->where('date_created >=',$from_date);
        $this->db->where('date_created <=',$to_date);
        
        if($id === FALSE)
        {
            $query = $this->db->get('hjms_passengers');
            $data = $query->result_array();
            return $data;
        }
        
        $options = array('id'=> $id);
        
        $query = $this->db->get_where('hjms_passengers',$options);
        $data = $query->result_array();
        return $data;
    }
    
    public function get_passengersByUser($id = FALSE,$user_id)
    {
        $from_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_START_DATE')));
        $to_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_END_DATE')));
        
        $this->db->where('date_created >=',$from_date);
        $this->db->where('date_created <=',$to_date);
        
        if($id === FALSE)
        {
            $this->db->where('user_id',$user_id);
            $query = $this->db->get('hjms_passengers');
            $data = $query->result_array();
            return $data;
        }
        
        $options = array('id'=> $id,'user_id'=>$user_id);
        
        $query = $this->db->get_where('hjms_passengers',$options);
        $data = $query->result_array();
        return $data;
    }
    
    public function get_passengersWherein($wherein_id,$user_id=null)
    {
        //$from_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_START_DATE')));
        //$to_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_END_DATE')));
        
        // $this->db->where('date_created >=',$from_date);
        // $this->db->where('date_created <=',$to_date);
        
        $this->db->select('id,first_name,last_name,passport_no,
            visa_no,visa_status,description,dob,YEAR(CURDATE()) - YEAR(dob) AS age,
            passport_issue_date,passport_expiry_date,visa_type');
        $this->db->where_in('id',$wherein_id);
        
        if($user_id != null)
        {
            $this->db->where('user_id',$user_id);
        }
        
        $query = $this->db->get('hjms_passengers');
        $data = $query->result_array();
        return $data;
    }
            
    //get all passengers and also only one passenger and active and inactive too.
    public function get_activepassengers($id = FALSE)
    {
        $from_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_START_DATE')));
        $to_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_END_DATE')));
        
        $this->db->where('date_created >=',$from_date);
        $this->db->where('date_created <=',$to_date);
        
        if($id === FALSE)
        {
            $this->db->select('id,first_name,last_name,passport_no,
            visa_no,visa_status,description,dob,YEAR(CURDATE()) - YEAR(dob) AS age,
            passport_issue_date,passport_expiry_date,visa_type');
            $options = array('active'=>1);
            
            $this->db->order_by('id','desc');
            $query = $this->db->get_where('hjms_passengers',$options);
            $data = $query->result_array();
            return $data;
        }
        
        $this->db->select('id,first_name,last_name,passport_no,
        visa_no,visa_status,description,dob,YEAR(CURDATE()) - YEAR(dob) AS age,
        passport_issue_date,passport_expiry_date,visa_type');
        
        $this->db->order_by('id','desc');
        $options = array('id'=> $id,'active'=>1);
        
        $query = $this->db->get_where('hjms_passengers',$options);
        $data = $query->result_array();
        return $data;
    }
    
    //get all passengers and also only one passenger and active and inactive too.
    public function get_passengersNotInvoiced($id = FALSE,$user_id=null)
    {
        $from_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_START_DATE')));
        $to_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_END_DATE')));
        
        $this->db->where('date_created >=',$from_date);
        $this->db->where('date_created <=',$to_date);
        
        if($user_id != null)
        {
            $this->db->where('user_id',$user_id);
        }
    
        if($id === FALSE)
        {
            
            $this->db->select('id,first_name,last_name,passport_no,
            visa_no,visa_status,description,dob,YEAR(CURDATE()) - YEAR(dob) AS age,
            passport_issue_date,passport_expiry_date,visa_type');
            $options = array('active'=>1,'invoiced'=>0);
           
            $this->db->order_by('id','desc');
            $query = $this->db->get_where('hjms_passengers',$options);
            $data = $query->result_array();
            return $data;
        }
        
        $this->db->select('id,first_name,last_name,passport_no,
        visa_no,visa_status,description,dob,YEAR(CURDATE()) - YEAR(dob) AS age,
        passport_issue_date,passport_expiry_date,visa_type');
        
        $this->db->order_by('id','desc');
        $options = array('id'=> $id,'active'=>1,'invoiced'=>0);
        
        $query = $this->db->get_where('hjms_passengers',$options);
        $data = $query->result_array();
        return $data;
    }
    
    function getpassengerDropDown()
    {
        $from_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_START_DATE')));
        $to_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_END_DATE')));
        
        $this->db->where('date_created >=',$from_date);
        $this->db->where('date_created <=',$to_date);
        
        $data = array();
        $data['']= 'Select Passenger';
        
        $query = $this->db->get_where('hjms_passengers',array('active'=>'1'));
        
        if ($query->num_rows() > 0)
        {
            foreach ($query->result_array() as $row)
            {
                 $data[$row['id']] = $row['first_name'] .' ' .$row['last_name'];
            }
        }
        $query->free_result();
        return $data;
    }
    
    function getpassengerSupplierDropDown()
    {
        $from_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_START_DATE')));
        $to_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_END_DATE')));
        
        $this->db->where('date_created >=',$from_date);
        $this->db->where('date_created <=',$to_date);
        
        $data = array();
        $data[0]= 'Select passenger';
        
        $this->db->where('sp.also_passenger',1);
        $this->db->join('pos_supplier sp','sp.company_id=cs.company_id','right');
        $query = $this->db->get_where('hjms_passengers cs',array('cs.status'=>'active','cs.company_id'=> $_SESSION['company_id']));
        
        if ($query->num_rows() > 0)
        {
            foreach ($query->result_array() as $row)
            {
                 $data[$row['id']] = $row['first_name'] .' ' .$row['last_name'] . ''.$row['name'];
            }
        }
        $query->free_result();
        return $data;
    }
    
   
    function getMAXCustInvoiceNo($invoice_prefix)
    {   
        $this->db->order_by('id','desc');
        $this->db->like('invoice_no',$invoice_prefix,'after');
        $query = $this->db->get('pos_passenger_payments',1);
        return $query->row()->invoice_no;
    }
    
    
    public function get_passengerName($passenger_id)
    {
        $options = array('id'=> $passenger_id);
        
        $query = $this->db->get_where('hjms_passengers',$options);
        if($row = $query->row())
        {
            return $row->first_name .' '.$row->last_name;
        }
        
        return '';
    }
    
    public function get_passengerVoucherNo($passenger_id)
    {
        $options = array('passenger_id'=> $passenger_id);
        
        $query = $this->db->get_where('hjms_voucher_pnr_detail',$options);
        if($query->row())
        {
            return $query->result_array();
        }
        
        return '';
    }
    
    function deletePassenger($id)
    {
       
       $this->db->delete('hjms_passengers',array('id'=>$id));
       
    }
    
    function inactivate($id,$op_balance_dr,$op_balance_cr)
    {
        //$posting_type_code = $this->M_passengers->getpassengerPostingTypes($id);
//                       
//       //OPENING BALANCE IN passenger ACCOUNT
//       $receivable_account_code = $posting_type_code[0]['receivable_acc_code'];//passenger ledger id
//       
//       $receivable_account = $this->M_groups->get_groups($receivable_account_code,$_SESSION['company_id']);
//       $receivable_dr_balance = abs($receivable_account[0]['op_balance_dr']);
//       $receivable_cr_balance = abs($receivable_account[0]['op_balance_cr']);
//       
//      if($receivable_dr_balance !== 0 || $receivable_cr_balance !== 0)
//       {
//           $dr_balance = ($receivable_dr_balance-$op_balance_dr);
//           $cr_balance = ($receivable_cr_balance-$op_balance_cr);
//           
//           $this->M_groups->editGroupOPBalance($receivable_account_code,$dr_balance,$cr_balance);
//       }
                      
        $query = $this->db->update('hjms_passengers',array('status'=>'inactive'),array('id'=>$id));
        
            //for logging
            $msg = 'passenger id: '.$id;
            $this->M_logs->add_log($msg,"passengers","Inactivated","POS");
            // end logging
    }
    
    function delete_entry_by_id($entry_id)
    {
        $query = $this->db->get_where('pos_passenger_payments',array('entry_id'=>$entry_id,
        'company_id'=> $_SESSION['company_id']));
        
        if ($query->num_rows() > 0)
        {
            $data = $query->result_array();
            
            $passenger_id = $data[0]['passenger_id'];
            $invoice_no = $data[0]['invoice_no'];
            //$total_amount = ($data[0]['debit']+$data[0]['credit']);
            //$cur_amount = 0;
                        
                 if($passenger_id != 0)
                 {  
                    /////////////////
                    //REDUCE THE TOTAL AMOUNT IN SALES TO SHOW EXACT AMOUNT IN OUTSTANDING INVOICES
                    $cust_payment_hstry = $this->get_passenger_payment_history($passenger_id,$invoice_no);
                    
                    foreach($cust_payment_hstry as $values){
                            
                          $prev_sales = $this->M_sales->get_sales_by_invoice($values['sales_invoice_no']);
                          //var_dump($prev_sales);
                          $data = array(
                            'paid' => abs(@$prev_sales[0]['paid']-$values['amount']),//must be positive values
                            );
                          $this->db->update('pos_sales',$data,array('invoice_no'=>$values['sales_invoice_no']));
                        
                    }
                    
                    //DELETE PAYMENT HISOTRY 
                    $this->delete_passenger_payment_history($passenger_id,$invoice_no);
                    
                   }
        }        
       $this->db->delete('pos_passenger_payments',array('entry_id'=>$entry_id));
        
    }
    
    function get_passenger_payment_history($passenger_id,$invoice_no){
        
        $options = array('passenger_id'=> $passenger_id,'invoice_no'=>$invoice_no,'company_id'=> $_SESSION['company_id']);
        
        $query = $this->db->get_where('pos_passenger_payment_history',$options);
        $data = $query->result_array();
        return $data;    
    }
    
    function delete_passenger_payment_history($passenger_id,$invoice_no)
    {
        $options = array('passenger_id'=> $passenger_id,'invoice_no'=>$invoice_no,'company_id'=> $_SESSION['company_id']);
        
        $query = $this->db->delete('pos_passenger_payment_history',$options);
        
    }
    
    function activate($id)
    {
        $query = $this->db->update('hjms_passengers',array('active'=>'1'),array('id'=>$id));
        
            //for logging
            $msg = 'passenger id: '.$id;
            $this->M_logs->add_log($msg,"passengers","Activated","POS");
            // end logging
    }
    
    function get_cust_supp_Union()
    {
        
        $query = $this->db->query('
        SELECT id,store_name,acc_code FROM hjms_passengers  WHERE status= "active"
        UNION
        SELECT id,name,acc_code FROM pos_supplier 
        WHERE also_passenger = 1 AND status="active"'
        );
         
        return $query->result_array(); 
    }    
    
    //insert peesenger
    //insert sales transaction 
    //and insert purchase transaction
    public function combine_sale_transaction($data = array())
    {
        $this->db->trans_start();
         
        $data_posted = json_decode(json_encode($data));
        
        //var_dump($data_posted);
        //die;
        
        $cust_total_amount =0;
        $sup_total_amount=0;
        $discount =0;
        $unit_price=0;
        $cost_price=0;
        
        $visa_cost=0;
        $ticket_cose=0;
        $hotel_cost=0;
        $other_cost=0;
        
        //print_r($data_posted);
        //echo die;
        
        //GET PREVIOISE INVOICE NO  
           @$prev_invoice_no = $this->M_sales->getMAXSaleInvoiceNo();
           //$number = (int) substr($prev_invoice_no,11)+1; // EXTRACT THE LAST NO AND INCREMENT BY 1
           //$new_invoice_no = 'POS'.date("Ymd").$number;
           $number = (int) $prev_invoice_no+1; // EXTRACT THE LAST NO AND INCREMENT BY 1
           $new_invoice_no = 'S'.$number;
           
       // print_r($data_posted);
       if(count($data_posted) > 0)
        {
           //GET ALL ACCOUNT CODE WHICH IS TO BE POSTED AMOUNT
        $sale_date = date('Y-m-d',strtotime($data_posted->sale_date));
        $customer_id=$data_posted->customer_id;
        //$emp_id=$data_posted->emp_id;
        $supplier_id=$data_posted->supplier_id;
        $posting_type_code = $this->M_customers->getCustomerPostingTypes($customer_id);
        $exchange_rate = ($data_posted->exchange_rate == '' ? 0 : $data_posted->exchange_rate);
        $currency_id = ($data_posted->currency_id == '' ? 0 : $data_posted->currency_id);
        $discount = ($data_posted->discount == '' ? 0 : $data_posted->discount);//discount value not percent
        $cust_narration = ($data_posted->cust_description == '' ? '' : $data_posted->cust_description);
        $sup_description = ($data_posted->sup_description == '' ? '' : $data_posted->sup_description);
         //if multi currency is used then multiply $exchange_rate with amount
         
        $cust_total_amount = ($data_posted->cust_visa_cost+$data_posted->cust_ticket_cost+$data_posted->cust_hotel_cost+$data_posted->cust_other_cost);
        $sup_total_amount = ($data_posted->sup_visa_cost+$data_posted->sup_ticket_cost+$data_posted->sup_hotel_cost+$data_posted->sup_other_cost);
            
        //////
         
    if(count($posting_type_code) !== 0)
    //if(count($sale_supp_posting_type_code) !== 0)
    {
        $data = array(
                'company_id'=> $_SESSION['company_id'],
                'first_name' => $data_posted->first_name,
                'last_name' => $data_posted->last_name,
                'city' => $data_posted->city,
                'country' => $data_posted->country,
                'mobile_no' => $data_posted->mobile_no,
                'status' => 'active',
                'description' => $data_posted->description,
                //FOR TRAVEL AGENT ONLY
                'passport_no' => $data_posted->passport_no,
                'cnic' => $data_posted->cnic,
                'father_name' => $data_posted->father_name,
                "gender" => $data_posted->gender,
                'dob' => $data_posted->dob,
                'passport_issue_date' => $data_posted->passport_issue_date,
                "passport_expiry_date" => $data_posted->passport_expiry_date,
                'mehram' => $data_posted->mehram,
                'customer_id' => $data_posted->customer_id,
                'visa_no' => $data_posted->visa_no,
                'visa_status' => $data_posted->visa_status,
                'visa_type' => $data_posted->visa_type,
                
                );
            
                $this->db->insert('hjms_passengers', $data);
                $pessanger_id = $this->db->insert_id();
                ///insert pessenger
                
       $data = array(
            'company_id'=> $_SESSION['company_id'],
            'invoice_no' => $new_invoice_no,
            'customer_id' => $customer_id,
            'supplier_id' => $supplier_id,
            'employee_id'=>0,
            'user_id'=>$_SESSION['user_id'],
            'sale_date' => $sale_date,
            'register_mode'=>$data_posted->register_mode,
            'account'=>$data_posted->cust_saleType,
            //'amount_due'=>$data_posted->amount_due,
            'description'=>$cust_narration,
            'discount_value'=>$discount,
            'currency_id'=>$currency_id,
            'exchange_rate'=>$exchange_rate,
            'total_amount'=>$cust_total_amount,
            
            );
            
        $this->db->insert('pos_sales', $data);
        $sale_id = $this->db->insert_id();
        
        //extract JSON array items from posted data.
        //foreach($data_posted->items as $posted_values):
        
        $service = 0; //($posted_values->service == null ? 0 : $posted_values->service);
        
        $data = array(
            'sale_id' => $sale_id,
            'invoice_no' => $new_invoice_no,
            'item_id'=>$pessanger_id,
            'description'=>'',
            'company_id'=> $_SESSION['company_id'],
            //'unit'=>($posted_values->unit == '' ? '' : $posted_values->unit),
            'visa_cost'=>$data_posted->cust_visa_cost,
            'ticket_cost'=>$data_posted->cust_ticket_cost,
            'hotel_cost'=>$data_posted->cust_hotel_cost,
            'other_cost'=>$data_posted->cust_other_cost,
            );
            
        $this->db->insert('pos_sales_items', $data);
        
                    //for logging
                    $msg = 'invoice no '. $new_invoice_no;
                    $this->M_logs->add_log($msg,"sale transaction","created","trans");
                    // end logging
                    
        //endforeach;
        //////////////////////////////////
        ////   ACCOUNT TRANSACTIONS  /////
        /////////////////////////////////
        
        //  Cash Debit and Sales Credit
        if($data_posted->cust_saleType == 'cash' && $data_posted->register_mode == 'sale')
            {
                //Search for sales and cash ledger account for account entry
                //if invoice is cash then entry will be cash debit and sales credit and vice versa
                $dr_ledger_id = $posting_type_code[0]['cash_acc_code'];
                $cr_ledger_id = $posting_type_code[0]['sales_acc_code'];
                
                $this->M_entries->addEntries($dr_ledger_id,$cr_ledger_id,$cust_total_amount,$cust_total_amount,ucwords($cust_narration),$new_invoice_no,$sale_date);
                ////////////////
              
            }
            
            //if Sales is on credit 
            //  AR - Customer Debit and Sales Credit
         elseif($data_posted->cust_saleType == 'credit' && $data_posted->register_mode == 'sale')
         {
                //Search for purchases and cash ledger account for account entry
                //if invoice is cash then entry will be purchase debit and cash credit and vice versa
                $dr_ledger_id = $posting_type_code[0]['receivable_acc_code'];
                $cr_ledger_id = $posting_type_code[0]['sales_acc_code'];
                
                //JOURNAL ENTRY
                $entry_id=$this->M_entries->addEntries($dr_ledger_id,$cr_ledger_id,$cust_total_amount,$cust_total_amount,ucwords($cust_narration),$new_invoice_no,$sale_date);
                
                //CUSTOMER PAYMENT ENTRY
                $this->M_customers->addCustomerPaymentEntry($dr_ledger_id,$cr_ledger_id,$cust_total_amount,0,$customer_id,$cust_narration,$new_invoice_no,$sale_date,$exchange_rate,$entry_id);
                
               ///
         }
        ///////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////
        //PURCHASING ENTRY STARTED HERE
        //////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////
          //GET PREVIOISE INVOICE NO  
           @$prev_invoice_no = $this->M_receivings->getMAXPurchaseInvoiceNo();
           $number = (int) substr($prev_invoice_no,1)+1; // EXTRACT THE LAST NO AND INCREMENT BY 1
           $new_sup_invoice_no = 'R'.$number;
           
           //GET ALL ACCOUNT CODE WHICH THE AMOUNT IS TO BE POSTED 
           $supp_posting_type_code = $this->M_suppliers->getSupplierPostingTypes($supplier_id);
        
        if(count($supp_posting_type_code) !== 0)
        {
             $data = array(
                'company_id'=> $_SESSION['company_id'],
                'invoice_no' => $new_sup_invoice_no,
                'supplier_id' => $supplier_id,
                'supplier_invoice_no' => 0,
                'employee_id'=>0,
                'user_id'=>$_SESSION['user_id'],
                'receiving_date' => $sale_date,
                'register_mode'=>$data_posted->sup_register_mode,
                'account'=>$data_posted->purchaseType,
                'amount_due'=>0,
                'description'=>$sup_description,
                'discount_value'=>$discount,
                'currency_id'=>$currency_id,
                'exchange_rate'=>$exchange_rate,
                'total_amount'=>$sup_total_amount
                );
                
            $this->db->insert('pos_receivings', $data);
            $receiving_id = $this->db->insert_id();
            
            $data = array(
                'receiving_id'=>$receiving_id,
                'invoice_no' => $new_sup_invoice_no,
                'item_id'=>$pessanger_id,
                'visa_cost'=>$data_posted->sup_visa_cost,
                'ticket_cost'=>$data_posted->sup_ticket_cost,
                'hotel_cost'=>$data_posted->sup_hotel_cost,
                'other_cost'=>$data_posted->sup_other_cost,
                'company_id'=> $_SESSION['company_id'],
                );
                
            $this->db->insert('pos_receivings_items', $data);
            // receiving itmes
            
                    //for logging
                    $msg = 'invoice no '. $new_sup_invoice_no;
                    $this->M_logs->add_log($msg,"purchase transaction","created","trans");
                    // end logging
            /////////////////////////////////
            ////   ACCOUNT TRANSACTIONS  /////
            /////////////////////////////////
            
            
            // inventory DEBIT AND
            // CASH CREDITED
            if($data_posted->purchaseType == 'cash' && $data_posted->sup_register_mode == 'receive')
                {
                    //Search for inventory and cash ledger account for account entry
                    //if invoice is cash then entry will be purchase debit and cash credit and vice versa
                    $dr_ledger_id = $supp_posting_type_code[0]['inventory_acc_code'];
                    $cr_ledger_id = $supp_posting_type_code[0]['cash_acc_code'];
                   
                   $this->M_entries->addEntries($dr_ledger_id,$cr_ledger_id,$sup_total_amount,$sup_total_amount,ucwords($sup_description),$new_sup_invoice_no,$sale_date);
               
                }
                
            //inventory DEBITED AND 
            //ACOUNT PAYABLE SUPPLIER ID IS CREDITED
             elseif($data_posted->purchaseType == 'credit' && $data_posted->sup_register_mode == 'receive')
             {
                //Search for inventory and cash ledger account for account entry
                //if invoice is cash then entry will be purchase debit and cash credit and vice versa
                $dr_ledger_id = $supp_posting_type_code[0]['inventory_acc_code'];
                $cr_ledger_id = $supp_posting_type_code[0]['payable_acc_code'];
                
                $this->M_entries->addEntries($dr_ledger_id,$cr_ledger_id,$sup_total_amount,$sup_total_amount,ucwords($sup_description),$new_sup_invoice_no,$sale_date);
               
                   //for cusmoter payment table
                   $this->M_suppliers->addsupplierPaymentEntry($cr_ledger_id,$dr_ledger_id,0,$sup_total_amount,$supplier_id,$sup_description,$new_sup_invoice_no,$sale_date);
                   ///
             }
                    
        }
        
        $this->db->trans_complete();
        
        return $new_invoice_no; //redirect to receipt page using this $receiving_id
         
         /////////////////////////////
         //      ACCOUNTS CLOSED ..///
         /////////////////////////////
         
        }// Posting type  end if 
        else{
            return '{"invoice_no":"no-posting-type"}';
        }
        
        }//$data_posted if close
        else{
            return 'No Data'; 
        }
    }
    
    
    //insert peesenger
    //insert sales transaction 
    //and insert purchase transaction
    public function combine_bulk_sale_transaction($data = array())
    {
        $this->db->trans_start();
         
        $data_posted = json_decode(json_encode($data));
        
        var_dump($data_posted);
        die;
        
        $cust_total_amount =0;
        $sup_total_amount=0;
        $discount =0;
        $unit_price=0;
        $cost_price=0;
        
        $visa_cost=0;
        $ticket_cose=0;
        $hotel_cost=0;
        $other_cost=0;
        
        //print_r($data_posted);
        //echo die;
        
        //GET PREVIOISE INVOICE NO  
           @$prev_invoice_no = $this->M_sales->getMAXSaleInvoiceNo();
           //$number = (int) substr($prev_invoice_no,11)+1; // EXTRACT THE LAST NO AND INCREMENT BY 1
           //$new_invoice_no = 'POS'.date("Ymd").$number;
           $number = (int) $prev_invoice_no+1; // EXTRACT THE LAST NO AND INCREMENT BY 1
           $new_invoice_no = 'S'.$number;
           
       // print_r($data_posted);
       if(count($data_posted) > 0)
        {
           //GET ALL ACCOUNT CODE WHICH IS TO BE POSTED AMOUNT
        $sale_date = date('Y-m-d',strtotime($data_posted->sale_date));
        $customer_id=$data_posted->customer_id;
        //$emp_id=$data_posted->emp_id;
        $supplier_id=$data_posted->supplier_id;
        $posting_type_code = $this->M_customers->getCustomerPostingTypes($customer_id);
        $exchange_rate = ($data_posted->exchange_rate == '' ? 0 : $data_posted->exchange_rate);
        $currency_id = ($data_posted->currency_id == '' ? 0 : $data_posted->currency_id);
        $discount = ($data_posted->discount == '' ? 0 : $data_posted->discount);//discount value not percent
        $cust_narration = ($data_posted->cust_description == '' ? '' : $data_posted->cust_description);
        $sup_description = ($data_posted->sup_description == '' ? '' : $data_posted->sup_description);
         //if multi currency is used then multiply $exchange_rate with amount
         
        $cust_total_amount = ($data_posted->cust_visa_cost+$data_posted->cust_ticket_cost+$data_posted->cust_hotel_cost+$data_posted->cust_other_cost);
        $sup_total_amount = ($data_posted->sup_visa_cost+$data_posted->sup_ticket_cost+$data_posted->sup_hotel_cost+$data_posted->sup_other_cost);
            
        //////
         
    if(count($posting_type_code) !== 0)
    //if(count($sale_supp_posting_type_code) !== 0)
    {
        $data = array(
                'company_id'=> $_SESSION['company_id'],
                'first_name' => $data_posted->first_name,
                'last_name' => $data_posted->last_name,
                'city' => $data_posted->city,
                'country' => $data_posted->country,
                'mobile_no' => $data_posted->mobile_no,
                'status' => 'active',
                'description' => $data_posted->description,
                //FOR TRAVEL AGENT ONLY
                'passport_no' => $data_posted->passport_no,
                'cnic' => $data_posted->cnic,
                'father_name' => $data_posted->father_name,
                "gender" => $data_posted->gender,
                'dob' => $data_posted->dob,
                'passport_issue_date' => $data_posted->passport_issue_date,
                "passport_expiry_date" => $data_posted->passport_expiry_date,
                'mehram' => $data_posted->mehram,
                'customer_id' => $data_posted->customer_id,
                'visa_no' => $data_posted->visa_no,
                'visa_status' => $data_posted->visa_status,
                'visa_type' => $data_posted->visa_type,
                
                );
            
                $this->db->insert('hjms_passengers', $data);
                $pessanger_id = $this->db->insert_id();
                ///insert pessenger
                
       $data = array(
            'company_id'=> $_SESSION['company_id'],
            'invoice_no' => $new_invoice_no,
            'customer_id' => $customer_id,
            'supplier_id' => $supplier_id,
            'employee_id'=>0,
            'user_id'=>$_SESSION['user_id'],
            'sale_date' => $sale_date,
            'register_mode'=>$data_posted->register_mode,
            'account'=>$data_posted->cust_saleType,
            //'amount_due'=>$data_posted->amount_due,
            'description'=>$cust_narration,
            'discount_value'=>$discount,
            'currency_id'=>$currency_id,
            'exchange_rate'=>$exchange_rate,
            'total_amount'=>$cust_total_amount,
            
            );
            
        $this->db->insert('pos_sales', $data);
        $sale_id = $this->db->insert_id();
        
        //extract JSON array items from posted data.
        //foreach($data_posted->items as $posted_values):
        
        $service = 0; //($posted_values->service == null ? 0 : $posted_values->service);
        
        $data = array(
            'sale_id' => $sale_id,
            'invoice_no' => $new_invoice_no,
            'item_id'=>$pessanger_id,
            'description'=>'',
            'company_id'=> $_SESSION['company_id'],
            //'unit'=>($posted_values->unit == '' ? '' : $posted_values->unit),
            'visa_cost'=>$data_posted->cust_visa_cost,
            'ticket_cost'=>$data_posted->cust_ticket_cost,
            'hotel_cost'=>$data_posted->cust_hotel_cost,
            'other_cost'=>$data_posted->cust_other_cost,
            );
            
        $this->db->insert('pos_sales_items', $data);
        
                    //for logging
                    $msg = 'invoice no '. $new_invoice_no;
                    $this->M_logs->add_log($msg,"sale transaction","created","trans");
                    // end logging
                    
        //endforeach;
        //////////////////////////////////
        ////   ACCOUNT TRANSACTIONS  /////
        /////////////////////////////////
        
        //  Cash Debit and Sales Credit
        if($data_posted->cust_saleType == 'cash' && $data_posted->register_mode == 'sale')
            {
                //Search for sales and cash ledger account for account entry
                //if invoice is cash then entry will be cash debit and sales credit and vice versa
                $dr_ledger_id = $posting_type_code[0]['cash_acc_code'];
                $cr_ledger_id = $posting_type_code[0]['sales_acc_code'];
                
                $this->M_entries->addEntries($dr_ledger_id,$cr_ledger_id,$cust_total_amount,$cust_total_amount,ucwords($cust_narration),$new_invoice_no,$sale_date);
                ////////////////
              
            }
            
            //if Sales is on credit 
            //  AR - Customer Debit and Sales Credit
         elseif($data_posted->cust_saleType == 'credit' && $data_posted->register_mode == 'sale')
         {
                //Search for purchases and cash ledger account for account entry
                //if invoice is cash then entry will be purchase debit and cash credit and vice versa
                $dr_ledger_id = $posting_type_code[0]['receivable_acc_code'];
                $cr_ledger_id = $posting_type_code[0]['sales_acc_code'];
                
                //JOURNAL ENTRY
                $entry_id=$this->M_entries->addEntries($dr_ledger_id,$cr_ledger_id,$cust_total_amount,$cust_total_amount,ucwords($cust_narration),$new_invoice_no,$sale_date);
                
                //CUSTOMER PAYMENT ENTRY
                $this->M_customers->addCustomerPaymentEntry($dr_ledger_id,$cr_ledger_id,$cust_total_amount,0,$customer_id,$cust_narration,$new_invoice_no,$sale_date,$exchange_rate,$entry_id);
                
               ///
         }
        ///////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////
        //PURCHASING ENTRY STARTED HERE
        //////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////
          //GET PREVIOISE INVOICE NO  
           @$prev_invoice_no = $this->M_receivings->getMAXPurchaseInvoiceNo();
           $number = (int) substr($prev_invoice_no,1)+1; // EXTRACT THE LAST NO AND INCREMENT BY 1
           $new_sup_invoice_no = 'R'.$number;
           
           //GET ALL ACCOUNT CODE WHICH THE AMOUNT IS TO BE POSTED 
           $supp_posting_type_code = $this->M_suppliers->getSupplierPostingTypes($supplier_id);
        
        if(count($supp_posting_type_code) !== 0)
        {
             $data = array(
                'company_id'=> $_SESSION['company_id'],
                'invoice_no' => $new_sup_invoice_no,
                'supplier_id' => $supplier_id,
                'supplier_invoice_no' => 0,
                'employee_id'=>0,
                'user_id'=>$_SESSION['user_id'],
                'receiving_date' => $sale_date,
                'register_mode'=>$data_posted->sup_register_mode,
                'account'=>$data_posted->purchaseType,
                'amount_due'=>0,
                'description'=>$sup_description,
                'discount_value'=>$discount,
                'currency_id'=>$currency_id,
                'exchange_rate'=>$exchange_rate,
                'total_amount'=>$sup_total_amount
                );
                
            $this->db->insert('pos_receivings', $data);
            $receiving_id = $this->db->insert_id();
            
            $data = array(
                'receiving_id'=>$receiving_id,
                'invoice_no' => $new_sup_invoice_no,
                'item_id'=>$pessanger_id,
                'visa_cost'=>$data_posted->sup_visa_cost,
                'ticket_cost'=>$data_posted->sup_ticket_cost,
                'hotel_cost'=>$data_posted->sup_hotel_cost,
                'other_cost'=>$data_posted->sup_other_cost,
                'company_id'=> $_SESSION['company_id'],
                );
                
            $this->db->insert('pos_receivings_items', $data);
            // receiving itmes
            
                    //for logging
                    $msg = 'invoice no '. $new_sup_invoice_no;
                    $this->M_logs->add_log($msg,"purchase transaction","created","trans");
                    // end logging
            /////////////////////////////////
            ////   ACCOUNT TRANSACTIONS  /////
            /////////////////////////////////
            
            
            // inventory DEBIT AND
            // CASH CREDITED
            if($data_posted->purchaseType == 'cash' && $data_posted->sup_register_mode == 'receive')
                {
                    //Search for inventory and cash ledger account for account entry
                    //if invoice is cash then entry will be purchase debit and cash credit and vice versa
                    $dr_ledger_id = $supp_posting_type_code[0]['inventory_acc_code'];
                    $cr_ledger_id = $supp_posting_type_code[0]['cash_acc_code'];
                   
                   $this->M_entries->addEntries($dr_ledger_id,$cr_ledger_id,$sup_total_amount,$sup_total_amount,ucwords($sup_description),$new_sup_invoice_no,$sale_date);
               
                }
                
            //inventory DEBITED AND 
            //ACOUNT PAYABLE SUPPLIER ID IS CREDITED
             elseif($data_posted->purchaseType == 'credit' && $data_posted->sup_register_mode == 'receive')
             {
                //Search for inventory and cash ledger account for account entry
                //if invoice is cash then entry will be purchase debit and cash credit and vice versa
                $dr_ledger_id = $supp_posting_type_code[0]['inventory_acc_code'];
                $cr_ledger_id = $supp_posting_type_code[0]['payable_acc_code'];
                
                $this->M_entries->addEntries($dr_ledger_id,$cr_ledger_id,$sup_total_amount,$sup_total_amount,ucwords($sup_description),$new_sup_invoice_no,$sale_date);
               
                   //for cusmoter payment table
                   $this->M_suppliers->addsupplierPaymentEntry($cr_ledger_id,$dr_ledger_id,0,$sup_total_amount,$supplier_id,$sup_description,$new_sup_invoice_no,$sale_date);
                   ///
             }
                    
        }
        
        $this->db->trans_complete();
        
        return $new_invoice_no; //redirect to receipt page using this $receiving_id
         
         /////////////////////////////
         //      ACCOUNTS CLOSED ..///
         /////////////////////////////
         
        }// Posting type  end if 
        else{
            return '{"invoice_no":"no-posting-type"}';
        }
        
        }//$data_posted if close
        else{
            return 'No Data'; 
        }
    }
}
?>