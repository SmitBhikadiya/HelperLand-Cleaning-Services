<?php

require_once("modals/ServiceModal.php");
require_once("phpmailer/mail.php");

class SDashboardController
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
            $currentpage = isset($this->data["pagenumber"]) ? $this->data["pagenumber"] : 1;
            $limit = isset($this->data["limit"]) ? $this->data["limit"] : 1;
            $haspets = isset($this->data["haspets"]) ? $this->data["haspets"] : "";
            $offset = ($currentpage - 1) * $limit;
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            switch ($request) {
                case "dashboard":
                    $newservice = $this->servicemodal->TotalServiceRequestBySPId("(0,1)", $userid)[0];
                    $upcoming = $this->servicemodal->TotalServiceRequestBySPId("(2)", $userid)[0];
                    $paymentdue = 0;
                    $result[0] = ["new" => $newservice["Total"], "upcoming" => $upcoming["Total"], "paymentdue" => $paymentdue];
                    break;
                case "newservice":
                    $result = $this->servicemodal->getAllServiceRequstBySPId($offset, $limit, "(0,1)", $userid, $haspets);
                    break;
                case "upcoming":
                    $result = $this->servicemodal->getAllServiceRequstBySPId($offset, $limit, "(2)", $userid);
                    break;
                case "schedule":
                    break;
                case "history":
                    $result = $this->servicemodal->getAllServiceRequstBySPId($offset, $limit, "(3,4,5)", $userid);
                    break;
                case "ratings":
                    $result = $this->servicemodal->getAllRatingBySPId($offset, $limit, $userid);
                    break;
                case "block":
                    $result = $this->servicemodal->getAllFavBlockBySPId($offset, $limit, $userid);
                    break;
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

    public function UpdateBlockUser()
    {
        $result = [[], []];
        if (isset($_SESSION["userdata"])) {
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            if (isset($this->data["b_id"]) && isset($this->data["b_is"])) {
                $id = $this->data["b_id"];
                $is = strtolower($this->data["b_is"]);
                if (in_array($is, ["block", "unblock"])) {
                    $set = ($is == "block") ? 1 : 0;
                    $result[0] = $this->servicemodal->UpdateBlockUser($id, $set);
                } else {
                    $this->addErrors("Invalid", "Data is not valid!!");
                }
            } else {
                $this->addErrors("Invalid", "Somthing went wrong with the data!!!");
            }
        } else {
            $this->addErrors("login", "User is not login!!!");
        }

        echo json_encode(["result" => $result[0], "errors" => $this->errors]);
    }

    public function TotalRequest($request = '')
    {
        $result = [[], []];
        if (isset($_SESSION["userdata"])) {
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            $haspets = isset($this->data["haspets"]) ? $this->data["haspets"] : "";
            switch ($request) {
                case "newservice":
                    $result = $this->servicemodal->TotalServiceRequestBySPId("(0,1)", $userid, $haspets);
                    break;
                case "upcoming":
                    $result = $this->servicemodal->TotalServiceRequestBySPId("(2)", $userid);
                    break;
                case "history":
                    $result = $this->servicemodal->TotalServiceRequestBySPId("(3,4)", $userid);
                    break;
                case "ratings":
                    $result = $this->servicemodal->getTotalRatingBySPId($userid);
                    break;
                case "block":
                    $result = $this->servicemodal->TotalFavoriteAndBlockBySPId($userid);
                    break;
                case "setting":
                    break;
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

    public function CancelService()
    {
        $result = 0;
        $mailmsg = "";
        if (isset($_SESSION["userdata"])) {
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            $serviceid = $this->data["serviceid"];
            $comment = $this->data["comment"];
            $result = $this->servicemodal->CancelServiceById($userid, $serviceid, $comment);
            if ($result == 1) {
                $service = $this->servicemodal->getServiceRequestById($serviceid);
                if (count($service) > 0) {
                    $body = "<h1>Service Request <b>" . $service["ServiceRequestId"] . "</h1></b> has been <kbd style='color:red;'><b>cancelled</b></kbd> by the customer.";
                    $mailmsg = sendmail([$service["SPEmail"]], "Service Cancelled", $body);
                }
            }
        } else {
            $this->addErrors("login", "User is not login!!!");
        }

        echo json_encode(["result" => $result, "errors" => $this->errors, "mail" => $mailmsg]);
    }

    public function AcceptServiceRequest()
    {
        $result = [[], []];
        $mailmsg = "";
        if (isset($_SESSION["userdata"])) {
            $user = $_SESSION["userdata"];
            $userid = $user["UserId"];
            $serviceid = $this->data["serviceid"];
            if (count($this->servicemodal->IsAcceptedByAnySP($serviceid)) < 1) {
                $service = $this->servicemodal->getServiceRequestById($serviceid);
                if (count($service) > 0) {
                    $startdate = date('Y-m-d', strtotime($service["ServiceStartDate"]));
                    $starttime = date('H:i', strtotime($service["ServiceStartDate"]));
                    $check_status = '(2)';
                    $results = $this->servicemodal->IsUpdateServiceSchedulePossibleOnDate($userid, $startdate, $check_status);
                    //print_r($results);
                    if (count($results[1]) > 0) {
                        foreach ($results[1] as $key => $val) {
                            $this->addErrors($key, $val);
                        }
                    } else {
                        $select_starttime = $this->convertTimeToStr($starttime);
                        $select_totalhour = $service["ServiceHours"][0];
                        $select_endtime =  $select_starttime + $select_totalhour;
                        if ($select_starttime + $select_totalhour > 21.0) {
                            $this->addErrors("Invalid", "Could not completed the service request, because service booking request is must be completed within 21:00 time");
                        } else {
                            for ($i = 0; $i < count($results[0]); $i++) {
                                $res = $results[0][$i];
                                if ($res["ServiceRequestId"] == $serviceid) {
                                    continue;
                                }
                                $service_starttime = $this->convertTimeToStr($res["ServiceStartTime"]);
                                $service_hour = $res["ServiceHours"][0];
                                $service_endtime = $service_starttime + $service_hour;
                                if ($select_starttime == $service_starttime || $select_endtime == $service_endtime || $select_starttime == $service_endtime || $select_endtime == $service_starttime ||
                                    ($select_starttime < $service_starttime && $select_endtime > $service_starttime) || ($service_starttime-$select_endtime) < 1 ||
                                    ($select_starttime > $service_starttime && $select_starttime < $service_endtime) || ($select_starttime-$service_endtime) < 1) {
                                    $this->addErrors("Invalid", "Another service request ".substr("000".$res["ServiceRequestId"], -4)." has already been assigned which has time overlap with this service request. You can’t pick this one!");
                                    break;
                                }
                            }
                        }
                    }
                    if(count($this->errors) < 1){
                        if(!$this->servicemodal->AcceptServiceRequest($serviceid, $userid)){
                            $this->addErrors("SQLError", "Somthing went wrong with the sql!!!");
                        }
                    }
                } else {
                    $this->addErrors("NotFound", "Service is not found!!!");
                }
            } else {
                $this->addErrors("accepted", "This service request is no more available. It has been assigned to another provider!!!");
            }
        } else {
            $this->addErrors("login", "User is not login!!!");
        }

        echo json_encode(["result" => $result[0], "errors" => $this->errors, "mail" => $mailmsg]);
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
