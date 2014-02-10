<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailValidator
 *
 * @author Saad Arif 
 */

require_once 'Validator.php';
class EmailValidator extends Validator {

    public function validate($value, $fieldName) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "$fieldName is not an valid address";
            return false;
        }
        return true;
    }

}
