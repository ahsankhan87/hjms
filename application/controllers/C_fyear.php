<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_fyear extends MY_Controller{
    
    public function __construct()
    {
        parent::__construct();
        //$this->lang->load('index');
    }
    
    public function index()
    {
        //$data = array('langs' => $this->session->userdata('lang'));
        
        $data['title'] = 'Fiscal Year';
        $data['main'] = 'Fiscal Year';
        
        //$data['cities'] = $this->M_city->get_city();
        $data['Fyear']= $this->M_fyear->get_Fyear(false);
        
                   
        $this->load->view('templates/header',$data);
        $this->load->view('fy/v_fyear',$data);
        $this->load->view('templates/footer');
        
    }
    function create()
    {
        //$data = array('langs' => $this->session->userdata('lang'));
        
        if($this->input->post('fy_start_date'))
        {
            $this->M_fyear->addFyear();
            $this->session->set_flashdata('message','Fyear Created');
            redirect('C_fyear','refresh');
        }
        else
        {
            $data['title'] = 'Create Fiscal Year';
            $data['main'] = 'Create Fiscal Year';
            
               
            $this->load->view('templates/header',$data);
            $this->load->view('fy/create',$data);
            $this->load->view('templates/footer');
        }
    }
    
    public function edit($id=NULL)
    {
        //$data = array('langs' => $this->session->userdata('lang'));
        
        if($this->input->post('fy_start_date'))
        {
            $this->M_fyear->editFyear();
            $this->session->set_flashdata('message','Fyear  Updated');
            redirect('C_fyear/index','refresh');
        }
        else
        {
            $data['title'] = 'Update Fiscal Year';
            $data['main'] = 'Update Fiscal Year';
            
            $data['Fyear']= $this->M_fyear->get_Fyear($id);
            
            $this->load->view('templates/header',$data);
            $this->load->view('fy/edit',$data);
            $this->load->view('templates/footer');
        }
    }
    
    function delete($id)
    {
        $this->M_fyear->deleteFyear($id);
        $this->session->set_flashdata('message','Fiscal Year  Deleted / inactive');
        redirect('C_fyear/index','refresh');
    }
    
    function activateFY($id)
    {
        $this->M_fyear->activateFyear($id);
        
        //get active financial year
        $fyear = $this->M_fyear->get_ActiveFyear();
        $sesdata = array(
                'FY_YEAR' => $fyear[0]['fy_year'],
                'FY_START_DATE' => $fyear[0]['fy_start_date'],
                'FY_END_DATE' => $fyear[0]['fy_end_date']
            );
        $this->session->set_userdata($sesdata);
        /////////////////
        
        $this->session->set_flashdata('message','Fiscal Year Activated');
        redirect('C_fyear/index','refresh');
    }
}