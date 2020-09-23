<?php
session_start();

require_once "config.php";
include_once ROOT."functions/redirect.php";

session_unset();
session_destroy();

redirectPage("index.php?s=1&p=1");
?>