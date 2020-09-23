<?php
/**
 *
 * Tag class
 *
 *
 * @package     Tag
 * @category    Library
 * @author      Juzz Sports
 * @date		04-06-2014
 */

Class Tag
{

    private $id;
    private $tagName;
    private $tagDescription;
    private $isActive;

    /**
     * Getter & Setter functions
     */
    public function getId()
    {
        return $this->id;
    }

    public function getTagName()
    {
        return $this->tagName;
    }

    public function getTagDescription()
    {
        return $this->tagDescription;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setId($val)
    {
        $this->id = intval($val);
    }

    public function setTagName($val)
    {
        $this->tagName = $val;
    }

    public function setTagDescription($val)
    {
        $this->tagDescription = $val;
    }

    public function setIsActive($val)
    {
        $this->isActive = intval($val);
    }


    /**
     * Save / Update Tag information
     */
    public function save()
    {
        $id = intval($this->getId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "tag";
        $fieldset = array("tag_name","tag_description","is_active");
        $valueset = array($this->getTagName(),$this->getTagDescription(),$this->getIsActive());

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
     * Get Tag by Id
     * @param $id
     * @return null|Tag
     */
    public static function loadById( $id , $active = null )
    {

        $id  = intval($id);

        $objTag = NULL;

        $table      = "tag";
        $active = (isset($active))?" AND tag.is_active = {$active}":" ";
        $condition 	= " $active AND id=".$id;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objTag = new Tag();
            $objTag->setId($resultRow["id"]);
            $objTag->setTagName($resultRow["tag_name"]);
            $objTag->setTagDescription($resultRow["tag_description"]);
            $objTag->setIsActive($resultRow["is_active"]);

        }

        return $objTag;
    }

    /**
     * Get All Tag
     *
     * @param int $start
     * @param int $limit
     * @return array
     */
    public static function load($start = 0, $limit = 0)
    {
        $start = intval($start);
        $limit = intval($limit);
        $objTagArr = array();

        $table      = "tag";
        $condition 	= "";
        $fields 	= "*";

        if($limit)
            $limitStr = " LIMIT ".$start ." , ".$limit;

        $row  	= Connection::getAllData($table, $condition, $fields, "", $limitStr);

        if( $row ) {

            foreach( $row as $resultRow ){

                $objTag = new Tag();
                $objTag->setId($resultRow["id"]);
                $objTag->setTagName($resultRow["tag_name"]);
                $objTag->setTagDescription($resultRow["tag_description"]);
                $objTag->setIsActive($resultRow["is_active"]);

                $objTagArr[] = $objTag;
            }

        }

        return $objTagArr;
    }


    /**
     * Delete Tag by Id
     * @param $id
     * @return bool
     */
    public static function deleteById( $id )
    {
        $id = intval( $id );
        return Connection::delData("tag", " AND id=".$id);
    }

    /**
     * get total number of record exist in database
     */
    public static function  getTotalTag()
    {
        $table      = "tag";
        $condition  = "";

        return Connection::getCountData($table, $condition);

    }


    /**
     * Check Tag is exist or not in database
     *
     * @param $tagName
     * @param $id
     * @return bool
     */
    public static function isTagExist($tagName,$id)
    {
        $tagName        = stripform($tagName);
        $id   = intval($id);

        $table       = "tag";
        $condition   = "AND tag_name ='" . dbsafe($tagName) . "' ";
        $condition  .= ($id) ? " AND id != ".$id : '';

        return  Connection::getCountData($table, $condition);

    }

    /**
     * Disable tag
     *
     * @param $id
     * @param $value
     * @return int
     */
    public static function disableTagById($id, $value)
    {
        $id          = intval($id);
        $value       = intval($value);

        $table      = "tag";
        $condition  = "AND id=" . $id;
        $fields     = "*";

        // fetch result from database
        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if($resultRow){
            $objTag = new Tag();
            $objTag->setId($resultRow["id"]);
            $objTag->setTagName($resultRow["tag_name"]);
            $objTag->setTagDescription($resultRow["tag_description"]);
            $objTag->setIsActive($value);

            return $objTag->save();
        }
        return 0;
    }
}
?>