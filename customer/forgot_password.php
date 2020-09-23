<?php
require_once ROOT . "functions/Connection.php";
require_once ROOT . "classes/Country.php";
require_once ROOT . "classes/Zone.php";
require_once "CustomerManager.php";

$errorArr = array();
$errorOccur = false;
define('SALT', 'SD0796SDF87B890JK89RBMLEJIEW');
if (count($_POST)) {
    // Registration form validation check
    $errorOccur = false;
    $data['email'] = stripform($_POST['email']);
    if ($data['email'] && !(CustomerManager::isEmailExist($data['email']))) {      
        $errorArr['email'] = "Email does not exist";
        $errorOccur = true;
        
    }   
   
    $data['password'] = stripform($_POST['password']);
    if (!$data['password']) {
        $errorArr['password'] = "Enter password";
        $errorOccur = true;
    }
    $data['confirm'] = stripform($_POST['confirm']);
    if (!$data['confirm']) {
        $errorArr['confirm'] = "Enter confirm password";
        $errorOccur = true;
    }   
    if ($data['confirm'] != $data['password']) {
        $errorArr['confirm'] = "Passwords doesn't match";
        $errorOccur = true;
    }
    $data['password'] = sha1($data['password'].SALT); // make encrypted password
   
    if (!$errorOccur) {
        // Save customer and customerAddress

        $result = CustomerManager::saveForgotPass($data);
        if ($result['success'] == 1) { // success
            redirectPage("login.php?s=5&chng_pass=1");
        } else { // error
            // handle error
            echo '<div class="alert alert-error" for="page">Can not save page information.</div>';
        }
    }
}

?>

<div class="account-login">
    <div class="page-title">
        <h1>Welcome to JuzzSports</h1>
    </div>
   <!-- <div class="alert">If you already have an account with us, please login at the <a href="login.php"><span class="link_color">login page</span></a>.</div>-->

    <div class="col-lg-9 no-padding col-left">
        <form id="forgotPassword-form" name="forgotPasswordForm" method="post" action="forgot_password.php" class="form-horizontal" role="form" onsubmit="return validation();">

        <div class="col-lg-12 new-users" style="margin-top: 20px;">
            
            <h4>Reset Password</h4>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="E-mail">E-mail: <span class="required">*</span></label>

                <div class="col-sm-8">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Your Email Address" >
                    <?php echo($errorOccur && $errorArr['email'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['email'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="password">New Password: <span class="required">*</span></label>

                <div class="col-sm-8">
                    <input type="password" placeholder="Password" id="password" name="password" class="form-control">
                    <?php echo($errorOccur && $errorArr['password'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['password'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="ConfirmPassword">Password Confirm: <span
                        class="required">*</span></label>

                <div class="col-sm-8 ">
                    <input type="password" name="confirm" placeholder="Confirm Password" id="confirm" class="form-control">
                    <?php echo($errorOccur && $errorArr['confirm'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['confirm'] . '</div>' : '') ?>
                </div>
            </div>            
            <div class="form-group" >
                <label class="col-sm-3 control-label " >&nbsp;</label>
                <div class="col-sm-4">
                 <p><button type="Submit" class="button" title="Submit" name="send" id="save_btn"><span><span>Reset Password</span></span></button></p>
                </div>
                <div class="col-sm-4 required"><p class="required">* Required Fields</p></div>
             </div>
           
        </div>
        
        </form>
    </div>

</div>
<script type="text/javascript">



    /**
     * Ref:: http://stackoverflow.com/questions/46155/validate-email-address-in-javascript
     *
     * @param email
     * @returns {boolean}
     */
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    // Form Validation
    function validation() {    
        if (document.getElementById('email').value == '') {
            alert('Please enter email');
            document.getElementById("email").focus();
            return false;
        }        
        else if (document.getElementById('password').value == '') {
            alert('Please enter new password');
            document.getElementById("password").focus();
            return false;
        }
        else if (document.getElementById('confirm').value == '') {
            alert('Please enter Confirmed Password');
            document.getElementById("confirm").focus();
            return false;
        }

        if (document.getElementById('confirm').value != document.getElementById('password').value) {
            alert('Confirm password doesn\'t match with password');
            document.getElementById('confirm').value = '';
            document.getElementById("confirm").focus();
            return false;
        }
        if (document.getElementById('email').value != '') {
            if (!validateEmail(document.getElementById('email').value)) {
                alert('Please enter a right email address');
                document.getElementById('email').focus();
                return false;
            }
        }

        return true;
    }

</script>