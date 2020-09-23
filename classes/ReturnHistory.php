<?php

/**
 *
 * ReturnHistory class
 *
 *
 * @package     ReturnHistory
 * @category    Library
 * @author      Juzz Sports
 * @date		11-06-2014
 */

Class ReturnHistory
{

    private $returnHistoryId;
    private $returnId;
    private $returnStatusId;
    private $notify;
    private $comment;
    private $dateAdded;



    /**
     * All getter and setter functions
     *
     */
    public function getReturnHistoryId()
    {
        return $this->returnHistoryId;
    }

    public function getReturnId()
    {
        return $this->returnId;
    }

    public function getReturnStatusId()
    {
        return $this->returnStatusId;
    }

    public function getNotify()
    {
        return $this->notify;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    public function setReturnHistoryId($val)
    {
        $this->returnHistoryId = intval($val);
    }

    public function setReturnId($val)
    {
        $this->returnId = intval($val);
    }

    public function setReturnStatusId($val)
    {
        $this->returnStatusId = intval($val);
    }

    public function setNotify($val)
    {
        $this->notify = intval($val);
    }

    public function setComment($val)
    {
        $this->comment = $val;
    }

    public function setDateAdded($val)
    {
        $this->dateAdded = $val;
    }



    /**
     * Insert and update information
     *
     * @return mixed
     *
     */



    public function save()
    {
        $returnHistoryId = intval($this->getReturnHistoryId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "return_history";
        $fieldset = array("return_id","return_status_id","notify","comment","date_added");
        $valueset = array($this->getReturnId(),$this->getReturnStatusId(),$this->getNotify(),$this->getComment(),$this->getDateAdded());

        if($returnHistoryId > 0){
            $condition = "AND return_history_id=".$returnHistoryId;
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
                $this->setReturnHistoryId($insert_id);
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
     * @return ReturnHistory
     *
     */
    public static function loadById( $returnHistoryId )
    {

        $returnHistoryId  = intval($returnHistoryId);

        $objReturnHistory = NULL;

        $table      = "return_history";
        $condition 	= "AND return_history_id=".$returnHistoryId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objReturnHistory = new ReturnHistory();
            $objReturnHistory->setReturnHistoryId($resultRow["return_history_id"]);
            $objReturnHistory->setReturnId($resultRow["return_id"]);
            $objReturnHistory->setReturnStatusId($resultRow["return_status_id"]);
            $objReturnHistory->setNotify($resultRow["notify"]);
            $objReturnHistory->setComment($resultRow["comment"]);
            $objReturnHistory->setDateAdded($resultRow["date_added"]);

        }

        return $objReturnHistory;
    }





    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function load($start, $limit)
    {
        $start      = intval($start);
        $limit      = intval($limit);

        $objReturnHistoryArr = array();

        $table      = "return_history";
        $condition 	= "";
        $fields 	= "*";

        $limitStr   = "";
        if($limit)
            $limitStr = " LIMIT ".$start.", ".$limit;

        $row  	= Connection::getAllData($table, $condition, $fields, "", $limitStr);

        if( $row ) {

            foreach( $row as $resultRow ){

                $objReturnHistory = new ReturnHistory();
                $objReturnHistory->setReturnHistoryId($resultRow["return_history_id"]);
                $objReturnHistory->setReturnId($resultRow["return_id"]);
                $objReturnHistory->setReturnStatusId($resultRow["return_status_id"]);
                $objReturnHistory->setNotify($resultRow["notify"]);
                $objReturnHistory->setComment($resultRow["comment"]);
                $objReturnHistory->setDateAdded($resultRow["date_added"]);

                $objReturnHistoryArr[] = $objReturnHistory;
            }

        }

        return $objReturnHistoryArr;
    }





    /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
    public static function deleteById( $returnHistoryId )
    {
        $returnHistoryId = intval( $returnHistoryId );
        return Connection::delData("return_history", " AND return_history_id=".$returnHistoryId);
    }


    /**
     * get total number of record exist in database
     */
    public static function  getTotalData()
    {
        $table      = "return_history";
        $condition  = "";
        return Connection::getCountData($table, $condition);

    }


    public static function deleteByReturnId($returnId)
    {
        $orderId = intval($returnId);
        return Connection::delData("return_history", " AND return_id=" . $returnId);
    }

}
?>