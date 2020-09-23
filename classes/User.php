<?php
/**
 *
 * User class
 *
 *
 * @package     User
 * @category    Library
 * @author      Juzz Sports
 * @date        29-05-2014
 */

Class User
{

    private $userId;
    private $userTypeId;
    private $username;
    private $password;
    private $salt;
    private $firstName;
    private $lastName;
    private $email;
    private $code;
    private $ip;
    private $created;
    private $isActive;

    /**
     * All getter and setter functions
     */
    public function getUserId()
    {
        return $this->userId;
    }

    public function getUserTypeId()
    {
        return $this->userTypeId;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setUserId($val)
    {
        $this->userId = intval($val);
    }

    public function setUserTypeId($val)
    {
        $this->userTypeId = intval($val);
    }

    public function setUsername($val)
    {
        $this->username = $val;
    }

    public function setPassword($val)
    {
        $this->password = $val;
    }

    public function setSalt($val)
    {
        $this->salt = $val;
    }

    public function setFirstName($val)
    {
        $this->firstName = $val;
    }

    public function setLastName($val)
    {
        $this->lastName = $val;
    }

    public function setEmail($val)
    {
        $this->email = $val;
    }

    public function setCode($val)
    {
        $this->code = $val;
    }

    public function setIp($val)
    {
        $this->ip = $val;
    }

    public function setCreated($val)
    {
        $this->created = $val;
    }

    public function setIsActive($val)
    {
        $this->isActive = intval($val);
    }


    /**
     * Insert and update function
     */
    public function save()
    {
        $userId = intval($this->getUserId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "user";
        $fieldset = array("user_type_id", "username", "password", "salt", "first_name", "last_name", "email", "code", "ip", "created", "is_active");
        $valueset = array($this->getUserTypeId(), $this->getUsername(), $this->getPassword(), $this->getSalt(), $this->getFirstName(), $this->getLastName(), $this->getEmail(), $this->getCode(), $this->getIp(), $this->getCreated(), $this->getIsActive());

        if ($userId > 0) {
            $condition = "AND user_id=" . $userId;
            if (Connection::updateData($table, $fieldset, $valueset, $condition)) {
                $result["success"] = true;
                $result["message"] = "Update Successful.";
            } else {
                $result["success"] = false;
                $result["message"] = "Update Failed.";
            }
        } else {
            $insert_id = 0;
            if (Connection::insertData($table, $fieldset, $valueset, $insert_id)) {
                $result["success"] = true;
                $result["message"] = "Insert Successful.";
                $this->setUserId($insert_id);
            } else {
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }

    /**
     * get user information by user id
     *
     * @param $userId
     * @return null|User
     */
    public static function loadById($userId)
    {

        $userId = intval($userId);

        $objUser = NULL;

        $table = "user";
        $condition = "AND user_id=" . $userId;
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objUser = new User();
            $objUser->setUserId($resultRow["user_id"]);
            $objUser->setUserTypeId($resultRow["user_type_id"]);
            $objUser->setUsername($resultRow["username"]);
            $objUser->setPassword($resultRow["password"]);
            $objUser->setSalt($resultRow["salt"]);
            $objUser->setFirstName($resultRow["first_name"]);
            $objUser->setLastName($resultRow["last_name"]);
            $objUser->setEmail($resultRow["email"]);
            $objUser->setCode($resultRow["code"]);
            $objUser->setIp($resultRow["ip"]);
            $objUser->setCreated($resultRow["created"]);
            $objUser->setIsActive($resultRow["is_active"]);

        }

        return $objUser;
    }

    /**
     * get all user information
     *
     * @return array
     */
    public static function load()
    {

        $objUserArr = array();

        $table = "user";
        $condition = "";
        $fields = "*";

        $row = Connection::getAllData($table, $condition, $fields, "", "");

        if ($row) {

            foreach ($row as $resultRow) {

                $objUser = new User();
                $objUser->setUserId($resultRow["user_id"]);
                $objUser->setUserTypeId($resultRow["user_type_id"]);
                $objUser->setUsername($resultRow["username"]);
                $objUser->setPassword($resultRow["password"]);
                $objUser->setSalt($resultRow["salt"]);
                $objUser->setFirstName($resultRow["first_name"]);
                $objUser->setLastName($resultRow["last_name"]);
                $objUser->setEmail($resultRow["email"]);
                $objUser->setCode($resultRow["code"]);
                $objUser->setIp($resultRow["ip"]);
                $objUser->setCreated($resultRow["created"]);
                $objUser->setIsActive($resultRow["is_active"]);

                $objUserArr[] = $objUser;
            }

        }

        return $objUserArr;
    }

    /**
     * delete user by user id (primary key)
     *
     * @param $userId
     * @return bool
     */
    public static function deleteById($userId)
    {
        $userId = intval($userId);
        return Connection::delData("user", " AND user_id=" . $userId);
    }

    /**
     * Customer Login Check
     * We can check by customerEmail and password
     *
     * @param	int $customerEmail
     * @param	sha1 $password
     *
     * @return	bool - true on success otherwise false
     */
    public static function customerLogin( $customerEmail, $password )
    {
        $objUser = User::loadByCustomerEmail( $customerEmail );

        if($objUser){
            if( strcmp($objUser->getPassword(), $password) == 0)
                return true;
        }

        return false;
    }

    /**
     * Get Admin Info by $customerEmail
     *
     * @param	str		- $customerEmail
     * @return	User User object or NULL if unable to locate
     */
    public static function loadByCustomerEmail( $customerEmail )
    {
        $objUser = NULL;

        $table 		= "user";
        $condition 	= "AND email LIKE '".dbsafe($customerEmail)."'";
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if($resultRow) {
            $objUser = new User();
            $objUser->setUserId($resultRow["user_id"]);
            $objUser->setUserTypeId($resultRow["user_type_id"]);
            $objUser->setUsername($resultRow["username"]);
            $objUser->setPassword($resultRow["password"]);
            $objUser->setSalt($resultRow["salt"]);
            $objUser->setFirstName($resultRow["first_name"]);
            $objUser->setLastName($resultRow["last_name"]);
            $objUser->setEmail($resultRow["email"]);
            $objUser->setCode($resultRow["code"]);
            $objUser->setIp($resultRow["ip"]);
            $objUser->setCreated($resultRow["created"]);
            $objUser->setIsActive($resultRow["is_active"]);
        }

        return $objUser;
    }

}

?>