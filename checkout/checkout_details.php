<!-- If Customer didn't have register / login  then will show step 1 , others will show after login -->

<div class="checkout_container column">
    <?php if(isset($_SESSION[$ses_id]['Products']) && !empty($_SESSION[$ses_id]['Products'])): ?>
    <div id="checkout">
        <div class="checkout-heading">Step 1: Checkout Options</div>
        <div class="checkout-content">  <?php if(!$sessUserId){ include_once 'checkout_steps_1_account.php'; } ?></div>
    </div>
    <div id="payment-address">
        <div class="checkout-heading"><span><?php echo (!$sessUserId)?'Step 2: Account & Billing Details':'Step 2: Billing Details' ?></span></div>
        <div class="checkout-content"><?php if($sessUserId): include_once 'checkout_steps_1_billing_details.php'; endif; ?> </div>
    </div>
    
    <div id="shipping-address">
        <div class="checkout-heading">Step 3: Delivery Details</div>
        <div class="checkout-content"><?php //if(!$sessUserId): include_once 'checkout_steps_1_shipping_details.php'; endif; ?></div>
    </div>
    <div id="shipping-method">
        <div class="checkout-heading">Step 4: Delivery Method</div>
        <div class="checkout-content"></div>
    </div>
    <div id="payment-method">
        <div class="checkout-heading">Step 5: Payment Method</div>
        <div class="checkout-content"></div>
    </div>
    <div id="confirm">
        <div class="checkout-heading">Step 6: Confirm Order</div>
        <div class="checkout-content"></div>
    </div>
    <?php else: ?>
    <div class="checkout"><h4>Your Shopping Cart is Empty</h4></div>
    <?php endif; ?>
</div>

<script type="text/javascript">
    // Payment address country change action
    jQuery('#payment-address #country').live('change',function(){
        var country_id = jQuery(this).val();       
        var _method = 'POST';
        var _url = '../customer/getZoneList.php';
        var _queryStr = {country_id:country_id};

        jQuery.ajax({
            type:_method,
            url:_url,
            data:_queryStr,
            success:function (msg) {                                
                jQuery("#payment-address #zone_id").empty().append(msg);
            }
        });
    });

    // delivery address country change action
    jQuery('#shipping-address #country').live('change',function(){
        var country_id = jQuery(this).val();
       
        var _method = 'POST';
        var _url = '../customer/getZoneList.php';
        var _queryStr = {country_id:country_id};

        jQuery.ajax({
            type:_method,
            url:_url,
            data:_queryStr,
            success:function (msg) {                                
                jQuery("#shipping-address #zone_id").empty().append(msg);
            }
        });
    });

// For modify link click action
jQuery('.checkout-heading a').live('click', function() {
	jQuery('.checkout-content').slideUp('slow');
	jQuery(this).parent().parent().find('.checkout-content').slideDown('slow');
});


