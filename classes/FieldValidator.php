<?php

class FieldValidator{
	public function __construct($required) { $this->required = $required; }
	protected $required=false;
	public function isValid($test) { return (!$this->required || strlen(trim($test)) > 0); }
	public function invalidReason($test) { return "This field is required"; }
	public function isRequired() { return $this->required; }
	public function clean($in) { return $in; }
}

class FieldValidatorPhone extends FieldValidator{
	public function __construct($required) { parent::__construct($required); }
	public function isValid($test){
		if (!parent::isValid($test)) return false;
		
		$test = $this->clean($test);
		return (preg_match('/^(?:\d{3}-\d{3}-\d{4})?$/', $test) == 1);
	}
	public function invalidReason($test){
		if (!parent::isValid($test)) return parent::invalidReason($test);
		return "Phone number must be in the format xxx-xxx-xxxx";
	}
	public function clean($in){
		if(!empty($in)){
			// remove non-numerics
			$in = preg_replace("/[^0-9]+/","",$in);
			
			if(strlen($in) > 10){
				// strip off leading 1 if exists then return
				$in = preg_replace("/^1?/","",$in);
			}
			
			// return in xxx-xxx-xxxx format
			$n1 = substr($in,0,3); //there will be: xxx
			$n2 = substr($in,3,3); //there will be: xxx
			$n3 = substr($in,6); //there will be: xxxx

			$in = $n1.'-'.$n2.'-'.$n3;
		}
		return $in;
	}
}

class FieldValidatorPhoneExt extends FieldValidator{
	public function __construct($required) { parent::__construct($required); }
	public function isValid($test){
		if (!parent::isValid($test)) return false;
		return (preg_match('/^(?:\d*)?$/',$test) == 1);
	}
	public function invalidReason($test){
		if (!parent::isValid($test)) return parent::invalidReason($test);
		return "Phone extension must contain only numbers";
	}
}

class FieldValidatorDateTime extends FieldValidator{
	public function __construct($required) { parent::__construct($required); }
	public function isValid($test){
		if (!parent::isValid($test)) return false;
		if(strlen($test)==1){ //single char input lets the DateTime object return the current time stamp
			return false;
		}
		try{
			$dtObj = new DateTime($test);
			return true;
		}catch(Exception $exc){
			return false;
		}
	}
	
	public function clean($in){
		$pattern = '/(?<day>\d{1,2})\-(?<month>Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)/';	
		if(!preg_match($pattern, $in)==1) $in = preg_replace('/(\-)+/','/', $in);
		
		$in = preg_replace('/(0000\/00\/00)|(00\/00\/0000)|(00\/00\/00)|(00:00:00)/','', $in);
		if(strlen(trim($in))>1){
			try{
				$dtObj = new DateTime($in);
				$in = $dtObj->format("Y-m-d H:i:s");
			}catch(Exception $exc){
				cust_warning($exc);
			}
		}
		return $in;
	}
	
	public function invalidReason($test, $byPass=false){
		if (!parent::isValid($test)) return parent::invalidReason($test);
		if(!$byPass)
			return "Incorrect DateTime format. Suggested formats [Date part:- mm/dd/yyyy Time part:- H:i:s or H:i AM/PM]";
		else
			return '';
	}
}

class FieldValidatorState extends FieldValidator{
	public function __construct($required) { parent::__construct($required); }
	public function isValid($test){
		if (!parent::isValid($test)) return false;
		return (preg_match('/^(?:[A-Z]{2})?$/',$test) == 1);
	}
	public function invalidReason($test){
		if (!parent::isValid($test)) return parent::invalidReason($test);
		return "State must be in two-character upper-case abreviated format such as MN";
	}
}

class FieldValidatorNumeric extends FieldValidator{
	public function __construct($required) { parent::__construct($required); }
	public function isValid($test){
		if (!parent::isValid($test)) return false;
		return (preg_match('/^(?:-?(\d+(?:\.\d*)?)|(\d*\.\d+))?$/',$test) == 1);
	}
	public function invalidReason($test){
		if (!parent::isValid($test)) return parent::invalidReason($test);
		return "It must be in Numeric format";
	}
}

class FieldValidatorBoolean extends FieldValidator{
	public function __construct($required) { parent::__construct($required); }
	public function isValid($test){
		if (!parent::isValid($test)) return false;
		return (preg_match('/^([0])$|^([1])$/',$test) == 1);
	}
	public function invalidReason($test){
		if (!parent::isValid($test)) return parent::invalidReason($test);
		return "Value must be 0 or 1";
	}
}

