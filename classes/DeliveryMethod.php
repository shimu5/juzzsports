<?php

/**
 *
 * DeliveryMethod class
 *
 *
 * @package     DeliveryMethod
 * @category    Library
 * @author      Juzz Sports
 * @date		03-06-2014
 */

Class DeliveryMethod
{

    private $deliveryMethodId;
    private $methodName;
    private $deliveryMethodCode;
    private $cost;
    private $sortOrder;
    private $status;


     /**
     * All getter and setter functions
     *
     */
    public function getDeliveryMethodId()
    {
        return $this->deliveryMethodId;
    }

    public function getMethodName()
    {
        return $this->methodName;
    }

    public function getDeliveryMethodCode()
    {
        return $this->deliveryMethodCode;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setDeliveryMethodId($val)
    {
        $this->deliveryMethodId = intval($val);
    }

    public function setMethodName($val)
    {
        $this->methodName = $val;
    }

    public function setDeliveryMethodCode($val)
    {
        $this->deliveryMethodCode = $val;
    }

    public function setCost($val)
    {
        $this->cost = floatval($val);
    }

    public function setSortOrder($val)
    {
        $this->sortOrder = intval($val);
    }

    public function setStatus($val)
    {
        $this->status = intval($val);
    }



    /**
     * Save / Update Delivery Method Information
     *
     * @return mixed
     */


    public function save()
    {
        $deliveryMethodId = intval($this->getDeliveryMethodId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "delivery_method";
        $fieldset = array("method_name","delivery_method_code","cost","sort_order","status");
        $valueset = array($this->getMethodName(),$this->getDeliveryMethodCode(),$this->getCost(),$this->getSortOrder(),$this->getStatus());

        if($deliveryMethodId > 0){
            $condition = "AND delivery_method_id=".$deliveryMethodId;
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
                $this->setDeliveryMethodId($insert_id);
             }else{
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
             }
        }

        return $result;

    }



    /**
     * Get Delivery Method Information by deliveryMethodId
     *
     * @param $deliveryMethodId
     * @return DeliveryMethod|null
     */
 public static function loadById( $deliveryMethodId )
    {

        $deliveryMethodId  = intval($deliveryMethodId);

        $objDeliveryMethod = NULL;

        $table      = "delivery_method";
        $condition 	= "AND delivery_method_id=".$deliveryMethodId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objDeliveryMethod = new DeliveryMethod();
            $objDeliveryMethod->setDeliveryMethodId($resultRow["delivery_method_id"]);
            $objDeliveryMethod->setMethodName($resultRow["method_name"]);
            $objDeliveryMethod->setDeliveryMethodCode($resultRow["delivery_method_code"]);
            $objDeliveryMethod->setCost($resultRow["cost"]);
            $objDeliveryMethod->setSortOrder($resultRow["sort_order"]);
            $objDeliveryMethod->setStatus($resultRow["status"]);

        }

        return $objDeliveryMethod;
    }

    /**
     * Get Delivery Method Information by deliveryMethodId
     *
     * @param $deliveryMethodId
     * @return DeliveryMethod|null
     */
    public static function loadByCode( $deliveryMethodCode )
    {        

        $objDeliveryMethod = NULL;       
        $table      = "delivery_method";
        $condition 	= "AND delivery_method_code='{$deliveryMethodCode}'";
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objDeliveryMethod = new DeliveryMethod();
            $objDeliveryMethod->setDeliveryMethodId($resultRow["delivery_method_id"]);
            $objDeliveryMethod->setDeliveryMethodCode($resultRow["delivery_method_code"]);
            $objDeliveryMethod->setMethodName($resultRow["method_name"]);
            $objDeliveryMethod->setCost($resultRow["cost"]);
            $objDeliveryMethod->setSortOrder($resultRow["sort_order"]);
            $objDeliveryMethod->setStatus($resultRow["status"]);

        }

        return $objDeliveryMethod;
    }

    /**
     * Get Delivery Method Information by shipping_method
     *
     * @param $deliveryMethod
     * @return DeliveryMethod|null
     */
    public static function getDeliveryMethodInfoByDeliveryMethod( $deliveryMethod)
    {

        $objDeliveryMethod = NULL;

        $table      = "delivery_method";
        $condition 	= "AND method_name LIKE '".$deliveryMethod."'";
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objDeliveryMethod = new DeliveryMethod();
            $objDeliveryMethod->setDeliveryMethodId($resultRow["delivery_method_id"]);
            $objDeliveryMethod->setDeliveryMethodCode($resultRow["delivery_method_code"]);
            $objDeliveryMethod->setMethodName($resultRow["method_name"]);
            $objDeliveryMethod->setCost($resultRow["cost"]);
            $objDeliveryMethod->setSortOrder($resultRow["sort_order"]);
            $objDeliveryMethod->setStatus($resultRow["status"]);

        }

        return $objDeliveryMethod;
    }

    /**
     * Get Delivery Method Information
     *
     * @param int $start
     * @param int $limit
     * @return array
     */
    public static function load($start = 0, $limit = 0)
    {
        $start = intval($start);
        $limit = intval($limit);

        $objDeliveryMethodArr = array();

        $table      = "delivery_method";
        $condition 	= "";
        $fields 	= "*";

        $limitStr = "";
        if($limit)
            $limitStr = " LIMIT ".$start. " , ".$limit;
        $row  	= Connection::getAllData($table, $condition, $fields, "", $limitStr);

        if( $row ) {

            foreach( $row as $resultRow ){

                $objDeliveryMethod = new DeliveryMethod();
                $objDeliveryMethod->setDeliveryMethodId($resultRow["delivery_method_id"]);
                $objDeliveryMethod->setMethodName($resultRow["method_name"]);
                $objDeliveryMethod->setDeliveryMethodCode($resultRow["delivery_method_code"]);
                $objDeliveryMethod->setCost($resultRow["cost"]);
                $objDeliveryMethod->setSortOrder($resultRow["sort_order"]);
                $objDeliveryMethod->setStatus($resultRow["status"]);

                $objDeliveryMethodArr[] = $objDeliveryMethod;
            }

        }

        return $objDeliveryMethodArr;
    }


    /**
     * Get Delivery Method Information by deliveryMethodId
     *
     * @param $deliveryMethodId
     * @return bool
     */
    public static function deleteById( $deliveryMethodId )
    {
        $deliveryMethodId = intval( $deliveryMethodId );
        return Connection::delData("delivery_method", " AND delivery_method_id=".$deliveryMethodId);
    }

    /**
     * get total number of record exist in database
     */
    public static function  getTotalDeliveryMethod()
    {
        $table      = "delivery_method";
        $condition  = "";

        return Connection::getCountData($table, $condition);

    }

    /**
     * check Delivery Method is exist or not in database
     *
     * @param $methodName
     * @param $deliveryMethodId
     * @return bool
     */
    public static function isDeliveryMethodExist($methodName,$deliveryMethodId)
    {
        $methodName        = stripform($methodName);
        $deliveryMethodId   = intval($deliveryMethodId);

        $table       = "delivery_method";
        $condition   = "AND method_name ='" . dbsafe($methodName) . "' ";
        $condition  .= ($deliveryMethodId) ? " AND delivery_method_id != ".$deliveryMethodId : '';

        return  Connection::getCountData($table, $condition);

    }

    /**
     * Disable Delivery Method
     *
     * @param $deliveryMethodId
     * @param $value
     * @return int|mixed
     */
    public static function disableDeliveryMethodById($deliveryMethodId, $value)
    {
        $deliveryMethodId   = intval($deliveryMethodId);
        $value              = intval($value);

        $table      = "delivery_method";
        $condition  = "AND delivery_method_id=" . $deliveryMethodId;
        $fields     = "*";

        // fetch result from database
        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if($resultRow){

            $objDeliveryMethod = new DeliveryMethod();
            $objDeliveryMethod->setDeliveryMethodId($resultRow["delivery_method_id"]);
            $objDeliveryMethod->setMethodName($resultRow["method_name"]);
            $objDeliveryMethod->setDeliveryMethodCode($resultRow["delivery_method_code"]);
            $objDeliveryMethod->setCost($resultRow["cost"]);
            $objDeliveryMethod->setSortOrder($resultRow["sort_order"]);
            $objDeliveryMethod->setStatus($value);

            return $objDeliveryMethod->save();
        }
        return 0;
    }

}
?>