<?php

require_once ROOT ."functions/Session.php";
$related_products = ProductRelated::loadByProductId($productId, 5);
$compareListArr = Session::getCompareProductSession();
//pr($related_products);
?>
<div class="col-right sidebar col-xs-12 col-sm-3">

    <div class="block block-related">
        <?php if (count($compareListArr)) { ?>
        <div class="block block-cart" style="margin-bottom: 20px;">
            <div class="block-title" style="margin: 0px;">
                    <strong><span>Compare Products</span></strong>
                </div>
                <div class="block-content">
                    <div class="block-content">
                        <p class="empty">You have chosen <a href="../product_details/product_compare.php"><strong><?php echo count($compareListArr); ?> products</strong></a> to compare.</p>
                    </div>

                </div>
            </div>
        <?php } ?>
        <div class="block-title"> <strong><span>Related Products</span></strong> </div>
        <div class="block-content">

            <?php if (!empty($related_products)) : ?>
                <ol class="mini-products-list" id="block-related">
                    <?php foreach ($related_products as $related) : ?>
                        <li class="item">

                            <div class="product">
                                <a href="index.php?id=<?php echo $related['product_id'];?>" title="Lorem ipsum dolor sit amet conse ctetur adipisicing elit" class="product-image">
                                    <?php
                                    $filename = "../images/products/" . $related['product_id'] . "/" . $related['image'];
                                    if (file_exists($filename)):
                                        ?>
                                        <img src="<?php echo BASE_URL ?>images/products/<?php echo $related['product_id'] . "/" . $related['image'] ?>" alt="<?php echo $related['name'] ?>" class="smallsize"/>
                                    <?php else : ?>
                                        <img src="<?php echo BASE_URL ?>images/missing.png" alt="No image available" class="smallsize" alt="<?php $related['name'] ?>"/>
        <?php endif; ?>                             
                                </a>
                                <p class="product-name"><a href="index.php?id=<?php echo $related['product_id'];?>"><?php echo $related['name'] ?></a></p>
                                <div class="product-details">
                                    <div class="price-box">
                                        <?php if (intval($related['product_discount_id']) == 0): ?>
                                            <p class="special-price"><span class="price-label">Regular Price:</span><span class="price" id="product-price-7-related"><?php echo $cur_symb ?><?php $price = ($related['price'] * $curr_row['value']);
                                echo sprintf("%0.2f", $price); ?></span> </p>
                                        <?php else: ?>
                                            <p class="special-price"> <span class="price-label">Discount Price</span><span class="price" id="product-price-7-related"> <?php echo $cur_symb ?><?php $price = ($related['discount_price'] * $curr_row['value']);
                                echo sprintf("%0.2f", $price); ?> </span> </p>
                                            <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price" id="old-price-7-related"><?php echo $cur_symb ?><?php $price = ($related['price'] * $curr_row['value']);
                                echo sprintf("%0.2f", $price); ?> </span> </p>
        <?php endif; ?>
                                    </div>
                                    <a href="#" onclick="setWishlist('<?php echo $related['product_id'] ?>'); return false;" class="link-wishlist" >Add to Wishlist</a>
                                    <div class="clear"></div>
                                    <a href="#" class="link-cart" onClick="addToCart('<?php echo $related['product_id'] ?>','1','<?php echo $curr_row['code'] ?>')">Add to Cart</a> </div>
                            </div>
                        </li>
    <?php endforeach; ?>            
                </ol>
