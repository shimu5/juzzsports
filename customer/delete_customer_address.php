<?php
session_start();

// Load required files
require_once "../config.php";
require_once ROOT."functions/Connection.php";
require_once ROOT."functions/redirect.php";
require_once "CustomerManager.php";

$sessUserId = (isset($_SESSION['sess_user_id'])) ? $_SESSION['sess_user_id'] : 0;
$addressId = (isset($_GET['address_id'])) ? intval($_GET['address_id']) : 0;

$result =  CustomerManager::deleteCustomerAddress($addressId);
//pr($result); die;
if($result)
    redirectPage("index.php?s=6&delete_status=1");
else
    redirectPage("index.php?s=6&delete_status=0");
?>