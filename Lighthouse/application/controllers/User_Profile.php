<?php 
    class User_Profile extends CI_Controller{
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
                $data['inventory'] = $this->Database_model->getInventory();
                $data['counts'] = count($this->Database_model->getCounts());
              //  $data['countsReq'] = count($this->Database_model->getRequest());
                $this->load->view('user_profile', $data);
            } else {
                $this->load->view('login_view');
            }
        }

        function updateUser(){
            $passData = json_decode(file_get_contents("php://input"));
            
            $accID  = $passData->accountID;

            $data = array(
                'aLActivity' => "Update Profile",
                'accID'      => $accID 
            );

            $this->Database_model->insertActivityLogs($data);

            $userData = array(
                "accLN"         => $passData->lastName,
                "accFN"         => $passData->firstName,
                "accContctNo"   => $passData->contactNo,
                "accUN"         => $passData->username,
                "accPass"       => $passData->password,
                "accEAd"        => $passData->email,
                "accAd"         => $passData->address
            );

            $this->Database_model->updateUser($accID, $userData);
        }

        function checkNewUserName(){
            $data = json_decode(file_get_contents("php://input"));

            $accID      = $data->accountID;
            $username   = $data->username;

            $resultOne = $this->Database_model->checkNewUsername($accID, $username);
            $resultTwo = $this->Database_model->checkUsername($username);
                
            if ($resultOne[0]->status == "FALSE" && $resultTwo == "TRUE") {
                echo("TRUE");
            }else if ($resultOne[0]->status == "TRUE" || ($resultOne[0]->status == "FALSE" && $resultTwo == "FALSE")) {
                echo("FALSE");
            }

        }
    }
?>