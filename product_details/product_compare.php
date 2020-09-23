<?php
session_start();
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "functions/Session.php";
require_once ROOT . "settings.php";
require_once "ProductManager.php";
//Session::unsetSessionData('compare_list');
//Session::setCompareProductSession(2);
//Session::setCompareProductSession(3);
//Session::setCompareProductSession(1);
//Session::setCompareProductSession(4);
//pr(Session::getCompareProductSession()); //die;
//$_SESSION['compare_list'][1] = 1;
//$_SESSION['compare_list'][2] = 1;
//$_SESSION['compare_list'][3] = 1;
//$_SESSION['compare_list'][4] = 1;
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
                <?php include_once "../include/top_menu.php";?>
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
                                    <?php if (count($_SESSION['compare_list'])) { // if has compare list ?>
                                        <table class="data-table data-table-indent" style="width: 100%;">
                                            <tbody>
                                                <?php
                                                // label names
                                                $labelArr = array("Product", "Image", "Price", "Model", "Manufacture", "Availability", "Summary", "Weight", "Dimensions (L x W x H)", "&nbsp;");
                                                $compareListArr = $_SESSION['compare_list'];
                                                $productDataArr = array();

                                                // load all product information by compare product list
                                                foreach ($compareListArr as $productId => $activeValue) {

                                                    $productArr = ProductManager::getProductDetailsById($productId); // get product list info

                                                    $productDataArr[0][$productArr['product_id']] = $productArr['product_name'];
                                                    $productDataArr[1][$productArr['product_id']] = $productArr['product_image'];
                                                    $productDataArr[2][$productArr['product_id']] = $curr_row['symbol_left'].' '.number_format($productArr['product_price']*$curr_row['value'], 2).' '.$curr_row['symbol_right'];
                                                    $productDataArr[3][$productArr['product_id']] = $productArr['product_model'];
                                                    $productDataArr[4][$productArr['product_id']] = $productArr['manufacturer_name'];
                                                    $productDataArr[5][$productArr['product_id']] = $productArr['in_stock'];
                                                    $productDataArr[6][$productArr['product_id']] = $productArr['product_description'];
                                                    $productDataArr[7][$productArr['product_id']] = number_format($productArr['product_weight'], 2).' ('.$productArr['product_unit'].')';
                                                    $productDataArr[8][$productArr['product_id']] = number_format($productArr['product_width'], 2) . ' x ' . number_format($productArr['product_length'], 2) . ' x ' . number_format($productArr['product_height'], 2).' ('.$productArr['product_length_unit'].')';
                                                    $currency_name = $curr_row['code'];

                                                    $productDataArr[9][$productArr['product_id']] = "<a href='#' class='btn' onclick='event.preventDefault(); removeFromCompareList($productId);return false;'>Remove</a>&nbsp;&nbsp;".
"<button type='button' title='Add to Cart' class='button btn-cart' onClick='addToCart(\"$productId\", \"1\", \"$currency_name\"); return false;' ><span><span>Add to Cart</span></span></button>";
                                                    
                                                    }
                                                foreach ($labelArr as $index => $label) { // print product compare data label wise
                                                    echo '<tr>';
                                                    echo '<td style="width: 15%; font-weight: bold;">' . $label . '</td>';
                                                    foreach ($compareListArr as $productId => $value) { // displat product information
                                                        if ($index == 1) {
                                                            $imagePath = "../images/products/" . $productId . '/' . $productDataArr[$index][$productId];
                                                            echo "<td>";
                                                            if (file_exists($imagePath)) {
                                                                echo '<img style="width: 20%; height: 20%;" src="' . BASE_URL . 'images/products/' . $productId . '/' . $productDataArr[$index][$productId] . '" />';
                                                            } else {
                                                                echo '<img style="width: 20%; height: 20%;" src="' . BASE_URL . 'images/missing.png" />';
                                                            }

                                                            echo "</td>";
                                                        } else {
                                                            if ($index == 0)
                                                                echo '<td> <a style="color: #FF5A00" href="index.php?id=' . $productId . '">' . $productDataArr[$index][$productId] . '</a></td>';
//                                                            elseif ($index == 7 || $index == 8)
//                                                                echo '<td style="' . ($index == 0 ? 'color: #FD6A56' : '') . '">' . $productDataArr[$index][$productId] . ' ( ' . $productDataArr[9][$productId] . ' )</td>';
                                                            else
                                                                echo '<td style="' . ($index == 0 ? 'color: #FD6A56' : '') . '">' . $productDataArr[$index][$productId] . '</td>';
                                                        }?>
<!--                                                <td><button type="button"  style="margin-left: 25%; margin-right: 25%; width: 50%; border: 1px solid gray; height: 40px;" onclick="removeFromCompareList('<?php //echo $productId; ?>');return false;"><strong>Remove</strong></button></td>-->
                                                    <?php }
                                                    echo '</tr>';?>
<!--                                                <tr></tr>-->
                                                <?php }

//                                                echo "<tr> <td></td>";
//
//                                                foreach ($compareListArr as $session_data) {
//                                                    ?>
<!--                                                <tr><td></td><td><button type="button" class="buttons btn-carts" style="margin-left: 25%; margin-right: 25%; width: 50%; border: 1px solid gray; height: 40px;" ><strong>Add to Cart</strong></button></td></tr>-->
                                                <?php
//                                                }
//                                                echo "</tr>";
//                                                echo "<tr> <td></td>";
//
//                                                foreach ($compareListArr as $session_data) {
//                                                    ?>
<!--                                                <tr><td></td><td><button type="button"  style="margin-left: 25%; margin-right: 25%; width: 50%; border: 1px solid gray; height: 40px;" onclick="removeFromCompareList('//<?php echo $productId; ?>');return false;"><strong>Remove</strong></button></td></tr>-->
                                            <?php
//                                            }
//                                            echo "</tr>";
                                            echo ' </tbody>
                                </table>';
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

<script type="text/javascript">
    function removeFromCompareList(product_id){
         //.preventDefault();
        product_id = parseInt(product_id);
    
        var _method = 'POST';
        var _url = '../category_products/manage_product_compare.php';
        var _queryStr = {product_id:product_id, type: 'remove'};

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
    
    function addToCartsss(product_id,qty,currency){
            jQuery.ajax({
                url:'../carts/ajax_add.php',
                type:'POST',
                data:'product_id='+product_id+'&qty='+qty+'&currency_code='+currency,
                success: function(response ){                   
                    jQuery(".block-cart-header").html(response);
                    var prod_name = jQuery(".block-cart-header").find('#product_add').html();
                    jQuery("#add_cart_success").html("Success: You have added  <a href='index.php?id="+product_id+"'>"+ prod_name+"</a> to your shopping cart!").toggle();
                },
                error: function(jqXHR, textStatus, errorThrown ){
                    alert(errorThrown);
                }
            })

    }
</script>