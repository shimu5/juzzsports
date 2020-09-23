<?php
/* 
 * Mailer class that will load PHP Mailer classes
 * and this class is the cnfiguration class
 * and open the template in the editor.
 *
 * https://github.com/PHPMailer/PHPMailer
 * https://scrutinizer-ci.com/g/PHPMailer/PHPMailer/)
 */

require_once('PHPMailerAutoload.php');
require_once ROOT . "classes/MailSettings.php";

class Mailer
{
    
     var $mail = null;
     
     function __construct() {
       
            $this->mail = new PHPMailer();
       
            //Tell PHPMailer to use SMTP
            $mail_settings = MailSettings::loadById(1);
            
            if(!empty($mail_settings)){                
                if($mail_settings->getMailType()=="smtp" ){
                    
                     // SMTP for Authentiction mail settings
                    $this->mail->isSMTP();

                    //Enable SMTP debugging
                    // 0 = off (for production use)
                    // 1 = client messages
                    // 2 = client and server messages
                    $this->mail->SMTPDebug = 0;
                   

                    //Ask for HTML-friendly debug output
                    //$this->mail->Debugoutput = 'html';
                    //Set the hostname of the mail server
                    $this->mail->Host = $mail_settings->getMailHost();
                    $this->mail->Port = $mail_settings->getMailPort();
                    if($mail_settings->getAuthentication()==1){
                        
                        //$this->mail->Host = 'smtp.gmail.com';
                        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
                        //$this->mail->Port = 587;                       
                        //Set the encryption system to use - ssl (deprecated) or tls
                        //$this->mail->SMTPSecure = 'tls';
                        $this->mail->SMTPSecure = $mail_settings->getSmtpSecure();

                        //Whether to use SMTP authentication
                        $this->mail->SMTPAuth = true;

                        //Username to use for SMTP authentication - use full email address for gmail
                        $this->mail->Username = $mail_settings->getUserName();
                        //$this->mail->Username = "shimu@divineit.net";

                        //Password to use for SMTP authentication
                        $this->mail->Password = $mail_settings->getPassword();
                        //Set who the message is to be sent from                        
                    }
                    else{
                        // SMTP for Non Authentiction mail settings
                        //$mail->Host = "mail.example.com";
                        //Set the SMTP port number - likely to be 25, 465 or 587
                        //$mail->Port = 25;
                        //Whether to use SMTP authentication
                        $mail->SMTPAuth = false;

                    }
                    //$this->mail->setFrom('shimu@divineit.net', 'Shamima');
                    $this->mail->setFrom($mail_settings->getMailFrom(), $mail_settings->getMailFromName());
                }
                elseif($mail_settings->getMailType()=="sendmail" ){
                    // Set PHPMailer to use the sendmail transport
                    $mail->isSendmail();
                }
            }

            return $this->mail;

    }

    function setMailAddress($from,$fromName){
        $this->mail->addAddress($from, $fromName);
    }

    function setMailBody($body){
        $this->mail->Body = $body;
    }


    function setMailSubject($subject){
        $this->mail->Subject = $subject;
    }

    function setMailAddAttachment($attachment){
        $this->mail->addAttachment = $attachment;
    }

    function MailSend($addAdress=null,$addAdressName=null,$subject=null,$Body=null,$msgHTML=null,$attachmentWithPathFiles=null){
           
            //Set an alternative reply-to address
            //$mail->addReplyTo('replyto@example.com', 'Akhter');

            //Set who the message is to be sent to
            //if()
            $this->mail->addAddress($addAdress, $addAdressName);
            //$this->mail->addAddress('shimu@divineit.net', 'shimu divine');
            
            //Set the subject line
            if(!isset($this->mail->Subject))$this->mail->Subject = (isset($subject))?$subject:'PHPMailer GMail SMTP test';
            if(!isset($this->mail->Body)) $this->mail->Body = (isset($Body))?$Body:"Just a test email";
                     
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            //$this->mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
            //$this->mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));


            //Replace the plain text body with one created manually
            //$this->mail->AltBody = 'This is a plain-text message body';

            //Attach an image file
            if(!empty($attachmentWithPathFiles) && is_array($attachmentWithPathFiles)){
                foreach($attachmentWithPathFiles as $attachment_with_path){
                    $this->mail->addAttachment($attachment_with_path);
                    //$this->mail->addAttachment('phpmailer_mini.jpg');
                }
                
            }
            elseif(!is_array($attachmentWithPathFiles)){
                $this->mail->addAttachment($attachmentWithPathFiles);
            }
            // pr($this->mail); die;
            return $this->mail->Send();

    }

}

?>
