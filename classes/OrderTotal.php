<?php

/**
 *
 * OrderTotal class
 *
 *
 * @package     OrderTotal
 * @category    Library
 * @author      Juzz Sports
 * @date		10-06-2014
 */

Class OrderTotal
{

    private $orderTotalId;
    private $orderId;
    private $code;
    private $title;
    private $text;
    private $value;
    private $sortOrder;



     /**
     * All getter and setter functions
     *
     */
    public function getOrderTotalId()
    {
        return $this->orderTotalId;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    public function setOrderTotalId($val)
    {
        $this->orderTotalId = intval($val);
    }

    public function setOrderId($val)
    {
        $this->orderId = intval($val);
    }

    public function setCode($val)
    {
        $this->code = $val;
    }

    public function setTitle($val)
    {
        $this->title = $val;
    }

    public function setText($val)
    {
        $this->text = $val;
    }

    public function setValue($val)
    {
        $this->value = $val;
    }

    public function setSortOrder($val)
    {
        $this->sortOrder = intval($val);
    }



     /**
     * Insert and update information
     *
     * @return mixed
     *
     */



    public function save()
    {
        $orderTotalId = intval($this->getOrderTotalId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "order_total";
        $fieldset = array("order_id","code","title","text","value","sort_order");
        $valueset = array($this->getOrderId(),$this->getCode(),$this->getTitle(),$this->getText(),$this->getValue(),$this->getSortOrder());

        if($orderTotalId > 0){
            $condition = "AND order_total_id=".$orderTotalId;
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
                $this->setOrderTotalId($insert_id);
             }else{
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
             }
        }

        return $result;

    }






     /**
     * get data from database by id
     *
     * @return OrderTotal
     *
     */
public static function loadById( $orderTotalId )
    {

        $orderTotalId  = intval($orderTotalId);

        $objOrderTotal = NULL;

        $table      = "order_total";
        $condition 	= "AND order_total_id=".$orderTotalId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objOrderTotal = new OrderTotal();
            $objOrderTotal->setOrderTotalId($resultRow["order_total_id"]);
            $objOrderTotal->setOrderId($resultRow["order_id"]);
            $objOrderTotal->setCode($resultRow["code"]);
            $objOrderTotal->setTitle($resultRow["title"]);
            $objOrderTotal->setText($resultRow["text"]);
            $objOrderTotal->setValue($resultRow["value"]);
            $objOrderTotal->setSortOrder($resultRow["sort_order"]);

        }

        return $objOrderTotal;
    }


    /**
     * get data from database by id
     *
     * @return OrderTotal
     *
     */
public static function loadByOrderId( $ordeId )
    {

        $ordeId  = intval($ordeId);

        $objOrderTotal = NULL;

        $table      = "order_total";
        $condition 	= "AND order_id=".$ordeId;
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objOrderTotal = new OrderTotal();
                $objOrderTotal->setOrderTotalId($resultRow["order_total_id"]);
                $objOrderTotal->setOrderId($resultRow["order_id"]);
                $objOrderTotal->setCode($resultRow["code"]);
                $objOrderTotal->setTitle($resultRow["title"]);
                $objOrderTotal->setText($resultRow["text"]);
                $objOrderTotal->setValue($resultRow["value"]);
                $objOrderTotal->setSortOrder($resultRow["sort_order"]);

                $objOrderTotalArr[] = $objOrderTotal;
            }

        }

        return $objOrderTotalArr;
    }





     /**
     * get all data from database
     *
     * @return Array
     *
     */
public static function load()
    {

        $objOrderTotalArr = array();

        $table      = "order_total";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objOrderTotal = new OrderTotal();
                $objOrderTotal->setOrderTotalId($resultRow["order_total_id"]);
                $objOrderTotal->setOrderId($resultRow["order_id"]);
                $objOrderTotal->setCode($resultRow["code"]);
                $objOrderTotal->setTitle($resultRow["title"]);
                $objOrderTotal->setText($resultRow["text"]);
                $objOrderTotal->setValue($resultRow["value"]);
                $objOrderTotal->setSortOrder($resultRow["sort_order"]);

                $objOrderTotalArr[] = $objOrderTotal;
            }

        }

        return $objOrderTotalArr;
    }





     /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
public static function deleteById( $orderTotalId )
    {
        $orderTotalId = intval( $orderTotalId );
        return Connection::delData("order_total", " AND order_total_id=".$orderTotalId);
    }

}
 ?>