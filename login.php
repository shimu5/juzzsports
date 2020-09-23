<?php
session_start();
require_once "config.php";
require_once ROOT."functions/Connection.php";
require_once ROOT."functions/functions.php";
include_once ROOT."functions/redirect.php";
require_once ROOT."classes/Customer.php";
include_once ROOT."classes/Currency.php";
include_once ROOT."classes/Product.php";
include_once ROOT."classes/CustomerOnline.php";
require_once ROOT."settings.php";


define('SALT', 'SD0796SDF87B890JK89RBMLEJIEW');
$loginError = 0;

$returnUrl = (isset($_REQUEST['url']) ? $_REQUEST['url'] : "");

if(isset($_POST['username'])){
    $customerEmail  = stripform($_POST['username']);
    $password       = stripform($_POST['password']);
    //pr($_POST); die;
    if($customerEmail && $password){
        $successLogin = Customer::customerLogin($customerEmail, sha1($password.SALT)); // check login info are valid or not
        //pr($successLogin); die;

        if($successLogin){
            $customerInfo = Customer::loadByCustomerEmail($customerEmail); // get customer info
            //pr($customerInfo); die;

            // set session information
            $_SESSION['sess_user_id'] 	    = $customerInfo->getCustomerId();
            $_SESSION['sess_user_firstname']= $customerInfo->getFirstname();
            $_SESSION['sess_user_lastname'] = $customerInfo->getLastname();
            $_SESSION['sess_user_email']    = $customerInfo->getEmail();
            $_SESSION['sess_user_data']     = $customerInfo;

            CustomerOnline::deleteByCustomerId($customerInfo->getCustomerId()); // delete previous login data

            // save login information
            $objCustomerOnline = new CustomerOnline();
            $objCustomerOnline->setIp($_SERVER['REMOTE_ADDR']);
            $objCustomerOnline->setCustomerId($customerInfo->getCustomerId());
            $objCustomerOnline->setUrl($_SERVER['REQUEST_URI']);
            $objCustomerOnline->setReferer($_SERVER['HTTP_REFERER']);
            $objCustomerOnline->setDateAdded(date("Y-m-d H:i:s"));

            $result = $objCustomerOnline->save();
            // ==== Fetch Cart Product and save
            include_once ROOT.'carts/fetch_cart.php';

            // =========Wish list add ==========
            
            if($sessUserId){
                
                $wishListData = ( is_object($customerInfo) && $customerInfo->getWishlist() ? unserialize($customerInfo->getWishlist()) : "");
               
                $wishListNow = $_SESSION['wish_list']; // get current wish list
                
                $wishListArr = (!empty($wishListData)?$wishListData:array())+(!empty($wishListNow)?$wishListNow:array());// merge wish list with previous list
               
                Customer::saveWishList($customerInfo->getCustomerId(), serialize($wishListArr)); // save wish list in data base
            }
            // End add wishlist
            //pr("d");
            if($returnUrl)
                redirectPage($returnUrl);
            else
                redirectPage("customer/index.php?s=1&p=1&login_status=1");

        }
        else
            $loginError = 1; // 1 = invalid customer information
    }
    else
        $loginError = 2; // username or password set empty
}



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
                <?php
                if(isset($_GET['reg_status']) && intval($_GET['reg_status']) == 1){
                    echo "<div class='alert alert-success'>You have successfully created your account.</div>";
                }
                if(isset($_GET['chng_pass']) && intval($_GET['chng_pass']) == 1){
                    echo "<div class='alert alert-success'>You have successfully changed your password.</div>";
                }
                ?>
            	<div class="main">
                    <?php $breadcrumbArr = array("Home" => "index.php?s=1&p=1", "Login" => "#"); ?>
                    <?php include_once "include/breadcrumb.php";?>
                    <?php
                        // Set page title and add category button
                        $titleArr = array('title' => "Sample Page");                        
                    ?>
                    <?php //include_once "include/pape_title.php";?>                    
                </div>
                 <div class="about-col-7">
                     <div class="account-login">
                         <div class="page-title">
                             <h1>Login or Create an Account</h1>
                         </div>
                         <form id="login-form" method="post" action="login.php">
                             <input type="hidden" name="url" value="<?php echo $returnUrl;?>" />
                             <div class="col2-set">
                                 <div class="wrapper">
                                     <div class="registered-users-wrapper">
                                         <div class="col-2 registered-users">
                                             <div class="content">
                                                 <h2>Registered Customers</h2>
                                                <?php
                                                if(isset($_SESSION['sess_user_id']) && $_SESSION['sess_user_id']){
                                                    echo "<div class='alert'>You are logged in now.</div>";
                                                }
                                                else{
                                                ?>
                                                 <p>If you have an account with us, please log in.</p>
                                                 <?php
                                                 if($loginError == 1 ){
                                                     echo "<div class='alert alert-error'>Email and/or Password is invalid.</div>";
                                                 }
                                                 else if($loginError == 2 ){
                                                     echo "<div class='alert alert-error'>Please enter Email/ Password.</div>";
                                                 }

                                                 ?>
                                                 <ul class="form-list">
                                                     <li>
                                                         <label class="required" for="email"><em>*</em>Email Address</label>

                                                         <div class="input-box">
                                                             <input type="email" title="Email Address"
                                                                    class="input-text required-entry validate-email form-control" id="email"
                                                                    value="" name="username">
                                                         </div>
                                                     </li>
                                                     <li>
                                                         <label class="required" for="pass"><em>*</em>Password</label>

                                                         <div class="input-box">
                                                             <input type="password" title="Password" id="pass"
                                                                    class="input-text required-entry validate-password form-control"
                                                                    name="password">
                                                         </div>
                                                     </li>
                                                 </ul>
                                                 <p class="required">* Required Fields</p>

                                                 <div class="buttons-set">
                                                     <a class="f-left"
                                                        href="forgot_password.php">Forgot Your Password?</a>
                                                     <button id="send2" name="send" title="Login" class="button" type="submit"><span><span>Login</span></span>
                                                     </button>                                                     
                                                 </div>
                                                 <?php
                                                }
                                                 ?>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="new-users-wrapper">
                                         <div class="col-1 new-users">
                                             <div class="content">
                                                 <h2>New Customers</h2>
                                                 <?php
                                                 if(isset($_SESSION['sess_user_id']) && $_SESSION['sess_user_id']){
                                                     echo "<div class='alert'>You are logged in now. You can visit your profile.</div>";
                                                 }
                                                 else{
                                                     ?>

                                                 <p>By creating an account with our store, you will be able to move through the checkout
                                                     process faster, store multiple shipping addresses, view and track your orders in your
                                                     account and more.</p>

                                                 <div class="buttons-set">
                                                     <a href="registration.php"><button
                                                             class="button" title="Create an Account" type="button">
                                                             <span><span>Create an Account</span></span></button></a>
                                                 </div>
                                                 <?php
                                                 }
                                                 ?>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </form>
                     </div>
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
