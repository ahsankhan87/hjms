<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in') !== TRUE){
          redirect('Login');
        }
    }
    
    public function index()
	{
	    $from_date = date('2019-12-01');
        $to_date = date('Y-m-d');
        $city_id = 0;
        
	    $data['title'] = 'Dashboard';
        $data['main'] = 'Dashboard';
        $data['main_small'] = '';
        
        // $this->M_reports->total_arrival_reports($from_date,$this->session->userdata('user_id'),$city_id,$city_id);
        // $this->M_reports->total_arrival_reports($from_date,$this->session->userdata('user_id'),$city_id,$city_id);
        
	    $this->load->view('templates/header',$data);
        $this->load->view('v_dashboard');
        $this->load->view('templates/footer');
        
	}
    
    public function total_arrival_report($report_date)
     {
        $data['total_pnrs_arrival'] = $this->M_reports->total_arrival_reports($report_date,$this->session->userdata('user_id'),'Jed%','Mad%');
        $data['total_pnrs_by_city'] = $this->M_reports->total_pnr_by_city($report_date,$this->session->userdata('user_id'),1);
        $data['checkin_checkout_pnrs'] = $this->M_reports->checkin_checkout($report_date,$this->session->userdata('user_id'),1,2);
        //print_r($data['total_pnrs_arrival']);
        echo json_encode($data);
	    
     }        
    
}
