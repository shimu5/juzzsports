<?php



/**
 *
 * Zone class
 *
 *
 * @package     Zone
 * @category    Library
 * @author      Juzz Sports
 * @date        01-06-2014
 */

Class Zone
{

    private $zoneId;
    private $countryId;
    private $name;
    private $code;
    private $status;

    /**
     * Setter and getter method
     */
    public function getZoneId()
    {
        return $this->zoneId;
    }

    public function getCountryId()
    {
        return $this->countryId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setZoneId($val)
    {
        $this->zoneId = intval($val);
    }

    public function setCountryId($val)
    {
        $this->countryId = intval($val);
    }

    public function setName($val)
    {
        $this->name = $val;
    }

    public function setCode($val)
    {
        $this->code = $val;
    }

    public function setStatus($val)
    {
        $this->status = intval($val);
    }

    /**
     * Save or update zone information
     */

    public function save()
    {
        $zoneId = intval($this->getZoneId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "zone";
        $fieldset = array("country_id", "name", "code", "status");
        $valueset = array($this->getCountryId(), $this->getName(), $this->getCode(), $this->getStatus());

        if ($zoneId > 0) {
            $condition = "AND zone_id=" . $zoneId;
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
                $this->setZoneId($insert_id);
            } else {
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }

    /**
     * get zone by zoneId
     *
     * @param $zoneId
     * @return null|Zone array
     */

    public static function loadById($zoneId)
    {

        $zoneId = intval($zoneId);

        $objZone = NULL;

        $table = "zone";
        $condition = "AND zone_id=" . $zoneId;
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objZone = new Zone();
            $objZone->setZoneId($resultRow["zone_id"]);
            $objZone->setCountryId($resultRow["country_id"]);
            $objZone->setName($resultRow["name"]);
            $objZone->setCode($resultRow["code"]);
            $objZone->setStatus($resultRow["status"]);

        }

        return $objZone;
    }

    /**
     * get all zones information
     *
     * @param int $start
     * @param int $limit
     * @return array
     */
    public static function load($start = 0, $limit = 0)
    {
        $start      = intval($start);
        $limit      = intval($limit);

        $objZoneArr = array();

        $table      = "zone";
        $condition  = "";
        $fields     = "*";
        $limitStr   = "";
        if($limit)
            $limitStr = " LIMIT ".$start . " , ". $limit;

        $row = Connection::getAllData($table, $condition, $fields, "", $limitStr);

        if ($row) {

            foreach ($row as $resultRow) {

                $objZone = new Zone();
                $objZone->setZoneId($resultRow["zone_id"]);
                $objZone->setCountryId($resultRow["country_id"]);
                $objZone->setName($resultRow["name"]);
                $objZone->setCode($resultRow["code"]);
                $objZone->setStatus($resultRow["status"]);

                $objZoneArr[] = $objZone;
            }

        }

        return $objZoneArr;
    }

    /**
     * get zone by countyId
     *
     * @param $countryId
     * @return Array | Zone list by countryId
     */
    public static function getZoneByCountryId($countryId)
    {

        $countryId  = intval($countryId);

        $objZoneArr = array();

        $table      = "zone";
        $condition  = "AND country_id=" . $countryId;
        $fields     = "*";

        $row = Connection::getAllData($table, $condition, $fields, "", "");

        if ($row) {

            foreach ($row as $resultRow) {

                $objZone = new Zone();
                $objZone->setZoneId($resultRow["zone_id"]);
                $objZone->setCountryId($resultRow["country_id"]);
                $objZone->setName($resultRow["name"]);
                $objZone->setCode($resultRow["code"]);
                $objZone->setStatus($resultRow["status"]);

                $objZoneArr[] = $objZone;
            }
        }
        return $objZoneArr;
    }


    /**
     * get total number of record exist in database
     */
    public static function  getTotalZone()
    {
        $table      = "zone";
        $condition  = "";

        return Connection::getCountData($table, $condition);

    }


    /**
     * check Zone is exist or not in database
     *
     * @param $name
     * @param $countryId
     * @param $zoneId
     * @return bool
     */
    public static function isZoneExist($name,$countryId,$zoneId)
    {
        $name        = stripform($name);
        $zoneId   = intval($zoneId);
        $countryId   = intval($countryId);

        $table       = "zone";
        $condition   = "AND name ='" . dbsafe($name) . "' ";
        $condition  .= ($zoneId) ? " AND zone_id != ".$zoneId : '';
        $condition  .= ($countryId) ? " AND country_id != ".$countryId : '';

        return  Connection::getCountData($table, $condition);

    }

    /**
     * @param $zoneId
     * @return bool
     */
    public static function deleteById($zoneId)
    {
        $zoneId = intval($zoneId);
        return Connection::delData("zone", " AND zone_id=" . $zoneId);
    }

    /**
     * Disable zone
     *
     * @param $zoneId
     * @param $value
     * @return int
     */
    public static function disableZoneById($zoneId, $value)
    {
        $zoneId   = intval($zoneId);
        $value    = intval($value);

        $table      = "zone";
        $condition  = "AND zone_id=" . $zoneId;
        $fields     = "*";

        // fetch result from database
        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if($resultRow){

            $objZone = new Zone();
            $objZone->setZoneId($resultRow["zone_id"]);
            $objZone->setCountryId($resultRow["country_id"]);
            $objZone->setName($resultRow["name"]);
            $objZone->setCode($resultRow["code"]);
            $objZone->setStatus($value);

            return $objZone->save();
        }
        return 0;
    }

}

?>