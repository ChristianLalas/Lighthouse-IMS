<?php 
	class Inventory extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('Database_model');
				$this->load->library('session');
				$this->load->helper('date');
			$this->load->helper('url');		
			date_default_timezone_set('Asia/Manila');	
		}
		
		function index(){
			if($this->session->userdata('logged_in')){
				$session_data = $this->session->userdata('logged_in');
				$data['accountUN'] = $session_data['accID'];
				$data['accounts'] = $this->Database_model->getAccounts();
				//data['inventory'] = $this->Database_model->getInventory();
				//data['itemType']   = $this->Database_model->EBGetItemType();
				$data['header'] = "(All)";
				//$data['counts'] = count($this->Database_model->getCounts());
               	//$data['countsReq'] = count($this->Database_model->getRequest());
				$this->load->view('inventory_list', $data);
			} else {
				redirect('Login/logInInvalid');
			}
		}

	}
?>