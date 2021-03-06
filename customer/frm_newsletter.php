<?php
session_start();

// Load required files
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "functions/redirect.php";
require_once "CustomerManager.php";

if(!isset($_SESSION['sess_user_id'])){ // authentication check
    redirectPage("../login.php?url=customer/frm_newsletter.php"); die;
}

$sessUserId = (isset($_SESSION['sess_user_id'])) ? $_SESSION['sess_user_id'] : 0;

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Newsletter Subscription</title>
    <?php
    require_once "../include/common_header.php";

    $errorArr = array();
    $errorOccur = false;

    if (count($_POST)) {
        $data = array();

        $data['customer_id'] = (isset($_SESSION['sess_user_id'])) ? $_SESSION['sess_user_id'] : 0;

        $data['newsletter'] = intval($_POST['newsletter']);
        if (!$data['newsletter']) {
            $errorArr['newsletter'] = "Please select a newsletter subcribe option";
            $errorOccur = true;
        }

        $data['newsletter'] = ($data['newsletter'] == 2 ? 0 : 1);
        if (!$errorOccur) {
            // Save newsletter option
            $result = CustomerManager::saveNewsletter($data);
            if ($result['success'] == 1) { // success
                redirectPage("index.php?s=6&change_status=1");
            } else { // error
                // handle error
                echo '<div class="alert alert-error" for="page">Can not save page information.</div>';
            }
        }

    }
    
    $customerObj = CustomerManager::getCustomerById($sessUserId);
    $newsletterValue = ($customerObj ? $customerObj->getNewsletter() : 0);
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
                            <h1 class="logo"><a href="../index.php?s=1&p=1" title="Juzz Sports"><img src="../images/logo.png" alt=""/></a>
                            </h1>

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
                            <?php $breadcrumbArr = array("Home" => "../index.php?s=1&p=1", "Profile" => "index.php?s=5", "Newsletter Subscription" => "#"); ?>
                            <?php include_once "../include/breadcrumb.php"; ?>
                        </div>
                        <!-- Page root content info -->
                        <div class="about-col-7">
                            <div class="page-title category-title">
                                <h1>Newsletter Subscription</h1>
                            </div>
                            <!--  customer form goes here  -->
                            <div class="col-lg-9 no-padding col-left">
                                <form id="registration-form" name="registrationForm" method="post"
                                      action="frm_newsletter.php" class="form-horizontal" role="form"
                                      onsubmit="return validation();">
                                    <div class="col-lg-12 new-users">


                                        <div class="col-lg-12 new-users" style="margin-top: 20px;">
                                            <h4>Do You want to subscribe newsletter ?</h4>

                                            <div class="form-group" >
                                                <div class="col-sm-2">
                                                    <input <?php echo ''; ?> style=" width: 30px; float: left; margin-left: 40px; margin-top: -5px" type="radio" id="newsletterYes" value="1" name="newsletter" <?php echo ($newsletterValue == 1 ? "checked='checked'" : "");?> class="form-control"><span>Yes</span>
                                                </div>
                                            <div class="col-sm-2">
                                                    <input style=" width: 30px; float: left; margin-left: 40px; margin-top: -5px" type="radio" id="newsletterNo" value="2" name="newsletter" class="form-control" <?php echo ($newsletterValue == 0 ? "checked='checked'" : "");?> > No
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttons-set" style="margin-right: 70%;">
                                            <button class="button" id="save_btn" title="Submit">
                                                <span><span>Change Subscription Option</span></span></button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div style="height:300px"></div>
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