<?php
    $top_tags = HomePageSetting::productTags(1 , 3 , 1);
    if(!empty($top_tags)):
?>
<div class="banners_row">
   <?php foreach($top_tags as $k=>$tag):?>
      <div class="banner ban<?php echo $k+1 ?>">
        <a href="category_products/index.php?tag_id=<?php echo $tag['tag_id']?>">
              <div class="banner_img"><img src="<?php echo BASE_URL ?>images/banner<?php echo $k+1 ?>.jpg" alt=""/></div>
        </a>
        <div class="ban1_bottom_section">
          <div class="title_product"><span class="red_text"><?php echo $tag['tag_name']?></span></div>
          <div>&nbsp;</div>
          <div class="desc_grid"><?php echo (strlen($tag['tag_description'])>100)?substr($tag['tag_description'], 0, 100)."...":$tag['tag_description'] ?><a href="category_products/index.php?tag_id=<?php echo $tag['tag_id']?>"><img src="images/arrow_btn.png" width="20" height="22" class="promtion_img_bullet"></a></div>
          <div class="clearfix"></div>
        </div>
      </div>
     <?php endforeach; ?>
</div>
<?php  endif; ?>