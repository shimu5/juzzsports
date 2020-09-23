<?php
require_once ROOT."classes/Product.php";
require_once ROOT."classes/Tag.php";
require_once ROOT."classes/Manufacturer.php";

$categoryId = intval($_GET['category_id']);

$productId = 0;

$filterArr = array();
if(!$isRemoveManufacturer){ // if manufacture filter is not reset
    $filterArr['manufacturer_id'] = $getManufacturerId;
}
if(!$isRemovePrice){// if price filter is not reset
    $filterArr['price'] = $getPrice;
}

if($categoryId)
    $productListArr = Product::loadByCategoryId($categoryId, $filterArr , 1); // get product list category and filter wise
else{
    $tagId = intval($_GET['tag_id']) ? intval($_GET['tag_id']) : 1; // load by tag_id
    $productListArr = Product::productsByTag($tagId, 100, 1, $filterArr); // get product list by tag id  =1 and limit to 6. default shop items
    $tagObj         = Tag::loadById($tagId , 1 ); // get tag name
}

$categoryObj = Category::loadById($categoryId , 1); // get category info by category id

?>

<div class="page-title category-title">
    <h1><?php echo ($categoryObj ? $categoryObj->getCategoryName() : ($tagObj ? $tagObj->getTagName() : "") ); // show category name;?></h1>
</div>

<?php if($getPrice || $getManufacturerId){ // show filter by items ?>
<div class="alert">
 <strong>Filter By : </strong>
    <?php if(!$isRemovePrice && $getPrice){ $getPriceArr = explode("_", $getPrice);?>
        Price: <a href="#"><?php echo $curr_row['symbol_left'].number_format($getPriceArr[0]*$curr_row['value'], 2, '.', '').' - '.($getPriceArr[1] != 'p' ? $curr_row['symbol_left'].number_format($getPriceArr[1]*$curr_row['value'], 2, '.', '') : 'and above')?></a>
    <?php }?>
    <?php if(!$isRemoveManufacturer && !$isRemovePrice && $getPrice && $getManufacturerId){
        echo ',';
    }?>
    <?php if(!$isRemoveManufacturer && $getManufacturerId){?>
        Manufacturer: <a href="#"> <?php echo Manufacturer::getManufacturerNameById($getManufacturerId);?></a>
    <?php }?>
</div>
<?php }?>

