<?php

class ValidatorManager {

    private $validators = array();
    private $validator_errors = array();

    public function addValidator(Validator $validator) {
        $this->validators[] = $validator;
        return $this;
    }

    public function validate($value) {
        foreach ($this->validators as $validator) {
            if (!$validator->validate($value)) {
                $this->validator_errors [] = array_merge($this->validator_errors, $validator->getErrors());
                return false;
            }
        }
        return true;
    }

    public function getErrors() {
        return $this->validator_errors;
    }

}

?> 