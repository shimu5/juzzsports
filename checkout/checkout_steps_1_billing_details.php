
<div class="column">
        <input name="payment_address" value="existing" id="payment-address-existing" checked="checked" type="radio">
        <label for="payment-address-existing">I want to use an existing address</label>
        <div id="payment-existing">
            <?php $custom_address = CheckoutManager::getCustomerAddressByCustomerId($sessUserId);   ?>
            <select name="address_id" style="width: 100%; margin-bottom: 15px;" size="5">
                <?php if(!empty($custom_address)): foreach($custom_address as $k=>$add ): ?>
                <option value="<?php echo $add['address_id'] ?>" <?php if($k==0): echo "selected"; endif; ?> > <?php echo $add['firstname']." ".$add['lastname'].", ".$add['lastname'].", ".$add['address_1'].", ".$add['country_name']."." ; ?></option>
                <?php endforeach;  endif;?>
            </select>
        </div>
        <p>
        <input name="payment_address" value="new" id="payment-address-new" type="radio">
        <label for="payment-address-new">I want to use a new address</label>
    </p>
    <div id="payment-new" style="display: none;" class="block">
        <div class="col-lg-9 no-padding col-left">
       
        <div class="col-lg-12 new-users" style="margin-top: 20px;">
            <input type="hidden" name="customer_id" value ="<?php echo $_SESSION[$ses_id]['customer_id']?>" />
            <div class="form-group">
                <label class="col-sm-3 control-label" for="firstname">First Name: <span class="required">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="firstname" id="firstname" class="form-control">
                    <?php echo($errorOccur && $errorArr['firstname'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['firstname'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="lastname">Last Name: <span class="required">*</span></label>

                <div class="col-sm-8">
                    <input type="text" name="lastname" id="lastname" class="form-control">
                    <?php echo($errorOccur && $errorArr['lastname'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['lastname'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="company">Company</label>

                <div class="col-sm-8">
                    <input type="text" name="company" id="company" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="address_1">Address 1:<span class="required">*</span></label>

                <div class="col-sm-8">
                    <input type="text" value="" name="address_1" id="address_1" class="form-control">
                    <?php echo($errorOccur && $errorArr['address_1'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['address_1'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="address_2">Address 2: </label>

                <div class="col-sm-8">
                    <input type="text" value="" name="address_2" id="address_2" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="city">City :<span class="required">*</span></label>

                <div class="col-sm-8">
                    <input type="text" value="" name="city" id="city" class="form-control">
                    <?php echo($errorOccur && $errorArr['city'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['city'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="postcode">Post Code: <span class="required">*</span></label>

                <div class="col-sm-8">
                    <input type="text" value="" name="postcode" id="postcode" class="form-control">
                    <?php echo($errorOccur && $errorArr['postcode'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['postcode'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="country">Country: <span class="required">*</span></label>

                <div class="col-sm-8">
                    <select class="col-sm-12 form-control" id="country" name="country">
                        <option value="">Select Country</option>
                        <?php $countrys = CheckoutManager::getCountries(); ?>
                        <?php foreach ($countrys as $county): ?>
                            <option
                                value="<?php echo $county->getCountryId() ?>"><?php echo $county->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo($errorOccur && $errorArr['country'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:40px;">' . $errorArr['country'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="region">Region/State: <span
                        class="required"></span></label>

                <div class="col-sm-8">                  
                    <select class="col-sm-12 form-control" id="zone_id" name="zone_id">
                        <option value="">Select Zone</option>
                    </select>
                    <?php echo($errorOccur && $errorArr['zone_id'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['zone_id'] . '</div>' : '') ?>
                </div>
            </div>            
        </div>      
    </div>       
    </div>
     <div class="col-lg-12 no-padding col-right">
            <div class="button_blocks">
                <div class="right"><a id="button-payment-address" class="btn">Continue</a></div>
                <div class="clearfix"></div>
            </div>
    </div>
    
</div>
<script>
jQuery( 'input[name=payment_address]:checked' ).live('click',function(){    
    if(jQuery(this).val()=="new"){
        jQuery("#payment-new").show();
        jQuery("#payment-existing").hide();
    }
    else{
        jQuery("#payment-existing").show();
        jQuery("#payment-new").hide();
    }

})

</script>
