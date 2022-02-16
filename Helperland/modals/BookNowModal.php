<?php
require("db_connection.php");

class BookNowModal extends Connection
{
    public $data;
    public $conn;
    public $errors = [];

    public function __construct($data)
    {
        $this->data = $data;
        $this->conn = $this->connect();
    }

    public function getPostalCode()
    {
        $zipcode = $this->data["postalcode"];
        //$sql = "SELECT zipcode.Id, city.Id, state.Id,zipcode.ZipcodeValue,city.CityName,state.StateName FROM zipcode JOIN city ON city.Id = zipcode.CityId JOIN state ON state.Id=city.StateId WHERE zipcode.ZipcodeValue = '$zipcode' ";
        $sql = "SELECT zipcode.Id, city.Id, state.Id,zipcode.ZipcodeValue,city.CityName,state.StateName FROM zipcode JOIN city ON city.Id = zipcode.CityId JOIN state ON state.Id=city.StateId JOIN useraddress ON zipcode.ZipcodeValue = useraddress.PostalCode JOIN user ON useraddress.UserId = user.UserId WHERE user.UserTypeId=2 AND useraddress.PostalCode = '$zipcode' ";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
        } else {
            $result = [];
            $this->addErrors("ZipCode", "We regret to inform you that your selected zip code is not covered by Helperland services until now!");
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

    public function getUserAddressById($addressid)
    {
        $sql = "SELECT * FROM useraddress WHERE AddressId=$addressid AND IsDeleted=0";
        $result = $this->conn->query($sql);
        if ($result) {
            if ($result->num_rows < 1) {
                $result = [];
                $this->addErrors("Address", "User address (id:$addressid) is not exits or deleted ");
            } else {
                $result = $result->fetch_assoc();
            }
        } else {
            $this->addErrors("SqlError", "SQL error : check $sql");
        }
        return [$result, $this->errors];
    }

    public function getFavoriteSP($userid, $workwithpet)
    {
        $sql = "SELECT favoriteandblocked.*, user.UserProfilePicture, concat(user.FirstName, ' ', user.LastName) AS FullName FROM favoriteandblocked JOIN user ON user.UserId = favoriteandblocked.TargetUserId WHERE user.UserId IN (SELECT favoriteandblocked.TargetUserId FROM favoriteandblocked JOIN user ON user.UserId = favoriteandblocked.UserId WHERE user.UserId = '$userid' AND user.UserTypeId = 1) AND user.IsApproved = 1 AND user.IsDeleted = 0 AND user.WorksWithPets >= $workwithpet";

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
        return $result;
    }

    public function insertUserAddress($userid, $email)
    {
        $address = $this->data["housenumber"] . ", " . $this->data["streetname"];
        $cityname = $this->data["cityname"];
        $statename = $this->data["statename"];
        $postalcode = $this->data["postalcode"];
        $mobile = $this->data["phonenumber"];
        $sql = "INSERT INTO useraddress (UserId, AddressLine1, City, State, PostalCode, Mobile, Email) VALUES ($userid, '$address', '$cityname', '$statename', '$postalcode', '$mobile', '$email') ";
        $result = $this->conn->query($sql);
        if (!$result) {
            $result = [];
            $this->addErrors("insert", "Somthing went wrong with the $sql or connection");
        } else {
            $result = $this->getUserDetailesByUserId($userid);
            if (count($result[1]) > 0) {
                $result = [];
                foreach ($result[1] as $key => $val) {
                    $this->addErrors($key, $val);
                }
            } else {
                $result = $result[0];
            }
        }
        return [$result, $this->errors];
    }

    public function isServiceAvailable($addressid, $ondate, $userid)
    {
        $address = $this->getUserAddressById($addressid);
        if (count($address[1]) > 0) {
            $result = [];
            foreach ($address[1] as $key => $val) {
                $this->addErrors($key, $val);
            }
        } else {
            $addressline = $address[0]["AddressLine1"];
            $city = $address[0]["City"];
            $state = $address[0]["State"];
            $postalcode = $address[0]["PostalCode"];
            $sql = "SELECT DATE_FORMAT(servicerequest.ServiceStartDate, '%Y-%m-%d') as ServiceStartDate, servicerequest.Status FROM servicerequest JOIN servicerequestaddress ON servicerequestaddress.ServiceRequestId = servicerequest.ServiceRequestId WHERE servicerequest.UserId = $userid AND servicerequestaddress.AddressLine1='$addressline' AND servicerequestaddress.City='$city' AND servicerequestaddress.State='$state' AND servicerequestaddress.PostalCode = $postalcode;";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                $result = $result->fetch_assoc();
                if ($result["Status"] != 5 && $result["ServiceStartDate"] == $ondate) {
                    $result = [];
                    $this->addErrors("Booked", "Another service request has been logged for this address on this date. Please select a different date.");
                }
            }
        }
        return [$result, $this->errors];
    }

