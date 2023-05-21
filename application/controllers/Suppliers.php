<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Suppliers extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        //$this->lang->load('index');
        $this->load->library('form_validation');
    }

    function index()
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '10240M');


        $data['title'] = 'List of Suppliers';
        $data['main'] = 'List of Suppliers';

        //$data['cities'] = $this->M_city->get_city();
        $data['suppliers'] = $this->M_suppliers->get_activeSuppliers();

        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/v_suppliers', $data);
        $this->load->view('templates/footer');
    }

    function supplierPayment($supplier_id)
    {
        $data['title'] = 'supplier' . ' ' . 'payment';
        $data['main'] = 'supplier' . ' ' . 'payment';

        $data['activeBanks'] = $this->M_banking->getbankDropDown();
        //$data['creditSales'] = $this->M_sales->get_creditSales($supplier_id);
        $data['supplier'] = $this->M_suppliers->get_suppliers($supplier_id);
        //$data['supplier_entries']= $this->M_suppliers->get_supplier_Entries($supplier_id,FY_START_DATE,FY_END_DATE);

        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/v_supplierPayment', $data);
        $this->load->view('templates/footer');
    }

    function get_suppliers_JSON($acc_code)
    {
        print_r(json_encode($this->M_suppliers->get_activeSuppliersByAccCode($acc_code)));
    }

    function get_activeSuppliers()
    {
        print_r(json_encode($this->M_suppliers->get_activeSuppliers()));
    }

    function create()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {


            //form Validation
            $this->form_validation->set_rules('name', 'Full Name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');

            //after form Validation run
            if ($this->form_validation->run()) {
                $this->db->trans_start();

                $data = array(
                    'name' => $this->input->post('name', true),
                    'email' => $this->input->post('email', true),
                    'address' => $this->input->post('address', true),
                    'contact_no' => $this->input->post('contact_no', true),
                    'status' => 'active',

                );

                if ($this->db->insert('hjms_supplier', $data)) {
                    $this->session->set_flashdata('message', 'Supplier Created');
                } else {
                    $this->session->set_flashdata('error', 'Supplier not updated');
                }
                //$this->M_suppliers->addSupplier();

                $this->db->trans_complete();

                redirect('Suppliers', 'refresh');
            }
        }
        //else
        //{
        $data['title'] = 'add_new' . ' ' . 'supplier';
        $data['main'] = 'add_new' . ' ' . 'supplier';

        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/create', $data);
        $this->load->view('templates/footer');
        //}

    }
    //edit category
    public function edit($id = NULL)
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //form Validation
            $this->form_validation->set_rules('name', 'Full Name', 'required');
            //$this->form_validation->set_rules('address', 'Address', 'required');
            //$this->form_validation->set_rules('contact_no', 'Contact No', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');

            //after form Validation run
            if ($this->form_validation->run()) {
                $this->db->trans_start();

                $file_name = $this->upload->data();
                $data = array(
                    'name' => $this->input->post('name', true),
                    'email' => $this->input->post('email', true),
                    'address' => $this->input->post('address', true),
                    'contact_no' => $this->input->post('contact_no', true),
                );
                if ($this->db->update('hjms_supplier', $data, array('id' => $this->input->post('id', true)))) {

                    $this->session->set_flashdata('message', 'Supplier Updated');
                } else {
                    $this->session->set_flashdata('error', 'Supplier not updated');
                }

                $this->db->trans_complete();

                redirect('Suppliers', 'refresh');
                //////////////////////////////////

            }
        } else {
            $data['title'] = 'Update' . ' ' . 'Supplier';
            $data['main'] = 'Update' . ' ' . 'Supplier';

            $data['supplier'] = $this->M_suppliers->get_suppliers($id);

            $this->load->view('templates/header', $data);
            $this->load->view('suppliers/edit', $data);
            $this->load->view('templates/footer');
        }
    }

    function supplierDetail($supplier_id)
    {
        $data['title'] = 'Supplier Detail';
        $data['main'] = 'Supplier Detail';
        $data['from_date'] = ($this->input->post('from_date') ? $this->input->post('from_date') : '');
        $data['to_date'] = ($this->input->post('to_date') ? $this->input->post('to_date') : '');
        $data['main_small'] = '<br />' . date('d-m-Y', strtotime($data['from_date'])) . ' To ' . date('d-m-Y', strtotime($data['to_date']));

        $data['supplier'] = $this->M_suppliers->get_suppliers($supplier_id);
        // $data['supplier_entries']= $this->M_suppliers->get_supplier_Entries($supplier_id,$data['from_date'],$data['to_date']);

        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/v_supplierDetail', $data);
        $this->load->view('templates/footer');
    }

    function delete($id)
    {
        //Allowing akses to admin only
        if ($this->session->userdata('level') !== '1') {
            $data['title'] = "403 Access Denied";
            $this->load->view('403', $data);
        } else {
            $this->M_suppliers->delete($id);

            $this->session->set_flashdata('message', 'Supplier Deleted');
            redirect('Suppliers', 'refresh');
        }
    }

    function inactivate($id, $op_balance_dr, $op_balance_cr) // it will inactive the page
    {
        if ($this->session->userdata('role') != 'admin') {
            redirect('No_access', 'refresh');
        }

        $this->db->trans_start();
        $this->M_suppliers->inactivate($id, $op_balance_dr, $op_balance_cr);
        $this->db->trans_complete();

        $this->session->set_flashdata('message', 'Supplier Deleted');
        redirect('suppliers/index', 'refresh');
    }

    function activate($id) // it will active 
    {
        if ($this->session->userdata('role') != 'admin') {
            redirect('No_access', 'refresh');
        }

        $this->M_suppliers->activate($id);
        $this->session->set_flashdata('message', 'Supplier Activated');
        redirect('suppliers/index', 'refresh');
    }

    public function SupplierImport()
    {
        $data = array('langs' => $this->session->userdata('lang'));

        $data['title'] = 'Suppliers Imports';
        $data['main'] = 'Suppliers Imports';

        $this->load->view('templates/header', $data);
        $this->load->view('suppliers/v_import', $data);
        $this->load->view('templates/footer');
    }

    public function do_import1()
    {
        $config = array();
        $config['upload_path'] = './images';
        $config['allowed_types'] = 'xlsx|xls|csv';

        $this->upload->initialize($config);

        //var_dump($_FILES);

        if (!$this->upload->do_upload('upload_items_import')) {

            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('suppliers/SupplierImport', 'refresh');
        } else {
            $upload_data = $this->upload->data();
            @chmod($upload_data['full_path'], 0777);

            $this->load->library('Excel');
            $this->load->library('IOFactory');
            $objPHPExcel = IOFactory::load($upload_data['full_path']);

            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            //var_dump($sheetData);

            $worksheet = $objPHPExcel->getSheet(0);
            $lastRow = $worksheet->getHighestRow();

            for ($row = 2; $row <= $lastRow; $row++) {

                $data = array(
                    'company_id' => $_SESSION['company_id'],
                    'posting_type_id' => $worksheet->getCell('A' . $row)->getValue(),
                    'op_balance_dr' => $worksheet->getCell('B' . $row)->getValue(),
                    'op_balance_cr' => $worksheet->getCell('C' . $row)->getValue(),
                    "acc_code" => $worksheet->getCell('D' . $row)->getValue(),
                    'name' => $worksheet->getCell('E' . $row)->getValue(),
                    'email' => $worksheet->getCell('F' . $row)->getValue(),
                    'address' => $worksheet->getCell('G' . $row)->getValue(),
                    'contact_no' => $worksheet->getCell('H' . $row)->getValue(),
                    'status' => 'active',
                );

                if ($this->db->insert('hjms_supplier', $data)) {

                    $supplier_id = $this->db->insert_id();
                    $exchange_rate = ($this->input->post('exchange_rate', true) == 0 ? 1 : $this->input->post('exchange_rate', true));

                    $op_balance_dr = $this->input->post('op_balance_dr', true) / $exchange_rate;
                    $op_balance_cr = $this->input->post('op_balance_cr', true) / $exchange_rate;

                    $posting_type_code = $this->M_suppliers->getSupplierPostingTypes($supplier_id);

                    if (count($posting_type_code) > 0) { //OPENING BALANCE IN supplier ACCOUNT
                        $payable_acc_code = $posting_type_code[0]['payable_acc_code']; //supplier ledger id
                        $payable_account = $this->M_groups->get_groups($payable_acc_code, $_SESSION['company_id']);
                        $payable_dr_balance = abs($payable_account[0]['op_balance_dr']);
                        $payable_cr_balance = abs($payable_account[0]['op_balance_cr']);

                        $dr_balance = ($payable_dr_balance + $op_balance_dr);
                        $cr_balance = ($payable_cr_balance + $op_balance_cr);

                        $this->M_groups->editGroupOPBalance($payable_acc_code, $dr_balance, $cr_balance);
                    }
                    //for logging
                    $msg = $this->input->post('name');
                    $this->M_logs->add_log($msg, "Supplier", "Added", "POS");
                    // end logging

                    $uploads = true;
                }
            }
            if ($uploads) {

                $this->session->set_flashdata('message', 'Supplier uploaded successfully');
            } else {
                $this->session->set_flashdata('error', 'Supplier not uploaded');
            }

            @unlink($upload_data['full_path']); //DELETE FILE
            redirect('suppliers/index', 'refresh');
        }
    }

    public function do_import()
    {

        if ($_FILES['upload_items_import']['name'] != '') {
            $errors = array();
            $file_name = $_FILES['upload_items_import']['name'];
            $file_size = $_FILES['upload_items_import']['size'];
            $file_tmp = $_FILES['upload_items_import']['tmp_name'];
            $file_type = $_FILES['upload_items_import']['type'];
            //$file_ext=strtolower(end(explode('.',$_FILES['upload_items_import']['name'])));
            $file_ext = pathinfo($_FILES['upload_items_import']['name']);
            $expensions = array("xlsx", "xls", "csv");

            if (in_array($file_ext['extension'], $expensions) === false) {
                $this->session->set_flashdata('error', 'extension not allowed, please choose a xlsx|xls|csv file.');
                redirect('pos/C_customers/CustomerImport', 'refresh');
            }

            if (empty($errors) == true) {

                $target_dir = 'images/company/';
                $target_file = $target_dir . basename($_FILES["upload_items_import"]["name"]);
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                move_uploaded_file($_FILES["upload_items_import"]["tmp_name"], $target_file);

                //echo "Success";
                $this->load->library('Excel');
                $this->load->library('IOFactory');

                $inputFileType = PHPExcel_IOFactory::identify($target_file);

                $objPHPExcel = IOFactory::load($target_file);

                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

                $worksheet = $objPHPExcel->getSheet(0);
                $lastRow = $worksheet->getHighestRow();
                //var_dump($worksheet);

                $uploads = false;
                $data_excel = array();
                for ($row = 2; $row <= $lastRow; $row++) {

                    $data = array(
                        $data_excel[$row - 1]['company_id'] = $_SESSION['company_id'],
                        $data_excel[$row - 1]['posting_type_id'] = $worksheet->getCell('A' . $row)->getValue(),
                        //'op_balance_dr' => $worksheet->getCell('B'.$row)->getValue(),
                        //                            'op_balance_cr' => $worksheet->getCell('C'.$row)->getValue(),
                        $data_excel[$row - 1]["acc_code"] = $worksheet->getCell('B' . $row)->getValue(),
                        $data_excel[$row - 1]['name'] = $worksheet->getCell('C' . $row)->getValue(),
                        $data_excel[$row - 1]['email'] = $worksheet->getCell('D' . $row)->getValue(),
                        $data_excel[$row - 1]['address'] = $worksheet->getCell('E' . $row)->getValue(),
                        $data_excel[$row - 1]['contact_no'] = $worksheet->getCell('F' . $row)->getValue(),
                        $data_excel[$row - 1]['status'] = 'active',
                    );

                    $uploads = true;
                }
                if ($uploads) {
                    $this->db->insert_batch('hjms_supplier', $data_excel);
                    //for logging
                    $msg = '';
                    $this->M_logs->add_log($msg, "Supplier", "Imported", "POS");
                    // end logging

                    $this->session->set_flashdata('message', 'Supplier uploaded successfully');
                } else {
                    $this->session->set_flashdata('error', 'Supplier not uploaded');
                }

                @unlink($target_file);
                redirect('suppliers/index', 'refresh');
            } else {
                //sprint_r($errors);
                //return $errors;
                $this->session->set_flashdata('error', $errors);
                redirect('suppliers/SupplierImport', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Please select excel file to upload');
            redirect('suppliers/SupplierImport', 'refresh');
        }
        //upload an image options
        ////////////////////////
    }
}
