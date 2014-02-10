<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MixedCaseValidator
 *
 * @author Saad Arif 
 */
require_once 'Validator.php';

class MixedCaseValidator extends Validator {

    public function validate($value,$fieldName) {
        if (strtolower($value) === $value) {
            $this->errors[] = "$fieldName should include uppercase and lowercase characters.";
            return false;
        }
        return true;
    }

}
