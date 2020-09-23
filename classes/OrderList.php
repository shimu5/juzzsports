<?php

/**
 *
 * OrderList class
 *
 *
 * @package     OrderList
 * @category    Library
 * @author      Juzz Sports
 * @date        10-06-2014
 */

Class OrderList
{

    private $orderId;
    private $invoiceNo;
    private $invoicePrefix;
    private $storeId;
    private $storeName;
    private $storeUrl;
    private $customerId;
    private $customerGroupId;
    private $firstname;
    private $lastname;
    private $email;
    private $telephone;
    private $fax;
    private $paymentFirstname;
    private $paymentLastname;
    private $paymentCompany;
    private $paymentCompanyId;
    private $paymentTaxId;
    private $paymentAddress1;
    private $paymentAddress2;
    private $paymentCity;
    private $paymentPostcode;
    private $paymentCountry;
    private $paymentCountryId;
    private $paymentZone;
    private $paymentZoneId;
    private $paymentAddressFormat;
    private $paymentMethod;
    private $paymentCode;
    private $paymentComment;
    private $bankName;
    private $bankAcountNo;
    private $shippingFirstname;
    private $shippingLastname;
    private $shippingCompany;
    private $shippingAddress1;
    private $shippingAddress2;
    private $shippingCity;
    private $shippingPostcode;
    private $shippingCountry;
    private $shippingCountryId;
    private $shippingZone;
    private $shippingZoneId;
    private $shippingAddressFormat;
    private $shippingMethod;
    private $shippingCode;
    private $comment;
    private $total;
    private $orderStatusId;
    private $affiliateId;
    private $commission;
    private $languageId;
    private $currencyId;
    private $currencyCode;
    private $currencyValue;
    private $ip;
    private $forwardedIp;
    private $userAgent;
    private $acceptLanguage;
    private $dateAdded;
    private $dateModified;
    private $cbaFreeShipping;



     /**
     * All getter and setter functions
     *
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getInvoiceNo()
    {
        return $this->invoiceNo;
    }

    public function getInvoicePrefix()
    {
        return $this->invoicePrefix;
    }

    public function getStoreId()
    {
        return $this->storeId;
    }

    public function getStoreName()
    {
        return $this->storeName;
    }

    public function getStoreUrl()
    {
        return $this->storeUrl;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getCustomerGroupId()
    {
        return $this->customerGroupId;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getFax()
    {
        return $this->fax;
    }

    public function getPaymentFirstname()
    {
        return $this->paymentFirstname;
    }

    public function getPaymentLastname()
    {
        return $this->paymentLastname;
    }

    public function getPaymentCompany()
    {
        return $this->paymentCompany;
    }

    public function getPaymentCompanyId()
    {
        return $this->paymentCompanyId;
    }

    public function getPaymentTaxId()
    {
        return $this->paymentTaxId;
    }

    public function getPaymentAddress1()
    {
        return $this->paymentAddress1;
    }

    public function getPaymentAddress2()
    {
        return $this->paymentAddress2;
    }

    public function getPaymentCity()
    {
        return $this->paymentCity;
    }

    public function getPaymentPostcode()
    {
        return $this->paymentPostcode;
    }

    public function getPaymentCountry()
    {
        return $this->paymentCountry;
    }

    public function getPaymentCountryId()
    {
        return $this->paymentCountryId;
    }

    public function getPaymentZone()
    {
        return $this->paymentZone;
    }

    public function getPaymentZoneId()
    {
        return $this->paymentZoneId;
    }

    public function getPaymentAddressFormat()
    {
        return $this->paymentAddressFormat;
    }

    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    public function getPaymentCode()
    {
        return $this->paymentCode;
    }

    public function getPaymentComment()
    {
        return $this->paymentComment;
    }

    public function getBankName()
    {
        return $this->bankName;
    }

    public function getBankAcountNo()
    {
        return $this->bankAcountNo;
    }

    public function getShippingFirstname()
    {
        return $this->shippingFirstname;
    }

    public function getShippingLastname()
    {
        return $this->shippingLastname;
    }

    public function getShippingCompany()
    {
        return $this->shippingCompany;
    }

    public function getShippingAddress1()
    {
        return $this->shippingAddress1;
    }

    public function getShippingAddress2()
    {
        return $this->shippingAddress2;
    }

    public function getShippingCity()
    {
        return $this->shippingCity;
    }

    public function getShippingPostcode()
    {
        return $this->shippingPostcode;
    }

    public function getShippingCountry()
    {
        return $this->shippingCountry;
    }

    public function getShippingCountryId()
    {
        return $this->shippingCountryId;
    }

    public function getShippingZone()
    {
        return $this->shippingZone;
    }

    public function getShippingZoneId()
    {
        return $this->shippingZoneId;
    }

    public function getShippingAddressFormat()
    {
        return $this->shippingAddressFormat;
    }

    public function getShippingMethod()
    {
        return $this->shippingMethod;
    }

    public function getShippingCode()
    {
        return $this->shippingCode;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getOrderStatusId()
    {
        return $this->orderStatusId;
    }

    public function getAffiliateId()
    {
        return $this->affiliateId;
    }

    public function getCommission()
    {
        return $this->commission;
    }

    public function getLanguageId()
    {
        return $this->languageId;
    }

    public function getCurrencyId()
    {
        return $this->currencyId;
    }

    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    public function getCurrencyValue()
    {
        return $this->currencyValue;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getForwardedIp()
    {
        return $this->forwardedIp;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function getAcceptLanguage()
    {
        return $this->acceptLanguage;
    }

    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    public function getDateModified()
    {
        return $this->dateModified;
    }

    public function getCbaFreeShipping()
    {
        return $this->cbaFreeShipping;
    }

    public function setOrderId($val)
    {
        $this->orderId = intval($val);
    }

    public function setInvoiceNo($val)
    {
        $this->invoiceNo = intval($val);
    }

    public function setInvoicePrefix($val)
    {
        $this->invoicePrefix = $val;
    }

    public function setStoreId($val)
    {
        $this->storeId = intval($val);
    }

    public function setStoreName($val)
    {
        $this->storeName = $val;
    }

    public function setStoreUrl($val)
    {
        $this->storeUrl = $val;
    }

    public function setCustomerId($val)
    {
        $this->customerId = intval($val);
    }

    public function setCustomerGroupId($val)
    {
        $this->customerGroupId = intval($val);
    }

    public function setFirstname($val)
    {
        $this->firstname = $val;
    }

    public function setLastname($val)
    {
        $this->lastname = $val;
    }

    public function setEmail($val)
    {
        $this->email = $val;
    }

    public function setTelephone($val)
    {
        $this->telephone = $val;
    }

    public function setFax($val)
    {
        $this->fax = $val;
    }

    public function setPaymentFirstname($val)
    {
        $this->paymentFirstname = $val;
    }

    public function setPaymentLastname($val)
    {
        $this->paymentLastname = $val;
    }

    public function setPaymentCompany($val)
    {
        $this->paymentCompany = $val;
    }

    public function setPaymentCompanyId($val)
    {
        $this->paymentCompanyId = $val;
    }

    public function setPaymentTaxId($val)
    {
        $this->paymentTaxId = $val;
    }

    public function setPaymentAddress1($val)
    {
        $this->paymentAddress1 = $val;
    }

    public function setPaymentAddress2($val)
    {
        $this->paymentAddress2 = $val;
    }

    public function setPaymentCity($val)
    {
        $this->paymentCity = $val;
    }

    public function setPaymentPostcode($val)
    {
        $this->paymentPostcode = $val;
    }

    public function setPaymentCountry($val)
    {
        $this->paymentCountry = $val;
    }

    public function setPaymentCountryId($val)
    {
        $this->paymentCountryId = intval($val);
    }

    public function setPaymentZone($val)
    {
        $this->paymentZone = $val;
    }

    public function setPaymentZoneId($val)
    {
        $this->paymentZoneId = intval($val);
    }

    public function setPaymentAddressFormat($val)
    {
        $this->paymentAddressFormat = $val;
    }

    public function setPaymentMethod($val)
    {
        $this->paymentMethod = $val;
    }

    public function setPaymentCode($val)
    {
        $this->paymentCode = $val;
    }

    public function setPaymentComment($val)
    {
        $this->paymentComment = $val;
    }

    public function setBankName($val)
    {
        $this->bankName = $val;
    }

    public function setBankAcountNo($val)
    {
        $this->bankAcountNo = $val;
    }

    public function setShippingFirstname($val)
    {
        $this->shippingFirstname = $val;
    }

    public function setShippingLastname($val)
    {
        $this->shippingLastname = $val;
    }

    public function setShippingCompany($val)
    {
        $this->shippingCompany = $val;
    }

    public function setShippingAddress1($val)
    {
        $this->shippingAddress1 = $val;
    }

    public function setShippingAddress2($val)
    {
        $this->shippingAddress2 = $val;
    }

    public function setShippingCity($val)
    {
        $this->shippingCity = $val;
    }

    public function setShippingPostcode($val)
    {
        $this->shippingPostcode = $val;
    }

    public function setShippingCountry($val)
    {
        $this->shippingCountry = $val;
    }

    public function setShippingCountryId($val)
    {
        $this->shippingCountryId = intval($val);
    }

    public function setShippingZone($val)
    {
        $this->shippingZone = $val;
    }

    public function setShippingZoneId($val)
    {
        $this->shippingZoneId = intval($val);
    }

    public function setShippingAddressFormat($val)
    {
        $this->shippingAddressFormat = $val;
    }

    public function setShippingMethod($val)
    {
        $this->shippingMethod = $val;
    }

    public function setShippingCode($val)
    {
        $this->shippingCode = $val;
    }

    public function setComment($val)
    {
        $this->comment = $val;
    }

    public function setTotal($val)
    {
        $this->total = $val;
    }

    public function setOrderStatusId($val)
    {
        $this->orderStatusId = intval($val);
    }

    public function setAffiliateId($val)
    {
        $this->affiliateId = intval($val);
    }

    public function setCommission($val)
    {
        $this->commission = $val;
    }

    public function setLanguageId($val)
    {
        $this->languageId = intval($val);
    }

    public function setCurrencyId($val)
    {
        $this->currencyId = intval($val);
    }

    public function setCurrencyCode($val)
    {
        $this->currencyCode = $val;
    }

    public function setCurrencyValue($val)
    {
        $this->currencyValue = $val;
    }

    public function setIp($val)
    {
        $this->ip = $val;
    }

    public function setForwardedIp($val)
    {
        $this->forwardedIp = $val;
    }

    public function setUserAgent($val)
    {
        $this->userAgent = $val;
    }

    public function setAcceptLanguage($val)
    {
        $this->acceptLanguage = $val;
    }

    public function setDateAdded($val)
    {
        $this->dateAdded = $val;
    }

    public function setDateModified($val)
    {
        $this->dateModified = $val;
    }

    public function setCbaFreeShipping($val)
    {
        $this->cbaFreeShipping = intval($val);
    }



    /**
     * Insert and update information
     *
     * @return mixed
     *
     */


    public function save()
    {
        $orderId = intval($this->getOrderId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "order_list";
        $fieldset = array("invoice_no","invoice_prefix","store_id","store_name","store_url","customer_id","customer_group_id","firstname","lastname","email","telephone","fax","payment_firstname","payment_lastname","payment_company","payment_company_id","payment_tax_id","payment_address_1","payment_address_2","payment_city","payment_postcode","payment_country","payment_country_id","payment_zone","payment_zone_id","payment_address_format","payment_method","payment_code","payment_comment","bank_name","bank_acount_no","shipping_firstname","shipping_lastname","shipping_company","shipping_address_1","shipping_address_2","shipping_city","shipping_postcode","shipping_country","shipping_country_id","shipping_zone","shipping_zone_id","shipping_address_format","shipping_method","shipping_code","comment","total","order_status_id","affiliate_id","commission","language_id","currency_id","currency_code","currency_value","ip","forwarded_ip","user_agent","accept_language","date_added","date_modified","cba_free_shipping");
        $valueset = array($this->getInvoiceNo(),$this->getInvoicePrefix(),$this->getStoreId(),$this->getStoreName(),$this->getStoreUrl(),$this->getCustomerId(),$this->getCustomerGroupId(),$this->getFirstname(),$this->getLastname(),$this->getEmail(),$this->getTelephone(),$this->getFax(),$this->getPaymentFirstname(),$this->getPaymentLastname(),$this->getPaymentCompany(),$this->getPaymentCompanyId(),$this->getPaymentTaxId(),$this->getPaymentAddress1(),$this->getPaymentAddress2(),$this->getPaymentCity(),$this->getPaymentPostcode(),$this->getPaymentCountry(),$this->getPaymentCountryId(),$this->getPaymentZone(),$this->getPaymentZoneId(),$this->getPaymentAddressFormat(),$this->getPaymentMethod(),$this->getPaymentCode(),$this->getPaymentComment(),$this->getBankName(),$this->getBankAcountNo(),$this->getShippingFirstname(),$this->getShippingLastname(),$this->getShippingCompany(),$this->getShippingAddress1(),$this->getShippingAddress2(),$this->getShippingCity(),$this->getShippingPostcode(),$this->getShippingCountry(),$this->getShippingCountryId(),$this->getShippingZone(),$this->getShippingZoneId(),$this->getShippingAddressFormat(),$this->getShippingMethod(),$this->getShippingCode(),$this->getComment(),$this->getTotal(),$this->getOrderStatusId(),$this->getAffiliateId(),$this->getCommission(),$this->getLanguageId(),$this->getCurrencyId(),$this->getCurrencyCode(),$this->getCurrencyValue(),$this->getIp(),$this->getForwardedIp(),$this->getUserAgent(),$this->getAcceptLanguage(),$this->getDateAdded(),$this->getDateModified(),$this->getCbaFreeShipping());

        if ($orderId > 0) {
            $condition = "AND order_id=" . $orderId;
            if (Connection::updateData($table, $fieldset, $valueset, $condition)) {
                $result["success"] = true;
                $result["message"] = "Update Successful.";
            } else {
                $result["success"] = false;
                $result["message"] = "Update Failed.";
            }
        } else {
            $insert_id = 0;
            if (Connection::insertData($table, $fieldset, $valueset, $insert_id)) {
                $result["success"] = true;
                $result["message"] = "Insert Successful.";
                $this->setOrderId($insert_id);
            } else {
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }


    /**
     * get data from database by id
     *
     * @return OrderList
     *
     */

    public static function loadById($orderId)
    {

        $orderId = intval($orderId);

        $objOrderList = NULL;

        $table = "order_list";
        $condition = "AND order_id=" . $orderId;
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objOrderList = new OrderList();
            $objOrderList->setOrderId($resultRow["order_id"]);
            $objOrderList->setInvoiceNo($resultRow["invoice_no"]);
            $objOrderList->setInvoicePrefix($resultRow["invoice_prefix"]);
            $objOrderList->setStoreId($resultRow["store_id"]);
            $objOrderList->setStoreName($resultRow["store_name"]);
            $objOrderList->setStoreUrl($resultRow["store_url"]);
            $objOrderList->setCustomerId($resultRow["customer_id"]);
            $objOrderList->setCustomerGroupId($resultRow["customer_group_id"]);
            $objOrderList->setFirstname($resultRow["firstname"]);
            $objOrderList->setLastname($resultRow["lastname"]);
            $objOrderList->setEmail($resultRow["email"]);
            $objOrderList->setTelephone($resultRow["telephone"]);
            $objOrderList->setFax($resultRow["fax"]);
            $objOrderList->setPaymentFirstname($resultRow["payment_firstname"]);
            $objOrderList->setPaymentLastname($resultRow["payment_lastname"]);
            $objOrderList->setPaymentCompany($resultRow["payment_company"]);
            $objOrderList->setPaymentCompanyId($resultRow["payment_company_id"]);
            $objOrderList->setPaymentTaxId($resultRow["payment_tax_id"]);
            $objOrderList->setPaymentAddress1($resultRow["payment_address_1"]);
            $objOrderList->setPaymentAddress2($resultRow["payment_address_2"]);
            $objOrderList->setPaymentCity($resultRow["payment_city"]);
            $objOrderList->setPaymentPostcode($resultRow["payment_postcode"]);
            $objOrderList->setPaymentCountry($resultRow["payment_country"]);
            $objOrderList->setPaymentCountryId($resultRow["payment_country_id"]);
            $objOrderList->setPaymentZone($resultRow["payment_zone"]);
            $objOrderList->setPaymentZoneId($resultRow["payment_zone_id"]);
            $objOrderList->setPaymentAddressFormat($resultRow["payment_address_format"]);
            $objOrderList->setPaymentMethod($resultRow["payment_method"]);
            $objOrderList->setPaymentCode($resultRow["payment_code"]);
            $objOrderList->setPaymentComment($resultRow["payment_comment"]);
            $objOrderList->setBankName($resultRow["bank_name"]);
            $objOrderList->setBankAcountNo($resultRow["bank_acount_no"]);
            $objOrderList->setShippingFirstname($resultRow["shipping_firstname"]);
            $objOrderList->setShippingLastname($resultRow["shipping_lastname"]);
            $objOrderList->setShippingCompany($resultRow["shipping_company"]);
            $objOrderList->setShippingAddress1($resultRow["shipping_address_1"]);
            $objOrderList->setShippingAddress2($resultRow["shipping_address_2"]);
            $objOrderList->setShippingCity($resultRow["shipping_city"]);
            $objOrderList->setShippingPostcode($resultRow["shipping_postcode"]);
            $objOrderList->setShippingCountry($resultRow["shipping_country"]);
            $objOrderList->setShippingCountryId($resultRow["shipping_country_id"]);
            $objOrderList->setShippingZone($resultRow["shipping_zone"]);
            $objOrderList->setShippingZoneId($resultRow["shipping_zone_id"]);
            $objOrderList->setShippingAddressFormat($resultRow["shipping_address_format"]);
            $objOrderList->setShippingMethod($resultRow["shipping_method"]);
            $objOrderList->setShippingCode($resultRow["shipping_code"]);
            $objOrderList->setComment($resultRow["comment"]);
            $objOrderList->setTotal($resultRow["total"]);
            $objOrderList->setOrderStatusId($resultRow["order_status_id"]);
            $objOrderList->setAffiliateId($resultRow["affiliate_id"]);
            $objOrderList->setCommission($resultRow["commission"]);
            $objOrderList->setLanguageId($resultRow["language_id"]);
            $objOrderList->setCurrencyId($resultRow["currency_id"]);
            $objOrderList->setCurrencyCode($resultRow["currency_code"]);
            $objOrderList->setCurrencyValue($resultRow["currency_value"]);
            $objOrderList->setIp($resultRow["ip"]);
            $objOrderList->setForwardedIp($resultRow["forwarded_ip"]);
            $objOrderList->setUserAgent($resultRow["user_agent"]);
            $objOrderList->setAcceptLanguage($resultRow["accept_language"]);
            $objOrderList->setDateAdded($resultRow["date_added"]);
            $objOrderList->setDateModified($resultRow["date_modified"]);
            $objOrderList->setCbaFreeShipping($resultRow["cba_free_shipping"]);            

        }

        return $objOrderList;
    }


    /**
     * get all data from database
     *
     * @return Array
     *
     */

    public static function load($start = 0, $limit = 0)
    {
        $start = intval($start);
        $limit = intval($limit);

        $objOrderListArr = array();

        $table = "order_list";
        $condition = "";
        $fields = "*";

        $limitStr = "";
        if ($limit) {
            $limitStr = "LIMIT " . $start . ", " . $limit;
        }

        $row = Connection::getAllData($table, $condition, $fields, "", $limitStr);

        if ($row) {

            foreach ($row as $resultRow) {

                $objOrderList = new OrderList();
                $objOrderList->setOrderId($resultRow["order_id"]);
                $objOrderList->setInvoiceNo($resultRow["invoice_no"]);
                $objOrderList->setInvoicePrefix($resultRow["invoice_prefix"]);
                $objOrderList->setStoreId($resultRow["store_id"]);
                $objOrderList->setStoreName($resultRow["store_name"]);
                $objOrderList->setStoreUrl($resultRow["store_url"]);
                $objOrderList->setCustomerId($resultRow["customer_id"]);
                $objOrderList->setCustomerGroupId($resultRow["customer_group_id"]);
                $objOrderList->setFirstname($resultRow["firstname"]);
                $objOrderList->setLastname($resultRow["lastname"]);
                $objOrderList->setEmail($resultRow["email"]);
                $objOrderList->setTelephone($resultRow["telephone"]);
                $objOrderList->setFax($resultRow["fax"]);
                $objOrderList->setPaymentFirstname($resultRow["payment_firstname"]);
                $objOrderList->setPaymentLastname($resultRow["payment_lastname"]);
                $objOrderList->setPaymentCompany($resultRow["payment_company"]);
                $objOrderList->setPaymentCompanyId($resultRow["payment_company_id"]);
                $objOrderList->setPaymentTaxId($resultRow["payment_tax_id"]);
                $objOrderList->setPaymentAddress1($resultRow["payment_address_1"]);
                $objOrderList->setPaymentAddress2($resultRow["payment_address_2"]);
                $objOrderList->setPaymentCity($resultRow["payment_city"]);
                $objOrderList->setPaymentPostcode($resultRow["payment_postcode"]);
                $objOrderList->setPaymentCountry($resultRow["payment_country"]);
                $objOrderList->setPaymentCountryId($resultRow["payment_country_id"]);
                $objOrderList->setPaymentZone($resultRow["payment_zone"]);
                $objOrderList->setPaymentZoneId($resultRow["payment_zone_id"]);
                $objOrderList->setPaymentAddressFormat($resultRow["payment_address_format"]);
                $objOrderList->setPaymentMethod($resultRow["payment_method"]);
                $objOrderList->setPaymentCode($resultRow["payment_code"]);
                $objOrderList->setPaymentComment($resultRow["payment_comment"]);
                $objOrderList->setBankName($resultRow["bank_name"]);
                $objOrderList->setBankAcountNo($resultRow["bank_acount_no"]);
                $objOrderList->setShippingFirstname($resultRow["shipping_firstname"]);
                $objOrderList->setShippingLastname($resultRow["shipping_lastname"]);
                $objOrderList->setShippingCompany($resultRow["shipping_company"]);
                $objOrderList->setShippingAddress1($resultRow["shipping_address_1"]);
                $objOrderList->setShippingAddress2($resultRow["shipping_address_2"]);
                $objOrderList->setShippingCity($resultRow["shipping_city"]);
                $objOrderList->setShippingPostcode($resultRow["shipping_postcode"]);
                $objOrderList->setShippingCountry($resultRow["shipping_country"]);
                $objOrderList->setShippingCountryId($resultRow["shipping_country_id"]);
                $objOrderList->setShippingZone($resultRow["shipping_zone"]);
                $objOrderList->setShippingZoneId($resultRow["shipping_zone_id"]);
                $objOrderList->setShippingAddressFormat($resultRow["shipping_address_format"]);
                $objOrderList->setShippingMethod($resultRow["shipping_method"]);
                $objOrderList->setShippingCode($resultRow["shipping_code"]);
                $objOrderList->setComment($resultRow["comment"]);
                $objOrderList->setTotal($resultRow["total"]);
                $objOrderList->setOrderStatusId($resultRow["order_status_id"]);
                $objOrderList->setAffiliateId($resultRow["affiliate_id"]);
                $objOrderList->setCommission($resultRow["commission"]);
                $objOrderList->setLanguageId($resultRow["language_id"]);
                $objOrderList->setCurrencyId($resultRow["currency_id"]);
                $objOrderList->setCurrencyCode($resultRow["currency_code"]);
                $objOrderList->setCurrencyValue($resultRow["currency_value"]);
                $objOrderList->setIp($resultRow["ip"]);
                $objOrderList->setForwardedIp($resultRow["forwarded_ip"]);
                $objOrderList->setUserAgent($resultRow["user_agent"]);
                $objOrderList->setAcceptLanguage($resultRow["accept_language"]);
                $objOrderList->setDateAdded($resultRow["date_added"]);
                $objOrderList->setDateModified($resultRow["date_modified"]);
                $objOrderList->setCbaFreeShipping($resultRow["cba_free_shipping"]);                

                $objOrderListArr[] = $objOrderList;
            }

        }

        return $objOrderListArr;
    }


    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function getAllOrderData($start = 0, $limit = 0, $conditionFilterStr = "", $orderBy = "")
    {
        $start = intval($start);
        $limit = intval($limit);

        $table      = "order_list OL
                       LEFT JOIN order_status OS USING(order_status_id)
                      ";
        $condition  = "".($conditionFilterStr ? $conditionFilterStr : "");
        $fields     = "OL.* ,OS.status_name";

        $limitStr = "";
        if ($limit) {
            $limitStr = "LIMIT " . $start . ", " . $limit;
        }

        return Connection::getAllData($table, $condition, $fields, $orderBy, $limitStr);

    }

    /**
     * get all order product data from database
     *
     * @return Array
     *
     */
    public static function getAllOrderProductData($start = 0, $limit = 0, $conditionFilterStr = "")
    {
        $start = intval($start);
        $limit = intval($limit);

        $table      = "order_list OL
                       LEFT JOIN order_product OP ON OL.order_id = OP.order_id
                      ";
        $condition  = "".($conditionFilterStr ? $conditionFilterStr : "");
        $fields     = " * ";

        $limitStr = "";
        if ($limit) {
            $limitStr = "LIMIT " . $start . ", " . $limit;
        }

        return Connection::getAllData($table, $condition, $fields, "", $limitStr);

    }



    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function getAllOrderDataByDateRange($start = 0, $limit = 0, $conditionFilterStr = "")
    {
        $start = intval($start);
        $limit = intval($limit);

        $table      = "order_list OL
                        LEFT JOIN order_product OP ON(OL.order_id = OP.order_id)
                        LEFT JOIN order_status OS USING (order_status_id)
                      ";
        $condition  = "".($conditionFilterStr ? $conditionFilterStr : "");
        $fields     = "SUM(OP.quantity) AS no_of_order,count(OP.product_id) AS no_of_product, SUM(OP.total) AS total_price";

        $limitStr = "";
        if ($limit) {
            $limitStr = "LIMIT " . $start . ", " . $limit;
        }

        return Connection::getAllData($table, $condition, $fields, "", $limitStr);

    }

    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function getAllOrderListByDateRange($start = 0, $limit = 0, $conditionFilterStr = "")
    {
        $start = intval($start);
        $limit = intval($limit);

        $table      = "order_product OP
                        LEFT JOIN order_list OL ON(OL.order_id = OP.order_id)
                        LEFT JOIN product P ON (p.product_id = OP.product_id)
                      ";
        $condition  = "".($conditionFilterStr ? $conditionFilterStr : "");
        $fields     = "OP.product_id,P.name,P.model,SUM(OP.quantity) AS total_quantity,SUM(OP.total) AS total_price";

        $limitStr = "";
        if ($limit) {
            $limitStr = "LIMIT " . $start . ", " . $limit;
        }

        return Connection::getAllData($table, $condition, $fields, "GROUP BY OP.product_id", $limitStr);

    }

    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function getCustomerOrdersListByDateRange($start = 0, $limit = 0, $conditionFilterStr = "")
    {
        $start = intval($start);
        $limit = intval($limit);

        $table      = "order_product OP
                        LEFT JOIN order_list OL ON(OL.order_id = OP.order_id)
                        LEFT JOIN customer C ON (C.customer_id = OL.customer_id)
                      ";
        $condition  = "".($conditionFilterStr ? $conditionFilterStr : "");
        $fields     = "C.firstname,C.email,C.status,OP.quantity,OP.total,SUM(OP.quantity) AS total_quantity,SUM(OP.total) AS total_price, SUM(OP.product_id) AS total_product";

        $limitStr = "";
        if ($limit) {
            $limitStr = "LIMIT " . $start . ", " . $limit;
        }

        return Connection::getAllData($table, $condition, $fields, "GROUP BY OL.customer_id", $limitStr);

    }

    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function getCustomerRewardPointsByDateRange($start = 0, $limit = 0, $conditionFilterStr = "")
    {
        $start = intval($start);
        $limit = intval($limit);

        $table      = "order_product OP
                        LEFT JOIN order_list OL ON(OL.order_id = OP.order_id)
                        LEFT JOIN customer C ON (C.customer_id = OL.customer_id)
                      ";
        $condition  = "".($conditionFilterStr ? $conditionFilterStr : "");
        $fields     = "C.firstname,C.email,C.status,OP.quantity,OP.total,SUM(OP.quantity) AS total_quantity,SUM(OP.total) AS total_price, SUM(OP.reward) AS total_reward";

        $limitStr = "";
        if ($limit) {
            $limitStr = "LIMIT " . $start . ", " . $limit;
        }

        return Connection::getAllData($table, $condition, $fields, "GROUP BY OL.customer_id", $limitStr);

    }

    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function getTotalRewardPointsNoCustomers()
    {

        $table      = "order_product OP
                        LEFT JOIN order_list OL ON(OL.order_id = OP.order_id)
                        LEFT JOIN customer C ON (C.customer_id = OL.customer_id)
                      ";
        $condition  = "";
        $fields     = "C.firstname,C.email,C.status,OP.quantity,OP.total,SUM(OP.quantity) AS total_quantity,SUM(OP.total) AS total_price, SUM(OP.reward) AS total_reward";


        return count(Connection::getAllData($table, $condition, $fields, "GROUP BY OL.customer_id", ""));

    }

    /**
     * get total data from database
     *
     * @return Array
     *
     */
    public static function getTotalCustomerOrders()
    {

        $table      = "order_product OP
                        LEFT JOIN order_list OL ON(OL.order_id = OP.order_id)
                        LEFT JOIN customer C ON (C.customer_id = OL.customer_id)
                      ";
        $condition  = "";
        $fields     = "C.firstname,C.email,C.status,OP.quantity,OP.total,SUM(OP.quantity) AS total_quantity,SUM(OP.total) AS total_price, SUM(OP.product_id) AS total_product";

        return count(Connection::getAllData($table, $condition, $fields, "GROUP BY OL.customer_id", ""));

    }

    /**
     * get total data from database
     *
     * @return Array
     *
     */
    public static function getTotalPurchasedData()
    {

        $table      = "order_product OP
                        LEFT JOIN order_list OL ON(OL.order_id = OP.order_id)
                        LEFT JOIN product P ON (p.product_id = OP.product_id)
                      ";
        $condition  = "";
        $fields     = "OP.product_id,P.name,P.model,count(OP.quantity) AS total_quantity,SUM(OP.total) AS total_price";

        return count(Connection::getAllData($table, $condition, $fields, "GROUP BY OP.product_id", ""));

    }

    /**
     * get all data from database
     *
     * @return Array
     *
     */
    public static function getTotalData()
    {

        $table      = "order_list OL
                       LEFT JOIN order_status OS USING(order_status_id)
                      ";
        $condition  = "";

        return Connection::getCountData($table, $condition);

    }


    /**
     * delete data from database by id
     *
     * @return True | False
     *
     */

    public static function deleteById($orderId)
    {
        $orderId = intval($orderId);
        return Connection::delData("order_list", " AND order_id=" . $orderId);
    }

    /**
     * Get list of customer
     *
     * @param $customerId
     * @param $start
     * @param $limit
     * @return array|bool
     */
    public static function getCustomerOrderList($customerId,$start,$limit)
    {
        $customerId = intval($customerId);
        $start      = intval($start);
        $limit      = intval($limit);

        $table      = "`order_list` OL
                        INNER JOIN order_product OP USING(order_id)
                        LEFT JOIN order_status OS USING(order_status_id)
                      ";
        $condition 	= "  AND OL.order_status_id > 0 AND customer_id = ".$customerId;
        $fields     = "OL.order_id AS order_id, OL.date_added AS date_added, OL.firstname AS firstname, OL.lastname AS lastname, SUM(OP.price) AS total_price, SUM(OP.quantity) AS quantity, OS.status_name";

        $limitStr = "";
        if ($limit) {
            $limitStr = "LIMIT " . $start . ", " . $limit;
        }

        return Connection::getAllData($table, $condition, $fields, "GROUP BY OP.order_id", $limitStr);
    }

    /**
     * Get customer order information
     * @param $orderId
     * @param $customerId
     * @return array|bool
     */
    public static function getCustomerOrderDetail($orderId,$customerId){
        $orderId        = intval($orderId);
        $customerId     = intval($customerId);

        $table      = "`order_list` OL
                        INNER JOIN order_product OP USING(order_id)
                        LEFT JOIN order_status OS USING(order_status_id)
                      ";
        $condition 	= " AND OL.order_id = ".$orderId." AND OL.order_status_id > 0 AND customer_id = ".$customerId;
        $fields     = "OL.*, SUM(OP.price) AS total_price, SUM(OP.quantity) AS quantity, OS.status_name";

        return Connection::getSingleData($table, $condition, $fields, "", "");
    }

    public static function getReturnOrderInfo($customerId,$productId,$orderId){
        $customerId     = intval($customerId);
        $orderId        = intval($orderId);
        $productId      = intval($productId);

        $table      = "`order_list` OL
                        INNER JOIN order_product OP USING(order_id)
                      ";
        $condition 	= " AND OL.order_id = ".$orderId." AND OP.product_id = ".$productId." AND customer_id = ".$customerId;
        $fields     = "*";

        return Connection::getSingleData($table, $condition, $fields, "", "");
    }

    /**
     * get list of order product information
     * @param $orderId
     * @return array|bool
     */
    public static function getCustomerOrderProduct($orderId){
        $orderId        = intval($orderId);
        $table      = "`order_product`";
        $condition 	= " AND order_id = ".$orderId;
        $fields     = "*";

        return Connection::getAllData($table, $condition, $fields, "", "");
    }

    /**
     * get total products sales
     *
     * @return Int
     */
    public static function getTotalProductSales(){

        $table      = "`order_product`";
        $condition 	= " ";
        $fields     = "SUM(quantity) AS total_products_sale";

        $result = Connection::getSingleData($table, $condition, $fields, "", "");

        return $result['total_products_sale'];
    }

    /**
     * get last 10 orders
     * @param $limit
     * @return array|bool
     */
    public static function getLast10sOrders($limit)
    {
        $limit        = intval($limit);
        $table      = "`order_list` OL
                        LEFT JOIN order_status OS USING(order_status_id)
                        ";
        $condition 	= "";
        $fields     = "OL.*, OS.status_name";
        $limitStr   = "LIMIT ".($limit ? $limit : 10);

        return Connection::getAllData($table, $condition, $fields, "ORDER BY date_added DESC", $limitStr);
    }

    /**
     * get last 10 orders
     * @param $limit
     * @return array|bool
     */
    public static function getTotalSales($days = 0)
    {
        $days        = intval($days);
        $table      = "order_product OP
                       LEFT JOIN order_list OL USING(order_id)
                      ";
        $condition 	= "";
        $fields     = "SUM(OP.total) as total_sales";

        if($days){
            $condition .= " AND date_added BETWEEN DATE_SUB(NOW(), INTERVAL ".$days." DAY) AND NOW()";
        }

        $result = Connection::getSingleData($table, $condition, $fields, "", "");

        return $result['total_sales'];
    }

    /**
     * get last 10 orders
     * @param $limit
     * @return array|bool
     */
    public static function getTotalOrders()
    {
        $table      = "order_list";
        $condition 	= "";

        return Connection::getCountData($table, $condition);

    }

    /**
     * Get list of order history
     * @param $orderId
     * @return array|bool
     */
    public static function getCustomerOrderHistory($orderId){
        $orderId    = intval($orderId);
        $table      = "`order_history` OH
                        LEFT JOIN order_status OS USING(order_status_id)
                      ";
        $condition 	= " AND OH.order_id = ".$orderId;
        $fields     = "OH.*,OS.status_name";

        return Connection::getAllData($table, $condition, $fields, "", "");
    }

}

?>
