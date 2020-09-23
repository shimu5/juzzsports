<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/check_auth.php");  	
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

$showTrModule = (isset($_SESSION['sess_company_id']) && is_array($_SESSION['sess_features_array']) && in_array("12", $_SESSION['sess_features_array'])) ? true : false;

if($showTrModule == false){
	print("You don't have permission to be here.  <a href=\"/marketplace/\">click here</a> to go to your My Marketplace page.");
	exit;
}

include_once($_SERVER['DOCUMENT_ROOT'] . "/admin/training_module/TrainingManager.php");

//Delete Course
if( isset($_GET['del_course_id']) ) {
  TrainingManager::deleteCourse( $_GET['del_course_id'] );
}

//Get Course List
$result = TrainingManager::getCourseList($_SESSION['sess_company_id']);	 
?>
<div class="fn_sect_body">
	<?php echo $result["resultdata"];?>
	<div class="clearboth nullobject"></div>
	<?php echo $result["pageres"];?>
</div>
	