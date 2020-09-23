<?php
session_start();

// Load required files
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "functions/redirect.php";
require_once "CustomerManager.php";

$sessUserId = (isset($_SESSION['sess_user_id'])) ? $_SESSION['sess_user_id'] : 0;

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Password Change</title>
    <?php
    require_once "../include/common_header.php";

    $errorArr = array();
    $errorOccur = false;
    define('SALT', 'SD0796SDF87B890JK89RBMLEJIEW');
    if (count($_POST)) {
        //pr($_POST); die;
        $data = array();

        $data['customer_id'] = (isset($_SESSION['sess_user_id'])) ? $_SESSION['sess_user_id'] : 0;

        $data['password'] = stripform($_POST['password']);
        if (!$data['password']) {
            $errorArr['password'] = "Please enter the password";
            $errorOccur = true;
        }
        $data['confirm'] = stripform($_POST['confirm']);
        if (!$data['confirm']) {
            $errorArr['confirm'] = "Please enter the confirm password";
            $errorOccur = true;
        }

        if (!$data['confirm']) {
            $errorArr['confirm'] = "Please enter the confirm password";
            $errorOccur = true;
        }

        if ($data['confirm'] != $data['password']) {
            $errorArr['confirm'] = "Passwords doesn't match";
            $errorOccur = true;
        }

        $data['password'] = sha1($data['password'] . SALT); // make encrypted password
        if (!$errorOccur) {
            // Save customer and customerAddress
            $result = CustomerManager::saveCustomerPass($data);
            if ($result['success'] == 1) { // success
                redirectPage("index.php?s=6&change_status=1");
            } else { // error
                // handle error
                echo '<div class="alert alert-error" for="page">Can not save page information.</div>';
            }
        }

    }
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
                            <?php $breadcrumbArr = array("Home" => "../index.php?s=1&p=1", "My Account" => "index.php?s=5", "Password" => "#"); ?>
                            <?php include_once "../include/breadcrumb.php"; ?>
                        </div>
                        <!-- Page root content info -->
                        <div class="about-col-7">
                            <div class="page-title category-title">
                                <h1>Change Password</h1>
                            </div>
                            <!--  customer form goes here  -->
                            <div class="col-lg-9 no-padding col-left">
                                <form id="registration-form" name="registrationForm" method="post"
                                      action="frm_customer_password.php" class="form-horizontal" role="form"
                                      onsubmit="return validation();">
                                    <div class="col-lg-12 new-users">


                                        <div class="col-lg-12 new-users" style="margin-top: 20px;">
                                            <h4>Your Password</h4>


                                            <div class="form-group">
                                                <label class="col-sm-3 control-label " for="password">Password: <span
                                                        class="required">*</span></label>

                                                <div class="col-sm-8">
                                                    <input type="password" placeholder="Password" id="password"
                                                           name="password" class="form-control">
                                                    <?php echo($errorOccur && $errorArr['password'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['password'] . '</div>' : '') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label " for="ConfirmPassword">Password
                                                    Confirm: <span
                                                        class="required">*</span></label>

                                                <div class="col-sm-8 ">
                                                    <input type="password" name="confirm" id="confirm"  placeholder=" Confirm Password"
                                                           class="form-control">
                                                    <?php echo($errorOccur && $errorArr['confirm'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['confirm'] . '</div>' : '') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttons-set" style="margin-right: 10%;">
                                            <p class="required">* Required Fields</p>
                                            <button class="button" id="save_btn" title="Submit">
                                                <span><span>Change Password</span></span></button>
                                        </div>
                                    </div>
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
<script type="text/javascript">
    function validation() {
        if (document.getElementById('password').value == '') {
            alert('Please enter password');
            document.getElementById("password").focus();
            return false;
        }

        if (document.getElementById('confirm').value == '') {
            alert('Please enter confirm password');
            document.getElementById("confirm").focus();
            return false;
        }

        if (document.getElementById('confirm').value != document.getElementById('password').value) {
            alert('Confirm password doesn\'t match with password');
            document.getElementById('confirm').value = '';
            document.getElementById("confirm").focus();
            return false;
        }
    }
</script>