class FieldValidatorBooleanOrNull extends FieldValidator{
	public function __construct($required) { parent::__construct($required); }
	public function isValid($test){
		if (!parent::isValid($test)) return false;
		return (preg_match('/^(([0])$|^([1])$)?$/',$test) == 1);
	}
	public function invalidReason($test){
		if (!parent::isValid($test)) return parent::invalidReason($test);
		return "Value must be 0 or 1";
	}
}

class FieldValidatorZip extends FieldValidator{
	public function __construct($required) { parent::__construct($required); }
	public function isValid($test){
		if (!parent::isValid($test)) return false;
		return (preg_match('/^(?:\d{3,5})?$/',$test) == 1);
	}
	public function invalidReason($test){
		if (!parent::isValid($test)) return parent::invalidReason($test);
		return "Zip Code must be 5-digits";
	}
	public function clean($in) {
		return sprintf("%05d", $in);
	}
}

class FieldValidatorEmail extends FieldValidator{
	public function __construct($required) { parent::__construct($required); }
	public function isValid($test) {
		if (!parent::isValid($test)) return false;
		return (preg_match('/^([a-z0-9_\-\.\+]+@[a-z0-9.-]+(\.){1}[a-z0-9]+)?$/i',$test) == 1);
	}
	public function invalidReason($test){
		if (!parent::isValid($test)) return parent::invalidReason($test);
		return "Must be a valid email address";
	}
}

class FieldValidatorAmount extends FieldValidator{
	public function __construct($required) { parent::__construct($required); }
	public function isValid($test){
		if (!parent::isValid($test)) return false;
		return (preg_match('/^(?:\$?[0-9,]+(\.(\d{2}))?)?$/',$test) == 1);
	}
	public function invalidReason($test){
		if (!parent::isValid($test)) return parent::invalidReason($test);
		return "Must be a valid amount format";
	}
	
	public function clean($in){
		$out = preg_replace("/[\$\,]/","",$in);
		error_log("cleaning amount $in to $out");
		return $out;
	}
}

class FieldValidatorLocationType extends FieldValidator{
	public function __construct($required) { parent::__construct($required); }
	public function isValid($test){
		if (!parent::isValid($test))
			return false; // failed parent class's validation
		else if ($test == "")
			return true; // allow blanks, parent class would catch if required
		else if (is_numeric($test) && in_array($test, FieldValidatorLocationType::$types))
			return true; // specified as id and the id is valid
		else if (array_key_exists(strtolower($test), FieldValidatorLocationType::$types))
			return true; //
        else
		    return false;
	}
	public function invalidReason($test){
		if (!parent::isValid($test)) return parent::invalidReason($test);
		return "Must be one of the following: Commercial, Governmental, Residential, Educational, or Other";
	}
	public function clean($in) {
		$in = strtolower($in);
		if (is_numeric($in) && in_array($in, FieldValidatorLocationType::$types))
			return (int)$in; // specified as id so just return id
		if (array_key_exists($in, FieldValidatorLocationType::$types))
			return FieldValidatorLocationType::$types[$in]; // specified as text so lookup and return id
		return FieldValidatorLocationType::$types['commercial']; // our default is commercial
	}
	private static $types = ARRAY ('commercial'=>1, 'governmental'=>2, 'residential'=>3, 'educational'=>4, 'other'=>5 );
}

class FieldValidatorPayModeType extends FieldValidator{
	public function __construct($required) { parent::__construct($required); }
	public function isValid($test){
		if (!parent::isValid($test)) return false;
		return (preg_match('/^(?:fixed|hourly|device|blended)?$/i',$test) == 1);
	}
	public function invalidReason($test){
		if (!parent::isValid($test)) return parent::invalidReason($test);
		return "Must be one of the following: Fixed, Hourly, Device, Blended";
	}
}


class FieldValidatorRadius extends FieldValidator{
	public function __construct($required) { parent::__construct($required); }
	
	public function isValid($test){
		if (!parent::isValid($test)) return false;
		return (preg_match('/^(([0-9])$|^([0-5][0-9])$|^(60))?$/',$test) == 1);
	}
	public function invalidReason($test){
		if (!parent::isValid($test)) return parent::invalidReason($test);
		return "Publish Alert Radius should Be Numeric Value And <= 60 Miles";
	}
} 