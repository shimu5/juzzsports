<?php
session_start();
/**
 *
 * Session Handle Class
 *
 * This class holds all the Session Manage functionality.
 *
 * @package     Session
 * @category    Library
 * @author
 * @link
 * @date
 */

include_once ROOT . "functions/db_connect.php";
include_once ROOT . "functions/Connection.php";
include_once ROOT . "functions/quote_smart.php";
include_once ROOT . "classes/FieldValidator.php";

class Session
{
    // max product to compare.
    public static $CompareProductMax = 4;

    /**
     * set session data
     *
     * @param $name
     * @param $value
     * @param int $indexKey
     * @param int $isArray
     */
    public static function setSessionData($name, $value, $indexKey = 0, $isArray = 0)
    {
        if($isArray && $indexKey){
            $_SESSION[$name][$indexKey] = $value;
        }
        else{
            $_SESSION[$name] = $value;
        }
    }

    /**
     * get session value by name
     *
     * @param $name
     * @return mixed
     */
    public static function getSessionData($name)
    {
        return $_SESSION[$name];
    }

    /**
     * set comparable products
     *
     * @param $name
     * @param $value
     */
    public static function setCompareProductSession($value)
    {
        if(Session::$CompareProductMax >= count($_SESSION['compare_list'])){ // no more than 4 product
            $_SESSION['compare_list'][$value] = 1;
        }
    }
    
    /**
     * set comparable products
     *
     * @param $name
     * @param $value
     */
    public static function setWishlistProductSession($value)
    {
            $_SESSION['wish_list'][$value] = 1;
            $sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);
            
            if($sessUserId){
               
                $customerInfo = Customer::loadById($sessUserId);               
                $wishListData = ( is_object($customerInfo) && $customerInfo->getWishlist() ? unserialize($customerInfo->getWishlist()) : "");                
                $wishListNow = $_SESSION['wish_list']; // get current wish list
                $wishListArr = (!empty($wishListData)?$wishListData:array())+(!empty($wishListNow)?$wishListNow:array());// merge wish list with previous list
                Customer::saveWishList($customerInfo->getCustomerId(), serialize($wishListArr)); // save wish list in data base
            }
    }

    /**
     * get compare data from session
     *
     * @return mixed
     */
    public static function getCompareProductSession()
    {
        return $_SESSION['compare_list'];
    }
    
    /**
     * get wish list data from session
     *
     * @return mixed
     */
    public static function getWishlistProductSession()
    {
        return $_SESSION['wish_list'];
    }

    /**
     * Delete compare product list form session
     */
    public static function deleteCompareProductList()
    {
        if (isset($_SESSION['compare_list']))
            unset($_SESSION['compare_list']);
    }
    
    /**
     * Delete compare product list form session
     */
    public static function deleteWishlistProductList()
    {
        if (isset($_SESSION['wish_list']))
            unset($_SESSION['wish_list']);
    }

    /**
     * Delete compare product id form session
     */
    public static function deleteCompareProduct($productId)
    {
        if (isset($_SESSION['compare_list'][$productId]))
            unset($_SESSION['compare_list'][$productId]);
    }
    
    /**
     * Delete compare product id form session
     */
    public static function deleteWishlistProduct($productId)
    {
        if (isset($_SESSION['wish_list'][$productId]))
            unset($_SESSION['wish_list'][$productId]);
    }

    /**
     * get all session data
     *
     * @return mixed
     */
    public static function getAllSessionData()
    {
            return $_SESSION;
    }

    public static function unsetSessionData($key)
    {
        if (isset($_SESSION[$key]))
            unset($_SESSION[$key]);
    }

    /**
     * Delete all session data
     */
    public static function deleteAllSession()
    {
        session_unset();
        session_destroy();
    }

} // End Class
 