<?php

/**
 *
 * ManufacturerStore class
 *
 *
 * @package     ManufacturerStore
 * @category    Library
 * @author      Juzz Sports
 * @date		02-06-2014
 */

Class ManufacturerStore
{

    private $manufacturerId;
    private $storeId;
    // Getter & Setter method
    public function getManufacturerId()
    {
        return $this->manufacturerId;
    }

    public function getStoreId()
    {
        return $this->storeId;
    }

    public function setManufacturerId($val)
    {
        $this->manufacturerId = intval($val);
    }

    public function setStoreId($val)
    {
        $this->storeId = intval($val);
    }


    /**
     * Save ManufacturerStore information
     *
     * @return mixed
     */
    public function save()
    {
        $result["success"] = true;
        $result["message"] = "";

        $table    = "manufacturer_store";
        $fieldset = array("manufacturer_id","store_id");
        $valueset = array($this->getManufacturerId(),$this->getStoreId());

        Connection::insertData($table,$fieldset,$valueset,$insert_id);
        $result["success"] = true;
        $result["message"] = "Insert Successful.";

        return $result;

    }


    /**
     * Get manufacturer store information by ManufacturerId
     * @param $manufacturerId
     * @return ManufacturerStore|null
     */
    public static function loadById( $manufacturerId )
    {

        $manufacturerId  = intval($manufacturerId);

        $objManufacturerStore = NULL;

        $table      = "manufacturer_store";
        $condition 	= "AND manufacturer_id=".$manufacturerId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objManufacturerStore = new ManufacturerStore();
            $objManufacturerStore->setManufacturerId($resultRow["manufacturer_id"]);
            $objManufacturerStore->setStoreId($resultRow["store_id"]);

        }

        return $objManufacturerStore;
    }


    /**
     * Get all manufacturer store
     *
     * @return array
     */
    public static function load()
    {

        $objManufacturerStoreArr = array();

        $table      = "manufacturer_store";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objManufacturerStore = new ManufacturerStore();
                $objManufacturerStore->setManufacturerId($resultRow["manufacturer_id"]);
                $objManufacturerStore->setStoreId($resultRow["store_id"]);

                $objManufacturerStoreArr[] = $objManufacturerStore;
            }

        }

        return $objManufacturerStoreArr;
    }


    /**
     * Delete Manufacturer store by ManufacturerId
     *
     * @param $manufacturerId
     * @return bool
     */
    public static function deleteById( $manufacturerId )
    {
        $manufacturerId = intval( $manufacturerId );
        return Connection::delData("manufacturer_store", " AND manufacturer_id=".$manufacturerId);
    }

}
?>