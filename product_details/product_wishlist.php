<?php
session_start();
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "functions/Session.php";
include_once ROOT . "functions/redirect.php";
require_once ROOT . "settings.php";
require_once "ProductManager.php";
//Session::unsetSessionData('compare_list');
//Session::setCompareProductSession(2);
//Session::setCompareProductSession(3);
//Session::setCompareProductSession(1);
//Session::setCompareProductSession(4);
//pr(Session::getWishlistProductSession()); //die;
//$_SESSION['compare_list'][1] = 1;
//$_SESSION['compare_list'][2] = 1;
//$_SESSION['compare_list'][3] = 1;
//$_SESSION['compare_list'][4] = 1;
?>
<?php 
 $sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);
$isLogged   = $sessUserId;

//echo $isLogged;
if(!$isLogged){
    redirectPage("../login.php?url=product_details/product_wishlist.php");
}

$customerObj = ProductManager::getWishList($sessUserId); // get customer info
$wishListData = ( $customerObj && $customerObj->getWishlist() ? unserialize($customerObj->getWishlist()) : "");

$wishListNow = Session::getWishlistProductSession(); // get current wish list

$wishListArr = $wishListData+$wishListNow;// merge wish list with previous list

ProductManager::saveWishList($sessUserId, $wishListArr); // save wish list in data base
    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Category wise product list</title>
        <?php
        require_once "../config.php";   // load configuration page
        require_once "../include/common_header.php";
        ?>
    </head>
    <body class="ps-static  cms-index-index cms-home">
        <div class="wrapper ps-static en-lang-class">
            <div class="page">
                <?php include_once "../include/swiper.php"; ?>
                <?php include_once "../include/top_bar.php"; ?>
                <div class="header-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="header">
                                    <h1 class="logo"><a href="../index.php?s=1&p=1" title="Juzz Sports"><img src="../images/logo.png" alt=""/></a></h1>
                                    <div class="right_head">
                                        <?php include_once "../include/header_cart.php"; ?>
                                        <?php include_once "../include/header_search.php"; ?>
                                        <?php include_once "../include/head_offer.php"; ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <?php include_once "../include/top_menu.php"; ?>
                <div class="main-container col1-layout">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="main">
                                    <!-- Dynamically set Breadcrumb info -->
                                    <?php $breadcrumbArr = array("Home" => "../index.php?s=1&p=1", "About Us" => "index.php?s=2&p=1&type=about&name=guide", $pageTitle => "#"); ?>
                                    <?php include_once "../include/breadcrumb.php"; ?>
                                    <?php
                                    // Dynamically Set page title and add category button
                                    $titleArr = array('title' => "Products Compare");
                                    ?>
                                    <?php include_once "../include/pape_title.php"; ?>
                                </div>
                                <!-- Page root content info -->
                                <div class="about-col-7" style="margin-top: 20px;">
                                    <?php if (count($_SESSION['wish_list'])) { // if has compare list ?>
                                        <table class="data-table data-table-indent" style="width: 100%;">
                                            <tbody>
                                                <?php
                                                //$wishlistArr = $_SESSION['wish_list'];
                                                $productDataArr = array();

                                                // load all product information by compare product list
                                                if (!empty($wishListArr)) {
                                                    echo '<tr>
                                                            <td>Image</td>
                                                            <td>Product Name</td>
                                                            <td>Model</td>
                                                            <td>Stock</td>
                                                            <td>Unit Price</td>
                                                            <td>Action</td>
                                                        </tr>';
                                                    foreach ($wishListArr as $productId => $activeValue) {
                                                        $wishlistDataArr = ProductManager::getWishlistProducts($productId); // get product list info 
                                                        $imagePath = "../images/products/" . $productId . '/' . $wishlistDataArr['product_image'];
                                                        echo '<tr>
                                                            <td>';
                                                        if (file_exists($imagePath)) {
                                                                echo '<img style="width: 20%; height: 20%;" src="' . BASE_URL . 'images/products/' . $productId . '/' . $wishlistDataArr['product_image'] . '" />';
                                                            } else {
                                                                echo '<img style="width: 20%; height: 20%;" src="' . BASE_URL . 'images/missing.png" />';
                                                            }
                                                            echo '</td>
                                                            <td>'.$wishlistDataArr["product_name"].'</td>
                                                            <td>'.$wishlistDataArr["product_model"].'</td>
                                                            <td>'.$wishlistDataArr["in_stock"].'</td>
                                                            <td>'.number_format($wishlistDataArr["product_price"],2).'</td>
                                                            <td>
                                                            <a href=\'#\' class=\'btn\' onclick=\'event.preventDefault(); addToCart('.$productId.');return false;\'>Add to Cart</a>
                                                            <a href=\'#\' class=\'btn\' onclick=\'event.preventDefault(); removeFromWishlistList('.$productId.');return false;\'>Remore</a></td>
                                                        </tr>';
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php
                                    } else {
                                        echo "<div class='alert alert-info' style='margin-bottom: 200px;'>There are no products here to compare.</div>";
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include_once "../include/footer_offer.php"; ?>
                <?php include_once "../include/footer.php"; ?>
                <?php include_once "../include/copyright.php"; ?>
            </div>
        </div>
    </body>
</html>
<?php //}
//else
    //redirectPage("../login.php?url=product_details/product_wishlist.php");
?>

<script type="text/javascript">
    function removeFromWishlistList(product_id){
        product_id = parseInt(product_id);
    
        var _method = 'POST';
        var _url = '../category_products/manage_product_compare.php';
        var _queryStr = {product_id:product_id, type: 'remove_wishlis'};

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