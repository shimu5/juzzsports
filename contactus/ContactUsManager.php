<?php
/**
 *
 * ContactUsManager Manager Class
 * ContactUsManager will manage all clients query
 *
 * @package     ContactUs Manager
 * @category    Manager
 * @author
 * @date        29/05/2014
 *
 *
 */
require_once ROOT . "functions/Connection.php";
require_once ROOT . "classes/Contactus.php";


class ContactUsManager
{
    /*
     * 
     * @parm    : Contact information array
     * @Return  : True/False
     *
     */

    public function saveContact($data) {
        $objContactus = new Contactus();
        $objContactus->setName($data['name']);
        $objContactus->setEmail($data['email']);
        $objContactus->setCreated(date('Y-m-d'));
        $objContactus->setEnquiryMailSubject($data['enquiry_mail_subject']);
        $objContactus->setEnquiryMailBody($data['enquiry_mail_body']);
        $objContactus->setIsActive(1);

        return $objContactus->save();
    }

}

?>
