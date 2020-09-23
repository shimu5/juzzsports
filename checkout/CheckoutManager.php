<?php

/**
 *
 * CheckoutManager Manager Class
 * CheckoutManager will manage all about us static page information
 *
 * @package     Checkout Manager
 * @category    Manager
 * @author
 * @date        28/05/2014
 *
 *
 */
//require_once ROOT . "functions/Connection.php";

require_once ROOT . "classes/Country.php";
require_once ROOT . "classes/Zone.php";
require_once ROOT . "classes/Customer.php";
require_once ROOT . "classes/Product.php";
require_once ROOT . "classes/CustomerAddress.php";
require_once ROOT . "classes/CustomerReward.php";
require_once ROOT . "classes/OrderList.php";
require_once ROOT . "classes/Store.php";
require_once ROOT . "classes/Country.php";
require_once ROOT . "classes/Zone.php";
require_once ROOT . "classes/PaymentMethod.php";
require_once ROOT . "classes/DeliveryMethod.php";
require_once ROOT . "classes/OrderProduct.php";
require_once ROOT . "classes/OrderTotal.php";
require_once ROOT . "classes/OrderHistory.php";
//require_once ROOT ."phpmailer/Mailer.php";


class CheckoutManager {
    
    public static function getCountries($pageType , $pageName) {
        return Country::load();
    }

    public static function getCustomerAddressByCustomerId($sessUserId){
       
        return CustomerAddress::getCustomerAddressByCustomerId($sessUserId);
    }


    public static function saveCustomerAddress($resultRow) {
        
        $customerId = $resultRow['customer_id'];       
        $objCustomerAddress = new CustomerAddress();
        $objCustomerAddress->setAddressId($resultRow["address_id"]);
        $objCustomerAddress->setCustomerId($customerId);
        $objCustomerAddress->setFirstname($resultRow["firstname"]);
        $objCustomerAddress->setLastname($resultRow["lastname"]);
        $objCustomerAddress->setCompany($resultRow["company"]);
        $objCustomerAddress->setCompanyId($resultRow["company_id"]);
        $objCustomerAddress->setTaxId($resultRow["tax_id"]);
        $objCustomerAddress->setAddress1($resultRow["address_1"]);
        $objCustomerAddress->setAddress2($resultRow["address_2"]);
        $objCustomerAddress->setCity($resultRow["city"]);
        $objCustomerAddress->setPostcode($resultRow["postcode"]);
        $objCustomerAddress->setCountryId($resultRow["country"]);
        $objCustomerAddress->setZoneId($resultRow["zone_id"]);

        return $objCustomerAddress->save(); // Save customer detail information

    }

    /**
     * Save Cart products
     * insert a order list
     * Inser order product
     * Insert Customer reward point if not previously avaiable, if available then save
     * Insert Cart Total as sub total in order total, then add for shipments total and then for total
     * Inser order history
     */

    public static function saveToCart($cart_products,$order, $total_price,$currency,$ses_id){
        $error = array();
        foreach($cart_products as $product){
            $prod = Product::productById($product['product_id']);
            //$latest_products_info[$product['product_id']] = $prod;            
            if($product['cart_quantity'] > $prod['quantity']){                
                $error['error'] .= "{$product['name']} , Quantity: {$product['cart_quantity']} not Available, \n";
            }
        }
        if(!empty($error)){ $error['success'] = false; echo json_encode($error); die; }


        if(!isset($order['shipping_address_id']) || !isset($order['billing_address_id']) || !isset($order['payment_method']) || !isset($order['shipping_method'])){
            $error['success'] = false;
            $error['error'] = 'Fill Order Steps';
            //pr($order);
            echo json_encode($error);
            die; 
        }
         
        
        $sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);
        if($sessUserId!=$order['customer_id']){
            $error['success'] = false;
            $error['error'] = 'Please login to correct user';            
        }
       
        
       
        //$store = Store::loadById(2);
        $store = Store::load($start = 1, $limit = 1);
        $store = $store[0];
        if(empty($store)){
            $error['success'] = false;
            $error['error'] = 'Please login to correct user';
            echo json_encode($error);
            die; 
        }
        $customer = Customer::loadById($order['customer_id']);
        $store_url = BASE_URL."admins/store/index.php?id=1";      

        $paddress = CustomerAddress::loadById($order['billing_address_id']);
        $shipaddress = CustomerAddress::loadById($order['shipping_address_id']);
        $payment_country_name = Country::loadById( $paddress->getCountryId() );
        $ship_country_name = Country::loadById( $shipaddress->getCountryId() );
        $payment_zone_name = Zone::loadById($paddress->getZoneId());
        $ship_zone_name = Zone::loadById($shipaddress->getZoneId());
        $PaymentMethod = PaymentMethod::loadByCode($order['payment_method']);
        $shippingMethod = DeliveryMethod::loadByCode($order['shipping_method']);
        $date_added = date('Y-m-d H:i:s', time());

