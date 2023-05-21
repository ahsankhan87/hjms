<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Hotel extends MY_Controller{
    
    function __construct()
    {
        parent::__construct();
       
        $this->load->library('form_validation');
    }
    
    function index()
    {
      //Allowing akses to admin only
      if($this->session->userdata('level') !== '1'){
          $data['title'] = "403 Access Denied";
          $this->load->view('403',$data);
      }else{
      
            $data['title'] = 'List of Hotels';
            $data['main'] = 'List of Hotels';
            $data['main_small'] = '';
            
            $data['hotels'] = $this->M_hotels->get_hotels();
            
            $this->load->view('templates/header',$data);
            $this->load->view('hotel/v_hotels',$data);
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
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
            
            //after form Validation run
            if($this->form_validation->run())
            {
                  $data = array(  
                  'name'=>$this->input->post('name'),
                  'description'=>$this->input->post('description'),
                  'active'=>$this->input->post('active'),
                  'user_id'=>$this->session->userdata('user_id'),  
                  );
                  
            $this->M_hotels->addHotels($data);
            $this->session->set_flashdata('message','Hotel Added');
            redirect('Hotel/index','refresh');
        }
        }
        
        $data['title'] = 'Add New Hotel';
        $data['main'] = 'Add New Hotel';
        $data['main_small'] = '';
        
        $this->load->view('templates/header',$data);
        $this->load->view('hotel/create',$data);
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
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
            
            //after form Validation run
            if($this->form_validation->run())
            {
                  $data = array(  
                        'name'=>$this->input->post('name'),
                        'description'=>$this->input->post('description'),
                        'active'=>$this->input->post('active'),
                        'date_modified'=>date('Y-m-d H:i:s'),
                        'user_id'=>$this->session->userdata('user_id'),
                     );
                  
            $this->M_hotels->updateHotels($data,array('id'=>$this->input->post('id')));
            //$this->M_hotels->update_hotel();
            $this->session->set_flashdata('message','Hotel Updated');
            redirect('Hotel/index','refresh');
            }
        }
        $data['title'] = 'Update Hotel';
        $data['main'] = 'Update Hotel';
        $data['main_small'] = '';
        
        $data['update_hotel'] = $this->M_hotels->get_hotels($id);      
        
        $this->load->view('templates/header',$data);
        $this->load->view('hotel/edit',$data);
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
            $this->M_hotels->deleteHotels($id);
            $this->session->set_flashdata('message','Hotel Deleted');
            redirect('Hotel/index','refresh');
      }
    }
}