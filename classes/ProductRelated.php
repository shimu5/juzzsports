<?php
/**
 *
 * ProductRelated class
 *
 *
 * @package     ProductRelated
 * @category    Library
 * @author      Juzz Sports
 * @date		08-06-2014
 */

Class ProductRelated
{

    private $productId;
    private $relatedId;



     /**
     * All getter and setter functions
     *
     */
    public function getProductId()
    {
        return $this->productId;
    }

    public function getRelatedId()
    {
        return $this->relatedId;
    }

    public function setProductId($val)
    {
        $this->productId = intval($val);
    }

    public function setRelatedId($val)
    {
        $this->relatedId = intval($val);
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

        $table = "product_related";
        $fieldset = array("related_id");
        $valueset = array($this->getRelatedId());

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
     * get data from database by id
     *
     * @return ProductRelated
     *
     */
public static function loadById( $productId )
    {

        $productId  = intval($productId);

        $objProductRelated = NULL;

        $table      = "product_related";
        $condition 	= "AND product_id=".$productId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objProductRelated = new ProductRelated();
            $objProductRelated->setProductId($resultRow["product_id"]);
            $objProductRelated->setRelatedId($resultRow["related_id"]);

        }

        return $objProductRelated;
    }





     /**
     * get all data from database
     *
     * @return Array
     *
     */
public static function load()
    {

        $objProductRelatedArr = array();

        $table      = "product_related";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objProductRelated = new ProductRelated();
                $objProductRelated->setProductId($resultRow["product_id"]);
                $objProductRelated->setRelatedId($resultRow["related_id"]);

                $objProductRelatedArr[] = $objProductRelated;
            }

        }

        return $objProductRelatedArr;
    }


    /**
     * Get products information by product id
     *
     * @return array of products
     */
    public static function loadByProductId($productId, $limit=1)
    {
        $productId = intval($productId);

        $table      = "product_related AS PR
                       JOIN product AS P ON P.product_id = PR.related_id
                       LEFT JOIN (
                            SELECT
                                price AS discount_price,
                                product_discount_id,
                                product_id,
                                date_start,
                                date_end
                            FROM
                            product_discount pd
                            WHERE	CURDATE() >= pd.date_start AND CURDATE() <= pd.date_end
                          ORDER BY product_discount_id DESC
                        ) PD ON (	PD.product_id = PR.related_id )
                    ";
        $condition 	= " AND PR.product_id = ".$productId;
        $fields 	= "P.*, PD.product_discount_id ,PD.discount_price,PD.date_start,PD.date_end,PR.related_id ";
        $orders = "GROUP BY PR.related_id order by sort_order ASC ";
        $limit = ($limit=="")?"": "Limit {$limit}";
        return Connection::getAllData($table, $condition, $fields, $orders, $limit,0);

    }


     /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
public static function deleteById( $productId )
    {
        $productId = intval( $productId );
        return Connection::delData("product_related", " AND product_id=".$productId);
    }

}
 ?>