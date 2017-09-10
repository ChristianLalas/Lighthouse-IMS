<?php

class VerifyLogin extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('Database_model');
	$this->load->helper('date');
	$this->load->helper('url');
			date_default_timezone_set('Asia/Manila');	
	
  }

  function index()
  {
    //This method will have the cairo_scaled_font_extents(scaledfont)ials validation
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
	
    if($this->form_validation->run() == FALSE)
    {
      //Field validation failed.  User redirected to login page
      redirect('Login/logInInvalid');
    }
    else
    {
      $data['username'] = $this->input->post('username');
      redirect('Inventory', $data);
    }
    
  }
  
  function check_database($password)
  {
    //Field validation succeeded.  Validate against database
    $username = $this->input->post('username');
    
    //query the database
    $result = $this->Database_model->login($username, $password);

    if($result)
    {
      foreach($result as $row)
      {
        $sess_array = array(
          'accID' => $row->accID,
          'accUN' => $row->accUN,
  		  'accPass' => $row->accPass,
  		  'accType' => $row->accType
        );
		
		
        $this->session->set_userdata('logged_in', $sess_array);
      	
			$accsID = $row->accID;
			$do = "Login";
			$data['actlog'] =  array(
				'aLActivity' => $do,
				'accID' => $accsID
			);
	  }
			$this->Database_model->insertActLogs($data['actlog']);
      return TRUE;
    }
  }

  function logOut(){
	  $accsID = $this->uri->segment(3);
			$date = date('Y-m-d');
			$time = date('h:i a');
			$do = "Logout";
			$data['actlog'] =  array(
				'aLActivity' => $do,
				'accID' => $accsID
			);
	$this->Database_model->insertActLogs($data['actlog']);
	$this->session->unset_userdata('logged_in', $sess_array);
	redirect('Login');
  }
}
?>