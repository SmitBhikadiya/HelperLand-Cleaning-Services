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
                    $status = '(3,4)';
                    $result = $this->servicemodal->getAllServiceRequestByUserId($offset, $limit, $userid, $status);
                    break;
                case "favorite-pros":
                    break;
                case "setting":
                    break;
                case "dashboard":
                    $status = '(0,1)';
                    $result = $this->servicemodal->getAllServiceRequestByUserId($offset, $limit, $userid, $status);
                    break;
                default:
                    $status = '(0,1)';
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

    public function UpdateServiceSchedule()
    {
        $result = [[], []];
        if (isset($_SESSION["userdata"])) {
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            if (isset($this->data["serviceid"])) {
                $serviceid = $this->data["serviceid"];
                $service = $this->servicemodal->getServiceRequestById($serviceid);
                if (count($service) > 0) {
                    $startdate = date('Y-m-d', strtotime($this->data["date"]));
                    $spid = $service["ServiceProviderId"];
                    $results = $this->servicemodal->IsUpdateServiceSchedulePossibleOnDate($spid, $startdate);
                    if (count($results[1]) > 0) {
                        foreach ($result[1] as $key => $val) {
                            $this->addErrors($key, $val);
                        }
                    } else {
                        $select_starttime = $this->data["time"];
                        $select_totalhour = $service["ServiceHours"][0];
                        $select_endtime =  $select_starttime + $select_totalhour;
                        if ($select_starttime + $select_totalhour > 21.0) {
                            $this->addErrors("Invalid", "Could not completed the service request, because service booking request is must be completed within 21:00 time");
                        } else {
                            for ($i = 0; $i < count($results[0]); $i++) {
                                $res = $results[0][$i];
                                if($res["ServiceRequestId"]==$serviceid){
                                    continue;
                                }
                                $service_starttime = $this->convertTimeToStr($res["ServiceStartTime"]);
                                $service_hour = $res["ServiceHours"][0];
                                $service_endtime = $service_starttime + $service_hour;
                                if ($select_starttime == $service_starttime || $select_endtime == $service_endtime || $select_starttime == $service_endtime || ($select_starttime < $service_starttime && $select_endtime > $service_starttime) || ($select_starttime > $service_starttime && $select_starttime < $service_endtime)) {
                                    $this->addErrors("Invalid", "Another service request has been assigned to the service provider on $startdate from ".$this->convertStrToTime($service_starttime)." to ".$this->convertStrToTime($service_endtime).". Either choose another date or pick up a different time slot");
                                    break;
                                }
                            }  
                        }
                        // if no errors then update date and time 
                        if(!(count($this->errors) > 0)){
                            $update = $this->servicemodal->UpdateSerivceScheduleById($startdate, $select_starttime, $serviceid, $userid);
                            if(!$update){
                                $this->addErrors("Wrong", "Somthing went wrong with the update");
                            }
                        }
                    }
                } else {
                    $this->addErrors("Invalid", "Service Request Not Found");
                }
            } else {
                $this->addErrors("Invalid", "Service Id is not found!!!");
            }
        } else {
            $this->addErrors("login", "User is not login!!!");
        }

        echo json_encode(["result" => $result[0], "errors" => $this->errors]);
    }

    public function TotalRequest()
    {
        if (isset($_SESSION["userdata"])) {
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            $result = $this->servicemodal->TotalRequestByUserId($userid);
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
