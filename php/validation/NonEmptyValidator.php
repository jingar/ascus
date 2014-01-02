<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlankValidator
 *
 * @author Saad Arif
 */
require_once 'Validator.php';

class NonEmptyValidator extends Validator {

    public function __construct($fieldName) {
        parent::__construct($fieldName);
    }

    public function validate($value) {
        if (strlen($value) < 1) {
            $this->errors[] = "$this->fieldName must not be blank";
            return false;
        }
        return true;
    }

}
