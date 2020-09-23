<?php

/**
 *
 * Product class
 *
 *
 * @package     Product
 * @category    Library
 * @author      Juzz Sports
 * @date        04-06-2014
 */

Class Product
{

    private $productId;
    private $name;
    private $description;
    private $metaDescription;
    private $metaKeyword;
    private $tag;
    private $model;
    private $location;
    private $quantity;
    private $image;
    private $manufacturerId;
    private $price;
    private $dateAvailable;
    private $weight;
    private $length;
    private $width;
    private $height;
    private $sortOrder;
    private $created;
    private $modified;
    private $isActive;
    private $viewed;


    /**
     * All getter and setter functions
     *
     */
    public function getProductId()
    {
        return $this->productId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    public function getMetaKeyword()
    {
        return $this->metaKeyword;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getManufacturerId()
    {
        return $this->manufacturerId;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDateAvailable()
    {
        return $this->dateAvailable;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getModified()
    {
        return $this->modified;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function getViewed()
    {
        return $this->viewed;
    }

    public function setProductId($val)
    {
        $this->productId = intval($val);
    }

    public function setName($val)
    {
        $this->name = $val;
    }

    public function setDescription($val)
    {
        $this->description = $val;
    }

    public function setMetaDescription($val)
    {
        $this->metaDescription = $val;
    }

    public function setMetaKeyword($val)
    {
        $this->metaKeyword = $val;
    }

    public function setTag($val)
    {
        $this->tag = $val;
    }

    public function setModel($val)
    {
        $this->model = $val;
    }

    public function setLocation($val)
    {
        $this->location = $val;
    }

    public function setQuantity($val)
    {
        $this->quantity = intval($val);
    }

    public function setImage($val)
    {
        $this->image = $val;
    }

    public function setManufacturerId($val)
    {
        $this->manufacturerId = intval($val);
    }

    public function setPrice($val)
    {
        $this->price = $val;
    }

    public function setDateAvailable($val)
    {
        $this->dateAvailable = $val;
    }

    public function setWeight($val)
    {
        $this->weight = $val;
    }

    public function setLength($val)
    {
        $this->length = $val;
    }

    public function setWidth($val)
    {
        $this->width = $val;
    }

    public function setHeight($val)
    {
        $this->height = $val;
    }

    public function setSortOrder($val)
    {
        $this->sortOrder = intval($val);
    }

    public function setCreated($val)
    {
        $this->created = $val;
    }

    public function setModified($val)
    {
        $this->modified = $val;
    }

    public function setIsActive($val)
    {
        $this->isActive = intval($val);
    }

    public function setViewed($val)
    {
        $this->viewed = intval($val);
    }


    /**
     * Insert and update information
     *
     * @return mixed
     *
     */


    public function save()
    {
        $productId = intval($this->getProductId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "product";
        $fieldset = array("name", "description", "meta_description", "meta_keyword", "tag", "model", "location", "quantity", "image", "manufacturer_id", "price", "date_available", "weight", "length", "width", "height", "sort_order", "created", "modified", "is_active", "viewed");
        $valueset = array($this->getName(), $this->getDescription(), $this->getMetaDescription(), $this->getMetaKeyword(), $this->getTag(), $this->getModel(), $this->getLocation(), $this->getQuantity(), $this->getImage(), $this->getManufacturerId(), $this->getPrice(), $this->getDateAvailable(), $this->getWeight(), $this->getLength(), $this->getWidth(), $this->getHeight(), $this->getSortOrder(), $this->getCreated(), $this->getModified(), $this->getIsActive(), $this->getViewed());

        if ($productId > 0) {
            $condition = "AND product_id=" . $productId;
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
                $this->setProductId($insert_id);
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
     * @return Product
     *
     */
    public static function loadById($productId)
    {

        $productId = intval($productId);

        $objProduct = NULL;

        $table = "product";
        $condition = "AND product_id=" . $productId;
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objProduct = new Product();
            $objProduct->setProductId($resultRow["product_id"]);
            $objProduct->setName($resultRow["name"]);
            $objProduct->setDescription($resultRow["description"]);
            $objProduct->setMetaDescription($resultRow["meta_description"]);
            $objProduct->setMetaKeyword($resultRow["meta_keyword"]);
            $objProduct->setTag($resultRow["tag"]);
            $objProduct->setModel($resultRow["model"]);
            $objProduct->setLocation($resultRow["location"]);
            $objProduct->setQuantity($resultRow["quantity"]);
            $objProduct->setImage($resultRow["image"]);
            $objProduct->setManufacturerId($resultRow["manufacturer_id"]);
            $objProduct->setPrice($resultRow["price"]);
            $objProduct->setDateAvailable($resultRow["date_available"]);
            $objProduct->setWeight($resultRow["weight"]);
            $objProduct->setLength($resultRow["length"]);
            $objProduct->setWidth($resultRow["width"]);
            $objProduct->setHeight($resultRow["height"]);
            $objProduct->setSortOrder($resultRow["sort_order"]);
            $objProduct->setCreated($resultRow["created"]);
            $objProduct->setModified($resultRow["modified"]);
            $objProduct->setIsActive($resultRow["is_active"]);
            $objProduct->setViewed($resultRow["viewed"]);

        }

        return $objProduct;
    }


    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function load($start = 0, $limit = 0)
    {
        $start          = intval($start);
        $limit          = intval($limit);

        $objProductArr = array();

        $table      = "product";
        $condition  = "";
        $fields     = "*";

        $limitStr = "";
        if($limit){
            $limitStr = "LIMIT ".$start.", ".$limit;
        }

        $row = Connection::getAllData($table, $condition, $fields, "", $limitStr);

        if ($row) {

            foreach ($row as $resultRow) {

                $objProduct = new Product();
                $objProduct->setProductId($resultRow["product_id"]);
                $objProduct->setName($resultRow["name"]);
                $objProduct->setDescription($resultRow["description"]);
                $objProduct->setMetaDescription($resultRow["meta_description"]);
                $objProduct->setMetaKeyword($resultRow["meta_keyword"]);
                $objProduct->setTag($resultRow["tag"]);
                $objProduct->setModel($resultRow["model"]);
                $objProduct->setLocation($resultRow["location"]);
                $objProduct->setQuantity($resultRow["quantity"]);
                $objProduct->setImage($resultRow["image"]);
                $objProduct->setManufacturerId($resultRow["manufacturer_id"]);
                $objProduct->setPrice($resultRow["price"]);
                $objProduct->setDateAvailable($resultRow["date_available"]);
                $objProduct->setWeight($resultRow["weight"]);
                $objProduct->setLength($resultRow["length"]);
                $objProduct->setWidth($resultRow["width"]);
                $objProduct->setHeight($resultRow["height"]);
                $objProduct->setSortOrder($resultRow["sort_order"]);
                $objProduct->setCreated($resultRow["created"]);
                $objProduct->setModified($resultRow["modified"]);
                $objProduct->setIsActive($resultRow["is_active"]);
                $objProduct->setViewed($resultRow["viewed"]);

                $objProductArr[] = $objProduct;
            }

        }

        return $objProductArr;
    }


    /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
    public static function deleteById($productId)
    {
        $productId = intval($productId);
        return Connection::delData("product", " AND product_id=" . $productId);
    }

}

?>