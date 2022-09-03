<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class City extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in') !== TRUE){
          redirect('Login');
        }
        $this->load->library('form_validation');
    }
    
    function index()
    {
         //Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
        
            $data['title'] = 'List of City';
            $data['main'] = 'List of City';
            $data['main_small'] = '';
            
            $data['city'] = $this->M_city->get_city();
            
            $this->load->view('templates/header',$data);
            $this->load->view('city/v_city',$data);
            $this->load->view('templates/footer');
          }  
    }
    
    function create()
    {
        //Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
      
       if($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form Validation
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            
            //after form Validation run
            if($this->form_validation->run())
            {
                  
            $this->M_city->addCity();
            $this->session->set_flashdata('message','City Added');
            redirect('City/index','refresh');
            }
        }
        
        $data['title'] = 'Add New City';
        $data['main'] = 'Add New City';
        $data['main_small'] = '';
        
        $this->load->view('templates/header',$data);
        $this->load->view('city/create',$data);
        $this->load->view('templates/footer');
       } 
    }
    
    function edit($id = NULL)
    {
         //Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
      
            if($this->input->server('REQUEST_METHOD') === 'POST')
            {
                //form Validation
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
                
                //after form Validation run
                if($this->form_validation->run())
                {
                      
                $this->M_city->updateCity(array('id'=>$this->input->post('id')));
                $this->session->set_flashdata('message','City Updated');
                redirect('City/index','refresh');
                }
            }
            $data['title'] = 'Update City';
            $data['main'] = 'Update City';
            $data['main_small'] = '';
            
            $data['update_city'] = $this->M_city->get_city($id);      
            
            $this->load->view('templates/header',$data);
            $this->load->view('city/edit',$data);
            $this->load->view('templates/footer');
      }
    }
    
    function delete($id)
    {
         //Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
      
            $this->M_city->deleteCity($id);
            $this->session->set_flashdata('message','City Deleted');
            redirect('City/index','refresh');
      }
    }
}