<?php
require("db_connection.php");

class ContactUsModal extends Connection
{
    public $data;
    public $errors = [];

    public function __construct($data){
        $this->data = $data;
        $this->conn = $this->connect();
    }

    private function addErrors($key, $val){
        $this->errors[$key] = $val;
    }
}
