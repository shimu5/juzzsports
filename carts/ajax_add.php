<?php
// Load required files
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "Settings.php";
require_once ROOT . "classes/Product.php";
require_once ROOT . "classes/Customer.php";


session_start();
$ses_id = session_id();

/*
 * Ajax Cart add, evry cart will be added depend on quantity and product id,
 * newly added cart will added in session products array using product_id as key
 * if added product already in array then it will just increment quanity count and cart price
 * or otherwise added a new product_id array key fetch data from database
 */

if(empty($_SESSION[$ses_id]['Products']) || !(array_key_exists($_POST['product_id'], $_SESSION[$ses_id]['Products']))){
    $product = Product::productById($_POST['product_id']);
    $product['cart_quantity'] = $_POST['qty'];
    if(isset($product['product_discount_id']))
        $dis_checking_price = intval($product['discount_price']);
    else
        $dis_checking_price = intval($product['price']);

    $product['dis_checking_price'] = $dis_checking_price;
    $product['cart_price'] = intval($_POST['qty']) * $dis_checking_price;

    $_SESSION[$ses_id]['Products'][$product['product_id']] = $product;
    $_SESSION[$ses_id]['Cart_Total_Price'] +=$product['cart_price'];
    $session_products = $_SESSION[$ses_id]['Products'];
    $product_name = $product['name'];

}
elseif(array_key_exists($_POST['product_id'], $_SESSION[$ses_id]['Products'])){
    $session_products = $_SESSION[$ses_id]['Products'];
    $k = $_POST['product_id'];
    if($session_products[$k]['product_id']==$_POST['product_id']){
        $session_products[$k]['cart_quantity'] =  intval($session_products[$k]['cart_quantity']) + intval($_POST['qty']);
        if(isset($session_products[$k]['product_discount_id']))
            $dis_checking_price = intval($session_products[$k]['discount_price']);
        else
            $dis_checking_price = intval($session_products[$k]['price']);

        $session_products[$k]['dis_checking_price'] = $dis_checking_price;
        $session_products[$k]['cart_price'] = $dis_checking_price * intval($session_products[$k]['cart_quantity']);

    }
    $_SESSION[$ses_id]['Cart_Total_Price'] +=$session_products[$k]['cart_price'];
    $_SESSION[$ses_id]['Products'][$k] = $session_products[$k];
    $product_name = $session_products[$k]['name'];
}
$sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);
if($sessUserId){
    Customer::saveCart($sessUserId, serialize($_SESSION[$ses_id]['Products']));
}
if(!isset($_POST['page']))
    require_once 'ajax_common.php';
?>
