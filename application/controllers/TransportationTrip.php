<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TransportationTrip extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    function index()
    {
        //Allowing akses to admin only
        if ($this->session->userdata('level') !== '1') {
            $data['title'] = "403 Access Denied";
            $this->load->view('403', $data);
        } else {

            $data['title'] = 'List of transportation trips';
            $data['main'] = 'List of transportation trips';
            $data['main_small'] = '';

            $data['transportation_trips'] = $this->M_transportation_trip->get_transportation_trip();

            $this->load->view('templates/header', $data);
            $this->load->view('transportation_trip/v_trip', $data);
            $this->load->view('templates/footer');
        }
    }

    function create()
    {
        //Allowing akses to admin only
        if ($this->session->userdata('level') !== '1') {
            $data['title'] = "403 Access Denied";
            $this->load->view('403', $data);
        } else {

            if ($this->input->server('REQUEST_METHOD') === 'POST') {
                //form Validation
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');

                //after form Validation run
                if ($this->form_validation->run()) {

                    $this->M_transportation_trip->addTransportationType();
                    $this->session->set_flashdata('message', 'transportation_trip Added');
                    redirect('TransportationTrip/index', 'refresh');
                }
            }

            $data['title'] = 'Add New transportation trip';
            $data['main'] = 'Add New transportation trip';
            $data['main_small'] = '';

            $this->load->view('templates/header', $data);
            $this->load->view('transportation_trip/create', $data);
            $this->load->view('templates/footer');
        }
    }

    function edit($id = NULL)
    {
        //Allowing akses to admin only
        if ($this->session->userdata('level') !== '1') {
            $data['title'] = "403 Access Denied";
            $this->load->view('403', $data);
        } else {

            $data = array('langs' => $this->session->userdata('lang'));

            if ($this->input->server('REQUEST_METHOD') === 'POST') {
                //form Validation
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');

                //after form Validation run
                if ($this->form_validation->run()) {

                    $this->M_transportation_trip->updateTransportationType($data, array('id' => $this->input->post('id')));
                    $this->session->set_flashdata('message', 'transportation trip Updated');
                    redirect('TransportationTrip/index', 'refresh');
                }
            }
            $data['title'] = 'Update Transportation Trip';
            $data['main'] = 'Update Transportation Trip';
            $data['main_small'] = '';

            $data['update_transportation_trip'] = $this->M_transportation_trip->get_transportation_trip($id);

            $this->load->view('templates/header', $data);
            $this->load->view('transportation_trip/edit', $data);
            $this->load->view('templates/footer');
        }
    }

    function delete($id)
    {
        //Allowing akses to admin only
        if ($this->session->userdata('level') !== '1') {
            $data['title'] = "403 Access Denied";
            $this->load->view('403', $data);
        } else {

            $this->M_transportation_trip->deleteTransportationType($id);
            $this->session->set_flashdata('message', 'Transportation Trip Deleted');
            redirect('TransportationTrip/index', 'refresh');
        }
    }
}
