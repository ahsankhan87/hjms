<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Passengers extends MY_Controller{
    
    function __construct()
    {
        parent::__construct();
       
        $this->load->library('form_validation');
    } 

    function index()
    {
        $data['title'] = 'Manage Passengers';
        $data['main'] = 'Manage Passengers';
        $data['main_small'] = '';
        
        //$data['cities'] = $this->M_city->get_city();
        //$data['passengers']= $this->M_passengers->get_passengers(false);
        if($this->session->userdata('level') !== '1'){
            $data['passengers']= $this->M_passengers->get_passengersByUser(false,$this->session->userdata('user_id'));
        }else{
            $data['passengers']= $this->M_passengers->get_passengers(false);
        }
        $this->load->view('templates/header',$data);
        //$this->load->view('pos/passengers/travel_agency/v_passengers_travel',$data);
        $this->load->view('passengers/v_passengers',$data);
        $this->load->view('templates/footer');
    }
    
    function passengerDetail($passenger_id)
    {
        $data['title'] = 'Passenger Detail';
        $data['main'] = 'Passenger Detail';
        $data['main_small'] = '';
        
        $data['from_date'] = ($this->input->post('from_date') ? $this->input->post('from_date') : FY_START_DATE);
        $data['to_date'] = ($this->input->post('to_date') ? $this->input->post('to_date') : FY_END_DATE);
        $data['main_small'] = '<br />'.date('d-m-Y',strtotime($data['from_date'])).' To '.date('d-m-Y',strtotime($data['to_date']));
        
        $data['passenger'] = $this->M_passengers->get_passengers($passenger_id,FY_START_DATE,FY_END_DATE);
        $data['passenger_entries']= $this->M_passengers->get_passenger_Entries($passenger_id,$data['from_date'],$data['to_date']);
        
        $this->load->view('templates/header',$data);
        $this->load->view('passengers/v_passengerDetail',$data);
        $this->load->view('templates/footer');
    }
    
    function receivePayment($passenger_id)
    {
        $data['title'] = 'Receive Payment Passengers';
        $data['main'] = 'Receive Payment Passengers';
         $data['main_small'] = '';
        
        $data['activeBanks'] = $this->M_banking->getbankDropDown();
        //$data['creditSales'] = $this->M_sales->get_creditSales($passenger_id);
        $data['passenger'] = $this->M_passengers->get_passengers($passenger_id,FY_START_DATE,FY_END_DATE);
        //$data['passenger_entries']= $this->M_passengers->get_passenger_Entries($passenger_id,FY_START_DATE,FY_END_DATE);
        
        $this->load->view('templates/header',$data);
        $this->load->view('passengers/v_receivePayment',$data);
        $this->load->view('templates/footer');
    }
    
    function getCreditSalesJSON($passenger_id)
    {
        $creditSales = $this->M_sales->get_creditSales($passenger_id);
        echo json_encode($creditSales);
    }
    
    function get_passengers_JSON()
    {
        print_r(json_encode($this->M_passengers->get_activepassengers(false,FY_START_DATE,FY_END_DATE)));
    }
    
    function get_passengers_by_customer_JSON($customer_id)
    {
        print_r(json_encode($this->M_passengers->get_activePassengersByCustomer($customer_id,FY_START_DATE,FY_END_DATE)));
    }
    
    function create()
    {
        //Allowing akses to admin only
    //   if($this->session->userdata('level') !== '1'){
    //       $data['title'] = "403 Access Denied";
    //       $this->load->view('403',$data);
    //   }else{
        
        if($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form Validation
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('passport_no', 'Passport No', 'required');
            
            //$this->form_validation->set_rules('opening_balance_amount', 'Opening Balance Amount', 'required');
            //$this->form_validation->set_rules('capital_acc_code', 'Select Capital Account', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
            
            //after form Validation run
            if($this->form_validation->run())
            {
                $data = array(
                'first_name' => $this->input->post('first_name', true),
                'last_name' => $this->input->post('last_name', true),
                'city' => $this->input->post('city', true),
                'country' => $this->input->post('country', true),
                'mobile_no' => $this->input->post('mobile_no', true),
                'active' => '1',
                'description' => $this->input->post('description', true),
                //FOR TRAVEL AGENT ONLY
                'passport_no' => $this->input->post('passport_no', true),
                'cnic' => $this->input->post('cnic', true),
                'father_name' => $this->input->post('father_name', true),
                "gender" => $this->input->post('gender', true),
                'dob' => $this->input->post('dob', true),
                'passport_issue_date' => $this->input->post('passport_issue_date', true),
                "passport_expiry_date" => $this->input->post('passport_expiry_date', true),
                'mehram' => $this->input->post('mehram', true),
                'customer_id' => 0,//$this->input->post('customer_id', true),
                'visa_no' => $this->input->post('visa_no', true),
                'visa_issue_date' => $this->input->post('visa_issue_date', true),
                'visa_status' => $this->input->post('visa_status', true),
                'visa_type' => $this->input->post('visa_type', true),
                'user_id'=>$this->session->userdata('user_id'),
                ////
                );
            
                if($this->db->insert('hjms_passengers', $data)) {
                   
                    $this->session->set_flashdata('message','Passenger Created');
                }else{
                    $this->session->set_flashdata('error','Passenger not Created');
                }
                
                redirect('Passengers/index','refresh');
            
           }
        }
            $data['title'] = 'Create Passenger';
            $data['main'] = 'Create New Passenger';
             $data['main_small'] = '';
        
            //$data['salesPostingTypeDDL'] = $this->M_postingTypes->get_SalesPostingTypesDDL();
            //$data['accountDDL'] = $this->M_groups->getGrpDetailDropDown($_SESSION['company_id'],$data['langs']);//search for legder account
            //$data['currencyDropDown'] = $this->M_currencies->getcurrencyDropDown();
           // $data['customerDDL'] = $this->M_customers->getCustomerDropDown();
               
            $this->load->view('templates/header',$data);
            //$this->load->view('pos/passengers/travel_agency/create_travel',$data);//for travel agency only
            $this->load->view('passengers/create',$data);
            $this->load->view('templates/footer');
        ///}
    }
    
    function combine_create()
    {
        //Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
        
        if($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form Validation
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('passport_no', 'Passport No', 'required');
            
            //$this->form_validation->set_rules('opening_balance_amount', 'Opening Balance Amount', 'required');
            //$this->form_validation->set_rules('capital_acc_code', 'Select Capital Account', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
            
            //after form Validation run
            if($this->form_validation->run())
            {
                $data = array(
                'first_name' => $this->input->post('first_name', true),
                'last_name' => $this->input->post('last_name', true),
                'city' => $this->input->post('city', true),
                'country' => $this->input->post('country', true),
                'mobile_no' => $this->input->post('mobile_no', true),
                'status' => 'active',
                'description' => $this->input->post('description', true),
                //FOR TRAVEL AGENT ONLY
                'passport_no' => $this->input->post('passport_no', true),
                'cnic' => $this->input->post('cnic', true),
                'father_name' => $this->input->post('father_name', true),
                "gender" => $this->input->post('gender', true),
                'dob' => $this->input->post('dob', true),
                'passport_issue_date' => $this->input->post('passport_issue_date', true),
                "passport_expiry_date" => $this->input->post('passport_expiry_date', true),
                'mehram' => $this->input->post('mehram', true),
                'customer_id' => $this->input->post('customer_id', true),
                'visa_no' => $this->input->post('visa_no', true),
                'visa_status' => $this->input->post('visa_status', true),
                'visa_type' => $this->input->post('visa_type', true),
                'visa_issue_date' => $this->input->post('visa_issue_date', true),
                'user_id'=>$this->session->userdata('user_id'),
                
                //'supplier_id' => $this->input->post('supplier_id', true),
//                'cust_visa_cost' => $this->input->post('cust_visa_cost', true),
//                'sup_visa_cost' => $this->input->post('sup_visa_cost', true),
//                'cust_ticket_cost' => $this->input->post('cust_ticket_cost', true),
//                'sup_ticket_cost' => $this->input->post('sup_ticket_cost', true),
//                'cust_hotel_cost' => $this->input->post('cust_hotel_cost', true),
//                'sup_hotel_cost' => $this->input->post('sup_hotel_cost', true),
//                'cust_other_cost' => $this->input->post('cust_other_cost', true),
//                'sup_other_cost' => $this->input->post('sup_other_cost', true),
//                
//                'sale_date' => $this->input->post('sale_date', true),
//                'cust_saleType' => $this->input->post('cust_saleType', true),
//                'purchaseType' => $this->input->post('purchaseType', true),
//                'exchange_rate' => 1,
//                'currency_id' => '',
//                'discount' => '',
//                'register_mode' => 'sale',
//                'sup_register_mode' => 'receive',
//                'cust_description' => $this->input->post('cust_description', true),
//                'sup_description' => $this->input->post('sup_description', true),
                ////
                );
            
                if($this->M_passengers->combine_sale_transaction($data)) {
                    
                    //for logging
                    $msg = $this->input->post('first_name'). ' '. $this->input->post('last_name');
                    $this->M_logs->add_log($msg,"passenger","Added","POS");
                    // end logging
            
                    $this->session->set_flashdata('message','Passenger Created');
                }else{
                    $this->session->set_flashdata('error','Passenger not created');
                }
                
                redirect('Passengers/index','refresh');
            
           }
        }
            $data['title'] = 'Create Passenger';
            $data['main'] = 'Create New Passenger';
             $data['main_small'] = '';
        
            //$data['salesPostingTypeDDL'] = $this->M_postingTypes->get_SalesPostingTypesDDL();
            //$data['accountDDL'] = $this->M_groups->getGrpDetailDropDown($_SESSION['company_id'],$data['langs']);//search for legder account
            $data['currencyDropDown'] = $this->M_currencies->getcurrencyDropDown();
            $data['customerDDL'] = $this->M_customers->getCustomerDropDown();
            $data['supplierDDL'] = $this->M_suppliers->getSupplierDropDown();
               
            $this->load->view('templates/header',$data);
            //$this->load->view('pos/passengers/travel_agency/create_travel',$data);//for travel agency only
            $this->load->view('passengers/combine_create',$data);
            $this->load->view('templates/footer');
        }
    }
    
    function bulk_create()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST')
        {
            
            //form Validation
            $this->form_validation->set_rules('customer_id', 'customer_id', 'required');
            //$this->form_validation->set_rules('passport_no', 'Passport No', 'required');
            
            //$this->form_validation->set_rules('opening_balance_amount', 'Opening Balance Amount', 'required');
            //$this->form_validation->set_rules('capital_acc_code', 'Select Capital Account', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
           
           if($this->form_validation->run())
            { 
            $first_name = $this->input->post('first_name', true);
            $last_name = $this->input->post('last_name', true);
            $city = $this->input->post('city', true);
            $country = $this->input->post('country', true);
            $mobile_no = $this->input->post('mobile_no', true);
            $status = 'active';
            $description = $this->input->post('description', true);
            //FOR TRAVEL AGENT ONLY
            $passport_no = $this->input->post('passport_no', true);
            $cnic = $this->input->post('cnic', true);
            $father_name = $this->input->post('father_name', true);
            $gender = $this->input->post('gender', true);
            $dob = $this->input->post('dob', true);
            $passport_issue_date = $this->input->post('passport_issue_date', true);
            $passport_expiry_date = $this->input->post('passport_expiry_date', true);
            $mehram = $this->input->post('mehram', true);
            $customer_id = $this->input->post('customer_id', true);
            $visa_no = $this->input->post('visa_no', true);
            $visa_status = $this->input->post('visa_status', true);
            $visa_type = $this->input->post('visa_type', true);
            $visa_issue_date = $this->input->post('visa_issue_date', true);
                
            //after form Validation run
            foreach ($first_name as $i=>$values) {
   		      
              if($values != '')
              {
                $data = array(
                'company_id'=> $_SESSION['company_id'],
                'first_name' => @$values,
                'last_name' => @$last_name[$i],
                'city' => @$city[$i],
                'country' => @$country[$i],
                'mobile_no' => @$mobile_no[$i],
                'status' => 'active',
                'description' => @$description[$i],
                //FOR TRAVEL AGENT ONLY
                'passport_no' => @$passport_no[$i],
                'cnic' => @$cnic[$i],
                'father_name' => @$father_name[$i],
                "gender" => @$gender[$i],
                'dob' => @$dob[$i],
                'passport_issue_date' => @$passport_issue_date[$i],
                "passport_expiry_date" => @$passport_expiry_date[$i],
                'mehram' => @$mehram[$i],
                'customer_id' => $customer_id,
                'visa_no' => @$visa_no[$i],
                'visa_issue_date' => @$visa_issue_date[$i],
                'visa_status' => @$visa_status[$i],
                'visa_type' => @$visa_type[$i],
                ////
                );
              }
                $data1[] = $data;
              
            }
                
                if($this->db->insert_batch('hjms_passengers', $data1)) {
                    
                    //for logging
                    //$msg = $this->input->post('first_name'). ' '. $this->input->post('last_name');
                    //$this->M_logs->add_log($msg,"passenger","Added","POS");
                    // end logging
            
                    $this->session->set_flashdata('message','Passenger Created');
                }else{
                    $this->session->set_flashdata('error','Passenger not Created');
                }
                redirect('Passengers/index','refresh');
            }
          
        }
            $data['title'] = 'Bulk Create Passenger';
            $data['main'] = 'Bulk Create Passenger';
             $data['main_small'] = '';
        
            //$data['salesPostingTypeDDL'] = $this->M_postingTypes->get_SalesPostingTypesDDL();
            //$data['accountDDL'] = $this->M_groups->getGrpDetailDropDown($_SESSION['company_id'],$data['langs']);//search for legder account
            $data['currencyDropDown'] = $this->M_currencies->getcurrencyDropDown();
            $data['customerDDL'] = $this->M_customers->getCustomerDropDown();
               
            $this->load->view('templates/header',$data);
            //$this->load->view('pos/passengers/travel_agency/create_travel',$data);//for travel agency only
            $this->load->view('passengers/bulk_create',$data);
            $this->load->view('templates/footer');
        
    }
    //edit category
    public function edit($id=NULL)
    {
         //Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
        
        if($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form Validation
            //$this->form_validation->set_rules('posting_type_id', 'Posting Type Id', 'required');
            //$this->form_validation->set_rules('store_name', 'Company Name', 'required');
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('passport_no', 'Passport No', 'required');
            //$this->form_validation->set_rules('capital_acc_code', 'Select Capital Account', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
            
            //after form Validation run
            if($this->form_validation->run())
            {
                $data = array(
                'first_name' => $this->input->post('first_name', true),
                'last_name' => $this->input->post('last_name', true),
                'city' => $this->input->post('city', true),
                'country' => $this->input->post('country', true),
                'mobile_no' => $this->input->post('mobile_no', true),
                'description' => $this->input->post('description', true),
                //FOR TRAVEL AGENT ONLY
                'passport_no' => $this->input->post('passport_no', true),
                'cnic' => $this->input->post('cnic', true),
                'father_name' => $this->input->post('father_name', true),
                "gender" => $this->input->post('gender', true),
                'dob' => $this->input->post('dob', true),
                'passport_issue_date' => $this->input->post('passport_issue_date', true),
                "passport_expiry_date" => $this->input->post('passport_expiry_date', true),
                'mehram' => $this->input->post('mehram', true),
                'customer_id' => $this->input->post('customer_id', true),
                'visa_no' => $this->input->post('visa_no', true),
                'visa_status' => $this->input->post('visa_status', true),
                'visa_issue_date' => $this->input->post('visa_issue_date', true),
                'visa_type' => $this->input->post('visa_type', true),
                'user_id'=>$this->session->userdata('user_id'),
                ////
                );
            //$this->db->update('pos_passengers', $data, array('id'=>$_POST['id']));
            
                if($this->db->update('hjms_passengers', $data, array('id'=>$this->input->post('id')))) {
                    
                    //$passenger_id = $this->input->post('id');
                    //$exchange_rate = ($this->input->post('exchange_rate', true) == 0 ? 1 : $this->input->post('exchange_rate', true));
//                    
//                    $op_balance_dr = $this->input->post('op_balance_dr', true)/$exchange_rate;
//                    $op_balance_cr = $this->input->post('op_balance_cr', true)/$exchange_rate;
//                    
//                    
//                    $op_balance_dr_old = $this->input->post('op_balance_dr_old', true)/$exchange_rate;
//                    
//                    $op_balance_cr_old = $this->input->post('op_balance_cr_old', true)/$exchange_rate;
//                    
//                    
//                    $posting_type_code = $this->M_postingTypes->get_salesPostingTypes($this->input->post('posting_type_id',true));
//                       
//                     //OPENING BALANCE IN passenger ACCOUNT
//                       $receivable_account_code = $posting_type_code[0]['receivable_acc_code'];//passenger ledger id
//                       
//                       $receivable_account = $this->M_groups->get_groups($receivable_account_code,$_SESSION['company_id']);
//                       $receivable_dr_balance = abs($receivable_account[0]['op_balance_dr']);
//                       
//                       $receivable_cr_balance = abs($receivable_account[0]['op_balance_cr']);
//                       
//                       $dr_balance = $receivable_dr_balance-$op_balance_dr_old;
//                       $cr_balance = $receivable_cr_balance-$op_balance_cr_old;
//                       
//                       $dr_balance = ($dr_balance+$op_balance_dr);
//                       $cr_balance = ($cr_balance+$op_balance_cr);
//                       
//                       $this->M_groups->editGroupOPBalance($receivable_account_code,$dr_balance,$cr_balance);
                       
                       //POST IN cusmoter payment table
                       //$this->M_passengers->addpassengerPaymentEntry($receivable_account_code,0,0,0,$passenger_id,
                       //'Opening Balance-Debtor','',null,$exchange_rate,$op_balance_dr,$op_balance_cr);
                       ///
                    
                    $this->session->set_flashdata('message','Passenger Updated');
                }else{
                    $this->session->set_flashdata('error','Passenger not updated');
                }
            
                redirect('Passengers','refresh');
            }
        }
       //else
        //{
            $data['title'] = 'Update Passenger';
            $data['main'] = 'Update Passenger';
             $data['main_small'] = '';
        
            $data['passenger'] = $this->M_passengers->get_passengers($id);
            //$data['salesPostingTypeDDL'] = $this->M_postingTypes->get_SalesPostingTypesDDL();
            //$data['accountDDL'] = $this->M_groups->getGrpDetailDropDown($_SESSION['company_id'],$data['langs']);//search for legder account
            //$data['currencyDropDown'] = $this->M_currencies->getcurrencyDropDown();
            //$data['customerDDL'] = $this->M_customers->getCustomerDropDown();
            
            $this->load->view('templates/header',$data);
            $this->load->view('passengers/edit',$data);
            //$this->load->view('pos/passengers/travel_agency/edit_travel',$data);//for travel agency only
            $this->load->view('templates/footer');
        //}
        }//user level check end
    }
    
    function delete($id)
    {
         //Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
        $this->M_passengers->deletePassenger($id);
        $this->session->set_flashdata('message','Passenger Deleted');
        redirect('Passengers/index','refresh');
        }
    }
    
    function inactivate($id,$op_balance_dr=0,$op_balance_cr=0) // it will inactive the page
    {
         //Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
        $this->M_passengers->inactivate($id,$op_balance_dr,$op_balance_cr);
        $this->session->set_flashdata('message','Passenger Deleted');
        redirect('Passengers/index','refresh');
        }
    }
    
    function activate($id) // it will active 
    {
         //Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
        $this->M_passengers->activate($id);
        $this->session->set_flashdata('message','Passenger Activated');
        redirect('Passengers/index','refresh');
        }
    }
    
    public function passengerImport()
    {
          //Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
        $data['title'] = 'Passenger Imports';
        $data['main'] = 'Passenger Imports';
        $data['main_small'] = '';
        
        $this->load->view('templates/header',$data);
        $this->load->view('passengers/v_import',$data);
        $this->load->view('templates/footer');
        }
    }
    
    public function do_import()
    {
        //Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
        
        $config = array();
        $config['upload_path'] = './asset/images';
        $config['allowed_types'] = 'xlsx|xls|csv';
        
        $this->upload->initialize($config);
       
       //var_dump($_FILES);
       
        if(!$this->upload->do_upload('upload_items_import')){
            
                //$this->session->set_flashdata('error',$this->upload->display_errors().' error');
                $data = array('error' => $this->upload->display_errors());
                $this->load->view('passengers/v_import',$data);
                //redirect('Passengers/passengerImport','refresh');
            }
            else
            {
                $upload_data = $this->upload->data();
                @chmod($upload_data['full_path'],0777);
                
                $this->load->library('Excel');
                $this->load->library('IOFactory');
                $objPHPExcel= IOFactory::load($upload_data['full_path']);
                
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                
                $worksheet = $objPHPExcel->getSheet(0);
        		$lastRow = $worksheet->getHighestRow();
        		
                $uploads = false;
                $data_excel = array();
        		for ($row = 2; $row <= $lastRow; $row++) {
        		      
                      //REPLACE DATE VALUE FROM EXCEL AND
                      //CONVERT INTO MYSQL DATE FORMAT
                      $date = str_replace("/", "-", $worksheet->getCell('G'.$row)->getValue());
                      $dob = date("Y-m-d", strtotime($date));
                        
                      $data = array(
                        
                        $data_excel[$row - 1]['user_id'] = $this->session->userdata('user_id'),
                        $data_excel[$row - 1]['group_code'] = trim($worksheet->getCell('A'.$row)->getValue()),
                        $data_excel[$row - 1]["group_name"] = trim($worksheet->getCell('B'.$row)->getValue()),
                        $data_excel[$row - 1]['pnr_code'] = trim($worksheet->getCell('C'.$row)->getValue()),
                        $data_excel[$row - 1]['first_name'] = trim($worksheet->getCell('D'.$row)->getValue()),
                        $data_excel[$row - 1]['mofa_no'] = trim($worksheet->getCell('E'.$row)->getValue()),
                        $data_excel[$row - 1]['gender'] = trim($worksheet->getCell('F'.$row)->getValue()),
                        $data_excel[$row - 1]['dob'] = $dob,
                        $data_excel[$row - 1]['country'] = trim($worksheet->getCell('H'.$row)->getValue()),
                        $data_excel[$row - 1]['passport_no'] = trim($worksheet->getCell('I'.$row)->getValue()),
                        $data_excel[$row - 1]['mehram'] = trim($worksheet->getCell('K'.$row)->getValue()),
                        $data_excel[$row - 1]['relation'] = trim($worksheet->getCell('M'.$row)->getValue()),
                        $data_excel[$row - 1]['moi_no'] = trim($worksheet->getCell('N'.$row)->getValue()),
                        $data_excel[$row - 1]['active'] = '1',
                        );
                        
                        $uploads = true;
        		}
        		         if($uploads){
        		              
                           // $this->db->insert('pos_passengers', $data);
        			       $this->db->insert_batch('hjms_passengers',$data_excel);
                           
        		          $this->session->set_flashdata('message','Passenger uploaded successfully');
                        }else{
                            $this->session->set_flashdata('error','Passenger not uploaded');
                        }
                        
                        @unlink($upload_data['full_path']);
                        redirect('Passengers/index','refresh');
            }
          }
    }
}