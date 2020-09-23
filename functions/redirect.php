<?php
require_once ROOT."functions/functions.php";

/**
 * This function redirects to an url
 * @param: string $url - URL we want to be re-directed to
 */
function redirectPage($url)
{
	if (headers_sent()){
		?>
		<script type="text/javascript">
		var newloc = <?php echo json_encode($url); ?>;
		if (window.location.replace)
			window.location.replace(newloc);
		else
			window.location.href = newloc;
		</script>
		<noscript><meta http-equiv="Refresh" content="0;URL=<?php echo $url; ?>" /></noscript>
		<?php
	}else{
		header( "Location: ". $url );
	}
	exit();
}

/**
 * This function decides where to be redirected and redirects
 * to that url using redirectPage($url) function
 * 
 * @param: string $url - URL we want to redirected to
 */
function redirectMobile($url)
{
	if(isMobileBrowser()){
		if((isset($_SESSION['stay_in_full_website']) && $_SESSION['stay_in_full_website'] == 1))
			return;
		else
			redirectPage($url);
	}else
		return;
}