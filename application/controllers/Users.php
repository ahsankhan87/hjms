<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    
    $this->load->library('form_validation');
  }

  function index()
  {
    if ($this->session->userdata('level') !== '1') {
      $data['title'] = "403 Access Denied";
      $this->load->view('403', $data);
    } else {

      $data = array('langs' => $this->session->userdata('lang'));

      $data['title'] = 'List of Users';
      $data['main'] = 'List of Users';
      $data['main_small'] = '';

      $data['users'] = $this->M_users->get_Users();

      $this->load->view('templates/header', $data);
      $this->load->view('users/v_users', $data);
      $this->load->view('templates/footer');
    }
  }

  function create()
  {
    if ($this->session->userdata('level') !== '1') {
      $data['title'] = "403 Access Denied";
      $this->load->view('403', $data);
    } else {

      $data = array('langs' => $this->session->userdata('lang'));

      if ($this->input->server('REQUEST_METHOD') === 'POST') {

        //form Validation
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules(
          'username',
          'username',
          'trim|required|min_length[3]|max_length[12]|callback_username_check'
        );
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[3]', array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
        ///$this->form_validation->set_rules(')

        //after form Validation run
        if ($this->form_validation->run()) {

          $this->M_users->addUser(); //only update username and password in emp table
          $this->session->set_flashdata('message', 'User Credentails Created');
          redirect('setting/users/C_users', 'refresh');
        } else {
          echo 'error';
        }
      }

      $data['title'] = 'Add New User';
      $data['main'] = 'Add New User';
      $data['main_small'] = '';

      $data['activeModules'] = $this->M_modules->get_modulesByParent();

      $this->load->view('templates/header', $data);
      $this->load->view('users/create', $data);
      $this->load->view('templates/footer');
    }
  }

  //FOR INTERNAL USER CHECK
  function username_check($username)
  {
    if ($this->M_users->username_exist($username)) {
      $this->form_validation->set_message('username_check', 'The {field} already exists.');

      return false;
    } else {
      return true;
    }
  }

  //edit 
  public function profile($user_id = NULL)
  {
    //if($this->session->userdata('level') !== '1'){
    //          $data['title'] = "403 Access Denied";
    //          $this->load->view('403',$data);
    //          }else{

    $data = array('langs' => $this->session->userdata('lang'));

    if ($this->input->server('REQUEST_METHOD') === 'POST') {
      //form Validation
      //if($this->M_users->username_exist($this->input->post('username',true)))
      //                {
      //                    $this->form_validation->set_rules('username', 'Username Exist', 'required');
      //                }
      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('user_level', 'Role', 'required');
      // $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[3]|max_length[12]'
      //);
      //$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[3]',array('required' => 'You must provide a %s.'));
      //$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
      $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
      ///$this->form_validation->set_rules(')

      //after form Validation run
      if ($this->form_validation->run()) {

        if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] == 0) {
          
          $file_name = $_FILES['userfile']['name'];
          $file_size =$_FILES['userfile']['size'];
          $file_tmp =$_FILES['userfile']['tmp_name'];
          $file_type=$_FILES['userfile']['type'];
          //$file_ext=strtolower(end(explode('.',$_FILES['upload_pic']['name'])));
          $file_ext=pathinfo($_FILES['userfile']['name']); 
          $expensions= array("jpeg","jpg","png","gif");
          
         if(in_array($file_ext['extension'],$expensions)=== false){
            $this->session->set_flashdata('error', 'extension not allowed, please choose a JPEG or PNG file.');
            redirect('Users/profile/' . $this->input->post('id'), 'refresh');
         }
         
         if($file_size > 2097152){
           $this->session->set_flashdata('error', 'File size must be excately 2 MB');
            redirect('Users/profile/' . $this->input->post('id'), 'refresh');
         }
         
          // uploads image in the folder images
          $temp = explode(".", $_FILES["userfile"]["name"]);
          $newfilename = substr(md5(time()), 0, 10) . '.' . end($temp);
          move_uploaded_file($_FILES['userfile']['tmp_name'], 'asset/images/' . $newfilename);
          $logo_file = $newfilename;

          //DELETE THE PREVIOUSE PICTURE
          $file = FCPATH . 'asset/images/' . $this->input->post('old_img_name');
          @unlink($file);
          /////////////

        } else {
          $logo_file = $this->input->post('old_img_name');
        }

        $data = array(
          'name'  => $this->input->post('name'),
          'company'  => $this->input->post('company'),
          'email'  => $this->input->post('user_email'),
          'contact'  => $this->input->post('contact'),
          'user_level'  => $this->input->post('user_level'),
          'address'  => $this->input->post('address'),
          "image" =>  $logo_file,
        );

        $this->db->update('hjms_users', $data, array('id' => $this->input->post('id', true)));

        $this->session->set_flashdata('message', 'User Profile Updated');
        redirect('Users/profile/' . $this->input->post('id'), 'refresh');
      }
    }
    $data['title'] = 'User Profile';
    $data['main'] = 'User Profile';
    $data['main_small'] = '';

    //$data['activeModules'] = $this->M_modules->get_modulesByParent();
    $data['users'] = $this->M_users->get_Users($user_id);

    // $data['cities'] = $this->M_city->getCitiesDropDown();

    $this->load->view('templates/header', $data);
    $this->load->view('users/edit', $data);
    $this->load->view('templates/footer');
    //}//403 access forbidden
  }

  public function change_password($user_id = NULL, $username = NULL)
  {
    if ($this->session->userdata('level') !== '1') {
      $data['title'] = "403 Access Denied";
      $this->load->view('403', $data);
    } else {

      if ($this->input->server('REQUEST_METHOD') === 'POST') {
        //$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[3]',array('required' => 'You must provide a %s.'));
        //            $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
        //            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
        ///$this->form_validation->set_rules(')

        //after form Validation run
        //if($this->form_validation->run()){

        $this->M_users->updateUser_password();
        $this->session->set_flashdata('message', 'User Password Updated');
        redirect('Users', 'refresh');
        //}

      }
      $data['title'] = 'Change Password';
      $data['main'] = 'Change Password of ' . $username;
      $data['main_small'] = '';

      $data['users'] = $this->M_users->get_Users($user_id);

      $this->load->view('templates/header', $data);
      $this->load->view('users/v_pwd_change', $data);
      $this->load->view('templates/footer');
    }
  }
  function activate($user_id)
  {
    if ($this->session->userdata('level') !== '1') {
      $data['title'] = "403 Access Denied";
      $this->load->view('403', $data);
    } else {

      $this->M_users->activateUser($user_id);
      $this->session->set_flashdata('message', 'User Activated');
      redirect('Users', 'refresh');
    }
  }

  function delete($user_id)
  {
    if ($this->session->userdata('level') !== '1') {
      $data['title'] = "403 Access Denied";
      $this->load->view('403', $data);
    } else {

      $this->M_users->deleteUser($user_id);
      $this->session->set_flashdata('message', 'User Deleted');
      redirect('Users', 'refresh');
    }
  }
}
