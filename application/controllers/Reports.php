<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Reports extends CI_Controller{
    
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
            $data['title'] = 'List of Report';
            $data['main'] = 'List of Report';
            $data['main_small'] = '';
            
            $data['arrival_reports'] = $this->M_report->arrival_reports();
            
            $this->load->view('templates/header',$data);
            //$this->load->view('reports/v_report',$data);
            $this->load->view('templates/footer');
           
    }
    
    function arrivalReport()
    {
        $data['title'] = 'Arrival Report';
        $data['main'] = 'Arrival Report';
        $data['main_small'] = '';
        
        $from_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_START_DATE')));
        $to_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_END_DATE')));
        
        $data['arrival_reports'] = $this->M_reports->arrival_reports($from_date,$to_date,$this->session->userdata('user_id'),'',true,false);
            
        $this->load->view('templates/header',$data);
        $this->load->view('reports/v_arrival_report',$data);
        $this->load->view('templates/footer');
        
    }
    
    function searchArrivalReport($from_date=null,$to_date=null,$city_keyword='',$isArrival=true,$isDeparture=false)
    {
        if($from_date == null)
        {
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $city_keyword = $this->input->post('city_keyword');
            $isArrival = $this->input->post('isArrival');
            $isDeparture = $this->input->post('isDeparture');
            
        }
        
        $data['title'] = 'Arrival Report '.strtoupper($city_keyword);
        $data['main'] = 'Arrival Report '.strtoupper($city_keyword);
        $data['main_small'] = date('d-m-Y',strtotime($from_date)). ' to '. date('d-m-Y',strtotime($to_date));
        
        $data['arrival_reports'] = $this->M_reports->arrival_reports($from_date,$to_date,$this->session->userdata('user_id'),$city_keyword,$isArrival,$isDeparture);
        
        $this->load->view('templates/header',$data);
        $this->load->view('reports/v_arrival_report',$data);
        $this->load->view('templates/footer');
        
    }
    
    function departureReport()
    {
        $data['title'] = 'Departure Report';
        $data['main'] = 'Departure Report';
        $data['main_small'] = '';
        
        $from_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_START_DATE')));
        $to_date = date("Y-m-d H:i:s",strtotime($this->session->userdata('FY_END_DATE')));
        
        $data['Departure_reports'] = $this->M_reports->arrival_reports($from_date,$to_date,$this->session->userdata('user_id'),'',false,true);
        
        $this->load->view('templates/header',$data);
        $this->load->view('reports/v_departure_report',$data);
        $this->load->view('templates/footer');
       
    }
   function searchDepartureReport($from_date=null,$to_date=null,$city_keyword='',$isArrival=false,$isDeparture=true)
    {
        if($from_date == null)
        {
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $city_keyword = $this->input->post('city_keyword');
            $isArrival = $this->input->post('isArrival');
            $isDeparture = $this->input->post('isDeparture');
            
        }
        
        $data['title'] = 'Departure Report '.strtoupper($city_keyword);
        $data['main'] = 'Departure Report '.strtoupper($city_keyword);
        $data['main_small'] = date('d-m-Y',strtotime($from_date)). ' to '. date('d-m-Y',strtotime($to_date));
        
        $data['Departure_reports'] = $this->M_reports->arrival_reports($from_date,$to_date,$this->session->userdata('user_id'),$city_keyword,$isArrival,$isDeparture);
            
        $this->load->view('templates/header',$data);
        $this->load->view('reports/v_departure_report',$data);
        $this->load->view('templates/footer');
        
    }
    
}