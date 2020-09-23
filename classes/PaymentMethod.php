<?php

/**
 *
 * PaymentMethod class
 *
 *
 * @package     PaymentMethod
 * @category    Library
 * @author      Juzz Sports
 * @date		03-06-2014
 */

Class PaymentMethod
{

    private $paymentMethodId;
    private $name;
    private $status;
    private $orderStatus;
    private $sortOrder;
    private $extraCost;
    private $description;

    /**
     * Getter & Setter function
     */
    public function getPaymentMethodId()
    {
        return $this->paymentMethodId;
    }

    public function getpaymentMethodCode()
    {
        return $this->paymentMethodCode;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    public function getExtraCost()
    {
        return $this->extraCost;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setPaymentMethodId($val)
    {
        $this->paymentMethodId = intval($val);
    }

    public function setPaymentMethodCode($val)
    {
        $this->paymentMethodCode = $val;
    }

    public function setName($val)
    {
        $this->name = $val;
    }

    public function setStatus($val)
    {
        $this->status = intval($val);
    }

    public function setOrderStatus($val)
    {
        $this->orderStatus = intval($val);
    }

    public function setSortOrder($val)
    {
        $this->sortOrder = $val;
    }

    public function setExtraCost($val)
    {
        $this->extraCost = floatval($val);
    }

    public function setDescription($val)
    {
        $this->description = $val;
    }


    /**
     * Save / Update Payment Method information
     *
     * @return mixed
     */
    public function save()
    {
        $paymentMethodId = intval($this->getPaymentMethodId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "payment_method";
        $fieldset = array("name",'payment_method_code',"status","order_status","sort_order","extra_cost","description");
        $valueset = array($this->getName(),$this->getpaymentMethodCode(),$this->getStatus(),$this->getOrderStatus(),$this->getSortOrder(),$this->getExtraCost(),$this->getDescription());

        if($paymentMethodId > 0){
            $condition = "AND payment_method_id=".$paymentMethodId;
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
                $this->setPaymentMethodId($insert_id);
            }else{
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }


    /**
     * Get Payment Method information by paymentMethodId
     *
     * @param $paymentMethodId
     * @return null|PaymentMethod
     */
    public static function loadById( $paymentMethodId )
    {

        $paymentMethodId  = intval($paymentMethodId);

        $objPaymentMethod = NULL;

        $table      = "payment_method";
        $condition 	= "AND payment_method_id=".$paymentMethodId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objPaymentMethod = new PaymentMethod();
            $objPaymentMethod->setPaymentMethodId($resultRow["payment_method_id"]);
            $objPaymentMethod->setPaymentMethodCode($resultRow["payment_method_code"]);
            $objPaymentMethod->setName($resultRow["name"]);
            $objPaymentMethod->setStatus($resultRow["status"]);
            $objPaymentMethod->setOrderStatus($resultRow["order_status"]);
            $objPaymentMethod->setSortOrder($resultRow["sort_order"]);
            $objPaymentMethod->setExtraCost($resultRow["extra_cost"]);
            $objPaymentMethod->setDescription($resultRow["description"]);

        }

        return $objPaymentMethod;
    }

     /**
     * Get Payment Method information by paymentMethodId
     *
     * @param $paymentMethodCode
     * @return null|PaymentMethod
     */
    public static function loadByCode( $paymentMethodCode )
    {       
        $objPaymentMethod = NULL;

        $table      = "payment_method";
        $condition 	= "AND payment_method_code ='{$paymentMethodCode}'";
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objPaymentMethod = new PaymentMethod();
            $objPaymentMethod->setPaymentMethodId($resultRow["payment_method_id"]);
            $objPaymentMethod->setPaymentMethodCode($resultRow["payment_method_code"]);
            $objPaymentMethod->setName($resultRow["name"]);
            $objPaymentMethod->setStatus($resultRow["status"]);
            $objPaymentMethod->setOrderStatus($resultRow["order_status"]);
            $objPaymentMethod->setSortOrder($resultRow["sort_order"]);
            $objPaymentMethod->setExtraCost($resultRow["extra_cost"]);
            $objPaymentMethod->setDescription($resultRow["description"]);

        }

        return $objPaymentMethod;
    }

     /**
     * Get Payment Method information by paymentMethod
     *
     * @param $paymentMethod
     * @return null|PaymentMethod
     */
    public static function getPaymentMethodInfoByPaymentMethodName( $paymentMethod )
    {

        $objPaymentMethod = NULL;

        $table      = "payment_method";
        $condition 	= "AND name LIKE '".$paymentMethod."'";
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objPaymentMethod = new PaymentMethod();
            $objPaymentMethod->setPaymentMethodId($resultRow["payment_method_id"]);
            $objPaymentMethod->setPaymentMethodCode($resultRow["payment_method_code"]);
            $objPaymentMethod->setName($resultRow["name"]);
            $objPaymentMethod->setStatus($resultRow["status"]);
            $objPaymentMethod->setOrderStatus($resultRow["order_status"]);
            $objPaymentMethod->setSortOrder($resultRow["sort_order"]);
            $objPaymentMethod->setExtraCost($resultRow["extra_cost"]);
            $objPaymentMethod->setDescription($resultRow["description"]);

        }

        return $objPaymentMethod;
    }

    /**
     * Get Payment Method information
     *
     * @param int $start
     * @param int $limit
     * @return array
     */
    public static function load($start = 0, $limit = 0)
    {
        $start      = intval($start);
        $limit      = intval($limit);

        $objPaymentMethodArr = array();

        $table      = "payment_method";
        $condition 	= "";
        $fields 	= "*";
        $limitStr   = "";
        if($limit)
            $limitStr = " LIMIT ".$start . " , ". $limit;

        $row  	= Connection::getAllData($table, $condition, $fields, "", $limitStr);

        if( $row ) {

            foreach( $row as $resultRow ){

                $objPaymentMethod = new PaymentMethod();
                $objPaymentMethod->setPaymentMethodId($resultRow["payment_method_id"]);
                $objPaymentMethod->setPaymentMethodCode($resultRow["payment_method_code"]);
                $objPaymentMethod->setName($resultRow["name"]);
                $objPaymentMethod->setStatus($resultRow["status"]);
                $objPaymentMethod->setOrderStatus($resultRow["order_status"]);
                $objPaymentMethod->setSortOrder($resultRow["sort_order"]);
                $objPaymentMethod->setExtraCost($resultRow["extra_cost"]);
                $objPaymentMethod->setDescription($resultRow["description"]);

                $objPaymentMethodArr[] = $objPaymentMethod;
            }

        }

        return $objPaymentMethodArr;
    }


    /**
     * Delete Payment Method by paymentMethodId
     *
     * @param $paymentMethodId
     * @return bool
     */
    public static function deleteById( $paymentMethodId )
    {
        $paymentMethodId = intval( $paymentMethodId );
        return Connection::delData("payment_method", " AND payment_method_id=".$paymentMethodId);
    }


    /**
     * get total number of record exist in database
     */
    public static function  getTotalPaymentMethod()
    {
        $table      = "payment_method";
        $condition  = "";

        return Connection::getCountData($table, $condition);

    }

    /**
     * check Payment Method is exist or not in database
     *
     * @param $name
     * @param $paymentMethodId
     * @return bool
     */
    public static function isPaymentMethodExist($name,$paymentMethodId)
    {
        $name        = stripform($name);
        $paymentMethodId   = intval($paymentMethodId);

        $table       = "payment_method";
        $condition   = "AND name ='" . dbsafe($name) . "' ";
        $condition  .= ($paymentMethodId) ? " AND payment_method_id != ".$paymentMethodId : '';

        return  Connection::getCountData($table, $condition);

    }
    public static function disablePaymentMethodById($paymentMethodId, $value)
    {
        $paymentMethodId    = intval($paymentMethodId);
        $value              = intval($value);

        $table      = "payment_method";
        $condition  = "AND payment_method_id=" . $paymentMethodId;
        $fields     = "*";

        // fetch result from database
        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if($resultRow){

            $objPaymentMethod = new PaymentMethod();
            $objPaymentMethod->setPaymentMethodId($resultRow["payment_method_id"]);
            $objPaymentMethod->setPaymentMethodCode($resultRow["payment_method_code"]);
            $objPaymentMethod->setName($resultRow["name"]);
            $objPaymentMethod->setOrderStatus($resultRow["order_status"]);
            $objPaymentMethod->setSortOrder($resultRow["sort_order"]);
            $objPaymentMethod->setExtraCost($resultRow["extra_cost"]);
            $objPaymentMethod->setDescription($resultRow["description"]);
            $objPaymentMethod->setStatus($value);

            return $objPaymentMethod->save();
        }
        return 0;
    }

}
?>