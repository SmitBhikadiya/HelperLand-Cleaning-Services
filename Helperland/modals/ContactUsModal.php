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
        $sql = "INSERT INTO contactus (Name, Email, SubjectType, PhoneNumber, Message, UploadFileName) VALUES ('$Name', '$Email', '$SubjectType', '$PhoneNumber', '$Message', '$UploadFileName')";
        
        $result = $this->conn->query($sql);
        $last_id = $this->conn->insert_id;
        if(!$result){
            $this->addErrors("contactus", "Somthing went wrong with $sql");
        }else{
            $filelocation = $this->data["filelocation"];
            if(!empty($UploadFileName)){
                $sql = "INSERT INTO contactusattachment (ContactUsId, Name, FileName) VALUES ($last_id, '$UploadFileName', '$filelocation')";
                $result = $this->conn->query($sql);
                if(!$result){
                    $this->addErrors("contactusattachment", "Somthing went wrong with $sql");         
                }
            }
        }
        return [$result, $this->errors];
    }

    private function addErrors($key, $val){
        $this->errors[$key] = $val;
    }
}
