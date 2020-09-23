<?php
/*
 * fetch cart will check existing customer cart information from customer table if customer logged in,
 * if found database cart added then it will merge with newly added cart products
 * and all information will transfer in session
 */

$sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);
if($sessUserId){
    
    $customerId = $sessUserId;    
    $customerinfo = Customer::loadById($customerId);
    $db_cart = unserialize($customerinfo->getCart());
    $ses_cart = $_SESSION[$ses_id]['Products'];
    $temp_cart_price = $total_temp_cart_price = 0;
    //Customer::saveCart($sessUserId, serialize(array()));
    
    if(!empty($db_cart)) {               
        if(!empty($ses_cart))
        foreach($ses_cart as $sesproductid=>$sesproduct){             
            if(array_key_exists($sesproductid, $db_cart)){               
                $previous_quantity = $db_cart[$sesproductid]['cart_quantity'];
                $_SESSION[$ses_id]['Products'][$sesproductid]['cart_quantity'] +=$previous_quantity;
                $temp_cart_price = $_SESSION[$ses_id]['Products'][$sesproductid]['cart_quantity'] * $_SESSION[$ses_id]['Products'][$sesproductid]['dis_checking_price'] ;
                $_SESSION[$ses_id]['Products'][$sesproductid]['cart_price'] = $temp_cart_price;
                $total_temp_cart_price += $temp_cart_price;
                unset($db_cart[$sesproductid]);
               
            }
           
        }
          
        if(!empty($db_cart))
        foreach($db_cart as $db_product_id=>$db_product){
            $product = Product::productById($db_product_id);
            $product['cart_quantity'] = $db_product['cart_quantity'];
            if(isset($product['product_discount_id']))
            $dis_checking_price = intval($product['discount_price']);
            else
            $dis_checking_price = intval($product['price']);
            $product['dis_checking_price'] = $dis_checking_price;
            $temp_cart_price = intval($db_product['cart_quantity']) * $dis_checking_price;
            $product['cart_price'] = $temp_cart_price;
            $total_temp_cart_price += $temp_cart_price;
            $_SESSION[$ses_id]['Products'][$product['product_id']] = $product;
        }
        $_SESSION[$ses_id]['Cart_Total_Price'] = $total_temp_cart_price; 
    }  
}

?>
