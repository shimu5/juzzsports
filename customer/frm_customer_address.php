<?php
session_start();

// Load required files
require_once "../config.php";
require_once ROOT . "functions/Connection.php";
require_once ROOT . "functions/redirect.php";
require_once ROOT . "classes/Zone.php";
require_once "CustomerManager.php";

$sessUserId = (isset($_SESSION['sess_user_id'])) ? $_SESSION['sess_user_id'] : 0;

$errorArr = array();
$errorOccur = false;
if (count($_POST)) {

    //pr($_POST); die;
    $data = array();

    $data['customer_id'] = (isset($_SESSION['sess_user_id'])) ? $_SESSION['sess_user_id'] : 0;

    $data['address_id'] = intval($_POST['address_id']);

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
    $data['company'] = (stripform($_POST['company']) ? $_POST['company'] : "");
    $data['company_id'] = (stripform($_POST['company']) ? $_POST['company'] : "");
    $data['address_1'] = stripform($_POST['address_1']);
    if (!$data['address_1']) {
        $errorArr['address_1'] = "Enter address 1";
        $errorOccur = true;
    }
    $data['address_2'] = stripform($_POST['address_2']);

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
    $data['country'] = intval($_POST['country']);
    if (!$data['country']) {
        $errorArr['country'] = "Select any country";
        $errorOccur = true;
    }

    $data['zone_id'] = intval($_POST['zone_id']);

    if (!$errorOccur) {
        // Save customer and customerAddress
        $result = CustomerManager::saveCustomerAddress($data);
        if ($result['success'] == 1) { // success
            redirectPage("index.php?s=6&change_status=1");
        } else { // error
            // handle error
            echo '<div class="alert alert-error" for="page">Can not save page information.</div>';
        }
    }

}
$addressId = intval($_GET['address_id']);

$customerInfoObj = CustomerManager::getCustomerAddressById($addressId);

?>

<div class="page-title category-title">
    <h1>Address Book Entries</h1>
</div>
<!--  customer form goes here  -->
<div class="col-lg-9 no-padding col-left">
    <form id="registration-form" name="registrationForm" method="post"
          action="frm_customer_address.php" class="form-horizontal" role="form"
          onsubmit="return validation();">
        <input name="address_id" type="hidden" value="<?php echo ($customerInfoObj ? $customerInfoObj->getAddressId() : 0);?>">
        <div class="col-lg-12 new-users">

            <div class="col-lg-12 new-users" style="margin-top: 20px;">
                <h4>Your Address</h4>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="firstname">First Name: <span
                            class="required">*</span></label>

                    <div class="col-sm-8">
                        <input type="text" name="firstname" id="firstname" value="<?php echo ($customerInfoObj ? $customerInfoObj->getFirstname() : "");?>"
                               class="form-control">
                        <?php echo($errorOccur && $errorArr['firstname'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['firstname'] . '</div>' : '') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label " for="lastname">Last Name: <span
                            class="required">*</span></label>

                    <div class="col-sm-8">
                        <input type="text" name="lastname" id="lastname" value="<?php echo ($customerInfoObj ? $customerInfoObj->getLastname() : "");?>"
                               class="form-control">
                        <?php echo($errorOccur && $errorArr['lastname'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['lastname'] . '</div>' : '') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="company">Company</label>

                    <div class="col-sm-8">
                        <input type="text" name="company" id="company" value="<?php echo ($customerInfoObj ? $customerInfoObj->getCompany() : "");?>"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label " for="address_1">Address 1:<span
                            class="required">*</span></label>

                    <div class="col-sm-8">
                        <input type="text" name="address_1" id="address_1" value="<?php echo ($customerInfoObj ? $customerInfoObj->getAddress1() : "");?>"
                               class="form-control">
                        <?php echo($errorOccur && $errorArr['address_1'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['address_1'] . '</div>' : '') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="address_2">Address
                        2: </label>

                    <div class="col-sm-8">
                        <input type="text" value="<?php echo ($customerInfoObj ? $customerInfoObj->getAddress2() : "");?>" name="address_2" id="address_2" value="<?php echo $customerInfoArr[0]['address_2'];?>"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label " for="city">City :<span
                            class="required">*</span></label>

                    <div class="col-sm-8">
                        <input type="text" name="city" id="city" value="<?php echo ($customerInfoObj ? $customerInfoObj->getCity() : "");?>"
                               class="form-control">
                        <?php echo($errorOccur && $errorArr['city'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['city'] . '</div>' : '') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label " for="postcode">Post Code: <span
                            class="required">*</span></label>

                    <div class="col-sm-8">
                        <input type="text" value="<?php echo ($customerInfoObj ? $customerInfoObj->getPostcode() : "");?>" name="postcode" id="postcode"
                               class="form-control">
                        <?php echo($errorOccur && $errorArr['postcode'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['postcode'] . '</div>' : '') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label " for="country">Country: <span
                            class="required">*</span></label>

                    <div class="col-sm-8">
                        <select class="col-sm-12 form-control" id="country" name="country">
                            <option value="">Select Country</option>
                            <?php $countrys = CustomerManager::getCountries(); ?>
                            <?php foreach ($countrys as $county): ?>
                                <option
                                    value="<?php echo $county->getCountryId() ?>" <?php echo ($customerInfoObj && $customerInfoObj->getCountryId() == $county->getCountryId() ? 'selected="selected"' : "");?>><?php echo $county->getName() ?></option>
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
                            <?php $zoneListArr = Zone::getZoneByCountryId($customerInfoObj->getCountryId());
                            if($zoneListArr){
                                foreach($zoneListArr as $zoneObj){
                                    if($customerInfoObj->getZoneId() == $zoneObj->getZoneId())
                                        echo '<option value="'.$zoneObj->getZoneId().'" selected="selected">'.$zoneObj->getName().'</option>';
                                    else
                                        echo '<option value="'.$zoneObj->getZoneId().'">'.$zoneObj->getName().'</option>';
                                }
                            }

                            ?>
                        </select>
                        <?php echo($errorOccur && $errorArr['zone_id'] ? '<div class="alert alert-error" for="customer_registratin" style="margin-top:5px;">' . $errorArr['zone_id'] . '</div>' : '') ?>
                    </div>
                </div>
            </div>
            <div class="buttons-set">
                <p class="required">* Required Fields</p>
                <button class="button" id="save_btn" title="Submit">
                    <span><span>Submit</span></span></button>
            </div>
        </div>
</div>


<script type="text/javascript">

    function getZoneList() {
        alert("ddd");
        var country_id = jQuery('#country').val();
        //var country_id = jQuery(this).val();

        var _method = 'POST';
        var _url = 'getZoneList.php';
        var _queryStr = {country_id: country_id};

        jQuery.ajax({
            type: _method,
            url: _url,
            data: _queryStr,
            success: function (msg) {
                jQuery("#zone_id").empty().append(msg);
                //alert(msg);
            }
        });
    }

    jQuery('#country').change(getZoneList);

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


        return true;
    }

</script>