        if(empty($PaymentMethod)){
            $error['success'] = false;
            $error['error'] = 'Select Payment method';
            echo json_encode($error);
            die; 
        }

        
        if(empty($shippingMethod)){
            $error['success'] = false;
            $error['error'] = 'Select Shipping method';
            echo json_encode($error);
            die; 
        }

       
       
       
        $objOrderList = new OrderList();       
        $objOrderList->setInvoiceNo(0);
        $objOrderList->setInvoicePrefix("INV-".date("Y-m"));
        $objOrderList->setStoreId(0);
        $objOrderList->setStoreName($store->getName());
        $objOrderList->setStoreUrl($store_url);
        $objOrderList->setCustomerId($customer->getCustomerId());
        $objOrderList->setCustomerGroupId($customer->getCustomerGroupId());
        $objOrderList->setFirstname($customer->getFirstname());
        $objOrderList->setLastname($customer->getLastname());
        $objOrderList->setEmail($customer->getEmail());
        $objOrderList->setTelephone($customer->getTelephone());
        $objOrderList->setFax($customer->getFax());
        $objOrderList->setPaymentFirstname($paddress->getFirstname());
        $objOrderList->setPaymentLastname($paddress->getLastname());
        $objOrderList->setPaymentCompany($paddress->getCompany());
        $objOrderList->setPaymentCompanyId($paddress->getCompanyId());
        $objOrderList->setPaymentTaxId($paddress->getTaxId());
        $objOrderList->setPaymentAddress1($paddress->getAddress1());
        $objOrderList->setPaymentAddress2($paddress->getAddress2());
        $objOrderList->setPaymentCity($paddress->getCity());
        $objOrderList->setPaymentPostcode($paddress->getPostcode());
        $objOrderList->setPaymentCountry($payment_country_name->getName());
        $objOrderList->setPaymentCountryId($paddress->getCountryId());
        $objOrderList->setPaymentZone($payment_zone_name->getName());       
        $objOrderList->setPaymentZoneId($paddress->getZoneId());
        $objOrderList->setPaymentAddressFormat('');
        $objOrderList->setPaymentMethod($PaymentMethod->getName());      
        $objOrderList->setPaymentCode($order['payment_method']);
        $objOrderList->setPaymentComment($order["payment_comment"]);
        $objOrderList->setBankName($order["bank_name"]);
        $objOrderList->setBankAcountNo($order["bank_acount_no"]);
        $objOrderList->setShippingFirstname($shipaddress->getFirstname());
        $objOrderList->setShippingLastname($shipaddress->getLastname());
        $objOrderList->setShippingCompany($shipaddress->getCompany());
        $objOrderList->setShippingAddress1($shipaddress->getAddress1());
        $objOrderList->setShippingAddress2($shipaddress->getAddress2());
        $objOrderList->setShippingCity($shipaddress->getCity());         
        $objOrderList->setShippingPostcode($shipaddress->getPostcode());
        $objOrderList->setShippingCountry($ship_country_name->getName());
        $objOrderList->setShippingCountryId($shipaddress->getCountryId());
        $objOrderList->setShippingZone($ship_zone_name->getName());
        $objOrderList->setShippingZoneId($shipaddress->getZoneId());
        $objOrderList->setShippingAddressFormat('');
        $objOrderList->setShippingMethod($shippingMethod->getMethodName());
        $objOrderList->setShippingCode($order['shipping_method']);
        $objOrderList->setComment($order['shipping_comment']); //$order['shipping_comment']
        $objOrderList->setTotal($total_price);
        $objOrderList->setOrderStatusId(1);
        $objOrderList->setAffiliateId(0);
        $objOrderList->setCommission(0);
        $objOrderList->setLanguageId(1);
        $objOrderList->setCurrencyId($currency["currency_id"]);
        $objOrderList->setCurrencyCode($currency["code"]);
        $objOrderList->setCurrencyValue($currency["value"]);
        $objOrderList->setIp($_SERVER['REMOTE_ADDR']);
        $objOrderList->setForwardedIp('');
        $objOrderList->setUserAgent($_SERVER["HTTP_USER_AGENT"]);
        $objOrderList->setAcceptLanguage($_SERVER['HTTP_ACCEPT_LANGUAGE']);
        $objOrderList->setDateAdded($date_added);
        $objOrderList->setDateModified($date_added);
        $objOrderList->setCbaFreeShipping(0);
        

        
        $result = $objOrderList->save();        
        $order_id = $objOrderList->getOrderId();
        
