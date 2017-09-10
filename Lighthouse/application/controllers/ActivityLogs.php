<?php
	class ActivityLogs extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('Database_model');
			$this->load->helper('url');			
		}

		function index(){
			if($this->session->userdata('logged_in')){
				$session_data = $this->session->userdata('logged_in');
				$data['accountUN'] = $session_data['accID'];
				$data['accounts'] = $this->Database_model->getAccounts();
				$data['logs'] = $this->Database_model->getActivityLogs();
				//$data['counts'] = count($this->Database_model->getCounts());
				//$data['countsReq'] = count($this->Database_model->getRequest());
				$this->load->view('activitylogsPage', $data);
			} else {
				$this->load->view('login_view');
			}
		}

		function getActitySum(){
			$data = json_decode(file_get_contents("php://input"));

			$id =  $data->id;
			$activity = $data->activity;

			$result = $this->Database_model->getActivitySummary($id, $activity);
			echo($result);
		}
	}
?>