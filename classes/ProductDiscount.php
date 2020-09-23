<?php

/**
 *
 * ProductDiscount class
 *
 *
 * @package     ProductDiscount
 * @category    Library
 * @author      Juzz Sports
 * @date		05-06-2014
 */

Class ProductDiscount
{

    private $productDiscountId;
    private $productId;
    private $quantity;
    private $priority;
    private $price;
    private $dateStart;
    private $dateEnd;



     /**
     * All getter and setter functions
     *
     */
    public function getProductDiscountId()
    {
        return $this->productDiscountId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDateStart()
    {
        return $this->dateStart;
    }

    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    public function setProductDiscountId($val)
    {
        $this->productDiscountId = intval($val);
    }

    public function setProductId($val)
    {
        $this->productId = intval($val);
    }

    public function setQuantity($val)
    {
        $this->quantity = intval($val);
    }

    public function setPriority($val)
    {
        $this->priority = intval($val);
    }

    public function setPrice($val)
    {
        $this->price = $val;
    }

    public function setDateStart($val)
    {
        $this->dateStart = $val;
    }

    public function setDateEnd($val)
    {
        $this->dateEnd = $val;
    }



     /**
     * Insert and update information
     *
     * @return mixed
     *
     */



    public function save()
    {
        $productDiscountId = intval($this->getProductDiscountId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "product_discount";
        $fieldset = array("product_id","quantity","priority","price","date_start","date_end");
        $valueset = array($this->getProductId(),$this->getQuantity(),$this->getPriority(),$this->getPrice(),$this->getDateStart(),$this->getDateEnd());

        if($productDiscountId > 0){
            $condition = "AND product_discount_id=".$productDiscountId;
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
                $this->setProductDiscountId($insert_id);
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
     * @return ProductDiscount
     *
     */
public static function loadById( $productDiscountId )
    {

        $productDiscountId  = intval($productDiscountId);

        $objProductDiscount = NULL;

        $table      = "product_discount";
        $condition 	= "AND product_discount_id=".$productDiscountId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objProductDiscount = new ProductDiscount();
            $objProductDiscount->setProductDiscountId($resultRow["product_discount_id"]);
            $objProductDiscount->setProductId($resultRow["product_id"]);
            $objProductDiscount->setQuantity($resultRow["quantity"]);
            $objProductDiscount->setPriority($resultRow["priority"]);
            $objProductDiscount->setPrice($resultRow["price"]);
            $objProductDiscount->setDateStart($resultRow["date_start"]);
            $objProductDiscount->setDateEnd($resultRow["date_end"]);

        }

        return $objProductDiscount;
    }





     /**
     * get all data from database
     *
     * @return Array
     *
     */
public static function load()
    {

        $objProductDiscountArr = array();

        $table      = "product_discount";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objProductDiscount = new ProductDiscount();
                $objProductDiscount->setProductDiscountId($resultRow["product_discount_id"]);
                $objProductDiscount->setProductId($resultRow["product_id"]);
                $objProductDiscount->setQuantity($resultRow["quantity"]);
                $objProductDiscount->setPriority($resultRow["priority"]);
                $objProductDiscount->setPrice($resultRow["price"]);
                $objProductDiscount->setDateStart($resultRow["date_start"]);
                $objProductDiscount->setDateEnd($resultRow["date_end"]);

                $objProductDiscountArr[] = $objProductDiscount;
            }

        }

        return $objProductDiscountArr;
    }





     /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
public static function deleteById( $productDiscountId )
    {
        $productDiscountId = intval( $productDiscountId );
        return Connection::delData("product_discount", " AND product_discount_id=".$productDiscountId);
    }

}
 ?>