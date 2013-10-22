<?php
	class Validator{
	
		protected $value;
		protected $minimumChars = 0;
		protected $mixedCase = false;
		protected $minimumNumbers = 0;
		protected $minimumSymbols = 0;
		protected $alphaNumeric = false;
		protected $email  = false;
		protected $alpha  = false;
		protected $numeric = false;
		protected $Notblank = false;
		protected $errors = array();
		protected $fieldName = "value";
	
		public function __construct($value,$fieldName = "value") {
			$this->value = $value;
			$this->fieldName = $fieldName;
		}
		
		public function requireMinimumChars($len) {
			if (is_numeric($len) && $len> 0) {
			  $this->minimumChars= (int) $len; 
			}
		 }
		
		public function requireMixedCase() {
			$this->mixedCase = true;
		 }
		
		public function requireNumbers($num =1) {
			if (is_numeric($num) && $num > 0) {
			  $this->minimumNumbers = (int) $num; 
			}
		}
		
		public function requireSymbols($num = 1) {
			if (is_numeric($num) && $num > 0) {
			  $this->minimumSymbols = (int) $num; 
			}
		}
		public function requireAlphaNumeric()
		{
			$this->alphaNumeric= true;
		}
		
		public function requireValidationAsEmail()
		{
			$this->email = true;
		}
		
		public function requireAlpha()
		{
			$this->alpha= true;
		}
		
		public function requireNumeric()
		{
			$this->numeric= true;
		}
		public function requireNotBlank()
		{
			$this->notBlank = true;
		}
		
		public function check() {
		
			if (preg_match('/\s/', $this->value)) {
				$this->errors[] = "$this->fieldName cannot contain spaces.";	
			}
			if (strlen($this->value) < $this->minimumChars) {
				$this->errors[] = "$this->fieldName must be at least $this->minimumChars characters.";
			} 
			if($this->notBlank){
				if(strlen($this->value) < 1)
				{
					$this->errors[] = "$this->fieldName must not be blank";
				}
			}
			if ($this->mixedCase) {
			  $pattern = '/(?=.*[a-z])(?=.*[A-Z])/';
			  if (!preg_match($pattern, $this->value)) {
				$this->errors[] = "$this->fieldName should include uppercase and lowercase characters.";
			  }
			}
			if ($this->minimumNumbers) {
			  $pattern = '/\d/';
			  $found = preg_match_all($pattern, $this->value, $matches);
			  if ($found < $this->minimumNumbers) {
				$this->errors[] = "$this->fieldName should include at least $this->minimumNumbers number(s).";
			  }
			}
			if ($this->minimumSymbols) {
			  $pattern = "/[-!$%^&*(){}<>[\]'" . '"|#@:;.,?+=_\/\~]/';
			  $found = preg_match_all($pattern, $this->value, $matches);
			  if ($found < $this->minimumSymbols) {
				$this->errors[] = "$this->fieldName should include at least $this->minimumSymbols nonalphanumeric character(s)."; 
			  }
			}
			if($this->alphaNumeric){
				$pattern = "/^([a-zA-Z0-9])+$/i";
				if(!preg_match($pattern, $this->value))
				{
					$this->errors[] = "$this->fieldName should include at least 1 non-numeric character and 1 numeric character";
				}
			}
			if($this->email)
			{
				if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
					
					$this->errors[] = "invalid email address";
				}
			}
			if($this->alpha){
				$pattern = "/^[a-zA-Z -]+$/";
				
				if(!preg_match($pattern, $this->value))
				{
					$this->errors[] = "$this->fieldName can only contain letters";
				}
			}
			if($this->numeric){
				$pattern = "/^(?:0|[1-9][0-9]*)$/";
				
				if(!preg_match($pattern, $this->value))
				{
					$this->errors[] = "$this->fieldName can only contain numbers";
				}
			}
			
			return $this->errors ? false : true;
		}
		
		public function getErrors() {
			return $this->errors; 
		}
		
	}
?>