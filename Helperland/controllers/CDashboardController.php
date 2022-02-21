<?php

use LDAP\Result;

session_start();
//require("validation/booknowvalidator.php");
//require("phpmailer/mail.php");
require("modals/ServiceModal.php");

class CDashboardController
{
    public $validate;
    public $servicemodal;
    public $errors = [];

    public function __construct()
    {
        $this->data = $_POST;
        $this->servicemodal = new ServiceModal($this->data);
    }


    public function ServiceRequest($request=""){
        if(isset($_SESSION["userdata"])){
            $result = [[],[]];
            $currentpage = $this->data["pagenumber"];
            $limit = $this->data["limit"];
            $offset = ($currentpage-1)*$limit;
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            switch ($request) {
                case "service-history":
                    break;
                case "favorite-pros":
                    break;
                case "setting":
                    break;
                case "dashboard":
                    $result = $this->servicemodal->getAllServiceRequestByUserId($offset, $limit, $userid);
                    break;
                default:
                    $result = $this->servicemodal->getAllServiceRequestByUserId($offset, $limit, $userid);
            }

            if(count($result[1]) > 0){
                foreach ($result[1] as $key => $val) {
                    $this->addErrors($key, $val);
                }
            }

        }else{
            $this->addErrors("login", "User is not login!!!");
        }

        echo json_encode(["result"=>$result[0], "errors"=>$this->errors]);
    }

    public function TotalRequest(){
        if(isset($_SESSION["userdata"])){
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            $result = $this->servicemodal->TotalRequest($userid);
            if(count($result[1]) > 0){
                foreach ($result[1] as $key => $val) {
                    $this->addErrors($key, $val);
                } 
            }
        }else{
            $this->addErrors("login", "User is not login!!!");
        }

        echo json_encode(["result"=>$result[0], "errors"=>$this->errors]);
    }


     /*------------- Set error ------------*/
     private function addErrors($key, $val)
     {
         $this->errors[$key] = $val;
     }
    /*-------------- Show Error -----------*/
    public function showError($title, $errors = [])
    {
        $_SESSION["error_title"] = $title;
        $_SESSION["error_array"] = $errors;
        header("Location: " . Config::BASE_URL . "?controller=Default&function=error");
        exit();
    }
}
