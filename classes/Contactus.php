<?php	
/**
 *
 * Contactus class
 *
 * @package     Contactus
 * @category    Library
 * @author      Juzz Sports
 * @date	29-05-2014
 * 
 */

Class Contactus
{

    private $contactFormId;
    private $name;
    private $email;
    private $enquiryMailSubject;
    private $enquiryMailBody;
    private $created;
    private $isActive;

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
            //print_r($result);
            //die("ddd");
        }

        return $result;

    }



    public static function loadById( $contactFormId )
    {

        $contactFormId  = intval($contactFormId);

        $objContactus = NULL;

        $table      = "contact_form";
        $condition 	= "AND contact_form_id=".$contactFormId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objContactus = new Contactus();
            $objContactus->setContactFormId($resultRow["contact_form_id"]);
            $objContactus->setName($resultRow["name"]);
            $objContactus->setEmail($resultRow["email"]);
            $objContactus->setEnquiryMailSubject($resultRow["enquiry_mail_subject"]);
            $objContactus->setEnquiryMailBody($resultRow["enquiry_mail_body"]);
            $objContactus->setCreated($resultRow["created"]);
            $objContactus->setIsActive($resultRow["is_active"]);

        }

        return $objContactus;
    }



    public static function load()
    {

        $objContactusArr = array();

        $table      = "contact_form";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objContactus = new Contactus();
                $objContactus->setContactFormId($resultRow["contact_form_id"]);
                $objContactus->setName($resultRow["name"]);
                $objContactus->setEmail($resultRow["email"]);
                $objContactus->setEnquiryMailSubject($resultRow["enquiry_mail_subject"]);
                $objContactus->setEnquiryMailBody($resultRow["enquiry_mail_body"]);
                $objContactus->setCreated($resultRow["created"]);
                $objContactus->setIsActive($resultRow["is_active"]);

                $objContactusArr[] = $objContactus;
            }

        }

        return $objContactusArr;
    }



    public static function deleteById( $contactFormId )
    {
        $contactFormId = intval( $contactFormId );
        return Connection::delData("contact_form", " AND contact_form_id=".$contactFormId);
    }

}
 ?>