<div class="column">
    <p><b>Please select the preferred payment method to use on this order.</b></p>
    <?php $pmethod = PaymentMethod::load(); ?>
    <table>
        <tbody>
        <tr class="highlight">
            <!--<td><input type="radio" checked="checked" id="<?php //echo $pmethod->getpaymentMethodCode(); ?>" value="<?php //echo $pmethod->getpaymentMethodCode(); ?>" name="payment_method"></td>-->
            <td><?php if (!empty($pmethod)): ?>
                    <select name="payment_method" id="payment_method_select" class="form-control">
                        <!--<option value="">Select Payment Method</option>-->
                        <?php foreach ($pmethod as $mehtod): ?>
                            <option
                                value="<?php echo $mehtod->getpaymentMethodCode(); ?>"><?php echo $mehtod->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?></td>
            <!--<td><label for="cod">Cash On Delivery</label></td>-->
        </tr>
        </tbody>
    </table>
    <br/>
    <div id="payment_method_div" class="alert" style="display: none;"></div>
    <div id="payment_user_account" style="display: none;">
            <div class="form-group">
                <label class="col-sm-3 control-label " for="bank_name">Bank Name: <span class="required">*</span></label>
                <div class="col-sm-3">
                    <input type="text" name="bank_name" id="bank_name" class="form-control" disabled>
                    <!--<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;"></div>-->
                </div>
                <div style="clear:both"></div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="bank_acount_no">Bank Account: <span class="required">*</span></label>
                <div class="col-sm-3">
                    <input type="text" name="bank_acount_no" id="bank_acount_no" class="form-control" disabled >
                    <!--<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;"></div>-->
                </div>
                <div style="clear:both"></div>
           </div>
        <div style="clear:both"></div>
    </div>
    <div id="bank_information"><b>Add Comments About Your Order</b></div>
    <br/>
    <textarea style="width: 98%;" rows="8" name="payment_comment" id="payment_comment">

    </textarea>

    <div class="button_blocks">
        <div class="right">I have read and agree to the <a alt="Terms &amp; Conditions"
                                                           href="<?php echo BASE_URL . "terms_n_conditions.php" ?>"
                                                           class="colorbox cboxElement" target="_blank"><b>Terms &amp;
                    Conditions</b></a>
            <input type="checkbox" value="1" name="agree" id="terms_n_condition">
            <a class="btn" id="button-payment-method">Continue</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
