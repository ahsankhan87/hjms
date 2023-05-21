<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// CodeIgniter i18n library by Jérôme Jaglale
// http://maestric.com/en/doc/php/codeigniter_i18n
// version 10 - May 10, 2012

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //$this->ci =& get_instance();

        //-----------Check Admin User Authentication-------------------------
        //session_start();
        if($this->session->userdata('logged_in') !== TRUE){
            redirect('Login');
        }
        //---------------End------------------------------------

        //get active financial year
        define('FY_YEAR', $_SESSION['FY_YEAR']);
        define('FY_START_DATE', $_SESSION['FY_START_DATE']);
        define('FY_END_DATE', $_SESSION['FY_END_DATE']);
        
    }
}
