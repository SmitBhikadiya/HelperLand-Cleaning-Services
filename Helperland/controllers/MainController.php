<?php
require("./ContactUsController.php");

if (isset($_POST["contactus"])) {
    $contact = new ContactUsController($_POST);
    //$contact->insertContactForm();
}else{
    header("Location: ../views/homepage.php");
    exit();
}
?>