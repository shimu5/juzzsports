<?php
session_start();
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT."functions/functions.php";
require_once ROOT ."settings.php";
require_once ROOT ."classes/Product.php";
require_once ROOT ."classes/ProductImage.php";
require_once ROOT ."classes/ProductRelated.php";

$productId = intval($_GET['id']);

Product::updateNoOfViewed($productId); //update no of times viewed this product

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Product Details</title>
    <?php
    require_once "../config.php";
    //die(ROOT);
    require_once "../include/common_header.php";
    ?>
    <script type="text/javascript" src="../js/cloud-zoom.1.0.2.js"></script>
    <script type="text/javascript" src="../js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="../js/klass.min.js"></script>
    <script type="text/javascript" src="../js/code.photoswipe.jquery-3.0.5.js"></script>
    <script src="../js/dw_paus_scroller.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../css/cloud-zoom.css" media="all" />
</head>
<body class="ps-static  cms-index-index cms-home">
<div class="wrapper ps-static en-lang-class">
<div class="page">
<?php include_once "../include/swiper.php";?>
<?php include_once "../include/top_bar.php";?>
<div class="header-container">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="header">
          <h1 class="logo"><a href="../index.php" title="Juzz Sports"><img src="../images/logo.png" alt=""/></a></h1>
          <div class="right_head">
            <?php include_once "../include/header_cart.php";?>
            <?php include_once "../include/header_search.php";?>
            <?php include_once "../include/head_offer.php";?>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php include_once "../include/top_menu.php";?>
<!-------------------------------------Start of Mid Content---------------------------------->
<div class="main-container col2-right-layout">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="main">
                <!-- Dynamically set Breadcrumb info -->
                    <?php $breadcrumbArr = array("Home" => "index.php?s=1&p=1", "Shop" => "../category_products/index.php?s=3&path=0","Product Details" => "#"); ?>
                    <?php include_once "../include/breadcrumb.php";?>
                    <div class="row">
                        <div class="col-main-pro col-xs-12 col-sm-9">
                            <?php
                            $productId = $_GET['id'];
                            $productId = intval($productId);

                            if($productId <= 0) { // invalid product id, return to home page
                                ob_start();
                                header('location:'.BASE_URL.'index.php');
                                return true;
                            }
                            ?>
                            <div class="padding-s">
                            <?php include_once "products_details_content.php";?>
                            </div>
                        </div>
                        <?php include_once "products_details_right_panel.php";?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-------------------------------------End of Mid Content------------------------------------>
<?php include_once "../include/footer_offer.php";?>
<?php include_once "../include/footer.php";?>
<?php include_once "../include/copyright.php";?>
</div>
</div>
</body>
</html>
<script type="text/javascript">
    jQuery(".btn-cart").click(function(){
        var quantity = parseInt(jQuery("#qty").val());

        if(quantity <= 0){ // make an alert for 0 or -value quantity
            alert('Please enter the right quantity.');
            return false;
        }

        addToCart('<?php echo $product['product_id'] ?>',jQuery("#qty").val(),'<?php echo $curr_row['code'] ?>');
    })

    function addToCompareList(product_id){
        product_id = parseInt(product_id);

        var _method = 'POST';
        var _url = '../category_products/manage_product_compare.php';
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

    function setWishlist(product_id){
        product_id = parseInt(product_id);

        var _method = 'POST';
        var _url = '../category_products/manage_product_compare.php';
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

</script>