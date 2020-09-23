<?php
session_start();

require_once ROOT . "classes/OrderList.php";
require_once ROOT . "classes/Currency.php";
require_once ROOT . "classes/PaymentMethod.php";
require_once ROOT . "classes/OrderTotal.php";
if (empty($_GET['order_id']))
    redirectPage("../index.php?s=1&p=1");
$order = OrderList::loadById(intval($_GET['order_id']));

$sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);
$customerId = $order->getCustomerId();
if (empty($order) || $customerId != $sessUserId)
    redirectPage("../index.php?s=1&p=1");
$invoice_inc = intval($order->getInvoiceNo()) + 1;
$order->setInvoiceNo($invoice_inc);
$order->save();

$customerinfo = Customer::loadById($customerId);
$currncy = Currency::loadById($order->getCurrencyId());
$cur_cod = $order->getCurrencyCode();
$sym_left = $currncy->getSymbolLeft();
$cur_sym = ($sym_left != "") ? $sym_left : $cur_cod;

?>
<style>    
    @import url(<?php echo ROOT."css/google_css.css"?>);

    .container h1, .container h1, .container h3, .container h4, .container h5, .container h6 {
        font-family: 'Bree Serif', serif;
    }

    .printbtn {
        width: 100px;
        border: 1px solid #000;
        background: #000;
        color: #FFF;
        padding: 5px;
        margin-left: 20px;
    }
</style>
<?php if(intval($_GET['checkout_status'])){
    echo '<div class="alert">
    <div>Your order has been successfully processed!</div>
    <div>You can view your <a href="../order/index.php">order history</a> by going to the my account page.</div>
    <div>Thanks for shopping with us online!</div>
    <div style="margin-top: 10px;"><a href="../index.php" class="btn btn-continue">Continue Shopping</a> </div>
    </div>';
}?>
<div style="margin-bottom: 20px;"></div>
<div class="row actions">
    <div style="float: right;"><input type="button" value="Print Invoice" onclick="javascript:printDiv('printablediv')" class="btn printbtn"/></div>
    <div style="clear: both;"></div>
</div>
<div class="container" style="background: #FFF;" id="printablediv">

    <div class="row">
        <div class="col-xs-6">
            <h1>
                <img src="<?php echo "../images/logo.png" ?>">
            </h1>
        </div>
        <div class="col-xs-6 text-right">
            <h1>INVOICE</h1>

            <h1>
                <small>Invoice # <?php echo sprintf("%003d", $invoice_inc) ?></small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>From: <a href="#"><?php echo $order->getFirstname() . " " . $order->getLastname() ?></a></h4>
                </div>
                <div class="panel-body">
                    <p>
                        Address : <?php echo $order->getPaymentAddress1() ?> <br>
                        <?php echo $order->getPaymentCountry(); ?> <br>
                        <?php echo $order->getPaymentPostcode(); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xs-5 col-xs-offset-2 text-right">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>To : <a
                            href="#"><?php echo $order->getShippingFirstname() . " " . $order->getShippingLastname() ?></a>
                    </h4>
                </div>
                <div class="panel-body">
                    <p>
                        Address : <?php echo $order->getShippingAddress1(); ?> <br>
                        <?php echo $order->getShippingCountry(); ?> <br>
                        <?php echo $order->getShippingPostcode(); ?> <br>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- / end client details section -->
    <?php $orderlist = OrderList::getAllOrderProductData(0, 0, " AND OL.order_id={$order->getOrderId()}"); ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th><h4>Description</h4></th>
            <th class="text-center"><h4>Qty</h4></th>
            <th class="text-center"><h4>Size</h4></th>
            <th class="text-right"><h4>Rate/Price</h4></th>
            <th class="text-right"><h4>Sub Total</h4></th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($orderlist)): ?>
            <?php foreach ($orderlist as $k => $orderproduct):  $cur_val = $orderproduct['currency_value'] ?>
                <tr>
                    <td><a href="#"><?php echo $orderproduct['name'] ?></a></td>
                    <td class="text-center"><?php echo $orderproduct['quantity'] ?></td>
                    <td class="text-center"><?php echo $orderproduct['size'] ?></td>
                    <td class="text-right"><?php echo $cur_sym ?><?php echo money_format($orderproduct['price'] * $orderproduct['currency_value']) ?></td>
                    <td class="text-right"><?php echo $cur_sym; ?><?php echo money_format($orderproduct['price'] * $orderproduct['quantity'] * $orderproduct['currency_value']) ?></td>
                </tr>

            <?php endforeach; ?>
        <?php endif; ?>

        </tbody>
    </table>

    <div class="row text-right">
        <div class="col-xs-2 col-xs-offset-8">
            <p>
                <?php $orderTotal = OrderTotal::loadByOrderId($order->getOrderId()); ?>
                <strong>
                    <?php foreach ($orderTotal as $total): ?>
                        <?php echo $total->getTitle(); ?>  <br>
                    <?php endforeach; ?>
                </strong>
            </p>
        </div>
        <div class="col-xs-2">
            <strong>
                <?php foreach ($orderTotal as $total): ?>
                    <?php echo $cur_sym; ?><?php $total = floatval($total->getValue()) * $cur_val;
                    echo money_format($total); ?>  <br>
                <?php endforeach; ?>
            </strong>
        </div>
    </div>

    <?php  if ($order->getPaymentCode() == "bank") : ?>
        <div class="row">
            <div class="col-xs-5">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4>Bank details</h4>
                    </div>
                    <div class="panel-body">
                        Bank Name : <?php echo $order->getBankName(); ?><br/>
                        Bank Account No: <?php echo $order->getBankAcountNo(); ?><br/>
                        
                    </div>
                </div>
            </div>
            <?php if(trim($order->getPaymentComment())!=""): ?>
            <div class="col-xs-7">
                <div class="span7">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h4>Payment Comments</h4>
                    </div>
                    <div class="panel-body">
                      <p>
                        <?php echo nl2br(trim($order->getPaymentComment())); ?>
                      </p>                     
                    </div>
                  </div>
                </div>
            </div>
             <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="row text-center" style="padding: 20px; margin-top: 70px;"><h1><small>Thank you for shopping with JuzzSports! We hope to see you again!</small></h1></div>
</div>


<script>

    function printDiv(divID) {
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        document.body.innerHTML =
            "<html><head><title></title></head><body>" +
                divElements + "</body>";

        //Print Page
        window.print();

        //Restore orignal HTML
        document.body.innerHTML = oldPage;
        // window.print();

    }
</script>
