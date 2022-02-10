<?php
require("db_connection.php");

class BookNowModal extends Connection
{
    public $data;
    public $conn;
    public $errors = [];

    public function __construct($data){
        $this->data = $data;
        $this->conn = $this->connect();
    }

    public function getPostalCode(){
        $zipcode = $this->data["postalcode"];
        $sql = "SELECT * FROM zipcode WHERE ZipCodeValue='$zipcode'";
        $result = $this->conn->query($sql);
        if($result->num_rows < 1){
            $result = [];
        }else{
            $result = $result->fetch_assoc(); 
        }
        return $result;
    }

    private function addErrors($key, $val){
        $this->errors[$key] = $val;
    }
}