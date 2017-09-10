<?php
	class Accounts extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('Database_model');
			$this->load->helper('url');
			$this->load->helper('form');			
		}

		function index(){
			if($this->session->userdata('logged_in')){
				$session_data = $this->session->userdata('logged_in');
				$data['accountUN'] = $session_data['accID'];
				$data['accounts'] = $this->Database_model->getAccounts();
				$data['users'] = $this->Database_model->getAccoutsData();
			//	$data['counts'] = count($this->Database_model->getCounts());
			//$data['countsReq'] = count($this->Database_model->getRequest());
				$this->load->view('accounts', $data);
			} else {
				$this->load->view('login_view');
			}
		}

		function passwordAut(){
			$data = json_decode(file_get_contents("php://input"));

			$username = $data->username;
			$password = $data->password;

			$result = $this->Database_model->PasswordVeri($username, $password);

			echo($result);
		}

		function getUserInfo(){
			$data = json_decode(file_get_contents("php://input"));

			$id = $data->id;

			$result = $this->Database_model->getUserInfo($id);
			echo($result);
		}

		function getUserPass(){
			$data = json_decode(file_get_contents("php://input"));

			$id = $data->id;

			$result = $this->Database_model->getUserPassword($id);
			echo($result);
		}

		function accountEnable(){
			if($this->session->userdata('logged_in')){
				$data['accID'] = $this->uri->segment(4);
				$data['newStat'] = "ENABLED";
				$this->Database_model->editAccStat($data);
				
				$accID = $this->uri->segment(3);
				$date = date('Y-m-d');
				$time = date('h:i a');
				$edit = "Activated.$accID.Account";
				$data['actlog'] =  array(
					'aLActivity' => $edit,
					'accID' => $accID
				);
			
				$this->Database_model->insertActLogs($data['actlog']);
				redirect('Accounts');
			} else {
				$this->load->view('login_view');
			}
		}

		function accountDisable(){
			if($this->session->userdata('logged_in')){
				$data['accID'] = $this->uri->segment(4);
				$data['newStat'] = "DISABLED";
				$this->Database_model->editAccStat($data);
				
				$accID = $this->uri->segment(3);
				$date = date('Y-m-d');
				$time = date('h:i a');
				$edit = "Activated.$accID.Account";
				$data['actlog'] =  array(
					'aLActivity' => $edit,
					'accID' => $accID
				);
				
				$this->Database_model->insertActLogs($data['actlog']);
				redirect('Accounts');
			} else {
				$this->load->view('login_view');
			}
		}

		function updateUser(){
			$data = json_decode(file_get_contents("php://input"));
			
			$accID	= $data->id;

			$userData = array(
				"accLN" 		=> $data->lastName,
				"accFN" 		=> $data->firstName,
				"accContctNo" 	=> $data->contactNo,
				"accAd" 		=> $data->address,
				"accEAd" 		=> $data->email,
				"accType" 		=> $data->type
			);

			$this->Database_model->updateUser($accID, $userData);
		}	

		function addUser(){
			$data = json_decode(file_get_contents("php://input"));

			$newUserData = array(
				'accLN'			=> $data->lastName,
				'accFN'			=> $data->firstName,
				'accType'		=> $data->type,
				'accContctNo' 	=> $data->contactNo,
				'accAd' 		=> $data->address,
				'accEAd' 		=> $data->email,
				'accUN'			=> $data->username,
				'accPass'		=> $data->password,
				'accStat'		=> "ENABLED"
			);
			$this->Database_model->addUser($newUserData);
		}

		function checkUserName(){
			$data = json_decode(file_get_contents("php://input"));

			$result = $this->Database_model->checkUsername($data->userName);
			echo($result);
		}
	}
?>