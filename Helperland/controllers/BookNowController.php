<?php

session_start();
require("validation/booknowvalidator.php");
require("phpmailer/mail.php");
require("modals/BookNowModal.php");

class BookNowController
{
    private $data;
    private $booknowModal, $serviceModal;
    private $validator;
    private $errors = [];
    function __construct()
    {
        $this->data = $_POST;
        $this->booknowModal = new BookNowModal($this->data);
        $this->validator = new BookNowValidator($this->data);
    }

    function CheckPostalCode()
    {
        $result = [[], []];
        $errors = $this->validator->isPostalCodeValid();
        if (!count($errors) > 0) {
            $result = $this->booknowModal->getPostalCode();
            if (count($result[1]) > 0) {
                foreach ($result[1] as $key => $val) {
                    $this->addErrors($key, $val);
                }
            }
        } else {
            foreach ($errors as $key => $val) {
                $this->addErrors($key, $val);
            }
        }
        echo json_encode(["result" => $result[0], "errors" => $this->errors]);
    }

    function UserDetailes()
    {
        $result = [[], []];
        if (isset($_SESSION["userdata"])) {

            // get user address detailes
            $errors = $this->validator->isPostalCodeValid();
            if (!count($errors) > 0) {
                $userid = $_SESSION["userdata"]["UserId"];
                $result = $this->booknowModal->getUserDetailesByUserId($userid);
                if (count($result[1]) > 0) {
                    foreach ($result[1] as $key => $val) {
                        $this->addErrors($key, $val);
                    }
                }
            } else {
                foreach ($errors as $key => $val) {
                    $this->addErrors($key, $val);
                }
            }

            // get favorite service provider if selected any one
            $fav_list = [];
            if (isset($_POST["workwithpets"])) {
                $workwitpets = trim($_POST["workwithpets"]);
                if ($workwitpets == "true") {
                    $workwitpets = 1;
                } else {
                    $workwitpets = 0;
                }
                $fav_list = $this->booknowModal->getFavoriteSP($userid, $workwitpets);
            } else {
                $this->addErrors("Fieldname", "Work with pet field name is not verified!!");
            }
        } else {
            $this->addErrors("User", "User is not signin!!");
        }


        echo json_encode(["result" => $result[0], "favlist" => $fav_list, "errors" => $this->errors]);
    }

    function addNewAddress()
    {
        $result = [[], []];
        if (isset($_SESSION["userdata"])) {
            $errors = $this->validator->isNewAddressValidate();
            if (!count($errors) > 0) {
                $userid = $_SESSION['userdata']['UserId'];
                $email = $_SESSION['userdata']['Email'];
                $result = $this->booknowModal->insertUserAddress($userid, $email);
                if (count($result[1]) > 0) {
                    foreach ($result[1] as $key => $val) {
                        $this->addErrors($key, $val);
                    }
                }
            } else {
                foreach ($errors as $key => $val) {
                    $this->addErrors($key, $val);
                }
            }
        } else {
            $this->addErrors("User", "User is not signin!!");
        }

        echo json_encode(["result" => $result[0], "errors" => $this->errors]);
    }

    public function insertServiceRequest()
    {
        $result = [[], []];
        if (isset($_SESSION["userdata"])) {
            $user = $_SESSION["userdata"];
            $errors = $this->validator->isServiceRequestValidate();
            if (count($errors) > 0) {
                foreach ($errors as $key => $val) {
                    $this->addErrors($key, $val);
                }
            } else {
                $service = $this->booknowModal->insertServiceRequest();
                if(count($service[1]) > 0){
                    foreach ($service[1] as $key => $val) {
                        $this->addErrors($key, $val);
                    }
                }
                // [$postalcode, $cleaningstartdate, $cleaningstarttime, $cleaningworkinghour, $totalpayment, $extrahour, $workwitpets, $spid, $status, $paymentdone, $userid]
            }
        } else {
            $this->addErrors("User", "User is not signin!!");
        }
        echo json_encode(["result" => $service[0], "errors" => $this->errors]);
    }

    public function isServiceAvailable(){
        $result = [[], []];
        if (isset($_SESSION["userdata"])) {
            $userid = $_SESSION["userdata"]["UserId"];
            if(isset($this->data["adid"])){
                $adid = $this->data["adid"];
                $ondate = $this->data["selecteddate"];
                $result = $this->booknowModal->isServiceAvailable($adid, $ondate, $userid);
                if(count($result[1]) > 0){
                    foreach ($result[1] as $key => $val) {
                        $this->addErrors($key, $val);
                    }
                }
            }else{
                $this->addErrors("Invalid", "field name is not set");
            }
        }else {
            $this->addErrors("User", "User is not signin!!");
        }
        echo json_encode(["result" => $result[0], "errors" => $this->errors]);
    }

    /*------------- Set error ------------*/
    private function addErrors($key, $val)
    {
        $this->errors[$key] = $val;
    }
}
