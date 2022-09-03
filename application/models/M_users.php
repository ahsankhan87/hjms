<?php
class M_users extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    function get_Users($id = FALSE)
    {
        if($id == FALSE)
        {
            $query = $this->db->get('hjms_users');
            return $query->result_array();
        }
        
       $query = $this->db->get_where('hjms_users',array('id'=>$id));
       return $query->result_array();
    }
    
    function get_activeUsers($id = FALSE)
    {
        if($id == FALSE)
        {
            $query = $this->db->get_where('hjms_users',array('active'=>1));
            return $query->result_array();
        }
        
       $query = $this->db->get_where('hjms_users',array('id'=>$id,'active'=>1));
       return $query->result_array();
    }
  
  function username_exist($username)
     {
        $this->db->where('username',$username);
        $query = $this->db->get('hjms_users'); 
        
        if($query->num_rows() > 0)
        {
            return true;
        }else
        {
            return false;
        }
     }
     
     public function hasUsername($username)
    {
        $options = array('username'=> $username,'company_id'=> $_SESSION['company_id']);
        
        $query = $this->db->get_where('hjms_users',$options);
        
        if ($query->num_rows() > 0)
        {
            //echo "<span style='color:red;'>Taken</span>";
            return false;
        }
       
            return true;
        
    }
    function addUser()
    {
        $data = array(  'name'=>$this->input->post('name',true),
                        'password'=>md5($this->input->post('password',true)),
                        'status'=>1,
                        'role'=>$this->input->post('role',true),
                        'company_id'=> $_SESSION['company_id'],
                        'username'=>$this->input->post('username',true)
                      );
                  
        $this->db->insert('hjms_users',$data);   
        
    }
    
    function updateUser()
    {
        $data = array(  'name'  => $this->input->post('name'),
                        'company'  => $this->input->post('company'),
                        'email'  => $this->input->post('user_email'),
                        'contact'  => $this->input->post('contact'),
                        'user_level'  => $this->input->post('user_level'),
                        'address'  => $this->input->post('address'),
                        "image" =>	$this->upload->data('file_name'),
                      );
                  
        $this->db->update('hjms_users',$data,array('id'=>$this->input->post('id',true))); 
        
    }
    
    function updateUser_password()
    {
        $data = array(  'password'=>md5($this->input->post('password',true)),
                        
                      );
                  
        $this->db->update('hjms_users',$data,array('id'=>$this->input->post('id',true))); 
    }
    
    function deleteUser($id)
    {
        $query = $this->db->update('hjms_users',array('active'=>0),array('id'=>$id));
        
    }
    function activateUser($id)
    {
        $query = $this->db->update('hjms_users',array('active'=>1),array('id'=>$id));
        
    }
}