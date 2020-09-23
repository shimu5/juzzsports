<?php
require_once ROOT . "classes/Category.php";

$path = $_GET['path'];
$pathArr = explode("_", $path);
//pr($pathArr);
//die;


$categoryInfoObj = Category::loadById($mainCategoryId);
$subCategoryMenuItemArr = Category::getSubCategoryByParentId($mainCategoryId);
//pr($categoryInfoObj);


?>
<!-- div class="page-title category-title">
    <h1>Category</h1>
</div>
<div class="block block-layered-nav first" style="background: #F9F9F9; padding: 20px;">
    <div class="block-content">
        <dl id="narrow-by-list">
            <dt class="odd"
                style="border-top: 0px solid red;"><?php echo($categoryInfoObj ? $categoryInfoObj->getCategoryName() : ""); ?></dt>
            <dd class="odd">
                <ol>
                    <?php
                    /*if($subCategoryMenuItemArr){
                        foreach($subCategoryMenuItemArr as $subCategoryMenuItemObj){
                            //echo '<li> <a href="#"><span class="price">Men</span></a> </li>';
                            echo '<li><a href="../category_products/index.php?s=3&main_category_id='.$subCategoryMenuItemObj->getCategoryId().'">'.$subCategoryMenuItemObj->getCategoryName().'</a></li>';
                        }
                    }*/
                    ?>
                    <li><a href="#"><span class="price">Men</span></a></li>
                    <li><a href="#"><span class="price">Men</span></a></li>
                    <dd class="odd">
                        <li style=""><a href="#"><span class="price">Men</span></a></li>
                        <li style=""><a href="#"><span class="price">Men</span></a></li>
                        <li style=""><a href="#"><span class="price">Men</span></a></li>
                    </dd>

                </ol>
            </dd>
        </dl>
    </div>
</div -->
