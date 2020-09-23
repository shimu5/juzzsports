<?php
session_start();

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "functions/Session.php";
require_once ROOT."classes/Customer.php";

$productId = intval($_POST['product_id']);

if (isset($_POST['type']) && $_POST['type'] == 'add') {
    Session::setCompareProductSession($productId);
    echo "1";
}
else if (isset($_POST['type']) && $_POST['type'] == 'remove') {
    Session::deleteCompareProduct($productId);
    
    echo "1";
}

else if (isset($_POST['type']) && $_POST['type'] == 'add_wishlist') {
    Session::setWishlistProductSession($productId);
    echo "1";
}
else if (isset($_POST['type']) && $_POST['type'] == 'remove_wishlis') {
    Session::deleteWishlistProduct($productId);
    echo "1";
}
else
    echo "0";


?>
