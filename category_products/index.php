<?php
session_start();
require_once "../config.php";
require_once ROOT ."functions/Connection.php";
require_once ROOT ."settings.php";

$path       = $_GET['path'];
$pathArr    = explode("_", $path);

$categoryId = intval($_GET['category_id']);

// filter manage
$getPrice           = isset($_GET['price']) ? trim($_GET['price']) : "";
$getManufacturerId  = isset($_GET['manufacture_id']) && intval($_GET['manufacture_id']) ? $_GET['manufacture_id'] : 0;

$isRemoveManufacturer   = isset($_GET['remove_manufacture']) && intval($_GET['remove_manufacture']) ? $_GET['remove_manufacture'] : 0;
$isRemovePrice          = isset($_GET['remove_price']) && intval($_GET['remove_price']) ? $_GET['remove_price'] : 0;

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Category wise product list</title>
    <?php
    require_once "../config.php";   // load configuration page
    require_once "../include/common_header.php"; // include header section. e.g: css and js
    ?>
</head>
<body class="ps-static  cms-index-index cms-home">
<div class="wrapper ps-static en-lang-class">
<div class="page">
<?php include_once "../include/swiper.php"; // only for mobile menu ?>
<?php include_once "../include/top_bar.php"; // include top bar; e.g: login, currency and country ?>
<div class="header-container">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="header">
          <h1 class="logo"><a href="../index.php" title="Juzz Sports"><img src="../images/logo.png" alt=""/></a></h1>
          <div class="right_head">
            <?php include_once "../include/header_cart.php"; // in header section, load cart part. ?>
            <?php include_once "../include/header_search.php"; // in header section, load search part. ?>
            <?php include_once "../include/head_offer.php"; // in header section, load offer/ ads part ?>
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
                    <?php $breadcrumbArr = array("Home" => "../index.php?s=1&p=1", "Shop" => "#"); ?>
                    <?php include_once "../include/breadcrumb.php";?>
                    <div class="row">
                        <div class="col-main-pro col-xs-12 col-sm-9">
                            <div class="padding-s">
                            <?php
                            include_once "product_list_categorywise.php";
                            ?>
                            </div>
                        </div>
                        <?php include_once "right_panel.php";?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-------------------------------------End of Mid Content------------------------------------>
<?php include_once "../include/footer_offer.php"; // bottom offer, helpline section. ?>
<?php include_once "../include/footer.php"; // footer part ?>
<?php include_once "../include/copyright.php"; // copy right section. ?>
</div>
</div>
</body>
</html>
