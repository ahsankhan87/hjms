<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shirka extends MY_Controller
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

            $data['title'] = 'List of Shirkas';
            $data['main'] = 'List of Shirkas';
            $data['main_small'] = '';

            $data['shirkas'] = $this->M_shirkas->get_shirkas();

            $this->load->view('templates/header', $data);
            $this->load->view('shirka/v_shirkas', $data);
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
                    $this->load->helper(array('form', 'url'));

                    $config['upload_path']          = './asset/images/';
                    $config['allowed_types']        = 'gif|jpg|png|jpeg';
                    $config['max_size']             = 100;
                    $config['max_width']            = 1024;
                    $config['max_height']           = 768;
                    $config['file_name']           = Time();

                    //$this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('userfile')) {
                        $data = array('error' => $this->upload->display_errors());

                        //$this->load->view('shirka/create', $error);
                    } else {
                        //$data = array('upload_data' => $this->upload->data());

                        //$this->load->view('upload_success', $data);

                        $data = array(
                            'name' => $this->input->post('name'),
                            'picture' => $this->upload->data('file_name'),
                            'description' => $this->input->post('description'),
                            'active' => $this->input->post('active'),
                            'is_default' => $this->input->post('is_default'),
                            'user_id' => $this->session->userdata('user_id'),
                        );

                        $this->M_shirkas->addshirkas($data);
                        $this->session->set_flashdata('message', 'Shirka Added');
                        redirect('Shirka/index', 'refresh');
                    } //file upload end
                }
            }

            $data['title'] = 'Add New shirka';
            $data['main'] = 'Add New shirka';
            $data['main_small'] = '';

            $this->load->view('templates/header', $data);
            $this->load->view('shirka/create', $data);
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

            if ($this->input->server('REQUEST_METHOD') === 'POST') {
                //form Validation
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');

                //after form Validation run
                if ($this->form_validation->run()) {
                    $this->load->helper(array('form', 'url'));

                    $config['upload_path']          = './asset/images/';
                    $config['allowed_types']        = 'gif|jpg|png|jpeg';
                    $config['max_size']             = 100;
                    $config['max_width']            = 1024;
                    $config['max_height']           = 768;
                    $config['file_name']           = Time();

                    //$this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('userfile')) {
                        $data = array('error' => $this->upload->display_errors());

                        //$this->load->view('shirka/create', $error);
                    } else {
                        unlink($config['upload_path'] . $this->input->post('old_img_name'));

                        $data = array(
                            'name' => $this->input->post('name'),
                            'picture' => $this->upload->data('file_name'),
                            'description' => $this->input->post('description'),
                            'active' => $this->input->post('active'),
                            'is_default' => $this->input->post('is_default'),
                            'date_modified' => date('Y-m-d H:i:s'),
                            'user_id' => $this->session->userdata('user_id'),
                        );

                        $this->M_shirkas->updateshirkas($data, array('id' => $this->input->post('id')));
                        //$this->M_shirkas->update_shirka();
                        $this->session->set_flashdata('message', 'shirka Updated');
                        redirect('Shirka/index', 'refresh');
                    } //image end upload
                }
            }
            $data['title'] = 'Update shirka';
            $data['main'] = 'Update shirka';
            $data['main_small'] = '';

            $data['update_shirka'] = $this->M_shirkas->get_shirkas($id);

            $this->load->view('templates/header', $data);
            $this->load->view('shirka/edit', $data);
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
            $this->M_shirkas->deleteshirkas($id);
            $this->session->set_flashdata('message', 'shirka Deleted');
            redirect('Shirka/index', 'refresh');
        }
    }
}
