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
 *
 * 
 */
require_once ROOT . "functions/Connection.php";
require_once ROOT . "classes/Aboutus.php";


class AboutUsManager {
    /**
     *
     * Aboutus pages title array
     *
     * @return array
     */
    public static function getPageArr()
    {
        $pageArr = array();
        $pageArr['knows'] = "About Us";
        $pageArr['guide'] = "Apparel Size Guide";
        $pageArr['shipping'] = "Shipping Rates & Delivery";
        $pageArr['shoe'] = "Shoe Size Guide";
        $pageArr['faq'] = "FAQ";
        return $pageArr;
    }

    
    /**
     * Get Page Information by pageId
     *
     * @param    PageId
     * @return   Array 
     * 
     */
    public static function getPageInfoByName($pageType , $pageName) {      
        return Aboutus::loadByName($pageType , $pageName);
    }

}

// End Class 
?>