<?php  
    $bottom_tags = HomePageSetting::productTags(2 , 3 , 1);
   
    if(!empty($bottom_tags)):
        foreach($bottom_tags as $tag):
?>

<div class="page-title category-title">
    <h1><?php echo $tag['tag_name']; ?> <a href="category_products/index.php?tag_id=<?php echo $tag['tag_id'] ?>" title="<?php echo $tag['tag_description'] ?>"><span class="fa fa-arrow-circle-o-right detail_bullet_link"></span></a></h1>
</div>
<ul class="products-grid row">
    <?php $products = Product::productsByTag($tag['tag_id'], 4 , 1); if(!empty($products)): ?>
    <?php foreach($products as $prod):  $filename = "images/products/".$prod['product_id']."/".$prod['image']; //pr($prod); ?>
        <li class="item col-xs-3 first">
            <div class="grid_wrap"> 
                <a href="product_details/index.php?id=<?php echo $prod['product_id'] ?>" title="<?php echo $prod['name'] ?>" class="product-image image_cls">
                    <?php if(file_exists($filename)):?>
                    <img src="<?php echo BASE_URL ?>images/products/<?php echo $prod['product_id']."/".$prod['image'] ?>" alt="<?php echo $prod['name'] ?>" class="image_home"/>
                    <?php else :?>
                        <img src="<?php echo BASE_URL ?>images/missing.png" alt="No image available" class="image_home"/>
                    <?php endif; ?>
                </a>             
              <div class="product-shop">
                  <h3 class="product-name"><a href="product_details/index.php?id=<?php echo $prod['product_id'] ?>" title="<?php echo $prod['name'] ?>" >
                        <?php echo (strlen($prod['name'])>27)?substr($prod['name'], 0, 27):$prod['name']  ?></a>
                  </h3>
                <div class="desc_grid"><?php echo (strlen($prod['description'])>50)?substr($prod['description'], 0, 50)."...":$prod['description']  ?></div>
                <?php if($prod['product_discount_id']==null):?>
                <div class="price-box">
                    <span class="regular-price" id="product-price-29-new"> <span class="price"><?php echo $curr_row['symbol_left'] ?><?php $price = ($prod['price']*$curr_row['value']); echo sprintf("%0.2f",$price); ?></span> </span>
                </div>
                <?php else:?>
                <div class="price-box">
                    <p class="special-price"><span class="price" id="product-price-28-widget-catalogsale-47f89b6ad474ab816f3e47665d7e8af9"> <?php echo $curr_row['symbol_left'] ?><?php $price = ($prod['discount_price']*$curr_row['value']); echo sprintf("%0.2f",$price); ?> </span> </p>
                    <p class="old-price"><span class="price" id="old-price-28-widget-catalogsale-47f89b6ad474ab816f3e47665d7e8af9"> <?php echo $curr_row['symbol_left'] ?><?php $price = ($prod['price']*$curr_row['value']); echo sprintf("%0.2f",$price); ?> </span> </p>
                </div>
                <?php endif; ?>
                <div class="actions">
                  <button type="button" title="Add to Cart" class="button btn-cart" onclick="addToCart('<?php echo $prod['product_id'] ?>','1','<?php echo $curr_row['code'] ?>')"><strong><span class="fa fa-shopping-cart"></span></strong></button>
                  <button type="button" title="Wishlist" class="button btn-cart" onclick="setLocation('<?php echo $prod['product_id'] ?>')"><strong><span class="fa fa-eye"></span></strong></button>                  
                  <a href="product_details/index.php?id=<?php echo $prod['product_id'] ?>" title="<?php echo $prod['name'] ?>" ><button type="button" title="Details" class="button btn-details"  ><span><span>Details</span></span></button></a>
                </div>
              </div>
              <?php //if($prod['quantity']>0): ?>
              <?php if(isset($prod['stock_status'])): ?><div class="label-product"><span class="new"><?php echo $prod['stock_status'] ?></span></div><?php endif; ?>
              <?php //else: ?>
              <!--<div class="label-product ribbon_position"><span class="sale">Sold</span></div>-->
              <?php //endif; ?>
            </div>
        </li>
    <?php endforeach; ?>
    <?php endif;?>
</ul>
<div class="std">
  <div class="clear"></div>
</div>
<?php endforeach; endif;?>

<script>
//    function addToCart(product_id,qty,currency){
//            jQuery.ajax({
//                url:'carts/ajax_add.php',
//                type:'POST',
//                data:'product_id='+product_id+'&qty='+qty+'&currency_code='+currency,
//                success: function(response ){                  
//                    jQuery(".block-cart-header").html(response);                
//                },
//                error: function(jqXHR, textStatus, errorThrown ){
//                    alert(errorThrown);
//                }
//            })
//       
//    }
//     function deleteToCart(product_id){        
//        var r = confirm("Are you sure you would like to remove this item from the shopping cart?");
//        if(r){
//            jQuery.ajax({
//                url:'carts/ajax_delete.php',
//                type:'POST',
//                data:'product_id='+product_id,
//                success: function(response ){
//                    jQuery(".block-cart-header").html(response);
//                },
//                error: function(jqXHR, textStatus, errorThrown ){
//                    alert(errorThrown);
//                }
//            })
//        }
//    }
//    function editToCart(product_id){
//        window.location.assign("cart_information.php")
//    }

function setLocation(product_id){
        product_id = parseInt(product_id);
    
        var _method = 'POST';
        var _url = 'category_products/manage_product_compare.php';
        var _queryStr = {product_id:product_id, type: 'add_wishlist'};
        //alert

        jQuery.ajax({
            type:_method,
            url:_url,
            data:_queryStr,
            success:function (msg) {
                if(msg == '1'){
                    window.location.reload();
                }
                // refresh page
            }
        });
    }

</script>