<?php 
	
/**
 *
 * Currency class
 *
 *
 * @package     Currency
 * @category    Library
 * @author      Juzz Sports
 * @date		03-06-2014
 */

Class Currency
{

    private $currencyId;
    private $title;
    private $code;
    private $symbolLeft;
    private $symbolRight;
    private $decimalPlace;
    private $value;
    private $status;
    private $dateModified;

    public function getCurrencyId() 
    { 
        return $this->currencyId; 
    }

    public function getTitle() 
    { 
        return $this->title; 
    }

    public function getCode() 
    { 
        return $this->code; 
    }

    public function getSymbolLeft() 
    { 
        return $this->symbolLeft; 
    }

    public function getSymbolRight() 
    { 
        return $this->symbolRight; 
    }

    public function getDecimalPlace() 
    { 
        return $this->decimalPlace; 
    }

    public function getValue() 
    { 
        return $this->value; 
    }

    public function getStatus() 
    { 
        return $this->status; 
    }

    public function getDateModified() 
    { 
        return $this->dateModified; 
    }

    public function setCurrencyId($val) 
    { 
        $this->currencyId = intval($val); 
    }

    public function setTitle($val) 
    { 
        $this->title = $val; 
    }

    public function setCode($val) 
    { 
        $this->code = $val; 
    }

    public function setSymbolLeft($val) 
    { 
        $this->symbolLeft = $val; 
    }

    public function setSymbolRight($val) 
    { 
        $this->symbolRight = $val; 
    }

    public function setDecimalPlace($val) 
    { 
        $this->decimalPlace = $val; 
    }

    public function setValue($val) 
    { 
        $this->value = floatval($val); 
    }

    public function setStatus($val) 
    { 
        $this->status = intval($val); 
    }

    public function setDateModified($val) 
    { 
        $this->dateModified = $val; 
    }



    public function save()
    {
        $currencyId = intval($this->getCurrencyId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "currency";
        $fieldset = array("title","code","symbol_left","symbol_right","decimal_place","value","status","date_modified");
        $valueset = array($this->getTitle(),$this->getCode(),$this->getSymbolLeft(),$this->getSymbolRight(),$this->getDecimalPlace(),$this->getValue(),$this->getStatus(),$this->getDateModified());

        if($currencyId > 0){
            $condition = "AND currency_id=".$currencyId;
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
                $this->setCurrencyId($insert_id);
             }else{
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
             }
        }

        return $result;
        
    }



    public static function loadById( $currencyId )
    {

        $currencyId  = intval($currencyId);

        $objCurrency = NULL;

        $table      = "currency";
        $condition 	= "AND currency_id=".$currencyId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objCurrency = new Currency();
            $objCurrency->setCurrencyId($resultRow["currency_id"]);
            $objCurrency->setTitle($resultRow["title"]);
            $objCurrency->setCode($resultRow["code"]);
            $objCurrency->setSymbolLeft($resultRow["symbol_left"]);
            $objCurrency->setSymbolRight($resultRow["symbol_right"]);
            $objCurrency->setDecimalPlace($resultRow["decimal_place"]);
            $objCurrency->setValue($resultRow["value"]);
            $objCurrency->setStatus($resultRow["status"]);
            $objCurrency->setDateModified($resultRow["date_modified"]);
            
        }

        return $objCurrency;
    }



    public static function load($start = 0, $limit = 0)
    {
        $start         = intval($start);
        $limit         = intval($limit);
        $objCurrencyArr = array();

        $table      = "currency";
        $condition 	= "";
        $fields 	= "*";

        $limitStr = "";
        if($limit){
            $limitStr = "LIMIT ".$start.", ".$limit;
        }

        $row  	= Connection::getAllData($table, $condition, $fields, "ORDER BY title ASC", $limitStr);

        if( $row ) {

            foreach( $row as $resultRow ){

                $objCurrency = new Currency();
                $objCurrency->setCurrencyId($resultRow["currency_id"]);
                $objCurrency->setTitle($resultRow["title"]);
                $objCurrency->setCode($resultRow["code"]);
                $objCurrency->setSymbolLeft($resultRow["symbol_left"]);
                $objCurrency->setSymbolRight($resultRow["symbol_right"]);
                $objCurrency->setDecimalPlace($resultRow["decimal_place"]);
                $objCurrency->setValue($resultRow["value"]);
                $objCurrency->setStatus($resultRow["status"]);
                $objCurrency->setDateModified($resultRow["date_modified"]);
                
                $objCurrencyArr[] = $objCurrency;
            }

        }

        return $objCurrencyArr;
    }


    /**
     * get total number of record exist in database
     */
    public static function  getTotalCurrency()
    {
        $table = "currency";
        $condition = "";

        return Connection::getCountData($table, $condition);

    }

    /**
     * check currency is exist or not in database
     *
     * @param $code
     * @param $currencyId
     * @return bool
     */
    public static function isCurrencyExist($currency,$code,$currencyId)
    {
        $code        = stripform($code);
        $currency    = stripform($currency);
        $currencyId  = intval($currencyId);

        $table       = "currency";
        $condition   = "AND (code ='" . dbsafe($code) . "' OR title ='" . dbsafe($currency) . "') ";
        $condition  .= ($currencyId) ? " AND currency_id != ".$currencyId : '';

        return  Connection::getCountData($table, $condition);

    }


    /**
     * Delete currency by CurrencyId
     *
     * @param $currencyId
     * @return bool
     */
    public static function deleteById( $currencyId )
    {
        $currencyId = intval( $currencyId );
        return Connection::delData("currency", " AND currency_id=".$currencyId);
    }
	public static function fetchField($byfield){     
        return Connection::getSingleData("currency", sprintf("AND code='%s'",$byfield), "*", "", " LIMIT 1 ");
    }

    public static function disableCurrencyById($currencyId, $value)
    {
        $currencyId   = intval($currencyId);
        $value        = intval($value);

        $table      = "currency";
        $condition  = "AND currency_id=" . $currencyId;
        $fields     = "*";

        // fetch result from database
        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if($resultRow){

            $objCurrency = new Currency();
            $objCurrency->setCurrencyId($resultRow["currency_id"]);
            $objCurrency->setTitle($resultRow["title"]);
            $objCurrency->setCode($resultRow["code"]);
            $objCurrency->setSymbolLeft($resultRow["symbol_left"]);
            $objCurrency->setSymbolRight($resultRow["symbol_right"]);
            $objCurrency->setDecimalPlace($resultRow["decimal_place"]);
            $objCurrency->setValue($resultRow["value"]);
            $objCurrency->setDateModified($resultRow["date_modified"]);
            $objCurrency->setStatus($value);

            return $objCurrency->save();
        }
        return 0;
    }

}
 ?>