<?php
// Load required files
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "Settings.php";
require_once ROOT . "classes/Product.php";


session_start();
$ses_id = session_id();


if(empty($_SESSION[$ses_id]['Products']) || !(array_key_exists($_POST['product_id'], $_SESSION[$ses_id]['Products']))){
    $product = Product::productById($_POST['product_id']);
    $product['cart_quantity'] = $_POST['qty'];
    $product['cart_price'] = intval($_POST['qty']) * intval($product['price']) ;
    $_SESSION[$ses_id]['Products'][$product['product_id']] = $product;
    $session_products = $_SESSION[$ses_id]['Products'];
   // pr("new");
   // pr($session_products);
}
elseif(array_key_exists($_POST['product_id'], $_SESSION[$ses_id]['Products'])){
    $session_products = $_SESSION[$ses_id]['Products'];
    $k = $_POST['product_id'];
    if($session_products[$k]['product_id']==$_POST['product_id']){
        $session_products[$k]['cart_quantity'] =  intval($session_products[$k]['cart_quantity']) + intval($_POST['qty']);
        $session_products[$k]['cart_price'] = intval($session_products[$k]['price'])* intval($session_products[$k]['cart_quantity']);
    }
    $_SESSION[$ses_id]['Products'][$k] = $session_products[$k];
   //  pr("old");
   //  pr($session_products);
}

//pr($_SESSION[$ses_id]['Products']);
/*if(!empty($_SESSION[$ses_id]['Products'])) {

    $session_products = $_SESSION[$ses_id]['Products'];
    if(array_key_exists($_POST['product_id'], $session_products)){
        $k = $_POST['product_id'];
        if($session_products[$k]['product_id']==$_POST['product_id']){
            $session_products[$k]['cart_quantity'] =  intval($session_products[$k]['cart_quantity']) + intval($_POST['qty']);
            $session_products[$k]['cart_price'] = intval($session_products[$k]['price'])* intval($session_products[$k]['cart_quantity']);
        }
        $_SESSION[$ses_id]['Products'][$k] = $session_products[$k];
    }
    else{
        $product = Product::productById($_POST['product_id']);
        $session_products[$product['product_id']] = $product;
        $_SESSION[$ses_id]['Products'][$product['product_id']] = $product;
    }        
}
else{
    $product = Product::productById($_POST['product_id']);
    $product['cart_quantity'] = $_POST['qty'];
    $product['cart_price'] = intval($_POST['qty']) * intval($product['price']) ;
    $_SESSION[$ses_id]['Products'][$product['product_id']] = $product;
    $session_products = $_SESSION[$ses_id]['Products'];
    pr("new");
    pr($session_products);
}
*/
?>
<?php require_once 'ajax_common.php'; ?>
<h3><a href="#" style="color:#FD6A56">My Cart:</a></h3>
<div class="block-content">
<?php


    $cart_products = $_SESSION[$ses_id]['Products'];
    $cart_item  = $cart_item_price = $cart_total_price = 0;
    $cart_added_str = "";
    $cur_symb = ($_SESSION[$ses_id]['Currency']['symbol_left']=="")?$_SESSION[$ses_id]['Currency']['code']:$_SESSION[$ses_id]['Currency']['symbol_left'];
    if(!empty($cart_products)){
       foreach($cart_products as $cprod){ 
           $db_image = "images/products/{$cprod['product_id']}/{$cprod['image']}";
           $image_file = (file_exists(ROOT.$db_image))? "./".$db_image : "./images/".IMAGE_MISSING ;
           $cart_item += intval($cprod['cart_quantity']);
           $cart_item_price = intval($cprod['cart_price']) * $_SESSION[$ses_id]['Currency']['value'];
           $cart_total_price += (intval($cprod['cart_price']));          
           $cart_added_str = $cart_added_str."<li class='item'>
                        <div class='product-control-buttons'>
                                    <a class='btn-remove' onclick='return confirm(\"Are you sure you would like to remove this item from the shopping cart?\");' title='Remove This Item' href='#'>Remove This Item</a>
                                    <a class='btn-edit' title='Edit item' href='#'>Edit item</a>
                        </div>
                        <a class='product-image' href='#'><img alt='' src='{$image_file}'></a>
                        <p class='product-name'><a href='#'>{$cprod['name']}</a></p>
                        <div class='product-details'> <strong>{$cprod['cart_quantity']}</strong> x <span class='price'>{$cur_symb}{$cart_item_price}</span> </div>
                      </li>";
       }

       $cart_total_price = $cart_total_price*$_SESSION[$ses_id]['Currency']['value'];
    
?>
    <div class="summary"><p><strong title="#"><?php echo $cart_item; ?> item(s)</strong> - <span class="price"><?php echo $cur_symb ?><?php echo sprintf("%0.2f",$cart_total_price) ?></span></p></div>
    <div class="cart-content">
        <div class="cart-indent">
        <div class="cart-content-header">
          <p class="subtotal"> <span class="label">Cart Subtotal:</span> <span class="price"><?php echo $cur_symb ?><?php echo sprintf("%0.2f",$cart_total_price) ?></span> </p>
          <p class="block-subtitle">Recently added item(s)</p>
        </div>
        <ol class="mini-products-list" id="cart-sidebar">
          <?php echo $cart_added_str; ?>
        </ol>
        <div class="actions">
          <button onclick="setLocation('#')" class="button" title="Checkout" type="button"><span><span>Checkout</span></span></button>
          <button onclick="setLocation('#')" class="button" title="My Cart" type="button"><span><span>My Cart</span></span></button>
        </div>
        <script type="text/javascript">decorateList('cart-sidebar', 'none-recursive')</script>
        </div>
    </div>
    <p class="mini-cart"><strong title="#">4</strong> </p>
<?php } else { ?>
    <div class="empty">
        <div>0 item(s) - <span class="price">$0.00</span></div>
        <div class="cart-content"> You have no items in your shopping cart. </div>
    </div>
<?php } ?>
  </div>

