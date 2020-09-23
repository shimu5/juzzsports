
<div class="column">
    <div class="cart-info-edit">
      <table>
        <thead>
          <tr>
            <td class="name">Product Name</td>
            <td class="model">Model</td>
            <td class="quantity">Quantity</td>
            <td class="size">Size</td>
            <td class="price">Price</td>
            <td class="total">Total</td>
          </tr>
        </thead>
        <tbody>
        
            <?php $total = 0; if(!empty($_SESSION[$ses_id]['Products'])): foreach($_SESSION[$ses_id]['Products'] as $product): ?>
            <tr>
            <td class="name"><a href="<?php echo BASE_URL."product_details/index.php?id=".$product['product_id'] ?>" target="_blank"><?php echo $product['name'] ?></a></td>
            <td class="model"><?php echo $product['manufacture_name'] ?></td>
            <td class="quantity"><?php echo $product['cart_quantity'] ?></td>
            <td class="quantity"><?php echo $product['product_size'] ?></td>
            <td class="price"><?php echo $cur_symb ?><?php $price= (isset($product['product_discount_id']))?($product['discount_price']*$cur_rate):($product['price']*$cur_rate) ?> <?php echo money_format($price); ?></td>
            <td class="total"><?php echo $cur_symb ?><?php  $price_total = $price*$product['cart_quantity']; echo money_format($price_total); $total+=$price_total ; ?></td>
             </tr>
            <?php endforeach; endif;?>
       
      </tbody>
       <tfoot>
            <tr>
                <td colspan="5" class="a-right"><b>Sub-Total:</b></td>
                <td class="total"><?php echo $cur_symb ?><?php echo money_format($total); ?></td>
            </tr>
            <tr>
                <td colspan="5" class="a-right"><b>Total:</b></td>
            <td class="total"><?php echo $cur_symb ?><?php echo money_format($total); ?></td>
          </tr>
      </tfoot>
      </table>
    </div>
    <div class="payment"><div class="button_blocks">
    <div class="right"><a class="btn" id="button-confirm">Confirm Order</a></div>
    <div class="clearfix"></div>
  </div>

</div>
</div>