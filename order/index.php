<?php
session_start();
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "functions/Session.php";
include_once ROOT . "functions/redirect.php";
require_once ROOT . "settings.php";
require_once "OrderManager.php";

$sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);
$isLogged   = $sessUserId;


// pagination script
$page        = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
$limit       = OrderManager::getPageLimit(); // No. of page try to display
$start       = $page ? ($page - 1) * $limit : 0; //first item to display on this page


if(!$isLogged){
    redirectPage("../login.php?url=order/index.php");
}

$customerOrderListObj = OrderManager::getCustomerOrderList($sessUserId,$start, $limit); // get customer order list

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Transaction List</title>
    <?php
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
                            <?php $breadcrumbArr = array("Home" => "../index.php?s=1&p=1", "Profile" => "../customer/index.php?s=2&p=1", "Order List" => "#"); ?>
                            <?php include_once "../include/breadcrumb.php"; ?>
                            <?php
                            // Dynamically Set page title
                            $titleArr = array('title' => "Order List");
                            ?>
                            <?php include_once "../include/pape_title.php"; ?>
                        </div>
                        <!-- Page root content info -->
                        <div class="about-col-7" style="margin: 20px 0px 100px 0px;">
                            <?php include_once "order_list.php"; ?>
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