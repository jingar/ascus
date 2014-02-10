<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlphaValidator
 *
 * @author Saad Arif 
 */
require_once 'Validator.php';

class AlphaValidator extends Validator {

    public function validate($value, $fieldName) {
        if (!ctype_alpha($value)) {
            $this->errors[] = "$fieldName can only contain letters";
            return false;
        }
        return true;
    }

}
