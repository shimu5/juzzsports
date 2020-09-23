
<div class="column">
<p>Please select the preferred shipping method to use on this order.</p>
<table class="radio">
<tbody>

<?php $dmethod = DeliveryMethod::load(0, 1);  $dmethod = $dmethod[0]; ?>


<?php if($dmethod->getDeliveryMethodCode()!=""): ?>
<tr>
<td colspan="3"><b>Flat Rate</b></td>
</tr>
<tr class="highlight">
    <td><input type="radio" checked="checked" id="<?php echo $dmethod->getDeliveryMethodCode(); ?>" value="<?php echo $dmethod->getDeliveryMethodCode(); ?>" name="shipping_method"></td>
    <td><label for="<?php echo $dmethod->getDeliveryMethodCode(); ?>"><?php echo $dmethod->getMethodName(); ?></label></td>
    <td style="text-align: right;"><label for="flat.flat"><?php echo $cur_symb ?><?php echo ($dmethod->getCost()*$cur_rate); ?></label></td>
</tr>
<?php else: ?>
<tr class="highlight"><td colspan="3"><b>Please add a delivery method correctly</b></td></tr>
<?php endif; ?>


</tbody>
</table>
<div><b>Add Comments About Your Order</b><br/>
    <textarea style="width: 98%;" rows="8" name="shipping_comment"></textarea>
</div>

<div class="button_blocks">
    <div class="right"><a class="btn" id="button-shipping-method">Continue</a></div>
    <div class="clearfix"></div>
</div>
</div>
