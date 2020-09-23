<?php
session_start();
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT ."settings.php";
require_once "CheckoutManager.php";
require_once ROOT ."phpmailer/Mailer.php";

$sessUserId = (isset($_SESSION['sess_user_id']) ? $_SESSION['sess_user_id'] : 0);


/**
 * In checkout steps for ajax Route
 * if they get route information with post data that will be set in session order
 * if no post data then will show order step forms depend on route/steps
 */

/*if($_GET['route']=="login"){
    pr($_POST);
    die;
}
else*/
//pr($_GET);
if($_GET['route']=="payment_address"){    
    
    if(isset($_POST[$_GET['route']])){ //ajax request
        if($_POST[$_GET['route']]=="new"){
            unset($_POST['address_id']);
            $_POST['customer_id'] = $sessUserId;
            $result = CheckoutManager::saveCustomerAddress($_POST);           
            $_SESSION[$ses_id]['Order']['billing_address_id'] = $result['last_insert_id'];
            echo json_encode($result);            

        }
        else{            
            $_SESSION[$ses_id]['Order']['billing_address_id'] = $_POST['address_id'];
        }
    }
    else
        include_once 'checkout_steps_1_billing_details.php';
}
elseif($_GET['route']=="shipping_address"){
    if(isset($_POST[$_GET['route']])){
        if($_POST[$_GET['route']]=="new"){
            unset($_POST['address_id']);
            $_POST['customer_id'] = $sessUserId;
            $result = CheckoutManager::saveCustomerAddress($_POST);
            $_SESSION[$ses_id]['Order']['shipping_address_id'] = $result['last_insert_id'];
            echo json_encode($result);

        }
        else{            
            $_SESSION[$ses_id]['Order']['shipping_address_id'] = $_POST['address_id'];
        }
    }
    else
        include_once 'checkout_steps_1_shipping_details.php';
}
elseif($_GET['route']=="shipping_method"){
    if(isset($_POST[$_GET['route']])){                
        $_SESSION[$ses_id]['Order']['shipping_method'] = $_POST['shipping_method'];
        $_SESSION[$ses_id]['Order']['shipping_comment'] = $_POST['shipping_comment'];
    }
    else
        include_once 'checkout_steps_4_shipping_method.php';
}
elseif($_GET['route']=="payment_method"){
    if(isset($_POST[$_GET['route']])){
        $_SESSION[$ses_id]['Order']['payment_method'] = $_POST['payment_method'];
        $_SESSION[$ses_id]['Order']['payment_comment'] = $_POST['payment_comment'];
        if($_POST['payment_method']=="bank"){
            $_SESSION[$ses_id]['Order']['bank_name']= $_POST['bank_name'];
            $_SESSION[$ses_id]['Order']['bank_acount_no']= $_POST['bank_acount_no'];
        }
       // pr($_SESSION[$ses_id]['Order']);
    }
    else
        include_once 'checkout_steps_5_payment_method.php';
}
elseif($_GET['route']=="payment_method_description"){  
    $payment_method = PaymentMethod::loadByCode($_POST['method_code']);
    echo $payment_method->getDescription();
    
}
elseif($_GET['route']=="confirm"){
    /*
     *  In confirm route all session data of cart and user information of shipments and payments will save
     * save will occur in order list , order history , customer reward, and order products table
     */
    
    if(isset($_POST[$_GET['route']])){
        //pr($_SESSION);
        $_SESSION[$ses_id]['Order']['customer_id'] = $sessUserId;
        //pr($_SESSION[$ses_id]['Products']);
        //pr($_SESSION[$ses_id]['Order']);
        $result = CheckoutManager::saveToCart($_SESSION[$ses_id]['Products'],$_SESSION[$ses_id]['Order'],$_SESSION[$ses_id]['Cart_Total_Price'],$_SESSION[$ses_id]['Currency'],$ses_id);
       
    }
    else
        include_once 'checkout_step_6_confirm.php';
}
die;
?>

