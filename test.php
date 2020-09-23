<?php
require_once "config.php";
require_once ROOT . "functions/Connection.php";
include "classes/Contactus.php";
//include "functions/Connection.php";

/*$objContactus = new Contactus();
$objContactus->setId(1);
$objContactus->setName("Tasfin Hasan");
$objContactus->setEmail("tasfin@divineit.net");
$objContactus->setPhone("0155656564");
$objContactus->setComment("testing ...");

pr($objContactus);*/
pr(Contactus::loadById(1));

?>