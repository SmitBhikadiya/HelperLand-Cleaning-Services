<?php
require_once("db_connection.php");

class UsersModal extends Connection
{
    public $data;
    public $conn;
    public $errors = [];

    public function __construct($data)
    {
        $this->data = $data;
        $this->conn = $this->connect();
    }

    public function getUserDetailes($user, $pass)
    {

        $result = $this->getUserByEmail($user);
        if(count($result) <= 0){
            $_SESSION["error"] = array($user, "User is not exits!! create a new account");
            header("Location: " . Config::BASE_URL . "?controller=Default&function=homepage&parameter=loginmodal");
            exit();
        }
        else if(!password_verify($pass, $result["Password"])) {
            $_SESSION["error"] = array($user, "Username or Password is incorrect!!!");
            header("Location: " . Config::BASE_URL . "?controller=Default&function=homepage&parameter=loginmodal");
            exit();
        }

        return [$result, $this->errors];
    }

    public function insertUser()
    {
        $data = $this->data;
        $fname = trim($data["FirstName"]);
        $lname = trim($data["LastName"]);
        $email = trim($data["Email"]);
        $mobile = trim($data["Mobile"]);
        $usertypeid = intval(trim($data["UserTypeId"]));
        $is_approved = 0;

        // IF USER TYPE IS CUSTOMER THEN SET APPROVED BY DEFAULT
        if ($usertypeid == Config::USER_TYPE_IDS[0]) {
            $is_approved = 1;
            $userlocation = "user_registration";
        }else if($usertypeid == Config::USER_TYPE_IDS[1]){
            $userlocation = "servicer_registration";
        }else{
            $userlocation = "homepage";
        }

        // PASSWORD ENCRYPTION
        $password = password_hash(trim($data["Password"]), PASSWORD_DEFAULT);
        
        // EXECUTE QUERY
        $result = $this->getUserByEmail($email);
        if (!count($result) > 0) {
            $sql = "INSERT INTO user (FirstName, LastName, Email, Password, Mobile, UserTypeId, CreatedDate, IsApproved) 
                    VALUES ('$fname', '$lname', '$email', '$password', '$mobile', '$usertypeid', now(), $is_approved)";
            $result = $this->conn->query($sql);
            if (!$result) {
                $this->addErrors("insert", "Somthing went wrong with the $sql or connection");
            }
        }else{
            $_SESSION["error"] = array($email, "$email is already exists!! try to signin!!");
            header("Location: " . Config::BASE_URL . "?controller=Default&function=$userlocation");
            exit();
        }
        return [$result, $this->errors];
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE Email='$email'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return [];
        }
    }

    
    public function getUserByUserId($userid)
    {
        $sql = "SELECT * FROM user WHERE UserId=$userid";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return [];
        }
    }

    public function isUserVerified($user){
        $sql = "SELECT * FROM user WHERE Email='$user' AND IsApproved=1";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function changePassword($email, $psw){
        $password = password_hash($psw, PASSWORD_DEFAULT);
        $sql ="UPDATE user SET Password='$password' WHERE Email='$email'";
        $result = $this->conn->query($sql);
        if($result){
            return 1;
        }else{
            return 0;
        }
    }

    public function getUserAddressById($addid){
        $sql = "SELECT * FROM useraddress WHERE AddressId=$addid AND IsDeleted=0";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }else{
            return [];
        }
    }

    public function getCityByPostal($postal){
        $sql = "SELECT city.CityName, state.StateName FROM city JOIN zipcode ON zipcode.CityId = city.Id JOIN state ON state.Id = city.StateId WHERE zipcode.ZipcodeValue = $postal";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }else{
            return [];
        }
    }

    public function updateUserAddress($userid, $addid){
        $addline1 = trim($this->data["housenumber"]);
        $addline2 = trim($this->data["streetname"]);
        $postalcode = $this->data["postalcode"];
        $mobile = $this->data["mobile"];
        $result = $this->getCityByPostal($postalcode);
        if(count($result) > 0){
            $city = $result["CityName"];
            $state = $result["StateName"];
            $sql = "UPDATE useraddress SET AddressLine1='$addline1', AddressLine2='$addline2', City='$city', State='$state', PostalCode='$postalcode', Mobile='$mobile' WHERE UserId=$userid AND AddressId=$addid AND IsDeleted=0";
            $result = $this->conn->query($sql);
        }else{
            $this->addErrors("NotFound", "City or State is not found!!!");            
        }
        return [$result, $this->errors];
    }

    public function isExistsUserAddress($userid, $addid){
        $sql = "SELECT * FROM useraddress WHERE UserId=$userid AND AddressId=$addid AND IsDeleted=0";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $result = $result->fetch_assoc();
        }else{
            $result = [];
        }
        return $result;
    }

    public function insertUserAddress($userid, $email)
    {
        $addline1 = trim($this->data["housenumber"]);
        $addline2 = trim($this->data["streetname"]);
        $postalcode = $this->data["postalcode"];
        $mobile = $this->data["mobile"];
        $sql = "INSERT INTO useraddress (UserId, AddressLine1, AddressLine2, PostalCode, Mobile, Email, City, State) SELECT $userid, '$addline1', '$addline2', '$postalcode', '$mobile', '$email', city.CityName, state.StateName FROM  city JOIN zipcode ON city.Id = zipcode.CityId JOIN state ON state.Id = city.StateId  WHERE zipcode.ZipcodeValue = $postalcode";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function getAllUserAddressByUserId($userid)
    {
        $sql = "SELECT * FROM useraddress WHERE IsDeleted=0 AND UserId=$userid";
        $result = $this->conn->query($sql);
        $rows = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($rows, $row);
            }
            $result = $rows;
        } else {
            $result = [];
        }
        return [$result, $this->errors];
    }

    public function getUserDetailesByUserId($userid)
    {
        $postalcode = $this->data["postalcode"];
        $sql = "SELECT user.UserTypeId, useraddress.* FROM user JOIN useraddress ON user.UserId = useraddress.UserId WHERE  useraddress.PostalCode='$postalcode' AND useraddress.IsDeleted=0  AND user.UserTypeId = 1 AND user.UserId = '$userid'";
        $result = $this->conn->query($sql);
        $rows = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($rows, $row);
            }
            $result = $rows;
        } else {
            $result = [];
        }
        return [$result, $this->errors];
    }
    

    public function UpdateUserDetailes(){
        $userid = $this->data["userid"];
        $email = $this->data["Email"];
        $firstname = $this->data["FirstName"];
        $lastname = $this->data["LastName"];
        $phonenumber = $this->data["PhoneNumber"];
        $date = new DateTime($this->data["BirthDate"]);
        $dob = empty($this->data["BirthDate"]) ? "NULL" : $date->format('Y-m-d H:i:s');;
        $sql = "UPDATE user SET FirstName='$firstname', LastName='$lastname', Mobile='$phonenumber', DateOfBirth='$dob' WHERE UserId=$userid AND Email='$email'";
        $result = $this->conn->query($sql);
        if($result){
            return 1;
        }else{
            return 0;
        }
    }

    public function DeleteUserAddress($userid, $addid){
        $sql = "UPDATE useraddress SET IsDeleted=1 WHERE UserId=$userid AND AddressId=$addid";
        $result = $this->conn->query($sql);
        return $result;
    }

    private function addErrors($key, $val)
    {
        $this->errors[$key] = $val;
    }
}
