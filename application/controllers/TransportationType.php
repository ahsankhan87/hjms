<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TransportationType extends MY_Controller
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

      $data['title'] = 'List of Transportation Type';
      $data['main'] = 'List of Transportation Type';
      $data['main_small'] = '';

      $data['transportation_types'] = $this->M_transportation_type->get_transportation_type();

      $this->load->view('templates/header', $data);
      $this->load->view('transportation_type/v_type', $data);
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

          $this->M_transportation_type->addTransportationType();
          $this->session->set_flashdata('message', 'Transportation Type Added');
          redirect('TransportationType/index', 'refresh');
        }
      }

      $data['title'] = 'Add New Transportation Type';
      $data['main'] = 'Add New Transportation Type';
      $data['main_small'] = '';

      $this->load->view('templates/header', $data);
      $this->load->view('transportation_type/create', $data);
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

          $this->M_transportation_type->updateTransportationType($data, array('id' => $this->input->post('id')));
          $this->session->set_flashdata('message', 'Transportation Type Updated');
          redirect('TransportationType/index', 'refresh');
        }
      }
      $data['title'] = 'Update Transportation Type';
      $data['main'] = 'Update Transportation Type';
      $data['main_small'] = '';

      $data['update_transportation_type'] = $this->M_transportation_type->get_transportation_type($id);

      $this->load->view('templates/header', $data);
      $this->load->view('transportation_type/edit', $data);
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

      $this->M_transportation_type->deleteTransportationType($id);
      $this->session->set_flashdata('message', 'Transportation type Deleted');
      redirect('TransportationType/index', 'refresh');
    }
  }
}
