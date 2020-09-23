<?php

/**
 *
 * OrderHistory class
 *
 *
 * @package     OrderHistory
 * @category    Library
 * @author      Juzz Sports
 * @date        10-06-2014
 */

Class OrderHistory
{

    private $orderHistoryId;
    private $orderId;
    private $orderStatusId;
    private $notify;
    private $comment;
    private $dateAdded;


    /**
     * All getter and setter functions
     *
     */
    public function getOrderHistoryId()
    {
        return $this->orderHistoryId;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getOrderStatusId()
    {
        return $this->orderStatusId;
    }

    public function getNotify()
    {
        return $this->notify;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    public function setOrderHistoryId($val)
    {
        $this->orderHistoryId = intval($val);
    }

    public function setOrderId($val)
    {
        $this->orderId = intval($val);
    }

    public function setOrderStatusId($val)
    {
        $this->orderStatusId = intval($val);
    }

    public function setNotify($val)
    {
        $this->notify = intval($val);
    }

    public function setComment($val)
    {
        $this->comment = $val;
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
        $orderHistoryId = intval($this->getOrderHistoryId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "order_history";
        $fieldset = array("order_id", "order_status_id", "notify", "comment", "date_added");
        $valueset = array($this->getOrderId(), $this->getOrderStatusId(), $this->getNotify(), $this->getComment(), $this->getDateAdded());

        if ($orderHistoryId > 0) {
            $condition = "AND order_history_id=" . $orderHistoryId;
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
                $this->setOrderHistoryId($insert_id);
            } else {
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }


    /**
     * get data from database by id
     *
     * @return OrderHistory
     *
     */
    public static function loadById($orderHistoryId)
    {

        $orderHistoryId = intval($orderHistoryId);

        $objOrderHistory = NULL;

        $table = "order_history";
        $condition = "AND order_history_id=" . $orderHistoryId;
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objOrderHistory = new OrderHistory();
            $objOrderHistory->setOrderHistoryId($resultRow["order_history_id"]);
            $objOrderHistory->setOrderId($resultRow["order_id"]);
            $objOrderHistory->setOrderStatusId($resultRow["order_status_id"]);
            $objOrderHistory->setNotify($resultRow["notify"]);
            $objOrderHistory->setComment($resultRow["comment"]);
            $objOrderHistory->setDateAdded($resultRow["date_added"]);

        }

        return $objOrderHistory;
    }


    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function load()
    {

        $objOrderHistoryArr = array();

        $table = "order_history";
        $condition = "";
        $fields = "*";

        $row = Connection::getAllData($table, $condition, $fields, "", "");

        if ($row) {

            foreach ($row as $resultRow) {

                $objOrderHistory = new OrderHistory();
                $objOrderHistory->setOrderHistoryId($resultRow["order_history_id"]);
                $objOrderHistory->setOrderId($resultRow["order_id"]);
                $objOrderHistory->setOrderStatusId($resultRow["order_status_id"]);
                $objOrderHistory->setNotify($resultRow["notify"]);
                $objOrderHistory->setComment($resultRow["comment"]);
                $objOrderHistory->setDateAdded($resultRow["date_added"]);

                $objOrderHistoryArr[] = $objOrderHistory;
            }

        }

        return $objOrderHistoryArr;
    }


    /**
     * get all data from database by order id
     *
     * @return Array
     *
     */
    public static function getOrderProductHistoryByOrderId($orderId)
    {
        $orderId = intval($orderId);

        $objOrderHistory = null;

        $table = "order_history";
        $condition = "AND order_id = " . $orderId;
        $fields = "*";

        $resultRow = Connection::getAllData($table, $condition, $fields, "", "");

        if ($resultRow) {
            $objOrderHistory = new OrderHistory();
            $objOrderHistory->setOrderHistoryId($resultRow["order_history_id"]);
            $objOrderHistory->setOrderId($resultRow["order_id"]);
            $objOrderHistory->setOrderStatusId($resultRow["order_status_id"]);
            $objOrderHistory->setNotify($resultRow["notify"]);
            $objOrderHistory->setComment($resultRow["comment"]);
            $objOrderHistory->setDateAdded($resultRow["date_added"]);
        }

        return $objOrderHistory;
    }


    /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
    public static function deleteById($orderHistoryId)
    {
        $orderHistoryId = intval($orderHistoryId);
        return Connection::delData("order_history", " AND order_history_id=" . $orderHistoryId);
    }

    /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
    public static function deleteByOrderId($orderId)
    {
        $orderId = intval($orderId);
        return Connection::delData("order_history", " AND order_id=" . $orderId);
    }

}

?>