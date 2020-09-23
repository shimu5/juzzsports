<?php
/**
 *
 * Date: 6/11/14
 * Time: 11:03 AM
 */

?>
<style>
    table tr td{padding: 7px;}
    table tr th{
        padding: 7px;
        background:#FDFDFF;
    }
</style>
<?php $orderDetail = $customerOrderDetail; ?>
<div class="column" style="margin:0;">
    <table class="" style="background:#FDFDFF;border: 1px solid #F5F8FC;margin-bottom: 30px;width: 100%;">
        <tr>
            <th colspan="2" class="left" style="width:100%;background:#F5F8FC">Order Details</th>
        </tr>
        <tr>
            <td style="width: 50%;" class="left">
                <b>Order ID:</b> #<?php echo $orderDetail['order_id'] ?><br>
                <b>Date Added:</b> <?php echo $orderDetail['date_added'] ?>
            </td>
            <td style="width: 50%;" class="left">
                <b>Payment Method:</b> <?php echo $orderDetail['payment_method'] ?><br>
                <b>Shipping Method:</b> <?php echo $orderDetail['shipping_method'] ?>
            </td>
        </tr>
    </table>

    <table class="" style="background:#FDFDFF;border: 1px solid #F5F8FC;margin-bottom: 30px;width: 100%;">
        <tr>
            <th class="left"style="width:50%;background:#F5F8FC">Payment Address</th>
            <th class="left"style="width:50%;background:#F5F8FC">Shipping Address</th>
        </tr>
        <tr>
            <td class="left" style="width:50%;">
                <?php echo $orderDetail['firstname'].' '.$orderDetail['lastname'] ?>
                <?php echo ($orderDetail['payment_company'])?$orderDetail['payment_company'].'</br>':'' ?>
                <?php echo ($orderDetail['payment_address_1'])?$orderDetail['payment_address_1'].'</br>':'' ?>
                <?php echo ($orderDetail['payment_address_2'])?$orderDetail['payment_address_2'].'</br>':'' ?>
                <?php echo ($orderDetail['payment_city'])?$orderDetail['payment_city'].'</br>':'' ?>
                <?php echo ($orderDetail['payment_country'])?$orderDetail['payment_country'].'</br>':'' ?>
            </td>
            <td class="left" style="width:50%;">
                <?php echo $orderDetail['shipping_firstname'].' '.$orderDetail['shipping_lastname'] ?>
                <?php echo ($orderDetail['shipping_company'])?$orderDetail['shipping_company'].'</br>':'' ?>
                <?php echo ($orderDetail['shipping_address_1'])?$orderDetail['shipping_address_1'].'</br>':'' ?>
                <?php echo ($orderDetail['shipping_address_2'])?$orderDetail['shipping_address_2'].'</br>':'' ?>
                <?php echo ($orderDetail['shipping_city'])?$orderDetail['shipping_city'].'</br>':'' ?>
                <?php echo ($orderDetail['shipping_country'])?$orderDetail['shipping_country'].'</br>':'' ?>
            </td>
        </tr>
    </table>
    <table class="" style="background:#FDFDFF;border: 1px solid #F5F8FC;margin-bottom: 30px;width: 100%;">
        <tr>
            <th class="" style="width:55%;background:#F5F8FC">Product Name</th>
            <th class="" style="width:10%;background:#F5F8FC">Model</th>
            <th class="" style="width:10%;background:#F5F8FC">Quantity</th>
            <th class=""style="width:10%;background:#F5F8FC">Price</th>
            <th class=""style="width:10%;background:#F5F8FC">Total</th>
            <?php if($returnShow){?><th style="width:5%;;background:#F5F8FC"></th><?php }?>
        </tr>
        <?php foreach($orderProduct as $key=>$product): ?>
            <tr>
                <td class="" style="width:55%;"><?php echo $product['name'] ?></td>
                <td class=""style="width:10%;"><?php echo $product['model'] ?></td>
                <td class=""style="width:10%;"><?php echo $product['quantity'] ?></td>
                <td class=""style="width:10%;"><?php echo $product['price'] ?></td>
                <td class=""style="width:10%;"><?php echo $product['total'] ?></td>
                <?php if($returnShow){ ?>
                <td class=""style="width:5%;">
                    <a href="../order/return.php?order_id=<?php echo $product['order_id'] ?>&product_id=<?php echo $product['product_id'] ?>">
                        <img title="Return" alt="Return" src="../images/return.png">
                    </a>
                </td>
                <?php }?>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="block" style="background:#F5F8FC;">
        <h2 style="padding:7px;font-weight: bold;margin:0;">Order History</h2>

        <table class="" style="background:#FDFDFF;border: 1px solid #F5F8FC;margin-bottom: 30px;width: 100%;">
            <tr>
                <th class="" style="width:20%;border-bottom:1px solid #D5D5D5;">Date Added</th>
                <th class=""style="width:20%;border-bottom:1px solid #D5D5D5;">Status</th>
                <th class=""style="width:60%;border-bottom:1px solid #D5D5D5;">Comment</th>
            </tr>
            <?php foreach($orderHistory as $key=>$history): ?>
                <tr>
                    <td class=""><?php echo $history['date_added']?></td>
                    <td class=""><?php echo $history['status_name']?></td>
                    <td class=""><?php echo $history['comment']?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>


    <div class="" style="background-color: #F5F8FC;margin-bottom: 30px; padding:10px;">
        <div class="right"><a class="btn" href="../index.php?s=1&p=1">Continue</a></div>
        <div class="clearfix"></div>
    </div>

</div>