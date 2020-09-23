<?php
session_start();
require_once "../config.php";
require_once ROOT."functions/Connection.php";
require_once ROOT."classes/Zone.php";


$countryId   = intval($_POST['country_id']);

$zoneListArr = Zone::getZoneByCountryId($countryId); // get zone list by country id
$optionStr   = "<option value=''>Select Zone</option>";

if($zoneListArr){
    foreach($zoneListArr as $zoneList){
        $optionStr .= "<option value='".$zoneList->getZoneId()."'>".$zoneList->getName()."</option>";
    }
}

echo $optionStr;

?>