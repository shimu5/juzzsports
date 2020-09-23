<?php

/**
 *
 * HomePageSetting class
 *
 *
 * @package     HomePageSetting
 * @category    Library
 * @author      Juzz Sports
 * @date		05-06-2014
 */

Class HomePageSetting
{

    private $id;
    private $tagId;
    private $position;
    private $order;
    private $isActive;



     /**
     * All getter and setter functions
     *
     */
    public function getId()
    {
        return $this->id;
    }

    public function getTagId()
    {
        return $this->tagId;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setId($val)
    {
        $this->id = intval($val);
    }

    public function setTagId($val)
    {
        $this->tagId = intval($val);
    }

    public function setPosition($val)
    {
        $this->position = intval($val);
    }

    public function setOrder($val)
    {
        $this->order = intval($val);
    }

    public function setIsActive($val)
    {
        $this->isActive = intval($val);
    }



     /**
     * Insert and update information
     *
     * @return mixed
     *
     */



    public function save()
    {
        $id = intval($this->getId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "home_page_setting";
        $fieldset = array("tag_id","position","order","is_active");
        $valueset = array($this->getTagId(),$this->getPosition(),$this->getOrder(),$this->getIsActive());

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






     /**
     * get data from database by id
     *
     * @return HomePageSetting
     *
     */
public static function loadById( $id )
    {

        $id  = intval($id);

        $objHomePageSetting = NULL;

        $table      = "home_page_setting";
        $condition 	= "AND id=".$id;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objHomePageSetting = new HomePageSetting();
            $objHomePageSetting->setId($resultRow["id"]);
            $objHomePageSetting->setTagId($resultRow["tag_id"]);
            $objHomePageSetting->setPosition($resultRow["position"]);
            $objHomePageSetting->setOrder($resultRow["order"]);
            $objHomePageSetting->setIsActive($resultRow["is_active"]);

        }

        return $objHomePageSetting;
    }





     /**
     * get all data from database
     *
     * @return Array
     *
     */
public static function load()
    {

        $objHomePageSettingArr = array();

        $table      = "home_page_setting";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objHomePageSetting = new HomePageSetting();
                $objHomePageSetting->setId($resultRow["id"]);
                $objHomePageSetting->setTagId($resultRow["tag_id"]);
                $objHomePageSetting->setPosition($resultRow["position"]);
                $objHomePageSetting->setOrder($resultRow["order"]);
                $objHomePageSetting->setIsActive($resultRow["is_active"]);

                $objHomePageSettingArr[] = $objHomePageSetting;
            }

        }

        return $objHomePageSettingArr;
    }





     /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
public static function deleteById( $id )
    {
        $id = intval( $id );
        return Connection::delData("home_page_setting", " AND id=".$id);
    }

    /*
     * Home Page Tags fetch depend on position
     * return tags information
     */

    public function productTags($position=1 , $limit=0, $active=null){

        $table      = "home_page_setting";
        $sec_table = "tag";
        $condition 	= "";
        if($limit!=0) $limit = " limit {$limit}";
        $active = (isset($active))?" AND tag.is_active = {$active}":" ";       
        $sql = "Select * from $table
        JOIN $sec_table ON $table.tag_id=$sec_table.id
        WHERE $table.is_active=1  AND position={$position} {$active}  order by `order` ASC  $limit ";
        return Connection::getAllDataByQuery($sql);
    }

}
 ?>