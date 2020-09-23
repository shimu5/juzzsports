<?php
session_start();

require_once "config.php"; // load configuration data
require_once ROOT . "functions/Connection.php"; // database manager
include ROOT ."settings.php"; // load basic setting
include ROOT ."classes/HomePageSetting.php"; // home page setting
include ROOT ."classes/Product.php"; // load product class
//require_once ROOT ."phpmailer/Mailer.php";
?>

<?php //$mailObj = new Mailer();  $result = $mailObj->MailSend();  ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Home page</title>
<?php require_once "include/common_header_root.php"; // load common header files?>
</head>
<body class="ps-static  cms-index-index cms-home">
<div class="wrapper ps-static en-lang-class">
<div class="page">
<?php include_once "include/swiper_root.php"; // mobile view menu?>
<?php include_once "include/top_bar_root.php"; // load top bar section?>
<div class="header-container">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="header">
          <h1 class="logo"><a href="index.php?s=1&p=1" title="Juzz Sports"><img src="images/logo.png" alt=""/></a></h1>
          <div class="right_head">            
            <?php include_once "include/header_cart.php"; // load no of product added tp cart section?>
            <?php include_once "include/header_search_root.php"; // common search section in header?>
            <?php include_once "include/head_offer_root.php"; // no of wish list information section in header?>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php include_once "include/top_menu_root.php"; // load top menu?>
<div class="main-container col1-layout">
<div class="container">
<div class="row">
    <div class="col-xs-12">
        <div class="main">
            <div class="col-main_index">
                <div class="padding-s">
                    <?php
                    // display login status message
                    if(isset($_GET['login_status']) && intval($_GET['login_status']) == 1){ // login status message print
                        echo "<div class='alert alert-success'>You have logged in successfully</div>";
                    }
                    ?>
                <?php include_once "include/slider.php"; // home page image slide?>
                <?php include_once "include/offer.php"; // 3 parts feature section?>
                <?php include_once "product_list.php"; // display list of products?>
                <?php include_once "service_panel.php"; // hot line or help section?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php include_once "include/footer_offer.php"; // offer message in footer bar?>
<?php include_once "include/footer_root.php"; // footer links parts?>
<?php include_once "include/copyright.php"; // copy right section?>
</div>
</div>
</body>
</html>
