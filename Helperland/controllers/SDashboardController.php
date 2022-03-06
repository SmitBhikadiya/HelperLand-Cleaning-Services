<?php

require_once("modals/ServiceModal.php");
require_once("phpmailer/mail.php");

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


    public function ServiceRequest($request = "")
    {
        if (isset($_SESSION["userdata"])) {
            $result = [[], []];
            $currentpage = $this->data["pagenumber"];
            $limit = $this->data["limit"];
            $offset = ($currentpage - 1) * $limit;
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            switch ($request) {
                case "service-history":
                    $status = '(3,4,5)';
                    $result = $this->servicemodal->getAllServiceRequestByUserId($offset, $limit, $userid, $status);
                    break;
                case "favorite-pros":
                    $result = $this->servicemodal->getFavoriteAndBlockedList($userid);
                    break;
                case "dashboard":
                    $status = '(0,1,2)';
                    $result = $this->servicemodal->getAllServiceRequestByUserId($offset, $limit, $userid, $status);
                    break;
                default:
                    $status = '(0,1,2)';
                    $result = $this->servicemodal->getAllServiceRequestByUserId($offset, $limit, $userid, $status);
            }
            if (count($result[1]) > 0) {
                foreach ($result[1] as $key => $val) {
                    $this->addErrors($key, $val);
                }
            }
        } else {
            $this->addErrors("login", "User is not login!!!");
        }

        echo json_encode(["result" => $result[0], "errors" => $this->errors]);
    }

    public function UpdateFavouriteUser(){
        $result = [[],[]];
        if (isset($_SESSION["userdata"])) {
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            if(isset($this->data["f_id"]) && isset($this->data["f_is"])){
                $id = $this->data["f_id"];
                $is = strtolower($this->data["f_is"]);
                if(in_array($is, ["favourite", "unfavourite"])){
                    $set = ($is=='favourite') ? 1 : 0;
                    $result[0] = $this->servicemodal->UpdateFavouriteUser($id, $set);
                }else{
                    $this->addErrors("Invalid", "Data is not valid!!");
                }
            } else{
                $this->addErrors("Invalid", "Somthing went wrong with the data!!!");
            }
        }else {
            $this->addErrors("login", "User is not login!!!");
        }

        echo json_encode(["result" => $result[0], "errors" => $this->errors]);   
    }

    public function UpdateBlockUser(){
        $result = [[],[]];
        if (isset($_SESSION["userdata"])) {
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            if(isset($this->data["b_id"]) && isset($this->data["b_is"])){
                $id = $this->data["b_id"];
                $is = strtolower($this->data["b_is"]);
                if(in_array($is, ["block", "unblock"])){
                    $set = ($is=="block") ? 1 : 0;
                    $result[0] = $this->servicemodal->UpdateBlockUser($id, $set);
                }else{
                    $this->addErrors("Invalid", "Data is not valid!!");
                }
            } else{
                $this->addErrors("Invalid", "Somthing went wrong with the data!!!");
            }
        }else {
            $this->addErrors("login", "User is not login!!!");
        }

        echo json_encode(["result" => $result[0], "errors" => $this->errors]);
    }

    public function TotalRequest($request='')
    {   
        $result = [[],[]];
        if (isset($_SESSION["userdata"])) {
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            switch ($request) {
                case "service-history":
                    $status = '(3,4)';
                    $result = $this->servicemodal->TotalRequestByUserId($userid, $status);
                    break;
                case "favorite-pros":
                    $result = $this->servicemodal->TotalFavoriteAndBlockByUserId($userid);
                    break;
                case "dashboard":
                    $status = '(0,1,2)';
                    $result = $this->servicemodal->TotalRequestByUserId($userid, $status);
                    break;
                default:
                    $status = '(0,1,2)';
                    $result = $this->servicemodal->TotalRequestByUserId($userid, $status);
            }
        }else {
            $this->addErrors("login", "User is not login!!!");
        }
            
        if (count($result[1]) > 0) {
            foreach ($result[1] as $key => $val) {
                $this->addErrors($key, $val);
            }
        }

        echo json_encode(["result" => $result[0], "errors" => $this->errors]);
    }

    public function CancelService(){
        $result = 0;
        $mailmsg = "";
        if(isset($_SESSION["userdata"])){
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            $serviceid = $this->data["serviceid"];
            $comment = $this->data["comment"];
            $result = $this->servicemodal->CancelServiceById($userid, $serviceid, $comment);
            if($result==1){
                $service = $this->servicemodal->getServiceRequestById($serviceid);
                if(count($service) > 0){
                    $body = "<h1>Service Request <b>".$service["ServiceRequestId"]."</h1></b> has been <kbd style='color:red;'><b>cancelled</b></kbd> by the customer.";
                    $mailmsg = sendmail([$service["SPEmail"]], "Service Cancelled", $body);
                }
            }
        } else {
            $this->addErrors("login", "User is not login!!!");
        }

        echo json_encode(["result" => $result, "errors" => $this->errors, "mail"=>$mailmsg]);
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
    private function convertStrToTime($str){
        $hour = substr("0"+floor($str), -2);
        $min = "00";
        if($hour<$str){
            $min = "30";
        }
        return $hour.":".$min;
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
