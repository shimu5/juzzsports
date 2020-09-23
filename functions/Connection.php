<?php
/**
 *
 * Database Connection Class
 *
 * This class holds all the Database Connection Manage functionality.
 *
 * @package     Connection
 * @category    Library
 * @author
 * @link
 * @date
 */

include_once ROOT . "functions/db_connect.php";
include_once ROOT . "functions/quote_smart.php";
include_once ROOT . "classes/FieldValidator.php";

class Connection
{
    // max page no.
    public static $MaxPage = 10;

    //No of Data shows in a page
    public static $PageLimit = 30;

    /**
     *Show the Pages
     * @param $prow2 Total No of Item found, $now Current Page No,
     * $div div name for AJAX Paging and if $div == "" means non AJAX paging
     * @retun $out the page info
     */

    static function showThePagesinfoCommon($prow2, $now, $CUrl, $div)
    {
        $MaximumPage = Connection::$MaxPage;
        $limit = Connection::$PageLimit;

        if ($prow2 > $limit) {
            $page2 = $prow2 / $limit;
            $page3 = $prow2 % $limit;
            if ($page3 != 0) {
                $page2 = $page2;
            }

            $page2 = ceil($page2);
            $out = '<div class="PageNavDiv">';

            if ($now > 0) {
                $prev = ($now - 1);
                if ($div == "")
                    $out .= "<a class=\"pageNavs\" href=\"" . $CUrl . "k=0\"> &lt;&lt; </a><a class=\"pageNavs\" href=\"" . $CUrl . "k=" . $prev . "\"> &lt; </a>";
                else
                    $out .= "<a class=\"pageNavs\" href=\"#\" onclick=\"getAjaxListOfData('" . $div . "','" . $CUrl . "k=0'); return false;\"> &lt;&lt; </a><a class=\"pageNavs\" href=\"#\" onclick=\"getAjaxListOfData('" . $div . "','" . $CUrl . "k=" . $prev . "'); return false;\"> &lt; </a>";
            }

            // Show the Page numbers
            $max = $MaximumPage;
            $CurrentPage = $now;
            $dottedLowerLimit = false;
            $dottedUpperLimit = false;
            if (($max % 2) == 0) {
                $max = $max - 1;
            }

            $maxPages = $max;
            $span = ($max - 1) / 2;
            $totalp = $page2 - 1;

            if ($totalp < $max) {
                $upperLimit = min($totalp, ($span * 2 + 1));
                $lowerLimit = 0;
            } elseif ($CurrentPage < ($span + 1)) {
                $lowerLimit = 0;
                $upperLimit = min($totalp, ($span * 2 + 1));
            } elseif ($CurrentPage > ($totalp - $span)) {
                $upperLimit = $totalp;
                $lowerLimit = max(0, $totalp - $span * 2);
            } else {
                $upperLimit = min($totalp, $CurrentPage + $span);
                $lowerLimit = max(0, ($CurrentPage - $span));
            }

            if ($lowerLimit <> 0) {
                $dottedLowerLimit = true;
            }
            if ($upperLimit <> $totalp) {
                $dottedUpperLimit = true;
            } else {
                $dottedUpperLimit = false;
            }

            if ($dottedLowerLimit) $out .= ' ... ';
            for ($j = $lowerLimit; $j <= $upperLimit; $j++) {
                if ($j == $CurrentPage) {
                    $out .= ' <span class="currentPnav">' . ($j + 1) . '</span> ';
                } else {
                    if ($div == "") {
                        $urls = $CUrl . "k=" . $j;
                        $out .= " <a class=\"pageNavs\" href=\"$urls\">" . ($j + 1) . "</a> ";
                    } else {
                        $urls = "getAjaxListOfData('" . $div . "','" . $CUrl . "k=" . $j . "'); return false;";
                        $out .= " <a class=\"pageNavs\" href=\"#\" onclick=\"$urls\">" . ($j + 1) . "</a> ";
                    }
                }
                if ($j != $page2) {
                    $out .= ' | ';
                }
            }
            if ($dottedUpperLimit) $out .= ' ... ';

            if ($now < ($page2 - 1)) {
                $next = ($now + 1);
                if ($div == "")
                    $out .= "<a class=\"pageNavs\" href=\"" . $CUrl . "k=" . $next . "\"> &gt; </a><a class=\"pageNavs\" href=\"" . $CUrl . "k=" . ($page2 - 1) . "\"> &gt;&gt; </a>";
                else
                    $out .= "<a class=\"pageNavs\" href=\"#\" onclick=\"getAjaxListOfData('" . $div . "','" . $CUrl . "k=" . $next . "'); return false;\"> &gt; </a><a class=\"pageNavs\" href=\"#\" onclick=\"getAjaxListOfData('" . $div . "','" . $CUrl . "k=" . ($page2 - 1) . "'); return false;\"> &gt;&gt; </a>";

            }
            $out .= '
</div>
';
            $out .= '
<div class="PageinfoDiv">Page ' . ($now + 1) . ' of ' . $page2 . '</div>
';
        }
        return $out;
    }

