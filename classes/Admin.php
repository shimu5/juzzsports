<?php

/**
 *
 * Admin class
 *
 *
 * @package     Admin
 * @category    Library
 * @author      Juzz Sports
 * @date        28-05-2014
 */
define('SALT', 'SD0796SDF87B890JK89RBMLEJIEW');
Class Admin
{

    private $id;
    private $userName;
    private $password;
    private $fullName;
    private $userType;
    private $isActive;

    /**
     * all getter and setter functions
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setId($val)
    {
        $this->id = intval($val);
    }

    public function setUserName($val)
    {
        $this->userName = $val;
    }

    public function setPassword($val)
    {
        $this->password = $val;
    }

    public function setFullName($val)
    {
        $this->fullName = $val;
    }

    public function setUserType($val)
    {
        $this->userType = intval($val);
    }

    public function setIsActive($val)
    {
        $this->isActive = intval($val);
    }


    /**
     * insert and update data
     */
    public function save()
    {
        $id = intval($this->getId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "admin";
        $fieldset = array("user_name", "password", "full_name", "user_type", "is_active");
        $valueset = array($this->getUserName(), $this->getPassword(), $this->getFullName(), $this->getUserType(), $this->getIsActive());

        if ($id > 0) {
            $condition = "AND id=" . $id;
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
                $this->setId($insert_id);
            } else {
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }

    /**
     * Admin Login Check
     * We can check by userId and password
     *
     * @param	int $userId
     * @param	sha1 $password
     *
     * @return	bool - true on success otherwise false
     */
    public static function adminLogin( $adminName, $password )
    {
        $objAdmin = Admin::loadByAdminName( $adminName );

        if($objAdmin){
            if( strcmp($objAdmin->getPassword(), $password) == 0)
                return true;
        }

        return false;
    }

    /**
     * Get Admin Info by adminName
     *
     * @param	str		- $adminName
     * @return	Admin Admin object or NULL if unable to locate
     */
    public static function loadByAdminName( $adminName )
    {
        $objAdmin = NULL;

        $table 		= "admin";
        $condition 	= "AND user_name ='".dbsafe($adminName)."'";
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if($resultRow) {
            $objAdmin = new Admin();
            $objAdmin->setId($resultRow["id"]);
            $objAdmin->setUserName($resultRow["user_name"]);
            $objAdmin->setPassword($resultRow["password"]);
            $objAdmin->setFullName($resultRow["full_name"]);
            $objAdmin->setUserType($resultRow["user_type"]);
            $objAdmin->setIsActive($resultRow["is_active"]);
        }

        return $objAdmin;
    }


    /**
     * Load admin by admin id
     *
     * @param $id
     * @return Admin|null
     */
    public static function loadById($id)
    {

        $id = intval($id);

        $objAdmin = NULL;

        $table = "admin";
        $condition = "AND id=" . $id;
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objAdmin = new Admin();
            $objAdmin->setId($resultRow["id"]);
            $objAdmin->setUserName($resultRow["user_name"]);
            $objAdmin->setPassword($resultRow["password"]);
            $objAdmin->setFullName($resultRow["full_name"]);
            $objAdmin->setUserType($resultRow["user_type"]);
            $objAdmin->setIsActive($resultRow["is_active"]);

        }

        return $objAdmin;
    }


    /**
     * Get all admin list
     *
     * @return array
     */
    public static function load()
    {

        $objAdminArr = array();

        $table = "admin";
        $condition = "";
        $fields = "*";

        $row = Connection::getAllData($table, $condition, $fields, "", "");

        if ($row) {

            foreach ($row as $resultRow) {

                $objAdmin = new Admin();
                $objAdmin->setId($resultRow["id"]);
                $objAdmin->setUserName($resultRow["user_name"]);
                $objAdmin->setPassword($resultRow["password"]);
                $objAdmin->setFullName($resultRow["full_name"]);
                $objAdmin->setUserType($resultRow["user_type"]);
                $objAdmin->setIsActive($resultRow["is_active"]);

                $objAdminArr[] = $objAdmin;
            }

        }

        return $objAdminArr;
    }


    /**
     * delete admin by admin id
     *
     * @param $id
     * @return bool
     */
    public static function deleteById($id)
    {
        $id = intval($id);
        return Connection::delData("admin", " AND id=" . $id);
    }

}

?>