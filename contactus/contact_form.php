<?php
require_once "../config.php";
include_once ROOT."functions/redirect.php";

$contactusManager = new ContactUsManager();

$errorArr   = array();
$errorOccur = false;

if(count($_POST)){
    $data = array();
    $data['name'] = stripform($_POST['name']);
    if(!$data['name']){
        $errorArr['name'] = "Select any name";
        $errorOccur = true;
    }
    $data['email'] = stripform($_POST['email']);
    if(!$data['email']){
        $errorArr['email'] = "Select any email";
        $errorOccur = true;
    }
    $data['enquiry_mail_subject'] = stripform($_POST['enquiry_mail_subject']);
    if(!$data['enquiry_mail_subject']){
        $errorArr['enquiry_mail_subject'] = "Select any subject";
        $errorOccur = true;
    }
    $data['enquiry_mail_body'] = stripform($_POST['enquiry_mail_body']);
    if(!$data['enquiry_mail_body']){
        $errorArr['enquiry_mail_body'] = "Select any Message";
        $errorOccur = true;
    }

    if(!$errorOccur ){
        $result = $contactusManager->saveContact($data);
        if($result['success'] == 1){ // success
            redirectPage("index.php?s=5&success=1");
        }
        else{ // error
            // handle error
            echo '<div class="alert alert-error" for="page">Can not save page information.</div>';
        }
    }
    }

?>

<style type="text/css">
    .required{color:#FD6A56}
</style>

<div class="contact-block clearfix" style="margin-top: 20px;">
    <div class="contact-left"><h2>Address</h2>
        <ul>
            <li><h4>Address 1:</h4>
                <p style="margin-top: -15px;">JuzzSports, Singapore </p>
            </li>
            <li>
                <h4>Telephone:</h4>
                <p style="margin-top: -15px;"><span class="skype_c2c_print_container notranslate">+65 6221 8888</span><span skype_menu_props="{&quot;numberToCall&quot;:&quot;+65 6221 8888&quot;,&quot;isFreecall&quot;:false,&quot;isMobile&quot;:false,&quot;isRtl&quot;:false}" onclick="SkypeClick2Call.MenuInjectionHandler.makeCall(this, event)" onmouseout="SkypeClick2Call.MenuInjectionHandler.hideMenu(this, event)" onmouseover="SkypeClick2Call.MenuInjectionHandler.showMenu(this, event)" tabindex="-1" dir="ltr" class="skype_c2c_container notranslate" id="skype_c2c_container"><span skypeaction="skype_dropdown" dir="ltr" class="skype_c2c_highlighting_inactive_common"><span id="non_free_num_ui" class="skype_c2c_textarea_span"><img width="0" height="0" src="resource://skype_ff_extension-at-jetpack/skype_ff_extension/data/call_skype_logo.png" class="skype_c2c_logo_img"><span class="skype_c2c_text_span">+1 (234) 567-8901</span><span class="skype_c2c_free_text_span"></span></span></span></span><br>

            </li>
        </ul></div>
    <form method="post" id="contactForm" name="contactForm" class="horizontal-form" onsubmit="return validation();" action="index.php?s=5&type=contact&name=save">
        <div class="fieldset">
            <ul class="form-list">
                <li class="fields">
                    <div class="field">                        
                        <label class="" for="name"><em class="required">*</em><span> Name</span></label>
                        <div class="input-box">
                            <input type="text" class="input-text required-entry form-control" value="" title="Name" id="name" name="name">
                        </div>
                        <?php echo ($errorOccur && $errorArr['name'] ? '<div class="alert alert-error" for="contact" style="margin-right: 15px;">'.$errorArr['name'].'</div>' : '')?>
                    </div>
                    <div class="field">
                        <label class="" for="email"><em class="required">*</em> Email</label>
                        <div class="input-box">
                            <input type="text" class="input-text required-entry validate-email form-control" value="" title="Email" id="email" name="email">
                        </div>
                        <?php echo ($errorOccur && $errorArr['email'] ? '<div class="alert alert-error" for="contact" style="margin-right: 15px;">'.$errorArr['email'].'</div>' : '')?>
                    </div>
                </li>
                <li class="wide">
                    <label class="" for="Subject"><em class="required">*</em> Subject</label>
                    <div class="input-box">
                        <input type="text" class="input-text form-control" value="" title="Subject" id="subject" name="enquiry_mail_subject">
                    </div>
                    <?php echo ($errorOccur && $errorArr['enquiry_mail_subject'] ? '<div class="alert alert-error" for="contact" style="margin-right: 60px;">'.$errorArr['enquiry_mail_subject'].'</div>' : '')?>
                </li>
                <li class="wide">
                    <label class="" for="Message"><em class="required">*</em> Message</label>
                    <div class="input-box">
                        <textarea rows="3" cols="5" class="required-entry input-text form-control" title="Comment" id="comment" name="enquiry_mail_body"></textarea>
                    </div>
                    <?php echo ($errorOccur && $errorArr['enquiry_mail_body'] ? '<div class="alert alert-error" for="contact" style="margin-right: 15px;">'.$errorArr['enquiry_mail_body'].'</div>' : '')?>
                </li>
            </ul>
        </div>
        <div class="buttons-set">
            <p class="required">* Required Fields</p>
            <button class="button" id="save_btn" title="Submit" ><span><span>Submit</span></span></button>
        </div>
    </form>
</div>

<!--
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script>
    function initialize()
    {
        var mapProp = {
            center:new google.maps.LatLng(23.709921,90.407143),
            zoom:10,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        var map=new google.maps.Map(document.getElementById("googleMap")
        ,mapProp);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="googleMap" style="width:850px;height:420px;"></div>
-->

<!--<script src="../js/jquery-1.8.3.min.js" type="text/javascript"></script>-->
<script type="text/javascript">
    /**
     * Ref:: http://stackoverflow.com/questions/46155/validate-email-address-in-javascript
     *
     * @param email
     * @returns {boolean}
     */
    function validateEmail(email)
    {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    // Form Validation
    function validation()
    {
        if(document.getElementById('name').value == ''){
            alert('Please enter name');
            document.getElementById("name").focus();
            return false;
        }
        else if(document.getElementById('email').value ==''){
            alert('Please enter email address');
            document.getElementById("email").focus();
            return false;
        }
        else if(document.getElementById('subject').value ==''){
            alert('Please enter subject');
            document.getElementById("subject").focus();
            return false;
        }
        else if(document.getElementById('comment').value ==''){
            alert('Please enter message');
            document.getElementById("comment").focus();
            return false;
        }

        if(document.getElementById('email').value !=''){
            if (!validateEmail(document.getElementById('email').value)) {
                alert('Please enter a right email address');
                document.getElementById('email').focus();
                return false;
            }
        }
        
        return true;
    }
    
</script>