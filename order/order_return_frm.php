<?php
/**
 * Order Return form
 *
 * Date: 6/11/14
 * Time: 3:01 PM
 */

?>

<!--  Product Order Return form goes here  -->
<div class="order-return col-lg-9 no-padding col-left">
<form class="form-horizontal" action="return.php?order_id=<?php echo intval($orderInfoArr['order_id']) ?>&product_id=<?php echo intval($orderInfoArr['product_id']) ?>" method="post" name="returnOrderForm" id="return-order-form">
<div class="col-lg-12 info-section">
    <input type="hidden" name="customer_id" value="<?php echo intval($orderInfoArr['customer_id'])?>">
    <input type="hidden" name="product_id" value="<?php echo intval($orderInfoArr['product_id'])?>">
    <input type="hidden" name="date_ordered" value="<?php echo $orderInfoArr['date_added']?>">
    <h4>Order Information</h4>
    <div class="form-group">
        <label for="firstname" class="col-sm-3 control-label">First Name: <span class="required">*</span></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo (isset($orderInfoArr['firstname']))?($orderInfoArr['firstname']):''?>">
            <?php echo ($errorOccur && $errorArr['firstname'] ? '<div class="alert alert-error" for="firstname">'.$errorArr['firstname'].'</div>' : '')?>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-3 control-label ">Last Name: <span class="required">*</span></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo (isset($orderInfoArr['lastname']))?($orderInfoArr['lastname']):''?>">
            <?php echo ($errorOccur && $errorArr['lastname'] ? '<div class="alert alert-error" for="lastname">'.$errorArr['lastname'].'</div>' : '')?>
        </div>
    </div>
    <div class="form-group">
        <label for="E-mail" class="col-sm-3 control-label ">E-mail: <span class="required">*</span></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="email" name="email" value="<?php echo (isset($orderInfoArr['email']))?($orderInfoArr['email']):''?>">
            <?php echo ($errorOccur && $errorArr['email'] ? '<div class="alert alert-error" for="email">'.$errorArr['email'].'</div>' : '')?>
        </div>
    </div>
    <div class="form-group">
        <label for="Telephone" class="col-sm-3 control-label ">Telephone: <span class="required">*</span></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo (isset($orderInfoArr['telephone']))?($orderInfoArr['telephone']):''?>">
            <?php echo ($errorOccur && $errorArr['telephone'] ? '<div class="alert alert-error" for="telephone">'.$errorArr['telephone'].'</div>' : '')?>
        </div>
    </div>
    <div class="form-group">
        <label for="Fax" class="col-sm-3 control-label">Order Id: <span class="required">*</span> </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="order_id" name="order_id" value="<?php echo (isset($orderInfoArr['order_id']))?($orderInfoArr['order_id']):''?>">
            <?php echo ($errorOccur && $errorArr['order_id'] ? '<div class="alert alert-error" for="order">'.$errorArr['order_id'].'</div>' : '')?>
        </div>
    </div>
    <div class="form-group">
        <label for="Fax" class="col-sm-3 control-label">Order Date: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="date_added" name="date_added" value="<?php echo (isset($orderInfoArr['date_added']))?($orderInfoArr['date_added']):''?>">
        </div>
    </div>
</div>
<div class="col-lg-12 info-section" style="margin-top: 20px;">
    <h4>Order Information</h4>
    <div class="form-group">
        <label for="product" class="col-sm-3 control-label">Product Name: <span class="required">*</span></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="product" name="product" value="<?php echo (isset($orderInfoArr['name']))?($orderInfoArr['name']):''?>">
            <?php echo ($errorOccur && $errorArr['product'] ? '<div class="alert alert-error" for="product name">'.$errorArr['product'].'</div>' : '')?>
        </div>
    </div>
    <div class="form-group">
        <label for="model" class="col-sm-3 control-label ">Product Code: <span class="required">*</span></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="model" name="model" value="<?php echo (isset($orderInfoArr['model']))?($orderInfoArr['model']):''?>">
            <?php echo ($errorOccur && $errorArr['model'] ? '<div class="alert alert-error" for="Product code">'.$errorArr['model'].'</div>' : '')?>
        </div>
    </div>
    <div class="form-group">
        <label for="quantity" class="col-sm-3 control-label ">Quantity: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo (isset($orderInfoArr['quantity']))?($orderInfoArr['quantity']):''?>">
        </div>
    </div>
    <div class="form-group">
        <label for="opened" class="col-sm-3 control-label ">Product is opened:</label>
        <div class="col-sm-8" style="padding-top:7px;">
            <input class="" type="radio" value="1" name="opened" style="padding:0;margin:0;">
            <label for="opened" style="padding:0 5px;margin:0;">Yes</label>
            <input class="" type="radio" value="0" checked="checked" name="opened" style="padding:0;margin:0;">
            <label for="unopened" style="padding:0 20px 0 5px;margin:0;">No</label>
        </div>
    </div>
    <div class="form-group">
        <label for="reason for return" class="col-sm-3 control-label ">Reason for Return: <span class="required">*</span></label>
        <div class="col-sm-8">
            <select class="form-control" name="return_reason_id" id="return_reason_id">
                <option value="">Select return reason</option>
                <?php foreach($returnReasonStatus as $key=>$status):?>
                    <option value="<?php echo $key ?>"><?php echo $status ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo ($errorOccur && $errorArr['return_reason_id'] ? '<div class="alert alert-error" for="return reason">'.$errorArr['return_reason_id'].'</div>' : '')?>
        </div>
    </div>
    <div class="form-group">
        <label for="comment" class="col-sm-3 control-label">Comment: </label>
        <div class="col-sm-8">
            <textarea rows="6" cols="" style="width: 100%;" name="comment"></textarea>
        </div>
    </div>
</div>
<div class="buttons-set">
    <p class="required">* Required Fields</p>
    <button title="Submit" id="save_btn" class="button"><span><span>Submit</span></span></button>
</div>
</form>
</div>


