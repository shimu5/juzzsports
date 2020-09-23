<?php
// Load required files
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "Settings.php";
require_once ROOT . "classes/Product.php";

session_start();
$ses_id = session_id();

/*
 * in update check exist array key of product id ,
 * if found then it will increment/decreament quantity and price
 */

if(array_key_exists($_POST['product_id'], $_SESSION[$ses_id]['Products'])){
    $kid = $_POST['product_id'];
    $post_quantity = intval($_POST['quantity']);
    if($post_quantity>0){
        $_SESSION[$ses_id]['Products'][$kid]['cart_quantity'] = $post_quantity;
        $previous_price = $_SESSION[$ses_id]['Products'][$kid]['cart_price'];
        if(!isset($_SESSION[$ses_id]['Products'][$kid]['product_discount_id']))
            $discount_checking_price = $_SESSION[$ses_id]['Products'][$kid]['price'];
        else
            $discount_checking_price = $_SESSION[$ses_id]['Products'][$kid]['discount_price'];

        $_SESSION[$ses_id]['Products'][$kid]['dis_checking_price'] = $discount_checking_price;
        $_SESSION[$ses_id]['Products'][$kid]['cart_price'] = $discount_checking_price * $post_quantity;
        $_SESSION[$ses_id]['Products'][$kid]['product_size'] = $_POST['product_size'];
        $price_added = $_SESSION[$ses_id]['Products'][$kid]['cart_price'] - $previous_price;



        $_SESSION[$ses_id]['Cart_Total_Price'] +=$price_added;
    }
    else
        unset($_SESSION[$ses_id]['Products'][$kid]);

    $sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);
    if($sessUserId){
        Customer::saveCart($sessUserId, serialize($_SESSION[$ses_id]['Products']));
    }
    //pr($_SESSION[$ses_id]['Products']);
}


if(!isset($_POST['page']))
    require_once 'ajax_common.php';

 ?>