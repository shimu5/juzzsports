<?php
/*
 * Save cart will take cart data from session that user added
 * and will save in customer table cart filed before logout
 */
$sess_id = session_id();

$sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);
if($sessUserId){
    require_once ROOT . "functions/Connection.php";
    require_once ROOT."classes/Customer.php";
    Customer::saveCart($sessUserId, serialize($_SESSION[$sess_id]['Products']));
}


?>
