<?php

/*
 * Currency class
 *
 *
 * @package     Country
 * @category    Library
 * @author      Juzz Sports
 * @date		01-06-2014
 */

Class Currency
{

    private $currency_id ;
    private $title;
    private $code;
    private $symbol_left;
    private $symbol_right;
    private $decimal_place;
    private $value;
    private $status;
    private $date_modified;

   
    public function getCurrencyId()
    {
        return $this->currency_id;
    }

    public function getTitle()
    {
       return $this->title ;
    }

    public function getCode()
    {
       return $this->code;
    }

    public function getSymbolLeft()
    {
       return $this->symbol_left;
    }

    public function getSymbolRight()
    {
        return $this->symbol_right;
    }

    public function getDecimalPlace()
    {
        return $this->decimal_place;
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
        return $this->date_modified ;
    }

    // Setter 

    public function setCurrencyId($val)
    {
        $this->currency_id = intval($val);
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
        $this->symbol_left = $val;
    }

    public function setSymbolRight($val)
    {
        $this->symbol_right = $val;
    }

    public function setDecimalPlace($val)
    {
        $this->decimal_place = $val;
    }

    public function setValue($val)
    {
        $this->value = $val;
    }
    

    public function setStatus($val)
    {
        $this->status = intval($val);
    }

    public function setDateModified($val)
    {
        $this->date_modified = $val;
    }

    public static function load()
    {

        $objCurrancyArr = array();

        $table      = "currency";
//        $table = $this->table;
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "",0);

        if( $row ) {

            foreach( $row as $resultRow ){
               
                $objCurrancy = new Currency();
                $objCurrancy->setCurrencyId($resultRow["currency_id"]);
                $objCurrancy->setTitle($resultRow["title"]);
                $objCurrancy->setCode($resultRow["code"]);
                $objCurrancy->setSymbolLeft($resultRow["symbol_left"]);
                $objCurrancy->setSymbolRight($resultRow["symbol_right"]);
                $objCurrancy->setDecimalPlace($resultRow["decimal_place"]);
                $objCurrancy->setValue($resultRow["value"]);
                $objCurrancy->setStatus($resultRow["status"]);
                $objCurrancy->setDateModified($resultRow["date_modified"]);
                

                $objCurrancyArr[] = $objCurrancy;
            }

        }

        return $objCurrancyArr;
    }

    public static function fetchField($byfield){     
        return Connection::getSingleData("currency", sprintf("code='%s'",$byfield), "*", "", " LIMIT 1 ");
    }

}
?>