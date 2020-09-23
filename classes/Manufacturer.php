<?php



/**
 *
 * Manufacturer class
 *
 *
 * @package     Manufacturer
 * @category    Library
 * @author      Juzz Sports
 * @date		02-06-2014
 */

Class Manufacturer
{

    private $manufacturerId;
    private $name;
    private $image;
    private $filePath;
    private $sortOrder;
    private $isActive;

    /**
     * Setter && Getter function
     */
    public function getManufacturerId()
    {
        return $this->manufacturerId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getFilePath()
    {
        return $this->filePath;
    }

    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setManufacturerId($val)
    {
        $this->manufacturerId = intval($val);
    }

    public function setName($val)
    {
        $this->name = $val;
    }

    public function setImage($val)
    {
        $this->image = $val;
    }

    public function setFilePath($val)
    {
        $this->filePath = $val;
    }

    public function setSortOrder($val)
    {
        $this->sortOrder = intval($val);
    }

    public function setIsActive($val)
    {
        $this->isActive = intval($val);
    }

    /**
     * Save & Update function
     *
     * @return mixed
     */
    public function save()
    {
        $manufacturerId = intval($this->getManufacturerId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "manufacturer";
        $fieldset = array("name","image","file_path","sort_order","is_active");
        $valueset = array($this->getName(),$this->getImage(),$this->getFilePath(),$this->getSortOrder(),$this->getIsActive());

        if($manufacturerId > 0){
            $condition = "AND manufacturer_id=".$manufacturerId;
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
            if(Connection::insertData($table,$fieldset,$valueset,$insert_id, 1)){
                $result["success"] = true;
                $result["message"] = "Insert Successful.";
                $this->setManufacturerId($insert_id);
            }else{
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }


    /**
     * get Manufacturer information by ManufacturerId
     *
     * @param $manufacturerId
     * @return Manufacturer|null
     */
    public static function loadById( $manufacturerId )
    {

        $manufacturerId  = intval($manufacturerId);

        $objManufacturer = NULL;

        $table      = "manufacturer";
        $condition 	= "AND manufacturer_id=".$manufacturerId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objManufacturer = new Manufacturer();
            $objManufacturer->setManufacturerId($resultRow["manufacturer_id"]);
            $objManufacturer->setName($resultRow["name"]);
            $objManufacturer->setImage($resultRow["image"]);
            $objManufacturer->setFilePath($resultRow["file_path"]);
            $objManufacturer->setSortOrder($resultRow["sort_order"]);
            $objManufacturer->setIsActive($resultRow["is_active"]);
        }

        return $objManufacturer;
    }


    /**
     * get Manufacturer name by ManufacturerId
     *
     * @param $manufacturerId
     * @return Manufacturer|null
     */
    public static function getManufacturerNameById( $manufacturerId )
    {

        $manufacturerId  = intval($manufacturerId);

        $table      = "manufacturer";
        $condition 	= "AND manufacturer_id=".$manufacturerId;
        $fields 	= "name";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        return $resultRow["name"];
    }


    /**
     * get all Manufacturer information
     *
     * @param int $start
     * @param int $limit
     * @return array
     */
    public static function load($start = 0, $limit = 0, $isActive = 0)
    {
        $start         = intval($start);
        $limit         = intval($limit);
        $isActive      = intval($isActive);



        $objManufacturerArr = array();

        $table      = "manufacturer";
        $condition 	= ($isActive ? " AND is_active = ".$isActive : "");
        $fields 	= "*";

        $limitStr = "";
        if($limit){
            $limitStr = "LIMIT ".$start.", ".$limit;
        }

        $row  	= Connection::getAllData($table, $condition, $fields, "", $limitStr);

        if( $row ) {

            foreach( $row as $resultRow ){

                $objManufacturer = new Manufacturer();
                $objManufacturer->setManufacturerId($resultRow["manufacturer_id"]);
                $objManufacturer->setName($resultRow["name"]);
                $objManufacturer->setImage($resultRow["image"]);
                $objManufacturer->setSortOrder($resultRow["sort_order"]);
                $objManufacturer->setIsActive($resultRow["is_active"]);

                $objManufacturerArr[] = $objManufacturer;
            }

        }

        return $objManufacturerArr;
    }

    /**
     * get Manufacturer information by Manufacturer name/or manufacturerId
     *
     * @param $name
     * @param $manufacturerId
     * @return bool
     */
    public static function isManufacturerExist($name,$manufacturerId)
    {
        $table       = "manufacturer";
        $condition   = "AND name ='" . dbsafe($name) . "'";
        $condition .= ($manufacturerId)?" AND manufacturer_id != ".dbsafe($manufacturerId):"";
        return  Connection::getCountData($table, $condition);

    }

    /**
     * get Last ManufacturerId
     * @return int
     */
    public static function getLastManufacturerId()
    {
        $table       = "manufacturer";
        $condition   = "";
        $fields = "manufacturer_id";
        $orders = "ORDER BY manufacturer_id DESC";
        $limits = "LIMIT 1";

        return Connection::getSingleData($table, $condition,$fields,$orders,$limits);

    }

    /**
     * get total number of record exist in database
     */
    public static function  getTotalManufacturer()
    {
        $table = "manufacturer";
        $condition = "";

        return Connection::getCountData($table, $condition);

    }

    /**
     * Delete by manufacturerId
     * @param $manufacturerId
     * @return bool
     */
    public static function deleteById( $manufacturerId )
    {
        $manufacturerId = intval( $manufacturerId );
        return Connection::delData("manufacturer", " AND manufacturer_id=".$manufacturerId);
    }

    public static function disableManufacturerById($manufacturerId, $value)
    {
        $manufacturerId   = intval($manufacturerId);
        $value            = intval($value);

        $table      = "manufacturer";
        $condition  = "AND manufacturer_id=" . $manufacturerId;
        $fields     = "*";

        // fetch result from database
        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");
        if($resultRow){

            $objManufacturer = new Manufacturer();
            $objManufacturer->setManufacturerId($resultRow["manufacturer_id"]);
            $objManufacturer->setName($resultRow["name"]);
            $objManufacturer->setImage($resultRow["image"]);
            $objManufacturer->setSortOrder($resultRow["sort_order"]);
            $objManufacturer->setIsActive($value);

            return $objManufacturer->save();
        }
        return 0;
    }
}
?>