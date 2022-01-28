<?php

require("../modals/ContactUsModal.php");
require("./phpmailer/mail.php");
require("./validation/contactusvalidator.php");

class ContactUsController
{
    public $data;
    function __construct($post)
    {
        $this->data = $post;
    }
    function insertContactForm(){
        //server side validation
        $validator = new ContactUsValidator($_POST);
        $errors = $validator->isContactUsFormValidate();
        if (!count($errors) > 0) {
            //store attachemnet if avaialbel
            $newfilename = "";
            $target_dir = "";
            if (isset($_FILES["attachment"]) && !empty($_FILES["attachment"]["name"])) {
                $validate_error = $validator->isFileValidate($_FILES);
                if(!count($validate_error) > 0){
                    $newfilename = $_FILES["attachment"]["name"];
                    $target_dir = "../assets/attachments/" . $newfilename;
                    $file_temp_loc = $_FILES["attachment"]["tmp_name"];
                    if (!move_uploaded_file($file_temp_loc, $target_dir)) {
                        header("Location: ../errors.php?error=file failed to upload!!");
                        exit();
                    }
                }else{
                    header("Location: ../errors.php?error=File is not validate!!");
                    exit();
                }
            }
            //insert data into the database
            $this->data["filename"] = $newfilename;
            $this->data["filelocation"] = $target_dir;
            $contactModal = new ContactUsModal($this->data);
            $data = $contactModal->insertContactData();
            if (!count($data[1]) > 0) {
                //send mail to the admin
                $this->sendEmailToAdmin();
            } else {
                header("Location: ../errors.php/error=somthing went wrong");
                exit();
            }
            setcookie("contact_success","successfully", time()+3600, '/');
            header("Location: ../views/contact.php");
        }else{
            header("Location: ../errors.php/error=Form is not validated");
            exit();
        }
    }
    private function sendEmailToAdmin(){
        $name = ucwords($this->data["firstname"]." ".$this->data["lastname"]);
        date_default_timezone_set("Asia/Kolkata");
        $current_time = date("Y-m-d h:i:sa");
        $phonenumber = $this->data["phonenumber"];
        $email = $this->data["email"];
        $subject = $this->data["subject"];
        $message = strtolower($this->data["message"]);
        $html = "
            <div>
                <h1 style='border-bottom:1px solid #6e6e6e; font-weight:300;'>Contacer Detailes</h1>
                <h2 style='margin:5px 2px;'>$name <span style='color:#4287f5; font-size:14px;'>( $current_time )</span></h2>
                <h4 style='margin:5px 2px;'>Mobile: $phonenumber</h4>
                <h4 style='margin:5px 2px;'>Email: $email</h4>
                
            </div>
            <div>
                <h2 style='border-bottom:1px solid #6e6e6e; font-weight:300;'>Message</h2>
                <h3 style='color:black;'>\"$message\"</h3>
            </div>
        ";
        $attachment = ""; 
        if(!empty($this->data["filename"])){
            $attachment = $this->data["filelocation"];
            $html = $html."
                <div>
                    **You can see my attachment for more clearity**
                </div>
            ";
        }
        sendmail(Config::ADMIN_EMAIL, $subject, $html, $attachment);
    }
}
