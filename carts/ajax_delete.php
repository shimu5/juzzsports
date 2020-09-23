<?php
// Load required files
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "Settings.php";
require_once ROOT . "classes/Product.php";

session_start();
$ses_id = session_id();
unset($_SESSION[$ses_id]['Products'][$_POST['product_id']]);
$sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);
if($sessUserId){
      Customer::saveCart($sessUserId, serialize($_SESSION[$ses_id]['Products']));
}
if(!isset($_POST['page']))
 require_once 'ajax_common.php';
 ?>