<?php 
	
	    class Suppliers extends CI_Controller{
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
				$data['suppliers'] = $this->Database_model->getSuppliers();
				//$data['counts'] = count($this->Database_model->getCounts());
				//$data['countsReq'] = count($this->Database_model->getRequest());
				$this->load->view('suppliers', $data);
			} else {
					$this->load->view('login_view');
			}
		}
		
		function searchSupplier(){
			$passdata = json_decode(file_get_contents("php://input"));
			
			$result = $this->Database_model->searchSupplier($passdata->id);
			echo($result);
		}

		function updateSupplier(){
			$passdata = json_decode(file_get_contents("php://input"));
			
			$supID = $passdata->id;
			$accID = $passdata->accountID;

			$data = array(
				'aLActivity' => "Upadate Supplier",
				'accID'	 	 => $accID 
			);

			$this->Database_model->insertActivityLogs($data);

			$data = array(
					"supCompany"	=> $passdata->company, 
					"supAd"			=> $passdata->address, 
					"supContactNo"	=> $passdata->contactNo, 
					"supContactPer"	=> $passdata->personel	
				);

			$this->Database_model->updateSupplier($supID, $data);
		}

		function insertSupplier(){
			$passdata = json_decode(file_get_contents("php://input"));
			
			$accID = $passdata->accountID;

			$data = array(
				'aLActivity' => "Update Supplier",
				'accID'	 	 => $accID 
			);

			$this->Database_model->insertActivityLogs($data);

			$data = array(
					"supCompany"	=> $passdata->company, 
					"supAd"			=> $passdata->address, 
					"supContactNo"	=> $passdata->contactNo, 
					"supContactPer"	=> $passdata->personel,
					"supStat"		=> "ENABLED"	
				);

			$this->Database_model->newSupplier($data);
		}
		function newSupplier() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('Suppliername', 'Suppliername', 'required|min_length[2]');
		$this->form_validation->set_rules('Supplieraddress', 'Supplieraddress', 'required|min_length[2]');
		$this->form_validation->set_rules('Supcontactno', 'Supcontactno', 'required|min_length[2]');

		if ($this->form_validation->run() == FALSE) {
				$this->load->view('Suppliers');
			} else {

			$supCompany = $this->input->post('Suppliername');
			$supAd = $this->input->post('Supplieraddress');
			$supContactPer = $this->input->post('Supcontactper');
			
			$supCompany = htmlspecialchars($supCompany);
			$supAd = htmlspecialchars($supAd);
			$supContactPer = htmlspecialchars($supContactPer);

		$data['suppliers'] = array(
			'supCompany' => $supCompany,
			'supAd' => $supAd,
			'supContactNo' => $this->input->post('Supcontactno'),
			'supContactPer' => $supContactPer,
			'supStat' => "ENABLED"
		);

			$this->Database_model->newSupplier($data['suppliers']);
			redirect('Suppliers');
		}	
		}

		function supplierEnable(){
			if($this->session->userdata('logged_in')){
				$data['supID'] = $this->uri->segment(4);
				$data['newStat'] = "ENABLED";
				$this->Database_model->editSupStat($data);
				
				$supID = $this->uri->segment(3);
				$date = date('Y-m-d');
				$time = date('h:i a');
				$edit = "Activated.$supID.Supplier";
				$data['actlog'] =  array(
					'aLActivity' => $edit,
					'accID' => $accID
				);

				redirect('Suppliers');
			} else {
				$this->load->view('login_view');
			}
		}

		function supplierDisable(){
			if($this->session->userdata('logged_in')){
				$data['supID'] = $this->uri->segment(4);
				$data['newStat'] = "DISABLED";
				$this->Database_model->editSupStat($data);
				
				$supID = $this->uri->segment(3);
				$date = date('Y-m-d');
				$time = date('h:i a');
				$edit = "Activated.$supID.Supplier";
				$data['actlog'] =  array(
					'aLActivity' => $edit,
					'accID' => $accID
				);

				redirect('Suppliers');
			} else {
				$this->load->view('login_view');
			}
		}

		function checkNewSupplierName(){
			$passdata = json_decode(file_get_contents("php://input"));

			echo($this->Database_model->checkNewSupplierName($passdata->newSupplierName));
		}	

		function checkEditSupplierName(){
			$passdata = json_decode(file_get_contents("php://input"));

			$supID = $passdata->suppierID;
			$supName = $passdata->suppierName;

			$resultOne = $this->Database_model->checkEditSupplierName($supID, $supName);
			$resultTwo = $this->Database_model->checkNewSupplierName($supName);

			if ($resultOne[0]->status == "FALSE" && $resultTwo == "TRUE") {
				echo("TRUE");
			}else if ($resultOne[0]->status == "TRUE" || ($resultOne[0]->status == "FALSE" && $resultTwo == "FALSE")) {
				echo("FALSE");
			}
		}
	} 

?>