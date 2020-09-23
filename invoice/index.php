<?php
session_start();
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "functions/redirect.php";
require_once ROOT ."settings.php";
require_once ROOT ."classes/Product.php";
//require_once "CheckoutManager.php";


$sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);
$isLogged   = $sessUserId;

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cart Checkout</title>
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
                    <?php $breadcrumbArr = array("Home" => "../index.php?s=1&p=1", "Shopping Cart" => "../cart_information.php?s=5","Invoice" => "#"); ?>
                    <?php include_once "../include/breadcrumb.php";?>
                    <!--<iframe name="" src="<?php echo BASE_URL ?>invoice/invoice_detail.php?order_id=<?php echo $_GET['order_id']?>"> -->
                    <?php include_once "invoice_detail.php";?>
                   <!-- </iframe>-->
                   
                </div>
            </div>
        </div>
    </div>
</div>

<!-------------------------------------End of Mid Content------------------------------------>
<?php //include_once "../include/footer_offer.php";?>
<?php include_once "../include/footer.php";?>
<?php include_once "../include/copyright.php";?>
</div>
</div>
</body>
</html>
