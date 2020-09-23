<?php
require_once "../config.php";
require_once ROOT ."classes/Currency.php";
require_once ROOT ."settings.php";

?>
<div class="top-container">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="top_block">
            <div class="header-button currency-list"> <a title="Currency" href="#"><?php echo $curr_row['symbol_left'] ?></a>

                <ul style="width:217px; height: 200px; overflow-y:scroll;">
                    <?php
                    $currencies = Currency::load();
                    foreach($currencies as $curr): $cur_code = trim($curr->getCode()); //var_dump($cur_code); var_dump($_COOKIE['currency_code']);
                        $session_cur_code = $_SESSION[$ses_id]["currency_code"];
                        if(!isset($session_cur_code))$session_cur_code = DEFAULT_CURRENCY;
                        ?>

                        <li> <a href="#" onclick="getValue('<?php echo $cur_code;  ?>');return false;" title="<?php echo $cur_code;  ?>" class="currencies" style=" <?php echo ($session_cur_code==$cur_code) ? "color: #FD6A56" : "" ?>" ><?php echo trim($curr->getTitle()); ?> - <?php echo $curr->getCode();  ?></a> </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="header-button lang-list"> <a title="Language" href="#">en</a>
              <ul>
                <li> <a class="selected" href="#" title="en_US">English</a> </li>
              </ul>
            </div>
            <div class="header-button">
                <a title="Login" href="#" class="fa fa-lock" style="height: 20px; padding-top: 4px; color:white;"><?php echo (isset($_SESSION['sess_user_id']) && $_SESSION['sess_user_id'] ? " ".$_SESSION['sess_user_firstname'] : " Guest ");?></a>
                <ul>
                    <?php
                    if(isset($_SESSION['sess_user_id']) && $_SESSION['sess_user_id']){
                        echo '<li><a  href="../customer/index.php" title="My Account">Profile</a></li>';
                        echo '<li><a  href="../logout.php" title="Logout">Logout</a></li>';
                    }
                    else{
                        echo '<li><a class="selected" href="../login.php" title="Login">Login</a></li>';
                    }
                    ?>
                </ul>
            </div>
			<!--<div class="header-button">
                <a title="Login" href="login.php" class="fa fa-lock" style="height: 20px; padding-top: 4px; color:white;"></a>
            </div>-->

          <ul class="links">
            <li class="first contact_no"><span style="color:#F00; font-size:20px;" class="fa fa-phone"></span> + 65 6221 8888</li>
            <li style="padding-left:15px; color: #e0e0e0;">&nbsp;</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<script>
    function getValue(code){
        jQuery.ajax({
            url:'../currencies/ajax_session.php',
            type:'POST',
            data:'val='+code+'&name=currency_code',
            success: function(response ){
                jQuery(".currency-list > ul ").hide('slow');
                var location_str = location.href;
                location_str = location_str.replace("#", "");
                window.location.assign(location_str)
            },
            error: function(jqXHR, textStatus, errorThrown ){
                alert(errorThrown);
            }
        })
    }


</script>