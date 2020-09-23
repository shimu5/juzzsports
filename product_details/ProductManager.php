<?php
/**
 *
 * ProductManager Manager Class
 * ProductManager will manage all about us static page information
 *
 * @package     Product Manager
 * @category    Manager
 * @author
 * @date        28/05/2014
 *
 * 
 */
require_once ROOT . "functions/Connection.php";
require_once ROOT . "classes/Product.php";
require_once ROOT . "classes/Customer.php";


class ProductManager {
    /**
     *
     * Get product information by product id
     *
     * @return array
     */
    public static function getProductDetailsById($productId)
    {
//        pr(Product::loadById($productId));die;
//        pr(Product::loadProductsDetailsById($productId));die;
        return Product::loadProductsDetailsById($productId);
    }
    
    public static function getWishlistProducts($wishlistId){
        return Product::loadProductsDetailsById($wishlistId);
    }
    
}

// End Class 
?>