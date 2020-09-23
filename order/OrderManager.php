<?php
/**
 *
 * OrderManager Manager Class
 * OrderManager will manage all about us static page information
 *
 * @package     Order Manager
 * @category    Manager
 * @author
 * @date        10/6/2014
 *
 * 
 */
require_once ROOT . "functions/Connection.php";
require_once ROOT . "classes/OrderList.php";
require_once ROOT . "classes/ReturnList.php";
require_once ROOT . "classes/ReturnHistory.php";


class OrderManager {
    /**
     *
     * OrderList array
     *
     * @return array
     */
    public static function getOrderStatus()
    {
        $query  = "SELECT `order_status_id`,`status_name` FROM `order_status`";
        $statusList = Connection::getAllDataByQuery($query);
        $statusArr = array();
        foreach($statusList as $status)
        {
            $statusArr[$status['order_status_id']] = $status['status_name'];
        }
        return $statusArr;
    }

    public static function saveOrderReturn($data){
        $objReturnList = new ReturnList();

        $objReturnList->setOrderId($data["order_id"]);
        $objReturnList->setProductId($data["product_id"]);
        $objReturnList->setCustomerId($data["customer_id"]);
        $objReturnList->setFirstname($data["firstname"]);
        $objReturnList->setLastname($data["lastname"]);
        $objReturnList->setEmail($data["email"]);
        $objReturnList->setTelephone($data["telephone"]);
        $objReturnList->setProduct($data["product"]);
        $objReturnList->setModel($data["model"]);
        $objReturnList->setQuantity($data["quantity"]);
        $objReturnList->setOpened($data["opened"]);
        $objReturnList->setReturnReasonId($data["return_reason_id"]);
        $objReturnList->setReturnActionId($data["return_action_id"]);
        $objReturnList->setReturnStatusId($data["return_status_id"]);
        $objReturnList->setComment($data["comment"]);
        $objReturnList->setDateOrdered($data["date_ordered"]);
        $objReturnList->setDateAdded($data["date_added"]);
        $objReturnList->setDateModified($data["date_modified"]);
        if($objReturnList->save()){
            $objReturnHistory = new ReturnHistory();
            $objReturnHistory->setReturnId($objReturnList->getReturnId());
            $objReturnHistory->setReturnStatusId($data["return_status_id"]);
            $objReturnHistory->setNotify($data["notify"]);
            $objReturnHistory->setComment($data["comment"]);
            $objReturnHistory->setDateAdded($data["date_added"]);

            return $objReturnHistory->save();
        }
    }



    /**
     * Get list of Customer order
     *
     * @param $customerId
     * @param $start
     * @param $limit
     * @return array|bool
     */
    public static function getCustomerOrderList($customerId,$start,$limit){
        return OrderList::getCustomerOrderList($customerId,$start,$limit);
    }

    /**
     * Get Customer order details
     * @param $orderId
     * @param $customerId
     * @return array|bool
     */
    public static function getCustomerOrderDetail($orderId,$customerId){
        return OrderList::getCustomerOrderDetail($orderId,$customerId);
    }

    /**
     * get order infromeation
     * @param $customerId
     * @param $productId
     * @param $orderId
     * @return array|bool
     */
    public static function getReturnOrderInfo($customerId,$productId,$orderId){
        return OrderList::getReturnOrderInfo($customerId,$productId,$orderId);
    }

    /**
     * get all product of by orderId
     * @param $orderId
     * @return array|bool
     */
    public static function getCustomerOrderProduct($orderId){
        return OrderList::getCustomerOrderProduct($orderId);
    }

    /**
     * Get customer order history
     * @param $orderId
     * @return array|bool
     */
    public static function getCustomerOrderHistory($orderId){
        return OrderList::getCustomerOrderHistory($orderId);
    }

    /**
     * get page number
     * @return int
     */
    public static function getPageLimit()
    {
        return 50;//Connection::$PageLimit; //how many items to show per page
    }

    public static function getReturnReasonStatus(){
        return Connection::getAllDataByQuery("SELECT `return_reason_id`,`name` FROM `return_reason`");
    }

}

// End Class 
?>