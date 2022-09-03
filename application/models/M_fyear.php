<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_fyear extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        
    }
    
    //get all products and also only one product and active and inactive too.
    public function get_Fyear($id = FALSE)
    {
        if($id === FALSE)
        {
           
            //$this->db->order_by('sort','asc');
           // $option = array('company_id'=> $company_id);
            $query = $this->db->get_where('acc_fiscal_years');
            $data = $query->result_array();
            return $data;
        }
        
        //$this->db->order_by('sort','asc');
        $options = array('id'=> $id);
        
        $query = $this->db->get_where('acc_fiscal_years',$options);
        $data = $query->result_array();
        return $data;
    }
    
    function get_ActiveFyear()
    {
        $this->db->order_by('id','desc');
        $options = array('status'=>'active');
        
        $query = $this->db->get_where('acc_fiscal_years',$options,1);
        $data = $query->result_array();
        return $data;
    }
    
    function addFyear()
    {
        $data = array(
        //'company_id'=> $_SESSION['company_id'],
        'fy_start_date' => $this->input->post('fy_start_date',true),
        'fy_end_date' => $this->input->post('fy_end_date',true),
        'fy_year' => $this->input->post('fy_year',true),
        'status' => $this->input->post('status',true),
        );
        
        $this->db->insert('acc_fiscal_years', $data);
        
                   
    }
    
    function editFyear()
    {
        $data = array(
        //'company_id'=> $_SESSION['company_id'],
        'fy_start_date' => $this->input->post('fy_start_date',true),
        'fy_end_date' => $this->input->post('fy_end_date',true),
        'fy_year' => $this->input->post('fy_year',true),
        //'status' => $this->input->post('status',true),
        );
        
                  
                    
       $this->db->update('acc_fiscal_years', $data, array('id'=>$this->input->post('id')));
            
    }
    
    function activateFyear($id)
    {
        $this->db->update('acc_fiscal_years', array('status'=>'inactive'));
        
        $data = array(
        'status' => 'active',
        );
        
                   
       $this->db->update('acc_fiscal_years', $data, array('id'=>$id));
            
    }
    
    function getFyearDDL()
    {
        $data = array();
        $data[''] = '--Please Select--';
        
        //$this->db->group_by('account_code','asc');
        //$option = array('company_id'=> $_SESSION['company_id']);
        $query = $this->db->get_where('acc_fiscal_years');
            
        if ($query->num_rows() > 0)
        {
            foreach ($query->result_array() as $row)
            {
                 $data[$row['id']] = $row['fy_year'];
            }
        }
        $query->free_result();
        return $data;
    }
    
    function deleteFyear($id)
    {
        $this->db->delete('acc_fiscal_years',array('id'=>$id));
        
                  
    }
}