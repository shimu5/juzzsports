<div class="breadcrumbs">
<ul>
    <?php
    if($breadcrumbArr){
        $counter = 1;
        $lastItem = count($breadcrumbArr);
        foreach($breadcrumbArr as $name => $url){ 
            // Print 1st item of Breadcrumb
            if($counter == 1){ ?>
            <li class="home">                
                <a href="<?php echo ($url != -1 ? $url : '#');?>"><?php echo $name;?></a>
                <?php if($url != -1){?>
                <span>&gt;</span>
                <?php }?>
            </li>
        <?php            
            }
            else{ 
            // Print others item of Breadcrumb
            ?>
            <li class="cms_page">                
                <a href="<?php echo $url;?>"><?php echo $name;?></a>
                <?php if($counter != $lastItem){?>
                <span>&gt;</span>
                <?php }?>
            </li>
        <?php            
            }            
            $counter++;
        }
    }
    ?>    
</ul>
</div>