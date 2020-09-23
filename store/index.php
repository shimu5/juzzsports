<?php
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Home page</title>
<?php
// Load required files
require_once "../config.php";
require_once "../include/common_header.php";
require_once ROOT."admin/store/StoreManager.php";

?>

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
<div class="main-container col1-layout">
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12">
            	<div class="main">
                    <!-- Dynamically set Breadcrumb info -->
                    <?php $breadcrumbArr = array("Home" => "../index.php?s=1&p=1", "Store" => "index.php?s=5","Store Imformation" => "#"); ?>
                    <?php include_once "../include/breadcrumb.php";?>
                    <?php
                        // Dynamically Set page title and add category button
                        $titleArr = array('title' => 'Store Imformation');
                    ?>
                    <?php include_once "../include/pape_title.php";?>
                </div>
                    <!-- Page root content info -->
                 <div class="about-col-7">
                    <?php include_once "store_list.php";?>
                 </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "../include/footer_offer.php";?>
<?php include_once "../include/footer.php";?>
<?php include_once "../include/copyright.php";?>
</div>
</div>
</body>
</html>
