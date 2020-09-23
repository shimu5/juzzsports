<?php
/**
 *
 * Category class
 *
 *
 * @package     Category
 * @category    Library
 * @author      Juzz Sports
 * @date        28-05-2014
 */

Class Category
{

    private $categoryId;
    private $categoryName;
    private $description;
    private $parentId;
    private $top;
    private $sortOrder;
    private $laguageId;
    private $metaTagDescription;
    private $metaKeyword;
    private $seoKey;
    private $created;
    private $modifiedDate;
    private $isActive;

    /**
     * All getter and setter functions
     *
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function getTop()
    {
        return $this->top;
    }

    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    public function getLaguageId()
    {
        return $this->laguageId;
    }

    public function getMetaTagDescription()
    {
        return $this->metaTagDescription;
    }

    public function getMetaKeyword()
    {
        return $this->metaKeyword;
    }

    public function getSeoKey()
    {
        return $this->seoKey;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setCategoryId($val)
    {
        $this->categoryId = intval($val);
    }

    public function setCategoryName($val)
    {
        $this->categoryName = $val;
    }

    public function setDescription($val)
    {
        $this->description = $val;
    }

    public function setParentId($val)
    {
        $this->parentId = intval($val);
    }

    public function setTop($val)
    {
        $this->top = intval($val);
    }

    public function setSortOrder($val)
    {
        $this->sortOrder = intval($val);
    }

    public function setLaguageId($val)
    {
        $this->laguageId = intval($val);
    }

    public function setMetaTagDescription($val)
    {
        $this->metaTagDescription = $val;
    }

    public function setMetaKeyword($val)
    {
        $this->metaKeyword = $val;
    }

    public function setSeoKey($val)
    {
        $this->seoKey = $val;
    }

    public function setCreated($val)
    {
        $this->created = $val;
    }

    public function setModifiedDate($val)
    {
        $this->modifiedDate = $val;
    }

    public function setIsActive($val)
    {
        $this->isActive = intval($val);
    }


    /**
     * Insert and update function
     */
    public function save()
    {
        $categoryId = intval($this->getCategoryId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "category";
        $fieldset = array("category_name", "description", "parent_id", "top", "sort_order", "laguage_id", "meta_tag_description", "meta_keyword", "seo_key", "created", "modified_date", "is_active");
        $valueset = array($this->getCategoryName(), $this->getDescription(), $this->getParentId(), $this->getTop(), $this->getSortOrder(), $this->getLaguageId(), $this->getMetaTagDescription(), $this->getMetaKeyword(), $this->getSeoKey(), $this->getCreated(), $this->getModifiedDate(), $this->getIsActive());

        if ($categoryId > 0) {
            $condition = "AND category_id=" . $categoryId;
            if (Connection::updateData($table, $fieldset, $valueset, $condition)) {
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
                $this->setCategoryId($insert_id);
            } else {
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }


    /**
     * get category information by category id
     * @param $categoryId
     * @return Category|null     *
     */
    public static function loadById($categoryId,$active = null)
    {

        $categoryId = intval($categoryId);

        $objCategory = NULL;

        $table = "category";
        $active = (isset($active))?" AND $table.is_active = {$active}":" ";
        $condition = " $active AND category_id=" . $categoryId;
        $fields = "*";

        // fetch result from database
        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objCategory = new Category();
            $objCategory->setCategoryId($resultRow["category_id"]);
            $objCategory->setCategoryName($resultRow["category_name"]);
            $objCategory->setDescription($resultRow["description"]);
            $objCategory->setParentId($resultRow["parent_id"]);
            $objCategory->setTop($resultRow["top"]);
            $objCategory->setSortOrder($resultRow["sort_order"]);
            $objCategory->setLaguageId($resultRow["laguage_id"]);
            $objCategory->setMetaTagDescription($resultRow["meta_tag_description"]);
            $objCategory->setMetaKeyword($resultRow["meta_keyword"]);
            $objCategory->setSeoKey($resultRow["seo_key"]);
            $objCategory->setCreated($resultRow["created"]);
            $objCategory->setModifiedDate($resultRow["modified_date"]);
            $objCategory->setIsActive($resultRow["is_active"]);

        }

        return $objCategory;
    }


    /**
     * get all categories with start and limit value
     *
     * @param int $start
     * @param int $limit
     * @return array
     */
    public static function load($start = 0, $limit = 0,$cond="")
    {
        
        $start      = intval($start);
        $limit      = intval($limit);
        $objCategoryArr = array();

        $table = "category";
        $condition = $cond;
        $fields = "*";

        $limitStr = "";
        if($limit){
            $limitStr = "LIMIT ".$start.", ".$limit;
        }

        // fetch result from database

        $row = Connection::getAllData($table, $condition, $fields, "", $limitStr);

        if ($row) {

            foreach ($row as $resultRow) {

                $objCategory = new Category();
                $objCategory->setCategoryId($resultRow["category_id"]);
                $objCategory->setCategoryName($resultRow["category_name"]);
                $objCategory->setDescription($resultRow["description"]);
                $objCategory->setParentId($resultRow["parent_id"]);
                $objCategory->setTop($resultRow["top"]);
                $objCategory->setSortOrder($resultRow["sort_order"]);
                $objCategory->setLaguageId($resultRow["laguage_id"]);
                $objCategory->setMetaTagDescription($resultRow["meta_tag_description"]);
                $objCategory->setMetaKeyword($resultRow["meta_keyword"]);
                $objCategory->setSeoKey($resultRow["seo_key"]);
                $objCategory->setCreated($resultRow["created"]);
                $objCategory->setModifiedDate($resultRow["modified_date"]);
                $objCategory->setIsActive($resultRow["is_active"]);

                $objCategoryArr[] = $objCategory;
            }

        }

        return $objCategoryArr;
    }


    /**
     * get all parent categories
     *
     * @return array
     */
    public static function getParentList()
    {

        $objCategoryArr = array();

        $table = "category";
        $condition = " AND is_active = 1";
        $fields = "category_id, category_name";

        // fetch result from database

        $row = Connection::getAllData($table, $condition, $fields, "", "");

        if ($row) {

            foreach ($row as $resultRow) {

                $objCategory = new Category();
                $objCategory->setCategoryId($resultRow["category_id"]);
                $objCategory->setCategoryName($resultRow["category_name"]);

                $objCategoryArr[] = $objCategory;
            }

        }

        return $objCategoryArr;
    }

    /**
     * check id category is exist in database
     */
    public static function isCategoryExist($categoryName, $categoryId)
    {
        $table = "category";
        $condition = " AND category_name LIKE '".$categoryName."'". ($categoryId ? " AND category_id != ".$categoryId : "");

        return Connection::getCountData($table, $condition);

    }

    /**
     * get number of categories exist in database
     */
    public static function getTotalCategory()
    {
        $table = "category";
        $condition = "";

        return Connection::getCountData($table, $condition);

    }


    /**
     * delete category by category id
     *
     * @param $categoryId
     * @return bool
     */
    public static function disableCategoryById($categoryId, $value)
    {
        $categoryId = intval($categoryId);
        $value      = intval($value);

        $table      = "category";
        $condition  = "AND category_id=" . $categoryId;
        $fields     = "*";

        // fetch result from database
        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if($resultRow){
            $objCategory = new Category();
            $objCategory->setCategoryId($resultRow["category_id"]);
            $objCategory->setCategoryName($resultRow["category_name"]);
            $objCategory->setDescription($resultRow["description"]);
            $objCategory->setParentId($resultRow["parent_id"]);
            $objCategory->setTop($resultRow["top"]);
            $objCategory->setSortOrder($resultRow["sort_order"]);
            $objCategory->setLaguageId($resultRow["laguage_id"]);
            $objCategory->setMetaTagDescription($resultRow["meta_tag_description"]);
            $objCategory->setMetaKeyword($resultRow["meta_keyword"]);
            $objCategory->setSeoKey($resultRow["seo_key"]);
            $objCategory->setCreated($resultRow["created"]);
            $objCategory->setModifiedDate($resultRow["modified_date"]);
            $objCategory->setIsActive($value);

            return $objCategory->save();
        }
        return 0;
    }


    /**
     * delete category by category id
     *
     * @param $categoryId
     * @return bool
     */
    
    public static function deleteById($categoryId)
    {
        $categoryId = intval($categoryId);
        return Connection::delData("category", " AND category_id=" . $categoryId);
    }

    /**
     * get main category list
     *
     * @return Category
     */
    public static function getMainCategory()
    {
        $objCategoryArr = array();

        $table      = "category";
        $condition  = "AND parent_id = 0"; // 0 = main category
        $fields     = "*";

        // fetch result from database
        $row = Connection::getAllData($table, $condition, $fields, "", "");

        if ($row) {

            foreach ($row as $resultRow) {

                $objCategory = new Category();
                $objCategory->setCategoryId($resultRow["category_id"]);
                $objCategory->setCategoryName($resultRow["category_name"]);
                $objCategory->setDescription($resultRow["description"]);
                $objCategory->setParentId($resultRow["parent_id"]);
                $objCategory->setTop($resultRow["top"]);
                $objCategory->setSortOrder($resultRow["sort_order"]);
                $objCategory->setLaguageId($resultRow["laguage_id"]);
                $objCategory->setMetaTagDescription($resultRow["meta_tag_description"]);
                $objCategory->setMetaKeyword($resultRow["meta_keyword"]);
                $objCategory->setSeoKey($resultRow["seo_key"]);
                $objCategory->setCreated($resultRow["created"]);
                $objCategory->setModifiedDate($resultRow["modified_date"]);
                $objCategory->setIsActive($resultRow["is_active"]);

                $objCategoryArr[] = $objCategory;
            }

        }

        return $objCategoryArr;
    }

    /**
     * get main category list
     *
     * @return Category
     */
    public static function getSubCategoryByParentId($parentId)
    {
        $parentId = intval($parentId);

        $objCategoryArr = array();

        $table      = "category";
        $condition  = "AND parent_id = ".$parentId;
        $fields     = "*";

        // fetch result from database
        $row = Connection::getAllData($table, $condition, $fields, "", "");

        if ($row) {

            foreach ($row as $resultRow) {

                $objCategory = new Category();
                $objCategory->setCategoryId($resultRow["category_id"]);
                $objCategory->setCategoryName($resultRow["category_name"]);
                $objCategory->setDescription($resultRow["description"]);
                $objCategory->setParentId($resultRow["parent_id"]);
                $objCategory->setTop($resultRow["top"]);
                $objCategory->setSortOrder($resultRow["sort_order"]);
                $objCategory->setLaguageId($resultRow["laguage_id"]);
                $objCategory->setMetaTagDescription($resultRow["meta_tag_description"]);
                $objCategory->setMetaKeyword($resultRow["meta_keyword"]);
                $objCategory->setSeoKey($resultRow["seo_key"]);
                $objCategory->setCreated($resultRow["created"]);
                $objCategory->setModifiedDate($resultRow["modified_date"]);
                $objCategory->setIsActive($resultRow["is_active"]);

                $objCategoryArr[] = $objCategory;
            }

        }

        return $objCategoryArr;
    }

    /**
     * get category name by parent id
     *
     * @return Category
     */
    public static function getCategoryInfoByParentId($parentId)
    {
        $parentId = intval($parentId);

        $objCategory = null;

        $table      = "category";
        $condition  = "AND parent_id=" . $parentId;
        $fields     = "*";

        // fetch result from database
        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if($resultRow){
            $objCategory = new Category();
            $objCategory->setCategoryId($resultRow["category_id"]);
            $objCategory->setCategoryName($resultRow["category_name"]);
            $objCategory->setDescription($resultRow["description"]);
            $objCategory->setParentId($resultRow["parent_id"]);
            $objCategory->setTop($resultRow["top"]);
            $objCategory->setSortOrder($resultRow["sort_order"]);
            $objCategory->setLaguageId($resultRow["laguage_id"]);
            $objCategory->setMetaTagDescription($resultRow["meta_tag_description"]);
            $objCategory->setMetaKeyword($resultRow["meta_keyword"]);
            $objCategory->setSeoKey($resultRow["seo_key"]);
            $objCategory->setCreated($resultRow["created"]);
            $objCategory->setModifiedDate($resultRow["modified_date"]);
            $objCategory->setIsActive($resultRow["is_active"]);
        }
        return $objCategory;
    }

}

?>
