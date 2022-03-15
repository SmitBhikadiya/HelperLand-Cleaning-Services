<?php

require_once("modals/ServiceModal.php");
require_once("modals/UsersModal.php");
require_once("phpmailer/mail.php");

class ADashboardController
{
    public $validate;
    public $servicemodal, $usersmodal;
    public $errors = [];

    public function __construct()
    {
        $this->data = $_POST;
        $this->servicemodal = new ServiceModal($this->data);
        $this->usersmodal = new UsersModal($this->data);
    }

    public function TotalRequest($request = '')
    {
        $result = [[], []];
        if (isset($_SESSION["userdata"])) {
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            switch ($request) {
                case "usermanagement":
                    $result = $this->servicemodal->TotalUsersForAdmin();
                    break;
                default:
                    $result = $this->servicemodal->TotalRequestForAdmin();
            }
        } else {
            $this->addErrors("login", "User is not login!!!");
        }

        if (count($result[1]) > 0) {
            foreach ($result[1] as $key => $val) {
                $this->addErrors($key, $val);
            }
        }

        echo json_encode(["result" => $result[0], "errors" => $this->errors]);
    }

    public function ServiceRequest($request = "")
    {
        if (isset($_SESSION["userdata"])) {
            $result = [[], []];
            $currentpage = $this->data["pagenumber"];
            $limit = $this->data["limit"];
            $offset = ($currentpage - 1) * $limit;
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            $cust = [[], []];
            $serv = [[], []];
            $allusers = [[],[]];
            switch ($request) {
                case "usermanagement":
                    $result = $this->servicemodal->getAllUsersForAdmin($offset, $limit);
                    $allusers = $this->servicemodal->getAllUsers();
                    break;
                default:
                    $result = $this->servicemodal->getAllServiceRequestForAdmin($offset, $limit);
                    $cust = $this->servicemodal->getAllCustomerForAdmin();
                    $serv = $this->servicemodal->getAllServicerForAdmin();
            }
            if (count($result[1]) > 0 || count($cust[1]) > 0 || count($serv[1]) > 0) {
                $errors = $result[1] + $cust[1] + $serv[1];
                foreach ($errors as $key => $val) {
                    $this->addErrors($key, $val);
                }
            }
        } else {
            $this->addErrors("login", "User is not login!!!");
        }

        echo json_encode(["result" => $result[0], "Customer" => $cust[0], "Servicer" => $serv[0], "alluser"=>$allusers[0], "errors" => $this->errors]);
    }

    public function SetApprovedByAdmin(){
        $result = 0;
        if(isset($_SESSION["userdata"])){
            $user = $_SESSION["userdata"];
            if(isset($this->data["aid"]) && isset($this->data["userid"]) && $this->data["aid"]==$user["UserId"]){
                $userid = $this->data["userid"];
                $adminid = $this->data["aid"];
                if($this->usersmodal->IsUserExists($userid)){
                    if($this->usersmodal->UpdateApprovalByAdmin($adminid, $userid)){
                        $result = 1;
                    }else{
                        $this->addErrors("SQLError", "Somthing Went Wrong with the SQL!!!");
                    }
                }else{
                    $this->addErrors("Invalid", "Invalid Reuqest!!!");
                }
            }else{
                $this->addErrors("Invalid", "Invalid Reuqest!!!");
            }
        }else{
            $this->addErrors("login", "User is not login!!!");
        }
        echo json_encode(["result" => $result,"errors" => $this->errors]);
    }

    /*------------ Convert time(10:30) format to num(10.5) -------------*/
    private function convertTimeToStr($time)
    {
        $time = explode(":", $time);
        $hour = +$time[0];
        $min = 0.0;
        if (count($time) == 2) {
            $min = +$time[1];
            if ($min != 0) {
                $min = 0.5;
            }
        }
        return $hour + $min;
    }

    /*------------ Convert  format num(10.5) to time(10:30) -------------*/
    private function convertStrToTime($str)
    {
        $hour = substr("0" + floor($str), -2);
        $min = "00";
        if ($hour < $str) {
            $min = "30";
        }
        return $hour . ":" . $min;
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
