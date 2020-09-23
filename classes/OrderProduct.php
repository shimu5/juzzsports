<?php

/**
 *
 * OrderProduct class
 *
 *
 * @package     OrderProduct
 * @category    Library
 * @author      Juzz Sports
 * @date        10-06-2014
 */

Class OrderProduct
{

    private $orderProductId;
    private $orderId;
    private $productId;
    private $name;
    private $model;
    private $quantity;
    private $size;
    private $price;
    private $total;
    private $tax;
    private $reward;



     /**
     * All getter and setter functions
     *
     */
    public function getOrderProductId()
    {
        return $this->orderProductId;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getTax()
    {
        return $this->tax;
    }

    public function getReward()
    {
        return $this->reward;
    }

    public function setOrderProductId($val)
    {
        $this->orderProductId = intval($val);
    }

    public function setOrderId($val)
    {
        $this->orderId = intval($val);
    }

    public function setProductId($val)
    {
        $this->productId = intval($val);
    }

    public function setName($val)
    {
        $this->name = $val;
    }

    public function setModel($val)
    {
        $this->model = $val;
    }

    public function setQuantity($val)
    {
        $this->quantity = intval($val);
    }

    public function setSize($val)
    {
        $this->size = $val;
    }

    public function setPrice($val)
    {
        $this->price = $val;
    }

    public function setTotal($val)
    {
        $this->total = $val;
    }

    public function setTax($val)
    {
        $this->tax = $val;
    }

    public function setReward($val)
    {
        $this->reward = intval($val);
    }


    /**
     * Insert and update information
     *
     * @return mixed
     *
     */


    public function save()
    {
        $orderProductId = intval($this->getOrderProductId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "order_product";
        $fieldset = array("order_id","product_id","name","model","quantity","size","price","total","tax","reward");
        $valueset = array($this->getOrderId(),$this->getProductId(),$this->getName(),$this->getModel(),$this->getQuantity(),$this->getSize(),$this->getPrice(),$this->getTotal(),$this->getTax(),$this->getReward());

        if ($orderProductId > 0) {
            $condition = "AND order_product_id=" . $orderProductId;
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
                $this->setOrderProductId($insert_id);
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
     * @return OrderProduct
     *
     */
    public static function loadById($orderProductId)
    {

        $orderProductId = intval($orderProductId);

        $objOrderProduct = NULL;

        $table = "order_product";
        $condition = "AND order_product_id=" . $orderProductId;
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objOrderProduct = new OrderProduct();
            $objOrderProduct->setOrderProductId($resultRow["order_product_id"]);
            $objOrderProduct->setOrderId($resultRow["order_id"]);
            $objOrderProduct->setProductId($resultRow["product_id"]);
            $objOrderProduct->setName($resultRow["name"]);
            $objOrderProduct->setModel($resultRow["model"]);
            $objOrderProduct->setQuantity($resultRow["quantity"]);
            $objOrderProduct->setSize($resultRow["size"]);
            $objOrderProduct->setPrice($resultRow["price"]);
            $objOrderProduct->setTotal($resultRow["total"]);
            $objOrderProduct->setTax($resultRow["tax"]);
            $objOrderProduct->setReward($resultRow["reward"]);

        }

        return $objOrderProduct;
    }


    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function load()
    {

        $objOrderProductArr = array();

        $table = "order_product";
        $condition = "";
        $fields = "*";

        $row = Connection::getAllData($table, $condition, $fields, "", "");

        if ($row) {

            foreach ($row as $resultRow) {

                $objOrderProduct = new OrderProduct();
                $objOrderProduct->setOrderProductId($resultRow["order_product_id"]);
                $objOrderProduct->setOrderId($resultRow["order_id"]);
                $objOrderProduct->setProductId($resultRow["product_id"]);
                $objOrderProduct->setName($resultRow["name"]);
                $objOrderProduct->setModel($resultRow["model"]);
                $objOrderProduct->setQuantity($resultRow["quantity"]);
                $objOrderProduct->setSize($resultRow["size"]);
                $objOrderProduct->setPrice($resultRow["price"]);
                $objOrderProduct->setTotal($resultRow["total"]);
                $objOrderProduct->setTax($resultRow["tax"]);
                $objOrderProduct->setReward($resultRow["reward"]);

                $objOrderProductArr[] = $objOrderProduct;
            }

        }

        return $objOrderProductArr;
    }

    /**
     * get all data from database by order id
     *
     * @return Array
     *
     */
    public static function getOrderProductListByOrderId($orderId)
    {

        $orderId = intval($orderId);

        $objOrderProductArr = array();

        $table = "order_product";
        $condition = "AND order_id = " . $orderId;
        $fields = "*";

        $row = Connection::getAllData($table, $condition, $fields, "", "");

        if ($row) {

            foreach ($row as $resultRow) {

                $objOrderProduct = new OrderProduct();
                $objOrderProduct->setOrderProductId($resultRow["order_product_id"]);
                $objOrderProduct->setOrderId($resultRow["order_id"]);
                $objOrderProduct->setProductId($resultRow["product_id"]);
                $objOrderProduct->setName($resultRow["name"]);
                $objOrderProduct->setModel($resultRow["model"]);
                $objOrderProduct->setQuantity($resultRow["quantity"]);
                $objOrderProduct->setSize($resultRow["size"]);
                $objOrderProduct->setPrice($resultRow["price"]);
                $objOrderProduct->setTotal($resultRow["total"]);
                $objOrderProduct->setTax($resultRow["tax"]);
                $objOrderProduct->setReward($resultRow["reward"]);

                $objOrderProductArr[] = $objOrderProduct;
            }

        }

        return $objOrderProductArr;
    }


    /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
    public static function deleteById($orderProductId)
    {
        $orderProductId = intval($orderProductId);
        return Connection::delData("order_product", " AND order_product_id=" . $orderProductId);
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
        return Connection::delData("order_product", " AND order_id=" . $orderId);
    }

}

?>