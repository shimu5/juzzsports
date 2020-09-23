<?php
/* 
 * This is the template page to display Customer Order list
 *
 */

?>
<?php  if ($customerOrderListObj) { // if has customer order list
    foreach($customerOrderListObj as $orderList):

    ?>
        <div class="block" style="background-color: #F5F8FC;margin-bottom: 30px;padding: 10px;">
            <div class="order-list" style="padding: 10px;">
                <div class="order-id" style="float: left;margin-bottom: 2px;width: 49%;"><b>Order ID:</b> #<?php echo $orderList['order_id'];?></div>
                <div class="order-status" style="float: right;margin-bottom: 2px;text-align: right;width: 49%;"><b>Status:</b> <?php echo $orderList['status_name'];?></div>
                <div class="order-content" style="border-bottom:1px solid #EEEEEE;border-top:1px solid #EEEEEE;display: inline-block;margin-bottom: 20px;padding:10px 0;width: 100%;">
                    <div style="float: left;width: 33.3%;">
                        <b>Date Added:</b> <?php echo $orderList['date_added'];?><br>
                        <b>Products:</b>  <?php echo $orderList['quantity'];?>
                    </div>
                    <div style="float: left;width: 33.3%;">
                        <b>Customer:</b> <?php echo $orderList['firstname'].' '.$orderList['lastname'];?><br>
                        <b>Total:</b> <?php echo $curr_row['symbol_left'];?> <?php echo number_format($orderList['total_price']*$curr_row['value'],2);?> </div>
                    <div class="order-info" style="float: left;width: 33.3%;text-align: right;">
                        <a href="order_details.php?type=view&order_id=<?php echo $orderList['order_id'];?>">
                            <img title="View" alt="View" src="../images/info.png">
                        </a>&nbsp;&nbsp;
                        <a href="../invoice/index.php?order_id=<?php echo $orderList['order_id'];?>">
                            <img title="invoice" alt="Invoice" src="../images/invoice.png">
                        </a>
                    </div>
                </div>
            </div>
        </div>

<?php
        endforeach;
} else {
    echo "<div class='alert alert-info' style='margin-bottom: 200px;'>There are no Order.</div>";
}
?>
<?php  CustomerManager::showCustomerTransactionPagination($page, $sessUserId, ""); //pagination ?>