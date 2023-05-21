<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vouchers extends MY_Controller{
  
  public function __construct()
    {
        parent::__construct();
       
        $this->load->library('form_validation');
    }
    
  public function index()
	{
		$data['title'] = 'List of Vouchers';
        $data['main'] = 'List of Vouchers';;
        $data['main_small'] = '';
        
        $data['vouchers'] = $this->M_vouchers->get_vouchersByUser(False,$this->session->userdata('user_id'));
        
        $this->load->view('templates/header',$data);
        $this->load->view('vouchers/v_vouchers');
        $this->load->view('templates/footer');
        
	}
 public function allVouchers()
	{
		//Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
           $this->load->view('403',$data);
      }else{
        
            $data['title'] = 'List of All Vouchers';
            $data['main'] = 'List of All Vouchers';;
            $data['main_small'] = '';
            
            $data['vouchers'] = $this->M_vouchers->get_all_vouchers(False);
            
            $this->load->view('templates/header',$data);
            $this->load->view('vouchers/v_all_vouchers');
            $this->load->view('templates/footer');
        }
	}
    
  public function create()
	{
	   //Allowing akses to admin only
     // if($this->session->userdata('level') !== '1'){
//          $data['title'] = "403 Access Denied";
//      }else{
      
	   if($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form Validation
            
            //$this->form_validation->set_rules('name', 'Name', 'required');
            //$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
            
            //after form Validation run
            //if($this->form_validation->run())
            //{
            //var_dump($_POST);
            
            
            if(!empty($this->input->post('pax_id')))
            {
                
            
            $this->db->trans_start();
             
            $voucher_data = array(
            'voucher_date' => $this->input->post('voucher_date'),
            'voucher_no' => $this->input->post('voucher_no'),
            'transportation_trip_id'=> $this->input->post('transportation_trip_id', true),
            'transportation_type_id'=> $this->input->post('transportation_type_id', true),
            'transport_qty'=> $this->input->post('transport_qty', true),
            'ziarat'=> $this->input->post('ziarat', true),
            'remarks'=> $this->input->post('remarks', true),
            'user_id'=> $this->session->userdata('user_id'),
            'shirka_id'=> $this->input->post('shirka_id', true),
            
            'makkah_contact_person'=> $this->input->post('makkah_contact_person', true),
            'makkah_contact'=> $this->input->post('makkah_contact', true),
            'madina_contact_person'=> $this->input->post('madina_contact_person', true),
            'madina_contact'=> $this->input->post('madina_contact', true),
            'transport_contact_person'=> $this->input->post('transport_contact_person', true),
            'transport_contact'=> $this->input->post('transport_contact', true),
            'kt_contact_person'=> $this->input->post('kt_contact_person', true),
            'kt_contact'=> $this->input->post('kt_contact', true),
            
            'group_name'=> $this->input->post('group_name', true),
            'group_code'=> $this->input->post('group_code', true),
            
            );
            $this->db->insert('hjms_vouchers', $voucher_data);
            $voucher_id = $this->db->insert_id();
            
            $flight_data = array(
            'voucher_id' => $voucher_id, 
            'voucher_no' => $this->input->post('voucher_no'),
            'sector1_to_ksa' => $this->input->post('sector1_to_ksa', true),
            'sector2_to_ksa' => $this->input->post('sector2_to_ksa', true),
            'flight1_to_ksa' => $this->input->post('flight1_to_ksa', true),
            'flight2_to_ksa' => $this->input->post('flight2_to_ksa', true),
            'departure_date_to_ksa' => $this->input->post('departure_date_to_ksa', true),
            'departure_time_to_ksa' => $this->input->post('departure_time_to_ksa', true),
            'arrival_date_to_ksa' => $this->input->post('arrival_date_to_ksa', true),
            'arrival_time_to_ksa' => $this->input->post('arrival_time_to_ksa', true),
            'pnr_to_ksa' => $this->input->post('pnr_to_ksa', true),
            'sector1_return' => $this->input->post('sector1_return', true),
            'sector2_return' => $this->input->post('sector2_return', true),
            'flight1_return' => $this->input->post('flight1_return', true),
            'flight2_return' => $this->input->post('flight2_return', true),
            'departure_date_return' => $this->input->post('departure_date_return', true),
            'departure_time_return' => $this->input->post('departure_time_return', true),
            'arrival_date_return' => $this->input->post('arrival_date_return', true),
            'arrival_time_return' => $this->input->post('arrival_time_return', true),
            'pnr_return' => $this->input->post('pnr_return', true),
            'user_id'=> $this->session->userdata('user_id'),
            );
            
            $this->db->insert('hjms_voucher_flight_info', $flight_data);
            
            /////////////////////////////////////////
            ////PAX ENTRY IN TO VOUCHER TABLE
            $pax = $this->input->post('pax_id', true);
            foreach ($pax as $i=>$pax_id) {
   		      
              if($pax_id != '')
              {
                $data = array(
                'voucher_id' => $voucher_id, 
                'voucher_no' => $this->input->post('voucher_no'),
                'passenger_id' => @$pax_id,
                'user_id'=>$this->session->userdata('user_id'),
                ////
                );
                
                $pax_inv_data = array(
                'invoiced' => 1, 
                ////
                );
                $this->db->update('hjms_passengers', $pax_inv_data,array('id' => @$pax_id));
            
              }
                $data2[] = $data;
                
            }
            $this->db->insert_batch('hjms_voucher_pnr_detail', $data2);
            
            //////////////////////////////
            $city=$this->input->post('city', true);
            $pck_nights=$this->input->post('pck_nights', true);
            $pkg_checkin=$this->input->post('pkg_checkin', true);
            $pkg_checkout=$this->input->post('pkg_checkout', true);
            $hotel_id=$this->input->post('hotel_id', true);
            $room_type=$this->input->post('room_type', true);

            //after form Validation run
            foreach ($city as $i=>$values) {
   		      
              if(@$pck_nights[$i] !== 0)
              {
                $data = array(
                'voucher_id' => $voucher_id, 
                'voucher_no' => $this->input->post('voucher_no'),
                'city_id' => @$values,
                'nights' => @$pck_nights[$i],
                'checkin' => @$pkg_checkin[$i],
                'checkout' => @$pkg_checkout[$i],
                'hotel_id' => @$hotel_id[$i],
                'room_type' => @$room_type[$i],
                'user_id'=>$this->session->userdata('user_id'),
                ////
                );
              }
                $data1[] = $data;
              
            }
                
                if($this->db->insert_batch('hjms_voucher_package_detail', $data1)) {
                    
                    $this->session->set_flashdata('message','Voucher Created');
                }else{
                    $this->session->set_flashdata('error','Not Created');
                }
           $this->db->trans_complete();
           
           redirect('Vouchers/index','refresh');
            //}
            
            }else{ echo '<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>Select Pax</strong></div>';}//check empty paxs
        }
        
		    $data['title'] = 'Create Vouchers';
        $data['main'] = 'Create Vouchers';;
        $data['main_small'] = '';
        
            //GET PREVIOISE INVOICE NO  
           @$prev_invoice_no = $this->M_vouchers->getMAXVoucherNo();
           //$number = (int) substr($prev_invoice_no,11)+1; // EXTRACT THE LAST NO AND INCREMENT BY 1
           //$new_invoice_no = 'POS'.date("Ymd").$number;
           $number = (int) $prev_invoice_no+1; // EXTRACT THE LAST NO AND INCREMENT BY 1
           $data['new_invoice_no'] = $number;
           
        $data['trans_type'] = $this->M_transportation_type->get_activeTransportationType();
        $data['trans_trip'] = $this->M_transportation_trip->get_activeTransportationTrip();
        $data['hotels'] = $this->M_hotels->getHotelsDropDown();
        $data['city'] = $this->M_city->getCityDropDown();
        
        if($this->session->userdata('level') >= '2'){
          $data['shirkasDDL'] = $this->M_shirkas->getshirkasDropDownByDefault();
        }else{
            $data['shirkasDDL'] = $this->M_shirkas->getshirkasDropDown();
        }
        $this->load->view('templates/header',$data);
        $this->load->view('vouchers/create');
        $this->load->view('templates/footer');
        
        //}//check logged in user
	}
    
  public function edit($voucher_id = null, $user_id=null)
	{
	   //Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
      //var_dump($_POST);
      
	   if($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form Validation
            
            //$this->form_validation->set_rules('name', 'Name', 'required');
            //$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
            
            //after form Validation run
            //if($this->form_validation->run())
            //{
            
            $this->db->trans_start();
            
            $voucher_id = $this->input->post('voucher_id', true);
            $user_id = $this->input->post('user_id', true);
            
            //DELETE ALL THE VOUCHER DATA AND INSERT NEW ONE
            $this->delete_voucher_by_id($voucher_id,false,$user_id);
            ////////////////
            
            $voucher_data = array(
            'id'=>$voucher_id,
            'voucher_date' => $this->input->post('voucher_date'),
            'voucher_no' => $this->input->post('voucher_no'),
            'date_modified' => date('Y-m-d H:i:s'),
            'date_created'=> $this->input->post('date_created', true),
            'transportation_trip_id'=> $this->input->post('transportation_trip_id', true),
            'transportation_type_id'=> $this->input->post('transportation_type_id', true),
            'transport_qty'=> $this->input->post('transport_qty', true),
            'ziarat'=> $this->input->post('ziarat', true),
            'remarks'=> $this->input->post('remarks', true),
            'user_id'=> $this->input->post('user_id', true),
            'shirka_id'=> $this->input->post('shirka_id', true),
            
            'makkah_contact_person'=> $this->input->post('makkah_contact_person', true),
            'makkah_contact'=> $this->input->post('makkah_contact', true),
            'madina_contact_person'=> $this->input->post('madina_contact_person', true),
            'madina_contact'=> $this->input->post('madina_contact', true),
            'transport_contact_person'=> $this->input->post('transport_contact_person', true),
            'transport_contact'=> $this->input->post('transport_contact', true),
            'kt_contact_person'=> $this->input->post('kt_contact_person', true),
            'kt_contact'=> $this->input->post('kt_contact', true),

            'group_name'=> $this->input->post('group_name', true),
            'group_code'=> $this->input->post('group_code', true),
            
            );
            $this->db->insert('hjms_vouchers', $voucher_data);
            
            //var_dump($voucher_data);
            
            $flight_data = array(
            'voucher_id' => $voucher_id, 
            'voucher_no' => $this->input->post('voucher_no'),
            'sector1_to_ksa' => $this->input->post('sector1_to_ksa', true),
            'sector2_to_ksa' => $this->input->post('sector2_to_ksa', true),
            'flight1_to_ksa' => $this->input->post('flight1_to_ksa', true),
            'flight2_to_ksa' => $this->input->post('flight2_to_ksa', true),
            'departure_date_to_ksa' => $this->input->post('departure_date_to_ksa', true),
            'departure_time_to_ksa' => $this->input->post('departure_time_to_ksa', true),
            'arrival_date_to_ksa' => $this->input->post('arrival_date_to_ksa', true),
            'arrival_time_to_ksa' => $this->input->post('arrival_time_to_ksa', true),
            'pnr_to_ksa' => $this->input->post('pnr_to_ksa', true),
            'sector1_return' => $this->input->post('sector1_return', true),
            'sector2_return' => $this->input->post('sector2_return', true),
            'flight1_return' => $this->input->post('flight1_return', true),
            'flight2_return' => $this->input->post('flight2_return', true),
            'departure_date_return' => $this->input->post('departure_date_return', true),
            'departure_time_return' => $this->input->post('departure_time_return', true),
            'arrival_date_return' => $this->input->post('arrival_date_return', true),
            'arrival_time_return' => $this->input->post('arrival_time_return', true),
            'pnr_return' => $this->input->post('pnr_return', true),
            'user_id'=> $this->input->post('user_id', true),
            'date_created'=> $this->input->post('date_created', true),
            'date_modified' => date('Y-m-d H:i:s'),
            
            );
            
            $this->db->insert('hjms_voucher_flight_info', $flight_data);
            
            /////////////////////////////////////////
            ////PAX ENTRY IN TO VOUCHER TABLE
            $pax = $this->input->post('pax_id', true);
            if(count($pax) > 0)
              {
                foreach ($pax as $i=>$pax_id) {
              
                  $data = array(
                  'voucher_id' => $voucher_id, 
                  'voucher_no' => $this->input->post('voucher_no'),
                  'passenger_id' => @$pax_id,
                  'user_id'=>$this->input->post('user_id', true),
                  'date_created'=> $this->input->post('date_created', true),
                  'date_modified' => date('Y-m-d H:i:s'),
                  ////
                  );
                  
                  $pax_inv_data = array(
                  'invoiced' => 1, 
                  ////
                  );
                  $this->db->update('hjms_passengers', $pax_inv_data,array('id' => @$pax_id));
              
                
                  $data2[] = $data;
                }
              
                $this->db->insert_batch('hjms_voucher_pnr_detail', $data2);
              }
            //////////////////////////////
            $city=$this->input->post('city', true);
            $pck_nights=$this->input->post('pck_nights', true);
            $pkg_checkin=$this->input->post('pkg_checkin', true);
            $pkg_checkout=$this->input->post('pkg_checkout', true);
            $hotel_id=$this->input->post('hotel_id', true);
            $room_type=$this->input->post('room_type', true);

            //after form Validation run
            foreach ($city as $i=>$values) {
   		      
              if($values != '')
              {
                $data = array(
                'voucher_id' => $voucher_id, 
                'voucher_no' => $this->input->post('voucher_no'),
                'city_id' => @$values,
                'nights' => @$pck_nights[$i],
                'checkin' => @$pkg_checkin[$i],
                'checkout' => @$pkg_checkout[$i],
                'hotel_id' => @$hotel_id[$i],
                'room_type' => @$room_type[$i],
                'user_id'=>$this->input->post('user_id', true),
                'date_created'=> $this->input->post('date_created', true),
                'date_modified' => date('Y-m-d H:i:s'),
                ////
                );
              }
                $data1[] = $data;
              
            }
                if($this->db->insert_batch('hjms_voucher_package_detail', $data1)) {
                    
                    $this->session->set_flashdata('message','Updated');
                }else{
                    $this->session->set_flashdata('error','Not updated');
                }
                
                $this->db->trans_complete();
           
                redirect('Vouchers/index','refresh');
            //}
        }
        
		    $data['title'] = 'Edit Vouchers';
        $data['main'] = 'Edit Vouchers';;
        $data['main_small'] = '';
        
        $data['invoice'] = $this->M_vouchers->get_vouchersByUser($voucher_id,$user_id);
        $data['pckg_voucher'] = $this->M_vouchers->get_pkg_detail($voucher_id,$user_id);
        
        $data['trans_type'] = $this->M_transportation_type->get_activeTransportationType();
        $data['trans_trip'] = $this->M_transportation_trip->get_activeTransportationTrip();
        $data['hotels'] = $this->M_hotels->getHotelsDropDown();
        $data['city'] = $this->M_city->getCityDropDown();

        if($this->session->userdata('level') >= '2'){
          $data['shirkasDDL'] = $this->M_shirkas->getshirkasDropDownByDefault();
        }else{
            $data['shirkasDDL'] = $this->M_shirkas->getshirkasDropDown();
        }
        
        $this->load->view('templates/header',$data);
        $this->load->view('vouchers/edit');
        $this->load->view('templates/footer');
        
        }//check logged in user
	}
    
    public function pax_popup_post()
     {
        $pax_data = $this->input->post('pax_id',true);
        if(!empty($pax_data))
        {
          
          if($this->session->userdata('level') !== '1'){
            $user_id = $this->session->userdata('user_id');
          }else{
            $user_id = null;
          }
  
            $data = $this->M_passengers->get_passengersWherein($pax_data,$user_id);
            echo json_encode($data);    
        }
        
     }
   
   //SHOW THE PAX ON POPUP WHEN CLICK ON SELECT PAX BUTTON
   public function pax_popup()
     {
        //$pax_id = $this->input->post('product_id',true);
        if($this->session->userdata('level') !== '1'){
          $user_id = $this->session->userdata('user_id');
        }else{
          $user_id = null;
        }

        $data = $this->M_passengers->get_passengersNotInvoiced(false,$user_id);
        echo json_encode($data);
	    //$this->load->view('vouchers/v_pax_popup',$data);
        
     }
   
   //GET ALL INVOICED PAX FOR EDIT WHEN THE PAGE LAOD
   public function voucher_pax_popup($voucher_id,$user_id)
   {
        $data = $this->M_vouchers->get_pax_detail($voucher_id,$user_id);
        echo json_encode($data);
	    
   }
     
   public function rmvInvoicedPnr()
     {
        $this->db->trans_start();
        $pnr_id = $this->input->post('id',true);
        $pax_inv_data = array(
                'invoiced' => 0, 
                );
        $this->db->update('hjms_passengers', $pax_inv_data,array('id' =>$pnr_id,'user_id'=>$this->session->userdata('user_id')));
        
        ///////////////////////
        $this->db->delete('hjms_voucher_pnr_detail',array('passenger_id' =>$pnr_id));
        ////////////////////////
        $this->db->trans_complete(); 
        
        if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
            else
            {
              return FALSE;
            }
       
    }
   public function invoice($voucher_id,$voucher_no=0)
     {
        $data['title'] = 'VNo.'.$voucher_no;
        $data['main'] = 'VNo.'.$voucher_no;
        $data['main_small'] = '';
        
        if($this->session->userdata('level') !== '1'){
          $user_id = $this->session->userdata('user_id');
        }else{
          $user_id = null;
        }

        $data['invoice'] = $this->M_vouchers->get_vouchers_invoice($voucher_id,$user_id);
        
        $this->load->view('vouchers/v_invoice',$data);
     }
     
   function delete_voucher_by_id($voucher_id,$isDeleted,$user_id)
   {
      //Allowing akses to admin only
      if($this->session->userdata('level') !== '1' && $isDeleted){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
        
            $this->db->trans_start();
               
            $this->db->delete('hjms_vouchers',array('id'=>$voucher_id));
            $this->db->delete('hjms_voucher_flight_info',array('voucher_id'=>$voucher_id));
            
            $pnr_data = $this->M_vouchers->get_voucher_pax($voucher_id,$user_id);
            
            foreach($pnr_data as $pnr)
            {
                $this->db->update('hjms_passengers',array('invoiced'=>0),array('id'=>$pnr['passenger_id']));
            
            }
            
            $this->db->delete('hjms_voucher_pnr_detail',array('voucher_id'=>$voucher_id));
            $this->db->delete('hjms_voucher_package_detail',array('voucher_id'=>$voucher_id));
            
            $this->db->trans_complete();
            
            if($isDeleted){
                $this->session->set_flashdata('message','Voucher Deleted');
                redirect('Vouchers/index','refresh');
                
            }
      }//check logged in user  
   }
   
   function checkVoucherNoAvailability()
   {
        $voucher_no = $this->input->post('voucher_no',true);
        if($this->M_vouchers->checkVoucherAvailability($voucher_no))
        {
            echo true;
        }else{
            echo false;
        }
        
   }
}