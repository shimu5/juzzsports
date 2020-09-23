<?php
session_start();
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "functions/Session.php";
include_once ROOT . "functions/redirect.php";
include_once "CustomerManager.php";

$customerId = intval($_GET['customer_id']);
$productId  = intval($_GET['product_id']);

Session::deleteWishlistProductList($productId); // delete product from session wist list

$customerObj = CustomerManager::getWishList($customerId); // get customer info

$wishListSaveData = ( $customerObj && $customerObj->getWishlist() ? unserialize($customerObj->getWishlist()) : array());

unset($wishListSaveData[$productId]); // remove product from save wish list

CustomerManager::saveWishList($customerId, $wishListSaveData); // save updated wish list

redirectPage("customer_wishlist.php?delete_status=1");

?>