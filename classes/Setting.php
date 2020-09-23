<?php

/**
 *
 * Setting class
 *
 *
 * @package     Setting
 * @category    Library
 * @author      Juzz Sports
 * @date		03-06-2014
 */

Class Setting
{

    private $id;
    private $key;
    private $value;

    public function getId()
    {
        return $this->id;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setId($val)
    {
        $this->id = intval($val);
    }

    public function setKey($val)
    {
        $this->key = $val;
    }

    public function setValue($val)
    {
        $this->value = $val;
    }



    public function save()
    {
        $id = intval($this->getId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "settings";
        $fieldset = array("key","value");
        $valueset = array($this->getKey(),$this->getValue());

        if($id > 0){
            $condition = "AND id=".$id;
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
                $this->setId($insert_id);
             }else{
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
             }
        }

        return $result;

    }



    public static function loadById( $id )
    {

        $id  = intval($id);

        $objSetting = NULL;

        $table      = "settings";
        $condition 	= "AND id=".$id;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objSetting = new Setting();
            $objSetting->setId($resultRow["id"]);
            $objSetting->setKey($resultRow["key"]);
            $objSetting->setValue($resultRow["value"]);

        }

        return $objSetting;
    }



    public static function load()
    {

        $objSettingArr = array();

        $table      = "settings";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objSetting = new Setting();
                $objSetting->setId($resultRow["id"]);
                $objSetting->setKey($resultRow["key"]);
                $objSetting->setValue($resultRow["value"]);

                $objSettingArr[] = $objSetting;
            }

        }

        return $objSettingArr;
    }



    public static function deleteById( $id )
    {
        $id = intval( $id );
        return Connection::delData("settings", " AND id=".$id);
    }

    public static function loadRows()
    {

        $objSettingArr = array();

        $table      = "settings";
        $condition 	= "";
        $fields 	= "*";

        return $row  	= Connection::getAllData($table, $condition, $fields, "", "");
    }


}
 ?>