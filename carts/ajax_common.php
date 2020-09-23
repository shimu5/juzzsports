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
           $image_file = (file_exists(ROOT.$db_image))? BASE_URL.$db_image : BASE_URL."/images/".IMAGE_MISSING ;
           $cart_item += intval($cprod['cart_quantity']);
           $cart_item_price = intval($cprod['cart_price']) * $_SESSION[$ses_id]['Currency']['value'];
           $cart_total_price += (intval($cprod['cart_price']));
           $cart_added_str = $cart_added_str."<li class='item'>
                        <div class='product-control-buttons'>
                                    <a class='btn-remove' onclick=\"deleteToCart('{$cprod['product_id']}');return false;\" title='Remove This Item' href='#'>Remove This Item</a>
                                    <a class='btn-edit' onclick=\"editToCart('{$cprod['product_id']}');return false;\" title='Edit item' href='#'>Edit item</a>
                        </div>
                        <a class='product-image' href='#' onclick=\"productDetail('{$cprod['product_id']}');return false;\" ><img alt='' src='{$image_file}'></a>
                        <p class='product-name'><a href='#' onclick=\"productDetail('{$cprod['product_id']}');return false;\">{$cprod['name']}</a></p>
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
          <button onclick="checkOut()" class="button" title="Checkout" type="button"><span><span>Checkout</span></span></button>
          <button onclick="editToCart()" class="button" title="My Cart" type="button"><span><span>My Cart</span></span></button>
        </div>
        <!--<script type="text/javascript">decorateList('cart-sidebar', 'none-recursive')</script>-->
        </div>
    </div>
    <div style="display:none" id="product_add"><?php echo $product_name; ?></div>
    <p class="mini-cart"><strong title="#">4</strong> </p>
<?php } else { ?>
    <div class="empty">
        <div>0 item(s) - <span class="price">$0.00</span></div>
        <div class="cart-content"> You have no items in your shopping cart. </div>
    </div>
<?php } ?>
  </div>
