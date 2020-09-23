<?php
session_start();
$ses_id = session_id();
//print_r($_SESSION[$ses_id]['currency_code']);
$_SESSION[$ses_id]['currency_code'] = $_POST['val'];
//print_r($_SESSION);
?>
