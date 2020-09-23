<div class="shadow"></div>
<div class="swipe-left"></div>
<div class="swipe">
  <div class="swipe-menu"> <a href="#" title="Home" class="home-link">Home</a>
    <div class="footer-links-menu">
      <ul>
          <?php
          if(isset($_SESSION['sess_user_id']) && $_SESSION['sess_user_id']){
              echo '<li><a  href="customer/index.php" title="My Account">Profile</a></li>';
              echo '<li><a  href="logout.php" title="Logout">Logout</a></li>';
          }
          else{
              echo '<li><a class="selected" href="login.php" title="Login">Login</a></li>';
          }
          ?>
      </ul>
    </div>
  </div>
</div>
<div class="top-icon-menu">
  <div class="swipe-control"><i class="fa fa-align-justify"></i></div>
  <div class="top-search"><i class="fa fa-search"></i></div>
  <span class="clear"></span> 
</div>