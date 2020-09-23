<?php
    $host 	 = "localhost"; // db host
    $db_user = "root"; // db username
    $db_pass = ""; // db password //9l0HsWcaDQIK
    $db 	 = "juzzsports"; // db name

    $link = @mysql_connect($host,$db_user,$db_pass);
    if(!$link)
        die("Can't connect!!");
    $var2 = @mysql_select_db($db,$link);
    if(!$var2)
        die("<br>"."can't select dataBase");


    $table 		= 'order_product';
    $className 	= 'OrderProduct';

    $sql 		= mysql_query("DESCRIBE $table");
    echo "<pre>";
    
    $classStr = "
	
/**
 *
 * ".ucwords($className)." class
 *
 *
 * @package     ".ucwords($className)."
 * @category    Library
 * @author      Juzz Sports
 * @date		".date("d-m-Y")."
 */<br /><br />";

    $classStr .= "Class ".ucwords($className)."<br />";
    $classStr .= "{<br />";

    $FieldNameArr = array();
    $variableNameArr = array();
    $getFunctionArr  = array();
    $setFunctionArr  = array();
    $variableName    = '<br />';
    $FieldFuncNameGet   = '';
    $FieldFuncNameSet   = '';
$gsStr = '<br />
&nbsp;&nbsp;&nbsp;&nbsp; /**
&nbsp;&nbsp;&nbsp;&nbsp; * All getter and setter functions
&nbsp;&nbsp;&nbsp;&nbsp; *
&nbsp;&nbsp;&nbsp;&nbsp; */
';
$saveStr .='<br />';

    while($row = mysql_fetch_assoc($sql)){
        $Field          = $row['Field'];
        $FieldArr       = explode("_",$Field);
        $FieldNameArr[] = $Field;

        $FieldVarName       = "";
        $FieldGetFuncName   = "";
        $FieldSetFuncName   = "";

        $count1 = 0;
        foreach($FieldArr as $fieldName){
            $count1++;
            if($count1 == 1){
                $FieldVarName .= $fieldName;
            }
            else{
                $FieldVarName .= ucwords($fieldName);
            }
            $FieldGetFuncName .= ucwords($fieldName);
            $FieldSetFuncName .= ucwords($fieldName);
        }
        $variableNameArr[] = $FieldVarName;
        $variableName .= '&nbsp;&nbsp;&nbsp;&nbsp;private $'.$FieldVarName.';'.'<br />';

        /********* SET Function Start **********************************************************/
        $FieldFuncNameSet   .= '&nbsp;&nbsp;&nbsp;&nbsp;public function set'.$FieldSetFuncName;
        $FieldFuncNameSet .= '($val)'.' <br />';
        $FieldFuncNameSet .= '&nbsp;&nbsp;&nbsp;&nbsp;{'.' <br />';
        $FieldFuncNameSet .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

        $TypeArr = explode("(",$row['Type']);
        if($TypeArr[0] == 'int' || $TypeArr[0] == 'tinyint'){
            $FieldFuncNameSet .= '$this->'.$FieldVarName.' = intval($val);'.' <br />';
        }
        else if($TypeArr[0] == 'float'){
            $FieldFuncNameSet .= '$this->'.$FieldVarName.' = floatval($val);'.' <br />';
        }
        else{ // for = datetime/ varchar/ date/ double
            $FieldFuncNameSet .= '$this->'.$FieldVarName.' = $val;'.' <br />';
        }

        $FieldFuncNameSet .= '&nbsp;&nbsp;&nbsp;&nbsp;'.'}'.'<br /><br />';

        $setFunctionArr[] = $FieldSetFuncName;
        //$FieldFuncNameSet = '';
        /********* SET Function End **********************************************************/


        /********* Get Function Start **********************************************************/
        $FieldFuncNameGet .= '&nbsp;&nbsp;&nbsp;&nbsp;public function get'.$FieldGetFuncName;
        $FieldFuncNameGet .= '()'.' <br />';
        $FieldFuncNameGet .= '&nbsp;&nbsp;&nbsp;&nbsp;{'.' <br />';
        $FieldFuncNameGet .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

        $FieldFuncNameGet .= 'return $this->'.$FieldVarName.'; <br />';

        $FieldFuncNameGet .= '&nbsp;&nbsp;&nbsp;&nbsp;'.'}'.'<br /><br />';

        $getFunctionArr[] = $FieldGetFuncName;
        //$FieldFuncNameGet = '';
        /********* SET Function End **********************************************************/



        //print_r($row);
    }
    /*echo $variableNameArr."<br />";
    echo $FieldFuncNameGet;
    echo $FieldFuncNameSet;*/

    $classStr .= $variableName.'<br>'.$gsStr.$FieldFuncNameGet.$FieldFuncNameSet;

