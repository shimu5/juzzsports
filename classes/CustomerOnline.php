<?php

/**
 *
 * CustomerOnline class
 *
 *
 * @package     CustomerOnline
 * @category    Library
 * @author      Juzz Sports
 * @date        10-06-2014
 */

Class CustomerOnline
{

    private $ip;
    private $customerId;
    private $url;
    private $referer;
    private $dateAdded;


    /**
     * All getter and setter functions
     *
     */
    public function getIp()
    {
        return $this->ip;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getReferer()
    {
        return $this->referer;
    }

    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    public function setIp($val)
    {
        $this->ip = $val;
    }

    public function setCustomerId($val)
    {
        $this->customerId = intval($val);
    }

    public function setUrl($val)
    {
        $this->url = $val;
    }

    public function setReferer($val)
    {
        $this->referer = $val;
    }

    public function setDateAdded($val)
    {
        $this->dateAdded = $val;
    }


    /**
     * Insert and update information
     *
     * @return mixed
     *
     */


    public function save()
    {
        $result["success"] = true;
        $result["message"] = "";

        $table = "customer_online";
        $fieldset = array("ip", "customer_id", "url", "referer", "date_added");
        $valueset = array($this->getIp(), $this->getCustomerId(), $this->getUrl(), $this->getReferer(), $this->getDateAdded());

        $insert_id = 0;
        if (Connection::insertData($table, $fieldset, $valueset, $insert_id, 1)) {
            $result["success"] = true;
            $result["message"] = "Insert Successful.";
            $this->setIp($insert_id);
        } else {
            $result["success"] = false;
            $result["message"] = "Insert Failed.";
        }

        return $result;
    }


    /**
     * get data from database by id
     *
     * @return CustomerOnline
     *
     */
    public static function loadByCustomerId($customerId)
    {

        $customerId = intval($customerId);

        $objCustomerOnline = NULL;

        $table = "customer_online";
        $condition = "AND customer_id=" . $customerId;
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objCustomerOnline = new CustomerOnline();
            $objCustomerOnline->setIp($resultRow["ip"]);
            $objCustomerOnline->setCustomerId($resultRow["customer_id"]);
            $objCustomerOnline->setUrl($resultRow["url"]);
            $objCustomerOnline->setReferer($resultRow["referer"]);
            $objCustomerOnline->setDateAdded($resultRow["date_added"]);

        }

        return $objCustomerOnline;
    }


    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function load($start = 0, $limit = 0)
    {
        $start = intval($start);
        $limit = intval($limit);

        $objCustomerOnlineArr = array();

        $table = "customer_online";
        $condition = "";
        $fields = "*";

        $limitStr = "";
        if($limit){
            $limitStr = "LIMIT ".$start.", ".$limit;
        }

        $row = Connection::getAllData($table, $condition, $fields, "", $limitStr);

        if ($row) {

            foreach ($row as $resultRow) {

                $objCustomerOnline = new CustomerOnline();
                $objCustomerOnline->setIp($resultRow["ip"]);
                $objCustomerOnline->setCustomerId($resultRow["customer_id"]);
                $objCustomerOnline->setUrl($resultRow["url"]);
                $objCustomerOnline->setReferer($resultRow["referer"]);
                $objCustomerOnline->setDateAdded($resultRow["date_added"]);

                $objCustomerOnlineArr[] = $objCustomerOnline;
            }

        }

        return $objCustomerOnlineArr;
    }

    /**
     * get all count data from database
     *
     * @return no of count
     *
     */
    public static function getTotalData()
    {

        $table       = "customer_online";
        $condition  = "";


        return Connection::getCountData($table, $condition);
    }


    /**
     * delete data from database by $customerId
     *
     * @return True | False
     *
     */
    public static function deleteByCustomerId($customerId)
    {
        $customerId = intval($customerId);
        return Connection::delData("customer_online", " AND customer_id=" . $customerId);
    }

}

?>
