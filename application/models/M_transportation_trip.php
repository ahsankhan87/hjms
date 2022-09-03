<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_transportation_trip extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    //get all transportation_trip and also only one passenger and active and inactive too.
    public function get_transportation_trip($id = FALSE)
    {
        if($id === FALSE)
        {
            $query = $this->db->get('hjms_transportation_trip');
            $data = $query->result_array();
            return $data;
        }
        
        $options = array('id'=> $id);
        
        $query = $this->db->get_where('hjms_transportation_trip',$options);
        $data = $query->result_array();
        return $data;
    }
    
    public function get_TransportationTripName($id)
    {
        $options = array('id'=> $id);
        
        $query = $this->db->get_where('hjms_transportation_trip',$options);
        if($row = $query->row())
        {
            return $row->name;
        }
        
        return '';
    }
    
    //get all transportation_trip and also only one passenger and active and inactive too.
    public function get_activeTransportationTrip($id = FALSE)
    {
        if($id === FALSE)
        {
            
            $options = array('active'=>1);
            
            $this->db->select('id,name');
        
            $query = $this->db->get_where('hjms_transportation_trip',$options);
            $data = $query->result_array();
            return $data;
        }
        
        $this->db->select('id,name');
        $options = array('id'=> $id,'active'=>1);
        
        $query = $this->db->get_where('hjms_transportation_trip',$options);
        $data = $query->result_array();
        return $data;
    }
    
    public function get_activeTransportationTripByVoucherId($voucher_id)
    {
        $this->db->select('id,name');
        $options = array('voucher_id'=> $voucher_id,'active'=>1);
        
        $query = $this->db->get_where('hjms_transportation_trip',$options);
        $data = $query->result_array();
        return $data;
    }
    
    function getTransportationTypeDropDown()
    {
        $data = array();
        $data['']= 'Select Transportation Type';
        
        $query = $this->db->get_where('hjms_transportation_trip',array('active'=>1));
        
        if ($query->num_rows() > 0)
        {
            foreach ($query->result_array() as $row)
            {
                 $data[$row['id']] = $row['name'];
            }
        }
        $query->free_result();
        return $data;
    }
 
    function addTransportationType()
        {
            $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'active'=>$this->input->post('active'),
            'user_id'=>$this->session->userdata('user_id'),
            );
            $this->db->insert('hjms_transportation_trip', $data);
            
        }
        
     function updateTransportationType()
        {
            //$file_name = $this->upload->data();
            
            $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'date_modified' => date('Y-m-d H:i:s'),
            'active'=>$this->input->post('active'),
            'user_id'=>$this->session->userdata('user_id'),
            );
            $this->db->update('hjms_transportation_trip', $data, array('id'=>$this->input->post('id')));
            
        }
    
    function deleteTransportationType($id)
    {
       $this->db->delete('hjms_transportation_trip',array('id'=>$id));
            
    }
    
    function inactivate($id)
    {
       $query = $this->db->update('hjms_transportation_trip',array('active'=>0),array('id'=>$id));
        
            
    }
    
    function activate($id)
    {
        $query = $this->db->update('hjms_transportation_trip',array('active'=>1),array('id'=>$id));
        
    }
    
}
?>