<?php endif; ?>

        </div>

    </div> 
    <!--<div class="block block-cart">
      <div class="block-title"> <strong><span>My Cart</span></strong> </div>
      <div class="block-content">
        <div class="summary">
          <p class="amount">There are <a href="#">4 items</a> in your cart.</p>
          <p class="subtotal"> <span class="label">Cart Subtotal:</span> <span class="price">$130.40</span> </p>
        </div>
        <div class="actions">
          <button type="button" title="Checkout" class="button" onClick="setLocation('#')"><span><span>Checkout</span></span></button>
        </div>
        <p class="block-subtitle">Recently added item(s)</p>
        <ol id="cart-sidebar" class="mini-products-list">
          <li class="item">
            <div class="product-control-buttons"> <a href="#" title="Remove This Item" onClick="return confirm('Are you sure you would like to remove this item from the shopping cart?');" class="btn-remove">Remove This Item</a> <a href="#" title="Edit item" class="btn-edit">Edit item</a> </div>
            <a href="#" class="product-image"><img src="../images/product_90x90.png" alt="" /></a>
            <p class="product-name"><a href="#">Lorem ipsum dolor sit amet conse ctetur adipisicing elit</a></p>
            <div class="product-details"> <strong>2</strong> x <span class="price">$23.20</span> </div>
          </li>
          <li class="item">
            <div class="product-control-buttons"> <a href="#" title="Remove This Item" onClick="return confirm('Are you sure you would like to remove this item from the shopping cart?');" class="btn-remove">Remove This Item</a> <a href="#" title="Edit item" class="btn-edit">Edit item</a> </div>
            <a href="#" class="product-image"><img src="../images/product_90x90.png" alt="" /></a>
            <p class="product-name"><a href="#">Lorem ipsum dolor sit amet conse ctetur adipisicing elit</a></p>
            <div class="product-details"> <strong>2</strong> x <span class="price">$42.00</span> </div>
          </li>
        </ol>
      </div>
    </div>-->
    <!--<div class="block block-list block-compare">
      <div class="block-title"> <strong><span>Compare Products </span></strong> </div>
      <div class="block-content">
        <p class="empty">You have no items to compare.</p>
      </div>
    </div>
    <div class="block block-list block-viewed">
      <div class="block-title"> <strong><span>Recently Viewed Products</span></strong> </div>
      <div class="block-content">
        <ol id="recently-viewed-items">
          <li class="item">
            <p class="product-name"><a href="#">Lorem ipsum dolor sit amet conse ctetur adipisicing elit</a></p>
          </li>
          <li class="item">
            <p class="product-name"><a href="#">Lorem ipsum dolor sit amet conse ctetur adipisicing elit</a></p>
          </li>
        </ol>

      </div>
    </div>
    <div class="block block-tags">
      <div class="block-title"> <strong><span>Popular Tags</span></strong> </div>
      <div class="block-content">
        <ul class="tags-list">
          <li><a href="#" style="font-size:145%;">bundles</a></li>
          <li><a href="#" style="font-size:145%;">collection</a></li>
          <li><a href="#" style="font-size:145%;">conditioners</a></li>
          <li><a href="#" style="font-size:110%;">demanding</a></li>
          <li><a href="#" style="font-size:110%;">emphasize</a></li>
          <li><a href="#" style="font-size:110%;">experiment</a></li>
          <li><a href="#" style="font-size:75%;">professionally</a></li>
          <li><a href="#" style="font-size:75%;">shampoos</a></li>
        </ul>
        <div class="actions"> <a href="#">View All Tags</a> </div>
      </div>
    </div>
    <div class="block block-poll">
      <div class="block-title"> <strong><span>Community Poll</span></strong> </div>
      <form id="pollForm" action="http://livedemo00.template-help.com/magento_48581/poll/vote/add/poll_id/1/" method="post" onSubmit="return validatePollAnswerIsSelected();">
        <div class="block-content">
          <p class="block-subtitle">What is the main reason for you to purchase products online?</p>
          <ul id="poll-answers">
            <li>
              <input type="radio" name="vote" class="radio poll_vote" id="vote_1" value="1" />
              <span class="label">
              <label for="vote_1">More convenient shipping and delivery</label>
              </span> </li>
            <li>
              <input type="radio" name="vote" class="radio poll_vote" id="vote_2" value="2" />
              <span class="label">
              <label for="vote_2">Lower price</label>
              </span> </li>
            <li>
              <input type="radio" name="vote" class="radio poll_vote" id="vote_3" value="3" />
              <span class="label">
              <label for="vote_3">Bigger choice</label>
              </span> </li>
            <li>
              <input type="radio" name="vote" class="radio poll_vote" id="vote_4" value="4" />
              <span class="label">
              <label for="vote_4">Centralized product search procedure (without having to leave your home)</label>
              </span> </li>
            <li>
              <input type="radio" name="vote" class="radio poll_vote" id="vote_5" value="5" />
              <span class="label">
              <label for="vote_5">Payments security</label>
              </span> </li>
            <li>
              <input type="radio" name="vote" class="radio poll_vote" id="vote_6" value="6" />
              <span class="label">
              <label for="vote_6">30-day Money Back Guarantee</label>
              </span> </li>
            <li>
              <input type="radio" name="vote" class="radio poll_vote" id="vote_7" value="7" />
              <span class="label">
              <label for="vote_7">Other.</label>
              </span> </li>
          </ul>
          
          <div class="actions">
            <button type="submit" title="Vote" class="button"><span><span>Vote</span></span></button>
          </div>
        </div>
      </form>
    </div>-->
</div>
