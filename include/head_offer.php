<!--<div class="header_info">
  <h2>Free Shipping</h2>
  <h3>on orders over $99</h3>
  <p>This offer is valid on all our store items.</p>
</div>-->

<?php 

require_once ROOT."classes/Manufacturer.php";
require_once ROOT ."functions/Session.php";
require_once ROOT ."customer/CustomerManager.php";

//$wishListArr = Session::getWishlistProductSession();

$customerObj = CustomerManager::getWishList($_SESSION['sess_user_id']); // get customer info

$wishListData = ( $customerObj && $customerObj->getWishlist() ? unserialize($customerObj->getWishlist()) : array());

$wishListNow = Session::getWishlistProductSession(); // get current wish list

// merge wish list with save list
$resultWishListArr = array();
if($wishListData && $wishListNow)
    $resultWishListArr = $wishListData+$wishListNow;
else if(!$wishListNow && $wishListData)
    $resultWishListArr = $wishListData;
else if($wishListNow && !$wishListData)
    $resultWishListArr = $wishListNow;

?>

<div class="header_info">
  <h2>Wish List</h2>
  <h3> <a href="../customer/customer_wishlist.php">Wish List (<?php echo count($resultWishListArr);?></a>)</h3>  
  <p>You can buy wish listed products later.</p>
</div>
