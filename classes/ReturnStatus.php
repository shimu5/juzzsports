<?php

/**
 *
 * ReturnStatus class
 *
 *
 * @package     ReturnStatus
 * @category    Library
 * @author      Juzz Sports
 * @date		11-06-2014
 */

Class ReturnStatus
{

    private $returnStatusId;
    private $languageId;
    private $name;



    /**
     * All getter and setter functions
     *
     */
    public function getReturnStatusId()
    {
        return $this->returnStatusId;
    }

    public function getLanguageId()
    {
        return $this->languageId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setReturnStatusId($val)
    {
        $this->returnStatusId = intval($val);
    }

    public function setLanguageId($val)
    {
        $this->languageId = intval($val);
    }

    public function setName($val)
    {
        $this->name = $val;
    }



    /**
     * Insert and update information
     *
     * @return mixed
     *
     */



    public function save()
    {
        $returnStatusId = intval($this->getReturnStatusId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "return_status";
        $fieldset = array("language_id","name");
        $valueset = array($this->getLanguageId(),$this->getName());

        if($returnStatusId > 0){
            $condition = "AND return_status_id=".$returnStatusId;
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
                $this->setReturnStatusId($insert_id);
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
     * @return ReturnStatus
     *
     */
    public static function loadById( $returnStatusId )
    {

        $returnStatusId  = intval($returnStatusId);

        $objReturnStatus = NULL;

        $table      = "return_status";
        $condition 	= "AND return_status_id=".$returnStatusId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objReturnStatus = new ReturnStatus();
            $objReturnStatus->setReturnStatusId($resultRow["return_status_id"]);
            $objReturnStatus->setLanguageId($resultRow["language_id"]);
            $objReturnStatus->setName($resultRow["name"]);

        }

        return $objReturnStatus;
    }





    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function load()
    {

        $objReturnStatusArr = array();

        $table      = "return_status";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {
            foreach( $row as $resultRow ){
                $objReturnStatusArr[$resultRow["return_status_id"]] = $resultRow["name"];
            }
        }
        return $objReturnStatusArr;
    }





    /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
    public static function deleteById( $returnStatusId )
    {
        $returnStatusId = intval( $returnStatusId );
        return Connection::delData("return_status", " AND return_status_id=".$returnStatusId);
    }

}
?>