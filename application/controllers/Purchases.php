<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Purchases extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($purchaseType = '')
    {
        $data['title'] = 'Purchases';
        $data['main'] = 'Purchases';

        $data['purchaseType'] = $purchaseType;
        //$data['supplierDDL'] = $this->M_suppliers->getSupplierDropDown(); //search for legder account

        $this->load->view('templates/header', $data);
        $this->load->view('receivings/v_receivings', $data);
        // $this->load->view('city/create',$data);
        $this->load->view('templates/footer');
    }

    public function all()
    {
        $start_date = date("Y-m-d", strtotime("-6 month"));
        $to_date = date("Y-m-d");
        $fiscal_dates = "(From: " . date('d-m-Y', strtotime($start_date)) . " To:" . date('d-m-Y', strtotime($to_date)) . ")";

        $data['title'] = 'Purchases' . ' ' . $fiscal_dates;
        $data['main'] = 'Purchases';
        $data['main_small'] = $fiscal_dates;
        $data['purchaseType'] = "credit";

        $data['receivings'] = $this->M_receivings->get_receivings(false, $start_date, $to_date, 'credit');

        $this->load->view('templates/header', $data);
        $this->load->view('receivings/v_allPurchases', $data);
        $this->load->view('templates/footer');
    }

    public function edit($invoice_no)
    {
        $data['title'] = 'Edit' . ' ' . 'Purchases';
        $data['main'] = 'Edit' . ' ' . 'Purchases';

        $data['purchaseType'] = "cash"; //$saleType;//CASH, CREDIT, CASH RETURN AND CREDIT RETURN
        $data['invoice_no'] = $invoice_no;
        $data['edit'] = true;
        //$data['isEstimate'] = $isEstimate;

        //$data['itemDDL'] = $this->M_items->get_allItemsforJSON();
        //$data['customersDDL'] = $this->M_customers->getCustomerDropDown();

        $this->load->view('templates/header', $data);
        $this->load->view('receivings/v_editreceivings', $data);
        $this->load->view('templates/footer');
    }

    public function purchase_transaction($edit = null, $invoice_no = null)
    {
        //INITIALIZE
        $total_amount = 0;
        $discount = 0;

        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            if (count((array)$this->input->post('pnr')) > 0) {
                // var_dump($_POST);

                $this->db->trans_start();

                //IF EDIT THEN DELETE ALL INVOICES AND INSERT AGAIN
                if ($edit != null) {
                    $this->delete($invoice_no, false);
                    $new_invoice_no = $invoice_no;
                } else {
                    //GET PREVIOISE INVOICE NO  
                    @$prev_invoice_no = $this->M_receivings->getMAXPurchaseInvoiceNo();
                    //$number = (int) substr($prev_invoice_no,11)+1; // EXTRACT THE LAST NO AND INCREMENT BY 1
                    //$new_invoice_no = 'POS'.date("Ymd").$number;
                    $number = (int) $prev_invoice_no + 1; // EXTRACT THE LAST NO AND INCREMENT BY 1
                    $new_invoice_no = 'R' . $number;
                }

                //GET ALL ACCOUNT CODE WHICH IS TO BE POSTED AMOUNT
                $company_id = 0; // $_SESSION['company_id'];
                $sale_date = $this->input->post("sale_date");
                $user_id = $this->session->userdata('user_id');
                $emp_id = ''; //$this->input->post("emp_id");
                //$currency_id = ($this->input->post("currency_id") == '' ? 0 : $this->input->post("currency_id"));
                // $discount = ($this->input->post("total_discount") == '' ? 0 : $this->input->post("total_discount"));
                $narration = ''; //($this->input->post("description") == '' ? '' : $this->input->post("description"));
                $register_mode = 'receive'; //$this->input->post("register_mode");
                $purchaseType = $this->input->post("purchaseType");;
                $is_taxable =  1; //$this->input->post("is_taxable");
                $total_tax_amount =  ($is_taxable == 1 ? $this->input->post("total_tax") : 0);
                $due_date = $this->input->post("due_date");
                $business_address = $this->input->post("business_address");
                $payment_acc_code = $this->input->post("payment_acc_code");
                $sub_total = $this->input->post("sub_total");
                // $tax_acc_code = $this->input->post("tax_acc_code");
                // $tax_rate = $this->input->post("tax_rate");
                // $tax_id = $this->input->post('tax_id');
                
                //if tax amount is checked or 1 then tax will be dedected otherwise not deducted from total amount
                //total net amount 
                $net_total =  $this->input->post("net_total");

                //////
                $data = array(
                    'invoice_no' => $new_invoice_no,
                    'employee_id' => $emp_id,
                    'user_id' => $user_id,
                    'payment_acc_code' => $payment_acc_code,
                    'receiving_date' => $sale_date,
                    'register_mode' => $register_mode,
                    'account' => $purchaseType,
                    'description' => $narration,
                    'total_amount' => ($register_mode == 'receive' ? $sub_total : -$sub_total), //return will be in minus amount
                    // 'total_tax' => ($register_mode == 'receive' ? $total_tax_amount : -$total_tax_amount), //return will be in minus amount
                    'due_date' => $due_date,
                    'business_address' => $business_address,
                    // 'tax_rate' => $tax_rate,
                    //'supplier_id' => $supplier_id,
                    // 'tax_id' => $tax_id,
                );
                $this->db->insert('hjms_receivings', $data);
                $receiving_id = $this->db->insert_id();
                ////////

                foreach ($this->input->post('pnr') as $key => $value) {
                    if (strlen($value) > 0) {

                        $pnr_name  = htmlspecialchars(trim($value));
                        $qty = $this->input->post('qty')[$key];
                        $ticket_cost = $this->input->post('ticket_cost')[$key];
                        $hotel_cost = $this->input->post('hotel_cost')[$key];
                        $other_cost = $this->input->post('other_cost')[$key];
                        $visa_cost = $this->input->post('visa_cost')[$key];
                        $visa_no = $this->input->post('visa_no')[$key];
                        $description = $this->input->post('description')[$key];
                        $ticket_pnr = $this->input->post("ticket_pnr")[$key];
                        $ticket_no = $this->input->post("ticket_no")[$key];
                        $supplier_id = $this->input->post('supplier_id')[$key];
                        //$amount_paid = $this->input->post("amount_paid")[$key];
                        // $total_amount = (float)($qty * $visa_cost);


                        //INSERT PESSENGERS FIRST AND SAVE ID INTO THE RECEIVING TABLE
                        $data = array(
                            'first_name' => $pnr_name,
                            'group_code' => $this->input->post('group_code', true)[$key],
                            'group_name' => $this->input->post('group_name', true)[$key],
                            'country' => $this->input->post('country', true)[$key],
                            'pnr_code' => $this->input->post('pnr_code', true)[$key],
                            'active' => '1',
                            //FOR TRAVEL AGENT ONLY
                            'passport_no' => $this->input->post('passport_no', true)[$key],
                            'mofa_no' => $this->input->post('mofa_no', true)[$key],
                            'moi_no' => $this->input->post('moi_no', true)[$key],
                            "gender" => $this->input->post('gender', true)[$key],
                            'dob' => $this->input->post('dob', true)[$key],
                            'mehram' => $this->input->post('mehram', true)[$key],
                            'relation' => $this->input->post('relation', true)[$key],
                            //  'customer_id' => 0,//$this->input->post('customer_id', true),
                            'supplier_id' => $supplier_id,
                            'user_id' => $user_id,
                            ////
                        );

                        $this->db->insert('hjms_passengers', $data);
                        $pnr_id = $this->db->insert_id();
                        ///INSERT PESSENGERS

                        $data = array(
                            'receiving_id' => $receiving_id,
                            'invoice_no' => $new_invoice_no,
                            'account_code' => 0,
                            'item_id' => $pnr_id,
                            'description' => $narration,
                            'visa_cost' => ($register_mode == 'receive' ? $visa_cost : -$visa_cost), //actually its avg cost comming from sale from
                            'ticket_cost' => ($register_mode == 'receive' ? $ticket_cost : -$ticket_cost), //actually its avg cost comming from sale from
                            'hotel_cost' => ($register_mode == 'receive' ? $hotel_cost : -$hotel_cost), //actually its avg cost comming from sale from
                            'other_cost' => ($register_mode == 'receive' ? $other_cost : -$other_cost), //actually its avg cost comming from sale from
                            'description' => $description,
                            'visa_no' => $visa_no,
                            'ticket_pnr' => $ticket_pnr,
                            'ticket_no' => $ticket_no,
                            'supplier_id' => $supplier_id,
                            'date' => $sale_date,
                            //'paid' => $amount_paid,

                        );

                        $this->db->insert('hjms_receivings_items', $data);

                        ////// SUPPLIER PAYMENT DETAIL
                        $data = array(
                            'invoice_no' => $new_invoice_no,
                            'supplier_id' => $supplier_id,
                            'user_id' => $user_id,
                            'account_code' => '', //account_id,
                            'date' => $sale_date,
                            'debit' => 0,
                            'credit' => $visa_cost,
                            'narration' => 'Visa Cost ' . $narration,
                            'status' => 'visa_cost',

                        );
                        $this->db->insert('hjms_supplier_payments', $data);
                        //////////


                    }
                }

                $this->db->trans_complete();
                echo '1';
            }
        }
    }

    public function receipt($new_invoice_no)
    {
        $data['receivings_items'] = $this->M_receivings->get_receiving_items($new_invoice_no);
        $receivings_items = $data['receivings_items'];

        $data['title'] = ($receivings_items[0]['register_mode'] == 'receive' ? 'Purchase' : 'Return') . ' Invoice # ' . $new_invoice_no;
        $data['main'] = ''; //($receivings_items[0]['register_mode'] == 'receive' ? '' : 'Return ').'Purchase Invoice';
        $data['invoice_no'] = $new_invoice_no;


        $company_id = $_SESSION['company_id'];
        $data['Company'] = $this->M_companies->get_companies($company_id);

        $this->load->view('templates/header', $data);
        $this->load->view('receivings/v_receipt', $data);
        $this->load->view('templates/footer');
    }

    function get_purchases_JSON()
    {
        $start_date = date("Y-m-d");
        $to_date = date("Y-m-d");

        print_r(json_encode($this->M_receivings->get_selected_receivings($start_date, $to_date)));
    }

    function get_receiving_by_invoice($invoice_no)
    {
        print_r(json_encode($this->M_receivings->get_receiving_by_invoice($invoice_no)));
    }

    function get_receiving_items_only($invoice_no)
    {
        print_r(json_encode($this->M_receivings->get_receiving_items_only($invoice_no)));
    }

    public function getSupplierCurrencyJSON($supplier_id)
    {
        $suppliersCurrency = $this->M_suppliers->get_supplierCurrency($supplier_id);
        echo json_encode($suppliersCurrency);
    }

    public function delete($invoice_no, $redirect = true)
    {
        //if entry deleted then all item qty will be reversed
        $this->db->trans_start();

        $this->M_receivings->delete($invoice_no);
        $this->db->trans_complete();

        if ($redirect === true) {
            $this->session->set_flashdata('message', 'Entry Deleted');
            redirect('Purchases/all', 'refresh');
        }
    }


    public function import_passengers()
    {

        $config = array();
        $config['upload_path'] = './asset/images';
        $config['allowed_types'] = 'xlsx|xls|csv';

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('import_file')) {

            //$this->session->set_flashdata('error',$this->upload->display_errors().' error');
            $data = array('error' => $this->upload->display_errors());
            // $this->load->view('passengers/v_import', $data);
            echo $data['error'];
            //redirect('Passengers/passengerImport','refresh');
        } else {
            $upload_data = $this->upload->data();
            @chmod($upload_data['full_path'], 0777);

            $this->load->library('Excel');
            $this->load->library('IOFactory');
            $objPHPExcel = IOFactory::load($upload_data['full_path']);

            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            $worksheet = $objPHPExcel->getSheet(0);
            $lastRow = $worksheet->getHighestRow();

            $uploads = false;
            $data_excel = array();
            for ($row = 2; $row <= $lastRow; $row++) {

                //REPLACE DATE VALUE FROM EXCEL AND
                //CONVERT INTO MYSQL DATE FORMAT
                $date = str_replace("/", "-", $worksheet->getCell('G' . $row)->getValue());
                $dob = date("Y-m-d", strtotime($date));

                $data = array(

                    $data_excel[$row - 1]['user_id'] = $this->session->userdata('user_id'),
                    $data_excel[$row - 1]['group_code'] = trim($worksheet->getCell('A' . $row)->getValue()),
                    $data_excel[$row - 1]["group_name"] = trim($worksheet->getCell('B' . $row)->getValue()),
                    $data_excel[$row - 1]['pnr_code'] = trim($worksheet->getCell('C' . $row)->getValue()),
                    $data_excel[$row - 1]['first_name'] = trim($worksheet->getCell('D' . $row)->getValue()),
                    $data_excel[$row - 1]['mofa_no'] = trim($worksheet->getCell('E' . $row)->getValue()),
                    $data_excel[$row - 1]['gender'] = trim($worksheet->getCell('F' . $row)->getValue()),
                    $data_excel[$row - 1]['dob'] = $dob,
                    $data_excel[$row - 1]['country'] = trim($worksheet->getCell('H' . $row)->getValue()),
                    $data_excel[$row - 1]['passport_no'] = trim($worksheet->getCell('I' . $row)->getValue()),
                    $data_excel[$row - 1]['mehram'] = trim($worksheet->getCell('K' . $row)->getValue()),
                    $data_excel[$row - 1]['relation'] = trim($worksheet->getCell('M' . $row)->getValue()),
                    $data_excel[$row - 1]['moi_no'] = trim($worksheet->getCell('N' . $row)->getValue()),
                    $data_excel[$row - 1]['active'] = '1',
                );

                $uploads = true;
            }

            echo json_encode($data_excel);
        }
    }
}
