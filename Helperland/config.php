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
    const SMTP_EMAIL = "sbhikadiya892@rku.ac.in";
    const SMTP_PASS = "99041Sm04581it";
}
?>