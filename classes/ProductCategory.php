<?php


/**
 *
 * ProductCategory class
 *
 *
 * @package     ProductCategory
 * @category    Library
 * @author      Juzz Sports
 * @date		03-06-2014
 */

Class ProductCategory
{

    private $productId;
    private $categoryId;

    /**
     * Getter & Setter function
     */
    public function getProductId()
    {
        return $this->productId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setProductId($val)
    {
        $this->productId = intval($val);
    }

    public function setCategoryId($val)
    {
        $this->categoryId = intval($val);
    }


    /**
     * Save & update product category information
     *
     * @return mixed
     */
    public function save()
    {
        $productId = intval($this->getProductId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "product_category";
        $fieldset = array("category_id");
        $valueset = array($this->getCategoryId());

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
     * Get product category by productId
     * @param $productId
     * @return null|ProductCategory
     */
    public static function loadById( $productId )
    {

        $productId  = intval($productId);

        $objProductCategory = NULL;

        $table      = "product_category";
        $condition 	= "AND product_id=".$productId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objProductCategory = new ProductCategory();
            $objProductCategory->setProductId($resultRow["product_id"]);
            $objProductCategory->setCategoryId($resultRow["category_id"]);

        }

        return $objProductCategory;
    }


    /**
     * Get all product category information
     *
     * @return array
     */
    public static function load()
    {

        $objProductCategoryArr = array();

        $table      = "product_category";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objProductCategory = new ProductCategory();
                $objProductCategory->setProductId($resultRow["product_id"]);
                $objProductCategory->setCategoryId($resultRow["category_id"]);

                $objProductCategoryArr[] = $objProductCategory;
            }

        }

        return $objProductCategoryArr;
    }


    /**
     * Delete product category by productId
     * @param $productId
     * @return bool
     */
    public static function deleteById( $productId )
    {
        $productId = intval( $productId );
        return Connection::delData("product_category", " AND product_id=".$productId);
    }   

}
?>