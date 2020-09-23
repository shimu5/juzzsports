<?php
	error_reporting(0);
	
	$host 	 = "localhost"; // db host
	$db_user = "root"; // db username
	$db_pass = ""; // db password 
	$db 	 = "juzzsports_tashfin"; // db name
	
	$link = @mysql_connect($host,$db_user,$db_pass);	
	if(!$link)
		die("Can't connect!!");
	$var2 = @mysql_select_db($db,$link);
	if(!$var2)
		die("<br>"."can't select dataBase");
?>