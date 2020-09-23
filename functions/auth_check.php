<?php
session_start();

require_once "config.php";
include_once ROOT."functions/redirect.php";

if(!isset($_SESSION['sess_user_id']))
	redirectPage("/login.php");

?>