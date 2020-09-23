<?php
/**
 *
 * Customer class
 *
 *
 * @package      Customer
 * @category     Library
 * @author       Juzz Sports
 * @date            01-06-2014
 */

Class Customer
{

    private $customerId;
    private $storeId;
    private $firstname;
    private $lastname;
    private $email;
    private $telephone;
    private $fax;
    private $password;
    private $confirm;
    private $salt;
    private $cart;
    private $wishlist;
    private $newsletter;
    private $addressId;
    private $customerGroupId;
    private $ip;
    private $status;
    private $approved;
    private $token;
    private $dateAdded;

    /**
     * All getter and setter Class
     *
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getStoreId()
    {
        return $this->storeId;
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

    public function getPassword()
    {
        return $this->password;
    }

    public function getConfirm()
    {
        return $this->confirm;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function getWishlist()
    {
        return $this->wishlist;
    }

    public function getNewsletter()
    {
        return $this->newsletter;
    }

    public function getAddressId()
    {
        return $this->addressId;
    }

    public function getCustomerGroupId()
    {
        return $this->customerGroupId;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getApproved()
    {
        return $this->approved;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    public function setCustomerId($val)
    {
        $this->customerId = intval($val);
    }

    public function setStoreId($val)
    {
        $this->storeId = intval($val);
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

    public function setPassword($val)
    {
        $this->password = $val;
    }

    public function setConfirm($val)
    {
        $this->confirm = $val;
    }

    public function setSalt($val)
    {
        $this->salt = $val;
    }

    public function setCart($val)
    {
        $this->cart = $val;
    }

    public function setWishlist($val)
    {
        $this->wishlist = $val;
    }

    public function setNewsletter($val)
    {
        $this->newsletter = intval($val);
    }

    public function setAddressId($val)
    {
        $this->addressId = intval($val);
    }

    public function setCustomerGroupId($val)
    {
        $this->customerGroupId = intval($val);
    }

    public function setIp($val)
    {
        $this->ip = $val;
    }

    public function setStatus($val)
    {
        $this->status = intval($val);
    }

    public function setApproved($val)
    {
        $this->approved = intval($val);
    }

    public function setToken($val)
    {
        $this->token = $val;
    }

    public function setDateAdded($val)
    {
        $this->dateAdded = $val;
    }

    /***
     * Insert and update function
     *
     * @return mixed
     */
    public function save()
    {
        $customerId = intval($this->getCustomerId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "customer";
        $fieldset = array("store_id", "firstname", "lastname", "email", "telephone", "fax", "password", "salt", "cart", "wishlist", "newsletter", "address_id", "customer_group_id", "ip", "status", "approved", "token", "date_added");
        $valueset = array($this->getStoreId(), $this->getFirstname(), $this->getLastname(), $this->getEmail(), $this->getTelephone(), $this->getFax(), $this->getPassword(), $this->getSalt(), $this->getCart(), $this->getWishlist(), $this->getNewsletter(), $this->getAddressId(), $this->getCustomerGroupId(), $this->getIp(), $this->getStatus(), $this->getApproved(), $this->getToken(), $this->getDateAdded());

        if ($customerId > 0) {
            $condition = "AND customer_id=" . $customerId;
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
                $this->setCustomerId($insert_id);
            } else {
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }

    /**
     * get customer information by customer id
     *
     * @param $customerId
     * @return Customer|null
     */
    public static function loadById($customerId)
    {

        $customerId = intval($customerId);

        $objCustomer = NULL;

        $table = "customer";
        $condition = "AND customer_id=" . $customerId;
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objCustomer = new Customer();
            $objCustomer->setCustomerId($resultRow["customer_id"]);
            $objCustomer->setStoreId($resultRow["store_id"]);
            $objCustomer->setFirstname($resultRow["firstname"]);
            $objCustomer->setLastname($resultRow["lastname"]);
            $objCustomer->setEmail($resultRow["email"]);
            $objCustomer->setTelephone($resultRow["telephone"]);
            $objCustomer->setFax($resultRow["fax"]);
            $objCustomer->setPassword($resultRow["password"]);
            $objCustomer->setSalt($resultRow["salt"]);
            $objCustomer->setCart($resultRow["cart"]);
            $objCustomer->setWishlist($resultRow["wishlist"]);
            $objCustomer->setNewsletter($resultRow["newsletter"]);
            $objCustomer->setAddressId($resultRow["address_id"]);
            $objCustomer->setCustomerGroupId($resultRow["customer_group_id"]);
            $objCustomer->setIp($resultRow["ip"]);
            $objCustomer->setStatus($resultRow["status"]);
            $objCustomer->setApproved($resultRow["approved"]);
            $objCustomer->setToken($resultRow["token"]);
            $objCustomer->setDateAdded($resultRow["date_added"]);

        }

        return $objCustomer;
    }

    /**
     * get customer information by customer id
     *
     * @param $customerId
     * @return Customer|null
     */
    public static function loadByField($fieldname, $fieldvalue)
    {
       
        $objCustomer = NULL;

        $table = "customer";
        $condition = "AND {$fieldname}='".$fieldvalue . "' ";
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objCustomer = new Customer();
            $objCustomer->setCustomerId($resultRow["customer_id"]);
            $objCustomer->setStoreId($resultRow["store_id"]);
            $objCustomer->setFirstname($resultRow["firstname"]);
            $objCustomer->setLastname($resultRow["lastname"]);
            $objCustomer->setEmail($resultRow["email"]);
            $objCustomer->setTelephone($resultRow["telephone"]);
            $objCustomer->setFax($resultRow["fax"]);
            $objCustomer->setPassword($resultRow["password"]);
            $objCustomer->setSalt($resultRow["salt"]);
            $objCustomer->setCart($resultRow["cart"]);
            $objCustomer->setWishlist($resultRow["wishlist"]);
            $objCustomer->setNewsletter($resultRow["newsletter"]);
            $objCustomer->setAddressId($resultRow["address_id"]);
            $objCustomer->setCustomerGroupId($resultRow["customer_group_id"]);
            $objCustomer->setIp($resultRow["ip"]);
            $objCustomer->setStatus($resultRow["status"]);
            $objCustomer->setApproved($resultRow["approved"]);
            $objCustomer->setToken($resultRow["token"]);
            $objCustomer->setDateAdded($resultRow["date_added"]);

        }

        return $objCustomer;
    }

    /**
     * get customer information by customer id
     *
     * @param $customerId
     * @return Customer|null
     */
    public static function getTotalCustomers()
    {
        $table = "customer";
        $condition = "";

        return Connection::getCountData($table, $condition);
    }
    
    /**
     * get customer information by customer id
     *
     * @param $customerId
     * @return Customer|null
     */
    public static function saveWishList($customerId, $wishListArr)
    {

        $customerId = intval($customerId);

        $objCustomer = NULL;

        $table      = "customer";
        $condition  = "AND customer_id=" . $customerId;
        $fields     = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objCustomer = new Customer();
            $objCustomer->setCustomerId($resultRow["customer_id"]);
            $objCustomer->setStoreId($resultRow["store_id"]);
            $objCustomer->setFirstname($resultRow["firstname"]);
            $objCustomer->setLastname($resultRow["lastname"]);
            $objCustomer->setEmail($resultRow["email"]);
            $objCustomer->setTelephone($resultRow["telephone"]);
            $objCustomer->setFax($resultRow["fax"]);
            $objCustomer->setPassword($resultRow["password"]);
            $objCustomer->setSalt($resultRow["salt"]);
            $objCustomer->setCart($resultRow["cart"]);
            $objCustomer->setWishlist($wishListArr);
            $objCustomer->setNewsletter($resultRow["newsletter"]);
            $objCustomer->setAddressId($resultRow["address_id"]);
            $objCustomer->setCustomerGroupId($resultRow["customer_group_id"]);
            $objCustomer->setIp($resultRow["ip"]);
            $objCustomer->setStatus($resultRow["status"]);
            $objCustomer->setApproved($resultRow["approved"]);
            $objCustomer->setToken($resultRow["token"]);
            $objCustomer->setDateAdded($resultRow["date_added"]);
            
            return $objCustomer->save();

        }

        return array('success' => false);
    }


     /**
     * get customer information by customer id
     * save cart into customer table
     * @param $customerId
     * @return Customer|null
     */
    public static function saveCart($customerId, $cart)
    {

        $customerId = intval($customerId);

        $objCustomer = NULL;

        $table      = "customer";
        $condition  = "AND customer_id=" . $customerId;
        $fields     = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objCustomer = new Customer();
            $objCustomer->setCustomerId($resultRow["customer_id"]);
            $objCustomer->setStoreId($resultRow["store_id"]);
            $objCustomer->setFirstname($resultRow["firstname"]);
            $objCustomer->setLastname($resultRow["lastname"]);
            $objCustomer->setEmail($resultRow["email"]);
            $objCustomer->setTelephone($resultRow["telephone"]);
            $objCustomer->setFax($resultRow["fax"]);
            $objCustomer->setPassword($resultRow["password"]);
            $objCustomer->setSalt($resultRow["salt"]);
            $objCustomer->setCart($cart);
            $objCustomer->setWishlist($resultRow["wishlist"]);
            $objCustomer->setNewsletter($resultRow["newsletter"]);
            $objCustomer->setAddressId($resultRow["address_id"]);
            $objCustomer->setCustomerGroupId($resultRow["customer_group_id"]);
            $objCustomer->setIp($resultRow["ip"]);
            $objCustomer->setStatus($resultRow["status"]);
            $objCustomer->setApproved($resultRow["approved"]);
            $objCustomer->setToken($resultRow["token"]);
            $objCustomer->setDateAdded($resultRow["date_added"]);

            return $objCustomer->save();

        }

        return array('success' => false);
    }

    /**
     * get all customer information
     *
     * @return array
     */
    public static function load()
    {

        $objCustomerArr = array();

        $table = "customer";
        $condition = "";
        $fields = "*";

        $row = Connection::getAllData($table, $condition, $fields, "", "");

        if ($row) {

            foreach ($row as $resultRow) {

                $objCustomer = new Customer();
                $objCustomer->setCustomerId($resultRow["customer_id"]);
                $objCustomer->setStoreId($resultRow["store_id"]);
                $objCustomer->setFirstname($resultRow["firstname"]);
                $objCustomer->setLastname($resultRow["lastname"]);
                $objCustomer->setEmail($resultRow["email"]);
                $objCustomer->setTelephone($resultRow["telephone"]);
                $objCustomer->setFax($resultRow["fax"]);
                $objCustomer->setPassword($resultRow["password"]);
                $objCustomer->setSalt($resultRow["salt"]);
                $objCustomer->setCart($resultRow["cart"]);
                $objCustomer->setWishlist($resultRow["wishlist"]);
                $objCustomer->setNewsletter($resultRow["newsletter"]);
                $objCustomer->setAddressId($resultRow["address_id"]);
                $objCustomer->setCustomerGroupId($resultRow["customer_group_id"]);
                $objCustomer->setIp($resultRow["ip"]);
                $objCustomer->setStatus($resultRow["status"]);
                $objCustomer->setApproved($resultRow["approved"]);
                $objCustomer->setToken($resultRow["token"]);
                $objCustomer->setDateAdded($resultRow["date_added"]);

                $objCustomerArr[] = $objCustomer;
            }

        }

        return $objCustomerArr;
    }

    /**
     * get no of customer logged in now
     *
     * @return Int
     */
    public static function getTotalLoggedInCustomer()
    {
        $table      = "customer_online";
        $condition  = "";

        return Connection::getCountData($table, $condition);

    }



    /**
     * delete customer information by customer id
     *
     * @param $customerId
     * @return bool
     */
    public static function deleteById($customerId)
    {
        $customerId = intval($customerId);
        return Connection::delData("customer", " AND customer_id=" . $customerId);
    }

    /**
     * Customer Login Check
     * We can check by customerEmail and password
     *
     * @param    int $customerEmail
     * @param    sha1 $password
     *
     * @return    bool - true on success otherwise false
     */
    public static function customerLogin($customerEmail, $password)
    {
        $objCustomer = Customer::loadByCustomerEmail($customerEmail);

        if ($objCustomer) {
            if (strcmp($objCustomer->getPassword(), $password) == 0)
                return true;
        }

        return false;
    }

    /**
     * Get Customer Info by $customerEmail
     *
     * @param    str - $customerEmail
     * @return    Customer Customer object or NULL if unable to locate
     */
    public static function loadByCustomerEmail($customerEmail)
    {
        $objCustomer = NULL;

        $table = "customer";
        $condition = "AND email LIKE '" . dbsafe($customerEmail) . "'";
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objCustomer = new Customer();
            $objCustomer->setCustomerId($resultRow["customer_id"]);
            $objCustomer->setStoreId($resultRow["store_id"]);
            $objCustomer->setFirstname($resultRow["firstname"]);
            $objCustomer->setLastname($resultRow["lastname"]);
            $objCustomer->setEmail($resultRow["email"]);
            $objCustomer->setTelephone($resultRow["telephone"]);
            $objCustomer->setFax($resultRow["fax"]);
            $objCustomer->setPassword($resultRow["password"]);
            $objCustomer->setSalt($resultRow["salt"]);
            $objCustomer->setCart($resultRow["cart"]);
            $objCustomer->setWishlist($resultRow["wishlist"]);
            $objCustomer->setNewsletter($resultRow["newsletter"]);
            $objCustomer->setAddressId($resultRow["address_id"]);
            $objCustomer->setCustomerGroupId($resultRow["customer_group_id"]);
            $objCustomer->setIp($resultRow["ip"]);
            $objCustomer->setStatus($resultRow["status"]);
            $objCustomer->setApproved($resultRow["approved"]);
            $objCustomer->setToken($resultRow["token"]);
            $objCustomer->setDateAdded($resultRow["date_added"]);
        }

        return $objCustomer;
    }

    /**
     * Check: is customer email is exist
     *
     * @param    str - $email
     * @return  Int  No. Of row fetch
     */
    public static function isEmailExist($email, $customerId)
    {
        $table = "customer";
        $condition = "AND email LIKE '" . dbsafe($email) . "'".($customerId ? " AND customer_id != ".$customerId : "");

        return Connection::getCountData($table, $condition);

    }
    
   

}

?>