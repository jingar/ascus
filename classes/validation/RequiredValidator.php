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

class RequiredValidator extends Validator {

    public function validate($value, $fieldName) {
        if (strlen($value) < 1) {
            $this->errors[] = "$fieldName must not be blank";
            return FALSE;
        }
        return TRUE;
    }

}
