<?php
require("ContactUsController.php");

class DefaultController{
    function homepage(){
        include("views/Homepage.php");
    }
    function faqs(){
        include("views/FAQ.php");
    }
    function about(){
        include("views/about.php");
    }
    function contact(){
        if(isset($_POST["contactus"])){
            $contact = new ContactUsController($_POST);
            $contact->insertContactForm();
            exit();
        }
        include("views/contact.php");
    }
    function price(){
        include("views/Prices.php");
    }
}
?>