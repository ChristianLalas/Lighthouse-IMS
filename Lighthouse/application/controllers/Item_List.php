<?php 
	class Item_List extends CI_Controller{
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
				$data['inventory'] = $this->Database_model->getInventoryIL();
				$data['header'] = "(All)";
				$data['counts'] = count($this->Database_model->getCounts());
			//	$data['countsReq'] = count($this->Database_model->getRequest());
				$this->load->view('item_list', $data);
			} else {
				$this->load->view('login_view');
			}
		}


		function itemEnabled(){
			if($this->session->userdata('logged_in')){
					$session_data = $this->session->userdata('logged_in');
					$data['accountUN'] = $session_data['accID'];
					$data['accounts'] = $this->Database_model->getAccounts();
					$data['inventory'] = $this->Database_model->getInventoryILEnabled();
					$data['header'] = "(Enabled)";
					$data['counts'] = count($this->Database_model->getCounts());
					$data['countsReq'] = count($this->Database_model->getRequest());
					$this->load->view('item_list', $data);
			} else {
					$this->load->view('login_view');
			}
		}

		function itemDisabled(){
			if($this->session->userdata('logged_in')){
				$session_data = $this->session->userdata('logged_in');
				$data['accountUN'] = $session_data['accID'];
				$data['accounts'] = $this->Database_model->getAccounts();
				$data['inventory'] = $this->Database_model->getInventoryILDisabled();
				$data['header'] = "(Disabled)";
				$data['counts'] = count($this->Database_model->getCounts());
				$data['countsReq'] = count($this->Database_model->getRequest());
				$this->load->view('item_list', $data);
			} else {
				$this->load->view('login_view');
			}
		}

		function itemEnable(){
			if($this->session->userdata('logged_in')){
				$data['itemCode'] = $this->uri->segment(4);
				$data['newStat'] = "ENABLED";
				$this->Database_model->editItemStat($data);
				
				redirect('Item_List');
			} else {
				$this->load->view('login_view');
			}
		}

		function itemDisable(){
			if($this->session->userdata('logged_in')){
				$data['itemCode'] = $this->uri->segment(4);
				$data['newStat'] = "DISABLED";
				$this->Database_model->editItemStat($data);
				
				redirect('Item_List');
			} else {
				$this->load->view('login_view');
			}
		}

		function getUnits(){
			$result = $this->Database_model->getUnits();
			echo($result);
		}

		function getItemType(){
			$result = $this->Database_model->getItemType();
			echo($result);
		}

		function searchItem(){
			$passData = json_decode(file_get_contents("php://input"));

			$result = $this->Database_model->searchItem($passData->code);
			echo($result);
		}

		function updateItem(){
			$passData = json_decode(file_get_contents("php://input"));

			$data = array(
				"itemName" 	=> $passData->name,
				"baseUnit" 	=> $passData->baseUnit,
				"itemRLvl" 	=> $passData->reorderLvl,
				"itemTypeID"=> $passData->type,
				"convUnitID"=> $passData->convUnit,
				"bCValue"	=> $passData->bCValue
				);

			$this->Database_model->updateItem($passData->id, $data);
		}

		function insertItem(){
			$passData = json_decode(file_get_contents("php://input"));

			$data = array(
				"itemName" 	=> $passData->name,
				"baseUnit" 	=> $passData->baseUnit,
				"itemRLvl" 	=> $passData->reorderLvl,
				"itemTypeID"=> $passData->type,
				"itemQty"	=> 0,
				"convUnitID"=> $passData->convUnit,
				"bCValue"	=> $passData->bCValue,
				"itemStat"	=> "ENABLED"
				);

			$this->Database_model->newItem($data);
		}
		
		function checkNewItem(){
			$passData = json_decode(file_get_contents("php://input"));

			$result = $this->Database_model->checkNewItem($passData->newItemName);

			echo($result);
		}

		function checkEditItemName(){
			$passData = json_decode(file_get_contents("php://input"));

			$itemCode = $passData->itemCode;
			$itemName = $passData->itemName;
			
			$resultOne = $this->Database_model->checkEditItemName($itemCode, $itemName);
			$resultTwo = $this->Database_model->checkNewItem($itemName);
			
			if ($resultOne[0]->status == "FALSE" && $resultTwo == "TRUE") {
				echo("TRUE");
			} else if(($resultOne[0]->status == "FALSE" && $resultTwo == "FALSE") || $resultOne[0]->status == "TRUE"){
				echo("FALSE");
			}
		}

		function insertUnit(){
			$passData = json_decode(file_get_contents("php://input"));

			$this->Database_model->insertUnits($passData->unitName);
		}

		function checkNewUnitName(){
			$passData = json_decode(file_get_contents("php://input"));

			$result	= $this->Database_model->checkNewUnitName($passData->unitName);
			echo($result);
		}

		function checkEditUnitName(){
			$passData = json_decode(file_get_contents("php://input"));
			
			$unitID 	= $passData->unitID;
			$unitName 	= $passData->unitName;
			
			$result	= $this->Database_model->checkEditUnitName($unitID, $unitName);
			echo($result[0]->status);
		}
	}
?>