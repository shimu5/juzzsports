<?php

/**
 *
 * MailSettings class
 *
 *
 * @package     MailSettings
 * @category    Library
 * @author      Juzz Sports
 * @date		12-06-2014
 */

Class MailSettings
{

    private $mailSettingId;
    private $mailType;
    private $smtpSecure;
    private $authentication;
    private $mailHost;
    private $mailPort;
    private $userName;
    private $password;
    private $mailFrom;
    private $mailFromName;



     /**
     * All getter and setter functions
     *
     */
    public function getMailSettingId()
    {
        return $this->mailSettingId;
    }

    public function getMailType()
    {
        return $this->mailType;
    }

    public function getSmtpSecure()
    {
        return $this->smtpSecure;
    }

    public function getAuthentication()
    {
        return $this->authentication;
    }

    public function getMailHost()
    {
        return $this->mailHost;
    }

    public function getMailPort()
    {
        return $this->mailPort;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getMailFrom()
    {
        return $this->mailFrom;
    }

    public function getMailFromName()
    {
        return $this->mailFromName;
    }

    public function setMailSettingId($val)
    {
        $this->mailSettingId = intval($val);
    }

    public function setMailType($val)
    {
        $this->mailType = $val;
    }

    public function setSmtpSecure($val)
    {
        $this->smtpSecure = $val;
    }

    public function setAuthentication($val)
    {
        $this->authentication = intval($val);
    }

    public function setMailHost($val)
    {
        $this->mailHost = $val;
    }

    public function setMailPort($val)
    {
        $this->mailPort = intval($val);
    }

    public function setUserName($val)
    {
        $this->userName = $val;
    }

    public function setPassword($val)
    {
        $this->password = $val;
    }

    public function setMailFrom($val)
    {
        $this->mailFrom = $val;
    }

    public function setMailFromName($val)
    {
        $this->mailFromName = $val;
    }



     /**
     * Insert and update information
     *
     * @return mixed
     *
     */



    public function save()
    {
        $mailSettingId = intval($this->getMailSettingId());

        $result["success"] = true;
        $result["message"] = "";

        $table = "mail_settings";
        $fieldset = array("mail_type","smtp_secure","authentication","mail_host","mail_port","user_name","password","mail_from","mail_from_name");
        $valueset = array($this->getMailType(),$this->getSmtpSecure(),$this->getAuthentication(),$this->getMailHost(),$this->getMailPort(),$this->getUserName(),$this->getPassword(),$this->getMailFrom(),$this->getMailFromName());

        if($mailSettingId > 0){
            $condition = "AND mail_setting_id=".$mailSettingId;
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
                $this->setMailSettingId($insert_id);
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
     * @return MailSettings
     *
     */
public static function loadById( $mailSettingId )
    {

        $mailSettingId  = intval($mailSettingId);

        $objMailSettings = NULL;

        $table      = "mail_settings";
        $condition 	= "AND mail_setting_id=".$mailSettingId;
        $fields 	= "*";

        $resultRow  = Connection::getSingleData($table, $condition, $fields, "", "LIMIT 1");

        if( $resultRow ) {
            $objMailSettings = new MailSettings();
            $objMailSettings->setMailSettingId($resultRow["mail_setting_id"]);
            $objMailSettings->setMailType($resultRow["mail_type"]);
            $objMailSettings->setSmtpSecure($resultRow["smtp_secure"]);
            $objMailSettings->setAuthentication($resultRow["authentication"]);
            $objMailSettings->setMailHost($resultRow["mail_host"]);
            $objMailSettings->setMailPort($resultRow["mail_port"]);
            $objMailSettings->setUserName($resultRow["user_name"]);
            $objMailSettings->setPassword($resultRow["password"]);
            $objMailSettings->setMailFrom($resultRow["mail_from"]);
            $objMailSettings->setMailFromName($resultRow["mail_from_name"]);

        }

        return $objMailSettings;
    }





     /**
     * get all data from database
     *
     * @return Array
     *
     */
public static function load()
    {

        $objMailSettingsArr = array();

        $table      = "mail_settings";
        $condition 	= "";
        $fields 	= "*";

        $row  	= Connection::getAllData($table, $condition, $fields, "", "");

        if( $row ) {

            foreach( $row as $resultRow ){

                $objMailSettings = new MailSettings();
                $objMailSettings->setMailSettingId($resultRow["mail_setting_id"]);
                $objMailSettings->setMailType($resultRow["mail_type"]);
                $objMailSettings->setSmtpSecure($resultRow["smtp_secure"]);
                $objMailSettings->setAuthentication($resultRow["authentication"]);
                $objMailSettings->setMailHost($resultRow["mail_host"]);
                $objMailSettings->setMailPort($resultRow["mail_port"]);
                $objMailSettings->setUserName($resultRow["user_name"]);
                $objMailSettings->setPassword($resultRow["password"]);
                $objMailSettings->setMailFrom($resultRow["mail_from"]);
                $objMailSettings->setMailFromName($resultRow["mail_from_name"]);

                $objMailSettingsArr[] = $objMailSettings;
            }

        }

        return $objMailSettingsArr;
    }





     /**
     * delete data from database by id
     *
     * @return True | False
     *
     */
public static function deleteById( $mailSettingId )
    {
        $mailSettingId = intval( $mailSettingId );
        return Connection::delData("mail_settings", " AND mail_setting_id=".$mailSettingId);
    }

}
 ?>