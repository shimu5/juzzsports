<?php

/**
 *
 * ContactForm class
 *
 *
 * @package     ContactForm
 * @category    Library
 * @author      Juzz Sports
 * @date		30-06-2014
 */

Class ContactForm
{

    private $contactFormId;
    private $name;
    private $email;
    private $enquiryMailSubject;
    private $enquiryMailBody;
    private $created;
    private $isActive;



     /**
     * All getter and setter functions
     *
     */
    public function getContactFormId()
    {
        return $this->contactFormId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getEnquiryMailSubject()
    {
        return $this->enquiryMailSubject;
    }

    public function getEnquiryMailBody()
    {
        return $this->enquiryMailBody;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setContactFormId($val)
    {
        $this->contactFormId = intval($val);
    }

    public function setName($val)
    {
        $this->name = $val;
    }

    public function setEmail($val)
    {
        $this->email = $val;
    }

    public function setEnquiryMailSubject($val)
    {
        $this->enquiryMailSubject = $val;
    }

    public function setEnquiryMailBody($val)
    {
        $this->enquiryMailBody = $val;
    }

    public function setCreated($val)
    {
        $this->created = $val;
    }

    public function setIsActive($val)
    {
        $this->isActive = intval($val);
    }



     /**
     * Insert and update information
     *
     * @return mixed
     *
     */



    public function save()
    {
        $contactFormId = intval($this->getContactFormId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "contact_form";
        $fieldset = array("name","email","enquiry_mail_subject","enquiry_mail_body","created","is_active");
        $valueset = array($this->getName(),$this->getEmail(),$this->getEnquiryMailSubject(),$this->getEnquiryMailBody(),$this->getCreated(),$this->getIsActive());

        if($contactFormId > 0){
            $condition = "AND contact_form_id=".$contactFormId;
            if(Connection::updateData($table,$fieldset,$valueset,$condition)){
                $result["success"] = true;
                $result["message"] = "Update Successful.";
            }else {
                $result["success"] = false;
                $result["message"] = "Update Failed.";
            }
        }
        else{
             $insert_id = 0;
             if(Connection::insertData($table,$fieldset,$valueset,$insert_id)){
                $result["success"] = true;
                $result["message"] = "Insert Successful.";
                $this->setContactFormId($insert_id);
             }else{
                $result["success"] = false;
                $result["message"] = "Insert Failed.";
             }
        }

        return $result;

    }






     /**
     * get data from database by id
     *
     * @return ContactForm
     *
     */
public static function loadById( $contactFormId )
    {

        $contactFormId  = intval($contactFormId);

        $objContactForm = NULL;

        $table      = "contact_form";
        $condition 	= "AND contact_form_id=".$contactFormId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objContactForm = new ContactForm();
            $objContactForm->setContactFormId($resultRow["contact_form_id"]);
            $objContactForm->setName($resultRow["name"]);
            $objContactForm->setEmail($resultRow["email"]);
            $objContactForm->setEnquiryMailSubject($resultRow["enquiry_mail_subject"]);
            $objContactForm->setEnquiryMailBody($resultRow["enquiry_mail_body"]);
            $objContactForm->setCreated($resultRow["created"]);
            $objContactForm->setIsActive($resultRow["is_active"]);

        }

        return $objContactForm;
    }





     /**
     * get all data from database
     *
     * @return Array
     *
     */
public static function load()
    {

        $objContactFormArr = array();

        $table      = "contact_form";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objContactForm = new ContactForm();
                $objContactForm->setContactFormId($resultRow["contact_form_id"]);
                $objContactForm->setName($resultRow["name"]);
                $objContactForm->setEmail($resultRow["email"]);
                $objContactForm->setEnquiryMailSubject($resultRow["enquiry_mail_subject"]);
                $objContactForm->setEnquiryMailBody($resultRow["enquiry_mail_body"]);
                $objContactForm->setCreated($resultRow["created"]);
                $objContactForm->setIsActive($resultRow["is_active"]);

                $objContactFormArr[] = $objContactForm;
            }

        }

        return $objContactFormArr;
    }


    /**
     * get number of categories exist in database
     */
    public static function getTotalCategory()
    {
        $table = "contact_form";
        $condition = "";

        return Connection::getCountData($table, $condition);

    }





     /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
public static function deleteById( $contactFormId )
    {
        $contactFormId = intval( $contactFormId );
        return Connection::delData("contact_form", " AND contact_form_id=".$contactFormId);
    }

}
 ?>