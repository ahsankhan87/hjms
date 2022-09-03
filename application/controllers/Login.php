<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('M_login');
    $this->load->library('form_validation');
  }
 
  function index(){
    $this->load->view('v_login1');
  }
 
  function auth(){
    $username    = $this->input->post('username',TRUE);
    $password = md5($this->input->post('password',TRUE));
    $validate = $this->M_login->validate($username,$password);
    if($validate->num_rows() > 0){
        
        $isActive = $this->M_login->is_active($username,$password);
        if($isActive){
            
            //get active financial year
            $fyear = $this->M_fyear->get_ActiveFyear();
            
            $data  = $validate->row_array();
            $name  = $data['name'];
            $user_id = $data['id'];
            $username = $data['username'];
            $level = $data['user_level'];
            $company = $data['company'];
            $sesdata = array(
                'name'  => $name,
                'user_id' => $user_id,
                'username'  => $username,
                'level'     => $level,
                'logged_in' => TRUE,
                'FY_YEAR' => $fyear[0]['fy_year'],
                'FY_START_DATE' => $fyear[0]['fy_start_date'],
                'FY_END_DATE' => $fyear[0]['fy_end_date'],
                'company'     => $company,

            );
            $this->session->set_userdata($sesdata);
            // access login for admin
            if($level === '1'){
                redirect('Dashboard');
     
            // access login for staff
            }elseif($level === '2'){
                redirect('Dashboard');
     
            // access login for author
            }else{
                redirect('Dashboard');
            }
      }else{
        echo $this->session->set_flashdata('error','User / Member is not active, please contact your administrator');
        redirect('Login','refresh');
      }  
    }else{
        echo $this->session->set_flashdata('error','Username or Password is Wrong');
        redirect('Login','refresh');
    }
  }
 
  function logout(){
      $this->session->sess_destroy();
      
      $this->session->set_flashdata('error','You have been logged out.!');
      redirect('Login','refresh');
  }
  
  function register()
  {
    if($this->input->server('REQUEST_METHOD') === 'POST')
    {
        //var_dump($_POST);
        
      $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[12]|callback_username_check');
      $this->form_validation->set_rules('company', 'Company', 'required|trim');
      $this->form_validation->set_rules('name', 'Name', 'required|trim');
      $this->form_validation->set_rules('user_level', 'User Role', 'trim');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]',array('required' => 'You must provide a %s.'));
      $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
      $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
           
      if($this->form_validation->run())
      {
       //$verification_key = md5(rand());
       //$encrypted_password = $this->encrypt->encode($this->input->post('user_password'));
       $encrypted_password = md5($this->input->post('password'));
       $data = array(
        'name'  => $this->input->post('name'),
        'company'  => $this->input->post('company'),
        'username'  => $this->input->post('username'),
        'email'  => $this->input->post('user_email'),
        'password' => $encrypted_password,
        'contact'  => $this->input->post('contact'),
        'user_level'  => $this->input->post('user_level'),
        'address'  => $this->input->post('address'),
        
       );
       $id = $this->M_login->register($data);
       $this->session->set_flashdata('msg','User Credentails Created');
       redirect('Login','refresh');
       //if($id > 0)
//       {
//        $subject = "Please verify email for login";
//        $message = "
//        <p>Hi ".$this->input->post('user_name')."</p>
//        <p>This is email verification mail from Codeigniter Login Register system. For complete registration process and login into system. First you want to verify you email by click this <a href='".base_url()."register/verify_email/".$verification_key."'>link</a>.</p>
//        <p>Once you click this link your email will be verified and you can login into system.</p>
//        <p>Thanks,</p>
//        ";
//        $config = array(
//         'protocol'  => 'smtp',
//         'smtp_host' => 'smtpout.secureserver.net',
//         'smtp_port' => 80,
//         'smtp_user'  => 'xxxxxxx', 
//                      'smtp_pass'  => 'xxxxxxx', 
//         'mailtype'  => 'html',
//         'charset'    => 'iso-8859-1',
//                       'wordwrap'   => TRUE
//        );
//        $this->load->library('email', $config);
//        $this->email->set_newline("\r\n");
//        $this->email->from('info@webslesson.info');
//        $this->email->to($this->input->post('user_email'));
//        $this->email->subject($subject);
//        $this->email->message($message);
//        if($this->email->send())
//        {
//         $this->session->set_flashdata('message', 'Check in your email for email verification mail');
//         redirect('register');
//        }
//       }
      }
      }
      
      $this->load->view('v_register1');
      
  }
  
  //FOR INTERNAL USER CHECK
    function username_check($username)
    {
        if($this->M_users->username_exist($username))
        {
            $this->form_validation->set_message('username_check', 'The {field} already exists.');
                        
            return false;
        }else
        {
            return true;
        }
    }
    
 
}