<?php



/**
 *
 * Country class
 *
 *
 * @package     Country
 * @category    Library
 * @author      Juzz Sports
 * @date		01-06-2014
 */

Class Country
{

    private $countryId;
    private $name;
    private $isoCode2;
    private $isoCode3;
    private $addressFormat;
    private $postcodeRequired;
    private $isActive;

    /**
     * Setter and getter method
     */

    public function getCountryId()
    {
        return $this->countryId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getIsoCode2()
    {
        return $this->isoCode2;
    }

    public function getIsoCode3()
    {
        return $this->isoCode3;
    }

    public function getAddressFormat()
    {
        return $this->addressFormat;
    }

    public function getPostcodeRequired()
    {
        return $this->postcodeRequired;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setCountryId($val)
    {
        $this->countryId = intval($val);
    }

    public function setName($val)
    {
        $this->name = $val;
    }

    public function setIsoCode2($val)
    {
        $this->isoCode2 = $val;
    }

    public function setIsoCode3($val)
    {
        $this->isoCode3 = $val;
    }

    public function setAddressFormat($val)
    {
        $this->addressFormat = $val;
    }

    public function setPostcodeRequired($val)
    {
        $this->postcodeRequired = intval($val);
    }

    public function setIsActive($val)
    {
        $this->isActive = intval($val);
    }

    /**
     * Save / Update country information
     * @return mixed
     */
    public function save()
    {
        $countryId = intval($this->getCountryId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "country";
        $fieldset = array("name","iso_code_2","iso_code_3","address_format","postcode_required","is_active");
        $valueset = array($this->getName(),$this->getIsoCode2(),$this->getIsoCode3(),$this->getAddressFormat(),$this->getPostcodeRequired(),$this->getIsActive());

        if($countryId > 0){
            $condition = "AND country_id=".$countryId;
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
                $this->setCountryId($insert_id);
            }else{
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }


    /**
     * Get country information by countryId
     *
     * @param $countryId
     * @return Country|null
     */
    public static function loadById( $countryId )
    {

        $countryId  = intval($countryId);

        $objCountry = NULL;

        $table      = "country";
        $condition 	= "AND country_id=".$countryId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objCountry = new Country();
            $objCountry->setCountryId($resultRow["country_id"]);
            $objCountry->setName($resultRow["name"]);
            $objCountry->setIsoCode2($resultRow["iso_code_2"]);
            $objCountry->setIsoCode3($resultRow["iso_code_3"]);
            $objCountry->setAddressFormat($resultRow["address_format"]);
            $objCountry->setPostcodeRequired($resultRow["postcode_required"]);
            $objCountry->setIsActive($resultRow["is_active"]);

        }

        return $objCountry;
    }


    /**
     * Get all country information
     *
     * @param int $start
     * @param int $limit
     * @return array
     */
    public static function load($start = 0, $limit = 0)
    {
        $start      = intval($start);
        $limit      = intval($limit);

        $objCountryArr = array();

        $table      = "country";
        $condition 	= "";
        $fields 	= "*";

        $limitStr   = "";
        if($limit)
            $limitStr = " LIMIT ".$start.", ".$limit;

        $row  	= Connection::getAllData($table, $condition, $fields, "ORDER BY name ASC", $limitStr);

        if( $row ) {

            foreach( $row as $resultRow ){

                $objCountry = new Country();
                $objCountry->setCountryId($resultRow["country_id"]);
                $objCountry->setName($resultRow["name"]);
                $objCountry->setIsoCode2($resultRow["iso_code_2"]);
                $objCountry->setIsoCode3($resultRow["iso_code_3"]);
                $objCountry->setAddressFormat($resultRow["address_format"]);
                $objCountry->setPostcodeRequired($resultRow["postcode_required"]);
                $objCountry->setIsActive($resultRow["is_active"]);

                $objCountryArr[] = $objCountry;
            }

        }

        return $objCountryArr;
    }


    /**
     * Delete country information by countryId
     * @param $countryId
     * @return bool
     */
    public static function deleteById( $countryId )
    {
        $countryId = intval( $countryId );
        return Connection::delData("country", " AND country_id=".$countryId);
    }

    /**
     * get array with countryId & Country name
     *
     * @return array
     */
    public static function getCountryList()
    {
        $objCountryArr = array();

        $table      = "country";
        $condition 	= "";
        $fields 	= " country_id ,name ";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");
        $objCountryArr = array();
        if( $row ) {
            foreach( $row as $resultRow ){
                $objCountryArr[$resultRow["country_id"]] = $resultRow["name"];
            }
        }
        return $objCountryArr;
    }

    /**
     * get total number of record exist in database
     */
    public static function  getTotalCountry()
    {
        $table      = "country";
        $condition  = "";

        return Connection::getCountData($table, $condition);

    }

     /**
     * check Country is exist or not in database
     *
     * @param $countryCode
     * @param $countryId
     * @return bool
     */
    public static function isCountryExist($country,$countryCode,$countryId)
    {
        $countryCode    = stripform($countryCode);
        $country        = stripform($country);
        $countryId      = intval($countryId);

        $table       = "country";
        $condition   = "AND (iso_code_2 ='" . dbsafe($countryCode) . "' OR name ='" . dbsafe($country) . "') ";
        $condition  .= ($countryId) ? " AND country_id != ".$countryId : '';

        return  Connection::getCountData($table, $condition);

    }

    public static function disableCountryById($countryId, $value)
    {
        $countryId   = intval($countryId);
        $value       = intval($value);

        $table      = "country";
        $condition  = "AND country_id=" . $countryId;
        $fields     = "*";

        // fetch result from database
        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if($resultRow){

            $objCountry = new Country();
            $objCountry->setCountryId($resultRow["country_id"]);
            $objCountry->setName($resultRow["name"]);
            $objCountry->setIsoCode2($resultRow["iso_code_2"]);
            $objCountry->setIsoCode3($resultRow["iso_code_3"]);
            $objCountry->setAddressFormat($resultRow["address_format"]);
            $objCountry->setPostcodeRequired($resultRow["postcode_required"]);
            $objCountry->setIsActive($value);


            return $objCountry->save();
        }
        return 0;
    }


}
?>
