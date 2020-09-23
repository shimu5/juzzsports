<?php

require_once "../config.php";
require_once ROOT."functions/Connection.php";
require_once ROOT."functions/functions.php";
require_once ROOT."class/Zone.php";

//$zoneObj = new Zone();

$zones = Zone::load();
pr($zones);
die;
?>