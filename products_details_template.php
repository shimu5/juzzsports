<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Product List by Category</title>
    <?php
    require_once "config.php";
    //die(ROOT);
    require_once ROOT."include/common_header_root.php";
    ?>
    <script type="text/javascript" src="js/cloud-zoom.1.0.2.js"></script>
    <script type="text/javascript" src="js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="js/klass.min.js"></script>
    <script type="text/javascript" src="js/code.photoswipe.jquery-3.0.5.js"></script>
    <script src="js/dw_paus_scroller.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/cloud-zoom.css" media="all" />
</head>
<body class="ps-static  cms-index-index cms-home">
<div class="wrapper ps-static en-lang-class">
<div class="page">
<?php include_once "include/swiper_root.php";?>
<?php include_once "include/top_bar_root.php";?>
<div class="header-container">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="header">
          <h1 class="logo"><a href="#" title="Juzz Sports"><img src="images/logo.png" alt=""/></a></h1>
          <div class="right_head">
            <?php include_once "include/header_cart.php";?>
            <?php include_once "include/header_search_root.php";?>
            <?php include_once "include/head_offer.php";?>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php include_once "include/top_menu_root.php";?>
<!-------------------------------------Start of Mid Content---------------------------------->
<div class="main-container col2-right-layout">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="main">
                <!-- Dynamically set Breadcrumb info -->
                    <?php $breadcrumbArr = array("Home" => "index.php?s=1&p=1", "Store" => "index.php?s=5","Store Imformation" => "#"); ?>
                    <?php include_once "include/breadcrumb.php";?>
                    <div class="row">
                        <div class="col-main-pro col-xs-12 col-sm-9">
                            <div class="padding-s">
                            <?php include_once "products_details_sample.php";?>
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
<?php include_once "include/footer_offer.php";?>
<?php include_once "include/footer_root.php";?>
<?php include_once "include/copyright.php";?>
</div>
</div>
</body>
</html>
