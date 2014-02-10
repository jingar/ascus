<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NumericValidator
 *
 * @author Saad Arif
 */
require_once 'Validator.php';

class NumericValidator extends Validator {
    public function validate($value,$fieldName) {
        $pattern = "/^(?:0|[0-9]*)$/";

        if (!preg_match($pattern, $value)) {
            $this->errors[] = "$fieldName can only contain numbers";
            return false;
        }
        return true;
    }

//put your code here
}
