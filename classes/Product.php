<?php

/**
 *
 * Product class
 *
 *
 * @package     Product
 * @category    Library
 * @author      Juzz Sports
 * @date        03-06-2014
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
    private $stockStatusId;
    private $shipping;
    private $points;
    private $weightClassId;
    private $lengthClassId;
    private $minimum;
    private $sortOrder;
    private $created;
    private $modified;
    private $isActive;
    private $viewed;

    /**
     * Setter & Getter function
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

    public function getStockStatusId()
    {
        return $this->stockStatusId;
    }

    public function getShipping()
    {
        return $this->shipping;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function getWeightClassId()
    {
        return $this->weightClassId;
    }

    public function getLengthClassId()
    {
        return $this->lengthClassId;
    }

    public function getMinimum()
    {
        return $this->minimum;
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

    public function setStockStatusId($val)
    {
        $this->stockStatusId = intval($val);
    }

    public function setShipping($val)
    {
        $this->shipping = intval($val);
    }

    public function setPoints($val)
    {
        $this->points = intval($val);
    }

    public function setWeightClassId($val)
    {
        $this->weightClassId = intval($val);
    }

    public function setLengthClassId($val)
    {
        $this->lengthClassId = intval($val);
    }

    public function setMinimum($val)
    {
        $this->minimum = intval($val);
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
     * Save & update product information
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
        $fieldset = array("name", "description", "meta_description", "meta_keyword", "tag", "model", "location", "quantity", "image", "manufacturer_id", "price", "date_available", "weight", "length", "width", "height", "stock_status_id", "shipping", "points", "weight_class_id", "length_class_id", "minimum", "sort_order", "created", "modified", "is_active", "viewed");
        $valueset = array($this->getName(), $this->getDescription(), $this->getMetaDescription(), $this->getMetaKeyword(), $this->getTag(), $this->getModel(), $this->getLocation(), $this->getQuantity(), $this->getImage(), $this->getManufacturerId(), $this->getPrice(), $this->getDateAvailable(), $this->getWeight(), $this->getLength(), $this->getWidth(), $this->getHeight(), $this->getStockStatusId(), $this->getShipping(), $this->getPoints(), $this->getWeightClassId(), $this->getLengthClassId(), $this->getMinimum(), $this->getSortOrder(), $this->getCreated(), $this->getModified(), $this->getIsActive(), $this->getViewed());

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
            $objProduct->setStockStatusId($resultRow["stock_status_id"]);
            $objProduct->setShipping($resultRow["shipping"]);
            $objProduct->setPoints($resultRow["points"]);
            $objProduct->setWeightClassId($resultRow["weight_class_id"]);
            $objProduct->setLengthClassId($resultRow["length_class_id"]);
            $objProduct->setMinimum($resultRow["minimum"]);
            $objProduct->setSortOrder($resultRow["sort_order"]);
            $objProduct->setCreated($resultRow["created"]);
            $objProduct->setModified($resultRow["modified"]);
            $objProduct->setIsActive($resultRow["is_active"]);
            $objProduct->setViewed($resultRow["viewed"]);

        }

        return $objProduct;
    }


    /**
     * update no of times viewed this product
     *
     * @return Array
     *
     */
    public static function updateNoOfViewed($productId)
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
            $objProduct->setStockStatusId($resultRow["stock_status_id"]);
            $objProduct->setShipping($resultRow["shipping"]);
            $objProduct->setPoints($resultRow["points"]);
            $objProduct->setWeightClassId($resultRow["weight_class_id"]);
            $objProduct->setLengthClassId($resultRow["length_class_id"]);
            $objProduct->setMinimum($resultRow["minimum"]);
            $objProduct->setSortOrder($resultRow["sort_order"]);
            $objProduct->setCreated($resultRow["created"]);
            $objProduct->setModified($resultRow["modified"]);
            $objProduct->setIsActive($resultRow["is_active"]);
            $objProduct->setViewed($resultRow["viewed"] + 1);

            return $objProduct->save();

        }

        return array("success" => false);
    }


    /**
     * delete product by product id
     *
     * @param $productId
     * @return bool
     */
    public static function disableProductById($productId, $value)
    {
        $productId = intval($productId);
        $value = intval($value);

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
            $objProduct->setStockStatusId($resultRow["stock_status_id"]);
            $objProduct->setShipping($resultRow["shipping"]);
            $objProduct->setPoints($resultRow["points"]);
            $objProduct->setWeightClassId($resultRow["weight_class_id"]);
            $objProduct->setLengthClassId($resultRow["length_class_id"]);
            $objProduct->setMinimum($resultRow["minimum"]);
            $objProduct->setSortOrder($resultRow["sort_order"]);
            $objProduct->setCreated($resultRow["created"]);
            $objProduct->setModified($resultRow["modified"]);
            $objProduct->setIsActive($value);
            $objProduct->setViewed($resultRow["viewed"]);

            return $objProduct->save();

        }
        return array("success" => false);
    }

