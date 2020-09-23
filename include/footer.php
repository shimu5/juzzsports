<div class="footer-container">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="footer">
          <p id="back-top"><a href="#top"><span></span></a> </p>
          <div class="footer-cols-wrapper">
            <div class="footer-col">
              <h4>Information</h4>
              <div class="footer-col-content">
                <ul>
                  <li><a href="../aboutus/index.php?s=2&p=2&type=about&name=knows">About Us</a></li>
                  <!--<li><a href="#">Customer Service</a></li>
                  <li><a href="#">Template Settings</a></li>
                  <li class="last privacy"><a href="#">Privacy Policy</a></li>-->
                </ul>
                  <ul class="links">
                      <li class=" last"><a href="../store/index.php?s=4" title="Store">Store Information</a></li>
                      <li class=" last"><a href="../contactus/index.php?s=5" title="Contact Us">Contact Us</a></li>
                      <!--<li class="first"><a href="#" title="Site Map">Site Map</a></li>
                      <li><a href="#" title="Search Terms">Search Terms</a></li>
                      <li><a href="#" title="Advanced Search">Advanced Search</a></li>
                      <li><a href="#" title="Orders and Returns">Orders and Returns</a></li>-->
                </ul>
              </div>
            </div>
            <div class="footer-col">
              <h4>Registration / Login</h4>
              <div class="footer-col-content">
                <ul>
                    <li><a href="../login.php">Sign In</a> / <a href="../registration.php">Registration</a></li>
                    <li><a href="../customer/frm_newsletter.php">Newsletter</a></li>
                </ul>
              </div>
            </div>
            <div class="footer-col">
              <h4>My account</h4>
              <div class="footer-col-content">
                <ul>
                    <li><a href="../customer/index.php">Profile</a></li>
                    <li><a href="../cart_information.php">View Cart</a></li>
                    <li><a href="../customer/customer_wishlist.php">My Wishlist</a></li>
                    <li><a href="../product_details/product_compare.php">Compare Products List</a></li>
                </ul>
              </div>
            </div>
            <div class="footer-col last">
              <h4>Store Information</h4>
              <div class="footer-col-content">
                <form action="#" method="post" id="newsletter-validate-detail">
                  <div class="form-subscribe-header">1 WOODLANDS SQUARE<br>#02-20 CAUSEWAY POINT, S748098</div>
                  <div class="footer_tel">TEL +65 6462-6453</div>
                  <div class="form-subscribe-header">INFO@JUZZSPORTS.COM</div>
                  <div class="newsletter_wrapper">
                    &nbsp;
                  </div>
                </form>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    // for cart edit , delete and add option
    function addToCart(product_id,qty,currency){
            jQuery.ajax({
                url:'../carts/ajax_add.php',
                type:'POST',
                data:'product_id='+product_id+'&qty='+qty+'&currency_code='+currency,
                success: function(response ){                   
                    jQuery(".block-cart-header").html(response);
                    var prod_name = jQuery(".block-cart-header").find('#product_add').html();
                    jQuery("#add_cart_success").html("Success: You have added  <a href='index.php?id="+product_id+"'>"+ prod_name+"</a> to your shopping cart!").toggle();
                },
                error: function(jqXHR, textStatus, errorThrown ){
                    alert(errorThrown);
                }
            })

    }
    function addToCompare(product_id,qty,currency){
            jQuery.ajax({
                url:'../compare/ajax_add.php',
                type:'POST',
                data:'product_id='+product_id+'&qty='+qty+'&currency_code='+currency,
                success: function(response ){
                    /*jQuery(".block-cart-header").html(response);
                     //alert("root = > "+jQuery(".block-cart-header").find('#product_add').html());
                    var prod_name = jQuery(".block-cart-header").find('#product_add').html();
                    jQuery("#add_cart_success").html("Success: You have added  <a href='product_details/index.php?id="+product_id+"'>"+ prod_name+"</a> to your shopping cart!").toggle();*/
                },
                error: function(jqXHR, textStatus, errorThrown ){
                    alert(errorThrown);
                }
            })

    }
     function deleteToCart(product_id){
        var r = confirm("Are you sure to remove this item from shopping cart?");
        if(r){
            jQuery.ajax({
                url:'../carts/ajax_delete.php',
                type:'POST',
                data:'product_id='+product_id,
                success: function(response ){
                    jQuery(".block-cart-header").html(response);
                    window.location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown ){
                    alert(errorThrown);
                }
            })
        }
    }

    function editToCart(product_id){
        window.location.assign("../cart_information.php")
    }

    function checkOut(){
        window.location.assign("../checkout/index.php")
    }

    function productDetail(product_id){
        window.location.assign("../product_details/index.php?id="+product_id)
    }

</script>