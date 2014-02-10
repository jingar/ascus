<?php

require_once 'Validator.php';

class AlphaNumericValidator extends Validator {

    public function validate($value, $fieldName) {
        $pattern = "/^([a-zA-Z0-9])+$/i";
        if (!preg_match($pattern, $value)) {
            $this->errors[] = "$fieldName should include at least 1 non-numeric character and 1 numeric character";
            return false;
        }
        return true;
    }

}

?>