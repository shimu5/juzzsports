<?php

/**
 *
 * Store class
 *
 *
 * @package     Store
 * @category    Library
 * @author      Juzz Sports
 * @date        02-06-2014
 */

Class Store
{

    private $storeId;
    private $name;
    private $address;
    private $telephone;
    private $created;
    private $isActive;

    /**
     * All getter and setter functions
     * @return mixed     *
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setStoreId($val)
    {
        $this->storeId = intval($val);
    }

    public function setName($val)
    {
        $this->name = $val;
    }

    public function setAddress($val)
    {
        $this->address = $val;
    }

    public function setTelephone($val)
    {
        $this->telephone = $val;
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
     *
     * @return mixed
     */
    public function save()
    {
        $storeId = intval($this->getStoreId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "store";
        $fieldset = array("name", "address", "telephone", "created", "is_active");
        $valueset = array($this->getName(), $this->getAddress(), $this->getTelephone(), $this->getCreated(), $this->getIsActive());

        if ($storeId > 0) {
            $condition = "AND store_id=" . $storeId;
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
                $this->setStoreId($insert_id);
            } else {
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }

    /**
     * get store info by store id
     *
     * @param $storeId
     * @return null|Store
     */
    public static function loadById($storeId)
    {

        $storeId = intval($storeId);

        $objStore = NULL;

        $table = "store";
        $condition = "AND store_id=" . $storeId;
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objStore = new Store();
            $objStore->setStoreId($resultRow["store_id"]);
            $objStore->setName($resultRow["name"]);
            $objStore->setAddress($resultRow["address"]);
            $objStore->setTelephone($resultRow["telephone"]);
            $objStore->setCreated($resultRow["created"]);
            $objStore->setIsActive($resultRow["is_active"]);

        }

        return $objStore;
    }

    /**
     * get all store info
     *
     * @return array
     */
    public static function load($start = 0, $limit = 0)
    {
        $start = intval($start);
        $limit = intval($limit);

        $objStoreArr = array();

        $table = "store";
        $condition = "";
        $fields = "*";

        $limitStr = "";
        if($limit){
            $limitStr = "LIMIT ".$start.", ".$limit;
        }

        $row = Connection::getAllData($table, $condition, $fields, "", $limitStr);

        if ($row) {

            foreach ($row as $resultRow) {

                $objStore = new Store();
                $objStore->setStoreId($resultRow["store_id"]);
                $objStore->setName($resultRow["name"]);
                $objStore->setAddress($resultRow["address"]);
                $objStore->setTelephone($resultRow["telephone"]);
                $objStore->setCreated($resultRow["created"]);
                $objStore->setIsActive($resultRow["is_active"]);

                $objStoreArr[] = $objStore;
            }

        }

        return $objStoreArr;
    }

    /**
     * delete store information by store id
     *
     * @param $storeId
     * @return bool
     */
    public static function deleteById($storeId)
    {
        $storeId = intval($storeId);
        return Connection::delData("store", " AND store_id=" . $storeId);
    }

    /**
     * delete store information by store id
     *
     * @param $storeId
     * @return bool
     */
    public static function isStoreExist($storeName, $storeId)
    {
        $table      = "store";
        $condition  = "AND name LIKE '".$storeName."'".($storeId ? " AND store_id !=".$storeId : "");

        return Connection::getCountData($table, $condition);
    }

    /**
     * get total store information
     *
     * @param
     * @return int
     */
    public static function getTotalStore()
    {
        $table      = "store";
        $condition  = "";

        return Connection::getCountData($table, $condition);
    }

}

?>