/********* save Function start **********************************************************/
$saveStr = '<br />
&nbsp;&nbsp;&nbsp;&nbsp; /**
&nbsp;&nbsp;&nbsp;&nbsp; * Insert and update information
&nbsp;&nbsp;&nbsp;&nbsp; *
&nbsp;&nbsp;&nbsp;&nbsp; * @return mixed
&nbsp;&nbsp;&nbsp;&nbsp; *
&nbsp;&nbsp;&nbsp;&nbsp; */
';
$saveStr .='<br />';
$saveStr .= '<br />
&nbsp;&nbsp;&nbsp;&nbsp;public function save()
&nbsp;&nbsp;&nbsp;&nbsp;{';
$saveStr .='<br />';

$saveStr .='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$saveStr .='$'.$variableNameArr[0].' = intval($this->get'.$getFunctionArr[0].'());'.'<br /><br />';
$saveStr .='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$saveStr .= '$result["success"] = true;'.'<br />';
$saveStr .='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$saveStr .= '$result["message"] = "";';
$saveStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$saveStr .= '$table = "'.$table.'";';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

$fieldSetStr = '';
$count2 = 1;
foreach($FieldNameArr as $fName){
    if($count2 != 1)
        $fieldSetStr .= '"'.$fName.'",';
    $count2++;
}
$fieldSetStr = substr($fieldSetStr,0,-1);
$saveStr .= '$fieldset = array('.$fieldSetStr.');';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$fieldSetStr = '';
$count2 = 1;
foreach($getFunctionArr as $fName){
    if($count2 != 1)
        $fieldSetStr .= '$this->get'.$fName.'(),';
    $count2++;
}
$fieldSetStr = substr($fieldSetStr,0,-1);
$saveStr .= '$valueset = array('.$fieldSetStr.');';

$saveStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$saveStr .= 'if($'.$variableNameArr[0].' > 0){';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$saveStr .= '$condition = "AND '.$FieldNameArr[0].'=".$'.$variableNameArr[0].';';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$saveStr .= 'if(Connection::updateData($table,$fieldset,$valueset,$condition)){';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $saveStr .= '$result["success"] = true;';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $saveStr .= '$result["message"] = "Update Successful.";';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $saveStr .= '}else {';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $saveStr .= '$result["success"] = false;';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $saveStr .= '$result["message"] = "Update Failed.";';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $saveStr .= '}';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

$saveStr .= '}';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$saveStr .= 'else{';
    $saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $saveStr .= '$insert_id = 0;';
    $saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $saveStr .= 'if(Connection::insertData($table,$fieldset,$valueset,$insert_id)){';
        $saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $saveStr .= '$result["success"] = true;';
        $saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $saveStr .= '$result["message"] = "Insert Successful.";';
        $saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $saveStr .= '$this->set'.$getFunctionArr[0].'($insert_id);'; //------------
        $saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $saveStr .= '}else{';
        $saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $saveStr .= '$result["success"] = false;';
        $saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $saveStr .= '$result["message"] = "Insert Failed.";';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $saveStr .= '}';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$saveStr .= '}';
$saveStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$saveStr .= 'return $result;';
$saveStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$saveStr .='<br />&nbsp;&nbsp;&nbsp;&nbsp;}<br /><br />';

/********* save Function End **********************************************************/


/********* loadById Function Start **********************************************************/
$loadByIdStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;';
$loadByIdStr .= '<br />
&nbsp;&nbsp;&nbsp;&nbsp; /**
&nbsp;&nbsp;&nbsp;&nbsp; * get data from database by id
&nbsp;&nbsp;&nbsp;&nbsp; *
&nbsp;&nbsp;&nbsp;&nbsp; * @return '.ucwords($className).'
&nbsp;&nbsp;&nbsp;&nbsp; *
&nbsp;&nbsp;&nbsp;&nbsp; */
';
$saveStr .='<br />';
$loadByIdStr .= 'public static function loadById( $'.$variableNameArr[0].' )';
$loadByIdStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;';
$loadByIdStr .= '{';
$loadByIdStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$loadByIdStr .= '$'.$variableNameArr[0].'  = intval($'.$variableNameArr[0].');'; //-----
$loadByIdStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$loadByIdStr .= '$obj'.ucwords($className).' = NULL;';
$loadByIdStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

$loadByIdStr .= '$table      = "'.$table.'";'; //
$loadByIdStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$loadByIdStr .= '$condition 	= "AND '.$FieldNameArr[0].'=".$'.$variableNameArr[0].';';
$loadByIdStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$loadByIdStr .= '$fields 	= "*";';
$loadByIdStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

$loadByIdStr .= '$resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");';
$loadByIdStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$loadByIdStr .= 'if( $resultRow ) {';
$loadByIdStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$loadByIdStr .= '$obj'.ucwords($className).' = new '.ucwords($className).'();';
$loadByIdStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $index = 0;
        foreach($getFunctionArr as $getFunction){
            $loadByIdStr .= '$obj'.ucwords($className).'->set'.$getFunction.'($resultRow["'.$FieldNameArr[$index].'"]);';
            $loadByIdStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            $index++;
        }
$loadByIdStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$loadByIdStr .= '}';
$loadByIdStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

$loadByIdStr .= 'return $obj'.ucwords($className).';';
$loadByIdStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;';
$loadByIdStr .= '}'.'<br /><br />';


/********* load Function End **********************************************************/



/********* load Function Start **********************************************************/
$loadStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;';
$loadStr .= '<br />
&nbsp;&nbsp;&nbsp;&nbsp; /**
&nbsp;&nbsp;&nbsp;&nbsp; * get all data from database
&nbsp;&nbsp;&nbsp;&nbsp; *
&nbsp;&nbsp;&nbsp;&nbsp; * @return Array
&nbsp;&nbsp;&nbsp;&nbsp; *
&nbsp;&nbsp;&nbsp;&nbsp; */
';
$loadStr .= 'public static function load()';
$loadStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;';
$loadStr .= '{';
$loadStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$loadStr .= '$obj'.ucwords($className).'Arr = array();';

$loadStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

$loadStr .= '$table      = "'.$table.'";';
$loadStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$loadStr .= '$condition 	= "";';
$loadStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$loadStr .= '$fields 	= "*";';
$loadStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

$loadStr .= '$row  	= Connection::getAllData($table, $condition, $fields, "", "");';
$loadStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$loadStr .= 'if( $row ) {';
$loadStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $loadStr .= 'foreach( $row as $resultRow ){';
$loadStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $loadStr .= '$obj'.ucwords($className).' = new '.ucwords($className).'();';
    $loadStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $index = 0;
    foreach($getFunctionArr as $getFunction){
        $loadStr .= '$obj'.ucwords($className).'->set'.$getFunction.'($resultRow["'.$FieldNameArr[$index].'"]);';
        $loadStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $index++;
    }
    $loadStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

        $loadStr .= '$obj'.ucwords($className).'Arr[] = $obj'.ucwords($className).';';
$loadStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $loadStr .= '}';
$loadStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$loadStr .= '}';
$loadStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

$loadStr .= 'return $obj'.ucwords($className).'Arr;';
$loadStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;';
$loadStr .= '}'.'<br /><br />';
/********* loadById Function End **********************************************************/


/********* deleteById Function Start **********************************************************/
$deleteByIdStr .= '<br /><br />'.'&nbsp;&nbsp;&nbsp;&nbsp;';
$deleteByIdStr .= '<br />
&nbsp;&nbsp;&nbsp;&nbsp; /**
&nbsp;&nbsp;&nbsp;&nbsp; * delete data from database by id
&nbsp;&nbsp;&nbsp;&nbsp; *
&nbsp;&nbsp;&nbsp;&nbsp; * @return True | False
&nbsp;&nbsp;&nbsp;&nbsp; *
&nbsp;&nbsp;&nbsp;&nbsp; */
';
$deleteByIdStr .= 'public static function deleteById( $'.$variableNameArr[0].' )';
$deleteByIdStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;';
$deleteByIdStr .= '{';
$deleteByIdStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $deleteByIdStr .= '$'.$variableNameArr[0].' = intval( $'.$variableNameArr[0].' );';
$deleteByIdStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $deleteByIdStr .= 'return Connection::delData("'.$table.'", " AND '.$FieldNameArr[0].'=".$'.$variableNameArr[0].');';
$deleteByIdStr .= '<br />'.'&nbsp;&nbsp;&nbsp;&nbsp;';
$deleteByIdStr .= '}';
$deleteByIdStr .= '<br /><br />'.'';
/********* deleteById Function End **********************************************************/




    $classStr .= $saveStr.$loadByIdStr.$loadStr.$deleteByIdStr;
    echo $classStr .= "}<br /> ?>";

?>