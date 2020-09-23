<?php // pr($_SESSION[$ses_id]); ?>
<div class="account-login">
    <div class="page-title">
        <h1>Shopping Cart Information</h1>
    </div>
    <form id="login-form" method="post" >
        <div class="cart-info-edit">
            <?php if(!empty($_SESSION[$ses_id]['Products'])){ ?>
                <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Model</th>                    
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>&nbsp;&nbsp;&nbsp;</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
                </thead>
                  <tbody>
                <?php $total_item_rate= 0; $cart_products= $_SESSION[$ses_id]['Products'];
                // view all product list in cart
                foreach($cart_products as $prod):
                    $item_price = (!isset($prod['product_discount_id']))?$prod['price']:$prod['discount_price'];
                    $per_item_total_rate = (($item_price*$prod['cart_quantity'])*$cur_rate);
                    $total_item_rate +=$per_item_total_rate;

                ?>
              
                <tr class="prod_<?php echo $prod['product_id']; ?>">
                    <td class="image">
                        <a href="product_details/index.php?id=<?php echo $prod['product_id'] ?>">
                            <?php $image="images/products/".$prod['product_id']."/".$prod['image']; $filename = (file_exists($image))?$image:"images/".IMAGE_MISSING; ?>
                            <img src="<?php echo $filename; ?>" />
                        </a>
                    </td>
                    <td class="name"><a href="product_details/index.php?id=<?php echo $prod['product_id'] ?>"><?php echo $prod['name']; ?></a></td>
                    <td><?php echo $prod['manufacture_name']; ?>&nbsp;</td>                    
                    <td class="name"><input type="text" value='<?php echo $prod['cart_quantity']; ?>' name="cart_quantity[<?php echo $prod['product_id']?>]" id="quantity_<?php echo $prod['product_id'] ?>"  class="detail-qty" size="5" maxlength="5"/></td>
                    <td class="name"><input type="text" value='<?php echo $prod['product_size']; ?>' name="product_size[<?php echo $prod['product_id']?>]" id="size_<?php echo $prod['product_id'] ?>"  class="detail-qty" maxlength="20" /></td>
                    <td><a href="#" id="<?php echo $prod['product_id'] ?>" class="cart_update">Update</a>
                        <a href="#" id="<?php echo $prod['product_id'] ?>" class="cart_delete">Delete</a>
                    </td>

                    <td><?php echo $cur_symb." ".sprintf("%0.2f",(($item_price*$cur_rate))); ?></td>
                    <td><?php echo $cur_symb." ".sprintf("%0.2f",($per_item_total_rate)); ?></td>
                </tr>
               
                <?php endforeach; ?>
                 </tbody>
                <!-- Table footer --> 

		<tfoot>
	        <tr>
                      <td colspan="6"></td>
	              <td>Sub Total : </td>
                      <td><?php echo $cur_symb." ".sprintf("%0.2f",($total_item_rate)); ?> </td>

	        </tr>
                <tr>
                      <td colspan="6"></td>
	              <td>Total : </td>
                      <td><?php echo $cur_symb." ".sprintf("%0.2f",($total_item_rate)); ?> </td>

	        </tr>
		</tfoot>
        </table>
                <div class="right"><a href="checkout/index.php" class="btn"><span>Checkout</span></a></div>
            <?php }else{ ?>
            <div class="alert" style="margin-bottom: 200px;">There are no cart information here.</div>
            <?php } ?>
            <div>
            <div class="left"> <a href="index.php" class="btn"><span>Continue Shopping</span></a></div>

            <div class="clear"></div>
        </div>
        </div>
        
    </form>
</div>
<script>
    jQuery(".cart_update").click(function(e){
        e.preventDefault();
        var product_id = jQuery(this).attr("id");
        var quantity = parseInt(jQuery("#quantity_"+product_id).val())
        var size = jQuery.trim(jQuery("#size_"+product_id).val())

        if(quantity <= 0){ // make an alert for 0 or -value quantity
            alert('Please enter the right quantity.');
            return false;
        }

        if(typeof quantity === "number" && !isNaN(quantity)){ // update quantity from cart
            jQuery.ajax({
                url:'carts/ajax_update.php',
                type:'POST',
                data:'product_id='+product_id+"&page=cart_update&quantity="+quantity+"&product_size="+size,
                success: function(response ){
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown ){
                    alert(errorThrown);
                }
            })
        }else{
        alert("Insert Quantity Number");
        }       
    })
    jQuery(".cart_delete").click(function(e){ // delete product from cart
        e.preventDefault();
        var product_id = jQuery(this).attr("id");
        var r = confirm("Are you sure to remove this item from shopping cart?");
        if(r){
            jQuery.ajax({
                url:'carts/ajax_delete.php',
                type:'POST',
                data:'product_id='+product_id+"&page=cart_detail",
                success: function(response ){
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown ){
                    alert(errorThrown);
                }
            })
        }

    })
</script>