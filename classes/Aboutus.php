<?php
/**
 *
 * Aboutus class
 *
 *
 * @package     Aboutus
 * @category    Library
 * @author      Juzz Sports
 * @date        28-05-2014
 */
Class Aboutus
{

    private $pageId;
    private $title;
    private $description;
    private $pageName;
    private $parentName;
    private $pageType;
    private $metaTitle;
    private $metaKeyword;
    private $metaDescription;
    private $created;
    private $isActive;

    /**
     * all getter and setter functions
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPageName()
    {
        return $this->pageName;
    }

    public function getParentName()
    {
        return $this->parentName;
    }

    public function getPageType()
    {
        return $this->pageType;
    }

    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    public function getMetaKeyword()
    {
        return $this->metaKeyword;
    }

    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setPageId($val)
    {
        $this->pageId = intval($val);
    }

    public function setTitle($val)
    {
        $this->title = $val;
    }

    public function setDescription($val)
    {
        $this->description = $val;
    }

    public function setPageName($val)
    {
        $this->pageName = $val;
    }

    public function setParentName($val)
    {
        $this->parentName = $val;
    }

    public function setPageType($val)
    {
        $this->pageType = $val;
    }

    public function setMetaTitle($val)
    {
        $this->metaTitle = $val;
    }

    public function setMetaKeyword($val)
    {
        $this->metaKeyword = $val;
    }

    public function setMetaDescription($val)
    {
        $this->metaDescription = $val;
    }

    public function setCreated($val)
    {
        $this->created = $val;
    }

    public function setIsActive($val)
    {
        $this->isActive = intval($val);
    }

    /**
     * insert and update function
     */
    public function save()
    {
        $pageId = intval($this->getPageId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "static_page";
        $fieldset = array("title", "description", "page_name", "parent_name", "page_type", "meta_title", "meta_keyword", "meta_description", "created", "is_active");
        $valueset = array($this->getTitle(), $this->getDescription(), $this->getPageName(), $this->getParentName(), $this->getPageType(), $this->getMetaTitle(), $this->getMetaKeyword(), $this->getMetaDescription(), $this->getCreated(), $this->getIsActive());

        if ($pageId > 0) {
            $condition = "AND page_id=" . $pageId;
            if (Connection::updateData($table, $fieldset, $valueset, $condition, 1)) {
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
                $this->setPageId($insert_id);
            } else {
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }

    /**
     * get about us information by id
     *
     * @param $pageId
     * @return Aboutus|null
     */
    public static function loadById($pageId)
    {

        $pageId = intval($pageId);

        $objAboutus = NULL;

        $table = "static_page";
        $condition = "AND page_id=" . $pageId;
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objAboutus = new Aboutus();
            $objAboutus->setPageId($resultRow["page_id"]);
            $objAboutus->setTitle($resultRow["title"]);
            $objAboutus->setDescription($resultRow["description"]);
            $objAboutus->setPageName($resultRow["page_name"]);
            $objAboutus->setParentName($resultRow["parent_name"]);
            $objAboutus->setPageType($resultRow["page_type"]);
            $objAboutus->setMetaTitle($resultRow["meta_title"]);
            $objAboutus->setMetaKeyword($resultRow["meta_keyword"]);
            $objAboutus->setMetaDescription($resultRow["meta_description"]);
            $objAboutus->setCreated($resultRow["created"]);
            $objAboutus->setIsActive($resultRow["is_active"]);

        }

        return $objAboutus;
    }

    /**
     * get about us information by page Name
     *
     * @param $pageName & $pageType
     * @return Aboutus|null
     */
    public static function loadByName($pageType , $pageName)
    {

        $objAboutus = NULL;

        $table = "static_page";
        $condition = "AND page_name='" . $pageName."' AND page_type='" . $pageType ."'";
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objAboutus = new Aboutus();
            $objAboutus->setPageId($resultRow["page_id"]);
            $objAboutus->setTitle($resultRow["title"]);
            $objAboutus->setDescription($resultRow["description"]);
            $objAboutus->setPageName($resultRow["page_name"]);
            $objAboutus->setParentName($resultRow["parent_name"]);
            $objAboutus->setPageType($resultRow["page_type"]);
            $objAboutus->setMetaTitle($resultRow["meta_title"]);
            $objAboutus->setMetaKeyword($resultRow["meta_keyword"]);
            $objAboutus->setMetaDescription($resultRow["meta_description"]);
            $objAboutus->setCreated($resultRow["created"]);
            $objAboutus->setIsActive($resultRow["is_active"]);

        }

        return $objAboutus;
    }


    /**
     * get all about us information
     *
     * @return array
     */
    public static function load($start = 0, $limit = 0)
    {
        $start         = intval($start);
        $limit         = intval($limit);
        $objAboutusArr = array();

        $table     = "static_page";
        $condition = "";
        $fields    = "*";

        $limitStr = "";
        if($limit){
            $limitStr = "LIMIT ".$start.", ".$limit;
        }

        $row = Connection::getAllData($table, $condition, $fields, "", $limitStr);

        if ($row) {

            foreach ($row as $resultRow) {

                $objAboutus = new Aboutus();
                $objAboutus->setPageId($resultRow["page_id"]);
                $objAboutus->setTitle($resultRow["title"]);
                $objAboutus->setDescription($resultRow["description"]);
                $objAboutus->setPageName($resultRow["page_name"]);
                $objAboutus->setParentName($resultRow["parent_name"]);
                $objAboutus->setPageType($resultRow["page_type"]);
                $objAboutus->setMetaTitle($resultRow["meta_title"]);
                $objAboutus->setMetaKeyword($resultRow["meta_keyword"]);
                $objAboutus->setMetaDescription($resultRow["meta_description"]);
                $objAboutus->setCreated($resultRow["created"]);
                $objAboutus->setIsActive($resultRow["is_active"]);

                $objAboutusArr[] = $objAboutus;
            }

        }

        return $objAboutusArr;
    }

    /**
     * get about us information by page name and page type
     *
     * @param $get
     * @return Aboutus|null
     */
    public static function isPageExist($pageName, $pageType, $pageId)
    {
        $pageId      = intval($pageId);
        
        $table       = "static_page";
        $condition   = "AND page_name ='" . dbsafe($pageName) . "' AND page_type ='" . dbsafe($pageType) . "' ";
        $condition .= ($pageId) ? " AND page_id != ".$pageId : '';
     
        return  Connection::getCountData($table, $condition);
        
    }


    /**
     * get total number of record exist in database
     */
    public static function  getTotalAboutusPage()
    {
        $table = "static_page";
        $condition = "";

        return Connection::getCountData($table, $condition);

    }

    /**
     *  delete about us information by id
     *
     * @param $pageId
     * @return bool
     */
    public static function deleteById($pageId)
    {
        $pageId = intval($pageId);
        return Connection::delData("static_page", " AND page_id=" . $pageId);
    }

}

?>