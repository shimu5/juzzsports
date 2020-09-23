<?php
$storeList = StoreManager::getAllStores();

echo "<div style='margin-top: 20px;'></div>";
if($storeList){
    $counter = 0;
    $storeStr = "";
    foreach($storeList as $storeObj){
        if($counter % 3 == 2){
            $storeStr .= '<div class="about-padd">';
            $storeStr .= '<div class="wrapper">';
        }
        if($counter % 3 == 0){ //n-th row, 1st colm store address; n = 1,2,3..
            $storeStr .= '<div class="about-col-1">';
                $storeStr .= '<h3>'.$storeObj->getName().'</h3>';
                $storeStr .= '<p>'.$storeObj->getAddress().'</p>';
                $storeStr .= '<p> Tel: '.$storeObj->getTelephone().'</p>';
                $storeStr .= '<span></span>';
            $storeStr .= '</div>';
        }
        if($counter % 3 == 1){ //n-th row, 2ns colm store address; n = 1,2,3..
            $storeStr .= '<div class="about-col-2">';
                $storeStr .= '<h3>'.$storeObj->getName().'</h3>';
                $storeStr .= '<p>'.$storeObj->getAddress().'</p>';
                $storeStr .= '<p> Tel: '.$storeObj->getTelephone().'</p>';
                $storeStr .= '<span></span>';
            $storeStr .= '</div>';
        }
        if($counter % 3 == 2){//n-th row, 3rd colm store address; n = 1,2,3..
            $storeStr .= '<div class="about-col-3">';
                $storeStr .= '<h3>'.$storeObj->getName().'</h3>';
                $storeStr .= '<p>'.$storeObj->getAddress().'</p>';
                $storeStr .= '<p> Tel: '.$storeObj->getTelephone().'</p>';
            $storeStr .= '</div>';
        }
        if($counter % 3 == 2){
            $storeStr .= '</div>';
            $storeStr .= '</div>';
            $storeStr .= '<div class="clear" style="margin-bottom: 0px;"></div>';

        }

        $counter++;
    }

    echo $storeStr;
}
?>
