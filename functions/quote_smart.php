<?php

/**
 * This should be called on all form data.  It is the key for us
 * to move to a safer PHP configuration in the future.  If the PHP
 * configuration is set to "magic quote" form data will be pre-escaped
 * which can cause problems when not immediately inserting into database.
 * We want to guarantee all data is in its genuine un-escaped format
 * until we use it in an SQL query or display it on the page.
 * 
 * Example usage:
 * $name = stripform($_REQUEST['name']);
 * echo "You input ".displaysafe($name)."<br/>";
 * echo "Enter your name: <input type=\"text\" name=\"name\" value=\"".displaysafe($name)."\" /><br/>";
 * $sql = "insert into names VALUE('".dbsafe($name)."')";
 * 
 * @param $data The form data to be cleaned.
 */
function stripform($data) {
	if (get_magic_quotes_gpc())	{
		// magic quotes is turned on
		if (is_string($data)) {
			$data = stripslashes($data);
		} else if (is_array($data)) {
			// recursively call ourselves for each item
			$data = array_map("stripform", $data);
		}
	}
	return $data;
}

/**
 * Convenience function for getting form data that may
 * or may not be present.  If not present, the default
 * value specified will be returned.  If present, the
 * data is passed through stripform() automatically so
 * that any escaping PHP may have done is removed and the
 * value is exactly what the user input.
 * 
 * Example usage:
 * $name = fetchstrip($_POST, "name", "[no name entered]");
 * 
 * @param array $formdata the form array being used.  Passed by reference for optimization.
 * @param string $key key name the data being fetched would be stored under
 * @param mixed $default (optional) any default value you may want to return if value is not present, will be empty string unless otherwise specified
 * @returns mixed returns fetched form data
 */
function fetchstrip(&$formdata, $key, $default="")
{
	if (!$formdata || !array_key_exists($key, $formdata))
		return $default;
	
	$value = stripform($formdata[$key]);
	return $value;
}

/**
 * This should be called on data that is used in SQL queries.
 * The data should be surrounded by single-quotes in your
 * SQL query.  If you do not surround the data in single-quotes
 * this function will not work properly!
 * 
 * Example usage:
 * $name = stripform($_REQUEST['name']);
 * echo "You input ".displaysafe($name)."<br/>";
 * echo "Enter your name: <input type=\"text\" name=\"name\" value=\"".displaysafe($name)."\" /><br/>";
 * $sql = "insert into names VALUE('".dbsafe($name)."')";
 * 
 * @param $data The form data to be cleaned.
 */
function dbsafe($data) {
	if(! is_array($data)) {
		return mysql_real_escape_string($data);
	}
}

/**
 * This should be called on data that is being printed out
 * into the HTML content of a page. It will change all HTML
 * special characters such as < and > into the escaped versions
 * like &lt; and &gt;.  This is important so that user-submitted
 * data cannot contain HTML formatting that messes up the page,
 * or worse javascript attacks.
 * 
 * The data returned from this function is also safe to be
 * inside quoted fields such as element attributes because quotes
 * are converted from " to &quot;
 * 
 * Example usage:
 * $name = stripform($_REQUEST['name']);
 * echo "You input ".displaysafe($name)."<br/>";
 * echo "Enter your name: <input type=\"text\" name=\"name\" value=\"".displaysafe($name)."\" /><br/>";
 * $sql = "insert into names VALUE('".dbsafe($name)."')";
 * 
 * @param $data The form data to be cleaned.
 */
function displaysafe($data) {
	return htmlspecialchars($data);
}

/**
 * @param $text
 * @param $limit
 * @return string
 */
function truncatewords($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

?>