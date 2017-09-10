<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $this->load->helper('form');
    if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                redirect('Inventory', refresh);
            } else {
                $this->load->view('login_view');
            }
        }

  function logInInvalid()
  {
    $this->load->helper('form');
    if($this->session->userdata('logged_in')){
                $session_data = $this->session->userdata('logged_in');
                redirect('Inventory', refresh);
            } else {
              $this->load->view('login_view', true);
              $this->load->view('login_warning', true);
            }
        }
  }


?>