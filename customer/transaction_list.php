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

// pagination script
$page        = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
$limit       = CustomerManager::getPageLimit(); // No. of page try to display
$start       = $page ? ($page - 1) * $limit : 0; //first item to display on this page

//echo $isLogged;
if(!$isLogged){
    redirectPage("../login.php?url=customer/transaction_list.php");
}

$customerTransactionObj = CustomerManager::getTransactionList($sessUserId,$start, $limit); // get customer transaction info

$valance = CustomerManager::getTotalCustomerBalance($sessUserId); // get total customer balance

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Transaction List</title>
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
                            <?php $breadcrumbArr = array("Home" => "../index.php?s=1&p=1", "Profile" => "index.php", "Transaction List" => "#"); ?>
                            <?php include_once "../include/breadcrumb.php"; ?>
                            <?php
                            // Dynamically Set page title
                            $titleArr = array('title' => "Transaction List");
                            ?>
                            <?php include_once "../include/pape_title.php"; ?>
                        </div>
                        <!-- Page root content info -->
                        <div class="about-col-7" style="margin: 20px 0px 100px 0px;">
                            <?php  if ($customerTransactionObj) { // if has compare list ?>
                                <div class="alert">Your current balance is:<b> <?php echo $curr_row['symbol_left'];?> <?php echo number_format(($valance*$curr_row['value']), 2, '.', ''); ?></b></div>
                                <table class="data-table data-table-indent" style="width: 100%;">
                                    <tbody>
                                    <?php

                                    // load all customer transaction information
                                    if (!empty($customerTransactionObj)) {
                                        echo '<tr>
                                                <th>Date Added</th>
                                                <th>Description</th>
                                                <th style="text-align: center;">Amount</th>
                                            </tr>';
                                        $counter = 1;

                                        foreach ($customerTransactionObj as $customerTransaction) { ?>
                                            <tr>
                                                <td><?php echo $customerTransaction->getDateAdded(); ?></td>
                                                <td><?php echo $customerTransaction->getDescription(); ?></td>
                                                <td style="text-align: right;"><?php echo $curr_row['symbol_left'];?> <?php echo number_format(($customerTransaction->getAmount()*$curr_row['value']), 2, '.', ''); ?></td>
                                            </tr>
                                      <?php  }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            <?php
                            } else {
                                echo "<div class='alert alert-info' style='margin-bottom: 200px;'>There are no customer Transaction available now.</div>";
                            }
                            ?>
                            <?php  CustomerManager::showCustomerTransactionPagination($page, $sessUserId, ""); //pagination ?>
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