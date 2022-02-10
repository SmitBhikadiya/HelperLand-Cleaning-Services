<?php

require("validation/booknowvalidator.php");
require("phpmailer/mail.php");
require("modals/BookNowModal.php");

class BookNowController
{
    public $data;
    public $booknowModal;
    public $errors = [];
    function __construct()
    {
        $this->data = $_POST;
        $this->booknowModal = new BookNowModal($this->data);
    }

    function CheckPostalCode(){
        $result = [];
        if(isset($_POST["postalcode"])){
            $zipcode = $_POST["postalcode"];
            if(!empty($zipcode)){
                $result = $this->booknowModal->getPostalCode();
                if(count($result) < 1){
                    $this->addErrors("ZipCode", "We regret to inform you that your selected zip code is not covered by Helperland services until now!");
                }
            }else{
                $this->addErrors("ZipCode","Zipcode can't be empty");
            }
        }else{
            $this->addErrors("ZipCode","Somthing went wrong with the field name");
        }
        echo json_encode(["result"=>$result, "errors"=>$this->errors]);
    }

    function isLogin(){
        
    }
    
    /*-------------- Show Error -----------*/
    public function showError($title, $errors = [])
    {
        $_SESSION["error_title"] = $title;
        $_SESSION["error_array"] = $errors;
    }
    /*------------- Set error ------------*/
    private function addErrors($key, $val){
        $this->errors[$key] = $val;
    }
}
