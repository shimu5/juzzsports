<?php
/**
 *
 * CustomerManager Manager Class
 * CustomerManager will manage all about us static page information
 *
 * @package     Customer Manager
 * @category    Manager
 * @author
 * @date        28/05/2014
 *
 * 
 */
require_once ROOT . "functions/Connection.php";
require_once ROOT . "classes/Country.php";
require_once ROOT . "classes/Zone.php";
require_once ROOT . "classes/Customer.php";
require_once ROOT . "classes/CustomerTransaction.php";
require_once ROOT . "classes/CustomerAddress.php";
require_once ROOT . "classes/CustomerReward.php";


class CustomerManager {

    // Get Country list
    public static function getCountries($pageType , $pageName) {
        return Country::load();
    }

    /**
     * Save customer and customerAddress information
     *
     * @param $data
     * @return mixed
     */
    public static function saveCustomer($data) {
        $objCustomer = new Customer();
        $objCustomer->setFirstname($data['firstname']);
        $objCustomer->setLastname($data["lastname"]);
        $objCustomer->setEmail($data["email"]);
        $objCustomer->setTelephone($data["telephone"]);
        $objCustomer->setFax($data["fax"]);
        $objCustomer->setPassword($data["password"]);
        $objCustomer->setStoreId(1);
        $objCustomer->setSalt("");
        $objCustomer->setCart("");
        $objCustomer->setWishlist("");
        $objCustomer->setNewsletter(0);
        $objCustomer->setAddressId(0);
        $objCustomer->setCustomerGroupId(1);
        $objCustomer->setIp($_SERVER['REMOTE_ADDR']);
        $objCustomer->setStatus(1);
        $objCustomer->setApproved(1);
        $objCustomer->setToken("");
        $objCustomer->setDateAdded(date("Y-m-d H;i:s"));

        $customerResult = $objCustomer->save(); // Save customer information

        $customerId = $objCustomer->getCustomerId();
        if($customerResult['success']){
            $objCustomerAddress = new CustomerAddress();
            $objCustomerAddress->setCustomerId($customerId);
            $objCustomerAddress->setFirstname($data["firstname"]);
            $objCustomerAddress->setLastname($data["lastname"]);
            $objCustomerAddress->setCompanyId($data["company"]);
            $objCustomerAddress->setAddress1($data["address_1"]);
            $objCustomerAddress->setAddress2($data["address_2"]);
            $objCustomerAddress->setCity($data["city"]);
            $objCustomerAddress->setPostcode($data["postcode"]);
            $objCustomerAddress->setCountryId($data["country"]);
            $objCustomerAddress->setZoneId($data["zone_id"]);
            $objCustomerAddress->setTaxId(0);

            $result = $objCustomerAddress->save();// Save Customer Address information

            $addressId = $objCustomerAddress->getAddressId();

            $customerInfoObj = Customer::loadById($customerId);
            $objCustomer = new Customer();
            $objCustomer->setCustomerId($customerId);
            $objCustomer->setFirstname($customerInfoObj->getFirstname());
            $objCustomer->setLastname($customerInfoObj->getLastname());
            $objCustomer->setEmail($customerInfoObj->getEmail());
            $objCustomer->setTelephone($customerInfoObj->getTelephone());
            $objCustomer->setFax($customerInfoObj->getFax());
            $objCustomer->setPassword($customerInfoObj->getPassword());
            $objCustomer->setStoreId($customerInfoObj->getStoreId());
            $objCustomer->setSalt($customerInfoObj->getSalt());
            $objCustomer->setCart($customerInfoObj->getCart());
            $objCustomer->setWishlist($customerInfoObj->getWishlist());
            $objCustomer->setNewsletter($customerInfoObj->getNewsletter());
            $objCustomer->setAddressId($addressId);
            $objCustomer->setCustomerGroupId($customerInfoObj->getCustomerGroupId());
            $objCustomer->setIp($_SERVER['REMOTE_ADDR']);
            $objCustomer->setStatus($customerInfoObj->getStatus());
            $objCustomer->setApproved($customerInfoObj->getApproved());
            $objCustomer->setToken($customerInfoObj->getToken());
            $objCustomer->setDateAdded($customerInfoObj->getDateAdded());

            return $objCustomer->save(); // Save customer information
        }
    }

