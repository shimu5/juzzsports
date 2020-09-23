<?php

/**
 *
 * ReturnAction class
 *
 *
 * @package     ReturnAction
 * @category    Library
 * @author      Juzz Sports
 * @date		12-06-2014
 */

Class ReturnAction
{

    private $returnActionId;
    private $languageId;
    private $name;



    /**
     * All getter and setter functions
     *
     */
    public function getReturnActionId()
    {
        return $this->returnActionId;
    }

    public function getLanguageId()
    {
        return $this->languageId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setReturnActionId($val)
    {
        $this->returnActionId = intval($val);
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
        $returnActionId = intval($this->getReturnActionId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "return_action";
        $fieldset = array("language_id","name");
        $valueset = array($this->getLanguageId(),$this->getName());

        if($returnActionId > 0){
            $condition = "AND return_action_id=".$returnActionId;
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
                $this->setReturnActionId($insert_id);
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
     * @return ReturnAction
     *
     */
    public static function loadById( $returnActionId )
    {

        $returnActionId  = intval($returnActionId);

        $objReturnAction = NULL;

        $table      = "return_action";
        $condition 	= "AND return_action_id=".$returnActionId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objReturnAction = new ReturnAction();
            $objReturnAction->setReturnActionId($resultRow["return_action_id"]);
            $objReturnAction->setLanguageId($resultRow["language_id"]);
            $objReturnAction->setName($resultRow["name"]);

        }

        return $objReturnAction;
    }





    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function load()
    {

        $objReturnActionArr = array();

        $table      = "return_action";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {
            foreach( $row as $resultRow ){
                $objReturnActionArr[$resultRow["return_action_id"]] = $resultRow["name"];
            }
        }

        return $objReturnActionArr;
    }





    /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
    public static function deleteById( $returnActionId )
    {
        $returnActionId = intval( $returnActionId );
        return Connection::delData("return_action", " AND return_action_id=".$returnActionId);
    }

}
?>