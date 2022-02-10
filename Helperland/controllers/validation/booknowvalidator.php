<?php
    class BookNowValidator{
        public $data;
        public $errors = [];
        private static $booknowfield = ['FirstName', 'LastName', 'Mobile', 'Email', 'Subject', 'Message', 'Policy'];

        function __construct($data){
            $this->data = $data;
        }
        function isContactUsFormValidate(){
            if(!isset($this->data["Policy"])){
                $this->data["Policy"] = "";
            }
            foreach(self::$booknowfield as $field){
                if(!array_key_exists($field, $this->data)){
                    $this->addErrors("field","$field is not exists");
                    return $this->errors;
                }
            }
            $this->validateFirstname(trim($this->data["FirstName"]));
            $this->validateMobile(trim($this->data["Mobile"]));
            $this->validateMessage(trim($this->data["Message"]));
            $this->validatePolicy(trim($this->data["Policy"]));

            return $this->errors;
        } 
        public function validateFirstname($fname){
            if(empty($fname)){
                $this->addErrors("firstname","field can`t be empty");
            }else{
                if(!preg_match("/^[^@$!%*#?&]+$/", $fname)){
                    $this->addErrors("firstname","special charcater can't be accepted");
                }
            }
        }

        public function validateMobile($mobile){
            if(empty($mobile)){
                $this->addErrors("mobile","field can`t be empty");
            }else{
                if(!preg_match('/^[0-9]{10}$/',$mobile)){
                    $this->addErrors("mobile","length must be 10 chars & number");
                }
            }
        }

        public function validateMessage($message){
            if(empty($message)){
                $this->addErrors("message","field can`t be empty");
            }else{
                if(strlen($message) > Config::MESSAGE_MAX_LENGTH){
                    $this->addErrors("message","Message can't be longer than ".Config::MESSAGE_MAX_LENGTH." characters");
                } 
            }
        }

        public function validatePolicy($policy){
            if(empty($policy)){
                $this->addErrors("policy","privacy & policy must be accepted");
            }
        }
    

        private function addErrors($key, $value){
            $this->errors[$key] = $value;
        }
    }
?>  