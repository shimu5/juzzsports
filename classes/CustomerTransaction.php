<?php
/**
 *
 * CustomerTransaction class
 *
 *
 * @package     CustomerTransaction
 * @category    Library
 * @author      Juzz Sports
 * @date		10-06-2014
 */

Class CustomerTransaction
{

    private $customerTransactionId;
    private $customerId;
    private $orderId;
    private $description;
    private $amount;
    private $dateAdded;



    /**
     * All getter and setter functions
     *
     */
    public function getCustomerTransactionId()
    {
        return $this->customerTransactionId;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    public function setCustomerTransactionId($val)
    {
        $this->customerTransactionId = intval($val);
    }

    public function setCustomerId($val)
    {
        $this->customerId = intval($val);
    }

    public function setOrderId($val)
    {
        $this->orderId = intval($val);
    }

    public function setDescription($val)
    {
        $this->description = $val;
    }

    public function setAmount($val)
    {
        $this->amount = $val;
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
        $customerTransactionId = intval($this->getCustomerTransactionId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "customer_transaction";
        $fieldset = array("customer_id","order_id","description","amount","date_added");
        $valueset = array($this->getCustomerId(),$this->getOrderId(),$this->getDescription(),$this->getAmount(),$this->getDateAdded());

        if($customerTransactionId > 0){
            $condition = "AND customer_transaction_id=".$customerTransactionId;
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
                $this->setCustomerTransactionId($insert_id);
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
     * @param $customerTransactionId
     * @return CustomerTransaction|null
     */
    public static function loadById( $customerTransactionId )
    {

        $customerTransactionId  = intval($customerTransactionId);

        $objCustomerTransaction = NULL;

        $table      = "customer_transaction";
        $condition 	= "AND customer_transaction_id=".$customerTransactionId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objCustomerTransaction = new CustomerTransaction();
            $objCustomerTransaction->setCustomerTransactionId($resultRow["customer_transaction_id"]);
            $objCustomerTransaction->setCustomerId($resultRow["customer_id"]);
            $objCustomerTransaction->setOrderId($resultRow["order_id"]);
            $objCustomerTransaction->setDescription($resultRow["description"]);
            $objCustomerTransaction->setAmount($resultRow["amount"]);
            $objCustomerTransaction->setDateAdded($resultRow["date_added"]);

        }

        return $objCustomerTransaction;
    }

    /**
     * Get customer Transaction Info
     * @param $customerId
     * @return CustomerTransaction|null
     */
    public static function loadByCustomerId( $customerId=0,$start = 0, $limit = 0 )
    {
        $customerId  = intval($customerId);
        $start  = intval($start);
        $limit  = intval($limit);

        $objCustomerTransactionArr = NULL;

        $table      = "customer_transaction";
        $condition 	= "AND customer_id=".$customerId;
        $fields 	= "*";

        $limitStr   = "";
        if($limit)
            $limitStr = " LIMIT ".$start.", ".$limit;


        $row  	= Connection::getAllData($table, $condition, $fields, "", $limitStr);

        if( $row ) {

            foreach( $row as $resultRow ){

                $objCustomerTransaction = new CustomerTransaction();
                $objCustomerTransaction->setCustomerTransactionId($resultRow["customer_transaction_id"]);
                $objCustomerTransaction->setCustomerId($resultRow["customer_id"]);
                $objCustomerTransaction->setOrderId($resultRow["order_id"]);
                $objCustomerTransaction->setDescription($resultRow["description"]);
                $objCustomerTransaction->setAmount($resultRow["amount"]);
                $objCustomerTransaction->setDateAdded($resultRow["date_added"]);

                $objCustomerTransactionArr[] = $objCustomerTransaction;
            }

        }

        return $objCustomerTransactionArr;
    }





    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function load()
    {

        $objCustomerTransactionArr = array();

        $table      = "customer_transaction";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objCustomerTransaction = new CustomerTransaction();
                $objCustomerTransaction->setCustomerTransactionId($resultRow["customer_transaction_id"]);
                $objCustomerTransaction->setCustomerId($resultRow["customer_id"]);
                $objCustomerTransaction->setOrderId($resultRow["order_id"]);
                $objCustomerTransaction->setDescription($resultRow["description"]);
                $objCustomerTransaction->setAmount($resultRow["amount"]);
                $objCustomerTransaction->setDateAdded($resultRow["date_added"]);

                $objCustomerTransactionArr[] = $objCustomerTransaction;
            }

        }

        return $objCustomerTransactionArr;
    }

    public static function getTotalCustomerBalance($customerId){
        $customerId = intval($customerId);
        $query = "Select sum(amount) as amount from customer_transaction where customer_id = ".$customerId;
        $result = Connection::getSingleDataByQuery($query);

        return $result['amount'];
    }


    /**
     * Get total customer transaction number
     * @return bool
     */
    public static function  getTotalCustomerTransaction($customerId)
    {
        $table      = "customer_transaction";
        $condition  = "AND customer_id=".$customerId;

        return Connection::getCountData($table, $condition);

    }



    /**
     * delete data from database by id
     *
     * @param $customerTransactionId
     * @return bool
     */
    public static function deleteById( $customerTransactionId )
    {
        $customerTransactionId = intval( $customerTransactionId );
        return Connection::delData("customer_transaction", " AND customer_transaction_id=".$customerTransactionId);
    }

}
?>