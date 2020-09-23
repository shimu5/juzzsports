<?php

/**
 *
 * ProductImage class
 *
 *
 * @package     ProductImage
 * @category    Library
 * @author      Juzz Sports
 * @date		08-06-2014
 */

Class ProductImage
{

    private $productImageId;
    private $productId;
    private $imageName;
    private $imagePath;
    private $sortOrder;



     /**
     * All getter and setter functions
     *
     */
    public function getProductImageId()
    {
        return $this->productImageId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getImageName()
    {
        return $this->imageName;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    public function setProductImageId($val)
    {
        $this->productImageId = intval($val);
    }

    public function setProductId($val)
    {
        $this->productId = intval($val);
    }

    public function setImageName($val)
    {
        $this->imageName = $val;
    }

    public function setImagePath($val)
    {
        $this->imagePath = $val;
    }

    public function setSortOrder($val)
    {
        $this->sortOrder = intval($val);
    }



     /**
     * Insert and update information
     *
     * @return mixed
     *
     */



    public function save()
    {
        $productImageId = intval($this->getProductImageId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "product_image";
        $fieldset = array("product_id","image_name","image_path","sort_order");
        $valueset = array($this->getProductId(),$this->getImageName(),$this->getImagePath(),$this->getSortOrder());

        if($productImageId > 0){
            $condition = "AND product_image_id=".$productImageId;
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
                $this->setProductImageId($insert_id);
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
     * @return ProductImage
     *
     */
public static function loadById( $productImageId )
    {

        $productImageId  = intval($productImageId);

        $objProductImage = NULL;

        $table      = "product_image";
        $condition 	= "AND product_image_id=".$productImageId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objProductImage = new ProductImage();
            $objProductImage->setProductImageId($resultRow["product_image_id"]);
            $objProductImage->setProductId($resultRow["product_id"]);
            $objProductImage->setImageName($resultRow["image_name"]);
            $objProductImage->setImagePath($resultRow["image_path"]);
            $objProductImage->setSortOrder($resultRow["sort_order"]);

        }

        return $objProductImage;
    }





     /**
     * get all data from database
     *
     * @return Array
     *
     */
public static function load()
    {

        $objProductImageArr = array();

        $table      = "product_image";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objProductImage = new ProductImage();
                $objProductImage->setProductImageId($resultRow["product_image_id"]);
                $objProductImage->setProductId($resultRow["product_id"]);
                $objProductImage->setImageName($resultRow["image_name"]);
                $objProductImage->setImagePath($resultRow["image_path"]);
                $objProductImage->setSortOrder($resultRow["sort_order"]);

                $objProductImageArr[] = $objProductImage;
            }

        }

        return $objProductImageArr;
    }

    /**
     * Get products information by product id
     *
     * @return array of products
     */
    public static function loadByProductId($productId, $limit=1)
    {
        $productId = intval($productId);        

        $table      = "product P
                       JOIN product_image PI USING(product_id)
                    ";
        $condition 	= " AND P.product_id = ".$productId;
        $fields 	= "PI.*";
        $orders = "order by sort_order ASC ";
        $limit = ($limit=="")?"": "Limit {$limit}";
        return Connection::getAllData($table, $condition, $fields, $orders, $limit,0);

    }





     /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
public static function deleteById( $productImageId )
    {
        $productImageId = intval( $productImageId );
        return Connection::delData("product_image", " AND product_image_id=".$productImageId);
    }

}
 ?>