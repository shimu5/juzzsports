<?php
require_once ROOT . "classes/Manufacturer.php";
require_once ROOT . "functions/Session.php";

$manufacturerListArr = Manufacturer::load(0, 0, 1); // get all manufacture list
//pr($manufacturerListArr);

$compareListArr = Session::getCompareProductSession();

?>
<div class="col-right sidebar col-xs-12 col-sm-3" xmlns="http://www.w3.org/1999/html">
    <?php if (count($compareListArr)) { ?>
        <div class="block block-cart  <?php echo(count($compareListArr) ? "first" : ""); ?>">
            <div class="block-title"><strong><span>Compare Products</span></strong></div>
            <div class="block-content">
                <div class="block-content">
                    <p class="empty">You have chosen <a
                            href="../product_details/product_compare.php"><strong><?php echo count($compareListArr); ?>
                                products</strong></a> to compare.</p>
                </div>

            </div>
        </div>
    <?php } ?>
    <div class="block block-layered-nav <?php echo(count($compareListArr) ? "" : "first"); ?>">
        <div class="block-title"><strong><span>Category</span></strong> <span class="toggle"></span></div>

        <script type="text/javascript" src="../js/scriptbreaker-multiple-accordion-1.js"></script>
        <script language="JavaScript">
            jQuery(document).ready(function () {
                jQuery(".topnav").accordion({
                    accordion: false,
                    speed: 500,
                    closedSign: '[+]',
                    openedSign: '[-]'
                });
            });

        </script>
        <style>

        </style>
        <div class="block-content" style="margin-bottom: 30px;">
            <?php
            require_once ROOT . "classes/Category.php";

            // get category; level = 0
            $categoryMenuItemArr = Category::getMainCategory();
            $categoryMenuStr = "";
            $getPath = "";

            // display category list with sub categories
            if ($categoryMenuItemArr) {
                $categoryMenuStr .= '<ul class="topnav">';

                foreach ($categoryMenuItemArr as $categoryMenuItemObj) {
                    $active1Css = ($pathArr[0] == $categoryMenuItemObj->getCategoryId() ? "class='active'" : "");

                    $categoryMenuStr .= '<li ' . ($pathArr[0] == $categoryMenuItemObj->getCategoryId() ? "class='active'" : "") . '> <a href="#">' . $categoryMenuItemObj->getCategoryName() . '</a>';

                    // get sub category by parent id; level 1
                    $subCategoryMenuItemArr = Category::getSubCategoryByParentId($categoryMenuItemObj->getCategoryId());
                    if ($subCategoryMenuItemArr) {
                        $categoryMenuStr .= '<ul>';
                        foreach ($subCategoryMenuItemArr as $subCategoryMenuItemObj) {
                            $categoryMenuStr .= '<li ' . ($pathArr[1] == $subCategoryMenuItemObj->getCategoryId() ? "class='active'" : "") . '> <a href="#">' . $subCategoryMenuItemObj->getCategoryName() . '</a>';

                            // get sub category by parent id; level 2
                            $subCategoryMenuItemLevel2Arr = Category::getSubCategoryByParentId($subCategoryMenuItemObj->getCategoryId());
                            if ($subCategoryMenuItemLevel2Arr) {
                                $categoryMenuStr .= '<ul>';
                                foreach ($subCategoryMenuItemLevel2Arr as $subCategoryMenuItemLevel2Obj) {
                                    $pathIds = $categoryMenuItemObj->getCategoryId() . '_' . $subCategoryMenuItemObj->getCategoryId() . "_" . $subCategoryMenuItemLevel2Obj->getCategoryId(); // make the category browse path
                                    $isSelected = ($pathArr[2] == $subCategoryMenuItemLevel2Obj->getCategoryId() ? 1 : 0); // is selected item
                                    $categoryMenuStr .= '<li ' . ($isSelected ? "class='active'" : "") . '> <a style="' . ($isSelected ? "color: #fd6a56;" : "") . '" href="index.php?s=3&path=' . ($pathIds) . '&category_id=' . $subCategoryMenuItemLevel2Obj->getCategoryId() . (!$isRemoveManufacturer ? '&manufacture_id=' . $getManufacturerId : '') . (!$isRemovePrice ? '&price=' . $getPrice : '') . '">' . $subCategoryMenuItemLevel2Obj->getCategoryName() . '</a> </li>';

                                    if ($isSelected && empty($getPath))
                                        $getPath = $pathIds;

                                }
                                $categoryMenuStr .= '</ul>';
                            }
                            $categoryMenuStr .= " </li>";
                        }
                        $categoryMenuStr .= '</ul>';
                    }
                    $categoryMenuStr .= " </li>";
                }
                $categoryMenuStr .= '</ul>';

            }
            echo $categoryMenuStr;
            ?>


        </div>
        <div class="block block-layered-nav">
            <div class="block-title"><strong><span>Shop By</span></strong> <span class="toggle"></span></div>
            <div class="block-content">
                <p class="block-subtitle">Shopping Options</p>
                <dl id="narrow-by-list">
                    <dt class="odd">
                        <span>Price</span>
                        <span style="float: right; font-weight: normal; font-size: 11px;"><a
                                href="index.php?s=3&path=<?php echo $getPath; ?>&category_id=<?php echo $categoryId; ?>&price=<?php echo $getPrice; ?>&manufacture_id=<?php echo $getManufacturerId; ?>&remove_price=1&remove_manufacture=<?php echo $isRemoveManufacturer ?>">Reset</a></span>
                    <div style="clear: both;"></div>
                    </dt>
                    <dd class="odd">
                        <ol>
                            <li>
                                <a style="<?php echo(!$isRemovePrice && $getPrice == '1_49.99' ? 'color: #FD6A56;' : ''); ?>"
                                   href="index.php?s=3&path=<?php echo $getPath; ?>&category_id=<?php echo $categoryId; ?>&price=1_49.99<?php echo($isRemoveManufacturer == 0 ? "&manufacture_id=" . $getManufacturerId : "") ?>"><span
                                        class="price">
                                    <span><?php echo $curr_row['symbol_left'] ?><?php $price = (1 * $curr_row['value']);
                                        echo sprintf("%0.2f", $price); ?></span> -
                                    <span><?php echo $curr_row['symbol_left'] ?><?php $price = (49.99 * $curr_row['value']);
                                        echo sprintf("%0.2f", $price); ?></span>
                                </a>
                            </li>
                            <li>
                                <a style="<?php echo(!$isRemovePrice && $getPrice == '50_99.99' ? 'color: #FD6A56;' : ''); ?>"
                                   href="index.php?s=3&path=<?php echo $getPath; ?>&category_id=<?php echo $categoryId; ?>&price=50_99.99<?php echo($isRemoveManufacturer == 0 ? "&manufacture_id=" . $getManufacturerId : "") ?>">
                                    <span><?php echo $curr_row['symbol_left'] ?><?php $price = (50 * $curr_row['value']);
                                        echo sprintf("%0.2f", $price); ?></span> -
                                    <span><?php echo $curr_row['symbol_left'] ?><?php $price = (99.99 * $curr_row['value']);
                                        echo sprintf("%0.2f", $price); ?></span>
                                </a></li>
                            <li>
                                <a style="<?php echo(!$isRemovePrice && $getPrice == '100_149.99' ? 'color: #FD6A56;' : ''); ?>"
                                   href="index.php?s=3&path=<?php echo $getPath; ?>&category_id=<?php echo $categoryId; ?>&price=100_149.99<?php echo($isRemoveManufacturer == 0 ? "&manufacture_id=" . $getManufacturerId : "") ?>">
                                    <span><?php echo $curr_row['symbol_left'] ?><?php $price = (100 * $curr_row['value']);
                                        echo sprintf("%0.2f", $price); ?></span> -
                                    <span><?php echo $curr_row['symbol_left'] ?><?php $price = (149.99 * $curr_row['value']);
                                        echo sprintf("%0.2f", $price); ?></span>
                                </a></li>
                            <li>
                                <a style="<?php echo(!$isRemovePrice && $getPrice == '150_199.99' ? 'color: #FD6A56;' : ''); ?>"
                                   href="index.php?s=3&path=<?php echo $getPath; ?>&category_id=<?php echo $categoryId; ?>&price=150_199.99<?php echo($isRemoveManufacturer == 0 ? "&manufacture_id=" . $getManufacturerId : "") ?>">
                                    <span><?php echo $curr_row['symbol_left'] ?><?php $price = (150 * $curr_row['value']);
                                        echo sprintf("%0.2f", $price); ?></span> -
                                    <span><?php echo $curr_row['symbol_left'] ?><?php $price = (199.99 * $curr_row['value']);
                                        echo sprintf("%0.2f", $price); ?></span>
                                </a></li>
                            <li>
                                <a style="<?php echo(!$isRemovePrice && $getPrice == '200_249.99' ? 'color: #FD6A56;' : ''); ?>"
                                   href="index.php?s=3&path=<?php echo $getPath; ?>&category_id=<?php echo $categoryId; ?>&price=200_249.99<?php echo($isRemoveManufacturer == 0 ? "&manufacture_id=" . $getManufacturerId : "") ?>">
                                    <span><?php echo $curr_row['symbol_left'] ?><?php $price = (200 * $curr_row['value']);
                                        echo sprintf("%0.2f", $price); ?></span> -
                                    <span><?php echo $curr_row['symbol_left'] ?><?php $price = (249.99 * $curr_row['value']);
                                        echo sprintf("%0.2f", $price); ?></span>
                                </a></li>
                            <li>
                                <a style="<?php echo(!$isRemovePrice && $getPrice == '250_p' ? 'color: #FD6A56;' : ''); ?>"
                                   href="index.php?s=3&path=<?php echo $getPath; ?>&category_id=<?php echo $categoryId; ?>&price=250_p<?php echo($isRemoveManufacturer == 0 ? "&manufacture_id=" . $getManufacturerId : "") ?>">
                                    <span><?php echo $curr_row['symbol_left'] ?><?php $price = (250 * $curr_row['value']);
                                        echo sprintf("%0.2f", $price); ?></span> -
                                    and <span>above</span>
                                </a></li>
                        </ol>
                    </dd>
                    <dt class="last even">
                        <span>Manufacturer</span>
                        <span style="float: right; font-weight: normal; font-size: 11px;"><a
                                href="index.php?s=3&path=<?php echo $getPath; ?>&category_id=<?php echo $categoryId; ?>&price=<?php echo $getPrice; ?>&manufacture_id=<?php echo $getManufacturerId; ?>&remove_manufacture=1&remove_price=<?php echo $isRemovePrice ?>">Reset</a></span>
                    <div style="clear: both;"></div>
                    </dt>
                    <dd class="last even">
                        <ol>
                            <?php if ($manufacturerListArr) {
                                foreach ($manufacturerListArr as $manufacturerObj) {
                                    $manufacturerId = $manufacturerObj->getManufacturerId();
                                    if (!$isRemoveManufacturer && $getManufacturerId == $manufacturerId)
                                        echo '<li> <a style="color: #FD6A56;" href="index.php?s=3&path=' . $getPath . '&category_id=' . $categoryId . ($isRemovePrice == 0 ? '&price=' . $getPrice : '') . '&manufacture_id=' . $manufacturerId . '">' . $manufacturerObj->getName() . '</a> </li>';
                                    else
                                        echo '<li> <a href="index.php?s=3&path=' . $getPath . '&category_id=' . $categoryId . ($isRemovePrice == 0 ? '&price=' . $getPrice : '') . '&manufacture_id=' . $manufacturerId . '">' . $manufacturerObj->getName() . '</a> </li>';

                                }
                            }?>
                        </ol>
                    </dd>
                </dl>
            </div>
        </div>


    </div>