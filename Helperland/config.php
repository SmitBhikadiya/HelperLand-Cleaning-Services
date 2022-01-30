<?php 
class Config{
    
    /*------------ Database Constant ------------*/
    const DB_HOST = "localhost";
    const DB_USER = "root";
    const DB_PASS = "";
    const DB_NAME = "helperland";
    
    /*------------ Users Constant--------------*/
    const SESSION_DESTROY_TIME = 60*60*1; // 1 hour (60sec * 60min * 1hour)
    const USER_TYPE = ["customer", "servicer", "admin"];

    /*------------- FOR SMTP --------------*/
    const SMTP_HOST = "smtp.gmail.com";
    
    //Enter Email and Password to activate smtp service
    const SMTP_EMAIL = "";
    const SMTP_PASS = "";
    
    /*-------------Contact US ------------*/
    const SUBJECT_TYPE = ['general', 'inquiry', 'renewal', 'revocation'];
    const MESSAGE_MAX_LENGTH = 250; // 250 characters long

    /*-------------- File Upload Validation ----------------*/
    const FILE_MAX_SIZE = 1*1024*1024*4; //(bit*byte*kb*mb) max_size = 4mb
    const FILE_EXTENSION = ['jpg', 'jpeg', 'png', 'docx', 'pdf', 'gif'];

    /*---------------- Application Leval Constant --------------------*/
    const ADMIN_EMAIL = "sbhikadiya892@rku.ac.in";
    const BASE_URL = "http://localhost/Tatvasoft-PSD-TO-HTML/HelperLand/";
}
?>