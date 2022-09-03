<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_reports extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function arrival_reports($from_date=null,$to_date=null,$user_id,$city_keyword='',$isArrival,$isDeparture)
    {
        
        
        if($isArrival)
        {
            if($from_date != null && $to_date != null){
                $this->db->where("arrival_date_to_ksa BETWEEN '$from_date' AND '$to_date'");
            }
        }
            
        if($isDeparture)
        {
            if($from_date != null && $to_date != null){
                $this->db->where("arrival_date_return BETWEEN '$from_date' AND '$to_date'");
            }
        }
        
        if($city_keyword != '')
        {
            $this->db->like('vf.sector2_to_ksa',$city_keyword,'left');
            
        }
        
        $this->db->where('vpnr.date_created >=',$from_date);
        $this->db->where('vpnr.date_created <=',$to_date);
        
        $this->db->select('vpnr.*,vf.arrival_date_to_ksa,vf.arrival_date_return,vf.sector2_to_ksa,
        vf.arrival_time_to_ksa,vf.arrival_time_return,vf.departure_date_to_ksa,vf.departure_date_return,
        vf.departure_time_to_ksa,vf.departure_time_return,
        p.first_name, p.last_name,p.passport_no,p.dob,p.visa_no,
        YEAR(CURDATE()) - YEAR(p.dob) AS age,p.visa_issue_date');
        $this->db->join('hjms_voucher_flight_info vf','ON vf.voucher_id = vpnr.voucher_id','LEFT');
        $this->db->join('hjms_passengers p','ON p.id = vpnr.passenger_id','LEFT');
        //$this->db->join('hjms_users u','ON u.id = vpnr.user_id','LEFT');
                
        $options = array('vpnr.user_id'=>$user_id);
        
        $query = $this->db->get_where('hjms_voucher_pnr_detail vpnr',$options);
        $data = $query->result_array();
        //print_r($this->db->last_query()); 
        
        return $data;
    }
    
    function total_arrival_reports($report_date,$user_id,$city_1,$city_2)
    {
        $from_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_START_DATE')));
        $to_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_END_DATE')));
           
        $this->db->where('hvfi.date_created >=',$from_date);
        $this->db->where('hvfi.date_created <=',$to_date);
        
         $query_string = "SELECT(
                          SELECT COUNT(vpnr.passenger_id)
                    	  FROM hjms_voucher_pnr_detail AS vpnr LEFT JOIN hjms_voucher_flight_info AS vf
                          ON vpnr.voucher_id = vf.voucher_id
                          WHERE vpnr.user_id = '$user_id' AND vf.sector2_to_ksa LIKE '$city_1' AND 
                          arrival_date_to_ksa = '$report_date'
                          
                    	  ) AS total_arrival_city_1,
                    	  (SELECT COUNT(vpnr.passenger_id)
                    	  FROM hjms_voucher_pnr_detail vpnr LEFT JOIN hjms_voucher_flight_info vf
                          ON vpnr.voucher_id = vf.voucher_id
                          WHERE vpnr.user_id = '$user_id' AND vf.sector2_to_ksa LIKE '$city_1' AND
                          vf.arrival_date_return = '$report_date'
                    	  ) AS total_departure_city_1,
                          (
                          SELECT COUNT(vpnr.passenger_id)
                    	  FROM hjms_voucher_pnr_detail vpnr LEFT JOIN hjms_voucher_flight_info vf
                          ON vpnr.voucher_id = vf.voucher_id
                          WHERE vpnr.user_id = '$user_id' AND vf.sector2_to_ksa LIKE '$city_2' AND 
                          arrival_date_to_ksa = '$report_date'
                    	  ) AS total_arrival_city_2,
                    	  (
                          SELECT COUNT(vpnr.passenger_id)
                    	  FROM hjms_voucher_pnr_detail vpnr LEFT JOIN hjms_voucher_flight_info vf
                          ON vpnr.voucher_id = vf.voucher_id
                          WHERE vpnr.user_id = '$user_id' AND vf.sector2_to_ksa LIKE '$city_2' AND
                          vf.arrival_date_return = '$report_date'
                    	  ) AS total_departure_city_2
                        FROM hjms_voucher_flight_info hvfi
                        GROUP BY total_arrival_city_1";
                    
        $query = $this->db->query($query_string);
        //$query = $this->db->get_where('hjms_voucher_flight_info vf',$options);
        $data = $query->result_array();
        //print_r($this->db->last_query()); 
        return $data;
    }
    
    function checkin_checkout($report_date,$user_id,$city_1,$city_2)
    {
         $query_string = "SELECT(
                          SELECT COUNT(vpnr.passenger_id)
                    	  FROM hjms_voucher_pnr_detail vpnr LEFT JOIN hjms_voucher_package_detail vp
                          ON vpnr.voucher_id = vp.voucher_id
                          WHERE vpnr.user_id = '$user_id' AND vp.city_id = '$city_1' AND 
                          vp.checkin = '$report_date'
                    	  ) AS checkin_city_makkah,
                    	  (
                          SELECT COUNT(vpnr.passenger_id)
                    	  FROM hjms_voucher_pnr_detail vpnr LEFT JOIN hjms_voucher_package_detail vp
                          ON vpnr.voucher_id = vp.voucher_id
                          WHERE vpnr.user_id = '$user_id' AND vp.city_id = '$city_1' AND
                          vp.checkout = '$report_date'
                    	  ) AS checkout_city_makkah,
                          (
                          SELECT COUNT(vpnr.passenger_id)
                    	  FROM hjms_voucher_pnr_detail vpnr LEFT JOIN hjms_voucher_package_detail vp
                          ON vpnr.voucher_id = vp.voucher_id
                          WHERE vpnr.user_id = '$user_id' AND vp.city_id = '$city_2' AND 
                          vp.checkin = '$report_date'
                    	  ) AS checkin_city_madina,
                    	  (
                          SELECT COUNT(vpnr.passenger_id)
                    	  FROM hjms_voucher_pnr_detail vpnr LEFT JOIN hjms_voucher_package_detail vp
                          ON vpnr.voucher_id = vp.voucher_id
                          WHERE vpnr.user_id = '$user_id' AND vp.city_id = '$city_2' AND
                          vp.checkout = '$report_date'
                    	  ) AS checkout_city_madina
                        FROM hjms_voucher_package_detail
                        GROUP BY checkin_city_makkah";
                    
        $query = $this->db->query($query_string);
        //$query = $this->db->get_where('hjms_voucher_flight_info vf',$options);
        $data = $query->result_array();
        return $data;
    }
    
    function total_pnr_by_city($report_date,$user_id,$city_id)
    {
        $query_string =  "SELECT COUNT(vpnr.id) AS total_pnr
                    	  FROM  hjms_voucher_pnr_detail vpnr LEFT JOIN hjms_voucher_package_detail vp 
                          ON vpnr.voucher_id = vp.voucher_id
                          WHERE vp.user_id = '$user_id' AND vp.city_id = '$city_id' AND
                          vp.checkin <= '$report_date' AND vp.checkout >= '$report_date'
 	                     ";
                    
        $query = $this->db->query($query_string);
        //$query = $this->db->get_where('hjms_voucher_flight_info vf',$options);
        $data = $query->result_array();
        return $data;   
    }
}