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
    $data = array();
    $data['firstname'] = stripform($_POST['firstname']);
    if (!$data['firstname']) {
        $errorArr['firstname'] = "Enter first name";
        $errorOccur = true;
    }
    $data['lastname'] = stripform($_POST['lastname']);
    if (!$data['lastname']) {
        $errorArr['lastname'] = "Enter last name";
        $errorOccur = true;
    }
    $data['email'] = stripform($_POST['email']);
    if (!$data['email']) {
        $errorArr['email'] = "Enter email";
        $errorOccur = true;
    }
    if ($data['email'] && CustomerManager::isEmailExist($data['email'])) {
        $errorArr['email'] = "Email already exist";
        $errorOccur = true;
    }
    $data['telephone'] = stripform($_POST['telephone']);
    if (!$data['telephone']) {
        $errorArr['telephone'] = "Enter telephone";
        $errorOccur = true;
    }
    $data['address_1'] = stripform($_POST['address_1']);
    if (!$data['address_1']) {
        $errorArr['address_1'] = "Enter address 1";
        $errorOccur = true;
    }
    $data['city'] = stripform($_POST['city']);
    if (!$data['city']) {
        $errorArr['city'] = "Enter city";
        $errorOccur = true;
    }
    $data['postcode'] = stripform($_POST['postcode']);
    if (!$data['postcode']) {
        $errorArr['postcode'] = "Enter post code";
        $errorOccur = true;
    }
    $data['country'] = stripform($_POST['country']);
    if (!$data['country']) {
        $errorArr['country'] = "Select any country";
        $errorOccur = true;
    }

    $data['zone_id'] = stripform($_POST['zone_id']);

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
    $data['fax'] = stripform($_POST['fax']);
    $data['address_2'] = stripform($_POST['address_2']);
    $data['company'] = stripform($_POST['company']);


    if ($data['confirm'] != $data['password']) {
        $errorArr['confirm'] = "Passwords doesn't match";
        $errorOccur = true;
    }

    $data['password'] = sha1($data['password'].SALT); // make encrypted password
    //pr($data); die;
    if (!$errorOccur) {
        // Save customer and customerAddress
        $result = CustomerManager::saveCustomer($data);
        if ($result['success'] == 1) { // success
            redirectPage("login.php?s=5&reg_status=1");
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
    <div class="alert">If you already have an account with us, please login at the <a href="login.php"><span class="link_color">login page</span></a>.</div>

    <div class="col-lg-9 no-padding col-left">
        <form id="registration-form" name="registrationForm" method="post" action="registration.php" class="form-horizontal" role="form" onsubmit="return validation();">
        <div class="col-lg-12 new-users">
            <h4>Your Personal Details</h4>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="firstname">First Name: <span
                        class="required">*</span></label>

                <div class="col-sm-8">
                    <input type="text" name="firstname" id="firstname" class="form-control">
                    <?php echo($errorOccur && $errorArr['firstname'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['firstname'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="lastname">Last Name: <span class="required">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="lastname" id="lastname" class="form-control">
                    <?php echo($errorOccur && $errorArr['lastname'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['lastname'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="E-mail">E-mail: <span class="required">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="email" id="email" class="form-control">
                    <?php echo($errorOccur && $errorArr['email'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['email'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="Telephone">Telephone: <span
                        class="required">*</span></label>

                <div class="col-sm-8">
                    <input type="text" name="telephone" id="telephone" class="form-control">
                    <?php echo($errorOccur && $errorArr['telephone'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['telephone'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="Fax">Fax: </label>

                <div class="col-sm-8">
                    <input type="text" name="fax" id="fax" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-lg-12 new-users" style="margin-top: 20px;">
            <h4>Your Address</h4>

            <div class="form-group">
                <label class="col-sm-3 control-label" for="company">Company</label>

                <div class="col-sm-8">
                    <input type="text" name="company" id="company" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="address_1">Address 1:<span class="required">*</span></label>

                <div class="col-sm-8">
                    <input type="text" value="" name="address_1" id="address_1" class="form-control">
                    <?php echo($errorOccur && $errorArr['address_1'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['address_1'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="address_2">Address 2: </label>

                <div class="col-sm-8">
                    <input type="text" value="" name="address_2" id="address_2" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="city">City :<span class="required">*</span></label>

                <div class="col-sm-8">
                    <input type="text" value="" name="city" id="city" class="form-control">
                    <?php echo($errorOccur && $errorArr['city'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['city'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="postcode">Post Code: <span class="required">*</span></label>

                <div class="col-sm-8">
                    <input type="text" value="" name="postcode" id="postcode" class="form-control">
                    <?php echo($errorOccur && $errorArr['postcode'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['postcode'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="country">Country: <span class="required">*</span></label>

                <div class="col-sm-8">
                    <select class="col-sm-12 form-control" id="country" name="country">
                        <option value="">Select Country</option>
                        <?php $countrys = CustomerManager::getCountries(); ?>
                        <?php foreach ($countrys as $county): ?>
                            <option
                                value="<?php echo $county->getCountryId() ?>"><?php echo $county->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo($errorOccur && $errorArr['country'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:40px;">' . $errorArr['country'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="region">Region/State: <span
                        class="required"></span></label>

                <div class="col-sm-8">
                    <!--<input type="text" id="zone_id" name="zone_id" class="form-control">-->
                    <select class="col-sm-12 form-control" id="zone_id" name="zone_id">
                        <option value="">Select Zone</option>
                    </select>
                    <?php echo($errorOccur && $errorArr['zone_id'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['zone_id'] . '</div>' : '') ?>
                </div>
            </div>
        </div>
        <div class="col-lg-12 new-users" style="margin-top: 20px;">
            <h4>Your Password</h4>

            <div class="form-group">
                <label class="col-sm-3 control-label " for="password">Password: <span class="required">*</span></label>

                <div class="col-sm-8">
                    <input type="password" placeholder="Password" id="password" name="password" class="form-control">
                    <?php echo($errorOccur && $errorArr['password'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['password'] . '</div>' : '') ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label " for="ConfirmPassword">Password Confirm: <span
                        class="required">*</span></label>

                <div class="col-sm-8 ">
                    <input type="password" name="confirm" id="confirm" class="form-control">
                    <?php echo($errorOccur && $errorArr['confirm'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['confirm'] . '</div>' : '') ?>
                </div>
            </div>
        </div>
        <div class="buttons-set">
            <p class="required">* Required Fields</p>
            <button class="button" id="save_btn" title="Submit"><span><span>Submit</span></span></button>
        </div>
        </form>
    </div>
    <div class="col-lg-3 col-right">
        <!--<div class="box">
            <div class="box-heading"><h2>Account</h2></div>
            <div class="box-content">
                <ul>
                    <li><a href="login.php">Login</a> / <a href="registration.php">Register</a></li>
                    <li><a href="#">Forgotten Password</a></li>
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">Wish List</a></li>
                    <li><a href="#">Order History</a></li>
                    <li><a href="#">Downloads</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Transactions</a></li>
                    <li><a href="#">Newsletter</a></li>
                </ul>
            </div>
        </div>-->
    </div>

</div>
<script type="text/javascript">

    function getZoneList() {
        var country_id = jQuery('#country').val();
        //var country_id = jQuery(this).val();

        var _method = 'POST';
        var _url = 'customer/getZoneList.php';
        var _queryStr = {country_id:country_id};

        jQuery.ajax({
            type:_method,
            url:_url,
            data:_queryStr,
            success:function (msg) {
                jQuery("#zone_id").empty().append(msg);
                //alert(msg);
            }
        });
    }

    jQuery('#country').change(getZoneList);

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


        if (document.getElementById('firstname').value == '') {
            alert('Please enter first name');
            document.getElementById("firstname").focus();
            return false;
        }
        else if (document.getElementById('lastname').value == '') {
            alert('Please enter last name');
            document.getElementById("lastname").focus();
            return false;
        }
        else if (document.getElementById('email').value == '') {
            alert('Please enter email');
            document.getElementById("email").focus();
            return false;
        }
        else if (document.getElementById('telephone').value == '') {
            alert('Please enter telephone');
            document.getElementById("telephone").focus();
            return false;
        }
        else if (document.getElementById('address_1').value == '') {
            alert('Please enter address 1');
            document.getElementById("address_1").focus();
            return false;
        }
        else if (document.getElementById('city').value == '') {
            alert('Please enter city');
            document.getElementById("city").focus();
            return false;
        }
        else if (document.getElementById('postcode').value == '') {
            alert('Please enter postcode');
            document.getElementById("postcode").focus();
            return false;
        }
        else if (document.getElementById('country').value == '') {
            alert('Please select country');
            document.getElementById("country").focus();
            return false;
        }
        else if (document.getElementById('password').value == '') {
            alert('Please enter password');
            document.getElementById("password").focus();
            return false;
        }
        else if (document.getElementById('confirm').value == '') {
            alert('Please enter confirm');
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