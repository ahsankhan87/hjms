<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_packages extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    //get all packages and also only one passenger and active and inactive too.
    public function get_packages($id = FALSE)
    {
        if($id === FALSE)
        {
            
            $this->db->order_by('id','desc');
            
            $query = $this->db->get_where('hjms_packages',array('company_id'=> $_SESSION['company_id']));
            $data = $query->result_array();
            return $data;
        }
        
        $this->db->order_by('id','desc');
        $options = array('id'=> $id,'company_id'=> $_SESSION['company_id']);
        
        $query = $this->db->get_where('hjms_packages',$options);
        $data = $query->result_array();
        return $data;
    }
    
    //get all packages and also only one passenger and active and inactive too.
    public function get_activeTransportationTrip($id = FALSE)
    {
        if($id === FALSE)
        {
            
            $options = array('active'=>1);
            
            $this->db->select('id,name');
        
            $query = $this->db->get_where('hjms_packages',$options);
            $data = $query->result_array();
            return $data;
        }
        
        $this->db->select('id,name');
        $options = array('id'=> $id,'active'=>1);
        
        $query = $this->db->get_where('hjms_packages',$options);
        $data = $query->result_array();
        return $data;
    }
    
    
    function getTransportationTypeDropDown()
    {
        $data = array();
        $data['']= 'Select Transportation Type';
        
        $query = $this->db->get_where('hjms_packages',array('active'=>1));
        
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
            'name' => $this->input->hjmst('name'),
            'description' => $this->input->hjmst('description'),
            'active' => 1
            );
            $this->db->insert('hjms_packages', $data);
            
        }
        
     function updateTransportationType()
        {
            //$file_name = $this->upload->data();
            
            $data = array(
            'name' => $this->input->hjmst('name'),
            'description' => $this->input->hjmst('description'),
            'date_modified' => date('Y-m-d H:i:s'),
            
            );
            $this->db->update('hjms_packages', $data, array('id'=>$_POST['id']));
            
        }
    
    function deleteTransportationType($id)
    {
       $this->db->delete('hjms_packages',array('id'=>$id));
            
    }
    
    function inactivate($id)
    {
       $query = $this->db->update('hjms_packages',array('active'=>0),array('id'=>$id));
        
            
    }
    
    function activate($id)
    {
        $query = $this->db->update('hjms_packages',array('active'=>1),array('id'=>$id));
        
    }
    
}
?>