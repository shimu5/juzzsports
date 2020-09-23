<?php

//die("dds");
require_once "config.php";
include_once ROOT."classes/Currency.php";
include_once ROOT."classes/Setting.php";

/* Default settings of website from Seetings table
 * eg DEFAULT_CURRENCY define as constant
 * Example : define(DEFAULT_CURRENCY,'SGD');
 *
 */

$setting_rows = Setting::loadRows();
foreach($setting_rows as $sett){
    if(!defined($sett['key']))
        define($sett['key'],$sett['value']);
}


/*  if cookie unset then check for default currency code and set it as cookie
 *  if cookie set then fetch full row of that code and set values of currency
 */

$ses_id = session_id();

if(!isset($_SESSION[$ses_id]['currency_code'])){
    $curcode = DEFAULT_CURRENCY;
    $_SESSION[$ses_id]['currency_code'] = DEFAULT_CURRENCY;
}
else{
   $curcode = $_SESSION[$ses_id]['currency_code'];
}
 $curr_row = Currency::fetchField($curcode);
 $_SESSION[$ses_id]['Currency'] =  $curr_row;
$cur_rate = $curr_row['value'];
$cur_symb = ($curr_row['symbol_left']!="")?$curr_row['symbol_left']:$curr_row['code'];
//pr($_SESSION);
//session_destroy();


/**
*
* set cookie value by cookie name
*/
/*function setcookie($name, $value, $expire = 0, $path = "", $domain = "")
{
    setcookie($name, $value, $expire, $path, $domain);
}*/

/**
*
*   get cookie value by cookie name
*/

/*function getcookie($name = "")
{
    return ($name ? $_COOKIE[$name] : $_COOKIE);
}*/

?>
