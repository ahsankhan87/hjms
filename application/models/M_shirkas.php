<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_shirkas extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    //get all shirkas and also only one passenger and active and inactive too.
    public function get_shirkas($id = FALSE)
    {
        if($id === FALSE)
        {
            $this->db->order_by('id','desc');
            
            $query = $this->db->get_where('hjms_shirkas');
            $data = $query->result_array();
            return $data;
        }
        
        $this->db->order_by('id','desc');
        $options = array('id'=> $id);
        
        $query = $this->db->get_where('hjms_shirkas',$options);
        $data = $query->result_array();
        return $data;
    }
    
    //get all shirkas and also only one passenger and active and inactive too.
    public function get_activeshirkas($id = FALSE)
    {
        if($id === FALSE)
        {
            $this->db->select('id,name');
            $options = array('active'=>1);
            
            $query = $this->db->get_where('hjms_shirkas',$options);
            $data = $query->result_array();
            return $data;
        }
        
        $this->db->select('id,name');
        $options = array('id'=> $id,'active'=>1);
        
        $query = $this->db->get_where('hjms_shirkas',$options);
        $data = $query->result_array();
        return $data;
    }
    
    
    function getshirkasDropDown()
    {
        $data = array();
        //$data['']= 'Select Shirka';
        $this->db->order_by('id Desc');
        $query = $this->db->get_where('hjms_shirkas',array('active'=>1));
        
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
    
    function getshirkasDropDownByDefault()
    {
        $data = array();
        //$data['']= 'Select Shirka';
        
        $query = $this->db->get_where('hjms_shirkas',array('active'=>1,'is_default'=>1));
        
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
    
    function addshirkas($data)
        {
            
            $this->db->insert('hjms_shirkas', $data);
            
        }
        
     function updateshirkas($data)
        {
            $this->db->update('hjms_shirkas', $data, array('id'=>$this->input->post('id')));
            
        }
    
    function deleteshirkas($id)
    {
       $this->db->delete('hjms_shirkas',array('id'=>$id));
            
    }
    
    function inactivate($id)
    {
       $query = $this->db->update('hjms_shirkas',array('active'=>0),array('id'=>$id));
        
            
    }
    
    function activate($id)
    {
        $query = $this->db->update('hjms_shirkas',array('active'=>1),array('id'=>$id));
        
    }
    
}
?>