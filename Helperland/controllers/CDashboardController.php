<?php
session_start();

class CDashboard
{
    public $validate;
    public $dashboardmodal;

    public function __construct()
    {
        $this->data = $_POST;
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
