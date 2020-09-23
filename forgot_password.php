<?php
session_start();
require_once "config.php";
require_once ROOT."functions/Connection.php";
require_once ROOT."functions/functions.php";
include_once ROOT."functions/redirect.php";
require_once ROOT."classes/User.php";
include_once ROOT."classes/Currency.php";
require_once ROOT."settings.php";

define('SALT', 'SD0796SDF87B890JK89RBMLEJIEW');
$loginError = 0;


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
<?php include_once "include/swiper_root.php";?>
<?php include_once "include/top_bar_root.php";?>

<div class="header-container">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="header">
          <h1 class="logo"><a href="index.php" title="Juzz Sports"><img src="images/logo.png" alt=""/></a></h1>
          <div class="right_head">
            <?php include_once "include/header_cart.php";?>
            <?php include_once "include/header_search_root.php";?>
            <?php include_once "include/head_offer_root.php";?>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php include_once "include/top_menu_root.php";?>
<div class="main-container col1-layout">
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12">
            	<div class="main">
                    <?php $breadcrumbArr = array("Home" => "index.php?s=1&p=1", "Account" => "login.php", "Forgot Password" => "#"); ?>
                    <?php include_once "include/breadcrumb.php";?>
                    <?php
                        // Set page title and add category button
                        $titleArr = array('title' => "Sample Page");
                    ?>
                    <?php //include_once "include/pape_title.php";?>
                </div>
                 <div class="about-col-7">
                     <?php include_once 'customer/forgot_password.php';?>
                 </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "include/footer_offer.php";?>
<?php include_once "include/footer_root.php";?>
<?php include_once "include/copyright.php";?>
</div>
</div>
</body>
</html>
