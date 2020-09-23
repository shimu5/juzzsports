<?php
session_start();
require_once "../config.php";
include_once ROOT."functions/redirect.php";

if(!isset($_SESSION['sess_user_id'])){ // authentication check
    redirectPage("../login.php"); die;
}

$sessUserId = (isset($_SESSION['sess_user_id'])) ? $_SESSION['sess_user_id'] : 0;

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Customer Profile Page</title>
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
                    <?php
                    if(isset($_GET['login_status']) && intval($_GET['login_status']) == 1){ // login status message print
                        echo "<div class='alert alert-success'>You have logged in successfully</div>";
                    }
                    if(isset($_GET['change_status']) && intval($_GET['change_status']) == 1){ // change status message print
                        echo "<div class='alert alert-success'>Information has been changed successfully</div>";
                    }

                    if(isset($_GET['delete_status']) && intval($_GET['delete_status']) == 1){ // delete status message print
                        echo "<div class='alert alert-success'>Information has been deleted successfully</div>";
                    }
                    else if(isset($_GET['delete_status']) && intval($_GET['delete_status']) == 0){ // delete fail status message print
                        echo "<div class='alert alert-success'>Information can not delete successfully</div>";
                    }
                    
                    if(isset($_GET['checkout_status']) && intval($_GET['checkout_status']) == 1){ // change status message print
                        echo "<div class='alert alert-success'>Your order has been successfully submitted.</div>";
                    }

                    ?>
                    <!-- Dynamically set Breadcrumb info -->
                    <?php $breadcrumbArr = array("Home" => "../index.php?s=1&p=1", "My Account" => "index.php?s=6","Profile" => "#"); ?>
                    <?php include_once "../include/breadcrumb.php";?>
                    <?php
                        // Dynamically Set page title and add category button
                        $titleArr = array('title' => 'Welcome to JuzzSports');
                    ?>
                    <?php if(intval($_GET['type']) != 'change' && intval($_GET['type']) != 'delete') include_once "../include/pape_title.php";?>
                </div>
                    <!-- Page root content info -->
                 <div class="about-col-7">
                    <?php
                    if($_GET['type'] == 'change'){ // customer address change form
                        include_once "frm_customer_address.php";
                    }
                    else if($_GET['type'] == 'delete'){ // customer address delete form
                        include_once "delete_customer_address.php";
                    }
                    else
                        include_once "profile.php"; // customer profile page
                    ?>
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
