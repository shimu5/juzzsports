<?php
session_start();
require_once "../config.php";
include_once ROOT."functions/redirect.php";

if(!isset($_SESSION['sess_user_id'])){ // authentication check
    redirectPage("../login.php"); die;
}
?>
<div style="margin-top: 20px;"></div>
<div class="about-padd">
    <div class="wrapper">
        <div class="about-col-1" style="height: 40%">
            <h3>My Account</h3>
            <p><a href="frm_customer_info.php">Edit your account information</a></p>
            <p><a href="frm_customer_password.php">Change your password</a></p>
            <p><a href="customer_address.php">Modify your address book entries</a></p>
            <p><a href="customer_wishlist.php">Modify your wish list</a></p>
            <p>&nbsp;</p>
            <span></span>
        </div>
        <div class="about-col-2">
            <h3>My Orders</h3>
            <p><a href="../order/index.php">View your order history</a></p>
            <p><a href="reward.php">Your Reward Points</a></p>
            <p><a href="../return/index.php">View your return requests</a></p>
            <p><a href="transaction_list.php">Your Transactions</a></p>
            <p>&nbsp;</p>

            <span></span>
        </div>
        <div class="about-col-3">
            <h3>Newsletter</h3>
            <p><a href="frm_newsletter.php">Subscribe / unsubscribe to newsletter</a></p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <span></span>
        </div>
    </div>
</div>
<div class="clear" style="margin-bottom: 0px;"></div>
