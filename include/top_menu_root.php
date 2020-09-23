<?php
require_once "config.php";
require_once ROOT."classes/Category.php";

$categoryMenuItemArr = Category::getMainCategory();

?>
<div class="nav-container">

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul id="nav" class="sf-menu">
                    <li class="level0 nav-1 first level-top"><a href="index.php" class="level-top"><span>Home</span></a></li>
                    <li class="level0 nav-2 level-top parent"><a href="aboutus/index.php?s=2&p=1&type=about&name=guide" class="level-top"><span>About Us</span></a>
                        <ul class="level0">
                            <li class="level1 nav-2-2"><a href="aboutus/index.php?s=2&p=2&type=about&name=knows">About Us</a></li>
                            <li class="level1 nav-2-1 first"><a href="aboutus/index.php?s=2&p=1&type=about&name=guide">Apparel Size Guide</a></li>
                            <li class="level1 nav-2-3"><a href="aboutus/index.php?s=2&p=3&type=about&name=shipping">Shipping Rates & Delivery</a></li>
                            <li class="level1 nav-2-4"><a href="aboutus/index.php?s=2&p=4&type=about&name=shoe">Shoe Size Guide</a></li>
                            <li class="level1 nav-2-5 last"><a href="aboutus/index.php?s=2&p=5&type=about&name=faq">FAQ</a></li>
                        </ul>
                    </li>
                    <li class="level3 nav-3 level-top parent"><a href="category_products/index.php?s=3&path=0" class="level-top"><span>Shop</span></a></li>
                    <li class="level0 nav-4 level-top"><a href="store/index.php?s=4" class="level-top"><span>Store</span></a></li>
                    <li class="level0 nav-5 level-top"  style="background:none;"><a href="contactus/index.php?s=5" class="level-top"><span>Contact Us</span></a></li>
                </ul>
                <div class="sf-menu-block">
                    <div id="menu-icon">Categories</div>
                    <ul class="sf-menu-phone">
                        <li class="level0 nav-1 first level-top"><a href="index.php" class="level-top"><span>Home</span></a></li>                        
                        <li class="level0 nav-2 active level-top parent"><a class="level-top" href="aboutus/index.php?s=2&p=1&type=about&name=guid"><span>About Us</span></a>
                            <ul class="level0" style="display: none;">
                                <li class="level1 nav-2-1 first"><a href="aboutus/index.php?s=2&p=1&type=about&name=guide"><span>Apparel Size Guide</span></a></li>
                                <li class="level1 nav-2-2"><a href="aboutus/index.php?s=2&p=2&type=about&name=knows"><span>Get to Know Us</span></a></li>
                                <li class="level1 nav-2-3"><a href="aboutus/index.php?s=2&p=3&type=about&name=shipping"><span>Shipping Rates & Delivery</span></a></li>
                                <li class="level1 nav-2-4"><a href="aboutus/index.php?s=2&p=4&type=about&name=shoe"><span>Shoe Size Guide</span></a></li>
                                <li class="level1 nav-2-5 last"><a href="aboutus/index.php?s=2&p=5&type=about&name=faq"><span>FAQ</span></a></li>
                            </ul>
                            <strong class="opened"></strong></li>
                        <li class="level3 nav-3 active level-top parent"><a class="level-top" href="../category_products/index.php?s=3&p=1"><span>Shop</span></a>
                            <ul class="level0" style="display: none;">
                                <?php
                                // Display main categories; e.g: Men, Women
                                if($categoryMenuItemArr){
                                    $totalCategory = count($categoryMenuItemArr);
                                    $counterCategory = 0;
                                    foreach($categoryMenuItemArr as $categoryMenuItemObj){
                                        $counterCategory++;
                                        echo '<li class="level3 nav-3-2 '.($totalCategory == $counterCategory ? "last" : "").'"><a href="../category_products/index.php?s=3&path='.$categoryMenuItemObj->getCategoryId().'"><span>'.$categoryMenuItemObj->getCategoryName().'</span></a></li>';
                                    }
                                }
                                ?>
                            </ul>
                            <strong class="opened"></strong></li>
                        <li class="level0 nav-4 level-top"><a href="#" class="level-top"><span>Store</span></a></li>
                        <li class="level0 nav-5 level-top"><a href="contactus/index.php?s=5" class="level-top"><span>Contact Us</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>