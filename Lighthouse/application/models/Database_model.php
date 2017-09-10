<?php 

class Database_model extends CI_Model{
	
	function __construct(){
		parent :: __construct();
	}
	
	
	function login($username, $password){
		$this -> db -> select('accID, accUn, accPass');
		$this -> db -> from('accounts');
		$this -> db -> where("accUN like binary", $username); 
		$this -> db -> where("accPass like binary", $password);
		$this -> db -> where(accStat, "ENABLED");
		$this -> db -> limit(1);
		
		$query = $this -> db -> get();
		if($query->num_rows() == 1){
			return $query->result();
		} else {
			return NULL;
		}
	}
	
	function getAccounts(){
		$query = $this->db->query('SELECT * FROM ACCOUNTS where accStat = "ENABLED";');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return NULL;
		}
	}

	function newAccount($data){
		$this->db->insert('accounts', $data);
	}

	 function editAccStat($data){
		$this->db->where('accID', $data['accID'])->update('accounts', array('accStat' => $data['newStat']));
	}
	
	function insertActLogs($data){
		$this->db->insert('actlogs', $data);
	}


	/*activity logs*/
	function getActivityLogs(){
		$query = $this->db->query("SELECT * FROM actlogs join accounts on  actlogs.accID = accounts.accID order by aLDateTime DESC;");
		if($query->num_rows() >= 0){
			return $query->result();
		} else {
			return null;
		}
	}
	
	/*acounts*/
	function getAccoutsData(){
		$query = $this->db->query('SELECT  * FROM accounts;');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return null;
		}
	}

	/*add new user*/
	function addUser($newUserData){
		$this->db->insert('accounts',$newUserData);
	}

	/*admin varification*/
	function PasswordVeri($adminUsername, $adminPass){
		$query = $this->db->query("SELECT * FROM accounts where accUN = '".$adminUsername."' and accPass = '".$adminPass."' and accType = 'MANAGER' and accStat = 'ENABLED'");
		if($query->num_rows() > 0){
			return "TRUE";
		} else {
			return "FALSE";
		}
	}

	function getUserPassword($id){
		$data = array();
		$query = $this->db->query("SELECT accPass FROM accounts where accID = '".$id."'");
		if($query->num_rows() >= 0){	
			foreach($query->result() as $rs){
				$data[] = '{"password":"'.$rs->accPass.'"}';
			};
			return json_encode($data);
		} else {
			return null;
		}
	}

	function getUserInfo($id){
		$data = array();
		$query = $this->db->query("SELECT * FROM accounts where accID = '".$id."'");
		if($query->num_rows() >= 0){	
			foreach($query->result() as $rs){
				$data[] = '{"id":"'.$rs->accID.'", "fname":"'.$rs->accFN.'", "lname":"'.$rs->accLN.'", "type":"'.$rs->accType.'", "username":"'.$rs->accUN.'", "password":"'.$rs->accPass.'", "contactNo":"'.$rs->accContctNo.'", "address":"'.$rs->accAd.'", "status":"'.$rs->accStat.'"}';
			};
			return json_encode($data);
		} else {
			return null;
		}
	}

	function changePass($id, $newPassword){
		$this->db->query("UPDATE accounts SET password = '".$newPassword."' WHERE accID='".$id."';");
	}

	function editUser($Id){
		$query = $this->db->query("SELECT  * FROM accounts where accID = ".$Id.";");
		if($query->num_rows() >= 0){
			return $query->result();
		} else {
			return null;
		}
	}

	function updateUser($accID, $data){
		$this->db->where('accID', $accID);
		$this->db->update('accounts', $data); 
	}

	/*change User Status either de/activate*/
	function changeUserStatus($id, $data){
		$this->db->where('accID', $id);
		$this->db->update('accounts', $data); 
	}
	
	function insertActivityLogs($data){
		$this->db->insert('actlogs',$data);

		$query = $this->db->query("SELECT actLogID FROM actlogs order by actLogID desc limit 1;");

		if($query->num_rows() >= 0){
			return $query->result();
		} else {
			return null;
		}
	}
	

	function checkUsername($newUsername){
		$query = $this->db->query("select * from accounts WHERE accUN = '".$newUsername."';");
		if($query->num_rows() > 0){
			return "TRUE";
		} else {
			return "FALSE";
		}
	}

	function checkNewUsername($accID, $newUsername){
		$query = $this->db->query('SELECT if(accUN = "'.$newUsername.'","TRUE","FALSE") as "status" FROM accounts where accID = '.$accID.';');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return null;
		}
	}

	//SUPPLIER

	function getSuppliers(){
		$query = $this->db->query('Select * from suppliers;');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return NULL;
		}
	}

	function getSupplier(){
		$query = $this->db->query('Select * from suppliers where supStat = "ENABLED";');
		if($query->num_rows() >= 0){
			return $query->result();
		} else {
			return null;
		}
	}

	function newSupplier($data){
		$this->db->insert('suppliers', $data);
	}

	function editSupStat($data){
		$this->db->where('supID', $data['supID'])->update('suppliers', array('supStat' => $data['newStat']));
	}
	function addSupplier($data){
		$this->db->insert('suppliers',$data);
	}
	
	/*edit suppliers*/
	function searchSupplier($supId){
		$query = $this->db->query("SELECT * FROM suppliers WHERE supID='".$supId."'");
		if($query->num_rows() >= 0){
			return json_encode($query->result());
		} else {
			return null;
		}
	}

	function updateSupplier($supId, $data){
		$this->db->where('supId', $supId);
		$this->db->update('suppliers', $data); 
	}
	//INVENTORY
	function getUnit(){
		$query = $this->db->query('Select * from units');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return NULL;
		}
	}


	function getInventory(){
		$query = $this->db->query('SELECT *, TRUNCATE((itemQty / bCValue), 0) as "baseQty", mod(itemQty, bCValue) as "convQty" FROM ((inventory join units on baseUnit = unitID) join convunits on inventory.convUnitID = convunits.convUnitID) join itemtype on inventory.itemTypeID = itemtype.itemTypeID WHERE itemStat = "ENABLED" order by itemName ASC;');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return NULL;
		}
	}

	function getInventoryRawMat(){
		$query = $this->db->query('SELECT *, TRUNCATE((itemQty / bCValue), 0) as "baseQty", mod(itemQty, bCValue) as "convQty" FROM ((inventory join units on baseUnit = unitID) join convunits on inventory.convUnitID = convunits.convUnitID) join itemtype on inventory.itemTypeID = itemtype.itemTypeID WHERE itemStat = "ENABLED" AND itemTypeName = "RAW MATERIAL" order by itemName ASC;');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return NULL;
		}
	}

	function getInventoryProd(){
		$query = $this->db->query('SELECT *, TRUNCATE((itemQty / bCValue), 0) as "baseQty", mod(itemQty, bCValue) as "convQty" FROM ((inventory join units on baseUnit = unitID) join convunits on inventory.convUnitID = convunits.convUnitID) join itemtype on inventory.itemTypeID = itemtype.itemTypeID WHERE itemStat = "ENABLED" AND itemTypeName = "PRODUCTS" order by itemName ASC;');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return NULL;
		}
	}

	function getInventoryIL(){
		$query = $this->db->query('select * from ((inventory join itemtype on inventory.itemTypeID = itemtype.itemTypeID) join units on baseUnit = unitID) join convunits on inventory.convUnitID = convunits.convUnitID order by itemName ASC;');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return NULL;
		}
	}

	function getInventoryILEnabled(){
		$query = $this->db->query('select * from ((inventory join itemtype on inventory.itemTypeID = itemtype.itemTypeID) join units on baseUnit = unitID) join convunits on inventory.convUnitID = convunits.convUnitID where itemStat = "ENABLED" order by itemName ASC;');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return NULL;
		}
	}

	function getInventoryILDisabled(){
		$query = $this->db->query('select * from ((inventory join itemtype on inventory.itemTypeID = itemtype.itemTypeID) join units on baseUnit = unitID) join convunits on inventory.convUnitID = convunits.convUnitID where itemStat = "DISABLED" order by itemName ASC;');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return NULL;
		}
	}

	function getCounts(){
		$query = $this->db->query('select * from ((inventory join itemtype on inventory.itemTypeID = itemtype.itemTypeID) join units on baseUnit = unitID) join convunits on inventory.convUnitID = convunits.convUnitID WHERE itemRLvl > (itemQty / bCValue) AND itemStat = "ENABLED" order by itemName ASC;');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return NULL;
		}
	}
	function getItems(){
		$query = $this->db->query('SELECT * from ((inventory join itemtype on inventory.itemTypeID = itemtype.itemTypeID) join units on baseUnit = unitID) join convunits on inventory.convUnitID = convunits.convUnitID where itemStat = "ENABLED" order by itemName ASC;');
		if($query->num_rows() > 0){
			return json_encode($query->result());
		} else {
			return NULL;
		}
	}

    function editItemStat($data){
		$this->db->where('itemCode', $data['itemCode'])->update('inventory', array('itemStat' => $data['newStat']));
	}
	
	function updInventory($data){
		$this->db->update('inventory', $data, array('prodID' => $prodid));
	}

	function newItem($data){
		$this->db->insert('inventory', $data);
	}
	
	function newDelivery($data){
		$this->db->insert('deliveries', $data);
	}
	function checkEditItemName($itemCode, $newItemName){
		$query = $this->db->query('SELECT if(itemName = "'.$newItemName.'","TRUE","FALSE") as "status" FROM inventory where itemCode = '.$itemCode.';');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return null;
		}
	}
	function checkNewItem($newItemName){
		$query = $this->db->query("Select * from inventory where itemName ='".$newItemName."';");
		if($query->num_rows() > 0){
			return "TRUE";
		} else {
			return "FALSE";
		}
	}

	function insertUnits($unitName){
		$data = array('unitName' => $unitName );
		$this->db->insert('units', $data);

		$data = array('convUnitName' => $unitName );
		$this->db->insert('convunits', $data);
	}

	function checkNewUnitName($unitName){
		$query = $this->db->query("SELECT * FROM units where unitName = '".$unitName."';");
		if($query->num_rows() > 0){
			return "TRUE";
		} else {
			return "FALSE";
		}
	}

	function checkEditUnitName($unitID, $unitName){
		$query = $this->db->query('SELECT if(unitID = "'.$unitName.'","TRUE","FALSE") as "status" FROM units where unitName = '.$unitID.';');
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return null;
		}
	}
	function getUnits(){
		$query = $this->db->query("SELECT * FROM units");
		if($query->num_rows() > 0){
			return json_encode($query->result());
		} else {
			return NULL;
		}
	}

	function getItemType(){
		$query = $this->db->query("SELECT * FROM itemtype");
		if($query->num_rows() > 0){
			return json_encode($query->result());
		} else {
			return NULL;
		}
	}
	function searchItem($itemCode){
		$query = $this->db->query("SELECT * FROM inventory where itemCode = ".$itemCode.";");
		if($query->num_rows() > 0){
			return json_encode($query->result());
		} else {
			return NULL;
		}
	}
   


}
?>