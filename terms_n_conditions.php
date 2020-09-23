<?php
session_start();
require_once "config.php";
require_once ROOT . "functions/Connection.php";
require_once "settings.php";

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Home page</title>
    <?php
    require_once "config.php";
    require_once "include/common_header_root.php";
    ?>

</head>
<body class="ps-static  cms-index-index cms-home">
<div class="wrapper ps-static en-lang-class">
    <div class="page">
        <?php include_once "include/swiper_root.php"; ?>
        <?php include_once "include/top_bar_root.php"; ?>

        <div class="header-container">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="header">
                            <h1 class="logo"><a href="index.php?s=1&p=1" title="Juzz Sports"><img src="images/logo.png"
                                                                                                  alt=""/></a></h1>

                            <div class="right_head">
                                <?php include_once "include/header_cart.php"; ?>
                                <?php include_once "include/header_search_root.php"; ?>
                                <?php include_once "include/head_offer_root.php"; ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <?php include_once "include/top_menu_root.php"; ?>
        <div class="main-container col1-layout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="main">
                            <?php $breadcrumbArr = array("Home" => "./index.php?s=1&p=1", "Terms and Conditions" => "#"); ?>
                            <?php include_once "include/breadcrumb.php"; ?>
                            <?php
                            // Set page title and add category button
                            $titleArr = array('title' => "Terms and Conditions");
                            ?>

                        </div>
                        <div class="about-col-7">
                            <div class="account-login">
                                <div class="page-title">
                                    <h1>Terms and Conditions </h1>
                                </div>
                                <div style="margin-bottom: 200px;">
                                    This page, together with the documents referred to on it, tells you the terms and
                                    conditions (these Terms and Conditions) on which we supply any of the products (each
                                    a Product) listed on our website juzzsports.com (hereinafter referred to as ‘the
                                    Site’) to you. Please read these terms and conditions carefully before ordering any
                                    Products from the Site. You should understand that by ordering any of our Products,
                                    you agree to be bound by these terms and conditions. You should print a copy of
                                    these Terms and Conditions for future reference.
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once "include/footer_offer.php"; ?>
        <?php include_once "include/footer_root.php"; ?>
        <?php include_once "include/copyright.php"; ?>
    </div>
</div>
</body>
</html>
