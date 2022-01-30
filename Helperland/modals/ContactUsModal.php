<?php
require("db_connection.php");

class ContactUsModal extends Connection
{
    public $data;
    public $conn;
    public $errors = [];

    public function __construct($data){
        $this->data = $data;
        $this->conn = $this->connect();
    }

    public function insertContactData(){
        $Name = $this->data["firstname"]." ".$this->data["lastname"];
        $Email = $this->data["email"];
        $SubjectType = $this->data["subject"];
        $PhoneNumber = $this->data["phonenumber"];
        $Message = $this->data["message"];
        $UploadFileName = $this->data["filename"];
        $filelocation = $this->data["filelocation"];
        $sql = "INSERT INTO contactus (Name, Email, Subject, PhoneNumber, Message, UploadFileName, FileName) VALUES ('$Name', '$Email', '$SubjectType', '$PhoneNumber', '$Message', '$UploadFileName', '$filelocation')";
        
        $result = $this->conn->query($sql);
        if(!$result){
            $this->addErrors("contactus", "Somthing went wrong with $sql");
        }
        return [$result, $this->errors];
    }

    private function addErrors($key, $val){
        $this->errors[$key] = $val;
    }
}