    /**
     * Get all records of the result set back as an array of arrays.
     * @param string $sql
     * @return array list (array) of records (associative arrays), false if error
     */
    public static function getAllDataByQuery($sql)
    {
        $data = array();
        $result = mysql_query($sql);
        if ($result) {
            while ($res = mysql_fetch_array($result)) {
                $data[] = $res;
            }
            return $data;
        } else {
            //die($sql);
            return false;
        }
    }

    /**
     * Get the first record from a result set.  Note that this method
     * will automatically append "LIMIT 1" to the end as an optimization
     * as long as LIMIT was not found anymore in your passed in SQL string
     * @param string $sql
     * @return array record as associative array, null if no record found, false if error
     */
    public static function getFirstRow($sql)
    {
        if (!preg_match('/\blimit\b/i', $sql))
            $sql .= " LIMIT 1";
        $r = self::getAllResults($sql);
        if ($r === false)
            return false;
        if (count($r) > 0)
            return $r[0];
        return null;
    }

    /**
     * Get the first field of the first record.
     * @param string $sql
     * @return mixed value of first field of first record.  null if no record found, false if error occurred.
     */
    public static function getSingleValue($sql)
    {
        $res = self::getFirstRow($sql);
        if (!$res) {
            return $res;
        }
        $data = $res[0];
        return $data;
    }

    /**
     *Get All data From any Table
     * @param $table Table Name, $condition sql condition, $fields gets the specific field data, $orders for sorting, $limits limits of data
     * @retun $data All data
     */

    public static function getAllData($table, $condition, $fields, $orders, $limits, $printSql = 0)
    {
        $data = array();
        if ($printSql)
            echo $sql = "SELECT $fields FROM $table WHERE 1 $condition $orders $limits";
        else
            $sql = "SELECT $fields FROM $table WHERE 1 $condition $orders $limits";

        $result = mysql_query($sql);
        if ($result) {
            while ($res = mysql_fetch_array($result)) {
                $data[] = $res;
            }
            return $data;
        } else {
            //ErrorLog::logErrorSql($sql, __FILE__, __FUNCTION__, __LINE__);
            return false;
        }
    }


    /**
     * Get Specific data build query sql
     * @retun $data Specific data
     */

    public static function getSingleDataByQuery($sql, $printSql = 0)
    {
        $data = array();
        if ($printSql)
            echo $sql;
        
        $result = mysql_query($sql);
        if ($result) {
            return mysql_fetch_assoc($result);
        } else {          
            return false;
        }
    }

    /**
     *Get Specific data From any Table
     * @param $table Table Name, $condition sql condition, $fields gets the specific field data, $orders for sorting, $limits limits of data
     * @retun $data Specific data
     */

    public static function getSingleData($table, $condition, $fields, $orders = "", $limits = "", $printSql = 0)
    {
        $data = array();
        if ($printSql)
            echo $sql = "SELECT $fields FROM $table WHERE 1 $condition $orders $limits";
        else
            $sql = "SELECT $fields FROM $table WHERE 1 $condition $orders $limits";
        $result = mysql_query($sql);
        if ($result) {
            return mysql_fetch_assoc($result);
        } else {
            //error_log("Connection::getSpecfDataByQuery() failed query: $sql (".mysql_error().")");
            //ErrorLog::logError("Connection::getSpecfDataByQuery() failed query: $sql (".mysql_error().")", __FILE__, __FUNCTION__, __LINE__);
            return false;
        }
    }

    /**
     *Get Specific data From a union query
     * @param query1 , query2, $orderBy, $limit
     * @retun $data array of result rows
     */
    public static function getDataByUnion($query1, $query2, $orderBy, $limit = "")
    {
        $data = array();
        $sql = "($query1) UNION ($query2) $orderBy $limit";
        $result = mysql_query($sql);
        if ($result) {
            while ($res = mysql_fetch_array($result)) {
                $data[] = $res;
            }
            return $data;
        } else {
            //ErrorLog::logErrorSql($sql, __FILE__, __FUNCTION__, __LINE__);
            return false;
        }
    }