    /**
     * Update customer information
     *
     * @param $data
     * @return mixed
     */
    public static function saveCustomerInfo($data) {

        $customerId = $data['customer_id'];

        $customerInfoObj = Customer::loadById($customerId); // get customer information

        $objCustomer = new Customer();
        $objCustomer->setCustomerId($customerId);
        $objCustomer->setFirstname($data["firstname"]);
        $objCustomer->setLastname($data["lastname"]);
        $objCustomer->setEmail($data["email"]);
        $objCustomer->setTelephone($data["telephone"]);
        $objCustomer->setFax($data["fax"]);

        $objCustomer->setPassword($customerInfoObj->getPassword());
        $objCustomer->setStoreId($customerInfoObj->getStoreId());
        $objCustomer->setSalt($customerInfoObj->getSalt());
        $objCustomer->setCart($customerInfoObj->getCart());
        $objCustomer->setWishlist($customerInfoObj->getWishlist());
        $objCustomer->setNewsletter($customerInfoObj->getNewsletter());
        $objCustomer->setAddressId($customerInfoObj->getAddressId());
        $objCustomer->setCustomerGroupId($customerInfoObj->getCustomerGroupId());
        $objCustomer->setIp($customerInfoObj->getIp());
        $objCustomer->setStatus($customerInfoObj->getStatus());
        $objCustomer->setApproved($customerInfoObj->getApproved());
        $objCustomer->setToken($customerInfoObj->getToken());
        $objCustomer->setDateAdded($customerInfoObj->getDateAdded());

        return $objCustomer->save(); // Save customer information


    }


