<?php

class ValidatorManager {

    private $_validator_errors = array();
    private $_validators = array();

    public function addValidator($validator) {
        $this->_validators[] = $validator;
        return $this;
    }

    public function validate($value, $fieldName) {
        foreach ($this->_validators as $validator) {
            if (!$validator->validate($value, $fieldName)) {
                $this->_validator_errors = array_merge($this->_validator_errors, $validator->getErrors());
            }
        }

        $this->_validators = array();
        if (!empty($this->getErrors())) {
            return false;
        }
        return true;
    }

    public function getErrors() {
        return $this->_validator_errors;
    }

}

?> 