<?php
/**
 *
 * AboutusManager Manager Class
 * AboutusManager will manage all about us static page information
 *
 * @package     Aboutus Manager
 * @category    Manager
 * @author
 * @date        28/05/2014
 */

require_once ROOT . "functions/Connection.php";
require_once ROOT . "functions/functions.php";
require_once ROOT . "classes/ReturnList.php";
require_once ROOT . "classes/ReturnStatus.php";

class ReturnManager
{

    /**
     * get return list by id
     * @param $returnId
     * @return ReturnList
     */
    public static function getReturnRequestListByCustomerId($customerId, $start, $limit)
    {
        return ReturnList::getReturnRequestListByCustomerId($customerId, $start, $limit);
    }


    /**
     * Get Pagination
     *
     * @param: $page = current page number, $page = extra parameter want to add in url
     * @param $param
     * @return HTML - Pagination
     */
    public static function shoReturnRequestPagination($page, $customerId, $param)
    {
        $limit = ReturnManager::getPageLimit(); //how many items to show per page
        $adjacents = 1;
        $targetpage = "index.php"; //your file name  (the name of this file)
        $total_pages = ReturnList::getTotalRequestData($customerId); // total item, take from database; count query

        echo paginationShow($targetpage, $total_pages, $adjacents, $page, $limit, $param);
    }

    /**
     * Get Page Limit
     *
     * @return int - Page value
     */
    public static function getPageLimit()
    {
        return 30;//Connection::$PageLimit; //how many items to show per page
    }

}

?>