    /**
     * Save customer and customerDtails information
     *
     * @param $data
     * @return mixed
     */
    public static function saveCustomerAddress($resultRow) {
        $customerId = $resultRow['customer_id'];

        //$customerInfoObj = Customer::loadById($customerId);
       // pr($data);

        //$objCustomer = new Customer();
        //$objCustomerAddress->setCustomerId($customerId);

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


    public static function saveCustomerPass($data) {
        $customerId = $data['customer_id'];
        $customerInfoObj = Customer::loadById($customerId);

        $objCustomer = new Customer();
        $objCustomer->setCustomerId($customerId);
        $objCustomer->setFirstname($customerInfoObj->getFirstname());
        $objCustomer->setLastname($customerInfoObj->getLastname());

        $objCustomer->setPassword($data["password"]);
        $objCustomer->setConfirm($data["confirm"]);

        $objCustomer->setEmail($customerInfoObj->getEmail());
        $objCustomer->setTelephone($customerInfoObj->getTelephone());
        $objCustomer->setFax($customerInfoObj->getFax());
        $objCustomer->setStoreId($customerInfoObj->getStoreId());
        $objCustomer->setSalt($customerInfoObj->getSalt());
        $objCustomer->setCart($customerInfoObj->getCart());
        $objCustomer->setWishlist($customerInfoObj->getWishlist());
        $objCustomer->setNewsletter($customerInfoObj->getNewsletter());
        $objCustomer->setAddressId($customerInfoObj->getAddressId());
        $objCustomer->setCustomerGroupId($customerInfoObj->getCustomerGroupId());
        $objCustomer->setIp($customerInfoObj->getIp());
        $objCustomer->setStatus($customerInfoObj->getStatus());
        $objCustomer->setApproved($customerInfoObj->getApproved());
        $objCustomer->setToken($customerInfoObj->getToken());
        $objCustomer->setDateAdded($customerInfoObj->getDateAdded());
        //pr($objCustomer);die();
        return $objCustomer->save(); // Save customer information
    }

    public static function saveForgotPass($data) {
       
        $customerEmail = $data['email'];
        $customerInfoObj = Customer::loadByField("email", $customerEmail);      
        $objCustomer = new Customer();
        $objCustomer->setCustomerId($customerInfoObj->getCustomerId());
        $objCustomer->setFirstname($customerInfoObj->getFirstname());
        $objCustomer->setLastname($customerInfoObj->getLastname());
        $objCustomer->setPassword($data["password"]);
        $objCustomer->setConfirm($data["confirm"]);
        $objCustomer->setEmail($customerInfoObj->getEmail());
        $objCustomer->setTelephone($customerInfoObj->getTelephone());
        $objCustomer->setFax($customerInfoObj->getFax());
        $objCustomer->setStoreId($customerInfoObj->getStoreId());
        $objCustomer->setSalt($customerInfoObj->getSalt());
        $objCustomer->setCart($customerInfoObj->getCart());
        $objCustomer->setWishlist($customerInfoObj->getWishlist());
        $objCustomer->setNewsletter($customerInfoObj->getNewsletter());
        $objCustomer->setAddressId($customerInfoObj->getAddressId());
        $objCustomer->setCustomerGroupId($customerInfoObj->getCustomerGroupId());
        $objCustomer->setIp($customerInfoObj->getIp());
        $objCustomer->setStatus($customerInfoObj->getStatus());
        $objCustomer->setApproved($customerInfoObj->getApproved());
        $objCustomer->setToken($customerInfoObj->getToken());
        $objCustomer->setDateAdded($customerInfoObj->getDateAdded());        
        return $objCustomer->save(); // Save customer information
    }


    /**
     * save subscribe option
     *
     * @param $data
     * @return mixed
     */
    public static function saveNewsletter($data) {
        $customerId = $data['customer_id'];
        $customerInfoObj = Customer::loadById($customerId);

        $objCustomer = new Customer();
        $objCustomer->setCustomerId($customerId);
        $objCustomer->setFirstname($customerInfoObj->getFirstname());
        $objCustomer->setLastname($customerInfoObj->getLastname());

        $objCustomer->setPassword($customerInfoObj->getPassword());
        $objCustomer->setConfirm($customerInfoObj->getConfirm());

        $objCustomer->setEmail($customerInfoObj->getEmail());
        $objCustomer->setTelephone($customerInfoObj->getTelephone());
        $objCustomer->setFax($customerInfoObj->getFax());
        $objCustomer->setStoreId($customerInfoObj->getStoreId());
        $objCustomer->setSalt($customerInfoObj->getSalt());
        $objCustomer->setCart($customerInfoObj->getCart());
        $objCustomer->setWishlist($customerInfoObj->getWishlist());
        $objCustomer->setNewsletter($data['newsletter']);
        $objCustomer->setAddressId($customerInfoObj->getAddressId());
        $objCustomer->setCustomerGroupId($customerInfoObj->getCustomerGroupId());
        $objCustomer->setIp($customerInfoObj->getIp());
        $objCustomer->setStatus($customerInfoObj->getStatus());
        $objCustomer->setApproved($customerInfoObj->getApproved());
        $objCustomer->setToken($customerInfoObj->getToken());
        $objCustomer->setDateAdded($customerInfoObj->getDateAdded());

        return $objCustomer->save(); // Save newsletter subscribe information
    }


    // Check :: Customer email address already in database
    public static function isEmailExist($email, $customerId = 0) {
        return Customer::isEmailExist($email, $customerId);
    }

    // get customer information by customer id
    public static function getCustomerById($customerId) {
        return Customer::loadById($customerId);
    }

    /**
     * get customer address by customer id
     *
     * @param $sessUserId
     * @return Array
     */
    public static function getCustomerAddressByCustomerId($sessUserId){
        return CustomerAddress::getCustomerAddressByCustomerId($sessUserId);
    }

    /**
     * get customer address by customer id
     *
     * @param $sessUserId
     * @return Array
     */
    public static function getCustomerAddressById($sessUserId){
        return CustomerAddress::loadById($sessUserId);
    }


    /**
     * delete customer address by address id
     *
     * @param $addressId
     * @return True | False
     */
    public static function deleteCustomerAddress($addressId)
    {
        return CustomerAddress::deleteById($addressId);
    }
    
    /**
     * get wishlist from customer table
     * 
     * @param type $customerId
     * @return String 
     */
    public static function getWishList($customerId)
    {  
        return Customer::loadById($customerId);
    }

    /**
     * get customer transaction
     *
     * @param $customerId
     * @param $start
     * @param $limit
     * @return CustomerTransaction|null
     */
    public static function getTransactionList($customerId,$start, $limit)
    {
        return CustomerTransaction::loadByCustomerId($customerId,$start, $limit);
    }

    public static function getTotalCustomerBalance($customerId){
        return CustomerTransaction::getTotalCustomerBalance($customerId);
    }
    /**
     * update wishlist from customer table
     * 
     *
     * @param $customerId
     * @param $wishlistArr
     * @return Customer|null
     */
    public static function saveWishList($customerId, $wishlistArr){
        return Customer::saveWishList($customerId, serialize($wishlistArr));
    }


    /**
     * get page number
     * @return int
     */
    public static function getPageLimit()
    {
        return 50;//Connection::$PageLimit; //how many items to show per page
    }

    /**
     * Get Pagination
     *
     * @param $page = current page number, $page = extra parameter want to add in url
     * @param $param
     * @return HTML - Pagination
     */
    public static function showCustomerTransactionPagination($page, $customerId, $param)
    {
        $limit = 50; //how many items to show per page
        $adjacents = 1;
        $targetpage = "transaction_list.php"; //your file name  (the name of this file)
        $total_pages = CustomerTransaction::getTotalCustomerTransaction($customerId); // total item, take from database; count query

        echo paginationShow($targetpage, $total_pages, $adjacents, $page, $limit, $param);
    }

    /**
     * Get Pagination
     *
     * @param $page = current page number, $page = extra parameter want to add in url
     * @param $param
     * @return HTML - Pagination
     */
    public static function showCustomerRewardPagination($page, $customerRewardId, $param)
    {
        $limit = 50; //how many items to show per page
        $adjacents = 1;
        $targetpage = "reward.php"; //your file name  (the name of this file)
        $total_pages = CustomerReward::getTotalCustomerReward($customerRewardId); // total item, take from database; count query

        echo paginationShow($targetpage, $total_pages, $adjacents, $page, $limit, $param);
    }

    /**
     * get customer total reward point
     *
     * @param $customerRewardId
     * @return mixed
     */
    public static function getTotalCustomerRewardBalance($customerRewardId){

        return CustomerReward::getTotalCustomerRewardBalance($customerRewardId);
    }

    /**
     * get all customer reward point list
     *
     * @param $customerRewardId
     * @param $start
     * @param $limit
     * @return Array
     */
    public static function getRewardPoint($customerRewardId,$start, $limit)
    {

        return CustomerReward::loadByCustomerId($customerRewardId,$start, $limit);
    }



}

// End Class 
?>