        if($result['success']){            
            $customer_reward = $cart_total_price = 0;

            // order Product insertion
            if(!empty($cart_products))
            foreach($cart_products as $k=>$product){
                $cart_product_price_total = $price= 0;
                $objOrderProduct = new OrderProduct();
                //$objOrderProduct->setOrderProductId($resultRow["order_product_id"]);
                $objOrderProduct->setOrderId($order_id);
                $objOrderProduct->setProductId($product["product_id"]);
                $objOrderProduct->setName($product["name"]);
                $objOrderProduct->setModel($product["manufacture_name"]);
                $objOrderProduct->setQuantity($product["cart_quantity"]);
                $objOrderProduct->setSize($product["product_size"]);
                if($product['product_discount_id']!=NULL)
                    $price = ($product["discount_price"]*$currency['value']);
                else                    
                    $price = ($product["price"]*$currency['value']);
                    
                $objOrderProduct->setPrice($price);
                $cart_product_price_total = $price*$product["cart_quantity"];
                $cart_total_price +=$cart_product_price_total;
                $objOrderProduct->setTotal($cart_product_price_total);
                $objOrderProduct->setTax(0);
                $objOrderProduct->setReward(($product["points"]*$product["cart_quantity"]));
                $customer_reward += intval($product["points"]);                
                $result_prod = $objOrderProduct->save();
                $objOrderProduct->getOrderProductId();

                $order_products[] = "{$product["name"]} - {$product["cart_quantity"]} - {$currency['code']}{$price} ";
            }           

            // order Reward insertion
            if($customer_reward>0){
                $custrewardinfo = CustomerReward::fetchByCustomerId($customer->getCustomerId());
                $objCustomerReward = new CustomerReward();
                if(!empty($custrewardinfo) && $custrewardinfo->getCustomerRewardId()>0)
                    $objCustomerReward->setCustomerRewardId($custrewardinfo->getCustomerRewardId());
                $objCustomerReward->setCustomerId($customer->getCustomerId());
                $objCustomerReward->setOrderId(1);
                $objCustomerReward->setDescription("Reward point");
                $objCustomerReward->setPoints($customer_reward);
                $objCustomerReward->setDateAdded($date_added);
                $objCustomerReward->save();
            }

            // order Total insertion only shipping implement
          

            $objOrderTotal = new OrderTotal();
            $objOrderTotal->setOrderId($order_id);
            $objOrderTotal->setCode('sub_total');
            $objOrderTotal->setTitle('Sub-Total');
            $objOrderTotal->setText($cart_total_price);
            $objOrderTotal->setValue($cart_total_price);
            $objOrderTotal->setSortOrder(1);
            $objOrderTotal->save();
          

            $objOrderTotal = new OrderTotal();
            $objOrderTotal->setOrderId($order_id);
            $objOrderTotal->setCode($shippingMethod->getDeliveryMethodCode());
            $objOrderTotal->setTitle($shippingMethod->getMethodName());
            $objOrderTotal->setText($shippingMethod->getMethodName());
            $ship_rate = $shippingMethod->getCost()*$currency['value'];
            $objOrderTotal->setValue($ship_rate);
            $objOrderTotal->setSortOrder(2);
            $result = $objOrderTotal->save();

            $objOrderTotal = new OrderTotal();
            //$objOrderTotal->setOrderTotalId($resultRow["order_total_id"]);
            $objOrderTotal->setOrderId($order_id);
            $objOrderTotal->setCode('total');
            $objOrderTotal->setTitle('Total');
            $objOrderTotal->setText(($cart_total_price+$ship_rate));
            $objOrderTotal->setValue(($cart_total_price+$ship_rate));
            $objOrderTotal->setSortOrder(3);
            $result = $objOrderTotal->save();
            
            // Order Hisory Entry
            $objOrderHistory = new OrderHistory();           
            $objOrderHistory->setOrderId($order_id);
            $objOrderHistory->setOrderStatusId(1);
            $objOrderHistory->setNotify(1);
            $objOrderHistory->setComment($order['payment_comment']);
            $objOrderHistory->setDateAdded($date_added);
            $result = $objOrderHistory->save();          
            unset($_SESSION[$ses_id]['Order']);
            unset($_SESSION[$ses_id]['Products']);
            unset($_SESSION[$ses_id]['Cart_Total_Price']);
            $customerinfo = Customer::loadById($customer->getCustomerId());
            $result = Customer::saveCart($customer->getCustomerId(), serialize(array()));
            $result['result'] = "Succes submit";

            $order_products_str = implode(", \n", $order_products);

            /*$mailObj = new Mailer();
            $from = $customer->getEmail();                       
            $fromname = $customer->getFirstname(). " ".$customer->getLastname();
           
            $subject = sprintf(CART_CHECKOUT_SUBJECT,$order_id);
            $body = sprintf(CART_CHECKOUT_BODY,$order_products_str);
            $mailObj->setMailAddress($from, $fromname);
            $mailObj->setMailSubject($subject);
            $mailObj->setMailBody(sprintf(CART_CHECKOUT_BODY,$order_products_str));
            //pr($mailObj); die("d");           
            //if(!$mailObj->MailSend($from,$fromname,$subject,$body)){
            if(!$mailObj->MailSend()){
                $result['error'] = "Mail can\'t send ! Order Submit. \n Check your Account Order history";
                $result['success']=false;
                echo json_encode($result);
                die;
            }*/

            $result['order_id'] = $order_id;
            $result['success']=true;
            
            echo json_encode($result);
            die;

            
        }


    }

    
}