// Payment Address
jQuery('#button-payment-address').live('click', function(e) {   
       if(jQuery("#payment-address input[type='radio']:checked").val()=="new"){
           var checkflag= validation("payment-address");
           if(!checkflag){
                e.preventDefault();
                 return;
           }
        } 
	jQuery.ajax({
		url: 'index.php?route=payment_address',
		type: 'post',
		data: jQuery('#payment-address input[type=\'text\'], #payment-address input[type=\'password\'], #payment-address input[type=\'checkbox\']:checked, #payment-address input[type=\'radio\']:checked, #payment-address input[type=\'hidden\'], #payment-address select'),
		dataType: 'json',
		beforeSend: function() {
			jQuery('#button-payment-address').attr('disabled', true);
			jQuery('#button-payment-address').after('<span class=\'wait\'><img src="<?php echo BASE_URL?>/images/loading.gif" alt="" /></span>');
		},
		complete: function() {
			jQuery('#button-payment-address').attr('disabled', false);
			jQuery('.wait').remove();
		},
		success: function(json) {
                        console.log(json);
			/*$('.error').remove();

			if (json['redirect']) {
				location = json['redirect'];
			}

			if (json['error']) {
				if (json['error']['firstname']) {
					jQuery('#payment-address input[name=\'firstname\']').after('&lt;span class="error"&gt;' + json['error']['firstname'] + '&lt;/span&gt;');
				}

				if (json['error']['lastname']) {
					jQuery('#payment-address input[name=\'lastname\']').after('&lt;span class="error"&gt;' + json['error']['lastname'] + '&lt;/span&gt;');
				}

				if (json['error']['telephone']) {
					jQuery('#payment-address input[name=\'telephone\']').after('&lt;span class="error"&gt;' + json['error']['telephone'] + '&lt;/span&gt;');
				}

				if (json['error']['address_1']) {
					jQuery('#payment-address input[name=\'address_1\']').after('&lt;span class="error"&gt;' + json['error']['address_1'] + '&lt;/span&gt;');
				}

				if (json['error']['city']) {
					jQuery('#payment-address input[name=\'city\']').after('&lt;span class="error"&gt;' + json['error']['city'] + '&lt;/span&gt;');
				}

				if (json['error']['postcode']) {
					jQuery('#payment-address input[name=\'postcode\']').after('&lt;span class="error"&gt;' + json['error']['postcode'] + '&lt;/span&gt;');
				}

				if (json['error']['country']) {
					jQuery('#payment-address select[name=\'country_id\']').after('&lt;span class="error"&gt;' + json['error']['country'] + '&lt;/span&gt;');
				}

				if (json['error']['zone']) {
					jQuery('#payment-address select[name=\'zone_id\']').after('&lt;span class="error"&gt;' + json['error']['zone'] + '&lt;/span&gt;');
				}
			} else {*/
                            
                          
                            jQuery.ajax({
					url: 'index.php?route=shipping_address',
					dataType: 'html',
					success: function(html) {

						jQuery('#shipping-address .checkout-content').html(html);
                                                jQuery('#payment-address .checkout-content').slideUp('slow');

                                                jQuery('#shipping-address .checkout-content').slideDown('slow');

                                                jQuery('#payment-address .checkout-heading a').remove();
                                                jQuery('#shipping-address .checkout-heading a').remove();
                                                jQuery('#shipping-method .checkout-heading a').remove();
                                                jQuery('#payment-method .checkout-heading a').remove();

                                                jQuery('#payment-address .checkout-heading').append('<a>Modify > </a>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});

				jQuery.ajax({
					url: 'index.php?route=payment_address',
					dataType: 'html',
					success: function(html) {
						jQuery('#payment-address .checkout-content').html(html);
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			//}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});


// Shipping Address
jQuery('#button-shipping-address').live('click', function(e) {
        if(jQuery("#shipping-address input[type='radio']:checked").val()=="new"){
           var checkflag= validation("shipping-address");
           if(!checkflag){
                e.preventDefault();
                 return;
           }
        }

	jQuery.ajax({
		url: 'index.php?route=shipping_address',
		type: 'post',
		data: jQuery('#shipping-address input[type=\'text\'], #shipping-address input[type=\'password\'], #shipping-address input[type=\'checkbox\']:checked, #shipping-address input[type=\'radio\']:checked, #shipping-address select'),
		dataType: 'json',
		beforeSend: function() {
			jQuery('#button-shipping-address').attr('disabled', true);
			jQuery('#button-shipping-address').after('<span class=\'wait\'><img src="<?php echo BASE_URL?>/images/loading.gif" alt="" /></span>');
		},
		complete: function() {
			jQuery('#button-shipping-address').attr('disabled', false);
			jQuery('.wait').remove();
		},
		success: function(json) {
			/*jQuery('.error').remove();

			if (json['redirect']) {
				location = json['redirect'];
			}

			if (json['error']) {
				if (json['error']['firstname']) {
					$('#shipping-address input[name=\'firstname\']').after('&lt;span class="error"&gt;' + json['error']['firstname'] + '&lt;/span&gt;');
				}

				if (json['error']['lastname']) {
					$('#shipping-address input[name=\'lastname\']').after('&lt;span class="error"&gt;' + json['error']['lastname'] + '&lt;/span&gt;');
				}

				if (json['error']['email']) {
					$('#shipping-address input[name=\'email\']').after('&lt;span class="error"&gt;' + json['error']['email'] + '&lt;/span&gt;');
				}

				if (json['error']['telephone']) {
					$('#shipping-address input[name=\'telephone\']').after('&lt;span class="error"&gt;' + json['error']['telephone'] + '&lt;/span&gt;');
				}

				if (json['error']['address_1']) {
					$('#shipping-address input[name=\'address_1\']').after('&lt;span class="error"&gt;' + json['error']['address_1'] + '&lt;/span&gt;');
				}

				if (json['error']['city']) {
					$('#shipping-address input[name=\'city\']').after('&lt;span class="error"&gt;' + json['error']['city'] + '&lt;/span&gt;');
				}

				if (json['error']['postcode']) {
					$('#shipping-address input[name=\'postcode\']').after('&lt;span class="error"&gt;' + json['error']['postcode'] + '&lt;/span&gt;');
				}

				if (json['error']['country']) {
					$('#shipping-address select[name=\'country_id\']').after('&lt;span class="error"&gt;' + json['error']['country'] + '&lt;/span&gt;');
				}

				if (json['error']['zone']) {
					$('#shipping-address select[name=\'zone_id\']').after('&lt;span class="error"&gt;' + json['error']['zone'] + '&lt;/span&gt;');
				}
			} else {*/
				jQuery.ajax({
					url: 'index.php?route=shipping_method',
					dataType: 'html',
					success: function(html) {
						jQuery('#shipping-method .checkout-content').html(html);

						jQuery('#shipping-address .checkout-content').slideUp('slow');

						jQuery('#shipping-method .checkout-content').slideDown('slow');

						jQuery('#shipping-address .checkout-heading a').remove();
						jQuery('#shipping-method .checkout-heading a').remove();
						jQuery('#payment-method .checkout-heading a').remove();

						jQuery('#shipping-address .checkout-heading').append('<a>Modify > </a>');

						jQuery.ajax({
							url: 'index.php?route=shipping_address',
							dataType: 'html',
							success: function(html) {
								jQuery('#shipping-address .checkout-content').html(html);
							},
							error: function(xhr, ajaxOptions, thrownError) {
								alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
							}
						});
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			// } */
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// Delivery method button click
jQuery('#button-shipping-method').live('click', function(e) {
        e.preventDefault();        
        var del_method = jQuery('#shipping-method input[type=\'radio\']:checked').val();        
        if(del_method==undefined){
            alert("Please select a shipping method");
            return false;
        }
        else{
	jQuery.ajax({
		url: 'index.php?route=shipping_method',
		type: 'post',
		data: jQuery('#shipping-method input[type=\'radio\']:checked, #shipping-method textarea'),
		dataType: 'json',
		beforeSend: function() {
			jQuery('#button-shipping-method').attr('disabled', true);
			jQuery('#button-shipping-method').after('<span class=\'wait\'><img src="<?php echo BASE_URL?>/images/loading.gif" alt="" /></span>');
		},
		complete: function() {
			jQuery('#button-shipping-method').attr('disabled', false);
			jQuery('.wait').remove();
		},
		success: function(json) {			
				jQuery.ajax({
					url: 'index.php?route=payment_method',
					dataType: 'html',
					success: function(html) {
						jQuery('#payment-method .checkout-content').html(html);

						jQuery('#shipping-method .checkout-content').slideUp('slow');

						jQuery('#payment-method .checkout-content').slideDown('slow');

						jQuery('#shipping-method .checkout-heading a').remove();
						jQuery('#payment-method .checkout-heading a').remove();

						jQuery('#shipping-method .checkout-heading').append('<a>Modify > </a>');

					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
        }
});

jQuery('#button-payment-method').live('click', function(e) {

       if(jQuery("#payment_method_select").val()=="bank"){
           if(jQuery.trim(jQuery("#bank_name").val())=="" ){
                alert("Fill Bank Name");
                jQuery("#bank_name").focus();
                e.preventDefault();
                return;
           }
           if(jQuery.trim(jQuery("#bank_acount_no").val())==""){
                alert("Fill Bank Account No");
                jQuery("#bank_acount_no").focus();
                e.preventDefault();
                return;
           }
       }
       if(jQuery.trim(jQuery("#payment_method_select").val())==""){
            alert("Select a Payment Method");
            e.preventDefault();
            return;
        }
        if(!jQuery("#terms_n_condition").is(':checked')){
            alert("Please check Terms and Conditions!");
            e.preventDefault();
            return;
        }       
       /* if(jQuery.trim(jQuery("#payment_comment").val())==""){
            alert("Please fill comments about order!");
            e.preventDefault();
            return;
        }*/

	jQuery.ajax({
		url: 'index.php?route=payment_method',
		type: 'post',
		data: jQuery('#payment-method #payment_method_select, #payment-method input[type=\'checkbox\']:checked, #payment-method textarea,#payment-method input[type=\'text\']'),
		dataType: 'json',
		beforeSend: function() {
			jQuery('#button-payment-method').attr('disabled', true);
			jQuery('#button-payment-method').after('<span class=\'wait\'><img src="<?php echo BASE_URL?>/images/loading.gif" alt="" /></span>');
		},
		complete: function() {
			jQuery('#button-payment-method').attr('disabled', false);
			jQuery('.wait').remove();
		},
		success: function(json) {
			/*jQuery('.warning').remove();

			if (json['redirect']) {
				location = json['redirect'];
			}

			if (json['error']) {
				if (json['error']['warning']) {
					$('#payment-method .checkout-content').prepend('&lt;div class="warning" style="display: none;"&gt;' + json['error']['warning'] + '&lt;/div&gt;');

					$('.warning').fadeIn('slow');
				}
			} else { */
				jQuery.ajax({
					url: 'index.php?route=confirm',
					dataType: 'html',
					success: function(html) {
						jQuery('#confirm .checkout-content').html(html);

						jQuery('#payment-method .checkout-content').slideUp('slow');

						jQuery('#confirm .checkout-content').slideDown('slow');

						jQuery('#payment-method .checkout-heading a').remove();

						jQuery('#payment-method .checkout-heading').append('<a>Modify > </a>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			// }*/
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

//  confirm a cart for order
jQuery('#button-confirm').live('click', function() {
    jQuery.ajax({
            url: 'index.php?route=confirm',
            dataType: 'html',
            type: 'post',
            data: "confirm=1",
            dataType:'json',
            success: function(msg) {
                    
                   console.log(msg)
                   if(msg['success'] && msg['order_id']){
                    location = "../invoice/index.php?checkout_status=1&order_id="+msg['order_id'];
                   }
                   else{
                       //console.log(json['error']);
                       alert(msg['error']);
                   }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
    });
});

jQuery("#payment_method_div").hide();

jQuery('#payment_method_select').live('change', function(e) {
    e.preventDefault();
    var pay_code = jQuery("#payment_method_select").val();

    if(pay_code=='bank'){        
        jQuery("#payment_user_account").show().find("input").removeAttr("disabled");
        jQuery.ajax({
                url: 'index.php?route=payment_method_description',
                dataType: 'html',
                type: 'post',
                data: "method_code="+pay_code,
                success: function(resHtml) {                     
                       jQuery("#payment_method_div").html(resHtml).show()
                },
                error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
        });
    }
    else{               
         jQuery("#payment_method_div").hide();
         jQuery("#payment_user_account").hide().find("input").attr("disabled","disabled");
    }
})





/**
     * Ref:: http://stackoverflow.com/questions/46155/validate-email-address-in-javascript
     *
     * @param email
     * @returns {boolean}
     */
    
    // Form Validation
    function validation(parent_div) {
        if (jQuery('#'+parent_div+' #firstname').val() == '') {
            alert('Please enter first name');
            jQuery('#'+parent_div+' #firstname').focus();
            return false;
        }
        else if (jQuery('#'+parent_div+' #lastname').val() == '') {
            alert('Please enter last name');
            //document.getElementById("lastname").focus();
            return false;
        }
        else if (jQuery('#'+parent_div+' #address_1').val() == '') {
            alert('Please enter address 1');
            jQuery('#'+parent_div+' address_1').focus();
            return false;
        }
        else if (jQuery('#'+parent_div+' #city').val() == '') {
            alert('Please enter city');
            jQuery('#'+parent_div+' #city').focus();
            return false;
        }
        else if (jQuery('#'+parent_div+' #postcode').val() == '') {
            alert('Please enter postcode');
            jQuery('#'+parent_div+' #postcode').focus();
            //document.getElementById("postcode").focus();
            return false;
        }
        else if (jQuery('#'+parent_div+' #country').val() == '') {
            alert('Please select country');
            jQuery('#'+parent_div+' #country').focus();
            return false;
        }
        /*else if (jQuery('#'+parent_div+' #zone_id').val() == '') {
            alert('Please select Zone');
            jQuery('#'+parent_div+' #zone_id').focus();
            return false;
        }*/
        return true;
    }
</script>