<?php



/**
 *
 * Product class
 *
 *
 * @package     Product
 * @category    Library
 * @author      Juzz Sports
 * @date		03-06-2014
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
        $fieldset = array("name","description","meta_description","meta_keyword","tag","model","location","quantity","image","manufacturer_id","price","date_available","weight","length","width","height","sort_order","created","modified","is_active","viewed");
        $valueset = array($this->getName(),$this->getDescription(),$this->getMetaDescription(),$this->getMetaKeyword(),$this->getTag(),$this->getModel(),$this->getLocation(),$this->getQuantity(),$this->getImage(),$this->getManufacturerId(),$this->getPrice(),$this->getDateAvailable(),$this->getWeight(),$this->getLength(),$this->getWidth(),$this->getHeight(),$this->getSortOrder(),$this->getCreated(),$this->getModified(),$this->getIsActive(),$this->getViewed());

        if($productId > 0){
            $condition = "AND product_id=".$productId;
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
                $this->setProductId($insert_id);
            }else{
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }


    /**
     * Get product information by productId
     * @param $productId
     * @return null|array of product
     */
    public static function loadById( $productId )
    {

        $productId  = intval($productId);

        $objProduct = NULL;

        $table      = "product";
        $condition 	= "AND product_id=".$productId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
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
     * Get all product information
     *
     * @return array of product
     */
    public static function load()
    {

        $objProductArr = array();

        $table      = "product";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

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
     * Delete product by productId
     *
     * @param $productId
     * @return bool
     */
    public static function deleteById( $productId )
    {
        $productId = intval( $productId );
        return Connection::delData("product", " AND product_id=".$productId);
    }

    /*
     * fetch tables of category, and category products are available "product_category" table
     * then fetch products by joining product and  "product_category" table;
     */

     public function productsByTag($tagId=0, $limit=0){
       
        $table      = "product_tag";
        $sec_table = "product";
        $condition 	= "";
        if($limit!=0) $limit = " limit {$limit}";
        $sql = "Select $sec_table.*,manufacturer.name as manufacture_name,manufacturer.image as manufacture_image, pd.product_discount_id , pd.price as discount_price,pd.date_start,pd.date_end
        from $table JOIN $sec_table ON $table.product_id=$sec_table.product_id
        LEFT JOIN manufacturer ON $sec_table.manufacturer_id = manufacturer.manufacturer_id
        LEFT JOIN product_discount as pd ON $sec_table.product_id = pd.product_id AND CURDATE()>=pd.date_start AND CURDATE()<=pd.date_end
        WHERE product_tag.tag_id={$tagId} $limit";
        return Connection::getAllDataByQuery($sql);
     }

    /*
     * fetch each product by product Id
     */
    
    public static function productById( $productId )
    {
        $table      = "product";
        $sec_table = "product_discount";
        $condition 	= "";
        if($limit!=0) $limit = " limit 1";
        $sql = "Select $table.*,manufacturer.name as manufacture_name,manufacturer.image as manufacture_image, pd.product_discount_id , pd.price as discount_price,pd.date_start,pd.date_end
        from $table 
        LEFT JOIN manufacturer ON $table.manufacturer_id = manufacturer.manufacturer_id
        LEFT JOIN product_discount as pd ON $table.product_id = pd.product_id AND CURDATE()>=pd.date_start AND CURDATE()<=pd.date_end
        WHERE $table.product_id={$productId} {$limit}";
        return Connection::getSingleDataByQuery($sql);

    }

    /**
     * Get products information by category id
     *
     * @return array of products
     */
    public static function loadByCategoryId($categoryId)
    {
        $categoryId = intval($categoryId);

        $table      = "product P
                       LEFT JOIN product_category PC USING(product_id)
                       LEFT JOIN product_discount PD USING(product_id)
                    ";
        $condition 	= " AND PC.category_id = ".$categoryId;
        $fields 	= "P.*, PD.product_discount_id";

        return Connection::getAllData($table, $condition, $fields, "", "");

    }


}
?>