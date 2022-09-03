<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model{
 
  function validate($email,$password){
    $this->db->where('username',$email);
    $this->db->where('password',$password);
    $result = $this->db->get('hjms_users',1);
    return $result;
  }
  
  function is_active($email,$password){
    $this->db->where('username',$email);
    $this->db->where('password',$password);
    $this->db->where('active',1);
    $result = $this->db->get('hjms_users',1);
    if($result->num_rows() > 0)
    {
        return true;
    }
        return false;
  }
  
  function register($data)
  {
    $this->db->insert('hjms_users', $data);
    return $this->db->insert_id();
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
     
}