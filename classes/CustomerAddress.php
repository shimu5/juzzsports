<?php

/**
 *
 * CustomerAddress class
 *
 *
 * @package     CustomerAddress
 * @category    Library
 * @author      Juzz Sports
 * @date        01-06-2014
 */

Class CustomerAddress
{

    private $addressId;
    private $customerId;
    private $firstname;
    private $lastname;
    private $company;
    private $companyId;
    private $taxId;
    private $address1;
    private $address2;
    private $city;
    private $postcode;
    private $countryId;
    private $zoneId;

    /**
     * Setter and getter method
     */

    public function getAddressId()
    {
        return $this->addressId;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function getCompanyId()
    {
        return $this->companyId;
    }

    public function getTaxId()
    {
        return $this->taxId;
    }

    public function getAddress1()
    {
        return $this->address1;
    }

    public function getAddress2()
    {
        return $this->address2;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPostcode()
    {
        return $this->postcode;
    }

    public function getCountryId()
    {
        return $this->countryId;
    }

    public function getZoneId()
    {
        return $this->zoneId;
    }

    public function setAddressId($val)
    {
        $this->addressId = intval($val);
    }

    public function setCustomerId($val)
    {
        $this->customerId = intval($val);
    }

    public function setFirstname($val)
    {
        $this->firstname = $val;
    }

    public function setLastname($val)
    {
        $this->lastname = $val;
    }

    public function setCompany($val)
    {
        $this->company = $val;
    }

    public function setCompanyId($val)
    {
        $this->companyId = $val;
    }

    public function setTaxId($val)
    {
        $this->taxId = $val;
    }

    public function setAddress1($val)
    {
        $this->address1 = $val;
    }

    public function setAddress2($val)
    {
        $this->address2 = $val;
    }

    public function setCity($val)
    {
        $this->city = $val;
    }

    public function setPostcode($val)
    {
        $this->postcode = $val;
    }

    public function setCountryId($val)
    {
        $this->countryId = intval($val);
    }

    public function setZoneId($val)
    {
        $this->zoneId = intval($val);
    }

    /**
     * Save or update customer address information
     *
     */
    public function save()
    {
        $addressId = intval($this->getAddressId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "customer_address";
        $fieldset = array("customer_id", "firstname", "lastname", "company", "company_id", "tax_id", "address_1", "address_2", "city", "postcode", "country_id", "zone_id");
        $valueset = array($this->getCustomerId(), $this->getFirstname(), $this->getLastname(), $this->getCompany(), $this->getCompanyId(), $this->getTaxId(), $this->getAddress1(), $this->getAddress2(), $this->getCity(), $this->getPostcode(), $this->getCountryId(), $this->getZoneId());

        if ($addressId > 0) {
            $condition = "AND address_id=" . $addressId;
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
                $result["last_insert_id"] = $insert_id;
                $this->setAddressId($insert_id);
            } else {
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
            }
        }

        return $result;

    }

    /**
     * @param $addressId
     * @return CustomerAddress|null
     */
    public static function loadById($addressId)
    {

        $addressId = intval($addressId);

        $objCustomerAddress = NULL;

        $table = "customer_address";
        $condition = "AND address_id=" . $addressId;
        $fields = "*";

        $resultRow = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if ($resultRow) {
            $objCustomerAddress = new CustomerAddress();
            $objCustomerAddress->setAddressId($resultRow["address_id"]);
            $objCustomerAddress->setCustomerId($resultRow["customer_id"]);
            $objCustomerAddress->setFirstname($resultRow["firstname"]);
            $objCustomerAddress->setLastname($resultRow["lastname"]);
            $objCustomerAddress->setCompany($resultRow["company"]);
            $objCustomerAddress->setCompanyId($resultRow["company_id"]);
            $objCustomerAddress->setTaxId($resultRow["tax_id"]);
            $objCustomerAddress->setAddress1($resultRow["address_1"]);
            $objCustomerAddress->setAddress2($resultRow["address_2"]);
            $objCustomerAddress->setCity($resultRow["city"]);
            $objCustomerAddress->setPostcode($resultRow["postcode"]);
            $objCustomerAddress->setCountryId($resultRow["country_id"]);
            $objCustomerAddress->setZoneId($resultRow["zone_id"]);

        }

        return $objCustomerAddress;
    }

    /**
     * @return Array of all CustomerAddress information
     */

    public static function load()
    {

        $objCustomerAddressArr = array();

        $table = "customer_address";
        $condition = "";
        $fields = "*";

        $row = Connection::getAllData($table, $condition, $fields, "", "");

        if ($row) {

            foreach ($row as $resultRow) {

                $objCustomerAddress = new CustomerAddress();
                $objCustomerAddress->setAddressId($resultRow["address_id"]);
                $objCustomerAddress->setCustomerId($resultRow["customer_id"]);
                $objCustomerAddress->setFirstname($resultRow["firstname"]);
                $objCustomerAddress->setLastname($resultRow["lastname"]);
                $objCustomerAddress->setCompany($resultRow["company"]);
                $objCustomerAddress->setCompanyId($resultRow["company_id"]);
                $objCustomerAddress->setTaxId($resultRow["tax_id"]);
                $objCustomerAddress->setAddress1($resultRow["address_1"]);
                $objCustomerAddress->setAddress2($resultRow["address_2"]);
                $objCustomerAddress->setCity($resultRow["city"]);
                $objCustomerAddress->setPostcode($resultRow["postcode"]);
                $objCustomerAddress->setCountryId($resultRow["country_id"]);
                $objCustomerAddress->setZoneId($resultRow["zone_id"]);

                $objCustomerAddressArr[] = $objCustomerAddress;
            }

        }

        return $objCustomerAddressArr;
    }
    
    /**
     * @return Array of all CustomerAddress information
     */

    public static function getCustomerAddressByCustomerId($customerId)
    {
        $customerId = intval($customerId);

        $table      = "customer_address CA
                       LEFT JOIN country C USING(country_id)
                       LEFT JOIN zone Z ON(Z.country_id = C.country_id)
                      ";
        $condition  = " AND customer_id = ".$customerId;
        $fields     = "CA.*, C.name as country_name, Z.name as zone_name";

        return Connection::getAllData($table, $condition, $fields, "GROUP BY address_id", "");
        
    }

    /**
     * @param $addressId
     * @return bool
     */
    public static function deleteById($addressId)
    {
        $addressId = intval($addressId);
        return Connection::delData("customer_address", " AND address_id=" . $addressId);
    }

}

?>