/**
     * secrch product by product name
     *
     * @param $productName
     * @return Array
     */
    public static function searchProductInfoByProductName($productName)
    {

        $objProduct = NULL;

        $table      = "product";
        $condition  = 'AND name LIKE "%'.$productName.'%"';
        $fields     = "*";

        return Connection::getAllData($table, $condition, $fields, "", "");

    }

    /**
     * get total product list
     *
     *
     * @return total product INT
     */
    public static function getTotalProduct()
    {
        $table = "product";
        $condition = "";

        return Connection::getCountData($table, $condition);

    }


    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function load($start = 0, $limit = 0)
    {
        $start      = intval($start);
        $limit      = intval($limit);

        $objProductArr = array();

        $table = "product";
        $condition = "";
        $fields = "*";

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
                $objProduct->setStockStatusId($resultRow["stock_status_id"]);
                $objProduct->setShipping($resultRow["shipping"]);
                $objProduct->setPoints($resultRow["points"]);
                $objProduct->setWeightClassId($resultRow["weight_class_id"]);
                $objProduct->setLengthClassId($resultRow["length_class_id"]);
                $objProduct->setMinimum($resultRow["minimum"]);
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
     * get all data from database
     *
     * @return Array
     *
     */
    public static function showProductViewedData($start = 0, $limit = 0)
    {
        $start = intval($start);
        $limit = intval($limit);

        $table      = "product";
        $condition  = "AND viewed != 0";
        $fields     = "product_id,name,model,viewed";

        $limitStr = "";
        if ($limit) {
            $limitStr = "LIMIT " . $start . ", " . $limit;
        }

        return Connection::getAllData($table, $condition, $fields, "", $limitStr);
    }

/**
     * get all data viewed from database
     *
     * @return Int
     *
     */
    public static function getTotalViewed()
    {
        $table      = "product";
        $condition  = "";
        $fields     = "SUM(viewed) as total_viewed";

        $result = Connection::getSingleData($table, $condition, $fields, "", "");

        return $result['total_viewed'];
    }

/**
     * get all product number viewed from database
     *
     * @return Array
     *
     */
    public static function getTotalViewedProduct()
    {
        $table      = "product";
        $condition  = "AND viewed != 0";
        $fields     = "COUNT(viewed) as total_product";

        $result = Connection::getSingleData($table, $condition, $fields, "", "");

        return $result['total_product'];
    }

/**
     * get all product number viewed from database
     *
     * @return Array
     *
     */
    public static function resetViewedProduct()
    {
        $sql = "UPDATE product SET viewed = 0";

        return Connection::getSingleDataByQuery($sql);
    }


    /**
     * Delete product by productId
     *
     * @param $productId
     * @return bool
     */
    public static function deleteById($productId)
    {
        $productId = intval($productId);
        return Connection::delData("product", " AND product_id=" . $productId);
    }

    /*
     * fetch tables of category, and category products are available "product_category" table
     * then fetch products by joining product and  "product_category" table;
     */

    public static function productsByTag($tagId = 0, $limit = 0, $active = null, $filterArr = array())
    {

        $table = "product_tag";
        $sec_table = "product";
        $condition = "";
        if ($limit != 0) $limit = " limit {$limit}";
        $active = (isset($active))?" AND product.is_active = {$active}":" ";

        $filterCondition = "";
        if (count($filterArr)) {
            if ($filterArr['manufacturer_id']) {
                $filterCondition .= " AND ".$sec_table.".manufacturer_id = " . intval($filterArr['manufacturer_id']);
            }
            if ($filterArr['price']) {
                $priceArr = explode("_", $filterArr['price']);
                if ($priceArr[1] != 'p')
                    $filterCondition .= " AND (".$sec_table.".price >= " . floatval($priceArr[0]) . " AND ".$sec_table.".price <= " . floatval($priceArr[1]) . ")";
                else
                    $filterCondition .= " AND ".$sec_table.".price >= " . floatval($priceArr[0]);
            }

        }

        $active .= ($filterCondition ? $filterCondition : "");

        $sql = "Select $sec_table.*,manufacturer.name as manufacture_name,manufacturer.image as manufacture_image, pd.product_discount_id,
        pd.price as discount_price,pd.date_start,pd.date_end, ss.name as stock_name
        from $table JOIN $sec_table ON $table.product_id=$sec_table.product_id
        LEFT JOIN manufacturer ON $sec_table.manufacturer_id = manufacturer.manufacturer_id
        LEFT JOIN (
            SELECT *
                FROM product_discount
                WHERE product_discount.product_discount_id
                IN (

                SELECT MAX( product_discount.product_discount_id ) AS product_discount_id
                FROM product_discount
                WHERE CURDATE( ) >= product_discount.date_start
                AND CURDATE( ) <= product_discount.date_end
                GROUP BY product_discount.product_id
                )
        )AS pd
        ON pd.product_id = $sec_table.product_id
        LEFT JOIN stock_status as ss ON ss.stock_status_id = product.stock_status_id
        WHERE product_tag.tag_id={$tagId} {$active} {$limit} ";

        return Connection::getAllDataByQuery($sql);
    }

    /*
     * fetch each product by product Id
     */

    public static function productById($productId, $active = null)
    {
        $table = "product";
        $sec_table = "product_discount";
        $condition = "";
        $limit = " limit 1";
        $active = (isset($active))?" AND product.is_active = {$active}":" ";
        $sql = "Select $table.*,manufacturer.name as manufacture_name,manufacturer.image as manufacture_image, pd.product_discount_id ,
        pd.discount_price,pd.date_start,pd.date_end, ss.name as stock_name
        from $table 
        LEFT JOIN manufacturer ON $table.manufacturer_id = manufacturer.manufacturer_id
        LEFT JOIN ( SELECT price AS discount_price, product_discount_id, product_id, date_start, date_end FROM product_discount pd WHERE CURDATE() >= pd.date_start AND CURDATE() <= pd.date_end ORDER BY product_discount_id DESC ) PD ON ( PD.product_id = product.product_id )
        LEFT JOIN stock_status as ss ON ss.stock_status_id = product.stock_status_id
        WHERE $table.product_id={$productId} {$active} {$limit}";
        return Connection::getSingleDataByQuery($sql);

    }

    /**
     * Get products information by category id
     *
     * @return array of products
     */
    public static function loadByCategoryId($categoryId, $filterArr = array(),$active = null)
    {
        $categoryId = intval($categoryId);

        $active = (isset($active))?" AND P.is_active = {$active}":" ";
        $filterCondition = "";
        if (count($filterArr)) {
            if ($filterArr['manufacturer_id']) {
                $filterCondition .= " AND P.manufacturer_id = " . intval($filterArr['manufacturer_id']);
            }
            if ($filterArr['price']) {
                $priceArr = explode("_", $filterArr['price']);
                if ($priceArr[1] != 'p')
                    $filterCondition .= " AND (P.price >= " . floatval($priceArr[0]) . " AND P.price <= " . floatval($priceArr[1]) . ")";
                else
                    $filterCondition .= " AND P.price >= " . floatval($priceArr[0]);
            }

        }

        $table = "product P
                       LEFT JOIN product_category PC USING(product_id)
                       LEFT JOIN (
                            SELECT *
                                FROM product_discount
                                WHERE product_discount.product_discount_id
                                IN (

                                SELECT MAX( product_discount.product_discount_id ) AS product_discount_id
                                FROM product_discount
                                WHERE CURDATE( ) >= product_discount.date_start
                                AND CURDATE( ) <= product_discount.date_end
                                GROUP BY product_discount.product_id
                                )
                            )AS pd
                        ON pd.product_id = P.product_id
                    ";
        $condition = " $active AND  PC.category_id = " . $categoryId . $filterCondition;
        $fields = "P.*, PD.product_discount_id, PD.price AS discount_price";

        return Connection::getAllData($table, $condition, $fields, "", "");

    }

    public static function loadProductsDetailsById($productId)
    {
        $productId = intval($productId);


        $table = "product pr
                       LEFT JOIN product_discount pro_dis ON(pr.product_id = pro_dis.product_id)
                       LEFT JOIN stock_status ss ON(pr.stock_status_id = ss.stock_status_id)
                       LEFT JOIN weight_class_description wcd ON(pr.weight_class_id = wcd.weight_class_id)
                       LEFT JOIN length_class_description lcd ON(pr.length_class_id = lcd.length_class_id)
                       LEFT JOIN manufacturer manf ON(pr.manufacturer_id = manf.manufacturer_id)
                    ";
        $condition = " AND pr.product_id = " . $productId;
        $fields = "
                    pr.product_id as product_id,
                    pr.`name` as product_name,
                    pr.image as product_image,
                    pr.price as product_price,
                    pro_dis.price as discount_price,
                    pr.model  as product_model,
                    pr.manufacturer_id as product_manufacturer,
                    pr.stock_status_id as product_stock,
                    ss.name as in_stock,
                    pr.description as product_description,
                    pr.weight as product_weight,
                    pr.width as product_width,
                    pr.length as product_length,
                    pr.height as product_height,
                    wcd.unit as product_unit,
                    lcd.unit as product_length_unit,
                    manf.name as manufacturer_name";

        return Connection::getSingleData($table, $condition, $fields, "", "");


//        pr(Connection::getAllDataByQuery($query));die;
        //return Connection::getAllDataByQuery($query);
    }

    /**
     * Check product is exist
     * @param $productName
     * @param $productId
     * @return bool
     */
    public static function isProductExist($productName, $productId)
    {
        $productId = intval($productId);

        $table = "product";
        $condition = "AND name ='" . dbsafe($productName) . "' ";
        $condition .= ($productId) ? " AND product_id != " . $productId : '';

        return Connection::getCountData($table, $condition);

    }

    public static function getLastProductId()
    {
        $table = "product";
        $condition = "";
        $fields = "product_id";
        $orders = "ORDER BY product_id DESC";
        $limits = "LIMIT 1";

        return Connection::getSingleData($table, $condition, $fields, $orders, $limits);

    }

    public static function searchProductByKey($key)
    {
        $table = "product";
        $condition = " AND TRIM(name) like '" . trim($key) . "%'";
        $fields = "product_id,name";
        $orders = "";
        return Connection::getAllData($table, $condition, $fields, "", "");

    }
    
    public static function loadProducts($condition, $fields, $orders, $limits, $printSql = 0)
    {        
        $table = "product";
        $condition = "";
        $fields = (!isset($fields))?" * ":$fields;
        $orders = (!isset($orders))?" ":$orders;
        $limits = (!isset($limits))?" ":$limits;
        $row = Connection::getAllData($table, $condition, $fields, $orders, $limits, $printSql);
        return $row;
    }




}

?>