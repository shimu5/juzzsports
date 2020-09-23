<?php


/**
 *
 * CustomerReward class
 *
 *
 * @package     CustomerReward
 * @category    Library
 * @author      Juzz Sports
 * @date		10-06-2014
 */

Class CustomerReward
{

    private $customerRewardId;
    private $customerId;
    private $orderId;
    private $description;
    private $points;
    private $dateAdded;



     /**
     * All getter and setter functions
     *
     */
    public function getCustomerRewardId()
    {
        return $this->customerRewardId;
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

    public function getPoints()
    {
        return $this->points;
    }

    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    public function setCustomerRewardId($val)
    {
        $this->customerRewardId = intval($val);
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

    public function setPoints($val)
    {
        $this->points = intval($val);
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
        $customerRewardId = intval($this->getCustomerRewardId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "customer_reward";
        $fieldset = array("customer_id","order_id","description","points","date_added");
        $valueset = array($this->getCustomerId(),$this->getOrderId(),$this->getDescription(),$this->getPoints(),$this->getDateAdded());

        if($customerRewardId > 0){
            $condition = "AND customer_reward_id=".$customerRewardId;
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
                $this->setCustomerRewardId($insert_id);
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
     * @return CustomerReward
     *
     */
public static function loadById( $customerRewardId )
    {

        $customerRewardId  = intval($customerRewardId);

        $objCustomerReward = NULL;

        $table      = "customer_reward";
        $condition 	= "AND customer_reward_id=".$customerRewardId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objCustomerReward = new CustomerReward();
            $objCustomerReward->setCustomerRewardId($resultRow["customer_reward_id"]);
            $objCustomerReward->setCustomerId($resultRow["customer_id"]);
            $objCustomerReward->setOrderId($resultRow["order_id"]);
            $objCustomerReward->setDescription($resultRow["description"]);
            $objCustomerReward->setPoints($resultRow["points"]);
            $objCustomerReward->setDateAdded($resultRow["date_added"]);

        }

        return $objCustomerReward;
    }


     /**
     * get data from database by id
     *
     * @return CustomerReward
     *
     */
public static function loadByCustomerId( $customerId )
    {

        $customerId  = intval($customerId);

        $objCustomerReward = NULL;

        $table      = "customer_reward";
        $condition 	= "AND customer_id=".$customerId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objCustomerReward = new CustomerReward();
            $objCustomerReward->setCustomerRewardId($resultRow["customer_reward_id"]);
            $objCustomerReward->setCustomerId($resultRow["customer_id"]);
            $objCustomerReward->setOrderId($resultRow["order_id"]);
            $objCustomerReward->setDescription($resultRow["description"]);
            $objCustomerReward->setPoints($resultRow["points"]);
            $objCustomerReward->setDateAdded($resultRow["date_added"]);

        }

        return $objCustomerReward;
    }





     /**
     * get all data from database
     *
     * @return Array
     *
     */
public static function load()
    {

        $objCustomerRewardArr = array();

        $table      = "customer_reward";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objCustomerReward = new CustomerReward();
                $objCustomerReward->setCustomerRewardId($resultRow["customer_reward_id"]);
                $objCustomerReward->setCustomerId($resultRow["customer_id"]);
                $objCustomerReward->setOrderId($resultRow["order_id"]);
                $objCustomerReward->setDescription($resultRow["description"]);
                $objCustomerReward->setPoints($resultRow["points"]);
                $objCustomerReward->setDateAdded($resultRow["date_added"]);

                $objCustomerRewardArr[] = $objCustomerReward;
            }

        }

        return $objCustomerRewardArr;
    }





     /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
public static function deleteById( $customerRewardId )
    {
        $customerRewardId = intval( $customerRewardId );
        return Connection::delData("customer_reward", " AND customer_reward_id=".$customerRewardId);
    }

}
 ?>