    public function insertServiceRequestExtra($servicerequestid)
    {
        $sql = "";
        if (isset($this->data["extra"])) {
            $extras = +implode("", $this->data["extra"]);
            $sql = "INSERT INTO servicerequestextra (ServiceRequestId, ServiceExtraId) VALUES ($servicerequestid, $extras)";
            if (!$this->conn->query($sql)) {
                $this->addErrors("SQL", "Somthing went wrong with the $sql");
            }
        }
        return [$sql, $this->errors];
    }

    public function insertServiceRequestAddress($servicerequestid, $addressid)
    {
        $sql = "INSERT INTO servicerequestaddress (ServiceRequestId, AddressLine1, City, State, PostalCode, Mobile, Email) SELECT $servicerequestid, AddressLine1, City, State, PostalCode, Mobile, Email FROM useraddress WHERE useraddress.AddressId=$addressid";
        $result = $this->conn->query($sql);
        if (!$result) {
            $this->addErrors("SQL", "Somthing went wrong with the $sql");
        }
        return [$sql, $this->errors];
    }

    public function insertServiceRequest()
    {
        $postalcode = $this->data["postalcode"];
        $startdate = $this->data["cleaningstartdate"];
        $cleaningstarttime = $this->data["cleaningstarttime"];
        $addressid = $this->data["address"];
        $comment = $this->data["comments"];
        $success = [];

        // set data format 
        $date = new DateTime($startdate);
        $date->setTime(floor($cleaningstarttime), floor($cleaningstarttime)==$cleaningstarttime ? "00": (("0." . substr($cleaningstarttime, -1) * 60) * 100));
        $cleaningstartdate = $date->format('Y-m-d H:i:s');

        $cleaningworkinghour = $this->data["cleaningworkinghour"];
        $extrahour = 0;
        $workwitpets = 0;
        $spid = "NULL";
        $status = 0;
        $paymentdone = 1;
        $discount = 0;
        $userid = $_SESSION["userdata"]["UserId"];
        $spacceptdate = "NULL";
        $paymentdone = 1;

        if (isset($this->data["extra"])) {
            $extrahour = count($this->data["extra"]) * 0.5;
        }
        if (isset($this->data["workswithpet"])) {
            $workwitpets = 1;
        }
        if (isset($this->data["favsp"])) {
            $spid = $this->data["favsp"];
            $status = 1;
        }

        $servicehourlyrate = Config::SERVICE_HOURLY_RATE;
        $subtotal = $cleaningworkinghour * $servicehourlyrate;
        $totalpayment = $subtotal - $discount;

        $result = $this->isServiceAvailable($addressid, $startdate, $userid);
        if (count($result[1]) < 1) {
            // step 1: insert record into the servicerequest table
            $sql = "INSERT INTO servicerequest (UserId, ServiceStartDate, ZipCode, ServiceHourlyRate, ServiceHours, ExtraHours, SubTotal, Discount, TotalCost, Comments, ServiceProviderId, SPAcceptedDate, HasPets, Status, CreatedDate, PaymentDone) 
                VALUES ($userid, '$cleaningstartdate', '$postalcode', $servicehourlyrate, $cleaningworkinghour, $extrahour, $subtotal, $discount, $totalpayment, '$comment', $spid, $spacceptdate, $workwitpets, $status, now(), $paymentdone);";
            $service_req = $this->conn->query($sql);
            if (!$service_req) {
                $this->addErrors("SQL", "Somthing went wrong with the $sql");
            } else {
                array_push($success, true);
                $last_id = $this->conn->insert_id;
                // step 2: insert selected address into the servicerequestaddress table
                $address_req = $this->insertServiceRequestAddress($last_id, $addressid);
                if (count($address_req[1]) > 0) {
                    $this->addErrors("SQL", "Somthing went wrong with the $address_req[0]");
                } else {
                    array_push($success, true);
                    // step 3: insert extra service into the servicerequestextra table
                    $extras_req = $this->insertServiceRequestExtra($last_id);
                    if (count($extras_req[1]) > 0) {
                        $this->addErrors("SQL", "Somthing went wrong with the $extras_req[0]");
                    } else {
                        array_push($success, true);
                    }
                }
            }
        }else{
            array_push($success, false);
            foreach ($result[1] as $key => $val) {
                $this->addErrors($key, $val);
            }
        }
        return [$success, $this->errors];
    }


    private function addErrors($key, $val)
    {
        $this->errors[$key] = $val;
    }
}
