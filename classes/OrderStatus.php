<?php

/**
 *
 * OrderStatus class
 *
 *
 * @package     OrderStatus
 * @category    Library
 * @author      Juzz Sports
 * @date		04-06-2014
 */

Class OrderStatus
{

    private $orderStatusId;
    private $statusName;
    private $isActive;

    /**
     * Getter & Setter function
     */
    public function getOrderStatusId()
    {
        return $this->orderStatusId;
    }

    public function getStatusName()
    {
        return $this->statusName;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setOrderStatusId($val)
    {
        $this->orderStatusId = intval($val);
    }

    public function setStatusName($val)
    {
        $this->statusName = $val;
    }

    public function setIsActive($val)
    {
        $this->isActive = intval($val);
    }


    /**
     * Save / Update order status
     */
    public function save()
    {
        $orderStatusId = intval($this->getOrderStatusId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "order_status";
        $fieldset = array("status_name","is_active");
        $valueset = array($this->getStatusName(),$this->getIsActive());

        if($orderStatusId > 0){
            $condition = "AND order_status_id=".$orderStatusId;
            if(Connection::updateData($table,$fieldset,$valueset,$condition)){
                $result["success"] = true;
                $result["message"] = "Update Successful.";
            }else {
                $result["success"] = false;
                $result["message"] = "Update Failed.";
            }
        }
        else{
            $insert_id = 0;
            if(Connection::insertData($table,$fieldset,$valueset,$insert_id)){
                $result["success"] = true;
                $result["message"] = "Insert Successful.";
                $this->setOrderStatusId($insert_id);
            }else{
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }


    /**
     * Get Order status by orderStatusId
     *
     * @param $orderStatusId
     * @return null|OrderStatus
     */
    public static function loadById( $orderStatusId )
    {

        $orderStatusId  = intval($orderStatusId);

        $objOrderStatus = NULL;

        $table      = "order_status";
        $condition 	= "AND order_status_id=".$orderStatusId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objOrderStatus = new OrderStatus();
            $objOrderStatus->setOrderStatusId($resultRow["order_status_id"]);
            $objOrderStatus->setStatusName($resultRow["status_name"]);
            $objOrderStatus->setIsActive($resultRow["is_active"]);

        }

        return $objOrderStatus;
    }


    /**
     * Get all Order status
     * @return array of order_status_id & status_name
     */
    public static function load()
    {

        $objOrderStatusArr = array();

        $table      = "order_status";
        $condition 	= "";
        $fields 	= "order_status_id,status_name";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");
        $objOrderStatusArr = array();
        if( $row ) {
            foreach( $row as $resultRow ){
                $objOrderStatusArr[$resultRow["order_status_id"]] = $resultRow["status_name"];
            }
        }
        return $objOrderStatusArr;
    }


    /**
     * Delete Order Status
     * @param $orderStatusId
     * @return bool
     */
    public static function deleteById( $orderStatusId )
    {
        $orderStatusId = intval( $orderStatusId );
        return Connection::delData("order_status", " AND order_status_id=".$orderStatusId);
    }

}
?>