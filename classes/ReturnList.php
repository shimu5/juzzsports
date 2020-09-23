<?php
/**
 *
 * ReturnList class
 *
 *
 * @package     ReturnList
 * @category    Library
 * @author      Juzz Sports
 * @date		11-06-2014
 */

Class ReturnList
{

    private $returnId;
    private $orderId;
    private $productId;
    private $customerId;
    private $firstname;
    private $lastname;
    private $email;
    private $telephone;
    private $product;
    private $model;
    private $quantity;
    private $opened;
    private $returnReasonId;
    private $returnActionId;
    private $returnStatusId;
    private $comment;
    private $dateOrdered;
    private $dateAdded;
    private $dateModified;



    /**
     * All getter and setter functions
     *
     */
    public function getReturnId()
    {
        return $this->returnId;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getOpened()
    {
        return $this->opened;
    }

    public function getReturnReasonId()
    {
        return $this->returnReasonId;
    }

    public function getReturnActionId()
    {
        return $this->returnActionId;
    }

    public function getReturnStatusId()
    {
        return $this->returnStatusId;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getDateOrdered()
    {
        return $this->dateOrdered;
    }

    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    public function getDateModified()
    {
        return $this->dateModified;
    }

    public function setReturnId($val)
    {
        $this->returnId = intval($val);
    }

    public function setOrderId($val)
    {
        $this->orderId = intval($val);
    }

    public function setProductId($val)
    {
        $this->productId = intval($val);
    }

    public function setCustomerId($val)
    {
        $this->customerId = intval($val);
    }

    public function setFirstname($val)
    {
        $this->firstname = $val;
    }

    public function setLastname($val)
    {
        $this->lastname = $val;
    }

    public function setEmail($val)
    {
        $this->email = $val;
    }

    public function setTelephone($val)
    {
        $this->telephone = $val;
    }

    public function setProduct($val)
    {
        $this->product = $val;
    }

    public function setModel($val)
    {
        $this->model = $val;
    }

    public function setQuantity($val)
    {
        $this->quantity = intval($val);
    }

    public function setOpened($val)
    {
        $this->opened = intval($val);
    }

    public function setReturnReasonId($val)
    {
        $this->returnReasonId = intval($val);
    }

    public function setReturnActionId($val)
    {
        $this->returnActionId = intval($val);
    }

    public function setReturnStatusId($val)
    {
        $this->returnStatusId = intval($val);
    }

    public function setComment($val)
    {
        $this->comment = $val;
    }

    public function setDateOrdered($val)
    {
        $this->dateOrdered = $val;
    }

    public function setDateAdded($val)
    {
        $this->dateAdded = $val;
    }

    public function setDateModified($val)
    {
        $this->dateModified = $val;
    }



    /**
     * Insert and update information
     *
     * @return mixed
     *
     */



    public function save()
    {
        $returnId = intval($this->getReturnId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "return_list";
        $fieldset = array("order_id","product_id","customer_id","firstname","lastname","email","telephone","product","model","quantity","opened","return_reason_id","return_action_id","return_status_id","comment","date_ordered","date_added","date_modified");
        $valueset = array($this->getOrderId(),$this->getProductId(),$this->getCustomerId(),$this->getFirstname(),$this->getLastname(),$this->getEmail(),$this->getTelephone(),$this->getProduct(),$this->getModel(),$this->getQuantity(),$this->getOpened(),$this->getReturnReasonId(),$this->getReturnActionId(),$this->getReturnStatusId(),$this->getComment(),$this->getDateOrdered(),$this->getDateAdded(),$this->getDateModified());

        if($returnId > 0){
            $condition = "AND return_id=".$returnId;
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
                $this->setReturnId($insert_id);
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
     * @return ReturnList
     *
     */
    public static function loadById( $returnId )
    {

        $returnId  = intval($returnId);

        $objReturnList = NULL;

        $table      = "return_list";
        $condition 	= "AND return_id=".$returnId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objReturnList = new ReturnList();
            $objReturnList->setReturnId($resultRow["return_id"]);
            $objReturnList->setOrderId($resultRow["order_id"]);
            $objReturnList->setProductId($resultRow["product_id"]);
            $objReturnList->setCustomerId($resultRow["customer_id"]);
            $objReturnList->setFirstname($resultRow["firstname"]);
            $objReturnList->setLastname($resultRow["lastname"]);
            $objReturnList->setEmail($resultRow["email"]);
            $objReturnList->setTelephone($resultRow["telephone"]);
            $objReturnList->setProduct($resultRow["product"]);
            $objReturnList->setModel($resultRow["model"]);
            $objReturnList->setQuantity($resultRow["quantity"]);
            $objReturnList->setOpened($resultRow["opened"]);
            $objReturnList->setReturnReasonId($resultRow["return_reason_id"]);
            $objReturnList->setReturnActionId($resultRow["return_action_id"]);
            $objReturnList->setReturnStatusId($resultRow["return_status_id"]);
            $objReturnList->setComment($resultRow["comment"]);
            $objReturnList->setDateOrdered($resultRow["date_ordered"]);
            $objReturnList->setDateAdded($resultRow["date_added"]);
            $objReturnList->setDateModified($resultRow["date_modified"]);

        }

        return $objReturnList;
    }





    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function load($start,$limit,$conditionFilterStr)
    {
        $start = intval($start);
        $limit = intval($limit);

        $table      = "return_list OL
                       LEFT JOIN return_reason OS USING(return_reason_id)
                      ";
        $condition  = "".($conditionFilterStr ? $conditionFilterStr : "");
        $fields     = "OL.* ,OS.name as reason_name";

        $limitStr = "";
        if ($limit) {
            $limitStr = "LIMIT " . $start . ", " . $limit;
        }

        return Connection::getAllData($table, $condition, $fields, "", $limitStr);
    }

    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function getReturnRequestListByCustomerId($customerId, $start = 0, $limit = 0)
    {
        $start = intval($start);
        $limit = intval($limit);
        $customerId =intval($customerId);

        $table      = "return_list OL
                       LEFT JOIN return_status RS USING(return_status_id)
                      ";
        $condition  = "AND customer_id = ".$customerId;
        $fields     = "OL.* ,RS.name as status_name";

        $limitStr = "";
        if ($limit) {
            $limitStr = "LIMIT " . $start . ", " . $limit;
        }

        return Connection::getAllData($table, $condition, $fields, "", $limitStr);
    }
    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function getTotalRequestData($customerId)
    {
        $customerId =intval($customerId);

        $table      = "return_list OL
                       LEFT JOIN return_status RS USING(return_status_id)
                      ";
        $condition  = "AND customer_id = ".$customerId;

        return Connection::getCountData($table, $condition);
    }



    /**
     * get all return data from database
     *
     * @return Array
     *
     */
    public static function getReturnProductsListByDateRange($start,$limit,$conditionFilterStr)
    {
        $start = intval($start);
        $limit = intval($limit);

        $table      = "return_list RL";
        $condition  = "".($conditionFilterStr ? $conditionFilterStr : "");
        $fields     = "count(RL.product_id) AS total_order";

        $limitStr = "";
        if ($limit) {
            $limitStr = "LIMIT " . $start . ", " . $limit;
        }

        return Connection::getAllData($table, $condition, $fields, "", $limitStr);
    }





    /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
    public static function deleteById( $returnId )
    {
        $returnId = intval( $returnId );
        return Connection::delData("return_list", " AND return_id=".$returnId);
    }

    /**
     * get total number of record exist in database
     */
    public static function  getTotalData()
    {
        $table      = "return_list";
        $condition  = "";
        return Connection::getCountData($table, $condition);

    }

}
?>