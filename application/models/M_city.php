<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_city extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    //get all city and also only one passenger and active and inactive too.
    public function get_city($id = FALSE)
    {
        if($id === FALSE)
        {
            $query = $this->db->get('hjms_city');
            $data = $query->result_array();
            return $data;
        }
        
        $options = array('id'=> $id);
        
        $query = $this->db->get_where('hjms_city',$options);
        $data = $query->result_array();
        return $data;
    }
    
    //get all city and also only one passenger and active and inactive too.
    public function get_activeCity($id = FALSE)
    {
        if($id === FALSE)
        {
            $options = array('active'=>1);
            
            $this->db->select('id,name');
        
            $query = $this->db->get_where('hjms_city',$options);
            $data = $query->result_array();
            return $data;
        }
        
        $this->db->select('id,name');
        $options = array('id'=> $id,'active'=>1);
        
        $query = $this->db->get_where('hjms_city',$options);
        $data = $query->result_array();
        return $data;
    }
    
    
    function getCityDropDown()
    {
        $data = array();
        $data[0]= 'Select City';
        $this->db->where('active',1);
        $query = $this->db->get('hjms_city');
        
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
 
    function addCity()
        {
            $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'active'=>$this->input->post('active'),
            'user_id'=>$this->session->userdata('user_id'),
            );
            $this->db->insert('hjms_city', $data);
            
        }
        
     function updateCity()
        {
            //$file_name = $this->upload->data();
            
            $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'date_modified' => date('Y-m-d H:i:s'),
            'active'=>$this->input->post('active'),
            'user_id'=>$this->session->userdata('user_id'),
            );
            $this->db->update('hjms_city', $data, array('id'=>$this->input->post('id')));
            
        }
    
    function deleteCity($id)
    {
       $this->db->delete('hjms_city',array('id'=>$id));
            
    }
    
    function inactivate($id)
    {
       $query = $this->db->update('hjms_city',array('active'=>0),array('id'=>$id));
        
            
    }
    
    function activate($id)
    {
        $query = $this->db->update('hjms_city',array('active'=>1),array('id'=>$id));
        
    }
    
}
?>