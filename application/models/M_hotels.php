<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_hotels extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    //get all hotels and also only one passenger and active and inactive too.
    public function get_hotels($id = FALSE)
    {
        if($id === FALSE)
        {
            $this->db->order_by('id','desc');
            
            $query = $this->db->get_where('hjms_hotels');
            $data = $query->result_array();
            return $data;
        }
        
        $this->db->order_by('id','desc');
        $options = array('id'=> $id);
        
        $query = $this->db->get_where('hjms_hotels',$options);
        $data = $query->result_array();
        return $data;
    }
    
    //get all hotels and also only one passenger and active and inactive too.
    public function get_activeHotels($id = FALSE)
    {
        if($id === FALSE)
        {
            $this->db->select('id,name');
            $options = array('active'=>1);
            
            $query = $this->db->get_where('hjms_hotels',$options);
            $data = $query->result_array();
            return $data;
        }
        
        $this->db->select('id,name');
        $options = array('id'=> $id,'active'=>1);
        
        $query = $this->db->get_where('hjms_hotels',$options);
        $data = $query->result_array();
        return $data;
    }
    
    
    function getHotelsDropDown()
    {
        $data = array();
        $data['']= 'Select Hotel';
        
        $query = $this->db->get_where('hjms_hotels',array('active'=>1));
        
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
    
    function getHotelsDropDownByVoucherID($voucher_id)
    {
        $data = array();
        $data['']= 'Select Hotel';
        
        $query = $this->db->get_where('hjms_hotels',array('voucher_id'=>$voucher_id,'active'=>1));
        
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
    
    function addHotels($data)
        {
            
            $this->db->insert('hjms_hotels', $data);
            
        }
        
     function updateHotels($data)
        {
            $this->db->update('hjms_hotels', $data, array('id'=>$this->input->post('id')));
            
        }
    
    function deleteHotels($id)
    {
       $this->db->delete('hjms_hotels',array('id'=>$id));
            
    }
    
    function inactivate($id)
    {
       $query = $this->db->update('hjms_hotels',array('active'=>0),array('id'=>$id));
        
            
    }
    
    function activate($id)
    {
        $query = $this->db->update('hjms_hotels',array('active'=>1),array('id'=>$id));
        
    }
    
}
?>