<div class="category-products" style="margin-bottom: 20px;">
    <?php
    if($productListArr){ // display product list
        $counterProduct = 1;
        $totalProduct   = count($productListArr);
        foreach($productListArr as $productArr){
            if($counterProduct % 3 == 1)
                echo '<ul class="products-grid row '.($counterProduct == 1 ? 'first' : ($counterProduct == $totalProduct ? 'last' : '')).' '.($counterProduct%2 == 1 ? 'odd' : 'even').'">';
            $productId = intval($productArr['product_id']);
            $filename = "../images/products/".$productId."/".$productArr['image'];

?>

                <li class="item col-xs-pro <?php echo ($counterProduct%3 == 1 ? 'first' : ($counterProduct%3 == 0 ? 'last' : ''))?>">
                    <div class="grid_wrap"> <a href="../product_details/index.php?id=<?php echo $productId;?>" title="<?php echo $productArr['name'];?>" class="product-image">
                            <?php if(file_exists($filename)){ ?>
                                <img src="<?php echo BASE_URL ?>images/products/<?php echo $productId."/".$productArr['image']; ?>" alt="<?php echo $productArr['image'];?>"/>
                            <?php }else{?>
                                <img src="<?php echo BASE_URL ?>images/missing.png" alt="No image available" class="image_home"/>
                            <?php }?>

                        </a>
                        <div class="product-shop">
                            <h3 class="product-name"><a href="../product_details/index.php?id=<?php echo $productId;?>" title="<?php echo $productAlrr['name'];?>"><?php echo truncatewords($productArr['name'], 3);?></a></h3>
                            <div class="desc_grid"><?php echo truncatewords($productArr['description'], 7);?></div>

                            <?php if( empty($productArr['product_discount_id']) ){?>
                                <div class="price-box">
                                    <span class="regular-price" id="product-price-29-new"> <span class="price"><?php echo $curr_row['symbol_left'] ?><?php $price = ($productArr['price']*$curr_row['value']); echo sprintf("%0.2f",$price); ?></span> </span>
                                </div>
                            <?php } else{?>
                                <div class="price-box">
                                    <p class="special-price"><span class="price" id="product-price-28-widget-catalogsale-47f89b6ad474ab816f3e47665d7e8af9"> <?php echo $curr_row['symbol_left'] ?><?php $price = ($productArr['discount_price']*$curr_row['value']); echo sprintf("%0.2f",$price); ?> </span> </p>
                                    <p class="old-price"><span class="price" id="old-price-28-widget-catalogsale-47f89b6ad474ab816f3e47665d7e8af9"> <?php echo $curr_row['symbol_left'] ?><?php $price = ($productArr['price']*$curr_row['value']); echo sprintf("%0.2f",$price); ?> </span> </p>
                                </div>
                            <?php } ?>

                            <!--div class="actions">
                                <button type="button" title="Add to Cart" class="button btn-cart" onclick="addToCart('<?php echo $productId ?>','1','<?php echo $curr_row['code'] ?>')"><strong><span class="fa fa-shopping-cart"></span></strong></button>
                                <button type="button" title="Wishlist" class="button btn-cart" onclick="setLocation('#')"><strong><span class="fa fa-eye"></span></strong></button>
                                <button type="button" title="Details" class="button btn-details" onclick="setLocation('#')"><span><span>Details</span></span></button>
                            </div-->
							
							<div class="actions">
                                <button type="button" title="Add to Cart" class="button btn-cart" onclick="addToCart('<?php echo $productId ?>','1','<?php echo $curr_row['code'] ?>')"><strong><span class="fa fa-shopping-cart"></span></strong></button>
<!--                                <button type="button" title="Wishlist" class="button btn-cart" onclick="setLocation('#')"><strong><span class="fa fa-eye"></span></strong></button>-->
                                <button type="button" title="Wishlist" class="button btn-cart" onclick="setWishlist('<?php echo $productId ?>')"><strong><span class="fa fa-eye"></span></strong></button>

                                <button type="button" title="Compare Product" class="button btn-cart" onclick="addToCompareList('<?php echo $productId;?>');return false;"><strong><span class="fa fa-align-center"></span></strong></button>
                                <a href="../product_details/index.php?id=<?php echo $productId;?>" title="<?php echo $productAlrr['name'];?>"><button type="button" title="Details" class="button btn-details" > <span><span style="padding: 0px 10px;">Details</span></span></button></a>

                            </div>
							
                        </div>
                        <?php if($productArr['quantity']>0): ?>
                            <div class="label-product"><span class="new">New</span></div>
                        <?php else: ?>
                            <div class="label-product ribbon_position"><span class="sale">Sold</span></div>
                        <?php endif; ?>
                    </div>
                </li>
<?php
            if($counterProduct % 3 == 0)
                echo '</ul>';

            $counterProduct++;
        }
    }
    else{
        echo "<div class='alert alert-info'>There is no product available in this category now.</div>";
    }
    ?>


</div>

<script type="text/javascript">
    function goProductDetailsPage(productId)
    {
        productId = parseInt(productId);

        window.location.href = '../product_details/index.php?id='+productId;
        window.document.location = '../product_details/index.php?id='+productId;
    }

function setWishlist(product_id){
    product_id = parseInt(product_id);
    
    var _method = 'POST';
    var _url = 'manage_product_compare.php';
    var _queryStr = {product_id:product_id, type: 'add_wishlist'};

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

function addToCompareList(product_id){
    product_id = parseInt(product_id);
    
    var _method = 'POST';
    var _url = 'manage_product_compare.php';
    var _queryStr = {product_id:product_id, type: 'add'};

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
