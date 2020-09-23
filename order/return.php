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

if(!$isLogged){
    redirectPage("../login.php?url=order/index.php");
}

$errorArr   = array();
$errorOccur = false;
if(count($_POST)){
    $data = array();
    $data['firstname']          = stripform($_POST['firstname']);
    $data['lastname']           = stripform($_POST['lastname']);
    $data['email']              = stripform($_POST['email']);
    $data['telephone']          = stripform($_POST['telephone']);
    $data['order_id']           = stripform($_POST['order_id']);
    $data['product_id']         = stripform($_POST['product_id']);
    $data['customer_id']        = stripform($_POST['customer_id']);
    $data['date_added']         = stripform($_POST['date_added']);
    $data['product']            = stripform($_POST['product']);
    $data['model']              = stripform($_POST['model']);
    $data['quantity']           = stripform($_POST['quantity']);
    $data['opened']             = stripform($_POST['opened']);
    $data['return_reason_id']   = stripform($_POST['return_reason_id']);
    $data['comment']            = stripform($_POST['comment']);
    $data['return_status_id']   = 1;
    $data['date_ordered']       = date("Y-m-d", strtotime($_POST['date_ordered']));
    $data['date_added']         = date("Y-m-d");
    $data['date_modified']      = date("Y-m-d");

    if(!$data['firstname']){
        $errorArr['firstname'] = "Enter First Name";
        $errorOccur = true;
    }
    if(!$data['lastname']){
        $errorArr['lastname'] = "Enter Last Name";
        $errorOccur = true;
    }
    if(!$data['email']){
        $errorArr['email'] = "Enter E-mail";
        $errorOccur = true;
    }
    if(!$data['telephone']){
        $errorArr['telephone'] = "Enter Telephone";
        $errorOccur = true;
    }
    if(!$data['order_id']){
        $errorArr['order_id'] = "Enter Order Id";
        $errorOccur = true;
    }
    if(!$data['product']){
        $errorArr['product'] = "Enter Product Name";
        $errorOccur = true;
    }

    if(!$data['model']){
        $errorArr['model'] = "Enter Product Code";
        $errorOccur = true;
    }
    if(!$data['return_reason_id']){
        $errorArr['return_reason_id'] = "Select any return reason";
        $errorOccur = true;
    }

    if(!$errorOccur && $isExist == 0){
        $result = OrderManager::saveOrderReturn($data);
        if($result['success'] == 1){ // success
            redirectPage("order_details.php?type=view&return_status=1&order_id=".intval($_POST['order_id']));
        }
        else{ // error
            // handle error
            echo '<div class="alert alert-error" for="order return">Can not Order Return.</div>';
        }
    }
}

// get order return list
$orderId    = (isset($_GET['order_id'])) ? intval($_GET['order_id']) : 0;
$productId  = (isset($_GET['product_id'])) ? intval($_GET['product_id']) : 0;
$orderInfoArr = OrderManager::getReturnOrderInfo($sessUserId,$productId,$orderId);


// get Return Reason status
$returnReason = OrderManager::getReturnReasonStatus();
$returnReasonStatus = array();
foreach($returnReason as $reason){
    $returnReasonStatus[$reason['return_reason_id']] = $reason['name'];
}


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Return Order</title>
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
                            $titleArr = array('title' => "Order Return");
                            ?>
                            <?php include_once "../include/pape_title.php"; ?>
                        </div>
                        <!-- Page root content info -->
                        <div class="about-col-7" style="margin: 20px 0px 100px 0px;">
                            <?php include_once "order_return_frm.php"; ?>
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