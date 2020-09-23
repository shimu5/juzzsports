<?php
session_start();

// Load required files
require_once "../config.php";
require_once ROOT."functions/Connection.php";
require_once ROOT."functions/redirect.php";
require_once "CustomerManager.php";

$sessUserId = (isset($_SESSION['sess_user_id'])) ? $_SESSION['sess_user_id'] : 0;

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Customer Information Change</title>
    <?php
    require_once "../include/common_header.php";
    $errorArr = array();
    $errorOccur = false;
    if (count($_POST)) {

        $data = array();

        $data['customer_id'] = $sessUserId;

        $data['firstname'] = stripform($_POST['firstname']);
        if (!$data['firstname']) {
            $errorArr['firstname'] = "Enter first name";
            $errorOccur = true;
        }
        $data['lastname'] = stripform($_POST['lastname']);
        if (!$data['lastname']) {
            $errorArr['lastname'] = "Enter last name";
            $errorOccur = true;
        }
        $data['email'] = stripform($_POST['email1']);
        if (!$data['email']) {
            $errorArr['email'] = "Enter email";
            $errorOccur = true;
        }
        if ($data['email'] && CustomerManager::isEmailExist($data['email'], $sessUserId) ) {
            $errorArr['email'] = "Email already exist";
            $errorOccur = true;
        }
        $data['telephone'] = stripform($_POST['telephone']);
        if (!$data['telephone']) {
            $errorArr['telephone'] = "Enter telephone";
            $errorOccur = true;
        }
        $data['fax'] = stripform($_POST['fax']);
        //pr($errorArr); die;
        if (!$errorOccur) {
            // Save customer and customerAddress
            $result = CustomerManager::saveCustomerInfo($data);

            if ($result['success'] == 1) { // success
                redirectPage("index.php?s=6&change_status=1");
            } else { // error
                // handle error
                echo '<div class="alert alert-error" for="page">Can not save page information.</div>';
            }
        }

    }

    $customerInfoObj = CustomerManager::getCustomerById($sessUserId);

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
                            <h1 class="logo"><a href="../index.php" title="Juzz Sports"><img src="../images/logo.png" alt=""/></a>
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
                            <?php $breadcrumbArr = array("Home" => "../index.php?s=1&p=1", "Account" => "index.php?s=6", "Customer Information" => "#"); ?>
                            <?php include_once "../include/breadcrumb.php"; ?>
                        </div>
                        <!-- Page root content info -->
                        <div class="about-col-7">
                            <div class="page-title category-title">
                                <h1>My Account Information</h1>
                            </div>
                            <?php //include_once "store_list.php";?>
                            <!--  customer form goes here  -->
                            <div class="col-lg-9 no-padding col-left">
                                <form id="registration-form" name="registrationForm" method="post"
                                      action="frm_customer_info.php" class="form-horizontal" role="form"
                                      onsubmit="return validation();">
                                    <div class="col-lg-12 new-users">
                                        <h4>Your Personal Details</h4>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="firstname">First Name: <span
                                                    class="required">*</span></label>

                                            <div class="col-sm-8">
                                                <input type="text" name="firstname" id="firstname" value="<?php echo ($customerInfoObj ? $customerInfoObj->getFirstname() : "");?>" class="form-control">
                                                <?php echo($errorOccur && $errorArr['firstname'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['firstname'] . '</div>' : '') ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label " for="lastname">Last Name: <span
                                                    class="required">*</span></label>

                                            <div class="col-sm-8">
                                                <input type="text" name="lastname" id="lastname" value="<?php echo ($customerInfoObj ? $customerInfoObj->getLastname() : "");?>" class="form-control">
                                                <?php echo($errorOccur && $errorArr['lastname'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['lastname'] . '</div>' : '') ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label " for="email1">Email: <span
                                                    class="required">*</span></label>

                                            <div class="col-sm-8">
                                                <input type="text" name="email1" id="email1" value="<?php echo ($customerInfoObj ? $customerInfoObj->getEmail() : "");?>" class="form-control">
                                                <?php echo($errorOccur && $errorArr['email1'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['lastname'] . '</div>' : '') ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label " for="Telephone">Telephone: <span
                                                    class="required">*</span></label>

                                            <div class="col-sm-8">
                                                <input type="text" name="telephone" id="telephone" value="<?php echo ($customerInfoObj ? $customerInfoObj->getTelephone() : "");?>" class="form-control">
                                                <?php echo($errorOccur && $errorArr['telephone'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['telephone'] . '</div>' : '') ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="Fax">Fax: </label>

                                            <div class="col-sm-8">
                                                <input type="text" name="fax" id="fax" value="<?php echo ($customerInfoObj ? $customerInfoObj->getFax() : "");?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="buttons-set">
                                            <p class="required">* Required Fields</p>
                                            <button class="button" id="save_btn" title="Submit">
                                                <span><span>Submit</span></span></button>
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

    /**
     * Ref:: http://stackoverflow.com/questions/46155/validate-email-address-in-javascript
     *
     * @param email
     * @returns {boolean}
     */
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    // Form Validation
    function validation() {


        if (document.getElementById('firstname').value == '') {
            alert('Please enter first name');
            document.getElementById("firstname").focus();
            return false;
        }
        else if (document.getElementById('lastname').value == '') {
            alert('Please enter last name');
            document.getElementById("lastname").focus();
            return false;
        }
        else if (document.getElementById('email1').value == '') {
            alert('Please enter email');
            document.getElementById("email1").focus();
            return false;
        }
        else if (document.getElementById('telephone').value == '') {
            alert('Please enter telephone');
            document.getElementById("telephone").focus();
            return false;
        }

        if (document.getElementById('email1').value != '') {
            if (!validateEmail(document.getElementById('email1').value)) {
                alert('Please enter a right email address');
                document.getElementById('email1').focus();
                return false;
            }
        }

        return true;
    }

</script>