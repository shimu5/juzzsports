<?php
session_start();
require_once "config.php";
require_once ROOT."functions/Connection.php";
require_once ROOT."functions/functions.php";
include_once ROOT."functions/redirect.php";
include_once ROOT."classes/Product.php";
require_once ROOT."settings.php";

if ($_POST) {
    $q = $_POST['search'];
    $resultArr = Product::searchProductInfoByProductName($q); // search product with search key
    if($resultArr){
        foreach($resultArr as $result){ // display result
            echo '<div class="show" align="left">';
                    echo '<span class="name"><a href="product_details/index.php?id='.$result['product_id'].'">'.$result['name'].'</a></span>';
            echo '</div>';
        }
    }
}
?>
