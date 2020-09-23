<?php
session_start();
require_once "../config.php";
include_once ROOT."functions/redirect.php";
require_once ROOT."customer/CustomerManager.php";

$sessUserId = (isset($_SESSION['sess_user_id'])) ? $_SESSION['sess_user_id'] : 0;

if(!isset($_SESSION['sess_user_id'])){ // authentication check
    redirectPage("../login.php"); die;
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Customer Address</title>
<?php
// Load required files
require_once "../include/common_header.php";


?>

<?php 
// get customer information
$customerAddressArr = CustomerManager::getCustomerAddressByCustomerId($sessUserId);
//pr($customerAddressArr); die;
//die();
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
                        echo "<div class='alert alert-success'>Information has changed successfully</div>";
                    }
                    ?>
                    <!-- Dynamically set Breadcrumb info -->
                    <?php $breadcrumbArr = array("Home" => "../index.php?s=1&p=1", "My Account" => "index.php?s=6","Address" => "#"); ?>
                    <?php include_once "../include/breadcrumb.php";?>
                    <?php
                        // Dynamically Set page title and add category button
                        $titleArr = array('title' => 'Customer Address');
                    ?>
                    <?php include_once "../include/pape_title.php";?>
                </div>
                    <!-- Page root content info -->
                 <div class="about-col-7">
                     <div style="margin-top: 20px;"></div>
                     <div class="about-padd">
                         <div class="wrapper">
                             <?php
                             if($customerAddressArr){

                                 $counter = 1;
                                 $customerAddressStr = "";
                                 foreach ($customerAddressArr as $customerAddress){
                                     if($counter % 3 == 0){
                                         $customerAddressStr .= '<div class="about-padd">';
                                         $customerAddressStr .= '<div class="wrapper">';
                                     }
                                     if($counter % 3 == 1){
                                         $customerAddressStr .= '<div class="about-col-1">';
                                         $customerAddressStr .= '<h3>'.$customerAddress['firstname'].' '.$customerAddress['lastname'].'</h3>';
                                         $customerAddressStr .= '<p>'.($customerAddress['company'] ? $customerAddress['company'] : "&nbsp;").'</p>';
                                         $customerAddressStr .= '<p>'.($customerAddress['address_1'] ? $customerAddress['address_1'] : "&nbsp;").'</p>';
                                         $customerAddressStr .= '<p>'.$customerAddress['address_2'].'</p>';
                                         $customerAddressStr .= '<p>'.($customerAddress['city'] ? $customerAddress['city'] : "&nbsp;").'</p>';
                                         $customerAddressStr .= '<p>'.($customerAddress['country_name'] ? $customerAddress['country_name'] : "&nbsp;")." - ";
                                         $customerAddressStr .= $customerAddress['postcode'].'</p>';

                                         $customerAddressStr .= '<p>&nbsp;</p>';
                                         $customerAddressStr .= '<span><a class="btn btn-success" href="index.php?type=change&address_id='.$customerAddress['address_id'].'">Change</a> </span> &nbsp; &nbsp;';
                                         $customerAddressStr .= '<span><a onclick="return confirm(\'Do you want to delete this address?\');" class="btn" href="index.php?type=delete&address_id='.$customerAddress['address_id'].'">Delete</a> </span>';
                                         $customerAddressStr .= '</div>';
                                     }
                                     else if($counter % 3 == 2){
                                         $customerAddressStr .= '<div class="about-col-2">';
                                         $customerAddressStr .= '<h3>'.$customerAddress['firstname'].' '.$customerAddress['lastname'].'</h3>';
                                         $customerAddressStr .= '<p>'.($customerAddress['company'] ? $customerAddress['company'] : "&nbsp;").'</p>';
                                         $customerAddressStr .= '<p>'.($customerAddress['address_1'] ? $customerAddress['address_1'] : "&nbsp;").'</p>';
                                         $customerAddressStr .= '<p>'.$customerAddress['address_2'].'</p>';
                                         $customerAddressStr .= '<p>'.($customerAddress['city'] ? $customerAddress['city'] : "&nbsp;").'</p>';
                                         $customerAddressStr .= '<p>'.($customerAddress['country_name'] ? $customerAddress['country_name'] : "&nbsp;")." - ";
                                         $customerAddressStr .= $customerAddress['postcode'].'</p>';

                                         $customerAddressStr .= '<p>&nbsp;</p>';
                                         $customerAddressStr .= '<span><a class="btn btn-success" href="index.php?type=change&address_id='.$customerAddress['address_id'].'">Change</a> </span> &nbsp; &nbsp;';
                                         $customerAddressStr .= '<span><a onclick="return confirm(\'Do you want to delete this address?\');" class="btn" href="index.php?type=delete&address_id='.$customerAddress['address_id'].'">Delete</a> </span>';
                                         $customerAddressStr .= '</div>';
                                     }
                                     else if($counter % 3 == 0){
                                         $customerAddressStr .= '<div class="about-col-3">';
                                         $customerAddressStr .= '<h3>'.$customerAddress['firstname'].' '.$customerAddress['lastname'].'</h3>';
                                         $customerAddressStr .= '<p>'.($customerAddress['company'] ? $customerAddress['company'] : "&nbsp;").'</p>';
                                         $customerAddressStr .= '<p>'.($customerAddress['address_1'] ? $customerAddress['address_1'] : "&nbsp;").'</p>';
                                         $customerAddressStr .= '<p>'.$customerAddress['address_2'].'</p>';
                                         $customerAddressStr .= '<p>'.($customerAddress['city'] ? $customerAddress['city'] : "&nbsp;").'</p>';
                                         $customerAddressStr .= '<p>'.($customerAddress['country_name'] ? $customerAddress['country_name'] : "&nbsp;")." - ";
                                         $customerAddressStr .= $customerAddress['postcode'].'</p>';

                                         $customerAddressStr .= '<p>&nbsp;</p>';
                                         $customerAddressStr .= '<span><a class="btn btn-success" href="index.php?type=change&address_id='.$customerAddress['address_id'].'">Change</a> </span> &nbsp; &nbsp;';
                                         $customerAddressStr .= '<span><a onclick="return confirm(\'Do you want to delete this address?\');" class="btn" href="index.php?type=delete&address_id='.$customerAddress['address_id'].'">Delete</a> </span>';
                                         $customerAddressStr .= '</div>';
                                     }  
                                     
                                     if($counter % 3 == 0){
                                         $customerAddressStr .= '</div>';
                                         $customerAddressStr .= '</div>';

                                         $customerAddressStr .= '<div class="clear" style="margin-bottom: 0px;"></div>';

                                     }
                                     $counter++;
                                 }
                                 echo $customerAddressStr;
                             }
                             else{
                                 echo "<div class='alert alert-info' style='margin-bottom: 100px;'>There are no address available now.</div>";
                             }
                             ?>                             
                         </div>
                     </div>
                     <div class="clear" style="margin-bottom: 10px;"></div>
                    <?php //include_once "frm_customer_address.php";?>
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
