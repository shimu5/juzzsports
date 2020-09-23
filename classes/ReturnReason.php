<?php

/**
 *
 * ReturnReason class
 *
 *
 * @package     ReturnReason
 * @category    Library
 * @author      Juzz Sports
 * @date		11-06-2014
 */

Class ReturnReason
{

    private $returnReasonId;
    private $languageId;
    private $name;



    /**
     * All getter and setter functions
     *
     */
    public function getReturnReasonId()
    {
        return $this->returnReasonId;
    }

    public function getLanguageId()
    {
        return $this->languageId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setReturnReasonId($val)
    {
        $this->returnReasonId = intval($val);
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
        $returnReasonId = intval($this->getReturnReasonId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "return_reason";
        $fieldset = array("language_id","name");
        $valueset = array($this->getLanguageId(),$this->getName());

        if($returnReasonId > 0){
            $condition = "AND return_reason_id=".$returnReasonId;
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
                $this->setReturnReasonId($insert_id);
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
     * @return ReturnReason
     *
     */
    public static function loadById( $returnReasonId )
    {

        $returnReasonId  = intval($returnReasonId);

        $objReturnReason = NULL;

        $table      = "return_reason";
        $condition 	= "AND return_reason_id=".$returnReasonId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objReturnReason = new ReturnReason();
            $objReturnReason->setReturnReasonId($resultRow["return_reason_id"]);
            $objReturnReason->setLanguageId($resultRow["language_id"]);
            $objReturnReason->setName($resultRow["name"]);

        }

        return $objReturnReason;
    }





    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function load()
    {

        $objReturnReasonArr = array();

        $table      = "return_reason";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objReturnReasonArr[$resultRow["return_reason_id"]] = $resultRow["name"];
            }

        }

        return $objReturnReasonArr;
    }





    /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
    public static function deleteById( $returnReasonId )
    {
        $returnReasonId = intval( $returnReasonId );
        return Connection::delData("return_reason", " AND return_reason_id=".$returnReasonId);
    }

}
?>