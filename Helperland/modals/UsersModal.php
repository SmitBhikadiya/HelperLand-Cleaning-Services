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

    public function getUserDetailes()
    {

        $user = trim($this->data["UserName"]);
        $pass = trim($this->data["Password"]);

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

    public function getUserByEmail($user)
    {
        $sql = "SELECT * FROM user WHERE Email='$user'";
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

    private function addErrors($key, $val)
    {
        $this->errors[$key] = $val;
    }
}
