<?php
    $product = Product::productById( $productId );
    $related_images = ProductImage::loadByProductId($productId,3);

?>
<div id="notification">
<div id="add_cart_success"></div>
</div>
<div id="messages_product_view"></div>    
    <div class="product-view">
      <div class="product-essential">
      <!--  <form action="index.php?id=<?php //echo $productId ?>" method="post" id="product_addtocart_form">-->
          <input name="form_key" type="hidden" value="dm0652KFiShli2j5" />
          <div class="no-display">
            <input type="hidden" name="product" value="27" />
            <input type="hidden" name="related_product" id="related-products-field" value="" />
          </div>
          <div class="product-img-box">
            <div class="product-box-customs">
                <p class="product-image">
                    <?php
                    $filePath = "";
                    $filePathJpg = "../images/products/{$product['product_id']}/".$related_images[0]['image_name']."_600x600.jpg";
                    $filePathPng = "../images/products/{$product['product_id']}/".$related_images[0]['image_name']."_600x600.png";
                    $filePathJpeg = "../images/products/{$product['product_id']}/".$related_images[0]['image_name']."_600x600.jpeg";
                    $filePathGif = "../images/products/{$product['product_id']}/".$related_images[0]['image_name']."_600x600.gif";
                    $filePathBmp = "../images/products/{$product['product_id']}/".$related_images[0]['image_name']."_600x600.bmp";
                    if (file_exists($filePathJpg)){ // if jpg file
                        $filePath = $filePathJpg;
                    }
                    else if (file_exists($filePathJpeg)){ // if jpeg file
                        $filePath = $filePathJpeg;
                    }
                    else if (file_exists($filePathPng)){ // if png file
                        $filePath = $filePathPng;
                    }
                    else if (file_exists($filePathGif)){ // if gif file
                        $filePath = $filePathGif;
                    }
                    else if (file_exists($filePathBmp)){ // if bmp file
                        $filePath = $filePathBmp;
                    }
                    else
                        $filePath = BASE_URL."images/missing.png";

                    clearstatcache(); // clean cache
                    ?>
                  <a  href='<?php echo $filePath; ?>' class = 'cloud-zoom' id='zoom1' rel="position:'right',showTitle:1,titleOpacity:0.5,lensOpacity:0.5,adjustX: 10,adjustY:-4">
                      <img class="big" src="<?php echo $filePath ?>" alt='' title="<?php echo $title ?>" style="width:308px;height:308px"/>
                  </a>
              </p>
              <div class="more-views">
                <h2>More Views</h2>
                <div class="container-slider">
                  <ul class="slider tumbSlider-none" >
                   <?php foreach($related_images as $rimage):
                       $filePathSm = "";
                       $filePathJpg = "../images/products/{$product['product_id']}/".$rimage['image_name']."_308x308.jpg";
                       $filePathPng = "../images/products/{$product['product_id']}/".$rimage['image_name']."_308x308.png";
                       $filePathJpeg = "../images/products/{$product['product_id']}/".$rimage['image_name']."_308x308.jpeg";
                       $filePathGif = "../images/products/{$product['product_id']}/".$rimage['image_name']."_308x308.gif";
                       $filePathBmp = "../images/products/{$product['product_id']}/".$rimage['image_name']."_308x308.bmp";
                       if (file_exists($filePathJpg)){ // if jpg file
                           $filePathSm = $filePathJpg;
                       }
                       else if (file_exists($filePathJpeg)){ // if jpeg file
                           $filePathSm = $filePathJpeg;
                       }
                       else if (file_exists($filePathPng)){ // if png file
                           $filePathSm = $filePathPng;
                       }
                       else if (file_exists($filePathGif)){ // if gif file
                           $filePathSm = $filePathGif;
                       }
                       else if (file_exists($filePathBmp)){ // if bmp file
                           $filePathSm = $filePathBmp;
                       }
                       else
                           $filePathSm = BASE_URL."images/missing.png";
                       $filePathSm2 = "";
                       $filePathJpg = "../images/products/{$product['product_id']}/".$rimage['image_name']."_600x600.jpg";
                       $filePathPng = "../images/products/{$product['product_id']}/".$rimage['image_name']."_600x600.png";
                       $filePathJpeg = "../images/products/{$product['product_id']}/".$rimage['image_name']."_600x600.jpeg";
                       $filePathGif = "../images/products/{$product['product_id']}/".$rimage['image_name']."_600x600.gif";
                       $filePathBmp = "../images/products/{$product['product_id']}/".$rimage['image_name']."_600x600.bmp";
                       if (file_exists($filePathJpg)){ // if jpg file
                           $filePathSm2 = $filePathJpg;
                       }
                       else if (file_exists($filePathJpeg)){ // if jpeg file
                           $filePathSm2 = $filePathJpeg;
                       }
                       else if (file_exists($filePathPng)){ // if png file
                           $filePathSm2 = $filePathPng;
                       }
                       else if (file_exists($filePathGif)){ // if gif file
                           $filePathSm2 = $filePathGif;
                       }
                       else if (file_exists($filePathBmp)){ // if bmp file
                           $filePathSm2 = $filePathBmp;
                       }
                       else
                           $filePathSm2 = BASE_URL."images/missing.png";
                       clearstatcache();
                       ?>
                    <li> <a href='<?php echo $filePathSm2 ?>' class='cloud-zoom-gallery' title='' rel="useZoom: 'zoom1', smallImage: '<?php echo $filePathSm ?>' ">
                            <img src="<?php echo $filePathSm ?>" alt="" class="smallsize"/> </a> </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="product-shop">
            <div class="product-name">
              <h1><?php echo $product['name']; ?></h1>
            </div>
            <p class="availability in-stock">Availability: <span><?php echo $product['stock_name']; ?></span></p>
            
            <div class="price-box">
                <?php if(!isset($product['product_discount_id'])): ?>
                <span class="regular-price" id="product-price-27"> <span class="price"><?php echo $cur_symb ?><?php $price = $product['price'] * $cur_rate;  echo sprintf("%0.2f",$price); ?></span> </span>
                <?php else: ?>
                <span class="regular-price" id="product-price-27"> <span class="price"><?php echo $cur_symb ?><?php $price = $product['discount_price'] * $cur_rate;  echo sprintf("%0.2f",$price); ?></span> </span>
                <span class="old-price" id="product-price-27"> <span class="price"> <?php echo $cur_symb ?><?php $price = ($product['price']*$curr_row['value']); echo sprintf("%0.2f",$price); ?> </span> </span>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
            <div class="short-description">
              <h2>Quick Overview</h2>
              <!--<div class="std"><?php //echo $product['description'] ?></div>-->
            </div>
            <div class="clear"></div>
            <div class="add-to-box">
              <div class="add-to-cart">
                <div class="qty-block">
                  <label for="qty">Qty:</label>
                  <input type="text" name="qty" id="qty" maxlength="12" value="1" title="Qty" class="input-text qty" />
                </div>
                <button type="button" title="Add to Cart" class="button btn-cart" onClick="return false;addToCart('<?php echo $product['product_id'] ?>','1','<?php echo $curr_row['code'] ?>'); return false;"><span><span>Add to Cart</span></span></button>
<!--                <a href="#" class="btn button" onClick="addToCart('<?php echo $product['product_id'] ?>','1','<?php echo $curr_row['code'] ?>')">Add to Cart</a>-->
              </div>
              <span class="or">OR</span>
              <ul class="add-to-links">
                <li><a href="#" onClick="setWishlist('<?php echo $product['product_id'] ?>'); return false;" class="link-wishlist">Add to Wishlist</a></li>
                <li><span class="separator">|</span> <a href="#" class="link-compare" onClick="addToCompareList('<?php echo $product['product_id'] ?>','1','<?php echo $curr_row['code'] ?>')" >Add to Compare</a></li>
              </ul>
            </div>
            <style>
                #at3win #at3winheader h3 {
                    text-align:left !important;
                }
            </style>
          </div>
          <div class="clearer"></div>
       
      </div>
      <div class="product-collateral">
        <div class="box-collateral box-description">
          <h2>Details</h2>
          <div class="box-collateral-content">
            <div class="std"> <?php echo $product['description'] ?></div>
          </div>
        </div>
      </div>
    </div>

    

