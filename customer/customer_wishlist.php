<?php
session_start();
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "functions/Session.php";
include_once ROOT . "functions/redirect.php";
require_once ROOT . "settings.php";
require_once "../product_details/ProductManager.php";
require_once "CustomerManager.php";

$sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);
$isLogged   = $sessUserId;

//echo $isLogged;
if(!$isLogged){
    redirectPage("../login.php?url=customer/customer_wishlist.php");
}

$customerObj = CustomerManager::getWishList($sessUserId); // get customer info

$wishListData = ( $customerObj && $customerObj->getWishlist() ? unserialize($customerObj->getWishlist()) : array());

$wishListNow = Session::getWishlistProductSession(); // get current wish list


// merge wish list with save list
$resultWishListArr = array();
if($wishListData && $wishListNow)
    $resultWishListArr = $wishListData+$wishListNow;
else if(!$wishListNow && $wishListData)
    $resultWishListArr = $wishListData;
else if($wishListNow && !$wishListData)
    $resultWishListArr = $wishListNow;

if($resultWishListArr)
    CustomerManager::saveWishList($sessUserId, $resultWishListArr); // save wish list in data base
$currency_name = $curr_row['code'];
//pr($wishListArr);
    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Wish List</title>
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
                                    <?php if(intval($_GET['delete_status'])){?>
                                    <div class="alert alert-info">Product has been removed from wishlist successfully.</div>
                                    <?php }?>
                                    <!-- Dynamically set Breadcrumb info -->
                                    <?php $breadcrumbArr = array("Home" => "../index.php?s=1&p=1", "Wish List" => "#"); ?>
                                    <?php include_once "../include/breadcrumb.php"; ?>
                                    <?php
                                    // Dynamically Set page title and add category button
                                    $titleArr = array('title' => "Wish List");
                                    ?>
                                    <?php include_once "../include/pape_title.php"; ?>
                                </div>
                                <!-- Page root content info -->
                                <div class="about-col-7" style="margin: 20px 0px 100px 0px;">
                                    <?php if ($resultWishListArr) { // if has compare list ?>
                                        <table class="data-table data-table-indent" style="width: 100%;">
                                            <tbody>
                                                <?php
                                                
                                                $productDataArr = array();

                                                // load all product information by compare product list
                                                if (!empty($resultWishListArr)) {
                                                    echo '<tr>
                                                            <th>S/N</th>
                                                            <th>Image</th>
                                                            <th>Product Name</th>
                                                            <th>Model</th>
                                                            <th>Stock</th>
                                                            <th>Unit Price</th>
                                                            <th>Action</th>
                                                        </tr>';
                                                    $counter = 1;
                                                    foreach ($resultWishListArr as $productId => $activeValue) {
                                                        $wishlistDataArr = ProductManager::getWishlistProducts($productId); // get product list info 
                                                        $imagePath = "../images/products/" . $productId . '/' . $wishlistDataArr['product_image'];
                                                        echo '<tr>';
                                                        echo '<td style="text-align: center;">'.$counter++.'</td>';
                                                            echo '<td>';
                                                        if (file_exists($imagePath)) {
                                                                echo '<img style="width: 15%; height: 15%;" src="' . BASE_URL . 'images/products/' . $productId . '/' . $wishlistDataArr['product_image'] . '" />';
                                                            } else {
                                                                echo '<img style="width: 15%; height: 15%;" src="' . BASE_URL . 'images/missing.png" />';
                                                            }
                                                            echo '</td>
                                                            <td><a href="../product_details/index.php?id='.$productId.'">'.$wishlistDataArr["product_name"].'</a></td>
                                                            <td>'.$wishlistDataArr["product_model"].'</td>
                                                            <td>'.$wishlistDataArr["in_stock"].'</td>
                                                            <td>'.number_format($wishlistDataArr["product_price"],2).'</td>
                                                            <td>';
                                                            echo "<button type='button' title='Add to Cart' class='button btn-cart' onClick='addToCart(\"$productId\", \"1\", \"$currency_name\"); return false;' ><span><span>Add to Cart</span></span></button>";
//                                                            echo '<a href=\'#\' class=\'btn\' onclick=\'event.preventDefault(); addToCart('.$productId.');return false;\'>Add to Cart</a>';
                       echo '<a onclick="return confirm(\'Do you want to remove this product from wish list?\');" href="remove_wish_list.php?customer_id='.$sessUserId.'&product_id='.$productId.'" class=\'btn\'>Remove</a></td>';
                                                        echo '</tr>';
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php
                                    } else {
                                        echo "<div class='alert alert-info' style='margin-bottom: 200px;'>There are no products in your wish list.</div>";
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
        var _url = 'remove_wish_list.php';
        var _queryStr = {product_id:product_id, type: 'remove_wishlish'};

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