    /**
     *Get No of data From any Table
     * @param $table Table Name, $condition sql condition
     * @retun $data Count No. of Data
     */
    public static function getCountData($table, $condition, $printSql = 0)
    {
        $printSql = intval($printSql);
        if ($printSql == 1)
            echo $sql = "SELECT COUNT(1) AS counts FROM $table WHERE 1 $condition";
        elseif ($printSql == 0)
            $sql = "SELECT COUNT(1) AS counts FROM $table WHERE 1 $condition";
//        echo $sql;die;
        $result = mysql_query($sql);
        if ($result) {
            $res = mysql_fetch_array($result);
            $data = $res['counts'];
            return $data;
        } else {
            //ErrorLog::logErrorSql($sql, __FILE__, __FUNCTION__, __LINE__);
            return false;
        }
    }

    /**
     *Get No of data From a union of two queries
     * @param query1 , query2
     * @retun $data Count No. of Data
     */
    public static function getCountDataByUnion($query1, $query2, $orderBy, $limit = "")
    {
        $data = array();
        $sql = "($query1) UNION ($query2)";
        $result = mysql_query($sql);

        if ($result) {
            return mysql_num_rows($result);
        } else {
            //ErrorLog::logErrorSql($sql, __FILE__, __FUNCTION__, __LINE__);
            return false;
        }
    }

    /**
     *inserts data into any table
     * @param str $table = Table Name
     * @param array $fieldset = array of fields
     * @param array $valueset = array of values
     * @param int $insert_id optional, variable passed here will be set by reference to the last insert id
     * @param bool $preserveNulls optional, if true null values will be NULL in insert instead of empty string
     * @retun bool true on success else string errorMsg
     */
    public static function insertData($table, $fieldset = array(), $valueset = array(), &$insert_id = 0, $preserveNulls = false, $printSql = 0)
    {
        $errorMsg = "";

        if (count($fieldset) != count($valueset)) {
            $errorMsg = "Column set did not match with value set.";
            return $errorMsg;
        }

        $fields = "";
        foreach ($fieldset as $field) {
            $fields .= $field . ",";
        }
        $fields = substr($fields, 0, strlen($fields) - 1);

        $values = "";
        foreach ($valueset as $val) {
            if ($val === NULL && $preserveNulls)
                $values .= " null,";
            else
                $values .= " '" . dbsafe($val) . "',";
        }
        $values = substr($values, 0, strlen($values) - 1);
        if ($printSql)
            echo $sql = sprintf("INSERT INTO %s ( %s ) VALUES ( %s )", $table, $fields, $values);
        else
            $sql = sprintf("INSERT INTO %s ( %s ) VALUES ( %s )", $table, $fields, $values);
        if (mysql_query($sql)) {
            $insert_id = mysql_insert_id();
            return true;
        } else {
            return false;
        }
    }

    /**
     *updates data into any table
     * @param str $table = Table Name, array $fieldset = array of fields, array $valueset = array of values, str $condition
     * @param bool $preserveNulls optional, if true null values will be NULL in insert instead of empty string
     * @retun bool true on success else false
     */
    public static function updateData($table, $fieldset = array(), $valueset = array(), $condition = "", $preserveNulls = false, $printSql = 0)
    {
        $fields = "";
        $values = "";
        $errorMsg = "";
        $updateStr = "";

        if (count($fieldset) != count($valueset)) {
            cust_warning("Column set did not match with value set.");
            return false;
        }

        $i = 0;
        foreach ($fieldset as $field) {
            $value = "";
            if ($valueset[$i] === NULL && $preserveNulls)
                $value = "null, ";
            else
                $value = "'" . dbsafe($valueset[$i]) . "', ";

            $updateStr .= $field . " = " . $value;
            $i++;
        }

        $updateStr = substr($updateStr, 0, strlen($updateStr) - 2);

        if($printSql)
            echo $sql = sprintf("UPDATE `%s` SET %s WHERE 1 %s", $table, $updateStr, $condition);
        else
            $sql = sprintf("UPDATE `%s` SET %s WHERE 1 %s", $table, $updateStr, $condition);

        //mysql_query($sql) or die(mysql_error()."====".$sql);
        if (mysql_query($sql) or die().$sql)
            return true;
        else {
            return false;
        }
    }

    /**
     *Delete any row From any Table
     * @param $table Table Name, $condition sql condition
     * @retun
     */

    public static function delData($table, $condition)
    {
        $sql = "DELETE FROM $table WHERE 1 $condition";

        if (mysql_query($sql))
            return true;
        else {
            //ErrorLog::logErrorSql($sql, __FILE__, __FUNCTION__, __LINE__);
            return false;
        }
    }

    /**
     *return data with dispaly safe or return N/A if null
     * @param $value
     * @retun get data with dispaly safe or return N/A if null
     */
    public function getDataOrNA($value)
    {
        if (trim($value))
            return displaysafe($value);
        else
            return "N/A";
    }

} // End Class
 