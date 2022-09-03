<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_vouchers extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    //get all vouchers and also only one passenger and active and inactive too.
    public function get_all_vouchers($id = FALSE)
    {
        //$from_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_START_DATE')));
        //$to_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_END_DATE')));
        
        $this->db->where('v.date_created >=',$this->session->userdata('FY_START_DATE'));
        $this->db->where('v.date_created <=',$this->session->userdata('FY_END_DATE'));
        
        if($id === FALSE)
        {
            $this->db->select('v.id,v.voucher_no,v.voucher_date,v.ziarat,
            vf.arrival_date_to_ksa,vf.arrival_date_return,v.ziarat,vf.departure_date_to_ksa,vf.departure_date_return,
            v.remarks,v.voucher_date,v.user_id,u.name as username,v.makkah_contact_person,v.makkah_contact,v.shirka_id,
            v.madina_contact_person,v.madina_contact,vpd.room_type');
            
            //$this->db->join('hjms_transportation_trip ttrip','ON ttrip.id = v.transportation_trip_id','LEFT');
            //$this->db->join('hjms_transportation_type ttype','ON ttype.id = v.transportation_type_id','LEFT');
            $this->db->join('hjms_voucher_flight_info vf','ON vf.voucher_id = v.id','LEFT');
            $this->db->join('hjms_voucher_package_detail vpd','ON vpd.voucher_id = v.id','LEFT');
            $this->db->join('hjms_users u','ON v.user_id = u.id','LEFT');
            $this->db->group_by('v.id');
            $this->db->order_by('v.id','desc');
            $query = $this->db->get('hjms_vouchers v');
            $data = $query->result_array();
            return $data;
        }
        
        $this->db->select('vf.*,v.id,v.voucher_no,v.voucher_date,v.ziarat,v.remarks,v.voucher_date,
        v.transport_qty,u.name as username,v.makkah_contact_person,v.makkah_contact,v.shirka_id,
        v.madina_contact_person,v.madina_contact,vpd.room_type');
        $this->db->join('hjms_voucher_flight_info vf','ON vf.voucher_id = v.id','LEFT');
        //$this->db->join(' hjms_transportation_trip ttrip','ON ttrip.id = v.transportation_trip_id','LEFT');
        //$this->db->join('hjms_transportation_type ttype','ON ttype.id = v.transportation_type_id','LEFT');
        $this->db->join('hjms_voucher_package_detail vpd','ON vpd.voucher_id = v.id','LEFT');
        $this->db->join('hjms_users u','ON v.user_id = u.id','LEFT');
        $this->db->group_by('v.id');
        $options = array('v.id'=> $id);
        
        $query = $this->db->get_where('hjms_vouchers v',$options);
        $data = $query->result_array();
        return $data;
    }
    
    //get all vouchers and also only one passenger and active and inactive too.
    public function get_vouchersByUser($id = FALSE,$user_id=null)
    {
        
        $this->db->where('v.date_created >=',$this->session->userdata('FY_START_DATE'));
        $this->db->where('v.date_created <=',$this->session->userdata('FY_END_DATE'));
        
        if($user_id != null)
        {
            $this->db->where('v.user_id',$user_id);
        }
        
        if($id === FALSE)
        {
            $this->db->select('v.id,v.voucher_no,v.voucher_date,vf.arrival_date_to_ksa,vf.arrival_date_return,v.ziarat,v.group_name,v.group_code,
            v.remarks,v.voucher_date,v.transportation_type_id,v.transportation_trip_id,v.shirka_id,v.makkah_contact_person,v.makkah_contact,
            v.madina_contact_person,v.madina_contact,vpd.room_type');
            
            $this->db->order_by('v.id','desc');
            $this->db->join('hjms_voucher_flight_info vf','ON vf.voucher_id = v.id','LEFT');
            $this->db->join('hjms_voucher_package_detail vpd','ON vpd.voucher_id = v.id','LEFT');
            $this->db->group_by('v.id');

            //$this->db->where('v.user_id',$user_id);
            $query = $this->db->get('hjms_vouchers v');
            $data = $query->result_array();
            return $data;
        }
        
        $this->db->select('vf.*,v.id,v.voucher_no,v.voucher_date,v.ziarat,v.remarks,v.voucher_date,v.group_name,v.group_code,
        v.transport_qty,v.transportation_type_id,v.transportation_trip_id,v.makkah_contact_person,v.makkah_contact,
        v.madina_contact_person,v.madina_contact,v.transport_contact_person,v.shirka_id,v.transport_contact,v.kt_contact_person,v.kt_contact,
        u.company,u.contact,u.address,u.image,vpd.room_type');
        $this->db->join('hjms_voucher_flight_info vf','ON vf.voucher_id = v.id','LEFT');
        //$this->db->join('hjms_transportation_trip ttrip','ON ttrip.id = v.transportation_trip_id','LEFT');
        //$this->db->join('hjms_transportation_type ttype','ON ttype.id = v.transportation_type_id','LEFT');
        $this->db->join('hjms_voucher_package_detail vpd','ON vpd.voucher_id = v.id','LEFT');
        $this->db->join('hjms_users u','ON u.id = v.user_id','LEFT');
        $this->db->group_by('v.id');
        $options = array('v.id'=> $id);
        
        $query = $this->db->get_where('hjms_vouchers v',$options);
        $data = $query->result_array();
        return $data;
    }

    public function get_vouchers_invoice($id = FALSE,$user_id=null)
    {
        $this->db->where('v.date_created >=',$this->session->userdata('FY_START_DATE'));
        $this->db->where('v.date_created <=',$this->session->userdata('FY_END_DATE'));
        
        if($user_id != null)
        {
            $this->db->where('v.user_id',$user_id);
        }
        
        $this->db->select('vf.*,v.id,v.voucher_no,v.voucher_date,v.ziarat,v.remarks,v.voucher_date,v.group_name,v.group_code,
        ttrip.name as trip,ttype.name as type,v.transport_qty,v.transportation_type_id,v.transportation_trip_id,v.makkah_contact_person,v.makkah_contact,
        v.madina_contact_person,v.madina_contact,v.transport_contact_person,v.shirka_id,v.transport_contact,v.kt_contact_person,v.kt_contact,
        u.company,u.contact,u.address,u.image');
        $this->db->join('hjms_voucher_flight_info vf','ON vf.voucher_id = v.id','LEFT');
        $this->db->join('hjms_transportation_trip ttrip','ON ttrip.id = v.transportation_trip_id','LEFT');
        $this->db->join('hjms_transportation_type ttype','ON ttype.id = v.transportation_type_id','LEFT');
        $this->db->join('hjms_users u','ON u.id = v.user_id','LEFT');
                
        $options = array('v.id'=> $id);
        
        $query = $this->db->get_where('hjms_vouchers v',$options);
        $data = $query->result_array();
        return $data;
    }
    
    public function get_pkg_detail($voucher_id,$user_id=null)
    {
        $this->db->select('pkg.*, h.name as hotel, c.name as city');
        $this->db->join('hjms_hotels h','ON h.id = pkg.hotel_id','LEFT');
        $this->db->join('hjms_city c','ON c.id = pkg.city_id','LEFT');
        
        $options = array('voucher_id'=> $voucher_id);
        
        if($user_id != null)
        {
            $this->db->where('pkg.user_id',$user_id);
        }
        
        $query = $this->db->get_where('hjms_voucher_package_detail pkg',$options);
        $data = $query->result_array();
        return $data;
    }
   
    public function get_pax_detail($voucher_id,$user_id=null)
    {
        $this->db->select('vp.*,p.id AS id, p.first_name, p.last_name,p.passport_no,p.dob,p.visa_no,
        YEAR(CURDATE()) - YEAR(p.dob) AS age,p.visa_issue_date');
        $this->db->join('hjms_passengers p','ON p.id = vp.passenger_id','LEFT');
        
        $options = array('vp.voucher_id'=> $voucher_id);
        
        if($user_id != null)
        {
            $this->db->where('vp.user_id',$user_id);
        }
        
        $query = $this->db->get_where('hjms_voucher_pnr_detail vp',$options);
        $data = $query->result_array();
        return $data;
    }
    
    public function get_voucher_pax($voucher_id,$user_id=null)
    {
        $this->db->select('passenger_id');
        
        $options = array('voucher_id'=> $voucher_id);
        
        if($user_id != null)
        {
            $this->db->where('user_id',$user_id);
        }
        
        $query = $this->db->get_where('hjms_voucher_pnr_detail',$options);
        $data = $query->result_array();
        return $data;
    }

    public function get_pnrs($user_id)
    {
        //IF USER LEVEL 1 THEN SKIP THE USER ID CHECK
        if($this->session->userdata('level') !== '1'){
             
            if($user_id !== null)
            {
               $this->db->where('p.user_id',$user_id);
            }
        }
        
        $this->db->select('p.dob,vp.date_created');
        $from_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_START_DATE')));
        $to_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_END_DATE')));
        
        $this->db->where('vp.date_created >=',$from_date);
        $this->db->where('vp.date_created <=',$to_date);
        
        $this->db->join('hjms_passengers p','p.id=vp.passenger_id');
        
        $query = $this->db->get_where('hjms_voucher_pnr_detail vp');
        $data = $query->result_array();
        return $data;
    }

    function getMAXVoucherNo()
    {   
        $this->db->order_by('id DESC');
        $this->db->select('id');
        $query = $this->db->get('hjms_vouchers',1);
        return $query->row()->id;
    }
    
    function getTotalVouchers($user_id=null)
    {   
        //IF USER LEVEL 1 THEN SKIP THE USER ID CHECK
        if($this->session->userdata('level') !== '1'){
             
            if($user_id !== null)
            {
               $this->db->where('user_id',$user_id);
            }
        }
        
        $from_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_START_DATE')));
        $to_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_END_DATE')));
        
        $this->db->where('voucher_date >=',$from_date);
        $this->db->where('voucher_date <=',$to_date);
        
        $query = $this->db->get('hjms_vouchers');
        return $query->num_rows();
    }
    
    function getTotalPAX_by_voucher_id($voucher_id)
    {   
        $this->db->where('voucher_id',$voucher_id);
        
        $query = $this->db->get('hjms_voucher_pnr_detail');
        return $query->num_rows();
    }
    
    function checkVoucherAvailability($voucher_no)
    {   
        $this->db->where('voucher_no',$voucher_no);
        $query = $this->db->get('hjms_vouchers');
        if($query->num_rows() > 0){
            return true;
        }
        
            return false;
    }
}
?>